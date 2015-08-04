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

Once you have finished downloading the package from GitHub you need to tell your Application to use the session-auth service provider.

Open `app/config/app.php` and find

`Illuminate\Auth\AuthServiceProvider::class`

and replace it with

`KerchumA222\SessionAuth\SessionAuthServiceProvider::class`

This tells Laravel 5 to use the service provider from the vendor folder.

You also need to direct Auth to use the session driver instead of Eloquent or Database, edit `config/auth.php` and change driver to `session`

Configuration
-------------
No configuration needed in the client application. The Authenticating application needs to store user details in the shared `Session` in the key 'currentUser'. The required details of the currentUser are 'id', 'username' (or whatever your primary identifier is), and 'remember_token' (for remembering users in the child applications without going back to the authentication application).

### Example
In your authentication application (which should NOT include this plugin)
`Session::put('currentUser', ['id'=>1, 'username'=>'KerchumA222', 'remember_token'=>'xxxxxxx', 'groups'=>['Admin', 'User']]);`
This can be conveniently done in the `Authentication.php` middleware.

Usage
-----
Use of `Auth` is the same as with the default service provider. Auth::user() returns an instance of `GenericUser` with all the details stored in `Session` by the parent application.

Model Usage
-----------
You do not use a model with this implementation. 
