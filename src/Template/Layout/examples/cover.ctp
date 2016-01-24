<?php
/* @var $this \Cake\View\View */
use Cake\Core\Configure;

$this->Html->css('BootstrapUI.cover', ['block' => true]);
$this->prepend('tb_body_attrs', ' class="' . implode(' ', [$this->request->controller, $this->request->action]) . '" ');
$this->start('tb_body_start');
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">

                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand"><?= Configure::read('App.title') ?></h3>
                        <?= $this->fetch('tb_topnav') ?>
                    </div>
                </div>

                <div class="inner cover">
<?php
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    if (isset($this->Flash))
        echo $this->Flash->render();
    $this->end();
}
$this->end();

$this->start('tb_body_end');
?>
            </div>
        </div>
    </div>
</body>
<?php
$this->end();

$this->start('tb_footer');
printf('<footer class="mastfoot"><div class="inner">&copy;%s %s</div></footer>', date('Y'), Configure::read('App.title'));
$this->end('tb_footer');

$this->append('content', '</div>');
echo $this->fetch('content');
