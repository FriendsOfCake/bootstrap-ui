<?php

namespace BootstrapUI\Test\TestCase\View\Widget;

use BootstrapUI\View\Widget\ButtonWidget;
use Cake\Network\Session;
use Cake\TestSuite\TestCase;
use Cake\View\Form\ContextInterface;
use Cake\View\StringTemplate;

/**
 * ButtonWidgetTest class
 *
 */
class ButtonWidgetTest extends TestCase
{
    /**
     * @var StringTemplate
     */
    public $templates;

    /**
     * @var ContextInterface
     */
    public $context;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $templates = [
            'button' => '<button{{attrs}}>{{text}}</button>',
        ];
        $this->templates = new StringTemplate($templates);
        $this->context = $this->getMockBuilder('Cake\View\Form\ContextInterface')->getMock();
    }

    /**
     * Test render in a simple case.
     *
     * @return void
     */
    public function testRenderSimple()
    {
        $button = new ButtonWidget($this->templates);
        $result = $button->render(['name' => 'my_input'], $this->context);
        $expected = [
            'button' => ['type' => 'submit', 'name' => 'my_input', 'class' => 'btn btn-default'],
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Test render different button styles.
     *
     * @return void
     */
    public function testRenderDifferentStyles()
    {
        $styles = [
            'default',
            'success',
            'warning',
            'danger',
            'info',
            'primary'
        ];

        $button = new ButtonWidget($this->templates);

        foreach ($styles as $style) {
            $expected = [
                'button' => ['type' => 'submit', 'name' => 'my_input', 'class' => "btn-{$style} btn"],
                '/button'
            ];

            // support both "style" and "btn-style"
            foreach ([$style, "btn-$style"] as $type) {
                $result = $button->render(['name' => 'my_input', 'class' => $type], $this->context);
                $this->assertHtml($expected, $result);
            }
        }
    }

    /**
     * Test render with custom type
     *
     * @return void
     */
    public function testRenderType()
    {
        $button = new ButtonWidget($this->templates);
        $data = [
            'name' => 'my_input',
            'type' => 'button',
            'text' => 'Some button'
        ];
        $result = $button->render($data, $this->context);
        $expected = [
            'button' => ['type' => 'button', 'name' => 'my_input', 'class' => 'btn btn-default'],
            'Some button',
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Test render with a text
     *
     * @return void
     */
    public function testRenderWithText()
    {
        $button = new ButtonWidget($this->templates);
        $data = [
            'text' => 'Some <value>'
        ];
        $result = $button->render($data, $this->context);
        $expected = [
            'button' => ['type' => 'submit', 'class' => 'btn btn-default'],
            'Some <value>',
            '/button'
        ];
        $this->assertHtml($expected, $result);

        $data['escape'] = true;
        $result = $button->render($data, $this->context);
        $expected = [
            'button' => ['type' => 'submit', 'class' => 'btn btn-default'],
            'Some &lt;value&gt;',
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Test render with additional attributes.
     *
     * @return void
     */
    public function testRenderAttributes()
    {
        $button = new ButtonWidget($this->templates);
        $data = [
            'name' => 'my_input',
            'text' => 'Go',
            'class' => 'btn',
            'required' => true
        ];
        $result = $button->render($data, $this->context);
        $expected = [
            'button' => [
                'type' => 'submit',
                'name' => 'my_input',
                'class' => 'btn btn-default',
                'required' => 'required'
            ],
            'Go',
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }

    /**
     * Ensure templateVars option is hooked up.
     *
     * @return void
     */
    public function testRenderTemplateVars()
    {
        $this->templates->add([
            'button' => '<button {{attrs}} custom="{{custom}}">{{text}}</button>',
        ]);

        $button = new ButtonWidget($this->templates);
        $data = [
            'templateVars' => ['custom' => 'value'],
            'text' => 'Go',
        ];
        $result = $button->render($data, $this->context);
        $expected = [
            'button' => [
                'type' => 'submit',
                'custom' => 'value',
                'class' => 'btn btn-default'
            ],
            'Go',
            '/button'
        ];
        $this->assertHtml($expected, $result);
    }
}
