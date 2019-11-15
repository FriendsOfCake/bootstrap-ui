<?php
declare(strict_types=1);

namespace BootstrapUI\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\StringTemplate;
use Cake\View\Widget\LabelWidget;

/**
 * Input widget class for generating a file upload control.
 */
class FileWidget extends \Cake\View\Widget\FileWidget
{
    use InputgroupTrait;

    /**
     * Label widget.
     *
     * @var \Cake\View\Widget\LabelWidget
     */
    protected $_label;

    /**
     * Constructor
     *
     * @param \Cake\View\StringTemplate $templates Templates list.
     * @param \Cake\View\Widget\LabelWidget $label Label widget instance.
     */
    public function __construct(StringTemplate $templates, LabelWidget $label)
    {
        $this->_label = $label;

        parent::__construct($templates);
    }

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
    public function render(array $data, ContextInterface $context): string
    {
        $data['injectFormControl'] = false;

        $inputClass = 'form-control-file';
        if (
            isset($data['custom']) &&
            $data['custom']
        ) {
            $inputClass = 'custom-file-input';
        }
        unset($data['custom']);

        $data = $this->injectClasses($inputClass, $data);

        if (isset($data['inputGroupLabel'])) {
            $data['inputGroupLabel'] += [
                'for' => $data['id'],
            ];
            $data['templateVars']['label'] = $this->_label->render($data['inputGroupLabel'], $context);
            unset($data['inputGroupLabel']);
        }

        return $this->_withInputGroup($data, $context);
    }
}
