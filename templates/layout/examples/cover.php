<?php
/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

$this->start('html');
printf('<html lang="%s" class="h-100">', Configure::read('App.language'));
$this->end();

$this->Html->css('BootstrapUI.cover', ['block' => true]);

$this->prepend(
    'tb_body_attrs',
    'class="d-flex h-100 text-center text-white bg-dark ' .
        implode(' ', [h($this->request->getParam('controller')), h($this->request->getParam('action'))]) .
        '" '
);

$this->start('tb_body_start'); ?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0"><?= Configure::read('App.title') ?></h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <?= $this->fetch('tb_topnav') ?>
                </nav>
            </div>
        </header>
        <main role="main" class="px-3">
            <?= $this->fetch('content') ?>
        </main>
<?php $this->end(); ?>

<?php $this->start('tb_body_end'); ?>
    </div>
</body>
<?php $this->end(); ?>

<?php
$this->start('tb_footer');
printf(
    '<footer class="mt-auto text-white-50"><div class="inner"><p>&copy;%s %s</p></div></footer>',
    date('Y'),
    Configure::read('App.title')
);
$this->end();
