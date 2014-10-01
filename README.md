# TwitterBootstrap

## What's included?

- FlashComponent
- FormHelper
- Bake templates
- Sample layouts

## Installation

For a complete setup, add the following to your `App\Controller\AppController`:

```
public $components = ['Gourmet/TwitterBootstrap.Flash'];
public $helpers = ['Gourmet/TwitterBootstrap.Form'];
public $layout = 'Gourmet\TwitterBootstrap.default';
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
- blog
- signin
- dashboard
