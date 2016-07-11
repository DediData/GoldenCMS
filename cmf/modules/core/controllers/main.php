<?php
/** Core Controller Main Class */

/**
 * Core Controller Main Class
 *
 * Core Controller Main Class
 *
 * @package    CMF
 * @copyright  http://goldencms.com
 * @license    http://goldencms.com/license.txt  MIT License
 */

namespace modules\core\controllers;
use BaseController;

/**
 * Class Main
 *
 * @package core\controllers
 */
class Main extends BaseController{
	/**
	 * Initialize Module
	 */
	public function init(){
		/** Module Code, lowercase letters of module directory */
		$this->moduleCode = 'core';
		/** Module Name */
		$this->moduleName = 'Core Module';
		/** Initialize Module */
	}

	/**
	 * Initialize Home Page
	 * @param $fw
	 */
	public function home_page($fw){
		$fw->INTITLE = $this->moduleName;
		$fw->INCONTENT = $this->moduleName;
	}

	/**
	 * Access Denied
	 * @param $fw
	 */
	public function error_403($fw){
		$fw->INTITLE = $fw->TITLE = $fw['dict.403_title'];
		$fw->INCONTENT = $this->vrender('403.phtml');
	}

	/**
	 * Not Found
	 * @param $fw
	 */
	public function error_404($fw){
		$fw->INTITLE = $fw->TITLE = $fw['dict.404_title'];
		$fw->INCONTENT = $this->vrender('404.phtml');
	}

	/**
	 * Method not allowed
	 * @param $fw
	 */
	public function error_405($fw){
		$fw->INTITLE = $fw->TITLE = $fw['dict.405_title'];
		$fw->INCONTENT = $this->vrender('405.phtml');
	}

	/**
	 * Internal server error
	 * @param $fw
	 */
	public function error_500($fw){
		$fw->INTITLE = $fw->TITLE = $fw['dict.500_title'];
		$fw->INCONTENT = $this->vrender('500.phtml');
	}

	/**
	 * Other errors
	 * @param $fw
	 */
	public function error($fw){
		$fw->INTITLE = $fw->TITLE = $fw['dict.err_title'];
		$fw->INCONTENT = $this->vrender('error.phtml');
	}
}