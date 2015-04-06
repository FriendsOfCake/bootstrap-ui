<?php
namespace BootstrapUI\View\Widget;

use Cake\View\Form\ContextInterface;

class RadioWidget extends \Cake\View\Widget\RadioWidget
{
    /**
     * Render a set of radio buttons.
     *
     * Data supports the following keys:
     *
     * - `name` - Set the input name.
     * - `inline` - The alignement to use.
     * - `options` - An array of options. See below for more information.
     * - `disabled` - Either true or an array of inputs to disable.
     *    When true, the select element will be disabled.
     * - `val` - A string of the option to mark as selected.
     * - `label` - Either false to disable label generation, or
     *   an array of attributes for all labels.
     * - `required` - Set to true to add the required attribute
     *   on all generated radios.
     * - `idPrefix` Prefix for generated ID attributes.
     *
     * @param array $data The data to build radio buttons with.
     * @param \Cake\View\Form\ContextInterface $context The current form context.
     * @return string
     */
    public function render(array $data, ContextInterface $context)
    {
        $data += [
            'inline' => false,
        ];

        if ($data['inline']) {
            $this->_templates->add(['radioContainer' => '{{content}}']);
        }


        $templates = $this->_templates->get();
        $customize = [];
        if ($templates['nestingLabel'] === '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>') {
            $customize['nestingLabel'] = '<div class="radio">' . $templates['nestingLabel'] . '</div>';
        }
        $this->_templates->add($customize);

        unset($data['inline']);

        return parent::render($data, $context);
    }
}
