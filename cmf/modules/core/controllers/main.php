<?php
/**
 * @version		$Id: main.php 1 2012-05-20 18:18:12Z farhad $
 * @package		GoldenCMS
 * @copyright	Copyright (c) 2015 GoldenCMS (http://goldencms.com). All rights reserved.
 * @license		Commercial ( http://goldencms.com/license.html )
 * @author		Farhad Sakhaei ( http://farhad.us )
 * @description Main Controller Class
 */

namespace core\controllers;
use BaseController;

class Main extends BaseController{
	public function init(){
		/** Module Code, lowercase letters of module directory */
		$this->moduleCode = 'core';
		/** Module Name */
		$this->moduleName = 'Core Module';
		/** Initialize Module */
	}

	public function home_page($fw){
		$fw['INTITLE'] = $this->moduleName;
		$fw['INCONTENT'] = $this->moduleName;
	}
	
	/** Access Denied */
	public function error_403($fw){
		$fw['INTITLE'] = $fw['TITLE'] = $fw['dict.403_title'];
		$fw['INCONTENT'] = $this->vrender('403.phtml');
	}

	/** Not Found */
	public function error_404($fw){
		$fw['INTITLE'] = $fw['TITLE'] = $fw['dict.404_title'];
		$fw['INCONTENT'] = $this->vrender('404.phtml');
	}

	/** Method not allowed */
	public function error_405($fw){
		$fw['INTITLE'] = $fw['TITLE'] = $fw['dict.405_title'];
		$fw['INCONTENT'] = $this->vrender('405.phtml');
	}

	/** Internal server error */
	public function error_500($fw){
		$fw['INTITLE'] = $fw['TITLE'] = $fw['dict.500_title'];
		$fw['INCONTENT'] = $this->vrender('500.phtml');
	}

	/** Other errors */
	public function error($fw){
		$fw['INTITLE'] = $fw['TITLE'] = $fw['dict.err_title'];
		$fw['INCONTENT'] = $this->vrender('error.phtml');
	}
}