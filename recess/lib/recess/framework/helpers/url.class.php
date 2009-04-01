<?php
Library::import('recess.framework.helpers.AbstractHelper');
class url extends AbstractHelper {
	protected static $publicPath;
	protected static $app;
	public static function init($view){
		$request = $view->getRequest();
		self::setApp($request->meta->app);
	}
	public static function setApp($app) {
		self::$app = $app;
		self::$publicPath = self::$app->getPublicPath();
	}
	
	public static function base($str=''){
		return $_ENV['url.base'].$str;
	}
	public static function site($str=''){
		return $_ENV['url.base'].$str;
	}
	public static function asset($file=''){
		return $_ENV['url.base'].self::$publicPath.$file;
	}
	public static function setPublicPath($path) {
		return self::$publicPath = $path;
	}
	/**
	 * 
	 * @return  
	 * @param $methodName
	 */
	public static function app($methodName) {
		$args = func_get_args();
		return call_user_func_array(array(self::$app,'urlTo'),$args);
	}
}
?>