<?php
$class = 'alert';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
} else {
    $class .= ' alert-info';
}
?>
<div class="<?= h($class) ?>">
    <?= h($message) ?>
</div>
