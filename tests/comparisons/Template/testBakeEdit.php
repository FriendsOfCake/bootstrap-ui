<?php
/**
 * @var \TestApp\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $article
 * @var \TestApp\Model\Entity\Author[]|\Cake\Collection\CollectionInterface $authors
 */
?>
<?php $this->extend('/layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('List Authors'), ['controller' => 'Authors', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Author'), ['controller' => 'Authors', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="articles form content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Edit Article') ?></legend>
        <?php
            echo $this->Form->control('author_id', ['options' => $authors, 'empty' => true]);
            echo $this->Form->control('title');
            echo $this->Form->control('body');
            echo $this->Form->control('rating');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
