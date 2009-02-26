<?php
Library::import('recess.framework.helpers.AbstractHelper');
Library::import('recess.framework.helpers.url');

class view extends AbstractHelper {
	protected static $viewsDir = '';
	protected static $data = array();
	protected static $app;
	protected static $templates = array();
	protected static $blocks = array();
	protected static $slots = array();
	
	public static function init($view) {
		$response = $view->getResponse();
		self::$app = $response->meta->app;
		self::$data = $response->data;
	}
	
	public static function template($file,$args=null) {
		self::app_template(null,$file,$args);
	}
	
	public static function app_template($appClass,$file,$args=null) {
		if(array_key_exists(0,self::$templates)) {
			$blocks = self::$templates[0]['blocks'];
			$app = self::$templates[0]['app'];
		} else {
			$blocks = self::$data;
			$app = self::$app;
		}
		if(!empty($appClass)) $app = new $appClass;
		if(is_array($args)) $block = array_merge($blocks,$args);
		array_unshift(self::$templates,array('file'=>$file,'blocks'=>$blocks,'app'=>$app));
		ob_start();
		if(is_array($args)) self::end_template();
	}
	
	public static function file($file) {
		self::app_template(null,$file,array());
	}
	
	public static function app_file($appClass,$file) {
		self::app_template($appClass,$file,array());
	}
	
	public static function end_template() {
		$_view_template = array_shift(self::$templates);
		if(!$_view_template) throw new Exception('view:end_template called but no template active');
		extract($_view_template['blocks'],EXTR_SKIP);
		if(!isset($body)) $body = ob_get_clean();
		else ob_end_clean();
		url::setApp($_view_template['app']);
		include($_view_template['app']->getViewsDir().$_view_template['file'].'.php');
		url::setApp(array_key_exists(0,self::$templates) ? self::$templates[0]['app'] : self::$app);
	}
	
	public static function block($name,$val=null) {
		if(!($template = &self::$templates[0])) throw new Exception('self::block called but no template active');
		if($val!==null){
			$template['blocks'][$name] = $val;
			return $val;
		}
		array_unshift(self::$blocks,$name);
		ob_start();
	}
	
	public static function set($name,$val) {
		if(!($template = &self::$templates[0])) throw new Exception('self::set called but no template active');
		$template['blocks'][$name] = $val;
		return $val;
	}
	
	public static function end_block() {
		if(!($name = array_shift(self::$blocks))) throw new Exception('self::end_block called but no block active');
		self::block($name,ob_get_clean());
	}
	
	public static function slot($val=false) {
		array_unshift(self::$slots,$val);
		ob_start();
	}
	
	public static function end_slot() {
		$val = array_shift(self::$slots);
		$default = ob_get_clean();
		if($val===false) return;
		print $val ? $val : $default;
	}
	
}

?>
