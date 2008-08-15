<?php
/**
* @version $Id: install_english.php,v 1.3 2005/02/20 22:21:13 mic Exp $
* @package MMLi
* @copyright (C) 2000 - 2004 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @edited by mic (developer@mamboworld.net) www.mamboworld.net
* Mambo is Free Software
*/
// edited for Mambo 4.5.3 by Akarawuth Tamrareang  http://www.mambohub.com
// edited by mic (mic@mamboworld.net) - 2005.01.07


//-- Common
define ('_INSTALL_ISO','iso-8859-1');
define ('_INSTALL_YES', "Yes");
define ('_INSTALL_NO', "No");
define ('_INSTALL_AVAILABLE', "Available");
define ('_INSTALL_UNAVAILABLE', "Unavailable");
define ('_INSTALL_WRITABLE', "Writable");
define ('_INSTALL_ON', "ON");
define ('_INSTALL_OFF', "OFF");
define ('_INSTALL_UNWRITABLE', "Unwritable");
define ('_INSTALL_NEXT', "Next >>");
define ('_INSTALL_BACK', '<< Back'); // ##### new

//--Language choice
define ('_INSTALL_LANGUAGE_SECTION', "Mambo installation language");
define ('_INSTALL_LANGUAGE_DESCRIPTION', "The installer automatically detects your browser language preferences. However, you can select one of the available languages.");
define ('_INSTALL_LANGUAGE_LABEL', "Installation language");
define ('_INSTALL_LANGUAGE_CHECK','Language check');
define ('_INSTALL_LANGUAGE_CHOOSE','- Please Choose -');

//-- Index.php
	//--Left menu
define ('_INSTALL_LICENSE_ALERT', "Please read/accept license to continue installation");
define ('_MAMBO_WEB_INSTALLER', _MAMBORS_VERSION. " - Web Installer ::");  //  Add Title  by Ak.
define ('_INSTALL_MAMBO', "Mambo Installation");
define ('_INSTALL_STEP_PRECHECK', "pre-installation check");
define ('_INSTALL_STEP_LICENSE', "License");
define ('_INSTALL_STEP_1', "Step 1");
define ('_INSTALL_STEP_2', "Step 2");
define ('_INSTALL_STEP_3', "Step 3");
define ('_INSTALL_STEP_4', "Step 4");
	//--Pre-check zone
define ('_INSTALL_PRECHECK_TITLE', "pre-installation check");
define ('_INSTALL_PRECHECK_SECTION', "Pre-installation check for");
define ('_INSTALL_PRECHECK_DESCRIPTION', "If any of these items are highlighted in red then please take actions to correct them. <br />
			Failure to do so could lead to your Mambo installation not functioning correctly.");
define ('_INSTALL_PHP_VERSION','- <strong>PHP</strong> Version >= 4.1.0');
define ('_INSTALL_PHP_ZLIB', '- <strong>zlib</strong> compression support');
define ('_INSTALL_PHP_XML', '- <strong>XML</strong> support');
define ('_INSTALL_PHP_MYSQL', '- <strong>MySQL</strong> support');
define ('_INSTALL_CONFIG_FILE','- <strong>Mambo</strong> Configuration');
define ('_INSTALL_PHP_CONF', "You can still continue the install as the configuration will be displayed at the end, just copy & paste this and upload.");
define ('_INSTALL_SESSION', "- Session save path");
define ('_INSTALL_SESSION_NOT_SET','Not set');

	//--recommanded
define ('_INSTALL_PHP_SETTINGS_TITLE', "Recommended settings:");
define ('_INSTALL_PHP_SETTINGS_DESCRIPTION', "These settings are recommended for PHP in order to ensure full compatibility with Mambo.<br />
		However, Mambo will still operate if your settings do not quite match the recommended");
define ('_INSTALL_PHP_FONCTION', "Directive");
define ('_INSTALL_PHP_FONCTION_IDEAL', "Recommended");
define ('_INSTALL_PHP_FONCTION_ACTUAL', "Actual");
define ('_INSTALL_PHP_MODE', "Safe Mode:");
define ('_INSTALL_PHP_ERRORS', "Display Errors:");
define ('_INSTALL_PHP_UPLOAD', "File Uploads:");
define ('_INSTALL_PHP_QUOTES_GPC', "Magic Quotes GPC:");
define ('_INSTALL_PHP_QUOTES_RUNTIME', "Magic Quotes Runtime:");
define ('_INSTALL_PHP_GLOBALS', "Register Globals:");
define ('_INSTALL_PHP_OUTBUFFER', "Output Buffering:");
define ('_INSTALL_PHP_AUTOSTART_SESSION', "Session auto start:");
	//--file permission
define ('_INSTALL_DIRFILE_PERMS', "Directory and File Permissions:");
define ('_INSTALL_DIRFILE_PERMS_INFO', "In order for Mambo to function correctly it needs to be able to access or write to certain files	or directories. If you see \"Unwriteable\" you need to change the permissions on the file or directory to allow Mambo to write to it [e.g. per FTP-client with CHMOD 0777].");

//--Install.php
define ('_INSTALL_LICENSE_TITLE', "license");
define ('_INSTALL_LICENSE_TYPE', "GNU/GPL License:");
define ('_INSTALL_LICENSE_CONDITION', "*** To continue installing Mambo you must check the box under the license ***");
define ('_INSTALL_LICENSE_AGREE', "I Accept the GPL License");

//--Install1.php
define ('_INSTALL_DB_JS_HOSTNAME', 'Please enter a Host name');
define ('_INSTALL_DB_JS_USERNAME', 'Please enter a Database User Name');
define ('_INSTALL_DB_JS_BASENAME', 'Please enter a Name for your (new) Database');
define ('_INSTALL_DB_JS_PASSWORD', 'Please enter a Passwort for your (new) Database');
define('_INSTALL_DB_PASSWORD_VERRIFY',"Verify MySQL Password");    // Add by ninekrit
define ('_INSTALL_DB_JS_WARNING', 'Are you sure these settings are correct?\nMambo will now attempt to populate a Database with the settings you have supplied');
define ('_INSTALL_DB_SECTION', "MySQL database configuration:");
define ('_INSTALL_DB_HOSTNAME', "Host Name");
define ('_INSTALL_DB_HOSTNAME_DESCRIPTION', 'This is usually "localhost"');
define ('_INSTALL_DB_USERNAME', "MySQL User Name");
define('_INSTALL_DB_USERNAME_DESC', "Either something as 'root' or a username given by the hoster");
define ('_INSTALL_DB_PASSWORD', "MySQL Password");
define ('_INSTALL_DB_BASENAME', "MySQL Database Name");
define ('_INSTALL_DB_PREFIX', "MySQL Table Prefix");
define ('_INSTALL_DB_PREFIX_DESC', "Some hosts allow only a certain DB name per site. Use table prefix in this case for distinct mambo sites. <br />Dont use 'old_' since this is used for backup tables");
define ('_INSTALL_DB_DROPTABLES', "Drop Existing Tables?");
define ('_INSTALL_DB_BACKUP', "Backup Old Tables?");
define ('_INSTALL_DB_BACKUP_DESCRIPTION', "Any exiting backup tables from former mambo installations will be replaced");
define ('_INSTALL_DB_SAMPLE_DATA', "Install Sample Data?");
define ('_INSTALL_DB_SAMPLE_DATA_DESC',"Dont uncheck this unless you are experienced with mambo!");


//--Install2.php
define ('_INSTALL_DB_ERROR1', "The database details provided are incorrect and/or empty.");
define ('_INSTALL_DB_ERROR2', "The password and username provided are incorrect.");
define ('_INSTALL_DB_ERROR3', "The database name provided is empty.");
define ('_INSTALL_DB_ERROR4', "A database error occurred:");
define('INSTALL_DB_ERROR5', "The database passwords provided do not match.  Please try again.");
define ('_INSTALL_DB_DATAERROR', "Looks like there have been some errors with inserting data into your database!<br />You cannot continue.");
define ('_INSTALL_DB_LOGERROR', "<br /><br />Error log:<br />\n");

define ('_INSTALL_SITE_NONAME', "The sitename has not been provided");
define ('_INSTALL_JS_SITENAME', "Please enter Site Name");
define ('_INSTALL_JS_SITEURL', "Please enter Site URL");
define ('_INSTALL_JS_PATH', "Please enter the absolute path to your site");
define ('_INSTALL_JS_EMAIL', "Please enter an email address to contact your administrator");
define ('_INSTALL_JS_PASSWORD', "Please enter a password for you administrator");
define ('_INSTALL_SITE_SECTION', "Confirm the site Name, URL, absolute path and admin Email");
define ('_INSTALL_SITE_DESCRIPTION', "Usually, the URL and Absolute Path are correct, please do not change.
    	          If it is not correct, please contact your ISP or administrator.");
define ('_INSTALL_SITE_NAME', "Site name");
define ('_INSTALL_SITE_PATH', "Absolute Path");
define ('_INSTALL_SITE_URL', "Site URL");
define ('_INSTALL_SUPERADMIN_EMAIL', "Admin Email");
define ('_INSTALL_SUPERADMIN_PASSWORD', "Admin password");
define ('_INSTALL_ADMIN_PW','[NOTE: the suggested password can be replaced with one of your choice]');

//--Install3.php
define ('_INSTALL_JS_CHECKEMAIL', "You must provide a valid admin email address.");
define ('_INSTALL_JS_CHECKDB', "The database details provided are incorrect and/or empty");
define ('_INSTALL_JS_CHECKSITENAME', "The sitename has not been provided");
define ('_INSTALL_CONF_SITE_MAINTAIN', "'This site is down for maintenance.<br /> Please check back again soon.'");
define ('_INSTALL_CONF_SITE_UNAVAILABLE', "'This site is temporarily unavailable.<br /> Please notify the System Administrator'");
define ('_INSTALL_CONF_METADESC', "'Mambo - the dynamic portal engine and content management system'");
define ('_INSTALL_CONF_METAKEYS', "'mambo, Mambo, php, mysql, content, management'");
define ('_INSTALL_CONF_LANGUAGE_REF', "en_GB");
define ('_INSTALL_CHMOD_DIR', "<u>Information</u>: Directory permissions successfully changed.");
define ('_INSTALL_CHMOD_DIR_FAIL', "<u>Information</u>: Directory permissions could not be changed. Please CHMOD 0777 the following directories manually:<br />");
define ('_INSTALL_JS_CHECKURL', "The site url has not been provided");
define ('_INSTALL_CONGRATULATION', "Congratulations! " . _MAMBORS_VERSION . " is installed");
define ('_INSTALL_DESCRIPTION', "<p>Click the \"View Site\" button to start Mambo site or \"Administration\" to take you to administrator login.</p>");
define ('_INSTALL_LOGIN', "Administration Login Details");
define ('_INSTALL_ADMIN_USERNAME', "Username : admin");
define ('_INSTALL_ADMIN_PASSWORD', "Password : ");
define ('_INSTALL_VIEWSITE', "View Site");
define ('_INSTALL_LOGINADMIN', "Administration");
define ('_INSTALL_ALERT', 'Your configuration file or the directory is not writeable or another problem occured. Please copy following code (from "<?" till "?>"), create with your editor a file "configuration.php", paste those lines into, save and transfer this file with your FTP programm to the mainroot of your Mambo installation.<br /><strong>Due security reasons change the file permission with CHMOD to "0644"</strong>');

define ('_INSTALL_MAIL_DEL_INSTALLDIR','Attention: for your own security, please delete the installation directory, inclusive all files and directories within!!');
define ('_INSTALL_MAIL_DEL_INSTALLDIR_RENAME','Attantion: the directory "installation" was renamed to  " %s ". If you don\'t need at anymore, delete it as soon as possible!'); // +++++ new

?>
