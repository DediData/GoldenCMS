<?php
/**
 * @version		$Id: index.php 1 2012-05-20 18:18:12Z farhad $
 * @package		GoldenCMS
 * @copyright	Copyright (c) 2012 GoldenCMS (http://goldencms.com). All rights reserved.
 * @license		Commercial ( http://goldencms.com )
 * @author		Farhad Sakhaei
 * @description Front to the GoldenCMS application.
 */

/** Current Working Directory */
define('CW_DIR', str_replace('\\', '/', getcwd()));

/** Content management framework directory, Can be inaccessible by visitors */
define('CMF_DIR', CW_DIR . '/cmf/');

/** Content management system data directory, Can be inaccessible by visitors */
define('CMS_DIR', CW_DIR . '/cms/');

/** Content management system public directory, Should be accessible by visitors */
define('PUB_DIR', CW_DIR . '/public/');

/** Load Framework */
$fw = require( CMF_DIR . 'libs/f3/base.php' );

/** Search path for user-defined PHP classes that the framework will attempt to autoload at runtime.
	Accepts a pipe (|), comma (,), or semi-colon (;) as path separator. */
$fw['AUTOLOAD'] = 	CMF_DIR . '; ' .
					CMF_DIR . '/libs/; ' .
					CMF_DIR . '/libs/f3/; ' .
					CMF_DIR . '/modules/; ';

/** Bootstrap application */
CMF::bootstrap();

$fw->run();