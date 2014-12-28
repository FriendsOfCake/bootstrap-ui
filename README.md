# TwitterBootstrap

[![Build Status](https://travis-ci.org/gourmet/twitter_bootstrap.svg?branch=master)](https://travis-ci.org/gourmet/twitter_bootstrap)

Transparently use [Twitter Bootstrap 3][twbs3] with [CakePHP 3][cake3].

## What's included?

- FlashComponent + view elements
- FormHelper (create, button, input[type=text|radio|checkbox]) *more to come*
- Sample layouts (cover, signin, dashboard)
- Bake templates *incomplete*
- HtmlHelper *coming soon*

## What's NOT included

- Twitter Bootstrap

## Installation

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

[twbs3]:http://getbootstrap.com
[cake3]:http://cakephp.org

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

**NOTE: Check tests for more examples.**

## License

Copyright (c) 2014, Jad Bitar and licensed under [The MIT License][mit].

[mit]:http://www.opensource.org/licenses/mit-license.php
