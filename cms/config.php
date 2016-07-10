<?php

/** Application debug mode
	production or development */
$fw->APP_MODE = 'development';

/** Site URL */
$fw->SITE_URL = 'http://localhost/goldencms';


/** Cache backend. Unless assigned a value like 'memcache=localhost' (and the PHP memcache module is present),
	F3 auto-detects the presence of APC, WinCache and XCache and uses the first available PHP module if set to TRUE.
	If none of these PHP modules are available, a filesystem-based backend is used (default directory: tmp/cache).
	The framework disables the cache engine if assigned a FALSE value. */
$fw->CACHE = true;

/** Tells GoldenCMS to load the theme and output it. */
$fw->USE_THEMES = true;

/** Default timezone.
	Changing this value automatically calls the underlying date_default_timezone_set() function.
	Sets the default timezone used by all date/time functions in a script
	List of Supported Timezones : http://php.net/manual/en/timezones.php */
$fw->TZ = 'Asia/Tehran';

/** Default Language Base for multilingual site: subfolder
	(/site.com/en-us) or subdomain (en-us.site.com) */
$fw->LANGUAGE_BASE = 'subfolder';

/** Backup language for non translated text */
$fw->FALLBACK = 'en';

/** Current site active language.
	Value is used to load the appropriate language translation file in the folder pointed to by LOCALES.
	If set to NULL, language is auto-detected from the HTTP Accept-Language request header. */
$fw->DEFAULT_LANG = 'en';

$fw->ACTIVE_LANGUAGES = array('en','fa');

$fw->ACTIVE_TEMPLATE = 'default';

$fw->SITE_NAME = 'Golden CMS';

$fw->FAVICON_FILENAME = 'favicon.ico';

$fw->GEO_PLACE = 'England, London';
/** Toggle switch for suppressing or enabling standard output and error messages.
	Particularly useful in unit testing.
	Default : False */
$fw->QUIET = false;

/** Default serializer.
	Normally set to php, unless PHP igbinary extension is auto-detected.
	Assign json if desired. */
$fw->SERIALIZER = 'php';

$fw->ACTIVE_MODULES = Array();

/** Database Management System
	mysql,sqlite,sqlite2,mssql,sybase,dblib,sqlsrv,oci,odbc,db2,pgsql */
$fw->DBMS = 'mysql';
$fw->DBHOST = 'localhost';
$fw->DBPORT = '3306';
$fw->DBNAME = 'goldencms';
$fw->DBUSER = 'root';
$fw->DBPASS = '123';
$fw->DBFILE = '';

/** this is an array */
/*$fw->hash['x'] = 1;
$fw->hash['y'] = 2;
$fw->hash['z'] = 3;*/
/** dot-notation is recognized too */
/*$fw['hash.x'] = 1;
$fw['hash.y'] = 2;
$fw['hash.z'] = 3;*/
/** this is also an array */
//$fw->list = 7,8,9;
/** array with mixed elements */
//$fw->mix = 'this',123.45,FALSE;

/*
db_type=sqlite
db_file=data/sqlite/selfoss.db
db_host=localhost
db_database=selfoss
db_username=root
db_password=
db_port=3306
db_prefix=

items_perpage=50
items_lifetime=30
base_url=
username=
password=
salt=lkjl1289
public=
rss_title=selfoss feed
rss_max_items=300
rss_mark_as_read=0
homepage=newest

language=0

auto_mark_as_read=0
auto_stream_more=1
anonymizer=
use_system_font=
readability=
share=gtfprde
wallabag=
allow_public_update_access=
unread_order=
load_images_on_mobile=0
*/