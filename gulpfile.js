var fs          = require('fs');
var gulp        = require('gulp');
var runSequence = require('run-sequence');

// Project plugins
var rev          = require('gulp-rev');
var sass         = require('gulp-sass');
var clean        = require('gulp-clean');
var concat       = require('gulp-concat');
var rename       = require('gulp-rename');
var replace      = require('gulp-replace-task');
var collect      = require('gulp-rev-collector');
var imagemin     = require('gulp-imagemin');
var pngquant     = require('imagemin-pngquant');
var uglify       = require('gulp-uglify');
var minifyCss    = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var filter 	     = require('gulp-filter');
var plugin      = require('gulp-load-plugins')();

// Configuration
var config = require('./package.json').gulp;
var themePath = 'wp-content/themes/' + config.theme;
var distPath  = themePath + '/dist';
var distPathAbsolute = '/' + distPath;
var assetPath = themePath + '/assets';
const FOUNDATION = 'node_modules/foundation-sites';
var SOURCE = {
	scripts: [
		// Lets grab what-input first
	    'node_modules/what-input/dist/what-input.js',

		// Foundation core - needed if you want to use any of the components below
		FOUNDATION + '/dist/js/plugins/foundation.core.js',
		FOUNDATION + '/dist/js/plugins/foundation.util.*.js',

		// Pick the components you need in your project
		FOUNDATION + '/dist/js/plugins/foundation.abide.js',
		FOUNDATION + '/dist/js/plugins/foundation.accordion.js',
		FOUNDATION + '/dist/js/plugins/foundation.accordionMenu.js',
		FOUNDATION + '/dist/js/plugins/foundation.drilldown.js',
		FOUNDATION + '/dist/js/plugins/foundation.dropdown.js',
		FOUNDATION + '/dist/js/plugins/foundation.dropdownMenu.js',
		FOUNDATION + '/dist/js/plugins/foundation.equalizer.js',
		FOUNDATION + '/dist/js/plugins/foundation.interchange.js',
		FOUNDATION + '/dist/js/plugins/foundation.offcanvas.js',
		FOUNDATION + '/dist/js/plugins/foundation.orbit.js',
		FOUNDATION + '/dist/js/plugins/foundation.responsiveAccordionTabs.js',
		FOUNDATION + '/dist/js/plugins/foundation.responsiveMenu.js',
		FOUNDATION + '/dist/js/plugins/foundation.responsiveToggle.js',
		FOUNDATION + '/dist/js/plugins/foundation.reveal.js',
		FOUNDATION + '/dist/js/plugins/foundation.slider.js',
		FOUNDATION + '/dist/js/plugins/foundation.smoothScroll.js',
		FOUNDATION + '/dist/js/plugins/foundation.magellan.js',
		FOUNDATION + '/dist/js/plugins/foundation.sticky.js',
		FOUNDATION + '/dist/js/plugins/foundation.tabs.js',
		FOUNDATION + '/dist/js/plugins/foundation.toggler.js',
		FOUNDATION + '/dist/js/plugins/foundation.tooltip.js',

		// Place custom JS here, files will be concantonated, minified if ran with --production
		themePath + 'assets/js/**/*.js',
    ],
}

gulp.task(
	'default',
	[
		'compile-styles',
		'compile-scripts',
		'compile-fonts',
		'compile-images',
		'compile-templates'
	],
	function() {
		gulp.watch(assetPath + '/scss/**/*.scss',  ['compile-styles']);
		gulp.watch(assetPath + '/js/**/*.js',      ['compile-scripts']);
		gulp.watch(assetPath + '/fonts/**/*',      ['compile-fonts']);
		gulp.watch(assetPath + '/images/**/*',     ['compile-images']);
		gulp.watch(assetPath + '/templates/**/*',  ['compile-templates']);
	}
);

gulp.task('deploy-assets', function (callback) {
	runSequence(
		'clean',
		['compile-styles', 'compile-scripts', 'compile-images', 'compile-fonts', 'compile-templates'],
		['optimize-styles', 'optimize-scripts', 'optimize-images'],
		'version-assets',
		['replace-versioned-assets-in-assets', 'replace-versioned-assets-in-templates'],
		'gzip-assets',
		'publish-to-s3',
		callback
	);
});

gulp.task('clean', function () {
	return gulp.src([
		distPath,
		themePath + '/*.php'
	], {read: false})
		.pipe(clean({force: true}));
});

// Styles
// ------

gulp.task('compile-styles', function () {
	return (
		gulp.src([
			assetPath + '/scss/style.scss'
		])
		.pipe(sass().on('error', sass.logError))
		.pipe(autoprefixer({
				browsers: ['last 2 versions'],
				cascade: false
		}))
		.pipe(gulp.dest(distPath + '/css'))
	);
});

gulp.task('optimize-styles', function () {
	return gulp.src(distPath + '/css/style.css')
		.pipe(minifyCss())
		.pipe(gulp.dest(distPath + '/css'));
});



// Scripts
// -------

gulp.task('compile-scripts', function () {
	return (
		gulp.src( SOURCE.scripts )
		.pipe(plugin.plumber(function(error) {
            gutil.log(gutil.colors.red(error.message));
            this.emit('end');
        }))
		.pipe(concat('script.js'))
		.pipe(gulp.dest(distPath + '/js'))
	);
});

gulp.task('optimize-scripts', function () {
	return gulp.src(distPath + '/js/script.js')
		.pipe(uglify())
		.pipe(gulp.dest(distPath + '/js/'));
});



// Images
// -------

gulp.task('compile-images', function () {
	return gulp.src(assetPath + '/images/**/*')
		.pipe(gulp.dest(distPath + '/images'));
});

gulp.task('optimize-images', function () {
	return gulp.src(distPath + '/images/**/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest(distPath + '/images'));
});



// Fonts
// -----

gulp.task('compile-fonts', function () {
	return gulp.src(assetPath + '/fonts/**/*')
		.pipe(gulp.dest(distPath + '/fonts'));
});



// Templates
// ---------

gulp.task('compile-templates', function () {
	return gulp.src(assetPath + '/templates/**/*')
		.pipe(gulp.dest(themePath));
});


// versioning
// -----------

gulp.task('version-assets', function () {
	return gulp.src(distPath + '/**/*')
		.pipe(rev())
		.pipe(gulp.dest(distPath))
		.pipe(rev.manifest())
		.pipe(gulp.dest(themePath));
});

gulp.task('replace-versioned-assets-in-assets', function () {
	var dirReplacements = {};
	dirReplacements[distPathAbsolute] = config.productionAssetURL;

	return gulp.src([
			themePath + '/**/*.json',
			distPath + '/**/*.css',
			distPath + '/**/*.js'
		])
		.pipe(collect({ replaceReved: true, dirReplacements: dirReplacements }))
		.pipe(gulp.dest(distPath));
});

gulp.task('replace-versioned-assets-in-templates', function () {
	var dirReplacements = {};
	dirReplacements[distPathAbsolute] = config.productionAssetURL;

	return gulp.src([
			themePath + '/**/*.json',
			themePath + '/*.php'
		])
		.pipe(collect({ replaceReved: true, dirReplacements: dirReplacements }))
		.pipe(gulp.dest(themePath));
});
