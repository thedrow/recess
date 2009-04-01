<?php
Library::import('recess.framework.views.NativeView');
Library::import('recess.framework.helpers.view');
Library::import('recess.framework.helpers.url');
Library::import('recess.framework.helpers.html');

class TemplatingView extends NativeView { 	
	/**
	 * Realizes HTTP's body content based on the Response parameter. Responsible
	 * for returning content in the format desired. The render method likely uses
	 * inversion of control which delegates to another method within the view to 
	 * realize the Response.
	 *
	 * @param Response $response
	 * @abstract 
	 */
	protected function render(Response $response) {
		$this->loadHelper('recess.framework.helpers.view','recess.framework.helpers.url','recess.framework.helpers.html');
		parent::render($response);
	}
}
?>