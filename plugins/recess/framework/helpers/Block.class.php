<?php

class Block extends AbstractHelper {
	
	static function assign($name, $val) {
		Layout::block($name);
		echo $val;
		Layout::blockEnd();
	}
	
	static function start($name) {
		Layout::block($name);
	}
	
	static function end() {
		Layout::blockEnd();
	}
	
}

?>