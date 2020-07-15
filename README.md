# Bootstrap UI

[![Build Status](https://img.shields.io/travis/FriendsOfCake/bootstrap-ui/master.svg?style=flat-square)](https://travis-ci.org/FriendsOfCake/bootstrap-ui)
[![Coverage Status](https://img.shields.io/coveralls/FriendsOfCake/bootstrap-ui/master.svg?style=flat-square)](https://coveralls.io/r/FriendsOfCake/bootstrap-ui?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/friendsofcake/bootstrap-ui.svg?style=flat-square)](https://packagist.org/packages/friendsofcake/bootstrap-ui)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://packagist.org/packages/friendsofcake/bootstrap-ui)

Transparently use [Bootstrap 4][bs4] with [CakePHP 3][cakephp].

## Requirements

* CakePHP 4.x
* Bootstrap 4.x
* npm 5.x
* jQuery 3.2+
* Popper.js 1.x
* Fontawesome 5.x

## What's included?

- FlashComponent + elements (types: error, info, success, warning)
- FormHelper (align: default, inline, horizontal)
- HtmlHelper (components: breadcrumbs, badge, icon)
- PaginatorHelper
- Widgets (basic, radio, button, select, textarea)
- Sample layouts (cover, signin, dashboard)
- Bake templates

## Installing Using [Composer][composer]

`cd` to the root of your app folder (where the `composer.json` file is) and run the following command:

```
composer require friendsofcake/bootstrap-ui
```

Then load the plugin using CakePHP's console:
```
bin/cake plugin load BootstrapUI
```

## Usage

You can either use the Bootstrap command to make the necessary changes or do them manually.

### Installing Using the Bootstrap Command

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

    This will rewrite your `src/View/AppView` like described in [AppView Setup](#appview-setup).

3. Bootstrap UI has it's own layouts. You can install them using the `copy_layouts` command or do the changes like mentioned in [BootstrapUI Layout](#bootstrapui-layout) section:

    ```
    bin/cake bootstrap copy_layouts
    ```
    This will copy three sample layouts: `cover.php`, `dashboard.php` and `signin.php` to your app's `src/templates/layout/TwitterBootstrap`.

### Installing manually


#### AppView Setup

For a quick setup, just make your `AppView` class extend `BootstrapUI\View\UIView`. The base class will handle
the initializing and loading of the BootstrapUI `default.php` layout for your app.

The `src\View\AppView.php` will look something like the following:

```php
declare(strict_types=1);

namespace App\View;

use BootstrapUI\View\UIView;

class AppView extends UIView
{
    /**
     * Initialization hook method.
     */
    public function initialize(): void
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
declare(strict_types=1);

namespace App\View;

use BootstrapUI\View\UIViewTrait;
use Cake\View\View;

class AppView extends View
{
    use UIViewTrait;

    /**
     * Initialization hook method.
     */
    public function initialize(): void
    {
        //render the initializeUI method from the UIViewTrait
        $this->initializeUI();
    }
}
```

## BootstrapUI Layout

BootstrapUI comes with its own `default.php` layout file and examples taken from the Bootstrap framework.

When no layout for the view is defined the `BootstrapUI\View\UIViewTrait` will load its own `default.php` layout file. You can
override this behavior in two ways.

- Assign a layout to the template with `$this->setLayout('layout')`.
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
cp -R vendor/friendsofcake/bootstrap-ui/templates/layout/examples templates/layout/TwitterBootstrap
```

You can then simply extend them in your views like so:

```
$this->extend('../layout/TwitterBootstrap/dashboard');
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
bin/cake bake [subcommand] -t BootstrapUI
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
echo $this->Form->button('Submit');
echo $this->Form->end();
```

will render this HTML:

```html
<form method="post" accept-charset="utf-8" role="form" action="/articles/add">
  <div style="display:none;">
    <input type="hidden" name="_method" value="POST">
  </div>
  <div class="form-group text">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control">
  </div>
  <div class="form-group form-check checkbox">
    <input type="hidden" name="published" value="0">
    <input type="checkbox" class="form-check-input" name="published" value="1" id="published">
    <label class="form-check-label" for="published">Published</label>
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
echo $this->Form->end();
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

### Inline Form

```php
echo $this->Form->create($article, [
    'align' => 'inline',
]);
echo $this->Form->control('title', ['placeholder' => 'Title']);
echo $this->Form->control('published', ['type' => 'checkbox']);
echo $this->Form->end();
```

will render this HTML:

```html
<form method="post" accept-charset="utf-8" class="form-inline" role="form" action="/articles/add">
    <div class="form-group text">
        <label class="sr-only" for="title">Title</label>
        <input type="text" name="title" placeholder="Title" id="title" class="form-control"/>
    </div>
    <div class="form-check form-check-inline checkbox">
        <input type="hidden" name="published" value="0"/>
        <input type="checkbox" name="published" value="1" id="published" class="form-check-input">
        <label class="form-check-label" for="published">Published</label>
    </div>
    ...
</form>
```

### Supported controls

BootstrapUI supports and generates Bootstrap compatible markup for all of CakePHP's default controls. Additionally it
explicitly supports Bootstrap specific markup for the following controls:

- `range`

### Custom style controls

BootstrapUI supports Bootstrap's
[custom form control styles](https://getbootstrap.com/docs/4.5/components/forms/#custom-forms) for `checkbox`, `radio`,
`select`, `file`, and `range` controls. To enable custom styles, set the `custom` option to `true`.

```php
echo $this->Form->control('image', [
    'type' => 'file',
    'custom' => true,
]);
```

This would generate the following HTML:

```html
<div class="form-group file">
    <div class="custom-file">
        <input type="file" name="image" id="image" class="custom-file-input"/>
        <label class="custom-file-label" for="image">Image</label>
    </div>
</div>
```

### Appending/Prepending content

Appending/Prepending content to input groups is supported via the `append` and `prepend` options respectively.

```php
echo $this->Form->control('email', [
    'prepend' => '@',
]);
```

This would generate the following HTML:

```html
<div class="form-group email">
    <label for="email">Email</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">@</span>
        </div>
        <input type="email" name="email" id="email" class="form-control"/>
    </div>
</div>
```

### Inline checkboxes and radio buttons

[Inline checkboxes and radio buttons](https://getbootstrap.com/docs/4.5/components/forms/#inline) (not to be confused
with inline aligned forms), can be created by setting the `inline` option to `true`.

Inlined checkboxes and radio buttons will be rendered on the same horizontal row, regardless of the configured form
alignment.

```php
echo $this->Form->control('option_1', [
    'type' => 'checkbox',
    'inline' => true,
]);
echo $this->Form->control('option_2', [
    'type' => 'checkbox',
    'inline' => true,
]);
```

This would generate the following HTML:

```html
<div class="form-check form-check-inline checkbox">
    <input type="hidden" name="option-1" value="0"/>
    <input type="checkbox" name="option-1" value="1" id="option-1" class="form-check-input">
    <label class="form-check-label" for="option-1">Option 1</label>
</div>
<div class="form-check form-check-inline checkbox">
    <input type="hidden" name="option-2" value="0"/>
    <input type="checkbox" name="option-2" value="2" id="option-2" class="form-check-input">
    <label class="form-check-label" for="option-2">Option 2</label>
</div>
```

### Help text

Bootstrap's [form help text](https://getbootstrap.com/docs/4.5/components/forms/#help-text) is supported via the
`help` option.

The help text is by default being rendered in between of the control and the validation feedback.

```php
echo $this->Form->control('title', [
    'help' => 'Help text',
]);
```

This would generate the following HTML:

```html
<div class="form-group text">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control"/>
    <small class="form-text text-muted">Help text</small>
</div>
```

### Tooltips

[Bootstrap tooltips](https://getbootstrap.com/docs/4.5/components/tooltips/) can be added to labels via the `tooltip`
option. The tooltip toggles are by default being rendered as a [Font Awesome](https://fontawesome.com/) icon, so
additionally to including everything required by Bootstrap to support tooltips, you need to make sure to include Font
Awesome too.

```php
echo $this->Form->control('title', [
    'tooltip' => 'Tooltip text',
]);
```

This would generate the following HTML:

```html
<div class="form-group text">
    <label for="title">Title <span data-toggle="tooltip" title="Tooltip text" class="fas fa-info-circle"></span></label>
    <input type="text" name="title" id="title" class="form-control"/>
</div>
```

If you want to use a different toggle, being it a different Font Awesome icon, or maybe a completely different icon
font/library, then you can do this by
[overriding the `tooltip` template](https://book.cakephp.org/4/en/views/helpers/form.html#customizing-the-templates-formhelper-uses)
accordingly, being it globally, per form, or per control:

```php
echo $this->Form->control('title', [
    'tooltip' => 'Tooltip text',
    'templates' => [
        'tooltip' => '<span data-toggle="tooltip" title="{{content}}" class="material-icons">info</span>',
    ],
]);
```

### Error feedback style

BootstrapUI supports two styles of error feedback, the
[regular Bootstrap text feedback](https://getbootstrap.com/docs/4.5/components/forms/#validation), and
[Bootstrap tooltip feedback](https://getbootstrap.com/docs/4.5/components/forms/#tooltips) (not to be confused with
label tooltips that are configured via the `tooltip` option!).

The style can be configured via the `feedbackStyle` option, either globally, per form, or per control. The supported
styles are:

- `\BootstrapUI\View\Helper\FormHelper::FEEDBACK_STYLE_DEFAULT` Render error feedback as regular Bootstrap text
 feedback.
- `\BootstrapUI\View\Helper\FormHelper::FEEDBACK_STYLE_TOOLTIP` Render error feedback as Bootstrap tooltip feedback
 (inline forms are using this style by default).

Note that using the tooltip error style requires the form group elements to be non-static positioned! The form helper
will automatically add Bootstraps [position utility class](https://getbootstrap.com/docs/4.5/utilities/position/)
`position-relative` to the form group elements when the tooltip error style is enabled.

If you need different positioning, use either CSS to override the `position` rule on the `.form-group` elements, or use
the `formGroupPosition` option to set your desired position, either globally, per form, or per control. The option
supports the following values:

- `\BootstrapUI\View\Helper\FormHelper::POSITION_ABSOLUTE`
- `\BootstrapUI\View\Helper\FormHelper::POSITION_FIXED`
- `\BootstrapUI\View\Helper\FormHelper::POSITION_RELATIVE`
- `\BootstrapUI\View\Helper\FormHelper::POSITION_STATIC`
- `\BootstrapUI\View\Helper\FormHelper::POSITION_STICKY`

```php
$this->Form->setConfig([
    'feedbackStyle' => \BootstrapUI\View\Helper\FormHelper::FEEDBACK_STYLE_TOOLTIP,
    'formGroupPosition' => \BootstrapUI\View\Helper\FormHelper::POSITION_ABSOLUTE,
]);

// ...

echo $this->Form->control('title');
```

With an error on the `title` field, this would generate the following HTML:

```html
<div class="form-group position-absolute text is-invalid">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="is-invalid form-control"/>
    <div class="invalid-tooltip">Error message</div>
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
[bs4]:http://getbootstrap.com
[npm]:https://www.npmjs.com/
