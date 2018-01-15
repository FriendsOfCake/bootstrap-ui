<?php
$this->extend('../Layout/TwitterBootstrap/signin');
?>

<?= $this->Form->create($<%= $singularVar %>, ['class' => 'form-signin']) ?>
<h2 class="form-signin-heading"><?= __('Please sign in') ?></h2>
<?= $this->Form->label('email', __('Email address'), ['class' => 'sr-only']) ?>
<?= $this->Form->email('email', ['placeholder' => __('Email address'), 'autofocus']) ?>
<?= $this->Form->label('password', __('Password'), ['class' => 'sr-only']) ?>
<?= $this->Form->password('password', ['placeholder' => __('Password')]) ?>
<?= $this->Form->control('remember-me', ['type' => 'checkbox']) ?>
<?= $this->Form->submit(__('Sign in'), ['class' => 'btn btn-lg btn-primary btn-block']) ?>
<?= $this->Form->end() ?>
