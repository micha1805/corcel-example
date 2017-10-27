# Corcel framework

Laravel + WordPress = Corcel ;)

## Scope

* PHP: 7.1.10 (extensions: openssl, pdo, pdo_mysql, mbstring, tokenizer, xml)
* Composer: 1.5.2
* Laravel: 5.5.18

If you need to update your PHP version:

```bash
$ php -v
$ curl -s http://php-osx.liip.ch/install.sh | bash -s 7.1
```

If you need to install some of the PHP extensions required:

```bash
$ sudo apt-get install php7.1-openssl
```

If you need to install the latest Composer version:

```bash
$ composer --version

$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"

$ mv composer.phar /usr/local/bin/composer
```

> Be sure that you have these paths in your $PATH: `/usr/local/php5/bin` and `~/.composer/vendor/bin`.

## Knowledge base

These are the steps followed to create the project, which basically consist of integrating [Laravel](https://laravel.com/) and [WordPress](https://wordpress.org/), using [Corcel](https://github.com/corcel/corcel).

The main reason why we wanted to use Laravel in conjunction with WordPress in this project is taking advantage of WordPress posts/medias/menus/users content management system.

We will show you all the steps we took to reach the starting point of the project.

> For this intro, we are going to use [MAMP](https://www.mamp.info/en/) to run a local server environment.

### Installing Laravel and Wordpress

First, we're going to install Laravel:

```bash
$ composer create-project laravel/laravel corcel
```

And then, we install WordPress inside the Laravel root directory:

```bash
$ cd corcel
$ curl -O https://wordpress.org/latest.zip
$ unzip -q latest.zip
$ mv wordpress admin
$ rm -f latest.zip
```

At the time of this writing, the latest version of WordPress is 4.8.2.

### Setting up Laravel

First of all, we're going to install npm packages. It's going to take a couple of minutes, so you have time to go grab a drink or something :)

```bash
$ npm install
```

Then, we need to tell Laravel's htaccess to redirect transparently all requests to the subdirectory `/public`, except if we're requesting `/admin`:

```bash
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteBase /

    # Condition: all URIs, except /admin
    RewriteCond %{REQUEST_URI} !^/admin/
    # Rule: go to /public
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
```

You should now see the Laravel's splash screen when you navigate to `http://localhost:8888`.

### Setting up WordPress

WordPress shift. We need to prevent Laravel's htaccess rewriting rules from being inherited by WordPress. In order to do so, we're going to create the file `/public/admin/.htaccess` with the following content:

```bash
# BEGIN WordPress

<IfModule mod_rewrite.c>
    RewriteEngine Off
</IfModule>

# END WordPress
```

And, because we're gonna use Laravel in the frontend, we will disable the WordPress frontend completely by overwriting `/public/admin/index.php` with:

```php
<?php
header("Location: ./wp-admin/index.php");
exit();
```

Now, we need to create a database for our WordPress installation:

> Make sure you have the following path in your $PATH to use *mysql*: `/Applications/MAMP/Library/bin`

```bash
$ mysql --host=localhost -uroot -proot -e "create database corcel;"
```

Then, open the file `/admin/wp-config.php`, and modify the following lines with your database configuration:

```php
/** The name of the database for WordPress */
define('DB_NAME', 'corcel');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');
```

Also, add the following lines after the previous ones:

```php
/** Config the front-end url */
define('WP_HOME', 'http://localhost:8888');

/** Config the admin url */
define('WP_SITEURL', 'http://localhost:8888/admin');
```

> You should change WordPress debugging mode to true during development, too.

Now, add to the .env file these lines, because we will use it later:

```
WP_DATABASE=corcel
WP_USERNAME=root
WP_PASSWORD=root
WP_HOME=http://localhost:8888
WP_SITEURL=http://localhost:8888/admin
```

Finally, we should init the WordPress installation to create all the database tables automatically. We do this going to [http://localhost:8888/admin](http://localhost:8888/admin).

When finished, we will be able to access to the WordPress CMS with user/password created.

### Installing Corcel

Install Corcel using Composer again:

```bash
$ composer require jgrossi/corcel
```

Now we have to include *CorcelServiceProvider* in our `/config/app.php`:

```php
'providers' => [
    /*
     * Package Service Providers...
     */
    Corcel\Laravel\CorcelServiceProvider::class,
]
```

Then, run the following Artisan command in your terminal to have a `/config/corcel.php` config file, where we will set the database connection with WordPress tables and much more.

```bash
php artisan vendor:publish --provider="Corcel\Laravel\CorcelServiceProvider"
```

### Setting up Corcel

Let's add those following database connections in our `/config/database.php` file:

```php
'connections' => [

    'laravel' => [ // for Laravel database
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],

    'wordpress' => [ // for WordPress database (used by Corcel)
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => env('WP_DATABASE'),
        'username' => env('WP_USERNAME'),
        'password' => env('WP_PASSWORD'),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => 'wp_',
        'strict' => false,
        'engine' => null,
        ],
],
```

Then, we just set the database `connection` we want to be used by Corcel in `/config/corcel.php`. In this case, we should want to use the `wordpress` connection for Corcel, so:

```php
'connection' => 'wordpress',
```

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

We will use [Laravel](https://laravel.com/), a PHP framework that utilizes [Composer](https://getcomposer.org/) to manage its dependencies.

Also, we will use [Sass](http://sass-lang.com/) processing, the most mature, stable, and powerful professional grade CSS extension language in the world.

### Installing

Clone this repository:

```
$ git clone https://<your-username>@bitbucket.org/binalogue/<project-name>.git
```

Run Composer:

```
$ composer install
```

Run npm:

```
$ npm install
```

### Build commands

* `$ php artisan serve` — Compile and optimize the files in your assets directory

## Project structure

```
corcel/                             # → Root of your app
├── app/
│   ├── Console/
│   ├── Exceptions/
│   ├── Http/
|   |   ├── Controllers/
|   |   |   ├── Auth/
|   |   |   └── Controller.php
|   |   ├── Middleware/
|   |   └── Kernel.php
│   ├── Providers/
│   └── User.php
├── bootstrap/
├── config/
├── database/
├── node_modules/
├── public/
├── resources/
│   ├── assets/
│   │   ├── js/
│   │   └── sass/
│   ├── lang/
│   └── views/
│       ├── layouts/
│       └── partials/
├── routes/
├── storage/
├── tests/
├── vendor/
├── .editorconfig
├── .env
├── .gitignore
├── .htaccess
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── README.md
├── server.php
└── webpack.mix.js
```

## Built with

* [Laravel](https://laravel.com) - The PHP framework for web artisans
* [Composer](https://getcomposer.org/) - A dependency manager for PHP
* [npm](https://npmjs.com/) - A package manager for JavaScript and the world’s largest software registry
* [Bootstrap](http://getbootstrap.com/) - An open source toolkit for developing with HTML, CSS, and JavaScript
* [Sass](http://sass-lang.com/) - The most mature, stable, and powerful professional grade CSS extension language in the world
* [jQuery](https://jquery.com/) - A fast, small, and feature-rich JavaScript library
## Authors

* **[Binalogue](https://binalogue.com)**

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgments

* [Humans TXT](http://humanstxt.org/): We Are People, Not Machines
