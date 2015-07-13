<%

use Cake\Utility\Inflector;

$fields = collection($fields)
        ->filter(function($field) use ($schema) {
    return $schema->columnType($field) !== 'binary';
});
%>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
$this->start('tb_actions');
?>
<% if (strpos($action, 'add') === false): %>
<li><?=
    $this->Form->postLink(
    __('Delete'),
    ['action' => 'delete', $<%= $singularVar
    %>-><%= $primaryKey[0] %>],
    ['confirm' => __('Are you sure you want to delete # {0}?', $<%= $singularVar %>-><%= $primaryKey[0] %>)]
    )
    ?></li>
<% endif; %>
<li><?= $this->Html->link(__('List <%= $pluralHumanName %>'), ['action' => 'index']) ?></li>
<%
$done = [];
foreach ($associations as $type => $data) {
    foreach ($data as $alias => $details) {
        if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
            %>
<li><?= $this->Html->link(__('List <%= $this->_pluralHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'index']) %> </li>
            <li><?= $this->Html->link(__('New <%= $this->_singularHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'add']) %> </li>
            <%
            $done[] = $details['controller'];
        }
    }
}
%>
<?php $this->end(); ?>
<?php $this->assign('tb_sidebar', '<ul class="nav nav-sidebar">' . $this->fetch('tb_actions') . '</ul>'); ?>
<?= $this->Form->create($<%= $singularVar %>); ?>
<fieldset>
    <legend><?= __('<%= Inflector::humanize($action) %> {0}', ['<%= $singularHumanName %>']) ?></legend>
    <?php
    <%
    foreach ($fields as $field) {
        if (in_array($field, $primaryKey)) {
            continue;
        }
        if (isset($keyFields[$field])) {
            %>
    echo $this->Form->input('<%= $field %>', ['options' => $<%= $keyFields[$field] %>]);
            <%
            continue;
        }
        if (!in_array($field, ['created', 'modified', 'updated'])) {
            %>
    echo $this->Form->input('<%= $field %>');
            <%
        }
    }
    if (!empty($associations['BelongsToMany'])) {
        foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
            %>
    echo $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>]);
            <%
        }
    }
    %>
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>