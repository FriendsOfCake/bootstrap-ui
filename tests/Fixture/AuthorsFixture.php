<?php
namespace BootstrapUI\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class AuthorsFixture extends TestFixture
{
    public $fields = [
        'id' => ['type' => 'integer'],
        'name' => ['type' => 'string', 'default' => null],
        '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]]
    ];

    public $records = [
    ];
}
