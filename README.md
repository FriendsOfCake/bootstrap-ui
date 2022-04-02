# Bootstrap UI

[![Build Status][ico-ga]][ga]
[![Coverage Status][ico-coverage]][coverage]
[![Total Downloads][ico-downloads]][package]
[![License][ico-license]][license]

[ico-ga]: https://img.shields.io/github/workflow/status/FriendsOfCake/bootstrap-ui/CI/master?style=flat-square
[ico-coverage]: https://img.shields.io/codecov/c/github/FriendsOfCake/bootstrap-ui.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/friendsofcake/bootstrap-ui.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square

[ga]: https://github.com/FriendsOfCake/bootstrap-ui/actions?query=workflow%3ACI+branch%3Amaster
[coverage]: https://codecov.io/github/FriendsOfCake/bootstrap-ui
[package]: https://packagist.org/packages/friendsofcake/bootstrap-ui
[license]: LICENSE.txt

Transparently use [Bootstrap 5][bs] with [CakePHP 4][cakephp].

For version info see [version map](https://github.com/FriendsOfCake/bootstrap-ui/wiki#version-map).

## Requirements

* CakePHP 4.x
* Bootstrap 5.x
* npm 6.x
* Popper.js 2.x
* Bootstrap Icons 1.5.x

## What's included?

- FlashHelper (element types: `error`, `info`, `success`, `warning`)
- FormHelper (align: `default`, `inline`, `horizontal`)
- BreadcrumbsHelper
- HtmlHelper (components: `badge`, `icon`)
- PaginatorHelper
- Widgets (`basic`, `button`, `datetime`, `file`, `select`, `textarea`)
- Example layouts (`cover`, `signin`, `dashboard`)
- Bake templates

## Table of contents

- [Installation](#installation)
- [Setup](#setup)
  - [Using the Bootstrap commands](#using-the-bootstrap-commands)
  - [Manual setup](#manual-setup)
  - [BootstrapUI layouts](#bootstrapui-layouts)
  - [Including the Bootstrap framework](#including-the-bootstrap-framework)
- [Bake templates](#bake-templates)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Installation

`cd` to the root of your app folder (where the `composer.json` file is) and run the following [Composer][composer]
command:

```
composer require friendsofcake/bootstrap-ui
```

Then load the plugin using CakePHP's console:

```
bin/cake plugin load BootstrapUI
```

## Setup

You can either use the Bootstrap commands to make the necessary changes, or do them manually.

### Using the Bootstrap commands

1. To install the Bootstrap assets (Bootstrap's CSS/JS files, Popper.js) via npm you can use the `install`
   command, or [install them manually](#installing-bootstrap-assets-via-npm):

   ```
   bin/cake bootstrap install
   ```

   This will fetch all assets, copy the distribution assets to the BootstrapUI plugin's webroot directory, and symlink
   (or copy) them to your application's `webroot` directory.

   If you want to install the latest minor versions of the assets instead of the exact pinned ones, you can use the
   `--latest` option:

   ```
   bin/cake bootstrap install --latest
   ```

2. You will need to modify your `src/View/AppView` class to either extend `BootstrapUI\View\UIView` or
   use the trait `BootStrapUI\View\UIViewTrait`. For doing this you can either use the `modify_view` command, or
   [change your view manually](#appview-setup-using-uiview):

   ```
   bin/cake bootstrap modify_view
   ```

   This will rewrite your `src/View/AppView` like described in [AppView setup using UIView](#appview-setup-using-uiview).

3. BootstrapUI ships with some example layouts. You can install them using the `copy_layouts` command, or
   [copy them manually](#copying-example-layouts):

   ```
   bin/cake bootstrap copy_layouts
   ```

   This will copy the three example layouts `cover.php`, `dashboard.php` and `signin.php` to your application's
   `src/templates/layout/TwitterBootstrap`.

### Manual setup

#### Installing Bootstrap assets via npm

The [the `install` command](#using-the-bootstrap-commands) installs the Bootstrap assets via [npm], which you can also
do manually if you wish to control which assets are being included, and where they are placed.

Assuming you are in your application's root:

```
npm install @popperjs/core@2 bootstrap@5 bootstrap-icons@1
mkdir -p webroot/css
mkdir -p webroot/font/fonts
mkdir -p webroot/js
cp node_modules/@popperjs/core/dist/umd/popper.js webroot/js
cp node_modules/@popperjs/core/dist/umd/popper.min.js webroot/js
cp node_modules/bootstrap/dist/css/bootstrap.css webroot/css/
cp node_modules/bootstrap/dist/css/bootstrap.min.css webroot/css/
cp node_modules/bootstrap/dist/js/bootstrap.js webroot/js/
cp node_modules/bootstrap/dist/js/bootstrap.min.js webroot/js/
cp node_modules/bootstrap-icons/font/bootstrap-icons.css webroot/font/
cp node_modules/bootstrap-icons/font/fonts/bootstrap-icons.woff webroot/font/fonts/
cp node_modules/bootstrap-icons/font/fonts/bootstrap-icons.woff2 webroot/font/fonts/
cp vendor/friendsofcake/bootstrap-ui/webroot/font/bootstrap-icon-sizes.css webroot/font/
```

#### AppView setup using UIView

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
        // Don't forget to call parent::initialize()
        parent::initialize();
    }
}
```

#### AppView setup using UIViewTrait

If you're adding BootstrapUI to an existing application, it might be easier to use the trait, as it gives you more
control over the loading of the layout.

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
        parent::initialize();

        // Call the initializeUI method from UIViewTrait
        $this->initializeUI();
    }
}
```

#### Copying example layouts

In order to be able to use the BootstrapUI example layouts (directly taken from the Bootstrap examples), they need to be
copied to your application's layouts directory, either by using
[the `copy_layouts` command](#using-the-bootstrap-commands), or by copying the files manually:

```
cp -R vendor/friendsofcake/bootstrap-ui/templates/layout/examples templates/layout/TwitterBootstrap
```

### BootstrapUI layouts

BootstrapUI comes with its own `default.php` layout file and examples taken from the Bootstrap framework.

When no layout for the view is defined, the `BootstrapUI\View\UIViewTrait` will load its own `default.php` layout file.
You can override this behavior in two ways.

- Assign a layout to the template with `$this->setLayout('layout')`.
- Disable auto loading of the layout in `BootstrapUI\View\UIViewTrait` by adding `$this->initializeUI(['layout' => false]);` to your `AppView`'s `initialize()` function.

#### Using the example layouts

Once copied into your application's layouts directory (being it via
[the `copy_layouts` command](#using-the-bootstrap-commands) or [manually](#copying-example-layouts)), you can simply
extend the example layouts in your views like so:

```
$this->extend('../layout/TwitterBootstrap/dashboard');
```

Available types are:

- `cover`
- `signin`
- `dashboard`

**NOTE: Remember to set the stylesheets in the layouts you copy.**

### Including the Bootstrap framework

If you are using [the BoostrapUI plugin's default layout](#bootstrapui-layouts), and you have installed the Bootstrap
assets using [the `install` command](#using-the-bootstrap-commands), the required assets should automatically be
included.

If you wish to use your own layout template, then you need to take care of including the required CSS/JS files yourself.

If you have installed the assets using [the `install` command](#using-the-bootstrap-commands), you can refer to
them using the standard plugin syntax:

```php
// in the <head>
echo $this->Html->css('BootstrapUI.bootstrap.min');
echo $this->Html->css(['BootstrapUI./font/bootstrap-icons', 'BootstrapUI./font/bootstrap-icon-sizes']);
echo $this->Html->script(['BootstrapUI.popper.min', 'BootstrapUI.bootstrap.min']);
```

If you have installed the assets manually, you'll need to use paths accordingly. With
[the example copy commands](#installing-bootstrap-assets-via-npm) you could use the standard short path syntax:

```php
echo $this->Html->css('bootstrap.min');
echo $this->Html->css(['/font/bootstrap-icons', '/font/bootstrap-icon-sizes']);
echo $this->Html->script(['popper.min', 'bootstrap.min']);
```

If you're using paths that don't adhere to the CakePHP conventions, you'll have to explicitly specify them:

```php
echo $this->Html->css('/path/to/bootstrap.css');
echo $this->Html->css(['/path/to/bootstrap-icons.css', '/path/to/bootstrap-icon-sizes.css']);
echo $this->Html->script(['/path/to/popper.js', '/path/to/bootstrap.js']);
```

## Bake templates

For those of you who want even more automation, some bake templates have been included. Use them like so:

```
bin/cake bake [subcommand] -t BootstrapUI
```

Currently, bake templates for the following bake subcommands are included:

### `template`

Additionally to the default `index`, `add`, `edit`, and `view` templates, a `login` template is available too. While
the default CRUD action view templates can be utilized like this:

```bash
bin/cake bake template ControllerName -t BootstrapUI
```

the `login` template has to be used explicitly by specifying the action name:

```bash
bin/cake bake template ControllerName login -t BootstrapUI
```

## Usage

At the core of BootstrapUI is a collection of enhancements for CakePHP core helpers. Among other things, these helpers
replace the HTML templates used to render elements for the views. This allows you to create forms and components that
use the Bootstrap styles.

The current list of enhanced helpers are:

- `BootstrapUI\View\Helper\FlashHelper`
- `BootstrapUI\View\Helper\FormHelper`
- `BootstrapUI\View\Helper\HtmlHelper`
- `BootstrapUI\View\Helper\PaginatorHelper`
- `BootstrapUI\View\Helper\BreadcrumbsHelper`

When the `BootstrapUI\View\UIViewTrait` is initialized it loads the above helpers with the same aliases as the
CakePHP core helpers. That means that when you use `$this->Form->create()` in your views, the helper being used
is from the BootstrapUI plugin.

### Basic forms

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
    <!-- ... -->
    <div class="mb-3 form-group text">
        <label class="form-label" for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="mb-3 form-group form-check checkbox">
        <input type="hidden" name="published" value="0">
        <input type="checkbox" class="form-check-input" name="published" value="1" id="published">
        <label class="form-check-label" for="published">Published</label>
    </div>
    <button type="submit" class="btn btn-secondary">Submit</button>
    <!-- ... -->
</form>
```

### Horizontal forms

Horizontal forms automatically render labels and controls in separate columns (where applicable), labels in th first
one, and controls in the second one.

Alignment can be configured via the `align` option, which takes either a list of column sizes for the `md`
[Bootstrap screen-size/breakpoint](https://getbootstrap.com/docs/5.0/layout/breakpoints/), or a matrix of
screen-size/breakpoint names and column sizes.

The following will use the default `md` screen-size/breakpoint:

```php
use BootstrapUI\View\Helper\FormHelper;

echo $this->Form->create($article, [
    'align' => [
        FormHelper::GRID_COLUMN_ONE => 4, // first column (span over 4 columns)
        FormHelper::GRID_COLUMN_TWO => 8, // second column (span over 8 columns)
    ],
]);
echo $this->Form->control('title');
echo $this->Form->control('published', ['type' => 'checkbox']);
echo $this->Form->end();
```

It will render this HTML:

```html
<form method="post" accept-charset="utf-8" class="form-horizontal" role="form" action="/articles/add">
    <!-- ... -->
    <div class="mb-3 form-group row text">
        <label class="col-form-label col-md-4" for="title">Title</label>
        <div class="col-md-8">
            <input type="text" name="title" id="title" class="form-control">
        </div>
    </div>
    <div class="mb-3 form-group row checkbox">
        <div class="offset-md-4 col-md-8">
            <div class="form-check">
                <input type="hidden" name="published" value="0"/>
                <input type="checkbox" name="published" value="1" id="published" class="form-check-input"/>
                <label class="form-check-label" for="published">Published</label>
            </div>
        </div>
    </div>
    <!-- ... -->
</form>
```

The following uses a matrix of screen-sizes/breakpoints and column sizes:

```php
use BootstrapUI\View\Helper\FormHelper;

echo $this->Form->create($article, [
    'align' => [
        // column sizes for the `sm` screen-size/breakpoint
        'sm' => [
            FormHelper::GRID_COLUMN_ONE => 6,
            FormHelper::GRID_COLUMN_TWO => 6,
        ],
        // column sizes for the `md` screen-size/breakpoint
        'md' => [
            FormHelper::GRID_COLUMN_ONE => 4,
            FormHelper::GRID_COLUMN_TWO => 8,
        ],
    ],
]);
echo $this->Form->control('title');
echo $this->Form->control('published', ['type' => 'checkbox']);
echo $this->Form->end();
```

It will render this HTML:

```html
<form method="post" accept-charset="utf-8" class="form-horizontal" role="form" action="/articles/add">
    <!-- ... -->
    <div class="mb-3 form-group row text">
        <label class="col-form-label col-sm-6 col-md-4" for="title">Title</label>
        <div class="col-sm-6 col-md-8">
            <input type="text" name="title" id="title" class="form-control">
        </div>
    </div>
    <div class="mb-3 form-group row checkbox">
        <div class="offset-sm-6 offset-md-4 col-sm-6 col-md-8">
            <div class="form-check">
                <input type="hidden" name="published" value="0"/>
                <input type="checkbox" name="published" value="1" id="published" class="form-check-input"/>
                <label class="form-check-label" for="published">Published</label>
            </div>
        </div>
    </div>
    <!-- ... -->
</form>
```

The default alignment will use the `md` screen-size/breakpoint and the following column sizes:

```php
[
    FormHelper::GRID_COLUMN_ONE => 2,
    FormHelper::GRID_COLUMN_TWO => 10,
]
```

### Inline forms

Inline forms will render controls on one and the same row, and hide labels for most controls.

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
    <!-- ... -->
    <div class="form-group text">
        <label class="form-label visually-hidden" for="title">Title</label>
        <input type="text" name="title" placeholder="Title" id="title" class="form-control"/>
    </div>
    <div class="form-check form-check-inline checkbox">
        <input type="hidden" name="published" value="0"/>
        <input type="checkbox" name="published" value="1" id="published" class="form-check-input">
        <label class="form-check-label" for="published">Published</label>
    </div>
    <!-- ... -->
</form>
```

### Spacing

Out of the box BootstrapUI applies some default spacing for form controls. For default and horizontal aligned forms,
the `mb-3` [spacing class](https://getbootstrap.com/docs/5.0/utilities/spacing/) is being applied to all controls,
while inline forms are using the `g-3` [gutter class](https://getbootstrap.com/docs/5.0/layout/gutters/).

This can be changed using the `spacing` option, it applies on a per-helper and per-form basis for all alignments, and
for default/horizontal alignments it also applies on a per-control basis.

```php
// for all forms
echo $this->Form->setConfig([
    'spacing' => 'mb-6',
]);
```

```php
// for a specific form
echo $this->Form->create($entity, [
    'spacing' => 'mb-6',
]);
```

```php
// for a specific control (default/horizontal aligned forms only)
echo $this->Form->control('title', [
    'spacing' => 'mb-6',
]);
```

To completely disable this behavior, set the `spacing` option to `false`.

### Supported controls

BootstrapUI supports and generates Bootstrap compatible markup for all of CakePHP's default controls. Additionally it
explicitly supports Bootstrap specific markup for the following controls:

- `color`
- `range`
- `switch`

### Container attributes

Attributes of the outer control container can be changed via the `container` option, cutting the need to use custom
templates for simple changes. The `class` attribute is a special case, its value will be prepended to the existing
list of classes instead of replacing it.

```php
echo $this->Form->control('title', [
    'container' => [
        'class' => 'my-title-control',
        'data-meta' => 'meta information',
    ],
]);
```

This would generate the following HTML:

```html
<div data-meta="meta information" class="my-title-control mb-3 form-group text">
    <label class="form-label" for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control">
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
<div class="mb-3 form-group email">
    <label class="form-label" for="email">Email</label>
    <div class="input-group">
        <span class="input-group-text">@</span>
        <input type="email" name="email" id="email" class="form-control"/>
    </div>
</div>
```

#### Multiple addons

Multiple addons can be defined as an array for the `append` and `prepend` options:

```php
echo $this->Form->control('amount', [
    'prepend' => ['$', '0.00'],
]);
```

This would generate the following HTML:

```html
<div class="mb-3 form-group text">
    <label class="form-label" for="amount">Amount</label>
    <div class="input-group">
        <span class="input-group-text">$</span>
        <span class="input-group-text">0.00</span>
        <input type="text" name="amount" id="amount" class="form-control"/>
    </div>
</div>
```

#### Addon options

Addons support options that apply to the input group container. They can be defined by passing an array for the `append`
and `prepend` options, and adding an array with options as the last entry.

Options can contain HTML attributes as know from control options, as well as the special `size` option, which
automatically translates to the corresponding input group size class.

```php
echo $this->Form->control('amount', [
    'prepend' => [
        '$',
        '0.00',
        [
            'size' => 'lg',
            'class' => 'custom',
            'custom' => 'attribute',
        ],
    ],
]);
```

This would generate the following HTML:

```html
<div class="mb-3 form-group text">
    <label class="form-label" for="amount">Amount</label>
    <div class="input-group input-group-lg custom" custom="attribute">
        <span class="input-group-text">$</span>
        <span class="input-group-text">0.00</span>
        <input type="text" name="amount" id="amount" class="form-control"/>
    </div>
</div>
```

### Inline checkboxes and radio buttons

[Inline checkboxes/switches and radio buttons](https://getbootstrap.com/docs/4.5/components/forms/#inline) (not to be
confused with inline aligned forms), can be created by setting the `inline` option to `true`.

Inlined checkboxes/switches and radio buttons will be rendered on the same horizontal row. When using horizontal form
alignment however, only multi-checkboxes will render on the same row!

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
<div class="mb-3 form-check form-check-inline checkbox">
    <input type="hidden" name="option-1" value="0"/>
    <input type="checkbox" name="option-1" value="1" id="option-1" class="form-check-input">
    <label class="form-check-label" for="option-1">Option 1</label>
</div>
<div class="mb-3 form-check form-check-inline checkbox">
    <input type="hidden" name="option-2" value="0"/>
    <input type="checkbox" name="option-2" value="2" id="option-2" class="form-check-input">
    <label class="form-check-label" for="option-2">Option 2</label>
</div>
```

### Switches

[Switch style checkboxes](https://getbootstrap.com/docs/5.0/forms/checks-radios/#switches) can be created by setting the
`switch` option to `true`.

```php
echo $this->Form->control('option', [
    'type' => 'checkbox',
    'switch' => true,
]);
```

This would generate the following HTML:

```html
<div class="mb-3 form-group form-check form-switch checkbox">
    <input type="hidden" name="option" value="0"/>
    <input type="checkbox" name="option" value="1" id="option" class="form-check-input">
    <label class="form-check-label" for="option">Option</label>
</div>
```

### Floating labels

[Floating labels](https://getbootstrap.com/docs/5.0/forms/floating-labels) are supported for `text`, `textarea`, and
(non-`multiple`) `select` controls. They can be enabled via the label's `floating` option:

```php
echo $this->Form->control('title', [
    'label' => [
        'floating' => true,
    ],
]);
```

This would generate the following HTML:

```html
<div class="mb-3 form-floating form-group text">
    <input type="text" name="title" id="title" class="form-control"/>
    <label for="title">Title</label>
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
<div class="mb-3 form-group text">
    <label class="form-label" for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" aria-describedby="title-help"/>
    <small id="title-help" class="d-block form-text text-muted">Help text</small>
</div>
```

Attributes can be configured by passing an array for the `help` option, where the text is then defined in the `content`
key:

```php
echo $this->Form->control('title', [
    'help' => [
        'id' => 'custom-help',
        'class' => 'custom',
        'data-custom' => 'attribute',
        'content' => 'Help text',
    ],
]);
```

This would generate the following HTML:

```html
<div class="mb-3 form-group text">
    <label class="form-label" for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" aria-describedby="custom-help"/>
    <small id="custom-help" class="custom d-block form-text text-muted" data-custom="attribute">Help text</small>
</div>
```

### Tooltips

[Bootstrap tooltips](https://getbootstrap.com/docs/5.0/components/tooltips/) can be added to labels via the `tooltip`
option. The tooltip toggles are by default being rendered as a [Bootstrap icon](https://icons.getbootstrap.com/), which
is being included by default when installing the assets via the `install` command.

```php
echo $this->Form->control('title', [
    'tooltip' => 'Tooltip text',
]);
```

This would generate the following HTML:

```html
<div class="mb-3 form-group text">
    <label class="form-label" for="title">
        Title <span data-bs-toggle="tooltip" title="Tooltip text" class="bi bi-info-circle-fill"></span>
    </label>
    <input type="text" name="title" id="title" class="form-control"/>
</div>
```

If you want to use a different toggle, being it a different Boostrap icon, or maybe a completely different icon
font/library, then you can do this by
[overriding the `tooltip` template](https://book.cakephp.org/4/en/views/helpers/form.html#customizing-the-templates-formhelper-uses)
accordingly, being it globally, per form, or per control:

```php
echo $this->Form->control('title', [
    'tooltip' => 'Tooltip text',
    'templates' => [
        'tooltip' => '<span data-bs-toggle="tooltip" title="{{content}}" class="material-icons">info</span>',
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
<div class="mb-3 form-group position-absolute text is-invalid">
    <label class="form-label" for="title">Title</label>
    <input type="text" name="title" id="title" class="is-invalid form-control"/>
    <div class="invalid-tooltip">Error message</div>
</div>
```

### Flash Messages / Alerts

You can set Flash Messages using the default Flash component syntax. Supported types are `success`, `info`, `warning`,
`error`.

```php
$this->Flash->success('Your Success Message.');
```

#### Alert styles

If you need to set other Bootstrap Alert styles you can do this with:

```php
$this->Flash->set('Your Dark Message.', ['params' => ['class' => 'dark']]);
```

Supported styles are `primary`, `secondary`, `light`, `dark`.

#### Icons

By default alerts use Bootstrap icons depending on the alert type. The mapped types are `default`, `info`, `warning`,
`error`, and `success`. You can disable/customize icons via the `icon` option/parameter, either globally for the flash
helper, or individually for a single message.

Message without icon:

```php
$this->Flash->success('Message without icon.', [
    'params' => [
        'icon' => false,
    ],
]);
```

Use a custom icon:

```php
$this->Flash->success('Message with custom icon.', [
    'params' => [
        'icon' => 'mic-mute-fill',
    ],
]);
```

Pass icon options (the icon name is optional here, when omitted, the default icon map will be looked up):

```php
$this->Flash->success('Message with custom icon options.', [
    'params' => [
        'icon' => [
            'name' => 'mic-mute-fill',
            'size' => '2xl',
            'class' => 'foo bar me-2',
            'data-custom' => 'attribute',
        ],
    ],
]);
```

```html
<i class="foo bar me-2 bi bi-mic-mute-fill bi-2xl" data-custom="attribute"></i>
```

Use custom HTML:

```php
$this->Flash->success('Message with custom icon HTML.', [
    'params' => [
        'icon' => '<span class="material-icons">volume_off</span>',
    ],
]);
```

Disable icons for all flash messages:

```php
$this->loadHelper('Flash', [
    'className' => 'BootstrapUI.Flash',
    'icon' => false,
]);
```

Set icon options for all flash messages (the default icon map will be used, and the options will be applied to all
icons):

```php
$this->loadHelper('Flash', [
    'className' => 'BootstrapUI.Flash',
    'icon' => [
        'size' => '2xl',
        'class' => 'foo bar me-2',
        'data-custom' => 'attribute',
    ],
]);
```

Define a custom icon map:

```php
$this->loadHelper('Flash', [
    'className' => 'BootstrapUI.Flash',
    'iconMap' => [
        'default' => 'info-circle-fill',
        'success' => 'check-circle-fill',
        'error' => 'exclamation-triangle-fill',
        'info' => 'info-circle-fill',
        'warning' => 'exclamation-triangle-fill',
    ],
]);
```

Use a different icon set:

```php
$this->Flash->success('Message with different icon set.', [
    'params' => [
        'icon' => [
            'namespace' => 'fas',
            'prefix' => 'fa',
            'name' => 'microphone-slash',
            'size' => '2xl',
        ],
    ],
]);
```

```html
<i class="me-2 fas fa-microphone-slash fa-2xl"></i>
```

Use a different icon set for all flash messages:

```php
$this->loadHelper('Html', [
    'className' => 'BootstrapUI.Html',
    'iconDefaults' => [
        'namespace' => 'fas',
        'prefix' => 'fa',
    ],
]);
```

```php
$this->loadHelper('Flash', [
    'className' => 'BootstrapUI.Flash',
    'iconMap' => [
        'default' => 'info-circle',
        'success' => 'check-circle',
        'error' => 'exclamation-triangle',
        'info' => 'info-circle',
        'warning' => 'exclamation-triangle',
    ],
]);
```

### Badges

By default badges will render as `secondary` theme styled:

```php
echo $this->Html->badge('Text');
```

```html
<span class="badge bg-secondary">Text</span>
```

#### Background colors

[Background colors](https://getbootstrap.com/docs/5.0/components/badge/#background-colors) can be changed by specifying
one of the Bootstrap theme color names via the `class` option, the helper will make sure that the correct prefixes
are being applied:

```php
echo $this->Html->badge('Text', [
    'class' => 'danger',
]);
```

```html
<span class="badge bg-danger">Text</span>
```

#### Using a different HTML tag

By default badges are using the `<span>` tag. This can be changed via the `tag` option:

```php
echo $this->Html->badge('Text', [
    'tag' => 'div',
]);
```

```html
<div class="badge bg-secondary">Text</div>
```

### Icons

By default the HTML helper is configured to use [Bootstrap icons](https://icons.getbootstrap.com/).

```php
echo $this->Html->icon('mic-mute-fill');
```

```html
<i class="bi bi-mic-mute-fill"></i>
```

#### Sizes

Sizes can be specified via the `size` option, the passed value will automatically be prefixed:

```php
echo $this->Html->icon('mic-mute-fill', [
    'size' => '2xl',
]);
```

```html
<i class="bi bi-mic-mute-fill bi-2xl"></i>
```

This plugin ships Bootstrap icon classes for the following sizes that center-align the icon vertically: `2xs`, `xs`,
`sm`, `lg`, `xl`, and `2xl`, and the following ones that align the icons on the baseline: `1x`, `2x`, `3x`, `4x`, `5x`,
`6x`, `7x`, `8x`, `9x`, and `10x`.

#### Using a different icon set

You can use a different icon set by configuring the `namespace` and `prefix `options, either per `icon()` call:

```php
echo $this->Html->icon('microphone-slash', [
    'namespace' => 'fas',
    'prefix' => 'fa',
]);
```

or globally for all usages of `HtmlHelper::icon()` by configuring the HTML helper defaults:

```php
$this->loadHelper('Html', [
    'className' => 'BootstrapUI.Html',
    'iconDefaults' => [
        'namespace' => 'fas',
        'prefix' => 'fa',
    ],
]);
```

### Breadcrumbs

The breadcrumbs helper is a drop-in replacement, no additional configuration is available/required.

```php
echo $this->Breadcrumbs
    ->add('Home', '/')
    ->add('Articles', '/articles')
    ->add('View')
    ->render();
```

```html
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active"><a href="/articles" aria-current="page">Articles</a></li>
        <li class="breadcrumb-item"><span>View</span></li>
    </ol>
</nav>
```

### Pagination

The paginator helper generates bootstrap compatible/styles markup when using the helper's standard methods, and also
includes a convenience method that can generate a full set of pagination controls, that is first/previous/next/last as
well as page number links, all enclosed in a list wrapper.

```php
echo $this->Paginator->first();
echo $this->Paginator->prev();
echo $this->Paginator->numbers();
echo $this->Paginator->next();
echo $this->Paginator->last();
```

This would generate the following HTML:

```html
<li class="page-item first">
    <a class="page-link" aria-label="First" href="/articles/index">
        <span aria-hidden="true">«</span>
    </a>
</li>
<li class="page-item">
    <a class="page-link" rel="prev" aria-label="Previous" href="/articles/index">
        <span aria-hidden="true">‹</span>
    </a>
</li>
<li class="page-item">
    <a class="page-link" href="/articles/index">1</a>
</li>
<li class="page-item active" aria-current="page">
    <a class="page-link" href="#">2</a>
</li>
<li class="page-item">
    <a class="page-link" href="/articles/index?page=3">3</a>
</li>
<li class="page-item">
    <a class="page-link" rel="next" aria-label="Next" href="/articles/index?page=3">
        <span aria-hidden="true">›</span>
    </a>
</li>
<li class="page-item last">
    <a class="page-link" aria-label="Last" href="/articles/index?page=3">
        <span aria-hidden="true">»</span>
    </a>
</li>
```

#### Configuring the ARIA labels

When using the standard methods you can use the `label` option to pass a custom string to use for
[the `aria-label` attribute](https://getbootstrap.com/docs/5.0/components/pagination/#working-with-icons):

```php
echo $this->Paginator->first('«', ['label' => __('Beginning')]);
echo $this->Paginator->prev('‹', ['label' => __('Back')]);
echo $this->Paginator->next('›', ['label' => __('Forward')]);
echo $this->Paginator->last('»', ['label' => __('End')]);
```

This would generate the following HTML:

```html
<li class="page-item first">
    <a class="page-link" aria-label="Beginning" href="/articles/index">
        <span aria-hidden="true">«</span>
    </a>
</li>
<li class="page-item">
    <a class="page-link" rel="prev" aria-label="Back" href="/articles/index">
        <span aria-hidden="true">‹</span>
    </a>
</li>
<li class="page-item">
    <a class="page-link" rel="next" aria-label="Forward" href="/articles/index?page=3">
        <span aria-hidden="true">›</span>
    </a>
</li>
<li class="page-item last">
    <a class="page-link" aria-label="End" href="/articles/index?page=3">
        <span aria-hidden="true">»</span>
    </a>
</li>
```

#### Generating a full set of controls

A full set of pagination controls, that is first/previous/next/last as well as page number links, all enclosed in a list
wrapper, can be generated using the `links()` method.

By default it renders numbers only:

```php
echo $this->Paginator->links();
```

This would generate the following HTML:

```html
<ul class="pagination">
    <li class="page-item">
        <a class="page-link" href="/articles/index">1</a>
    </li>
    <li class="page-item active" aria-current="page">
        <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
        <a class="page-link" href="/articles/index?page=3">3</a>
    </li>
</ul>
```

##### Configuring controls

The generated controls can be configured via the `first`, `prev`, `next`, and `last` options, which each can take either
boolean `true` to generate the control with the helper defaults, a string that is used as the control's text, or an
array that allows specifying the link text as well as the ARIA label.

The generated controls can be configured via the `first`, `prev`, `next`, and `last` options, which each take either
boolean `true` to indicate that the control should be generated using the helper defaults, a string that is used as the
control's text, or an array with `label` and `text` options that determine the ARIA label value and the link text:

```php
echo $this->Paginator->links([
    'first' => '❮❮',
    'prev' => true,
    'next' => true,
    'last' => [
        'label' => 'End',
        'text' => '❯❯',
    ],
]);
```

This would generate the following HTML:

```html
<ul class="pagination">
    <li class="page-item first">
        <a class="page-link" aria-label="First" href="/articles/index">
            <span aria-hidden="true">❮❮</span>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link" rel="prev" aria-label="Previous" href="/articles/index">
            <span aria-hidden="true">‹</span>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link" href="/articles/index">1</a>
    </li>
    <li class="page-item active" aria-current="page">
        <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
        <a class="page-link" href="/articles/index?page=3">3</a>
    </li>
    <li class="page-item">
        <a class="page-link" rel="next" aria-label="Next" href="/articles/index?page=3">
            <span aria-hidden="true">›</span>
        </a>
    </li>
    <li class="page-item last">
        <a class="page-link" aria-label="End" href="/articles/index?page=3">
            <span aria-hidden="true">❯❯</span>
        </a>
    </li>
</ul>
```

##### Sizing

[The size](https://getbootstrap.com/docs/5.0/components/pagination/#sizing) can be specified via the `size` option:

```php
echo $this->Paginator->links([
    'size' => 'lg',
]);
```

This would generate the following HTML:

```html
<ul class="pagination pagination-lg">
    <!-- ... -->
</ul>
```

### Helper configuration

You can configure each of the helpers by passing in extra parameters when loading them in your `AppView.php`.

Here is an example of changing the `prev` and `next` labels for the Paginator helper.

```php
$this->loadHelper('Paginator', [
    'className' => 'BootstrapUI.Paginator',
    'labels' => [
        'prev' => 'previous',
        'next' => 'next',
    ],
]);
```

## Contributing

### Patches & Features

* Fork
* Mod, fix
* Test - this is important, so it's not unintentionally broken
* Commit - do not mess with license, todo, version, etc. (if you do change any, put them into separate commits that can
  be ignored when pulling)
* Pull request - bonus point for topic branches

To ensure your PRs are considered for upstream, you MUST follow the CakePHP coding standards. A `pre-commit`
hook has been included to automatically run the code sniffs for you. From your project's root directory:

```
cp ./contrib/pre-commit .git/hooks/
chmod 755 .git/hooks/pre-commit
```

### Testing

When working on the plugin's code you can run the tests for BootstrapUI by doing the following:

```
composer install
./vendor/bin/phpunit
```

### Bugs & Feedback

https://github.com/friendsofcake/bootstrap-ui/issues

## License

Copyright (c) 2015, Jad Bitar and licensed under [The MIT License][mit].

[cakephp]:https://cakephp.org/
[composer]:https://getcomposer.org/
[composer:ignore]:https://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md
[mit]:https://opensource.org/licenses/mit-license.php
[bs]:https://getbootstrap.com/
[npm]:https://www.npmjs.com/
