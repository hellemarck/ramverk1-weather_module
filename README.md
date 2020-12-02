## Weather module for Anax framework

This module is developed for usage in the PHP framework Anax.

### Installation

`composer require hellemarck/weather`

`make install`

`make install test`

### Copy configuration

rsync -av vendor/hellemarck/weather/config/ config/

rsync -av vendor/hellemarck/weather/src/ src/

rsync -av vendor/hellemarck/weather/test/ test/

rsync -av vendor/hellemarck/weather/view/ view/

### Add your personal API keys

Modify the file `config/api_keys_sample.php` to hold your personal API keys, and change its name to `api_keys.php`.

### Structure

The weather server will be available at `/weather`

and the ip server will be available at `/ip`

### Run tests

`make test`

Remember to fix the file api_keys.php first
