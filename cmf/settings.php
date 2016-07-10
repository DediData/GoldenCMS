<?php

$fw->CACHE = 'folder=' . CMS_DIR . 'cache/';

/** Directory where file uploads are saved. */
$fw->UPLOADS = CMS_DIR . 'uploads/';

/** Temporary folder for cache, filesystem locks, compiled F3 templates, etc.
	Default is the tmp/ folder inside the Web root.
	Adjust accordingly to conform to your site's security policies. */
$fw->TEMP = CMS_DIR . 'tmps/';

/** Location of custom logs. */
$fw->LOGS = CMS_DIR . 'logs/';

/** Location of F3 plugins.
	Default value is the folder where the framework code resides, i.e. the path to base.php. */
$fw->PLUGINS = CMF_DIR . 'libs/f3/';

/** Location of the language dictionaries. */
$fw->LOCALES = CMF_DIR . 'locales/';

$fw->ERROR_LOG_FILE = 'error.log';

/** Comma-separated list of DNS blacklist servers.
	http://whatismyipaddress.com/blacklist-check
	Framework generates a 403 Forbidden error
	if the user's IPv4 address is listed on the specified server(s). */
$fw->DNSBL = '';

/** Comma-separated list of IPv4 addresses exempt from DNSBL lookups. */
$fw->EXEMPT = '';

/** Pattern matching of routes against incoming URIs is case-insensitive by default.
	Set to FALSE to make it case-sensitive. */
$fw->CASELESS = true;

/** Enable/disable syntax highlighting of stack traces.
	Default value: TRUE (requires code.css stylesheet). */
$fw->HIGHLIGHT = true;

/** Character set used for document encoding. Default value is UTF-8. */
$fw->ENCODING = 'UTF-8';

/** Used to enable/disable auto-escaping. Default: True */
$fw->ESCAPE = false;
