<?php

class Slot extends AbstractHelper {
	
	static function assign($name, $val = '') {
		Layout::slot($name);
		echo $val;
		Layout::slotEnd();
	}
	
	static function start($val) {
		Layout::slot($val);
	}
	
	static function end() {
		Layout::slotEnd();
	}
	
}

?>