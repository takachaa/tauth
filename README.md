# tauth

## Introduction
Beforehand you need to make sure possible to send email from email and connect Databases of your Application.
tauth provides Interim registration and activation while utilizing original auth system such as LoginController and more.
That's why this package is required **laravel 5.3**.
This package include some view files prevented from auth scaffold, So you don't need to use auth scaffold.
Now you can image that this package is based on auth scaffold.

## Installation
Require this package using Composer.
```
$ composer require takachaa/tauth
```

Instead, you may of course manually update your require block and run composer update if you so choose.
```
{
    "require": {
        "takachaa/tauth": "dev-master"
    }
}
```

## Configuration
1.Edit the composer.json of your application to set Name Space:
```
"autoload": {
        "classmap": [
            "database"
        ],
        "psr-4": {
            "App\\": "app/",
            "Takachaa\\Tauth\\": "vendor/takachaa/tauth/src"
        }
    },

```
2.Register the Takachaa\Tauth\TAuthServiceProvider in your config/app.php configuration file.
```
'providers' => [
    // Other service providers...

    Takachaa\Tauth\TAuthServiceProvider::class,
],
```
3.Executes the composer dump autoload command to regenerate the autloader configuration.
```
$ composer dumpautoload -o
```
4.To prepare views, Copy views of package to the view directory of your application.
```
$ php artisan vendor:publish
```
5.To run all of migrations, execute the migrate Artisan command.
```
php artisan migrate
```

## Usage
### Registration
1.To interim registration, Access the your application like this.
```
http://**your application url**/register
```
2.Input account data, click the register button.

3.You can receive an email from your application to activate account.

### Activation
1.Check an email from your application.

2.To Active account, Click the Activate Account in an email.

### Login
1.To login, Access the your application like this or by login link.
```
http://**your application url**/login
```
2.Input email and password, and then login without error.

### Logout
1.To logout, Access the your application like this or by logout link.
```
http://**your application url**/logout
```

### Password Reset
1.To reset password, Access the your application like this or by forgot your password link
```
http://**your application url**/password/reset
```
2.Input email address of activated account in reset form.

3.You can receive an email from your application to password change.

4.To Active account, Click the Reset Password link in an email.

5.Input email and new password, and then you login without error.

## License
This software is released under the MIT License, see LICENSE.txt.

## Tips
### To Edit name and email address of application.
Edit the config/mail.php
```
'from' => [
        'address' => 'hello@example.com',
        'name' => 'Example',
    ],
```
### To Change routing of this package.
Edit vendor/takachaa/tauth/src/Http/routes.php

