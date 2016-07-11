<?php
/** GoldenCMS Index File */

/**
 * GoldenCMS Index File
 *
 * The first file runs the system
 *
 * @package    Index
 * @copyright  http://goldencms.com
 * @license    http://goldencms.com/license.txt  MIT License
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
$fw['AUTOLOAD'] = 	CMF_DIR . '; ';

/** Bootstrap application */
CMF::bootstrap();

$fw->run();