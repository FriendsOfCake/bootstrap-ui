<?php $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>

<?php $this->start('tb_actions'); ?>
<li><?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id], ['class' => 'nav-link']) ?></li>
<li><?= $this->Form->postLink( __('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'nav-link'] ) ?></li>
<li><?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
<li><?= $this->Html->link(__('List Authors'), ['controller' => 'Authors', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li><?= $this->Html->link(__('New Author'), ['controller' => 'Authors', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>

<div class="articles view large-9 medium-8 columns content">
    <h3><?= h($article->title) ?></h3>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('Author') ?></th>
                <td><?= $article->has('author') ? $this->Html->link($article->author->name, ['controller' => 'Authors', 'action' => 'view', $article->author->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($article->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($article->id) ?></td>
            </tr>
        </table>
    </div>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($article->body)); ?>
    </div>
</div>
