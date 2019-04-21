<?php
namespace TestApp\Model\Table;

use Cake\ORM\Table;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->belongsTo('Authors');
    }
}
