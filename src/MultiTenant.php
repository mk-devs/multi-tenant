<?php

namespace Mkdevs\MultiTenant;

use DB;
use Config;
use Artisan;
use Mkdevs\MultiTenant\MultiTenantWrapper;

class MultiTenant
{
	
	private $arguments;
	
	public function __construct()
	{
		$connection = Config::get('database.default');

		$this->arguments = [
			'database' 		 => '',
			'connection' 	 => $connection,
			'class'  		 => '',
			'path' 			 => '',
			'prev' 			 => [
				'database'   => Config::get('database.connections.'.$connection.'.database'),
				'connection' => $connection,
			]
		];
	}

	public function __call($method, $arguments)
	{
		$this->setArguments($arguments ? $arguments[0] : []);

		$instance = new MultiTenantWrapper($this->arguments);
		if(method_exists($instance, $method)) $instance->$method();

		return $this;
	}

	public function connectDatabase($connection, $database)
	{
		DB::purge($connection);
		Config::set('database.default', $connection);
		Config::set('database.connections.'.$connection.'.database', $database);
	}

	public function setArguments($arguments) 
	{
		if(is_string($arguments)) $arguments = ['database' => $arguments];

		if(isset($arguments['database'])) $this->arguments['database'] = $arguments['database'];
		if(isset($arguments['connection'])) $this->arguments['connection'] = $arguments['connection'];
		if(isset($arguments['class'])) $this->arguments['class'] = $arguments['class'];
		if(isset($arguments['path'])) $this->arguments['path'] = $arguments['path'];

		return $this->arguments;
	}

}