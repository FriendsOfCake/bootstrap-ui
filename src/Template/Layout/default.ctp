<?php

use Cake\Core\Configure;

/**
 * Default `html` block.
 */
if (!$this->fetch('html')) {
    $this->start('html');
    printf('<html lang="%s" class="no-js">', Configure::read('App.language'));
    $this->end();
}

/**
 * Default `title` block.
 */
if (!$this->fetch('title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}

/**
 * Default `footer` block.
 */
if (!$this->fetch('tb_footer')) {
    $this->start('tb_footer');
    printf('&copy;%s %s', date('Y'), Configure::read('App.title'));
    $this->end();
}

/**
 * Default `body` block.
 */
$this->prepend('tb_body_attrs', ' class="' . implode(' ', array($this->request->controller, $this->request->action)) . '" ');
if (!$this->fetch('tb_body_start')) {
    $this->start('tb_body_start');
    echo '<body' . $this->fetch('tb_body_attrs') . '>';
    $this->end();
}
if (!$this->fetch('tb_body_end')) {
    $this->start('tb_body_end');
    echo '</body>';
    $this->end();
}

/**
 * Prepend `meta` block with `author` and `favicon`.
 */
$this->prepend('meta', $this->Html->meta('author', null, array('name' => 'author', 'content' => Configure::read('App.author'))));
$this->prepend('meta', $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon')));

/**
 * Prepend `css` and `script` blocks with local or cdn TwitterBootstrap assets
 */
if ($this->helpers()->has('Cdn')) {
     $this->prepend('css', $this->Cdn->getCss());
     $this->prepend('script', $this->Cdn->getScript());
} else {
    $this->prepend('css', $this->Html->css(['bootstrap/bootstrap']));
    $this->prepend('script', $this->Html->script(['jquery/jquery', 'bootstrap/bootstrap']));
}
/**
 * Append the `$html5Shim` to the `css` block
 */
$html5Shim =
<<<HTML
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
HTML;
$this->append('css', $html5Shim);

?>
<!DOCTYPE html>

<?= $this->fetch('html') ?>

    <head>

        <?= $this->Html->charset() ?>

        <title><?= $this->fetch('title') ?></title>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>

    </head>

    <?php
    echo $this->fetch('tb_body_start');
    echo $this->fetch('content');
    echo $this->fetch('tb_footer');
    echo $this->fetch('script');
    echo $this->fetch('tb_body_end');
    ?>

</html>
