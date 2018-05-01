
# Laravel API with Passport Oauth2 Server

Implementation using Laravel Framework v5.6 and Laravel Passport's Oauth2 Server and examples provided on how to consume the API from multiple front end frameworks and other apps.

## Requirements

- Node.js
- Laravel 5.6+


## Steps

**Install Laravel**

``` bash
$ composer install
```


**Setup Laravel Auth**

``` bash
$ php artisan make:auth
```


**Add Passport**

``` bash
$ composer require laravel/passport
```


**Install Passport**

``` bash
$ php artisan passport:install
```


**Run migrations**

``` bash
$ php artisan migrate
```


**Add Passport Routes**

In AuthServiceProvider.php

``` php
namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}

```


**Set Passport as Auth's API driver**

In config/auth.php

``` php
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'passport',
        'provider' => 'users',
    ],
],
```


**Install Laravel Cors**

``` bash
$ composer require barryvdh/laravel-cors
```


## Examples


### Ionic Framework 

[Ionic 2 + Laravel Passport Login](https://github.com/fcaivano/ionic-passport-app)

### React

(soon)

### Inferno JS

(soon) 

### Marko JS

(soon)


## Contributing

If you have any suggestions or improvements open an issue.

<!-- ### Security

If you discover any security-related issues, please email email@provider.com instead of using the issue tracker. -->

<!-- ## Support

...

... -->


## License

Software licensed under the [MIT license](https://opensource.org/licenses/MIT).