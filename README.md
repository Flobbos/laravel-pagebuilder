# Laravel-Pagebuilder


![Laravel Pagebuilder](img/laravel-pagebuilder.png)

### Docs

* [Installation](#installation)
* [Configuration](#configuration)
* [Migrations](#migrations)
* [Seeds](#seeds)
* [Generators](#generators)
* [Slugs](#slugs)
* [Fields](#fields)
* [JS](#js components)
* [Laravel compatibility](#laravel-compatibility)

## Installation

#### Install the package

```bash
composer require flobbos/laravel-pagebuilder
```
#### Install pagebuilder
Laravel 5.7+
```bash
php artisan pagebuilder:install 
```

This will run all migrations and trigger the seeder for the initial elements
and a language entry

## Configuration

The only thing in the config file is the classes you wish to use with Pagebuilder.

You need to generate a model class first using the built in generator.

```php
'builder_classes' => [
        'page' => App\Page::class,
    ]
```

Set additional classes that are supposed to run in a Pagebuilder controller. You can
generate multiple controllers for multiple resources using the Pagebuilder.

```php
$this->articles->setClass('page');
```

This setting in the generated controller will tell it which resource it needs to 
use for generating content.

## Generators

You can generate the controller and views for creating pagebuilder based resources
using the following generator commands:

```php
php artisan pagebuilder:controller ArticleController --route=pagebuilder.pages --views=pagebuilder.pages
```

This will generate a complete resource controller named PageController where the routes
and view calls are replaced with the values above. The views will always be prefixed with
vendor.

```php
php artisan pagebuilder:views pagebuilder.pages --route=pagebuilder.pages
```

Use the corresponding routes that you set with the controller and it will all work magically.

```php
pagebuilder:model Page
```

This will generate a Page model that extends the BasePage model that comes with
the package so all necessary relationships and translation options are included. 
This step is necessary to be able to generate content because the BasePage model
should not be used as a resource directly. 

## Slugs

The pagebuilder is capable of generating translated URL slugs for you. All you 
need to do is uncomment the following line from your generated model:

```php
//protected $slug_field = 'title'; 
```

This will tell the pagebuilder which field in the translations is supposed to 
generate the URL slug. The slug will automatically be regenerated when you change
the named field. 

## Fields

There are some basic fields in the settings area for an resource but you are free
to add as many additional fields as needed. These fields will be automatically
saved in the database without further modifications to the DB structure. 

## JS Components

To use the pagebuilder you need to install its VueJS counterpart by running:

```bash
npm install @chrisbielak/vue-pagebuilder
```

All the needed documentation can be found here: 
[Vue Pagebuilder](https://www.npmjs.com/package/@chrisbielak/vue-pagebuilder "Google's Homepage")

## Laravel compatibility

 Laravel  | Crudable
:---------|:----------
 6.0      | >1.0.3
 5.8      | >1.0.0
 5.7      | >1.0.0


