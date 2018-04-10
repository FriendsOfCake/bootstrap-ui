# Bootstrap UI

[![Build Status](https://img.shields.io/travis/FriendsOfCake/bootstrap-ui/master.svg?style=flat-square)](https://travis-ci.org/FriendsOfCake/bootstrap-ui)
[![Coverage Status](https://img.shields.io/coveralls/FriendsOfCake/bootstrap-ui/master.svg?style=flat-square)](https://coveralls.io/r/FriendsOfCake/bootstrap-ui?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofcake/bootstrap-ui.svg?style=flat-square)](https://packagist.org/packages/friendsofcake/bootstrap-ui)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://packagist.org/packages/friendsofcake/bootstrap-ui)

Transparently use [Bootstrap 4][twbs4] with [CakePHP 3][cakephp].

## Requirements

* CakePHP 3.x
* Bootstrap 4.x
* npm 5.x
* jQuery 3.2+
* Popper.js 1.x
* Fontawesome 5.x

## What's included?

- FlashComponent + elements (types: error, info, success, warning)
- FormHelper (align: default, *inline (incomplete)*, horizontal)
- HtmlHelper (components: breadcrumbs, badge, icon)
- PaginatorHelper
- Widgets (basic, radio, button, select, textarea)
- Sample layouts (cover, signin, dashboard)
- Bake templates *incomplete*

## Installing Using [Composer][composer]

`cd` to the root of your app folder (where the `composer.json` file is) and run the following command:

```
composer require friendsofcake/bootstrap-ui
```

Then load the plugin by adding the following to your app's config/boostrap.php:
```
\Cake\Core\Plugin::load('BootstrapUI');
```

or using CakePHP's console:
```
bin/cake plugin load BootstrapUI
```

## Usage

You can either use the Bootstrap Shell to make the necessary changes or do them manually.

### Installing Using the Bootstrap Shell

1. To install install the bootstrap assets (bootstrap's css/js files, jquery and popper.js) via npm you can use the `install` command:

    ```
    bin/cake bootstrap install
    ```
    This will fetch all assets, copy the assets to plugin's webroot dir and symlink them to the app's webroot dir. Note that
    in debug mode the Shell will copy all assets (including source maps) and in production mode only minified versions.
2. You will need to modify your `src/View/AppView` class to either extend `BootstrapUI\View\UIView` or
   use the trait `BootStrapUI\View\UIViewTrait`. For doing this you can either use the `modify_view` command or [change your view manually][bootstrap-ui#appview-setup]:

    ```
    bin/cake bootstrap modify_view
    ```

    This will rewrite your `src/View/AppView` like described in [### AppView Setup].
3. Bootstrap has it's own layout. You can install them using the `copy_layouts` command or do the changes like mentioned in [## BootstrapUI Layout] section:

    ```
    bin/cake bootstrap copy_layouts
    ```
    This will copy three sample layouts: `cover.ctp`, `dashboard.ctp` and `signin.ctp` to your app's `src/Template/Layout/TwitterBootstrap`.

### Installing manually


#### AppView Setup

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

#### AppView Setup Using UIViewTrait

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

## Installing Bootstrap assets via npm

The install script installs the bootstrap assets via [npm]. You can install them also by hand assuming you are in `ROOT`:

```
npm install
cp node_modules/bootstrap/dist/css/bootstrap.css webroot/css/
cp node_modules/bootstrap/dist/js/bootstrap.js webroot/js/
cp node_modules/jquery/dist/jquery.js webroot/js
cp node_modules/popper.js/dist/popper.js webroot/js
```

## Console Bake

For those of you who want even more automation, some bake templates have been included. Use them like so:

```
bin/cake bake.bake [subcommand] -t BootstrapUI
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
  <div style="display:none;">
    <input type="hidden" name="_method" value="POST">
  </div>
  <div class="form-group text">
    <label class="col-form-label" for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control">
  </div>
  <div class="form-check">
    <input type="hidden" name="published" value="0">
    <label for="published">
      <input type="checkbox" name="published" value="1" id="published">Published
    </label>
  </div>
  <button type="submit" class="btn btn-secondary">Submit</button>
</form>
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
<form method="post" accept-charset="utf-8" class="form-horizontal" role="form" action="/articles/add">
  <div style="display:none;">
    <input type="hidden" name="_method" value="POST">
  </div>
  <div class="form-group text">
    <label class="col-form-label col-sm-6 col-md-4" for="title">Title</label>
    <div class="col-sm-6 col-md-4">
      <input type="text" name="title" id="title" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-6 col-md-offset-4 col-sm-6 col-md-4">
      <div class="checkbox">
        <input type="hidden" name="published" value="0">
        <label for="published">
          <input type="checkbox" name="published" value="1" id="published">Published
        </label>
      </div>
    </div>
  </div>
</form>
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

```php
$this->loadComponent('Auth', [
    'flash' => [
        'element' => 'error',
        'key' => 'auth'
    ],
    ...
```

### Flash Messages / Alerts

You can set Flash Messages using the default Flash syntax. Supported types are `success`, `info`, `warning`, `error`.
```php
$this->Flash->success('Your Success Message.');
```
If you need to set other Bootstrap Alert styles you can do this with:
```php
$this->Flash->set('Your Dark Message.', ['params' => ['class' => 'dark']]);
```
Supported styles are `primary`, `secondary`, `light`, `dark`.

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
[twbs4]:http://getbootstrap.com
[npm]:https://www.npmjs.com/
