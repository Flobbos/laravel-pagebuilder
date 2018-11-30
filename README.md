# Laravel-Pagebuilder


![Laravel Pagebuilder](img/laravel-pagebuilder.png)

### Docs

* [Installation](#installation)
* [Configuration](#configuration)
* [Migrations] (#migrations)
* [Seeds] (#seeds)
* [Generators](#generators)
* [Usage](#usage)
* [Laravel compatibility](#laravel-compatibility)

## Installation

#### Install the package

```bash
composer require flobbos/laravel-pagebuilder
```
#### Publish assets/config
Laravel 5.*
```bash
php artisan vendor:publish 
```

#### Install the required dependencies
~~~
npm install --save typescript@2.9.2 ts-loader@3.2.0 vue-class-component vue-property-decorator vue-quill-editor vue-select vue2-dragula vuex vuex-class lodash @types/lodash vue-bootstrap-datetimepicker@4.x vue-sticky-directive vue2-dropzone
~~~


#### Set up TypeScript
After installing the required dependencies you have to tell webpack to handle the file extensions and to use the ts-loader instead the vue-loader.
Add following to your webpack.mix.js

~~~
 module: {
            rules: [
                // We're registering the TypeScript loader here. It should only
                // apply when we're dealing with a `.ts` or `.tsx` file.
                {
                    test: /\.tsx?$/,
                    loader: 'ts-loader',
                    options: { appendTsSuffixTo: [/\.vue$/] },
                    exclude: /node_modules/
                }
            ]
        },

        resolve: {
            // We need to register the `.ts` extension so Webpack can resolve
            // TypeScript modules without explicitly providing an extension.
            // The other extensions in this list are identical to the Mix
            // defaults.
            extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx'],

            alias: {
                'scss': path.resolve(__dirname, './resources/assets/sass/frontend'),
                'vendor': path.resolve(__dirname, './node_modules/'),
            }
        },
~~~

#### Set up vue-class-components and vue-property-decorator

Create a file called `tsconfig.json` in your project root and fill it with following:

~~~
{
    "compilerOptions": {
        "target": "es5",
        "module": "es2015",
        "moduleResolution": "node",
        "isolatedModules": false,
        "experimentalDecorators": true,
        "emitDecoratorMetadata": true,
        "declaration": true,
        "noImplicitAny": true,
        "removeComments": false,
        "strictNullChecks": true,
        "typeRoots": [
            "../node_modules/@types/"
        ],
        "allowSyntheticDefaultImports": true,
        "lib": [
            "dom",
            "es2015",
            "es2016",
            "es2017"
        ]
    },
    "include": [
        "./*.ts"
    ],
    "exclude": [
        "node_modules",
        "lib"
    ],
    "compileOnSave": false
}
~~~

This is needed to use the vue-class-components and vue-property-decorator annotations

Because not all dependencies are TypeScript ready we need to create a declaration file in order that TypeScript knows the require method.

Create a file called `require.d.ts`  and declare the function like this:

~~~
declare function require(name: string): any;
~~~

## Configuration

The only thing in the config file is the classes you wish to use with Pagebuilder.

```php
'builder_classes' => [
        'article' => Flobbos\Pagebuilder\Models\Article::class,
    ]
```

Set additional classes that are supposed to run in a Pagebuilder controller. You can
generate multiple controllers for multiple resources using the Pagebuilder.

```php
$this->articles->setClass('article');
```

This setting in the generated controller will tell it which resource it needs to 
use for generating content.

## Migrations

You need to run the migrations in order for the package to work. This will 
also create a basic 'articles' table for your resources that you can change 
in order to fit your needs. 

## Seeds

You need to run the table seeder to have the first few standard elements active
in the Pagebuilder by using the following command:

```php
php artisan db:seed --class="Flobbos\Pagebuilder\Database\Seeds\ElementTableSeeder"
```

## Generators

You can generate the controller and views for creating pagebuilder based resources
using the following generator commands:

```php
php artisan pagebuilder:controller ArticleController --route=pagebuilder.articles --views=pagebuilder.articles
```

This will generate a complete resource controller named ArticleController where the routes
and view calls are replaced with the values above. The views will always be prefixed with
vendor.

```php
php artisan pagebuilder:views vendor.pagebuilder.articles --route=pagebuilder.articles
```

Use the corresponding routes that you set with the controller and it will all work magically.

```php
pagebuilder:model Post
```

This will generate a Post model that extends the Article model that comes with
the package so all necessary relationships and translation options are included. 
This step is only needed if your base model needs additional fields that don't 
come with the Article model. 

## Usage

Now it's time to use the pagebuilder.
Go to your admin.js or wherever you want to use it and load the pagebuilder.js file

~~~

require('./pagebuilder');
~~~

After that register the Vuex Store in your Vue instance.

~~~
import store from "./pagebuilder/store/index.ts"

...

const app = new Vue({
    el: '#app',
    store
});

~~~

## Laravel compatibility

 Laravel  | Crudable
:---------|:----------
 5.6      | >0.0.5
 5.5      | >0.0.5
 5.4      | >0.0.5

**Notice**: We're currently working on a new branch for Laravel 5.7 because that
version came with Bootstrap 4 and our views are based on Bootstrap 3. You can 
use the package with Laravel 5.7 of course but you need to update the views.

