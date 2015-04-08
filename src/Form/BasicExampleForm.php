<?php
namespace BootstrapUI\Form;

use Cake\Form\Form;
use Cake\Form\Schema;

class BasicExampleForm extends newt_form()
{
	protected function _buildSchema(Schema $schema)
	{
		return $schema->addField('email', 'string')
			->addField('password', 'string')
			->addField('file', 'string')
			->addField('check', 'boolean');
	}
}