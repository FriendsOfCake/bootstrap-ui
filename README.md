# Bootstrap UI

[![Build Status](https://img.shields.io/travis/FriendsOfCake/bootstrap-ui/master.svg?style=flat-square)](https://travis-ci.org/FriendsOfCake/bootstrap-ui)
[![Coverage Status](https://img.shields.io/coveralls/FriendsOfCake/bootstrap-ui/master.svg?style=flat-square)](https://coveralls.io/r/FriendsOfCake/bootstrap-ui?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofcake/bootstrap-ui.svg?style=flat-square)](https://packagist.org/packages/friendsofcake/bootstrap-ui)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://packagist.org/packages/friendsofcake/bootstrap-ui)

Transparently use [Bootstrap 3][twbs3] with [CakePHP 3][cakephp].

## Requirements

* CakePHP 3.x
* Bootstrap 3.x
* jQuery 1.9+

## What's included?

- FlashComponent + elements (types: error, info, success, warning)
- FormHelper (align: default, inline, horizontal)
- HtmlHelper (components: breadcrumbs, badge, label, icon)
- PaginatorHelper
- Widgets (basic, radio, button, select, textarea)
- Sample layouts (cover, signin, dashboard)
- Bake templates *incomplete*

## Installing Using [Composer][composer]

`cd` to the root of your app folder (where the `composer.json` file is) and run the following command:

```
composer require friendsofcake/bootstrap-ui
```

Then load the plugin by adding the following to your app's `config/boostrap.php`:

```php
\Cake\Core\Plugin::load('BootstrapUI');
```

or using CakePHP's console:

```
./bin/cake plugin load BootstrapUI
```

## Usage

You will need to modify your `src/View/AppView` class to either extend `BootstrapUI\View\UIView` or
use the trait `BootStrapUI\View\UIViewTrait`.

### AppView Setup

For a quick setup, just make your `AppView` class extend `BootstrapUI\View\UIView`. The base class will handle
the initializing and loading of the BootstrapUI `layout.ctp` for your app.

The `src\View\AppView.php` will look something like the following:

```php
namespace App\View;

use BootstrapUI\View\UIView;

class AppView extends UIView
{

    /**
     * Initialization hook method.
     */
    public function initialize()
    {
        //Don't forget to call the parent::initialize()
        parent::initialize();
    }
}
```

### AppView Setup Using UIViewTrait

If you're adding BootstrapUI to an existing application. It might be easier to use the trait,
as it gives you more control over the loading of the layout.

```php
namespace App\View;

use BootstrapUI\View\UIViewTrait;
use Cake\View\View;

class AppView extends View
{
    use UIViewTrait;

    /**
     * Initialization hook method.
     */
    public function initialize()
    {
        //render the initializeUI method from the UIViewTrait
        $this->initializeUI();
    }
}
```

## BootstrapUI Layout

BootstrapUI comes with its own `layout.ctp` file and examples taken from the Bootstrap framework.

When no layout for the view is defined the `BootstrapUI\View\UIViewTrait` will load its own `layout.ctp` file. You can
override this behavior in two ways.

- Assign a layout to the view with `$this->layout('layout')`.
- Disable auto loading of the layout in `BootstrapUI\View\UIViewTrait` with `$this->initializeUI(['layout' => false]);`.

### Loading the Bootstrap framework

If you wish to use your own layout template, just make sure to include:

```php
// in the <head>
echo $this->Html->css('path/to/bootstrap.css');
echo $this->Html->script(['path/to/jquery.js', 'path/to/bootstrap.js']);
```

When using the BootstrapUI layout (or a copy of it), extra layout types (directly taken from the
Bootstrap examples). You just need to copy them to your application's layouts directory:

```
cp -R vendor/friendsofcake/bootstrap-ui/src/Template/Layout/examples src/Template/Layout/TwitterBootstrap
```

You can then simply extend them in your views like so:

```
$this->extend('../Layout/TwitterBootstrap/dashboard');
```

Available types are:

- cover
- signin
- dashboard
- blog *coming soon*

**NOTE: Remember to set the stylesheets in the layouts you copy.**

## Installing Bootstrap via Bower

A quick way of getting the Bootstrap assets installed is using [bower]. Assuming you are in `ROOT`:

```
bower install bootstrap
mkdir -p webroot/css/bootstrap webroot/js/bootstrap webroot/js/jquery webroot/css/fonts
cp bower_components/bootstrap/dist/css/* webroot/css/bootstrap/.
cp bower_components/bootstrap/dist/js/* webroot/js/bootstrap/.
cp bower_components/jquery/dist/* webroot/js/jquery/.
cp bower_components/bootstrap/dist/fonts/* webroot/css/fonts/.
echo /bower_components >> .gitignore
git add .gitignore \
bower.json \
webroot/css/bootstrap \
webroot/js/bootstrap \
webroot/js/jquery
```

## Console Bake

For those of you who want even more automation, some bake templates have been included. Use them like so:

```
$ bin/cake bake.bake [subcommand] -t BootstrapUI
```

## Helper Usage

At the core of BootstrapUI is a collection of enhancements for CakePHP core helpers. These helpers replace the HTML
templates used to render elements for the views. This allows you to create forms and components that use the
Bootstrap styles.

The current list of enhanced helpers are:

- `BootstrapUI\View\Helper\FlashHelper`
- `BootstrapUI\View\Helper\FormHelper`
- `BootstrapUI\View\Helper\HtmlHelper`
- `BootstrapUI\View\Helper\PaginatorHelper`
- `BootstrapUI\View\Helper\BreadcrumbsHelper`

When the `BootstrapUI\View\UIViewTrait` is initialized it loads the above helpers with the same aliases as the
CakePHP core helpers. That means that when you use `$this->Form->create()` in your views. The helper being used
is from the BootstrapUI plugin.

### Basic Form

```php
echo $this->Form->create($article);
echo $this->Form->control('title');
echo $this->Form->control('published', ['type' => 'checkbox']);
```

will render this HTML:

```html
<form method="post" accept-charset="utf-8" role="form" action="/articles/add">
    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
    <div class="form-group">
        <label class="control-label" for="title">Title</label>
        <input type="text" name="title" required="required" id="title" class="form-control">
    </div>
    <div class="form-group">
        <input type="hidden" name="published" value="0">
        <label for="published">
            <input type="checkbox" name="published" value="1" id="published" class="form-control">
            Published
        </label>
    </div>
```

### Horizontal Form

```php
echo $this->Form->create($article, ['align' => [
    'sm' => [
        'left' => 6,
        'middle' => 6,
        'right' => 12
    ],
    'md' => [
        'left' => 4,
        'middle' => 4,
        'right' => 4
    ]
]]);
echo $this->Form->control('title');
echo $this->Form->control('published', ['type' => 'checkbox']);
```

will render this HTML:

```html
<form method="post" accept-charset="utf-8" role="form" class="form-horizontal" action="/articles/add">
    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
    <div class="form-group">
        <label class="control-label col-sm-6 col-md-4" for="title">Title</label>
        <div class="col-sm-6 col-md-4">
            <input type="text" name="title" required="required" id="title" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6 col-md-offset-4 col-md-4">
            <input type="hidden" name="published" value="0">
            <label for="published">
                <input type="checkbox" name="published" value="1" id="published" class="form-control">
                Published
            </label>
        </div>
    </div>
```

### Configuration

You can configure each of the helpers by passing in extra parameters through the AppView.php.

Here is an example of changing the `prev` and `next` labels for the PaginatorHelper.

```php
$this->loadHelper(
    'Paginator',
    [
        'className' => 'BootstrapUI.Paginator',
        'labels' => [
            'prev' => 'previous',
            'next' => 'next',
        ]
    ]
);
```

To style auth flash messages properly set the `flash` key in `AuthComponent` config as shown:

```
        $this->loadComponent('Auth', [
            'flash' => [
                'element' => 'error',
                'key' => 'auth'
            ],
            ...

```

**NOTE: Check tests for more examples.**

## Testing

You can run the tests for BootstrapUI by doing the following:

```
    $ composer install
    $ ./vendor/bin/phpunit
```

## Patches & Features

* Fork
* Mod, fix
* Test - this is important, so it's not unintentionally broken
* Commit - do not mess with license, todo, version, etc. (if you do change any, bump them into commits of
their own that I can ignore when I pull)
* Pull request - bonus point for topic branches

To ensure your PRs are considered for upstream, you MUST follow the CakePHP coding standards. A `pre-commit`
hook has been included to automatically run the code sniffs for you. From your project's root directory:

```
cp ./contrib/pre-commit .git/hooks/
chmod 755 .git/hooks/pre-commit
```

## Bugs & Feedback

http://github.com/friendsofcake/bootstrap-ui/issues

## License

Copyright (c) 2015, Jad Bitar and licensed under [The MIT License][mit].

[cakephp]:http://cakephp.org
[composer]:http://getcomposer.org
[composer:ignore]:http://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md
[mit]:http://www.opensource.org/licenses/mit-license.php
[twbs3]:http://getbootstrap.com
[bower]:http://bower.io
