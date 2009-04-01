<?php
Library::import('recess.framework.Application');

class {{programmaticName}}Application extends Application {
	public function __construct() {
		
		$this->name = '{{appName}}';
		
		$this->viewsDir = $_ENV['dir.apps'] . '{{camelProgrammaticName}}/views/';	
		
		$this->publicPath = 'apps/{{camelProgrammaticName}}/public/';
		
		$this->modelsPrefix = '{{camelProgrammaticName}}.models.';
		
		$this->controllersPrefix = '{{camelProgrammaticName}}.controllers.';
		
		$this->routingPrefix = '{{routesPrefix}}';
		
	}
}
?>