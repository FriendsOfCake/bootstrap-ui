<?php
use Cake\Routing\Router;

Router::plugin('/bootstrap_ui', function ($routes) {
	$routes->connect('/styleguide', [
		'controller' => 'Styleguide',
		'action' => 'index',
	]);
});