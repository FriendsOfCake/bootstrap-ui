<?php
/**
 * @var \TestApp\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $article
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/signin'); ?>

<?= $this->Form->create($article, ['class' => 'form-signin']) ?>
<?= $this->Html->image('BootstrapUI.baked-with-cakephp.svg', ['class' => 'mb-4', 'width' => '250']) ?>
<h1 class="h3 mb-3 font-weight-normal"><?= __('Please sign in') ?></h1>
<?= $this->Flash->render(); ?>
<?= $this->Form->control('email', ['label' => ['floating' => true], 'autofocus']) ?>
<?= $this->Form->control('password', ['type' => 'password', 'label' => ['floating' => true]]) ?>
<?= $this->Form->control('remember-me', ['type' => 'checkbox', 'inline' => true]) ?>
<?= $this->Form->submit(__('Sign in'), ['class' => 'w-100 btn btn-lg btn-primary']) ?>
<p class="mt-5 mb-3 text-muted">© <?= date('Y') ?></p>
<?= $this->Form->end() ?>
