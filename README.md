[![Build Status](https://travis-ci.com/hellemarck/ramverk1-weather_module.svg?branch=main)](https://travis-ci.com/hellemarck/ramverk1-weather_module)
[![CircleCI](https://circleci.com/gh/circleci/circleci-docs.svg?style=svg)](https://circleci.com/gh/hellemarck/ramverk1-weather_module)

## Weather module for Anax framework

This module is developed for usage in the PHP framework Anax.

### Installation

`composer require hellemarck/weather`

`make install`

`make install test`

### Copy configuration and module files

`rsync -av vendor/hellemarck/weather/config/ config/`

`rsync -av vendor/hellemarck/weather/src/ src/`

`rsync -av vendor/hellemarck/weather/test/ test/`

`rsync -av vendor/hellemarck/weather/view/ view/`

### Add your personal API keys

Modify the file `config/api_keys.php` to hold your personal API keys.

### Structure

The weather server will be available at `/weather`

and the ip server will be available at `/ip`

### Run tests

`make test`

Remember to fix the file api_keys.php first
