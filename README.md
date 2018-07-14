# Moulded Plastic Theme
Matthew Conto's personal portfolio theme, aka an excuse to practice setting up dev environments.

## Getting Started
Run `docker-compose up` to run the dev wordpress docker. See https://github.com/visiblevc/wordpress-starter for more information on the `visiblevc/wordpress` container.

Run `gulp` (after installing the [gulp-cli](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md)) to start watching for changes.

### Additional Tools
- `xDebug`, a PHP debugger
	- Setup requires installing [PEAR/PECL](https://pear.php.net/manual/en/installation.getting.php) (which can be quite a hassle)
	- You should also look up how to setup and create a PHP.ini file for your OS
		- Mac: use `/etc/php.ini.default` as the base for `/etc/php.ini`
		- WSL: Google it
	- It turns out, on macOS, you also need to run `xcode-select --install`
	- Configuration guide at https://xdebug.org/docs/install#configure-php

## Resources
- Setting up [Docker for Windows](https://nickjanetakis.com/blog/setting-up-docker-for-windows-and-wsl-to-work-flawlessly)
- Setting up a [Docker workflow for Wordpress](https://github.com/visiblevc/wordpress-starter)