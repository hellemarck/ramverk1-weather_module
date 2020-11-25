## Weather module for Anax (used in the ramverk1 repo)

WORK IN PROGRESS....

### Installation

`composer require hellemarck/weather`

### Copy configuration

rsync -av vendor/hellemarck/weather/config config/
rsync -av vendor/hellemarck/weather/src src/
rsync -av vendor/hellemarck/weather/test test/
rsync -av vendor/hellemarck/weather/view view/

### Add your personal API keys

Copy the file `config/api_key_sample.php` and add your personal API key.
Further instructions are found in that file.

### Structure

The weather service will be available at `/weather`
and the ip service will be available at `/ip`


<!-- Version to use: 1.0.3 -->
