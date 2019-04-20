<?php
/* @var $this \Cake\View\View */
use Cake\Core\Configure;

$this->Html->css('BootstrapUI.cover', ['block' => true]);
$this->prepend('tb_body_attrs', 'class="text-center ' . implode(' ', [$this->request->getParam('controller'), $this->request->getParam('action')]) . '" ');


$this->start('tb_body_start'); ?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand"><?= Configure::read('App.title') ?></h3>
                <nav class="nav nav-masthead justify-content-center">
                    <?= $this->fetch('tb_topnav') ?>
                </nav>
            </div>
        </header>
        <main role="main" class="inner cover">
            <?= $this->fetch('content') ?>
        </main>
<?php $this->end(); ?>

<?php $this->start('tb_body_end'); ?>
    </div>
</body>
<?php $this->end(); ?>

<?php $this->start('tb_footer');
printf('<footer class="mastfoot mt-auto"><div class="inner"><p>&copy;%s %s</p></div></footer>', date('Y'), Configure::read('App.title'));
$this->end('tb_footer');
