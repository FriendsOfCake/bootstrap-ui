<?php
$type = strtolower(str_replace([dirname(__FILE__) . DS, '.ctp'], ['', ''], $this->_current));
?>
<div class="alert alert-<?= $type ?>">
    <?= h($message) ?>
</div>
