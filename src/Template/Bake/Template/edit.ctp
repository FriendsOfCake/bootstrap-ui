<%

use Cake\Utility\Inflector;

$pk = '$' . $singularVar . '->' . $primaryKey[0];
%>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>

<li class="nav-item"><?= $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', <%= $pk %>],
        ['confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>), 'class' => 'nav-link']
    ) ?>
</li>
<li class="nav-item"><?= $this->Html->link(__('List <%= $pluralHumanName %>'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
<%
    $done = [];
    foreach ($associations as $type => $data) {
        foreach ($data as $alias => $details) {
            if ($details['controller'] !== $this->name && !in_array($details['controller'], $done)) {
            %>
<li class="nav-item"><?= $this->Html->link(__('List <%= $this->_pluralHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
<li class="nav-item"><?= $this->Html->link(__('New <%= $this->_singularHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
<%
            $done[] = $details['controller'];
            }
        }
    }
%>
<li class="nav-item"><?= $this->Html->link(__('New <%= $singularHumanName %>'), ['action' => 'add'], ['class' => 'nav-link']); ?></li>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-pills flex-column">' . $this->fetch('tb_actions') . '</ul>'); ?>


<div class="panel panel-default">
    <?= $this->Form->create($<%= $singularVar %>) ?>
    <fieldset>
        <legend><?= __('<%= Inflector::humanize($action) %> <%= $singularHumanName %>') ?></legend>
        <?php
<%
        foreach ($fields as $field) {
            if (in_array($field, $primaryKey)) {
                continue;
            }
            if (isset($keyFields[$field])) {
                $fieldData = $schema->column($field);
                if (!empty($fieldData['null'])) {
%>
            echo $this->Form->control('<%= $field %>', ['options' => $<%= $keyFields[$field] %>, 'empty' => true]);
<%
                } else {
%>
            echo $this->Form->control('<%= $field %>', ['options' => $<%= $keyFields[$field] %>]);
<%
                }
                continue;
            }
            if (!in_array($field, ['created', 'modified', 'updated'])) {
                $fieldData = $schema->column($field);
                if (in_array($fieldData['type'], ['date', 'datetime', 'time']) && (!empty($fieldData['null']))) {
%>
            echo $this->Form->control('<%= $field %>', ['empty' => true]);
<%
                } else {
%>
            echo $this->Form->control('<%= $field %>');
<%
                }
            }
        }
        if (!empty($associations['BelongsToMany'])) {
            foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
%>
            echo $this->Form->control('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>]);
<%
            }
        }
%>
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
































