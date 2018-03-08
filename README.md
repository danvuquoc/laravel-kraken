# laravel-kraken
A composer package for the Kraken PHP API which supports the Laravel 5
framework.

## Composer Installation
The best way to install laravel-kraken is with [Composer](<https://getcomposer.org/>).

To install the most recent version, run the following command.

`$ php composer.phar require danvuquoc/laravel-kraken`

Alternatively, you may edit your composer.son directly by adding the following
to the require section.
```
"require": {
    "danvuquoc/laravel-kraken": "1.*",
}
```

## Integration in Laravel
### Publish Configuration File
Running the following command will publish `config/kraken.php` to your config
folder. In this file you will need to insert your api key and api secret.

`$ php artisan vendor:publish
—provider="Danvuquoc\Kraken\KrakenServiceProvider"`

### Providers
_This is only applicable to versions prior to Laravel 5.5, [Automatic Package Discovery](https://laravel.com/docs/packages#package-discovery) is enabled for Laravel 5.5 and above._

Register the service provider in `config/app.php` by inserting it into the
providers array:
```
'providers' => [
    ...
    Danvuquoc\Kraken\KrakenServiceProvider::class,
    ...
]
```


### Facade
_This is only applicable to versions prior to Laravel 5.5, [Automatic Package Discovery](https://laravel.com/docs/packages#package-discovery) is enabled for Laravel 5.5 and above._

Register the facade in `config/app.php` by inserting it into the aliases array:
```
'aliases' => [
    ...
    'KrakenIO' => Danvuquoc\Kraken\KrakenFacade::class,
    ...
]
```
## Usage
Be sure to `use KrakenIO;` in your code

Then you can simply:
```
$response = KrakenIO::url([
    'url' => 'http://url-to-image.com/file.jpg',
    'wait' => true,
]);
```

Full documentation on the Kraken PHP Api is available on their [Kraken PHP API
Github Repo](<https://github.com/kraken-io/kraken-php>).
