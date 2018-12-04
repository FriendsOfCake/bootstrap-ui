<?php
namespace BootstrapUI\View\Widget;

use BootstrapUI\View\Widget\InputgroupTrait;
use Cake\View\Form\ContextInterface;

/**
 * Input widget class for generating a file upload control.
 */
class FileWidget extends \Cake\View\Widget\FileWidget
{
    use InputgroupTrait;

    /**
     * Render a file upload form widget.
     *
     * Data supports the following keys:
     *
     * - `name` - Set the input name.
     * - `escape` - Set to false to disable HTML escaping.
     *
     * All other keys will be converted into HTML attributes.
     * Unlike other input objects the `val` property will be specifically
     * ignored.
     *
     * @param array $data The data to build a file input with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string HTML elements.
     */
    public function render(array $data, ContextInterface $context)
    {
        $data['injectFormControl'] = false;
        $data = $this->injectClasses('form-control-file', $data);

        return $this->_withInputGroup($data, $context);
    }
}
