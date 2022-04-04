<?php
/**
 * @var \Cake\View\View $this
 */
$this->Html->css('BootstrapUI.signin', ['block' => true]);
$this->prepend(
    'tb_body_attrs',
    ' class="text-center ' .
    implode(' ', [h($this->request->getParam('controller')), h($this->request->getParam('action'))]) .
    '" '
);
$this->start('tb_body_start');
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    echo $this->Flash->render();
    $this->end();
}
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
<?php
$this->end();

$this->start('tb_body_end');
echo '</body>';
$this->end();

$this->start('tb_footer');
echo ' ';
$this->end();

echo $this->fetch('content');
