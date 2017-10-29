# **Introduction**

mygedung/modules is a laravel package which created to manage your large laravel app using modules. Module is like a laravel package, it has some views, controllers or models. This package is supported and tested in Laravel 5.

This package is a re-published, re-organised and maintained version of pingpong/modules, which isn't maintained anymore.

[![Build Status](https://travis-ci.org/myGedung/Modules.svg?branch=master)](https://travis-ci.org/myGedung/Modules)

## **Quick Example**

Generate your first module using php artisan module:make Blog. The following structure will be generated.

``` bash
app/
bootstrap/
vendor/
Modules/
  ├── Blog/
      ├── Assets/
      ├── Config/
      ├── Console/
      ├── Database/
          ├── Migrations/
          ├── Seeders/
      ├── Entities/
      ├── Http/
          ├── Controllers/
          ├── Middleware/
          ├── Requests/
          ├── routes.php
      ├── Providers/
          ├── BlogServiceProvider.php
      ├── Resources/
          ├── lang/
          ├── views/
      ├── Repositories/
      ├── Tests/
      ├── composer.json
      ├── module.json
      ├── start.php
```

# **Requirements**

The modules package requires PHP 7.0 or higher. The Laravel package also requires Laravel 5.5 or higher.

# **Installation and Setup**

## **Composer**

To install through Composer, by run the following command:

```
composer require mygedung/modules
```

The package will automatically register a service provider and alias.

Optionally, publish the package's configuration file by running:

``` bash
php artisan vendor:publish --provider="myGedung\Modules\LaravelModulesServiceProvider"
```

## **Autoloading**

By default the module classes are not loaded automatically. You can autoload your modules using psr-4. For example :

``` bash
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Modules\\": "Modules/"
    }
  }
}
```

>Tip: don't forget to run ```composer dump-autoload``` afterwards

# **Lumen**

Lumen doesn't come with a vendor publisher. In order to use laravel-modules with lumen you have to set it up manually.

Create a config folder inside the root directory and copy ```vendor/mygedung/modules/config/config.php``` to that folder named ```modules.php```

```
mkdir config
cp vendor/mygedung/modules/config/config.php config/modules.php
```

Then load the config and the service provider in ```app/bootstrap.php```

``` bash
$app->configure('modules');
$app->register(\myGedung\Modules\LumenModulesServiceProvider::class)
```

Modules uses ```path.public``` which isn't defined by default in Lumen. Register path.public before loading the service provider.

``` bash
$app->bind('path.public', function() {
 return __DIR__ . 'public/';
});
```

# **Creating a module**

Creating a module is simple and straightforward. Run the following command to create a module.

```
php artisan module:make <module-name>
```

Replace ```<module-name>``` by your desired name.

It is also possible to create multiple modules in one command.

```
php artisan module:make Blog User Auth
```

By default when you create a new module, the command will add some resources like a controller, seed class, service provider, etc. automatically. If you don't want these, you can add --plain flag, to generate a plain module.

```
php artisan module:make Blog --plain
```

 # or

```
php artisan module:make Blog -p
```

## **Naming convention**

Because we are autoloading the modules using psr-4, we strongly recommend using StudlyCase convention.

## **Folder structure**

``` bash
app/
bootstrap/
vendor/
Modules/
  ├── Blog/
      ├── Assets/
      ├── Config/
      ├── Console/
      ├── Database/
          ├── Migrations/
          ├── Seeders/
      ├── Entities/
      ├── Http/
          ├── Controllers/
          ├── Middleware/
          ├── Requests/
          ├── routes.php
      ├── Providers/
          ├── BlogServiceProvider.php
      ├── Resources/
          ├── lang/
          ├── views/
      ├── Repositories/
      ├── Tests/
      ├── composer.json
      ├── module.json
      ├── start.php
```

# **Custom namespaces**

When you create a new module it also registers new custom namespace for Lang, View and Config. For example, if you create a new module named blog, it will also register new namespace/hint blog for that module. Then, you can use that namespace for calling Lang, View or Config. Following are some examples of its usage:

Calling Lang:

``` bash
Lang::get('blog::group.name');

@trans('blog::group.name');
```

Calling View:

``` bash
view('blog::index')

view('blog::partials.sidebar')
```

Calling Config:

```
Config::get('blog.name')
```

# **Configuration**

You can publish the package configuration using the following command:

```
php artisan vendor:publish --provider="myGedung\Modules\LaravelModulesServiceProvider"
```

In the published configuration file you can configure the following things:

## **Default namespace**

What the default namespace will be when generating modules.

Key: ```namespace```

Default: ```Modules```

## **Overwrite the generated files**

Overwrite the default generated stubs to be used when generating modules. This can be useful to customise the output of different files.

Key: ```stubs```

## **Overwrite the paths**

Overwrite the default paths used throughout the package.

Key: ```paths```

## **Scan additional folders for modules**

This is disabled by default. Once enabled, the package will look for modules in the specified array of paths.

Key: ```scan```

## **Composer file template**

Customise the generated composer.json file.

Key: ```composer```

## **Caching**

If you have many modules it's a good idea to cache this information (like the multiple module.json files for example).

Key: ```cache```

## **Registering custom namespace**

Decide which custom namespaces need to be registered by the package. If one is set to false, the package won't handle its registration.

Key: ```register```

# **Helpers**

## **Module path function**

Get the path to the given module.

```
$path = module_path('Blog');
```

# **Artisan commands**

>**Useful Tip:**
You can use the following commands with the --help suffix to find its arguments and options.
>
>Note all the following commands use "Blog" as example module name, and example class/file names

## **Utility commands**

### **module:make**

Generate a new module.

```
php artisan module:make Blog
```

### **module:make**

Generate multiple modules at once.

```
php artisan module:make Blog User Auth
```

### **module:use**

Use a given module. This allows you to not specify the module name on other commands requiring the module name as an argument.

```
php artisan module:use Blog
```

### **module:unuse**

This unsets the specified module that was set with the module:use command.

```
php artisan module:unuse
```

### **module:list**

List all available modules.

```
php artisan module:list
```

### **module:migrate**

Migrate the given module, or without a module an argument, migrate all modules.

```
php artisan module:migrate Blog
```

### **module:migrate-rollback**

Rollback the given module, or without an argument, rollback all modules.

```
php artisan module:migrate-rollback Blog
```

### **module:migrate-refresh**

Refresh the migration for the given module, or without a specified module refresh all modules migrations.

```
php artisan module:migrate-refresh Blog
```

### **module:migrate-reset Blog**

Reset the migration for the given module, or without a specified module reset all modules migrations.

```
php artisan module:migrate-reset Blog
```

### **module:seed**

Seed the given module, or without an argument, seed all modules

```
php artisan module:seed Blog
```

### **module:publish-migration**

Publish the migration files for the given module, or without an argument publish all modules migrations.

```
php artisan module:publish-migration Blog
```

### **module:publish-config**

Publish the given module configuration files, or without an argument publish all modules configuration files.

```
php artisan module:publish-config Blog
```

### **module:publish-translation**

Publish the translation files for the given module, or without a specified module publish all modules migrations.

```
php artisan module:publish-translation Blog
```

### **module:enable**

Enable the given module.

```
php artisan module:enable Blog
```

### **module:disable**

Disable the given module.

```
php artisan module:disable Blog
```

### **module:update**

Update the given module.

```
php artisan module:update Blog
```

## **Generator commands**

### **module:make-command**

Generate the given console command for the specified module.

```
php artisan module:make-command CreatePostCommand Blog
```

### **module:make-migration**

Generate a migration for specified module.

```
php artisan module:make-migration create_posts_table Blog
```

### **module:make-seed**

Generate the given seed name for the specified module.

```
php artisan module:make-seed seed_fake_blog_posts Blog
```

### **module:make-controller**

Generate a controller for the specified module.

```
php artisan module:make-controller PostsController Blog
```

### **module:make-model**

Generate the given model for the specified module.

```
php artisan module:make-model Post Blog
```

Optional options:

- --fillable=field1,field2: set the fillable fields on the generated model
- --migration, -m: create the migration file for the given model

### **module:make-provider**

Generate the given service provider name for the specified module.

```
php artisan module:make-provider BlogServiceProvider Blog
```

### **module:make-middleware**

Generate the given middleware name for the specified module.

```
php artisan module:make-middleware CanReadPostsMiddleware Blog
```

### **module:make-mail**

Generate the given mail class for the specified module.

```
php artisan module:make-mail SendWeeklyPostsEmail Blog
```

### **module:make-notification**

Generate the given notification class name for the specified module.

```
php artisan module:make-notification NotifyAdminOfNewComment Blog
```

### **module:make-listener**

Generate the given listener for the specified module. Optionally you can specify which event class it should listen to. It also accepts a --queued flag allowed queued event listeners.

``` bash
php artisan module:make-listener NotifyUsersOfANewPost Blog

php artisan module:make-listener NotifyUsersOfANewPost Blog --event=PostWasCreated

php artisan module:make-listener NotifyUsersOfANewPost Blog --event=PostWasCreated --queued
```

### **module:make-request**

Generate the given request for the specified module.

```
php artisan module:make-request CreatePostRequest Blog
```

### **module:make-event**

Generate the given event for the specified module.

```
php artisan module:make-event BlogPostWasUpdated Blog
```

### **module:make-job**

Generate the given job for the specified module.

``` bash
php artisan module:make-job JobName Blog

php artisan module:make-job JobName Blog --sync # A synchronous job class
```

### **module:route-provider**

Generate the given route service provider for the specified module.

```
php artisan module:route-provider Blog
```

### **module:make-factory**

Generate the given database factory for the specified module.

```
php artisan module:make-factory FactoryName Blog
```

### **module:make-policy**

Generate the given policy class for the specified module.

The ```Policies``` is not generated by default when creating a new module. Change the value of ```paths.generator.policies``` in ```modules.php``` to your desired location.

```
php artisan module:make-policy PolicyName Blog
```

### **module:make-rule**

Generate the given validation rule class for the specified module.

The ```Rules``` folder is not generated by default when creating a new module. Change the value of ```paths.generator.rules``` in ```modules.php``` to your desired location.

```
php artisan module:make-rule ValidationRule Blog
```

### **module:make-resource**

Generate the given resource class for the specified module. It can have an optional --collection argument to generate a resource collection.

The ```Transformers``` folder is not generated by default when creating a new module. Change the value of ```paths.generator.resource``` in ```modules.php``` to your desired location.

``` bash
php artisan module:make-resource PostResource Blog
php artisan module:make-resource PostResource Blog --collection
```

### **module:make-test**

Generate the given test class for the specified module.

```
php artisan module:make-test EloquentPostRepositoryTest Blog
```

# **Facade methods**

Get all modules.

```
Module::all();
```

Get all cached modules.

```
Module::getCached()
```

Get ordered modules. The modules will be ordered by the priority key in module.json file.

```
Module::getOrdered();
```

Get scanned modules.

```
Module::scan();
```

Find a specific module.

``` bash
Module::find('name');
// OR
Module::get('name');
```

Find a module, if there is one, return the ```Module``` instance, otherwise throw ```myGedung\Modules\Exeptions\ModuleNotFoundException```.

```
Module::findOrFail('module-name');
```

Get scanned paths.

```
Module::getScanPaths();
```

Get all modules as a collection instance.

```
Module::toCollection();
```

Get modules by the status. 1 for active and 0 for inactive.

```
Module::getByStatus(1);
```

Check the specified module. If it exists, will return ```true```, otherwise ```false```.

```
Module::has('blog');
```

Get all enabled modules.

```
Module::enabled();
```

Get all disabled modules.

```
Module::disabled();
```

Get count of all modules.

```
Module::count();
```

Get module path.

```
Module::getPath();
```

Register the modules.

```
Module::register();
```

Boot all available modules.

```
Module::boot();
```

Get all enabled modules as collection instance.

```
Module::collections();
```

Get module path from the specified module.

```
Module::getModulePath('name');
```

Get assets path from the specified module.

```
Module::assetPath('name');
```

Get config value from this package.

```
Module::config('composer.vendor');
```

Get used storage path.

```
Module::getUsedStoragePath();
```

Get used module for cli session.

``` bash
Module::getUsedNow();
// OR
Module::getUsed();
```

Set used module for cli session.

```
Module::setUsed('name');
```

Get modules's assets path.

```
Module::getAssetsPath();
```

Get asset url from specific module.

```
Module::asset('blog:img/logo.img');
```

Install the specified module by given module name.

```
Module::install('mygedung/hello');
```

Update dependencies for the specified module.

```
Module::update('hello');
```

Add a macro to the module repository.

``` bash
Module::macro('hello', function() {
    echo "I'm a macro";
});
```

Call a macro from the module repository.

```
Module::hello();
```

Get all required modules of a module

```
Module::getRequirements('module name');
```

# **Module Methods**

Get an entity from a specific module.

```
$module = Module::find('blog');
```

Get module name.

```
$module->getName();
```

Get module name in lowercase.

```
$module->getLowerName();
```

Get module name in studlycase.

```
$module->getStudlyName();
```

Get module path.

```
$module->getPath();
```

Get extra path.

```
$module->getExtraPath('Assets');
```

Disable the specified module.

```
$module->disable();
```

Enable the specified module.

```
$module->enable();
```

Delete the specified module.

```
$module->delete();
```

Get an array of module requirements. Note: these should be aliases of the module.

```
$module->getRequires();
```

# **Publishing Modules**

After creating a module and you are sure your module module will be used by other developers. You can push your module to ```github``` or ```bitbucket``` and after that you can submit your module to the packagist website.

You can follow this step to publish your module.

- Create A Module.
- Push the module to github, bitbucket, gitlab etc.
- Submit your module to the packagist website. Submit to packagist is very easy, just give your github repository, click submit and you done.

## **Have modules be installed in the ```Modules/``` folder**

There is also a way for you to have your modules be installed in the ```Modules/``` automatically using *joshbrw/laravel-module-installer*. Simply require this package on your module, and set the type key in the ```composer.json``` file to ```laravel-module```.

# **Module Resources**

Your module will most likely contain what laravel calls resources, those contain configuration, views, translation files, etc. In order for you module to correctly load and if wanted publish them you need to let laravel know about them as in any regular package.

>**Note**
Those resources are loaded in the service provider generated with a module (using ```module:make```), unless the ```plain``` flag is used, in which case you will need to handle this logic yourself.

>**Note**
Don't forget to change the paths, in the following code snippets a "Blog" module is assumed.

## **Configuration**

``` bash
$this->publishes([
    __DIR__.'/../Config/config.php' => config_path('blog.php'),
], 'config');
$this->mergeConfigFrom(
    __DIR__.'/../Config/config.php', 'blog'
);
```

## **Views**

``` bash
$viewPath = base_path('resources/views/modules/blog');

$sourcePath = __DIR__.'/../Resources/views';

$this->publishes([
    $sourcePath => $viewPath
]);

$this->loadViewsFrom(array_merge(array_map(function ($path) {
    return $path . '/modules/blog';
}, \Config::get('view.paths')), [$sourcePath]), 'blog');
```

The main part here is the ```loadViewsFrom``` method call. If you don't want your views to be published to the laravel views folder, you can remove the call to the ```$this->publishes()``` call.

## **Language files**

``` bash
 $langPath = base_path('resources/lang/modules/blog');

if (is_dir($langPath)) {
    $this->loadTranslationsFrom($langPath, 'blog');
} else {
    $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'blog');
}
```

## **Factories**

If you want to use laravel factories you will have to add the following in your service provider:

``` bash
$this->app->singleton(Factory::class, function () {
    return Factory::construct(__DIR__ . '/Database/factories');
});
```

# **Module Console Commands**

Your module may contain console commands. You can generate these commands manually, or with the following helper:

```
php artisan module:make-command CreatePostCommand Blog
```

This will create a ```CreatePostCommand``` inside the Blog module. By default this will be ```Modules/Blog/Console/CreatePostCommand```.

## **Registering the command**

You can register the command with the laravel method called ```commands``` that is available inside a service provider class.

``` bash
$this->commands([
    \Modules\Blog\Console\CreatePostCommand::class,
]);
```

You can now access your command via ```php artisan``` in the console.

# **Registering Module Events**

Your module may contain events and event listeners. You can create these classes manually, or with the following helpers:

``` bash
php artisan module:make-event BlogPostWasUpdated Blog
php artisan module:make-listener NotifyAdminOfNewPost Blog
```

Once those are create you need to register them in laravel. This can be done in 2 ways:

- Manually calling ```$this->app['events']->listen(BlogPostWasUpdated::class, NotifyAdminOfNewPost::class);``` in your module service provider
- Or by creating a event service provider for your module which will contain all its events, similar to the ```EventServiceProvider``` under the app/ namespace.

## **Creating an EventServiceProvider**

Once you have multiple events, you might find it easier to have all events and their listeners in a dedicated service provider. This is what the EventServiceProvider is for.

Create a new class called for instance ```EventServiceProvider``` in the ```Modules/Blog/Providers``` folder (Blog being an example name).

This class needs to look like this:

``` bash
<?php

namespace Modules\Blog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [];
}
```

>Don't forget to load this service provider, for instance by adding it in the module.json file of your module.

This is now like the regular EventServiceProvider in the ```app/``` namespace. In our example the listen property will look like this:

``` bash
// ...
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BlogPostWasUpdated::class => [
            NotifyAdminOfNewPost::class,
        ],
    ];
}
```
