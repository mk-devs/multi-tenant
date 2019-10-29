<?php 

namespace Mkdevs\MultiTenant;

use Artisan;
use Mkdevs\MultiTenant\MultiTenant;

class MultiTenantWrapper extends MultiTenant
{

	private $arguments;

	public function __construct($arguments)
	{
		$this->arguments = $arguments;
	}

	public function migrate() 
	{
		Artisan::call("tenant:migrate", [
			'database' => $this->arguments['database'],
			'--connection' => $this->arguments['connection'],
			'--path' => $this->arguments['path']  ?? ''
		]);

		$this->reset();	
	}

	public function refresh() 
	{
		Artisan::call("tenant:refresh", [
			'database' => $this->arguments['database'],
			'--connection' => $this->arguments['connection']
		]);		

		$this->reset();		
	}

	public function rollback() 
	{
		Artisan::call("tenant:rollback", [
			'database' => $this->arguments['database'],
			'--connection' => $this->arguments['connection']
		]);		

		$this->reset();			
	}

	public function seed()
	{
		Artisan::call("tenant:seed", [
			'database' => $this->arguments['database'],
			'--connection' => $this->arguments['connection'],
			'--class' => $this->arguments['class'] ?? ''
		]);	

		$this->reset();			
	}

	public function create() 
	{
		Artisan::call("tenant:create", [
			'database' => $this->arguments['database'],
			'--connection' => $this->arguments['connection']
		]);		

		$this->reset();			
	}

	public function set()
	{
		$database = $this->arguments['database'];
		$connection = $this->arguments['connection'];
		$this->connectDatabase($connection, $database);
	}

	public function reset()
	{
		$database = $this->arguments['prev']['database'];
		$connection = $this->arguments['prev']['connection'];
		$this->connectDatabase($connection, $database);
	}

}