<?php
/** Content Management Framework Class */

/**
 * Content Management Framework Class
 *
 * This is the main class of CMF
 *
 * @package    CMF
 * @copyright  http://goldencms.com
 * @license    http://goldencms.com/license.txt  MIT License
 */

class CMF extends Prefab {

	/**
	 * Bootstrap of the CMF
	 */
	public static function bootstrap() {
		$fw = Base::instance();
		$fw->CMF_VERSION = '1.0';

		/** Break Row */
		define('BR',"\n");
		/** Tab */
		define('TAB',"\t");

		/** Load framework settings */
		require( CMF_DIR . 'settings.php' );

		/** Load the cms config file if exists, otherwise redirect to installer */
		if (file_exists( CMS_DIR . '/config.php')) {
			require( CMS_DIR . '/config.php' );
		} else {
			$fw->reroute('/install.php');
			exit();
		}

		/** Initialize Log system */
		$fw->logger = new \Log($fw->ERROR_LOG_FILE);
		//$fw->logger->write( string $text [, string $format = 'r' ] );  // Format: Thu, 21 Dec 2000 16:01:07 +0200
		//$fw->logger->write( 'hello' );  // Format: Thu, 21 Dec 2000 16:01:07 +0200
		//$fw->logger->erase();

		/** calculate execution time on unload */
		$fw->UNLOAD = 'CMF::execution_time';

		/** Initialize View system */
		$fw->view = View::instance();
		//echo $fw->view->render('myview.html','text/html',array('urls'=>$urls));
		//echo $fw->view->render('myview.xml','text/xml',array('urls'=>$urls));
		//echo $fw->view->render('myview.csv','text/csv',array('urls'=>$urls));

		/** Initialize Template system */
		$fw->template = Template::instance();
		//echo $fw->view->render('myview.html','text/html',array('urls'=>$urls));
		//echo $fw->view->render('myview.xml','text/xml',array('urls'=>$urls));
		//echo $fw->view->render('myview.csv','text/csv',array('urls'=>$urls));

		/** Check system settings */
		CMF::check_system();

		/** Add site name to the title */
		$fw->TITLE .= $fw->SITE_NAME;

		/** Generator */
		$fw->GENERATOR = 'GoldenCMS ' . $fw->CMF_VERSION;
		$fw->PACKAGE = $fw->GENERATOR;

		/** Path URL to public directory */
		define('PUB_URL', $fw->SITE_URL . str_replace( CW_DIR, '', PUB_DIR ));

		/** Detect current active template directory */
		$fw->template_dir = PUB_DIR . 'templates/' . $fw->ACTIVE_TEMPLATE . '/';

		/** Relative path to template directory */
		$fw->template_url = $fw->SITE_URL . str_replace( CW_DIR, '', $fw->template_dir );

		/** Favorite icon */
		$fw->FAV_ICON = PUB_URL . 'images/' . $fw->FAVICON_FILENAME;

		/** Detect if the site is in a sub folder */
		$fw->SUB_FOLDER = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

		/** Request URI based on the sub folder (if any sub folder) */
		$fw->REQUESTED_URI = '/' . str_replace($fw->SUB_FOLDER, '', $_SERVER['REQUEST_URI']);

		/** Request URL (FULL) */
		$fw->REQUESTED_URL = CMF::req_url();

		/** Load Language */
		CMF::load_language();

		/** Load core routes */
		include( CMF_DIR . 'modules/core/routes/main.php' );

		/** Load active modules routes */
		foreach($fw->ACTIVE_MODULES as $module){
			/** Load main route */
			include( CMF_DIR . 'modules/' . $module . '/routes/main.php' );
		}

		/** Initializing Database Connection */
		CMF::load_db();

		/** Template CSS File
			Loads template css file , if current language is a RTL language, it will load RTL style
		*/
		$fw->rtl_ext = ( $fw->is_rtl ) ? '-rtl' : '';
		$fw->THEME_CSS = $fw->template_url . 'css/style'. $fw->rtl_ext . '.css';

		$fw->INTITLE 		= $fw->INTITLE 		? $fw->INTITLE		: '';
		$fw->INCONTENT		= $fw->INCONTENT	? $fw->INCONTENT	: '';
		$fw->HEAD 			= $fw->HEAD 		? $fw->HEAD			: '';
		$fw->TAIL 			= $fw->TAIL 		? $fw->TAIL			: '';
		$fw->BODY_CLASS		= $fw->BODY_CLASS	? ' body' 			: 'body';

		$fw->BLOCK[] = '';
		$fw->BLOCK[] = '';
		$fw->BLOCK[] = '';

		/** Set up error handling */
		$fw->ONERROR = 'CMF::error_handler';
	}

	/** Request URL (Full URL) */
	public static function req_url(){
		$ssl      = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' );
		$sp       = strtolower( $_SERVER['SERVER_PROTOCOL'] );
		$protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
		$port     = $_SERVER['SERVER_PORT'];
		$port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
		$host     = isset( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : null;
		$host     = isset( $host ) ? $host : $_SERVER['SERVER_NAME'] . $port;
		return $protocol . '://' . $host . $_SERVER['REQUEST_URI'];
	}

	/** Load Database */
	public static function load_db(){
		$fw = Base::instance();
		$user = NULL;
		$pass = NULL;
		switch($fw->DBMS){
			/* MySQL 3.x, 4.x and 5.x */
			case 'mysql':
				$dsn = "mysql:host=$fw->DBHOST;port=$fw->DBPORT;dbname=$fw->DBNAME";
				$user = $fw->DBUSER;
				$pass = $fw->DBPASS;
				$options = NULL;
				break;
			/* SQLite */
			case 'sqlite':
				$dsn = "sqlite:$fw->DBFILE";
				$user = NULL;
				$pass = NULL;
				$options = NULL;
				break;
			/** SQLite2 */
			case 'sqlite2':
				$dsn = "sqlite2:$fw->DBFILE";
				$user = NULL;
				$pass = NULL;
				$options = NULL;
				break;
			/** Microsoft SQL Server */
			case 'mssql':
				$dsn = "mssql:host=$fw->DBHOST;dbname=$fw->DBNAME";
				$user = NULL;
				$pass = NULL;
				$options = NULL;
				break;
			/** Sybase */
			case 'sybase':
				$dsn = "sybase:host=$fw->DBHOST;dbname=$fw->DBNAME";
				$user = NULL;
				$pass = NULL;
				$options = NULL;
				break;
			/** Microsoft SQL Server (dblib) */
			case 'dblib':
				$dsn = "dblib:host=$fw->DBHOST;dbname=$fw->DBNAME";
				$user = $fw->DBUSER;
				$pass = $fw->DBPASS;
				$options = NULL;
				break;
			/** MS SQL Server (starting with SQL Server 2005) and SQL Azure */
			case 'sqlsrv':
				$dsn = "sqlsrv:Server=$fw->DBHOST,$fw->DBPORT;Database=$fw->DBNAME";
				$user = $fw->DBUSER;
				$pass = $fw->DBPASS;
				$options = NULL;
				break;
			/** Oracle */
			case 'oci':
				$dsn = "oci:dbname=//$fw->DBHOST:$fw->DBPORT/$fw->DBNAME";
				$user = NULL;
				$pass = NULL;
				$options = NULL;
				break;
			/** ODBC */
			case 'odbc':
				$dsn = "odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=$fw->DBFILE;Uid=$fw->DBUSER";
				$user = NULL;
				$pass = NULL;
				$options = NULL;
				break;
			/** DB2 */
			case 'db2':
				$dsn = "odbc:DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME=$fw->DBHOST;PORT=$fw->DBPORT;DATABASE=$fw->DBNAME;PROTOCOL=TCPIP;UID=$fw->DBUSER;PWD=$fw->DBPASS";
				$user = NULL;
				$pass = NULL;
				$options = NULL;
				break;
			/** PostgreSQL */
			case 'pgsql':
				$dsn = "pgsql:host=$fw->DBHOST;port=$fw->DBPORT;dbname=$fw->DBNAME;user=$fw->DBUSER;password=$fw->DBPASS";
				$user = NULL;
				$pass = NULL;
				$options = NULL;
				break;
			default:
				trigger_error('ERROR: No DBMS selected for Database, Please check config file!');
		}

	}

	/** Load language */
	public static function load_language(){
		$fw = Base::instance();
		if ( $fw->LANGUAGE_BASE === 'subfolder' ) {
			/** Site is configured for subfolder language base */

			/** Extract requested language from uri */
			preg_match('/^[\/]{1}(?<lang>[a-z]{2}(?:-[a-zA-Z]{2})?)(?:[\/]{1}.*)?$/', $fw->REQUESTED_URI, $tmp_array);
			$fw->REQUESTED_LANG = isset($tmp_array['lang']) ? $tmp_array['lang'] : NULL;
			if ( isset($fw->REQUESTED_LANG) ) {
				/** language code is in uri */
				/** Check if requested language code is in active site languages */
				if (in_array($fw->REQUESTED_LANG, $fw->ACTIVE_LANGUAGES)){
					/** Yes , requested language is in active site languages */
					/** Load requested language */
					$fw->LANGUAGE = $fw->REQUESTED_LANG;
					/** language route should be define for proper multilingual routes */
					$fw->LANG = '/@lang';
				} else {
					/** Detected language code is not in active language
						May be it is a defined route, We load default language */
					$fw->LANGUAGE = $fw->DEFAULT_LANG;
					/** No need to lang route */
					$fw->LANG = NULL;
				}
			} else {
				/** Language code is not in uri but the site is configured for multilingual subfolder
					So we load default language */
				$fw->LANGUAGE = $fw->DEFAULT_LANG;
				/** No need to lang route */
				$fw->LANG = NULL;
			}
		} elseif ( $fw->LANGUAGE_BASE === 'subdomain' ) {
			/** Site is configured for subdomain language base */

			/** No need to lang route for all subdomains */
			$fw->LANG = NULL;

			/* Extract requested language from subdomain */
			preg_match('/^(?<lang>[a-z]{2}(?:-[a-zA-Z]{2})?)[\.]{1}.*$/', $fw->SERVER_NAME, $tmp_array);
			$fw->REQUESTED_LANG = isset($tmp_array['lang']) ? $tmp_array['lang'] : NULL;

			if ( isset($fw->REQUESTED_LANG) ) {
				/** language code is in subdomain */

				/** Check if requested language code is in active site languages */
				if (in_array($fw->REQUESTED_LANG, $fw->ACTIVE_LANGUAGES)){
					/** Yes , requested language is in active site languages */
					/** Load requested language */
					$fw->LANGUAGE = $fw->REQUESTED_LANG;
				} else {
					/** Detected language code is not in active language
						May be it is a subdomain, We load default language */
					$fw->LANGUAGE = $fw->DEFAULT_LANG;
				}
			} else {
				/** Language code is not in subdomain but the site is configured for multilingual subdomain
					So we load default language */
				$fw->LANGUAGE = $fw->DEFAULT_LANG;
			}
		}

		/** Set html language property based on defined locale selected language */
		$fw->ACTIVE_LANG = isset($fw->four_lang) ? $fw->four_lang : $fw->two_lang;
	}

	/** Set up error handling */
	public static function error_handler() {
		$fw = Base::instance();
		/** recursively clear existing output buffers */
		while (ob_get_level())
			ob_end_clean();
		if ($fw->ERROR['code'] == 403) {
			$fw->mock('GET @403');
		} elseif($fw->ERROR['code'] == 404) {
			$fw->mock('GET @404');
		} elseif($fw->ERROR['code'] == 405) {
			$fw->mock('GET @405');
		} else {
			$stack = '';
			$i = 1;
			$debug = debug_backtrace();
			array_shift($debug); //Remove call to this function from stack trace
			array_shift($debug);
			array_shift($debug);
			foreach($debug as $node) {
				$stack .= "#$i ";
				if(isset($node['file'])) {
					$stack .= $node['file'] ."(" .$node['line']."): ";
				}
				if(isset($node['class'])) {
					$stack .= $node['class'] . $node['type'];
				}
				$stack .= $node['function'] . "(";
				if(isset($node['args'])){
					$tmpcomma = '';
					foreach($node['args'] as $key=>$value){
						if(is_object($value)){
							$value = get_class($value);
						}
						if (is_array($value)) {
							$value = 'Array';
						}
						$stack .= $tmpcomma . $key . " => " . $value;
						$tmpcomma = ', ';
					}
				}
				$stack .= ")" . PHP_EOL;
				$i++;
			}
			$fw->TRACE_INFO = str_replace("\r\n", '<br />', $stack);
			if($fw->ERROR['code'] == 500){
				$fw->mock('GET @500');
			}else{
				$fw->mock('GET @error');
			}
			if ($fw->APP_MODE == 'development' && $fw->ERROR.code != '404' &&
				$fw->ERROR.code != '403' && $fw->ERROR.code != '405') {
				$code	= $fw->ERROR['code'];
				$status	= $fw->ERROR['status'];
				$text	= $fw->ERROR['text'];
				//$trace	= $fw->ERROR.trace;
				$report_str = "ERROR CODE: [$code]\nERROR STATUS: [$status]\nERROR TEXT: [$text]\nERROR BACKTRACE: \n$stack";
				$fw->logger->write($report_str);
			}
		}
	}

	/**
	 * Checks the server compatibility and writable folders
	 */
	public static function check_system () {
		$fw = Base::instance();

		/** Report all PHP errors if application mode is development */
		if ($fw->APP_MODE == 'development') {
			@ini_set('display_errors', 1);
			error_reporting(E_ALL);
			$fw->DEBUG = 3;
		} else {
			@ini_set('display_errors', 0);
			@ini_set('magic_quotes_runtime', 0);
			error_reporting(0);
			$fw->DEBUG = 0;
		}

		/** Check PHP version */
		if ( version_compare( phpversion(), '5.3.4', '<' ) === true ) {
			trigger_error('ERROR: Your PHP version is ' . phpversion() . '. GoldenCMF requires PHP 5.3.4 or newer.');
		}

		/** Check Perl Compatible Regular Expressions */
		if ((float)PCRE_VERSION<7.9) {
			trigger_error('PCRE version is out of date');
		}

		/** Check writable directories */
		if (!is_dir( $fw->TEMP ) || !is_writable( $fw->TEMP ))
			$preErr[] = sprintf('please make sure that the \'%s\' directory is existing and writable.',$fw->TEMP);
		if ($fw->CACHE) {
			$cache_dir = str_replace("folder=", "", $fw->CACHE);
			if (!is_writable( $cache_dir))
				$preErr[] = sprintf('please make sure that the \'%s\' directory is writable.', $cache_dir);
		}
		if(isset($preErr)) {
			header('Content-Type: text;');
			die(implode("\n",$preErr));
		}
	}

	/** calculate execution time and memory */
	public static function execution_time() {
		$fw = Base::instance();
		if ($fw->APP_MODE == 'development') {
			$execution_time = round(microtime(true) - $fw->TIME, 4);
			echo( BR . '<!-- Script '.''.' executed in '.$execution_time.' seconds using '.
				round(memory_get_usage() / 1024 / 1024, 2).'/'.
				round(memory_get_peak_usage() / 1024 / 1024, 2).' MB memory/peak -->' );
		}
	}

}
