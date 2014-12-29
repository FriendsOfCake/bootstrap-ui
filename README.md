# TwitterBootstrap

[![Build Status](https://travis-ci.org/gourmet/twitter_bootstrap.svg?branch=master)](https://travis-ci.org/gourmet/twitter_bootstrap)

Transparently use [Twitter Bootstrap 3][twbs3] with [CakePHP 3][cake3].

## Requirements

* CakePHP 3.x
* Twitter Bootstrap 3.x

## What's included?

- FlashComponent + view elements
- FormHelper (create, button, input[type=text|radio|checkbox]) *more to come*
- Sample layouts (cover, signin, dashboard)
- Bake templates *incomplete*
- HtmlHelper *coming soon*

## Install

Using [Composer][composer]:

```
composer require gourmet/faker
```

Because this plugin has the type `cakephp-plugin` set in its own `composer.json`,
[Composer][composer] will install it inside your /plugins directory, rather than
in your `vendor-dir`. It is recommended that you add /plugins/gourmet/faker to your
`.gitignore` file and here's [why][composer:ignore].

You then need to load the plugin. In `boostrap.php`, something like:

```php
\Cake\Core\Plugin::load('Gourmet/Faker');
```

For a complete setup, add the following to your `App\Controller\AppController`:

```php
public $components = ['Gourmet/TwitterBootstrap.Flash'];
public $helpers = ['Gourmet/TwitterBootstrap.Form'];
```

You will also need to include the bootstrap stylesheet (or your custom one) to your layout for things to work (duh!):

```php
// in the <head>
$this->Html->css('path/to/stylesheet');
```

To use the included layout types (directly taken from the Bootstrap examples) you will need
to copy them to your application's layouts directory:

```
cp plugins/Gourmet/TwitterBootstrap/src/Template/Layout/examples src/Template/Layout/TwitterBootstrap
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

## Examples

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
        <label for="title">Title</label>
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
        <label class="col-md-2" for="title">Title</label>
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

## License

Copyright (c) 2014, Jad Bitar and licensed under [The MIT License][mit].

[cake3]:http://cakephp.org
[composer]:http://getcomposer.org
[composer:ignore]:http://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md
[mit]:http://www.opensource.org/licenses/mit-license.php
[twbs3]:http://getbootstrap.com
