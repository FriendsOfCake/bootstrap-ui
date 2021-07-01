<?php
/**
 * @var \Cake\View\View $this
 * @var array $params
 * @var string $message
 */

$icon = $params['icon'];
$class = array_unique((array)$params['class']);
$message = (isset($params['escape']) && $params['escape'] === false) ? $message : h($message);

if ($icon) {
    $isHtml = strpos($icon, '<') !== false;
    if (!$isHtml) {
        $icon = $this->Html->icon($icon, $params['iconOptions']);
    }
    $message = $icon . "<div>$message</div>";
}

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
