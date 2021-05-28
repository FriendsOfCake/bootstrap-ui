<?php
$class = array_unique((array)$params['class']);
$message = (isset($params['escape']) && $params['escape'] === false) ? $message : h($message);

if (in_array('alert-dismissible', $class)) {
    $button = <<<BUTTON
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
BUTTON;
    $message = $message . $button;
}
if (is_array($class)) {
    $class = join(' ', $class);
}
echo $this->Html->div($class, $message, $params['attributes']);
