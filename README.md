Session Based Authentication
====================================

Laravel 5 Session Authentication driver.

Implemented Features
--------------------
* Session level persistence for User information retrieved from other application


Installation
------------
To install this driver in your application, add the following to your `composer.json` file

```json
{
  ...
  "require": {
    "laravel/framework": "5.*",
    ...
    "KerchumA222/session-auth": "3.*",
  },
  ...
  "repositories": [{
    "type": "vcs",
    "url": "https://github.com/KerchumA222/session-auth"
  }],
  ...
}
```

Then run `composer update`.
NOTE: You may have to run composer with the `--prefer-source` flag in order to install this from GitHub. You will also need git installed on your machine. This is temporary and will be resolved when this is hosted on packagist.

Once you have finished downloading the package from GitHub you need to tell your Application to use the LDAP service provider.

Open `app/config/app.php` and find

`Illuminate\Auth\AuthServiceProvider::class`

and replace it with

`KerchumA222\SessionAuth\SessionAuthServiceProvider::class`

This tells Laravel 5 to use the service provider from the vendor folder.

You also need to direct Auth to use the session driver instead of Eloquent or Database, edit `config/auth.php` and change driver to `session`

Configuration
-------------
No configuration needed.

Usage
-----
Use of `Auth` is the same as with the default service provider.

Model Usage
-----------
You do not use a model with this implementation. 