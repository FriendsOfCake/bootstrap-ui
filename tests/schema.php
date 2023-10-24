<?php
declare(strict_types=1);

return [
    [
        'table' => 'articles',
        'columns' => [
            'id' => ['type' => 'integer'],
            'author_id' => ['type' => 'integer', 'null' => true],
            'title' => ['type' => 'string', 'null' => true],
            'body' => 'text',
            'rating' => ['type' => 'integer', 'null' => true],
        ],
        'constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]],
    ],
    [
        'table' => 'authors',
        'columns' => [
            'id' => ['type' => 'integer'],
            'name' => ['type' => 'string', 'default' => null],
        ],
        'constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]],
    ],
];
