<?php
/** BaseController Class */

/**
 * BaseController Class
 *
 * BaseController initialize other modules and their settings, routes, locales, ...
 *
 * @package    CMF
 * @copyright  http://goldencms.com
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 */

class BaseController extends Prefab {

	/**
	 * The Code for module identify
	 * @var string $moduleCode
	 */
	protected $moduleCode;

	/**
	 * Module Name
	 * @var	string $moduleName
	 */
	protected $moduleName;
	
	/** @var string moduleDir */
	protected $moduleDir;

	/**
	 * BaseController constructor.
	 */
	protected function __construct(){
		/** Check if module active or not, if not active return false */
		if (!$this->isactive()){
			return false;
		} elseif (!isset($this->moduleCode)){
			$this->init();
			/** define module directory */
			$this->moduleDir = CMF_DIR . 'modules/' . $this->moduleCode . '/';
			/** Load module settings */
			include( $this->moduleDir . 'settings.php' );
			/** Load js routes */
			include( $this->moduleDir . 'routes/js.php' );
			/** Load css routes */
			include( $this->moduleDir . 'routes/css.php' );
			$fw = Base::Instance();
			/** Initialize an instance of module in framework */
			$fw['mod_'.$this->moduleCode] = $this;
			/** Load module locales */
			$fw->LOCALES = $this->moduleDir . 'locales/';
		}
	}

	/**
	 * Render module view
	 *
	 * @param $filename
	 *
	 * @return mixed
	 */
	protected function vrender($filename){
		$fw = Base::Instance();
		$fw->UI = $this->moduleDir . 'views/';
		return $fw->view->render( $filename );
	}

	/**
	 * Render module template
	 *
	 * @param $filename
	 *
	 * @return mixed
	 */
	protected function trender($filename){
		$fw = Base::Instance();
		$fw->UI = $this->moduleDir . 'views/';
		return $fw->template->render( $filename );
	}

	/**
	 * Install module
	 */
	protected function install(){
		include( $this->moduleDir . 'install.php');
	}

	/** Uninstall module */
	protected function uninstall(){
		include( $this->moduleDir . 'uninstall.php');
	}

	/** Activate module */
	protected function activate(){

	}

	/** Deactivate module */
	protected function deactivate(){

	}

	/** is module actove? */
	protected function isactive(){
		return true;
	}

	/**
	 * Runs before any route
	 */
	public static function beforeroute(){
		
	}

	/**
	 * Runs after any route
	 */
	public static function afterroute(){
		/**
		Load active template
		Search path for user interface files used by the View and Template classes' render() method.
		Default value is the Web root.
		Accepts a pipe (|), comma (,), or semi-colon (;) as path separator.
		*/
		$fw = Base::Instance();
		$fw->CONTENT = $fw->mod_core->vrender('content.phtml');
		$fw->UI = $fw->template_dir;
		echo $fw->template->render( 'index.phtml');
	}
}