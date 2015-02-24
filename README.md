# Bootstrap UI

[![Build Status](https://travis-ci.org/FriendsOfCake/bootstrap-ui.svg?branch=master)](https://travis-ci.org/FriendsOfCake/bootstrap-ui)
[![Total Downloads](https://poser.pugx.org/friendsofcake/bootstrap-ui/downloads.svg)](https://packagist.org/packages/friendsofcake/bootstrap-ui)
[![License](https://poser.pugx.org/friendsofcake/bootstrap-ui/license.svg)](https://packagist.org/packages/friendsofcake/bootstrap-ui)

Transparently use [Twitter Bootstrap 3][twbs3] with [CakePHP 3][cakephp].

## Requirements

* CakePHP 3.x
* Twitter Bootstrap 3.x

## What's included?

- FlashComponent + elements (types: error, info, success, warning)
- FormHelper (types: vertical, inline, horizontal | inputs: text, textarea, select, checkbox, radio)
- Widgets (button, textarea)
- Sample layouts (cover, signin, dashboard)
- Bake templates *incomplete*
- HtmlHelper *coming soon*

## Install

Using [Composer][composer]:

```
composer require friendsofcake/bootstrap-ui:dev-master
```

You then need to load the plugin. In `boostrap.php`, something like:

```php
\Cake\Core\Plugin::load('BootstrapUI');
```

For a complete setup, add the following to your `App\View\AppView`:

```php
public $layout = 'BootstrapUI.default';

public function initialize(array $config)
{
    $this->loadHelper('Form', ['className' => BootstrapUI.Form']);
    $this->loadHelper('Flash', ['className' => BootstrapUI.Flash']);
}
```

If you wish to use your own layout template, just make sure to include:

```php
// in the <head>
echo $this->Html->css('path/to/bootstrap.css');
echo $this->Html->script(['path/to/jquery.js', 'path/to/bootstrap.js']);
```

When using the included layout (or a copy of), extra layout types (directly taken from the
Bootstrap examples). You just need to copy them to your application's layouts directory:

```
cp -R plugins/BootstrapUI/src/Template/Layout/examples src/Template/Layout/TwitterBootstrap
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

Finally, for those of you who want even more automation, some bake templates have been included. Use them
like so:

```
$ bin/cake bake.bake [subcommand] -t BootstrapUI
```

## Usage

### Basic Form

```php
echo $this->Form->create($article);
echo $this->Form->input('title');
echo $this->Form->input('published');
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
echo $this->Form->create($article, ['horizontal' => true]);
echo $this->Form->input('title');
echo $this->Form->input('published');
```

will render this HTML:

```html
<form method="post" accept-charset="utf-8" role="form" class="form-horizontal" action="/articles/add">
    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
    <div class="form-group">
        <label class="control-label col-md-2" for="title">Title</label>
        <div class="col-md-10">
            <input type="text" name="title" required="required" id="title" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="hidden" name="published" value="0">
            <label for="published">
                <input type="checkbox" name="published" value="1" id="published" class="form-control">
                Published
            </label>
        </div>
    </div>
```

**NOTE: Check tests for more examples.**

## Patches & Features

* Fork
* Mod, fix
* Test - this is important, so it's not unintentionally broken
* Commit - do not mess with license, todo, version, etc. (if you do change any, bump them into commits of
their own that I can ignore when I pull)
* Pull request - bonus point for topic branches

## Bugs & Feedback

http://github.com/friendsofcake/bootstrap-ui/issues

## License

Copyright (c) 2014, Jad Bitar and licensed under [The MIT License][mit].

[cakephp]:http://cakephp.org
[composer]:http://getcomposer.org
[composer:ignore]:http://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md
[mit]:http://www.opensource.org/licenses/mit-license.php
[twbs3]:http://getbootstrap.com
