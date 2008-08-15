<?php
/**
* @version $Id: english.php,v 3.0 2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

//administrator/components/com_mamhoo/admin.mamhoo.html.php
DEFINE('_MAMHOO','Mamhoo');
DEFINE('_MAMHOO_USER_MANAGE','Mamhoo User Manage');
DEFINE('_MAMHOO_DETAILS','Mamhoo User Details');
DEFINE('_MAMHOO_CORE_DETAILS','Core Details');
DEFINE('_MAMHOO_EXTENDED_DETAILS','Extended Details');
DEFINE('_MAMHOO_STORE_FAILED','store failed');
DEFINE('_MAMHOO_CONFIG',' Mamhoo User Extended Config ');
DEFINE('_MAMHOO_ABOUT',' About Mamhoo ');
DEFINE('_MAMHOO_LABEL','Label');
DEFINE('_MAMHOO_SHOW','Show');
DEFINE('_MAMHOO_TYPE','Type');
DEFINE('_MAMHOO_REQUIRED','Required');
DEFINE('_MAMHOO_SIZE','Size');
DEFINE('_MAMHOO_INITIAL','Initial Value');
DEFINE('_MAMHOO_ISREQUIRED',' is required!');

DEFINE('_MAMHOO_FILTER', 'Filter');
DEFINE('_MAMHOO_NB', '#');
DEFINE('_MAMHOO_USERS_NAME', 'Name');
DEFINE('_MAMHOO_USERS_USERNAME', 'Username');
DEFINE('_MAMHOO_USERS_LOG_IN', 'Logged In');
DEFINE('_MAMHOO_USERS_GROUP', 'Group');
DEFINE('_MAMHOO_USERS_EMAIL', 'E-mail');
DEFINE('_MAMHOO_USERS_REGISTER', 'Register Date');
DEFINE('_MAMHOO_USERS_LAST', 'Last Visit');
DEFINE('_MAMHOO_USERS_ENABLED', 'Enabled');
DEFINE('_MAMHOO_USERS_BLOCKED', 'Blocked');

DEFINE('_MAMHOO_USERS_NAME_MUST', 'You must provide a name.');
DEFINE('_MAMHOO_USERS_USERNAME_MUST', 'You must provide a user login name.');
DEFINE('_MAMHOO_USERS_USERNAME_INVALID', 'You login name contains invalid characters or is too short.');
DEFINE('_MAMHOO_USERS_EMAIL_MUST', 'You must provide an email address.');
DEFINE('_MAMHOO_USERS_ASSIGN', 'You must assign user to a group.');
DEFINE('_MAMHOO_USERS_NO_MATCH', 'Password do not match.');
DEFINE('_MAMHOO_EDIT', 'Edit');
DEFINE('_MAMHOO_NEW', 'New');
DEFINE('_MAMHOO_USERS_USERINFO', 'User Info');
DEFINE('_MAMHOO_USERS_PASS', 'New Password');
DEFINE('_MAMHOO_USERS_VERIFY', 'Verify Password');
DEFINE('_MAMHOO_USERS_BLOCK', 'Block User');
DEFINE('_MAMHOO_USERS_SUBMI', 'Receive Submission Emails');
DEFINE('_MAMHOO_USERS_REG_DATE', 'Register Date');
DEFINE('_MAMHOO_USERS_VISIT_DATE', 'Last Visit Date');

//administrator/components/com_mamhoo/admin.mamhoo.php
DEFINE('_MAMHOO_USERS_SUPER_ADMIN', 'Super Administrator');
DEFINE('_MAMHOO_ITEM_SEL_DEL', 'Select an item to delete');
DEFINE('_MAMHOO_SEL_ITEM', 'Select an item to');
DEFINE('_MAMHOO_USERS_CANNOT', 'You cannot delete a Super Administrator');
DEFINE('_MAMHOO_USERS_NOT_DEL_SELF', 'You cannot delete Yourself!');
DEFINE('_MAMHOO_USERS_NOT_DEL_ADMIN', 'You cannot delete another `Administrator` only `Super Administrators` have this power');
DEFINE('_MAMHOO_FLOGOUT_SUCC','Force Logout Successfully!');
DEFINE('_MAMHOO_SELECT_USER','Please select a user!');
DEFINE('_MAMHOO_CONFIG_SAVE',' Mamhoo Config Saved! ');

//administrator/components/com_mamhoo/toolbar.mamhoo.html.php
DEFINE('_MAMHOO_FLOGOUT','Force Logout');

//administrator/components/com_mamhoo/install.mamhoo.php
DEFINE('_MAMHOO_INST_UNINST_MAMHOOKS','Install/Uninstall Mamhooks');
DEFINE('_MAMHOO_USER_DETAILS','Your Mamhoo Details');
DEFINE('_MAMHOO_CHECK_IN','Mamhoo Check-In My Items');
DEFINE('_MAMHOO_COMPONENT','Mamhoo Component');
DEFINE('_MAMHOO_LICENSE','Copyright &copy; 2007 <a href="http://www.mamhoo.com/">mamhoo.com</a>, Mamhoo is free software, released under GNU/GPL license</a>.');
DEFINE('_MAMHOO_INST_SUCC','Installation: <font color="green">Succesful!</font>');
DEFINE('_MAMHOO_INST_DESC','The Installer has unpublished two usermenu items : the `Your Details` and the `Check-In My Items`');

//administrator/components/com_mamhoo/uninstall.mamhoo.php
DEFINE('_MAMHOO_UNINST_SUCC','Uninstallation: <font color="green">Succesful!</font>');
DEFINE('_MAMHOO_UNINST_DESC','The Uninstaller has published two usermenu items : the `Your Details` and the `Check-In My Items`');


//administrator/components/com_mamhoo/installer/mamhook.html.php
DEFINE('_MAMHOO_INSTALL_MAMHOOKS','Mamhooks');
DEFINE('_MAMHOO_INSTALL_CORE','Only those mamhooks that can be uninstalled are displayed - some Core mamhooks cannot be removed.');
DEFINE('_MAMHOO_INSTALL_MAMHOOK','Mamhook');
DEFINE('_MAMHOO_INSTALL_TYPE','Type');
DEFINE('_MAMHOO_INSTALL_AUTHOR','Author');
DEFINE('_MAMHOO_INSTALL_VERSION','Version');
DEFINE('_MAMHOO_INSTALL_DATE','Date');
DEFINE('_MAMHOO_INSTALL_AUTH_MAIL','Author Email');
DEFINE('_MAMHOO_INSTALL_AUTH_URL','Author URL');
DEFINE('_MAMHOO_INSTALL_NO_MAMHOOKS','There are no non-core, custom mamhooks installed.');
DEFINE('_MAMHOO_INSTALL_ADDON_CONFIG','Addon System Config');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX','Addon System Table Prefix');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH','Addon System Relative Path');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_EG',' ( e.g. phpbb_ )');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH_EG',' ( e.g. addons/phpbb2 )');
DEFINE('_MAMHOO_INSTALL_ADDON_NEXT','Next');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_REQUIRED','Addon System Table Prefix is required!');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_INVALID','Addon System Table Prefix is invalid!');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH_REQUIRED','Addon System Relative Path is required!');
DEFINE('_MAMHOO_INSTALL_ADDON_PATH_NOTEXIST','Addon System Path does not exist: ');

DEFINE('_MAMHOO_INSTALL_WRITABLE', 'Writeable');
DEFINE('_MAMHOO_INSTALL_UNWRITABLE', 'Unwriteable');
DEFINE('_MAMHOO_INSTALL_CONTINUE', 'Continue ...');
DEFINE('_MAMHOO_INSTALL_UPLOAD_PACK_FILE', 'Upload Package File');
DEFINE('_MAMHOO_INSTALL_PACK_FILE', 'Package File:');
DEFINE('_MAMHOO_INSTALL_UPL_INSTALL', 'Upload File &amp; Install');
DEFINE('_MAMHOO_INSTALL_FROM_DIR', 'Install from directory');
DEFINE('_MAMHOO_INSTALL_DIR', 'Install directory:');
DEFINE('_MAMHOO_INSTALL_DO_INSTALL', 'Install');

//administrator/components/com_mamhoo/installer/mamhook.php
DEFINE('_MAMHOO_INSTALL_INSTALL_MAMHOOK','Install Mamhook');

DEFINE('_MAMHOO_INSTALL_NOT_FOUND', 'Installer not found for mamhook ');
DEFINE('_MAMHOO_INSTALL_NOT_AVAIL', 'Installer not available for mamhook');
DEFINE('_MAMHOO_INSTALL_ENABLE_MSG', 'The installer can not continue before file uploads are enabled. Please use the install from directory method.');
DEFINE('_MAMHOO_INSTALL_ERROR_MSG_TITLE', 'Installer - Error');
DEFINE('_MAMHOO_INSTALL_ZLIB_MSG', 'The installer can not continue before zlib is installed');
DEFINE('_MAMHOO_INSTALL_NOFILE_MSG', 'No file selected');
DEFINE('_MAMHOO_INSTALL_NEWMODULE_ERROR_MSG_TITLE', 'Upload new module - error');
DEFINE('_MAMHOO_INSTALL_UPLOAD_PRE', 'Upload ');
DEFINE('_MAMHOO_INSTALL_UPLOAD_POST', ' - Upload Failed');
DEFINE('_MAMHOO_INSTALL_UPLOAD_POST2', ' -  Upload Error');
DEFINE('_MAMHOO_INSTALL_SUCCESS', 'Success');
DEFINE('_MAMHOO_INSTALL_ERROR', 'Error');
DEFINE('_MAMHOO_INSTALL_FAILED', 'Failed');
DEFINE('_MAMHOO_INSTALL_SELECT_DIR', 'Please select a directory');
DEFINE('_MAMHOO_INSTALL_UPLOAD_NEW', 'Upload new ');
DEFINE('_MAMHOO_INSTALL_FAIL_PERMISSION', 'Failed to change the permissions of the uploaded file.');
DEFINE('_MAMHOO_INSTALL_FAIL_MOVE', 'Failed to move uploaded file to <code>/media</code> directory.');
DEFINE('_MAMHOO_INSTALL_FAIL_WRITE', 'Upload failed as <code>/media</code> directory is not writable.');
DEFINE('_MAMHOO_INSTALL_FAIL_EXIST', 'Upload failed as <code>/media</code> directory does not exist.');

//administrator/components/com_mamhoo/installer/mamhook.class.php
DEFINE('_MAMHOO_INSTALL_MAMHOOK_CONFIG_EXISTS','Mamhook config file " %s " already exists!');
DEFINE('_MAMHOO_INSTALL_INC_CREATE_ERROR','Can not create inc file " %s "!');
DEFINE('_MAMHOO_INSTALL_INC_WRITE_ERROR','Can not write inc file " %s "!');
DEFINE('_MAMHOO_INSTALL_DIR_CREATE_ERROR','Failed to create directory " %s "!');
DEFINE('_MAMHOO_INSTALL_NO_MARKED','No file is marked as mamhook file');
DEFINE('_MAMHOO_INSTALL_SQL_ERROR','SQL error: ');
DEFINE('_MAMHOO_INSTALL_MAMHOOK_EXISTS','Mamhook " %s " already exists!');
DEFINE('_MAMHOO_INSTALL_UNINST_ERROR','Uninstall -  error');
DEFINE('_MAMHOO_INSTALL_FOLDER_EMPTY','Folder field empty, cannot remove files');
DEFINE('_MAMHOO_INSTALL_DELETING','<br />Deleting: ');
DEFINE('_MAMHOO_INSTALL_DELETING_XML','Deleting XML File: ');
DEFINE('_MAMHOO_INSTALL_CORE_NOT_UNINST',' is a core element, and cannot be uninstalled.<br />You need to unpublish it if you don\'t want to use it');
DEFINE('_MAMHOO_INSTALL_CHK_DIR_NOT_EXISTS','Directories not exist: <BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_DIR_NOT_WRITABLE','Directories not writable: <BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_FILE_NOT_EXISTS','Files not exist: <BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_FILE_NOT_WRITABLE','Files not writable: <BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CMD_OPENFIRST','Please process command "OPEN" first before command "%s" !');
DEFINE('_MAMHOO_INSTALL_CMD_FINDFIRST','Please process command "FIND" first before command "%s" !');
DEFINE('_MAMHOO_INSTALL_CMD_READERROR','Can not read file: "%s" !');
DEFINE('_MAMHOO_INSTALL_CMD_NOSEARCH','Nothing to search!');
DEFINE('_MAMHOO_INSTALL_CMD_NOMATCHED','File contents not matched : ');
DEFINE('_MAMHOO_INSTALL_CMD_CREATEERROR','Can not create file: "%s" !');
DEFINE('_MAMHOO_INSTALL_CMD_WRITEERROR','Can not write file: "%s" !');

//components/com_mamhoo/mamhoo.php
DEFINE('_MAMHOO_USER_NOT_EXISTS','User not exists!');

?>