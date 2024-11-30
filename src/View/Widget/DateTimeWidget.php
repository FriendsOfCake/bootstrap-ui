<?php
declare(strict_types=1);

namespace BootstrapUI\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\Widget\DateTimeWidget as CoreDateTimeWidget;

class DateTimeWidget extends CoreDateTimeWidget
{
    use InputGroupTrait;

    /**
     * Render a date / time form widget.
     *
     * Data supports the following keys:
     *
     * - `name` The name attribute.
     * - `val` The value attribute.
     * - `escape` Set to false to disable escaping on all attributes.
     * - `type` A valid HTML date/time input type. Defaults to "datetime-local".
     * - `timezone` The timezone the input value should be converted to.
     * - `step` The "step" attribute. Defaults to `1` for "time" and "datetime-local" type inputs.
     *   You can set it to `null` or `false` to prevent explicit step attribute being added in HTML.
     * - `format` A `date()` function compatible datetime format string.
     *   By default, the widget will use a suitable format based on the input type and
     *   database type for the context. If an explicit format is provided, then no
     *   default value will be set for the `step` attribute, and it needs to be
     *   explicitly set if required.
     *
     * All other keys will be converted into HTML attributes.
     *
     * @param array $data Data to render with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string A generated select box.
     * @throws \RuntimeException when the name attribute is empty.
     */
    public function render(array $data, ContextInterface $context): string
    {
        return $this->_withInputGroup($data, $context);
    }
}
