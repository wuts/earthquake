<?php
/**
* @version $Id: admin_english_utf-8.php,v 1.9 2008/04/21 11:27:52 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2007 Mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software based on Mambo
* Powered By mambochina.net & mambors.org
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// Language and Encode of admin language
DEFINE('_A_LANGUAGE','en');
DEFINE('_A_ISO','charset=UTF-8');

// needed for $alt text in toolbar item
DEFINE('_A_CANCEL','Cancel'); 
DEFINE('_A_SAVE','Save');
DEFINE('_A_APPLY','Apply'); 
DEFINE('_A_CLOSE','Close');
DEFINE('_A_COPY','Copy');
DEFINE('_A_MOVE','Move');
DEFINE('_A_DELETE','Delete'); 
DEFINE('_A_NEXT','Next'); 
DEFINE('_A_BACK','Back'); 
DEFINE('_A_DEFAULT','Default'); 
DEFINE('_A_RESTORE','Restore'); 

/**
* @location /../includes/mambo.php
* @desc Includes translations of several droplists and non-translated stuff
*/

//Droplist
DEFINE('_A_TOP','Top');
DEFINE('_A_ALL','All');
DEFINE('_A_NONE','None');
DEFINE('_A_SELECT_IMAGE','Select Image');
DEFINE('_A_NO_USER','No User');
DEFINE('_A_CREATE_CAT','You must create a category first');
DEFINE('_A_PARENT_BROWSER_NAV','Parent Window With Browser Navigation');
DEFINE('_A_NEW_BROWSER_NAV','New Window With Browser Navigation');
DEFINE('_A_NEW_W_BROWSER_NAV','New Window Without Browser Navigation');

//Alt Hover
DEFINE('_A_PENDING','Pending');
DEFINE('_A_VISIBLE','Visible');
DEFINE('_A_FINISHED','Finished');
DEFINE('_A_MOVE_UP','Move Up');
DEFINE('_A_MOVE_DOWN','Move Down');


/**
* @desc Includes the main adminLanguage class which refers to var's for translations
*/
class adminLanguage {

var $RTLsupport = false;

var $A_MAIL = 'Mailbox';

//templates/mambo_admin_blue/login.php
var $A_USERNAME = 'Username';
var $A_PASSWORD = 'Password';
var $A_WELCOME_MAMBO = '<p>Welcome to Mambo!</p><p>Use a valid username and password to gain access to the administration console.</p>';
var $A_WARNING_JAVASCRIPT = '!Warning! Javascript must be enabled for proper operation of the Administrator';

//templates/mambo_admin_blue/index.php
var $A_LOGIN = 'Login';
var $A_GENERATE_TIME = 'Page was generated in %f seconds';
var $A_LOGOUT = 'Logout';

//popups/contentwindow.php
var $A_TITLE_CPRE = 'Content Preview';
var $A_CLOSE = 'Close';
var $A_PRINT = 'Print';

//popups/modulewindow.php
var $A_TITLE_MPRE = 'Module Preview';

//popups/pollwindow.php
var $A_TITLE_PPRE = 'Poll Preview';
var $A_VOTE = 'Vote';
var $A_RESULTS = 'Results';

//popups/uploadimage.php
var $A_TITLE_UPLOAD = 'Upload a file';
var $A_FILE_UPLOAD = 'File Upload';
var $A_UPLOAD = 'Upload';
var $A_FILE_MAX_SIZE = 'Max Size'; //Ken ADDED

//modules/mod_components.php
var $A_ERROR = 'Error!';

//modules/mod_fullmenu.php
var $A_MENU_HOME = 'Home';
var $A_MENU_HOME_PAGE = 'Home Page';
var $A_MENU_CTRL_PANEL = 'Control Panel'; //KEN ADDED
var $A_MENU_SITE = 'Site';
var $A_MENU_SITE_MENU = 'Site Menu';
var $A_MENU_SITE_MANAGEMENT = 'Site Management'; //KEN ADDED
var $A_MENU_CONFIGURATION = 'Configuration';
var $A_MENU_LANGUAGES = 'Languages';
var $A_MENU_MANAGE_LANG = 'Manage Languages';
var $A_MENU_LANG_MANAGE = 'Language Manager';
var $A_MENU_INSTALL = 'Install';
var $A_MENU_INSTALL_LANG = 'Install Languages';
var $A_MENU_MEDIA_MANAGE = 'Media Manager';
var $A_MENU_MANAGE_MEDIA = 'Manage Media Files';
var $A_MENU_PREVIEW = 'Preview';
var $A_MENU_NEW_WINDOW = 'In New Window';
var $A_MENU_INLINE = 'Inline';
var $A_MENU_INLINE_POS = 'Inline with Positions';
var $A_MENU_STATISTICS = 'Statistics';
var $A_MENU_STATISTICS_SITE = 'Site Statistics';
var $A_MENU_BROWSER = 'Browser, OS, Domain';
var $A_MENU_PAGE_IMP = 'Page Impressions';
var $A_MENU_SEARCH_TEXT = 'Search Text';
var $A_MENU_TEMP_MANAGE = 'Template Manager';
var $A_MENU_TEMP_CHANGE = 'Change site template';
var $A_MENU_INSTALL_TEMPLATES = 'Install Site Templates';//KEN ADDED
var $A_MENU_SITE_TEMP = 'Site Templates';
var $A_MENU_ADMIN_TEMP = 'Administrator Templates';
var $A_MENU_ADMIN_CHANGE_TEMP = 'Change admin template';
var $A_MENU_INSTALL_ADMIN_TEMPLATES = 'Install Administrator Templates';//KEN ADDED
var $A_MENU_MODUL_POS = 'Module Positions';
var $A_MENU_TEMP_POS = 'Template Positions';
var $A_MENU_USER_MANAGE = 'User Manager';
var $A_MENU_MANAGE_USER = 'Manage users';
var $A_MENU_ADD_EDIT = 'Add/Edit Users';
var $A_MENU_MASS_MAIL = 'Mass Mail';
var $A_MENU_MAIL_USERS = 'Send an e-mail to a register user group';
var $A_MENU_MANAGE_STR = 'Manage Site Structure';
var $A_MENU_MANAGEMENT = 'Menu Management';//KEN ADDED
var $A_MENU_CONTENT = 'Content';
var $A_MENU_CONTENT_MANAGE = 'Content Management';
var $A_MENU_CONTENT_MANAGERS = 'Content Managers';
var $A_MENU_CONTENT_BY_SECTION = 'Content by Section'; //KEN ADDED
var $A_MENU_MANAGE_CONTENT = 'Manage Content Items';
var $A_MENU_ITEMS = 'Items';
var $A_MENU_ADDNEDIT = 'Add/Edit';
var $A_MENU_OTHER_MANAGE = 'Other Managers';
var $A_MENU_ITEMS_FRONT = 'Manage Frontpage Items';
var $A_MENU_ITEMS_CONTENT = 'Manage Typed Content Items';
var $A_MENU_CONTENT_SEC = 'Manage Content Sections';
var $A_MENU_CONTENT_CAT = 'Manage Content Categories';
var $A_MENU_CATEGORIES = 'Categories';
var $A_MENU_COMPONENTS = 'Components';
var $A_MENU_COMPONENTS_MANAGEMENT = 'Component Management';
var $A_MENU_INST_UNST = 'Install/Uninstall';
var $A_MENU_INST_UNST_COMPONENTS = 'Install/Uninstall components';
var $A_MENU_MORE_COMP = 'More Components';
var $A_MENU_MORE_COMP2 = 'More Components...';//KEN ADDED
var $A_MENU_MODULES = 'Modules';
var $A_MENU_INST_UNST_MODULES = 'Install/Uninstall Modules';//KEN ADDED
var $A_MENU_MODULES_MANAGEMENT = 'Module Management'; //KEN ADDED
var $A_MENU_INSTALL_CUST = 'Install custom modules';
var $A_MENU_SITE_MOD = 'Site Modules';
var $A_MENU_SITE_MOD_MANAGE = 'Manage Site modules';
var $A_MENU_ADMIN_MOD = 'Administrator Modules';
var $A_MENU_ADMIN_MOD_MANAGE = 'Manage Administrator modules';
var $A_MENU_MAMBOTS = 'Mambots';
var $A_MENU_INST_UNST_MAMBOTS = 'Install/Uninstall Mambots';//KEN ADDED
var $A_MENU_MAMBOTS_MANAGE = 'Mambots Management'; //KEN ADDED
var $A_MENU_CUSTOM_MAMBOT = 'Install custom mambot';
var $A_MENU_SITE_MAMBOT = 'Site Mambot';
var $A_MENU_SITE_MAMBOTS = 'Site Mambots';
var $A_MENU_MAMBOT_MANAGE = 'Manage Site Mambots';
var $A_MENU_INSTALLERS = 'Installers';//KEN ADDED
var $A_MENU_INSTALLERS_LIST = 'Installers List';//KEN ADDED
var $A_MENU_TEMPLATES_SITE = 'Templates - Site';//KEN ADDED
var $A_MENU_TEMPLATES_SITE_INST = 'Install Site Templates';//KEN ADDED
var $A_MENU_TEMPLATES_ADMIN = 'Templates - Admin';//KEN ADDED
var $A_MENU_TEMPLATES_ADMIN_INST = 'Install Admin Templates';//KEN ADDED
var $A_MENU_MESSAGES = 'Messages';
var $A_MENU_MESSAGES_MANAGEMENT = 'Messaging Management';//KEN ADDED
var $A_MENU_INBOX = 'Inbox';
var $A_MENU_PRIV_MSG = 'Private Messages';
var $A_MENU_GLOBAL_CHECK = 'Global Checkin';
var $A_MENU_CHECK_INOUT = 'Check-in all checked-out items';
var $A_MENU_SYSTEM_INFO = 'System Info';
var $A_MENU_CLEAN_CACHE = 'Clean Cache';
var $A_MENU_CLEAN_CACHE_ITEMS = 'Clean the content items cache';
var $A_MENU_BIG_THANKS = 'A big thanks to those involved';
var $A_MENU_SUPPORT = 'Support';
var $A_MENU_SYSTEM = 'System';
var $A_MENU_SYSTEM_MNG = 'System Management';

//modules/mod_latest.php
var $A_LATEST_ADDED = 'Most Recently Added Content';

//modules/mod_logged.php
var $A_USER_LOGGED = 'Currently Logged in Users';
var $A_USER_FORCE_LOGOUT = 'Force Logout User';

//modules/mod_online.php
var $A_ONLINE_USERS = 'Users Online';

//modules/mod_popular.php
var $A_POPULAR_MOST = 'Most Popular Items';
var $A_CREATED = 'Created';
var $A_HITS = 'Hits';

//modules/mod_quickicon.php
var $A_MENU_MANAGER = 'Menu Manager';
var $A_FRONTPAGE_MANAGER = 'Frontpage Manager';
var $A_STATIC_MANAGER = 'Static Content Manager';
var $A_SECTION_MANAGER = 'Section Manager';
var $A_CATEGORY_MANAGER = 'Category Manager';
var $A_ALL_MANAGER = 'All Content Items';
var $A_GLOBAL_CONF = 'Global Configuration';
var $A_HELP = 'Help';

//includes/menubar.html.php
var $A_NEW = 'New';
var $A_PUBLISH = 'Publish';
var $A_DEFAULT = 'Default';
var $A_ASSIGN = 'Assign';
var $A_UNPUBLISH = 'Unpublish';
var $A_EDIT = 'Edit';
var $A_DELETE = 'Delete';
var $A_SAVE = 'Save';
var $A_BACK = 'Back';
var $A_CANCEL = 'Cancel';

//Alerts
var $A_ALERT_SELECT_TO = 'Please make a selection from the list to';
var $A_ALERT_SELECT_PUB = 'Please make a selection from the list to publish';
var $A_ALERT_SELECT_PUB_LIST = 'Please select an item to make default';
var $A_ALERT_ITEM_ASSIGN = 'Please select an item to assign';
var $A_ALERT_SELECT_UNPUBLISH = 'Please make a selection from the list to unpublish';
var $A_ALERT_SELECT_EDIT = 'Please select an item from the list to edit';
var $A_ALERT_SELECT_DELETE = 'Please make a selection from the list to delete';
var $A_ALERT_CONFIRM_DELETE = 'Are you sure you want to delete selected items?';

//Alerts
var $A_ALERT_ENTER_PASSWORD = 'Please enter a password'; 
var $A_ALERT_INCORRECT = 'Incorrect Username, Password, or Access Level.  Please try again';
var $A_ALERT_INCORRECT_TRY = 'Incorrect Username and Password, please try again';
var $A_ALERT_ALPHA = 'File must only contain alphanumeric characters and no spaces please.';
var $A_ALERT_IMAGE_UPLOAD = 'Please select an image to upload';
var $A_ALERT_IMAGE_EXISTS = "Image %s already exists.";
var $A_ALERT_IMAGE_FILENAME = 'The file must be gif, png, jpg, bmp, swf, doc, xls or ppt';
var $A_ALERT_UPLOAD_FAILED = "Upload of %s failed";
var $A_ALERT_UPLOAD_SUC = "Upload of %s to %s successful";
var $A_ALERT_UPLOAD_SUC2 = "Upload of %s to %s successful";

//includes/pageNavigation.php
var $A_OF = 'of'; 
var $A_NO_RECORD_FOUND = 'No records found';
var $A_FIRST_PAGE = 'first page';
var $A_PREVIOUS_PAGE = 'previous page';
var $A_NEXT_PAGE = 'next page';
var $A_END_PAGE = 'end page';
var $A_PREVIOUS = 'Previous';
var $A_NEXT = 'Next';
var $A_END = 'End';
var $A_DISPLAY = 'Display';
var $A_MOVE_UP = 'Move Up';
var $A_MOVE_DOWN = 'Move Down';

//DIRECTORY COMPONENTS ALL FILES
var $A_COMP_CHECKED_OUT = 'Checked Out';
var $A_COMP_TITLE = 'Title';
var $A_COMP_IMAGE = 'Image';
var $A_COMP_FRONT_PAGE = 'Front Page';
var $A_COMP_IMAGE_POSITION = 'Image Position';
var $A_COMP_FILTER = 'Filter';
var $A_COMP_ORDERING = 'Ordering';
var $A_COMP_ACCESS_LEVEL = 'Access Level';
var $A_COMP_PUBLISHED = 'Published';
var $A_COMP_PUBLISH = 'Publish';
var $A_COMP_UNPUBLISHED = 'UnPublished';
var $A_COMP_UNPUBLISH = 'UnPublish';
var $A_COMP_REORDER = 'Reorder';
var $A_COMP_ORDER = 'Order';
var $A_COMP_SAVE_ORDER = 'Save Order';
var $A_COMP_ACCESS = 'Access';
var $A_COMP_SECTION = 'Section';
var $A_COMP_NB = '#';
var $A_COMP_ACTIVE = '# Active';
var $A_COMP_DESCRIPTION = 'Description';
var $A_COMP_SELECT_MENU_TYPE = 'Please select a menu type';
var $A_COMP_ENTER_MENU_NAME = 'Please enter a Name for this menu item';
var $A_COMP_CREATE_MENU_LINK = 'Are you sure you want to create a menu link? \nAny unsaved changes to this content will be lost.';
var $A_COMP_LINK_TO_MENU = 'Link to Menu';
var $A_COMP_CREATE_MENU = 'This will create a new menu item in the menu you select';
var $A_COMP_SELECT_MENU = 'Select a Menu';
var $A_COMP_MENU_TYPE_SELECT = 'Select Menu Type';
var $A_COMP_MENU_NAME_ITEM = 'Menu Item Name';
var $A_COMP_MENU_LINKS = 'Existing Menu Links';
var $A_COMP_MENU_LINKS_AVAIL = 'Menu links available when saved';
var $A_COMP_NONE = 'None';
var $A_COMP_MENU = 'Menu';
var $A_COMP_TYPE = 'Type';
var $A_COMP_EDIT = 'Edit';
var $A_COMP_NEW = 'New';
var $A_COMP_ADD = 'Add';
var $A_COMP_ITEM_NAME = 'Item Name';
var $A_COMP_STATE = 'State';
var $A_COMP_NAME = 'Name';
var $A_COMP_DEFAULT = 'Default';
var $A_COMP_CATEG = 'Category';
var $A_COMP_LINK_USER = 'Linked to User';
var $A_COMP_CONTACT = 'Contact';
var $A_COMP_EMAIL = 'E-mail';
var $A_COMP_PREVIEW = 'Preview';
var $A_COMP_ITEMS = 'items';
var $A_COMP_ITEM = 'item';
var $A_COMP_ID = 'ID';
var $A_COMP_EXPIRED = 'Expired';
var $A_COMP_YES = 'Yes';
var $A_COMP_NO = 'No';
var $A_COMP_EDITING = 'Editing';
var $A_COMP_ADDING = 'Adding';
var $A_COMP_HITS = 'Hits';
var $A_COMP_SOURCE = 'Source';
var $A_COMP_SEL_ITEM = 'Select an item to';
var $A_COMP_DATE = 'Date';
var $A_COMP_AUTHOR = 'Author';
var $A_COMP_ANOTHER_ADMIN = 'is currently being edited by another administrator';
var $A_COMP_SAVE_UNWRT = 'Make unwriteable after saving';
var $A_COMP_OVERRIDE_SAVE = 'Override write protection while saving';
var $A_COMP_ORDER_SAVED = 'New ordering saved';
var $A_COMP_NO_PARAMETERS = 'No Parameters';
var $A_COMP_POSITION = 'Position';
var $A_COMP_SHOW_ADV_DETAILS = 'Show Advanced Details';
var $A_COMP_HIDE_ADV_DETAILS = 'Hide Advanced Details';

//components/com_admin/admin.admin.html.php
var $A_COMP_ADMIN_HOME = 'Home';
var $A_COMP_ADMIN_SIMP_MODE = 'Simple Mode';
var $A_COMP_ADMIN_SIMP_MODE_SELECTED = 'Simple Mode (selected)';
var $A_COMP_ADMIN_SIMP_MODE_UNSELECTED = 'Simple Mode (unselected)';
var $A_COMP_ADMIN_ADV_MODE = 'Advanced Mode';
var $A_COMP_ADMIN_ADV_MODE_SELECTED = 'Advanced Mode (selected)';
var $A_COMP_ADMIN_ADV_MODE_UNSELECTED = 'Advanced Mode (unselected)';
//var $A_COMP_ADMIN_TITLE = 'Control Panel';
var $A_COMP_ADMIN_INFO = 'Information';
var $A_COMP_ADMIN_SYSTEM = 'System Information';
var $A_COMP_ADMIN_PHP_BUILT_ON = 'PHP built On:';
var $A_COMP_ADMIN_DB = 'Database Version:';
var $A_COMP_ADMIN_PHP_VERSION = 'PHP Version:';
var $A_COMP_ADMIN_SERVER = 'Web Server:';
var $A_COMP_ADMIN_SERVER_TO_PHP = 'WebServer to PHP interface:';
var $A_COMP_ADMIN_MAMBO_VERSION = 'Mambo Version:';
var $A_COMP_ADMIN_AGENT = 'User Agent:';
var $A_COMP_ADMIN_SETTINGS = 'Relevant PHP Settings:';
var $A_COMP_ADMIN_MODE = 'Safe Mode:';
var $A_COMP_ADMIN_BASEDIR = 'Open basedir:';
var $A_COMP_ADMIN_ERRORS = 'Display Errors:';
var $A_COMP_ADMIN_OPEN_TAGS = 'Short Open Tags:';
var $A_COMP_ADMIN_FILE_UPLOADS = 'File Uploads:';
var $A_COMP_ADMIN_QUOTES = 'Magic Quotes:';
var $A_COMP_ADMIN_REG_GLOBALS = 'Register Globals:';
var $A_COMP_ADMIN_OUTPUT_BUFF = 'Output Buffering:';
var $A_COMP_ADMIN_S_SAVE_PATH = 'Session save path:';
var $A_COMP_ADMIN_S_AUTO_START = 'Session auto start:';
var $A_COMP_ADMIN_XML = 'XML enabled:';
var $A_COMP_ADMIN_ZLIB = 'Zlib enabled:';
var $A_COMP_ADMIN_DISABLED = 'Disabled Functions:';
var $A_COMP_ADMIN_WYSIWYG = 'WYSIWYG Editor:';
var $A_COMP_ADMIN_CONF_FILE = 'Configuration File:';
var $A_COMP_ADMIN_PHP_INFO2 = 'PHP Info';
var $A_COMP_ADMIN_PHP_INFO = 'PHP Information';
var $A_COMP_ADMIN_PERMISSIONS='Permissions';
var $A_COMP_ADMIN_DIR_PERM = 'Directory Permissions';
var $A_COMP_ADMIN_FOR_ALL = 'For all Mambo functions and features to work ALL of the following directories should be writeable:';
var $A_COMP_ADMIN_CREDITS = 'Credits';
var $A_COMP_ADMIN_APP = 'Application';
var $A_COMP_ADMIN_URL = 'URL';
var $A_COMP_ADMIN_VERSION = 'Version';
var $A_COMP_ADMIN_LICENSE = 'License';
var $A_COMP_ADMIN_CALENDAR = 'Calendar';
var $A_COMP_ADMIN_PUB_DOMAIN = 'Public Domain';
var $A_COMP_ADMIN_ICONS = 'Icons';
var $A_COMP_ADMIN_INDEX = 'Index';
var $A_COMP_ADMIN_SITE_PREVIEW = 'Site Preview';
var $A_COMP_ADMIN_OPEN_NEW_WIN = 'Open in new window';

//components/com_admin/admin.admin.php
var $A_COMP_ALERT_NO_LINK = 'There is no link associated with this item';

//components/com_banners/admin.banners.html.php
var $A_COMP_BANNERS_MANAGER = 'Banner Manager';
var $A_COMP_BANNERS_NAME = 'Banner Name';
var $A_COMP_BANNERS_IMPRESS_MADE = 'Impressions Made';
var $A_COMP_BANNERS_IMPRESS_LEFT = 'Impressions Left';
var $A_COMP_BANNERS_CLICKS = 'Clicks';
var $A_COMP_BANNERS_CLICKS2 = '% Clicks';
var $A_COMP_BANNERS_PUBLISHED = 'Published';
var $A_COMP_BANNERS_LOCK = 'Checked Out';
var $A_COMP_BANNERS_PROVIDE = 'You must provide a banner name.';
var $A_COMP_BANNERS_SELECT_IMAGE = 'Please select an image.';
var $A_COMP_BANNERS_FILL_URL = 'Please fill in the URL for the banner.';
var $A_COMP_BANNERS_BANNER = 'Banner';
var $A_COMP_BANNERS_DETAILS = 'Details';
var $A_COMP_BANNERS_CLIENT = 'Client Name';
var $A_COMP_BANNERS_PURCHASED = 'Impressions Purchased';
var $A_COMP_BANNERS_UNLIMITED = 'Unlimited';
var $A_COMP_BANNERS_URL = 'Banner URL';
var $A_COMP_BANNERS_SHOW = 'Show Banner';
var $A_COMP_BANNERS_CLICK_URL = 'Click URL';
var $A_COMP_BANNERS_CUSTOM = 'Custom banner code';
var $A_COMP_BANNERS_RESET_CLICKS = 'Reset Clicks';
var $A_COMP_BANNERS_IMAGE = 'Banner Image';
var $A_COMP_BANNERS_CLIENT_MANAGER = 'Banner Client Manager';
var $A_COMP_BANNERS_NO_ACTIVE = 'No. of Active Banners';
var $A_COMP_BANNERS_FILL_CL_NAME = 'Please fill in the Client Name.';
var $A_COMP_BANNERS_FILL_CO_NAME = 'Please fill in the Contact Name.';
var $A_COMP_BANNERS_FILL_CO_EMAIL = 'Please fill in the Contact Email.';
var $A_COMP_BANNERS_TITLE_CLIENT = 'Banner Client';
var $A_COMP_BANNERS_CONTACT_NAME = 'Contact Name';
var $A_COMP_BANNERS_CONTACT_EMAIL = 'Contact Email';
var $A_COMP_BANNERS_EXTRA = 'Extra Info';

//components/com_banners/admin.banners.php
var $A_COMP_BANNERS_SELECT_CLIENT = 'Select Client';
var $A_COMP_BANNERS_THE_CLIENT = 'The client [ ';
var $A_COMP_BANNERS_EDITED = ' ] is currently being edited by another administrator.';
var $A_COMP_BANNERS_DEL_CLIENT = 'Cannot delete client at this time as they have a banner still running';

//components/com_categories/admin.categories.html.php
var $A_COMP_CATEG_MANAGER = 'Category Manager <small><small>[ Content: All ]</small></small>';
var $A_COMP_CATEG_CATEGS = 'Category Manager <small><small>[ %s ]</small></small>';
var $A_COMP_CATEG_NAME = 'Category Name';
var $A_COMP_CATEG_ID = 'Category ID';
var $A_COMP_CATEG_MUST_NAME = 'Category must have a name';
var $A_COMP_CATEG_DETAILS = 'Category Details';
var $A_COMP_CATEG_TITLE = 'Category Title';
var $A_COMP_CATEG_TABLE = 'Category Table';
var $A_COMP_CATEG_BLOG = 'Category Blog';
var $A_COMP_CATEG_MESSAGE = 'The category';
var $A_COMP_CATEG_MESSAGE2 = 'is currently being edited by another administrator';
var $A_COMP_CATEG_MOVE = 'Move Category';
var $A_COMP_CATEG_MOVE_TO_SECTION = 'Move to Section';
var $A_COMP_CATEG_BEING_MOVED = 'Categories being moved';
var $A_COMP_CATEG_CONTENT = 'Content Items being moved';
var $A_COMP_CATEG_MOVE_CATEG = 'This will move the Categories listed';
var $A_COMP_CATEG_ALL_ITEMS = 'and all the items within the category (also listed)';
var $A_COMP_CATEG_TO_SECTION = 'to the selected Section.';
var $A_COMP_CATEG_COPY = 'Copy Category';
var $A_COMP_CATEG_COPY_TO_SECTION = 'Copy to Section';
var $A_COMP_CATEG_BEING_COPIED = 'Categories being copied';
var $A_COMP_CATEG_ITEMS_COPIED = 'Content Items being copied';
var $A_COMP_CATEG_COPY_CATEGS = 'This will copy the Categories listed';

//components/com_categories/admin.categories.php
var $A_COMP_CATEG_DELETE = 'Select a category to delete';
var $A_COMP_CATEG_CATEG_S = 'Category(s)';
var $A_COMP_CATEG_CANNOT_REMOVE = 'cannot be removed as they contain records';
var $A_COMP_CATEG_SELECT = 'Select a category to';
var $A_COMP_CATEG_ITEM_MOVE = 'Select an item to move';
var $A_COMP_CATEG_MOVED_TO = 'Categories moved to';
var $A_COMP_CATEG_COPY_OF = 'Copy of';
var $A_COMP_CATEG_COPIED_TO = 'Categories copied to';
var $A_COMP_CATEG_SELECT_TYPE = 'Select Type';
var $A_COMP_CATEG_CONTACT_CATEG_TABLE = 'Contact Category Table';
var $A_COMP_CATEG_NEWSFEED_CATEG_TABLE = 'Newsfeed Category Table';
var $A_COMP_CATEG_WEBLINK_CATEG_TABLE = 'Weblink Category Table';
var $A_COMP_CATEG_CONTENT_CATEG_TABLE = 'Content Category Table';
var $A_COMP_CATEG_CONTENT_CATEG_BLOG = 'Content Category Blog';

//components/com_checkin/admin.checkin.php
var $A_COMP_CHECK_TITLE = 'Global Check-in';
var $A_COMP_CHECK_DB_T = 'Database Table';
var $A_COMP_CHECK_NB_ITEMS = '# of Items';
var $A_COMP_CHECK_IN = 'Checked-In';
var $A_COMP_CHECK_TABLE = 'Checking table';
var $A_COMP_CHECK_DONE = 'Checked out items have now been all checked in';

//components/com_config/admin.config.html.php
var $A_COMP_CONF_GC = 'Global Configuration';
var $A_COMP_CONF_IS = 'is';
var $A_COMP_CONF_WRT = 'Writeable';
var $A_COMP_CONF_UNWRT = 'Unwriteable';
//var $A_COMP_CONF_SITE_PAGE = 'site-page';
var $A_COMP_CONF_OFFLINE = 'Site Offline';
var $A_COMP_CONF_OFFMESSAGE = 'Offline Message';
var $A_COMP_CONF_OFFMESSAGE_TIP = 'A message that displays if your site is offline';
var $A_COMP_CONF_ERR_MESSAGE = 'System Error Message';
var $A_COMP_CONF_ERR_MESSAGE_TIP = 'A message that displays if Mambo could not connect to the database';
var $A_COMP_CONF_SITE_NAME = 'Site Name';
var $A_COMP_CONF_UN_LINKS = 'Show UnAuthorized Links';
var $A_COMP_CONF_UN_LINKS_TIP = 'If yes, will show links to content to registered content even if you are not logged in.  The user will need to login to see the item in full.';
var $A_COMP_CONF_USER_REG = 'Allow User Registration';
var $A_COMP_CONF_USER_REG_TIP = 'If yes, allows users to self-register';
var $A_COMP_CONF_AC_ACT = 'Use New Account Activation';
var $A_COMP_CONF_AC_ACT_TIP = 'If yes, the user will be mailed a link to activate their account before they can log in.';
var $A_COMP_CONF_REQ_EMAIL = 'Require Unique Email';
var $A_COMP_CONF_REQ_EMAIL_TIP = 'If yes, users cannot share the smae email address';
var $A_COMP_CONF_REG_SUBMIT = 'Allow Registered Submit Content';
var $A_COMP_CONF_REG_SUBMIT_TIP = 'If yes, allows Registered users to submit content in frontend';
var $A_COMP_CONF_DEBUG = 'Debug Site';
var $A_COMP_CONF_DEBUG_TIP = 'If yes, displays diagnostic information and SQL errors if present';
var $A_COMP_CONF_EDITOR = 'WYSIWYG Editor';
var $A_COMP_CONF_LENGTH = 'List Length';
var $A_COMP_CONF_LENGTH_TIP = 'Sets the default length of lists in the administrator for all users';
var $A_COMP_CONF_SITE_ICON = 'Favorites Site Icon';
var $A_COMP_CONF_SITE_ICON_TIP = 'If left blank or the file cannot be found, the default favicon.ico will be used.';
//var $A_COMP_CONF_LOCAL_PG = 'Locale-page';
var $A_COMP_CONF_LOCALE = 'Locale';
var $A_COMP_CONF_LANG = 'Frontend Language';
var $A_COMP_CONF_ALANG = 'Backend Language';
var $A_COMP_CONF_TIME_SET = 'Time Offset';
var $A_COMP_CONF_DATE = 'Current date/time configured to display';
var $A_COMP_CONF_LOCAL = 'Country Locale';
//var $A_COMP_CONF_CONT_PAGE = 'content-page';
var $A_COMP_CONF_CONTROL = '* These Parameters control Output elments *';
var $A_COMP_CONF_LINK_TITLES = 'Linked Titles';
var $A_COMP_CONF_MORE_LINK = 'Read More Link';
var $A_COMP_CONF_MORE_LINK_TIP = 'If set to show, the read-more link will show if main-text has been provided for the item';
var $A_COMP_CONF_RATE_VOTE = 'Item Rating/Voting';
var $A_COMP_CONF_RATE_VOTE_TIP = 'If set to show, a voting system will be enabled for content items';
var $A_COMP_CONF_AUTHOR = 'Author Names';
var $A_COMP_CONF_AUTHOR_TIP = 'If set to show, the name of the author will be displayed.  This a global setting but can be changed at menu and item levels.';
var $A_COMP_CONF_CREATED = 'Created Date and Time';
var $A_COMP_CONF_CREATED_TIP = 'If set to show, the date and time an item was created will be displayed. This a global setting but can be changed at menu and item levels.';
var $A_COMP_CONF_MOD_DATE = 'Modified Date and Time';
var $A_COMP_CONF_MOD_DATE_TIP = 'If set to show, the date and time an item was last modified will be displayed.  This a global setting but can be changed at menu and item levels.';
var $A_COMP_CONF_HITS = 'Hits';
var $A_COMP_CONF_HITS_TIP = 'If set to show, the hits for a particular item will be displayed.  This a global setting but can be changed at menu and item levels.';
var $A_COMP_CONF_PDF = 'PDF Icon';
var $A_COMP_CONF_OPT_MEDIA = 'Option not available as /media directory not writable';
var $A_COMP_CONF_PRINT_ICON = 'Print Icon';
var $A_COMP_CONF_EMAIL_ICON = 'Email Icon';
var $A_COMP_CONF_ICONS = 'Icons';
var $A_COMP_CONF_USE_OR_TEXT = 'Print, PDF & Email will utilise Icons or Text';
var $A_COMP_CONF_TBL_CONTENTS = 'Table of Contents on multi-page items';
var $A_COMP_CONF_BACK_BUTTON = 'Back Button';
var $A_COMP_CONF_CONTENT_NAV = 'Content Item Navigation';
var $A_COMP_CONF_HYPER = 'Use hyperlinked titles';
//var $A_COMP_CONF_DB_PAGE = 'db-page';
var $A_COMP_CONF_HOSTNAME = 'Hostname';
var $A_COMP_CONF_DB_USERNAME = 'Username';
var $A_COMP_CONF_DB_PW = 'Password';
var $A_COMP_CONF_DB_NAME = 'Database';
var $A_COMP_CONF_DB_PREFIX = 'Database Prefix';
//Svar $A_COMP_CONF_S_PAGE = 'server-page';
var $A_COMP_CONF_ABS_PATH = 'Absolute Path';
var $A_COMP_CONF_LIVE = 'Live Site';
var $A_COMP_CONF_SECRET = 'Secret Word';
var $A_COMP_CONF_GZIP = 'GZIP Page Compression';
var $A_COMP_CONF_CP_BUFFER = 'Compress buffered output if supported';
var $A_COMP_CONF_SESSION_TIME = 'Login Session Lifetime';
var $A_COMP_CONF_SEC = 'seconds';
var $A_COMP_CONF_AUTO_LOGOUT = 'Auto logout after this time of inactivity';
var $A_COMP_CONF_ERR_REPORT = 'Error Reporting';
var $A_COMP_CONF_REG_GLOBALS_EMU = 'Register Globals Emulation:';
var $A_COMP_CONF_REG_GLOBALS_EMU_DESC = 'Register globals emulation. Some components may stop working if this option is set to Off.';
var $A_COMP_CONF_HELP_SERVER = 'Help Server';
var $A_COMP_CONF_FILE_CREATION = 'File Creation';
var $A_COMP_CONF_FILE_PERM = 'File Permissions';
var $A_COMP_CONF_FILE_DONT_CHMOD = 'Dont CHMOD new files (use server defaults)';
var $A_COMP_CONF_FILE_CHMOD = 'CHMOD new files';
var $A_COMP_CONF_FILE_CHMOD_TIP = 'Select this option to define permission flags for new created files';
var $A_COMP_CONF_APPLY_FILE = 'Apply to existing files';
var $A_COMP_CONF_APPLY_FILE_TIP = 'Checking here will apply the permission flags to <em>all existing files</em> of the site.<br/><b>INAPPROPRIATE USAGE OF THIS OPTION MAY RENDER THE SITE INOPERATIVE!</b>';
var $A_COMP_CONF_DIR_CREATION = 'Directory Creation';
var $A_COMP_CONF_DIR_PERM = 'Directory Permissions';
var $A_COMP_CONF_DIR_DONT_CHMOD = 'Dont CHMOD new directories (use server defaults)';
var $A_COMP_CONF_DIR_CHMOD = 'CHMOD new directories';
var $A_COMP_CONF_DIR_CHMOD_TIP = 'Select this option to define permission flags for new created directories';
var $A_COMP_CONF_APPLY_DIR = 'Apply to existing directories';
var $A_COMP_CONF_APPLY_DIR_TIP = 'Checking here will apply the permission flags to <em>all existing directories</em> of the site.<br/><b>INAPPROPRIATE USAGE OF THIS OPTION MAY RENDER THE SITE INOPERATIVE!</b>';
var $A_COMP_CONF_USER = 'User';
var $A_COMP_CONF_GROUP = 'Group';
var $A_COMP_CONF_WORLD = 'World';
var $A_COMP_CONF_READ = 'read';
var $A_COMP_CONF_WRITE = 'write';
var $A_COMP_CONF_EXECUTE = 'execute';
var $A_COMP_CONF_SEARCH = 'search';
//var $A_COMP_CONF_META_PAGE = 'metadata-page';
var $A_COMP_CONF_META_DESC = 'Global Site Meta Description';
var $A_COMP_CONF_META_KEY = 'Global Site Meta Keywords';
var $A_COMP_CONF_META_TITLE = 'Show Title Meta Tag';
var $A_COMP_CONF_META_ITEMS = 'Show the title meta tag when viewing content items';
var $A_COMP_CONF_META_AUTHOR = 'Show Author Meta Tag';
var $A_COMP_CONF_META_AUTHOR_TIP = 'Show the author meta tag when viewing content items';
//var $A_COMP_CONF_MAIL_PAGE = 'mail-page';
var $A_COMP_CONF_MAIL = 'Mailer';
var $A_COMP_CONF_MAIL_FROM = 'Mail From';
var $A_COMP_CONF_MAIL_FROM_NAME = 'From Name';
var $A_COMP_CONF_MAIL_SENDMAIL_PATH = 'Sendmail Path';
var $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP Auth';
var $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP User';
var $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP Pass';
var $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Host';
//var $A_COMP_CONF_CACHE_PAGE = 'cache-page';
var $A_COMP_CONF_CACHE = 'Caching';
var $A_COMP_CONF_CACHE_FOLDER = 'Cache Folder';
var $A_COMP_CONF_CACHE_DIR = 'Current cache is directory is';
var $A_COMP_CONF_CACHE_DIR_UNWRT = 'The cache directory is UNWRITEABLE - please set this directory to CHMOD755 before turning on the cache';
var $A_COMP_CONF_CACHE_TIME = 'Cache Time';
//var $A_COMP_CONF_STATS_PAGE = 'stats-page';
var $A_COMP_CONF_STATS = 'Statistics';
var $A_COMP_CONF_STATS_ENABLE = 'Enable/disable collection of site statistics';
var $A_COMP_CONF_STATS_LOG_HITS = 'Log Content Hits by Date';
var $A_COMP_CONF_STATS_WARN_DATA = 'WARNING : Large amounts of data will be collected';
var $A_COMP_CONF_STATS_LOG_SEARCH = 'Log Search Strings';
//var $A_COMP_CONF_SEO_PAGE = 'seo-page';
var $A_COMP_CONF_SEO_LBL = 'SEO';
var $A_COMP_CONF_SEO = 'Search Engine Optimization';
var $A_COMP_CONF_SEO_SEFU = 'Search Engine Friendly URLs';
var $A_COMP_CONF_SEO_APACHE = 'Apache only! Rename htaccess.txt to .htaccess before activating';
var $A_COMP_CONF_SEO_DYN = 'Dynamic Page Titles';
var $A_COMP_CONF_SEO_DYN_TITLE = 'Dynamically changes the page title to reflect current content viewed';
var $A_COMP_CONF_SERVER = 'Server';
var $A_COMP_CONF_METADATA = 'Metadata';
var $A_COMP_CONF_EMAIL = 'Mail';
var $A_COMP_CONF_CACHE_TAB = 'Cache';

//components/com_config/admin.config.php
var $A_COMP_CONF_HIDE = 'Hide';
var $A_COMP_CONF_SHOW = 'Show';
var $A_COMP_CONF_DEFAULT = 'System Default';
var $A_COMP_CONF_NONE = 'None';
var $A_COMP_CONF_SIMPLE = 'Simple';
var $A_COMP_CONF_MAX = 'Maximum';
var $A_COMP_CONF_MAIL_FC = 'PHP mail function';
var $A_COMP_CONF_SEND = 'Sendmail';
var $A_COMP_CONF_SMTP = 'SMTP Server';
var $A_COMP_CONF_UPDATED = 'The Configuration Details have been updated!';
var $A_COMP_CONF_ERR_OCC = 'An Error Has Occurred! Unable to open config file to write!';

//components/com_contact/admin.contact.html.php
var $A_COMP_CONT_MANAGER = 'Contact Manager';
var $A_COMP_CONT_FILTER = 'Filter';
var $A_COMP_CONT_YOUR_NAME = 'You must provide a name.';
var $A_COMP_CONT_CATEG = 'Please select a Category.';
var $A_COMP_CONT_DETAILS = 'Contact Details';
var $A_COMP_CONT_POSITION = 'Contact\'s Position';
var $A_COMP_CONT_ADDRESS = 'Street Address';
var $A_COMP_CONT_TOWN = 'Town/Suburb';
var $A_COMP_CONT_STATE = 'State/County';
var $A_COMP_CONT_COUNTRY = 'Country';
var $A_COMP_CONT_POSTAL_CODE = 'Postal Code/ZIP';
var $A_COMP_CONT_TEL = 'Telephone';
var $A_COMP_CONT_FAX = 'Fax';
var $A_COMP_CONT_INFO = 'Miscellaneous Info';
//var $A_COMP_CONT_PUBLISH = 'publish-page';
var $A_COMP_CONT_PUBLISHING = 'Publishing Info';
var $A_COMP_CONT_SITE_DEFAULT = 'Site Default';
//var $A_COMP_CONT_IMG_PAGE = 'images-page';
var $A_COMP_CONT_IMG_INFO = 'Image Info';
var $A_COMP_CONT_PARAMS = 'params-page';
var $A_COMP_CONT_PARAMETERS = 'Parameters';
var $A_COMP_CONT_PARAM_MESS = '* These Parameters only control what you see when you click to view a Contact item *';
var $A_COMP_CONT_PUB_TAB = 'Publishing';
var $A_COMP_CONT_IMG_TAB = 'Images';

//components/com_contact/admin.contact.php
var $A_COMP_CONT_SELECT_REC = 'Select a record to';

//components/com_content/admin.content.html.php
var $A_COMP_CONTENT_ITEMS_MNG = 'Content Items Manager';
var $A_COMP_CONTENT_ALL_ITEMS = 'All Content Items';
var $A_COMP_CONTENT_START_ALWAYS = 'Start: Always';
var $A_COMP_CONTENT_START = 'Start';
var $A_COMP_CONTENT_FIN_NOEXP = 'Finish: No Expiry';
var $A_COMP_CONTENT_FINISH = 'Finish';
var $A_COMP_CONTENT_PUBLISH_INFO = 'Publish Information';
var $A_COMP_CONTENT_MANAGER = 'Manager';
var $A_COMP_CONTENT_ZERO = 'Are you sure you want to reset the Hits to Zero? \nAny unsaved changes to this content will be lost.';
var $A_COMP_CONTENT_MUST_TITLE = 'Content item must have a title';
var $A_COMP_CONTENT_MUST_NAME = 'Content item must have a name';
var $A_COMP_CONTENT_MUST_SECTION = 'You must select a Section.';
var $A_COMP_CONTENT_MUST_CATEG = 'You must select a Category.';
var $A_COMP_CONTENT_ITEMS = 'Content Items';
var $A_COMP_CONTENT_IN = 'content in';
var $A_COMP_CONTENT_TITLE_ALIAS = 'Title Alias';
var $A_COMP_CONTENT_ITEM_DETAILS = 'Item Details';
var $A_COMP_CONTENT_INTRO = 'Intro Text: (required)';
var $A_COMP_CONTENT_MAIN = 'Main Text: (optional)';
var $A_COMP_CONTENT_PUB_INFO = 'Publishing Info';
var $A_COMP_CONTENT_FRONTPAGE = 'Show on Frontpage';
var $A_COMP_CONTENT_AUTHOR = 'Author Alias';
var $A_COMP_CONTENT_CREATOR = 'Change Creator';
var $A_COMP_CONTENT_OVERRIDE = 'Override Created Date';
var $A_COMP_CONTENT_START_PUB = 'Start Publishing';
var $A_COMP_CONTENT_FINISH_PUB = 'Finish Publishing';
var $A_COMP_CONTENT_ID = 'Content ID';
var $A_COMP_CONTENT_DRAFT_UNPUB = 'Draft Unpublished';
var $A_COMP_CONTENT_RESET_HIT = 'Reset Hit Count';
var $A_COMP_CONTENT_REVISED = 'Revised';
var $A_COMP_CONTENT_TIMES = 'times';
var $A_COMP_CONTENT_CREATED = 'Created';
var $A_COMP_CONTENT_BY = 'By';
var $A_COMP_CONTENT_NEW_DOC = 'New document';
var $A_COMP_CONTENT_LAST_MOD = 'Last Modified';
var $A_COMP_CONTENT_NOT_MOD = 'Not modified';
var $A_COMP_CONTENT_MOSIMAGE = 'MOSImage Control';
var $A_COMP_CONTENT_SUB_FOLDER = 'Sub-folder';
var $A_COMP_CONTENT_GALLERY = 'Gallery Images';
var $A_COMP_CONTENT_IMAGES = 'Content Images';
var $A_COMP_CONTENT_UP = 'up';
var $A_COMP_CONTENT_DOWN = 'down';
var $A_COMP_CONTENT_REMOVE = 'remove';
var $A_COMP_CONTENT_EDIT_IMAGE = 'Edit the image selected';
var $A_COMP_CONTENT_IMG_ALIGN = 'Image Align';
var $A_COMP_CONTENT_ALIGN = 'Align';
var $A_COMP_CONTENT_ALT = 'Alt Text';
var $A_COMP_CONTENT_BORDER = 'Border';
var $A_COMP_CONTENT_IMG_CAPTION = 'Caption';
var $A_COMP_CONTENT_IMG_CAPTION_POS = 'Caption Position';
var $A_COMP_CONTENT_IMG_CAPTION_ALIGN = 'Caption Align';
var $A_COMP_CONTENT_IMG_WIDTH = 'Width';
var $A_COMP_CONTENT_APPLY = 'Apply';
var $A_COMP_CONTENT_PARAM = 'Parameter Control';
var $A_COMP_CONTENT_PARAM_MESS = '* These Parameters only control what you see when you click to view an item fully *';
var $A_COMP_CONTENT_META_DATA = 'Meta Data';
var $A_COMP_CONTENT_KEYWORDS = 'Keywords';
//var $A_COMP_CONTENT_LINK_PAGE = 'link-page';
var $A_COMP_CONTENT_LINK_CI = 'This will create a \'Link - Content Item\' in the menu you select';
var $A_COMP_CONTENT_LINK_NAME = 'Link Name';
var $A_COMP_CONTENT_SOMETHING = 'Please select something';
var $A_COMP_CONTENT_MOVE_ITEMS = 'Move Items';
var $A_COMP_CONTENT_MOVE_SECCAT = 'Move to Section/Category';
var $A_COMP_CONTENT_ITEMS_MOVED = 'Items being Moved';
var $A_COMP_CONTENT_SECCAT = 'Please select a Section/Category to copy the items to';
var $A_COMP_CONTENT_COPY_ITEMS = 'Copy Content Items';
var $A_COMP_CONTENT_COPY_SECCAT = 'Copy to Section/Category';
var $A_COMP_CONTENT_ITEMS_COPIED = 'Items being copied';
var $A_COMP_CONTENT_PUBLISHING = 'Publishing';
var $A_COMP_CONTENT_IMAGES2 = 'Images';
var $A_COMP_CONTENT_META_INFO = 'Meta Info';
var $A_COMP_CONTENT_ADD_ETC = 'Add Sect/Cat/Title';
var $A_COMP_CONTENT_LINK_TO_MENU = 'Link to Menu';
var $A_COMP_CONTENT_EDIT_CONTENT = 'Edit Content';
var $A_COMP_CONTENT_EDIT_STATIC = 'Edit Static Content';
var $A_COMP_CONTENT_EDIT_SECTION = 'Edit Section';
var $A_COMP_CONTENT_EDIT_CATEGORY = 'Edit Category';
var $A_COMP_CONTENT_EDIT_USER = 'Edit User';
//components/com_content/admin.content.php
var $A_COMP_CONTENT_CACHE = 'Cache cleaned';
var $A_COMP_CONTENT_MODULE = 'The module';
var $A_COMP_CONTENT_ANOTHER = 'is currently being edited by another administrator';
var $A_COMP_CONTENT_PUBLISHED = 'Item(s) successfully Published';
var $A_COMP_CONTENT_UNPUBLISHED = 'Item(s) successfully Unpublished';
var $A_COMP_CONTENT_SEL_TOG = 'Select an item to toggle';
var $A_COMP_CONTENT_SEL_DEL = 'Select an item to delete';
var $A_COMP_CONTENT_SUCCESS_DEL = 'Item(s) successfully deleted';
var $A_COMP_CONTENT_SEL_MOVE = 'Select an item to move';
var $A_COMP_CONTENT_MOVED = 'Item(s) successfully moved to Section';
var $A_COMP_CONTENT_ERR_OCCURRED = 'An error has occurred';
var $A_COMP_CONTENT_COPIED = 'Item(s) successfully copied to Section';
var $A_COMP_CONTENT_RESET_HIT_COUNT = 'Successfully Reset Hit count for';
var $A_COMP_CONTENT_IN_MENU = '(Link - Static Content) in menu';
var $A_COMP_CONTENT_SUCCESS = 'successfully created';
var $A_COMP_CONTENT_SELECT_CAT = 'Select Category';
var $A_COMP_CONTENT_SELECT_SEC = 'Select Section';

//components/com_content/toolbar.content.html.php
var $A_COMP_CONTENT_BAR_MOVE = 'Move';
var $A_COMP_CONTENT_BAR_COPY = 'Copy';
var $A_COMP_CONTENT_BAR_SAVE = 'Save';

//components/com_frontpage/admin.frontpage.html.php
var $A_COMP_FRONT_PAGE_MNG = 'Front Page Manager';
//var $A_COMP_FRONT_PAGE_ITEMS = 'Front Page Items';
var $A_COMP_FRONT_ORDER = 'Order';

//components/com_frontpage/admin.frontpage.php
var $A_COMP_FRONT_COUNT_NUM = 'Parameter count must be a number';
var $A_COMP_FRONT_INTRO_NUM = 'Parameter intro must be a number';
var $A_COMP_FRONT_WELCOME = 'Welcome to the Frontpage';
var $A_COMP_FRONT_IDONOT = 'I do not have anything to display';

//components/com_frontpage/toolbar.frontpage.html.php
var $A_COMP_FRONT_REMOVE = 'Remove';

//components/com_languages/admin.languages.html.php
var $A_COMP_LANG_INSTALL = 'Language Manager <small><small>[ Site ]</small></small>';
var $A_COMP_LANG_LANG = 'Language';
var $A_COMP_LANG_EMAIL = 'Author Email';
var $A_COMP_LANG_EDITOR = 'Language Editor';
var $A_COMP_LANG_FILE = 'File language';

//components/com_languages/admin.languages.php
var $A_COMP_LANG_UPDATED = 'Configuration succesfully updated!';
var $A_COMP_LANG_M_SURE = 'Error! Make sure that configuration.php is writeable.';
var $A_COMP_LANG_CANNOT = 'You can not delete language in use.';
var $A_COMP_LANG_FAILED_OPEN = 'Operation Failed: Could not open';
var $A_COMP_LANG_FAILED_SPEC = 'Operation failed: No language specified.';
var $A_COMP_LANG_FAILED_EMPTY = 'Operation failed: Content empty.';
var $A_COMP_LANG_FAILED_UNWRT = 'Operation failed: The file is not writable.';
var $A_COMP_LANG_FAILED_FILE = 'Operation failed: Failed to open file for writing.';

//components/com_mambots/admin.mambots.html.php
var $A_COMP_MAMB_ADMIN = 'Administrator';
var $A_COMP_MAMB_SITE = 'Site';
var $A_COMP_MAMB_MANAGER = 'Mambot Manager';
var $A_COMP_MAMB_NAME = 'Mambot Name';
var $A_COMP_MAMB_FILE = 'File';
var $A_COMP_MAMB_MUST_NAME = 'Mambot must have a name';
var $A_COMP_MAMB_MUST_FNAME = 'Mambot must have a filename';
var $A_COMP_MAMB_DETAILS = 'Mambot Details';
var $A_COMP_MAMB_FOLDER = 'Folder';
var $A_COMP_MAMB_MFILE = 'Mambot file';
var $A_COMP_MAMB_ORDER = 'Mambot Order';

//components/com_mambots/admin.mambots.php
var $A_COMP_MAMB_EDIT = 'is currently being edited by another administrator';
var $A_COMP_MAMB_DEL = 'Select a module to delete';
var $A_COMP_MAMB_TO = 'Select a mambot to';
var $A_COMP_MAMB_PUB = 'publish';
var $A_COMP_MAMB_UNPUB = 'unpublish';
var $A_COMP_MAMB_SAVED_CHANGES = 'Successfully Saved changes to Mambot: '; //KEN ADDED
var $A_COMP_MAMB_SAVED = 'Successfully Saved Mambot: '; //KEN ADDED
var $A_COMP_MAMB_ORDERING = 'New items default to the last place. Ordering can be changed after this item is saved.'; //KEN ADDED
var $A_COMP_MAMB_ORDERING_SAVED = 'Successfully Saved Mambot: '; //KEN ADDED

//components/com_massmail/admin.massmail.html.php
var $A_COMP_MASS_SUBJECT = 'Please fill in the subject';
var $A_COMP_MASS_SELECT_GROUP = 'Please select a group';
var $A_COMP_MASS_MESSAGE = 'Please fillin the message';
var $A_COMP_MASS_MAIL = 'Mass Mail';
var $A_COMP_MASS_GROUP = 'Group';
var $A_COMP_MASS_DETAILS = 'Details'; //KEN ADDED
var $A_COMP_MASS_CHILD = 'Mail to Child Groups';
var $A_COMP_MASS_HTML = 'Send in HTML mode'; //KEN ADDED
var $A_COMP_MASS_SUB = 'Subject';
var $A_COMP_MASS_MESS = 'Message';

//components/com_massmail/toolbar.massmail.html.php
var $A_COMP_MASS_SEND = 'Send Mail';

//components/com_massmail/admin.massmail.php
var $A_COMP_MASS_ALL = '- All User Groups -';
var $A_COMP_MASS_FILL = 'Please fill in the form correctly';
var $A_COMP_MASS_SENT = 'E-mail sent to';
var $A_COMP_MASS_USERS = 'users';

//components/com_media/admin.media.html.php
var $A_COMP_MEDIA_MG = 'Media Manager';
var $A_COMP_MEDIA_DIR = 'Directory';
var $A_COMP_MEDIA_UP = 'Up';
var $A_COMP_MEDIA_UPLOAD = 'Upload';
var $A_COMP_MEDIA_UPLOAD_MAX = 'Max size';
var $A_COMP_MEDIA_CODE = 'Code';
var $A_COMP_MEDIA_CDIR = 'Create Directory';
var $A_COMP_MEDIA_PROBLEM = 'Configuration Problem';
var $A_COMP_MEDIA_EXIST = 'does not exist.';
var $A_COMP_MEDIA_DEL = 'Delete';
var $A_COMP_MEDIA_INSERT = 'Insert your text here';
var $A_COMP_MEDIA_DEL_FILE = "Delete file \"+file+\"?";
var $A_COMP_MEDIA_DEL_ALL = "There are \"+numFiles+\" files/folders in \"+folder+\". Please delete all files/folder in \"+folder+\" first.";
var $A_COMP_MEDIA_DEL_FOLD = "Delete folder \"+folder+\"?";
var $A_COMP_MEDIA_NO_IMG = 'No Images Found';

//components/com_media/admin.media.php
var $A_COMP_MEDIA_NO_HACK = 'NO HACKING PLEASE';
var $A_COMP_MEDIA_DIR_SAFEMODE = 'Directory creation not allowed while running in SAFE MODE as this can cause problems.';
var $A_COMP_MEDIA_ALPHA = 'Directory name must only contain alphanumeric characters and no spaces please.';
var $A_COMP_MEDIA_FAILED = 'Upload FAILED.File allready exists';
var $A_COMP_MEDIA_ONLY = 'Only files of type gif, png, jpg, bmp, pdf, swf, doc, xls or ppt can be uploaded';
var $A_COMP_MEDIA_UP_FAILED = 'Upload FAILED';
var $A_COMP_MEDIA_UP_COMP = 'Upload complete';
var $A_COMP_MEDIA_NOT_EMPTY = '<font color="red">Unable to delete: not empty!</font>';//KEN ADDED
//components/com_media/toolbar.media.html.php
var $A_COMP_MEDIA_CREATE = 'Create';

//components/com_menumanager/admin.menumanager.html.php
var $A_COMP_MENU_NAME = 'Menu Name';
var $A_COMP_MENU_TYPE = 'Menu Type';
var $A_COMP_MENU_TITLE = 'Module Title';
var $A_COMP_MENU_ITEMS = 'Menu Items';//KEN ADDED
var $A_COMP_MENU_PUB = '# Published';//KEN ADDED
var $A_COMP_MENU_UNPUB = '# UnPublished';//KEN ADDED
var $A_COMP_MENU_MODULES = '# Modules';//KEN ADDED
var $A_COMP_MENU_EDIT_NAME = 'Edit Menu Name';//KEN ADDED
var $A_COMP_MENU_EDIT_ITEM = 'Edit Menu Items';//KEN ADDED
var $A_COMP_MENU_ID = 'Module ID';
var $A_COMP_MENU_TIPS = 'This is the identification name used by mambo to identify this menu within the code - it must be unique. Recommend that you do not have any spaces in your Menu Name';//KEN ADDED
var $A_COMP_MENU_TIPS2 = 'Title of the mod_mainmenu module required to show this Menu';//KEN ADDED
var $A_COMP_MENU_TIPS3 = '* A new mod_mainmenu module, with the Title you have entered above will automatically be created when you save this menu. *<br/><br/>Parameters for the module created are to be edited through the "Modules Manager [site]": Modules -> Site Modules';//KEN ADDED
var $A_COMP_MENU_ASSIGN = 'No module assigned to menu';
var $A_COMP_MENU_ENTER = 'Please enter a name for your menu';
var $A_COMP_MENU_ENTER_TYPE = 'Please enter a menu type for your menu';
var $A_COMP_MENU_ENTER_TITLE = 'Please enter a module name for your menu';
var $A_COMP_MENU_DETAILS = 'Menu Details';
var $A_COMP_MENU_MAINMENU = 'A mod_mainmenu module, with the same name will automatically be created/modified when you save this menu.';
var $A_COMP_MENU_DEL = 'Delete Menu';
var $A_COMP_MENU_MODULE_DEL = 'Menu/Module being Deleted';
var $A_COMP_MENU_ITEMS_DEL = 'Menu Items being Deleted';
var $A_COMP_MENU_WILL = '* This will';
var $A_COMP_MENU_WILL2 = 'this Menu, <br />ALL its Menu Items and the Module associated with it *';
var $A_COMP_MENU_YOU_SURE = 'Are you sure you want to Deleted this menu? \nThis will Delete the Menu, its Items and the Module.';
var $A_COMP_MENU_NAME_MENU = 'Please enter a name for the copy of the Menu';
var $A_COMP_MENU_NAME_MOD = 'Please enter a name for the new Module';
var $A_COMP_MENU_COPY = 'Copy Menu';
var $A_COMP_MENU_NEW = 'New Menu Name';
var $A_COMP_MENU_NEW_MOD = 'New Module Name';//KEN ADDED
var $A_COMP_MENU_COPIED = 'Menu being copied';
var $A_COMP_MENU_ITEMS_COPIED = 'Menu Items being copied';
var $A_COMP_MENU_MOD_MENU = 'A mod_mainmenu module, with the same name<br />will automatically be created when you save this menu.';

//components/com_menumanager/admin.menumanager.php
var $A_COMP_MENU_CREATED = 'New Menu created';
var $A_COMP_MENU_UPDATED = 'Menu Items & Modules updated';
var $A_COMP_MENU_DETECTED = 'Menu Deleted';
var $A_COMP_MENU_COPY_OF = 'Copy of Menu';
var $A_COMP_MENU_CONSIST = 'created, consisting of';
var $A_COMP_MENU_RENAME_WARNING = 'You cannot rename the mainmenu Menu as this will disrupt the proper operation of Mambo';
var $A_COMP_MENU_EXISTS_WARNING = 'A menu already exists with that name - you must enter a unique Menu Name';

//components/com_menumanager/toolbar.menumanager.html.php
var $A_COMP_MENU_BAR_DEL = 'Delete';

//components/com_modules/admin.modules.html.php
var $A_COMP_MOD_MANAGER = 'Module Manager';
var $A_COMP_MOD_NAME = 'Module Name';
var $A_COMP_MOD_POSITION = 'Position';
var $A_COMP_MOD_PAGES = 'Pages';
var $A_COMP_MOD_VARIES = 'Varies';
var $A_COMP_MOD_ALL = 'All';
var $A_COMP_MOD_USER = 'User';
var $A_COMP_MOD_MUST_TITLE = 'Module must have a title';
var $A_COMP_MOD_MODULE = 'Module';
var $A_COMP_MOD_DETAILS = 'Module Details';
var $A_COMP_MOD_SHOW_TITLE = 'Show title';
var $A_COMP_MOD_ORDER = 'Module Order';
var $A_COMP_MOD_CONTENT = 'Content';
var $A_COMP_MOD_PAGES_ITEMS = 'Pages / Items';
var $A_COMP_MOD_CUSTOM_OUTPUT = 'Custom Output';
var $A_COMP_MOD_MOD_POSITION = 'Module Positions';
var $A_COMP_MOD_ITEM_LINK = 'Menu Item Link(s)';
var $A_COMP_MOD_TAB_LBL = 'Location(s)';

//components/com_modules/admin.modules.php
var $A_COMP_MOD_MODULES = 'Module(s)';
var $A_COMP_MOD_MOD_COPIED = 'Module Copied';//KEN ADDED
var $A_COMP_MOD_SAVED_CHANGES = 'Successfully Saved changes to Module: ';//KEN ADDED
var $A_COMP_MOD_SAVED_MOD = 'Successfully Saved Module: ';//KEN ADDED
var $A_COMP_MOD_CANNOT = 'cannot be deleted they can only be un-installed as they are Mambo modules.';
var $A_COMP_MOD_SELECT_TO = 'Select a module to';

//components/com_modules/toolbar.modules.html.php
var $A_COMP_MOD_PREVIEW = 'Preview';
var $A_COMP_MOD_PREVIEW_TIP = 'You can only preview typed modules.';

//components/com_newsfeeds/admin.newsfeeds.html.php
var $A_COMP_FEED_TITLE = 'Newsfeed Manager';
var $A_COMP_FEED_NEWS = 'News Feed';
var $A_COMP_FEED_ARTICLES = '# Articles';
var $A_COMP_FEED_CACHE = 'Cache time(sec)';
var $A_COMP_FEED_EDIT_FEED = 'Edit Newsfeed';//KEN ADDED
var $A_COMP_FEED_FILL_NAME = 'Please fill in the newsfeed name.';
var $A_COMP_FEED_SEL_CATEG = 'Please select a Category.';
var $A_COMP_FEED_FILL_LINK = 'Please fill in the newsfeed link.';
var $A_COMP_FEED_FILL_NB = 'Please fill in the number of articles to display.';
var $A_COMP_FEED_FILL_REFRESH = 'Please fill in the cache refresh time.';
var $A_COMP_FEED_LINK = 'Link';
var $A_COMP_FEED_NB_ARTICLE = 'Number of Articles';
var $A_COMP_FEED_IN_SEC = 'Cache time (in seconds)';

//components/com_poll/admin.poll.html.php
var $A_COMP_POLL_MANAGER = 'Poll Manager';
var $A_COMP_POLL_TITLE = 'Poll Title';
var $A_COMP_POLL_OPTIONS = 'Options';
var $A_COMP_POLL_MUST_TITLE = 'Poll must have a title';
var $A_COMP_POLL_NON_ZERO = 'Poll must have a non-zero lag time';
var $A_COMP_POLL_POLL = 'Poll';
var $A_COMP_POLL_SHOW = 'Show on menu items';
var $A_COMP_POLL_LAG = 'Lag';
var $A_COMP_POLL_EDIT = 'Edit poll';//KEN ADDED
var $A_COMP_POLL_BETWEEN = '(seconds between votes)';

//components/com_poll/admin.poll.php
var $A_COMP_POLL_THE = 'The poll';
var $A_COMP_POLL_BEING = 'is currently being edited by another administrator.';

//components/com_poll/poll.class.php
var $A_COMP_POLL_TRY_AGAIN = 'There is a module already with that name, please try again.';

//components/com_sections/admin.sections.html.php
var $A_COMP_SECT_MANAGER = 'Section Manager';
var $A_COMP_SECT_NAME = 'Section Name';
var $A_COMP_SECT_ID = 'Section ID';
var $A_COMP_SECT_NB_CATEG = '# Categories';
var $A_COMP_SECT_NEW = 'New Section';
var $A_COMP_SECT_SEL_MENU = 'Please select a Menu';
var $A_COMP_SECT_MUST_NAME = 'Section must have a name';
var $A_COMP_SECT_MUST_TITLE = 'Section must have a title';
var $A_COMP_SECT_DETAILS = 'Section Details';
var $A_COMP_SECT_SCOPE = 'Scope';
var $A_COMP_SECT_SHORT_NAME = 'A short name to appear in menus';
var $A_COMP_SECT_LONG_NAME = 'A long name to be displayed in headings';
var $A_COMP_SECT_COPY = 'Copy Section';
var $A_COMP_SECT_COPY_TO = 'Copy to Section';
var $A_COMP_SECT_NEW_NAME = 'The new Section name';
var $A_COMP_SECT_WILL_COPY = 'This will copy the Categories listed<br />and all the items within the category (also listed)<br />to the new Section created.';
var $A_COMP_SECT_MENU_LINK = 'Menu links available when saved';//KEN ADDED

//components/com_sections/admin.sections.php
var $A_COMP_SECT_THE = 'The section';
var $A_COMP_SECT_LIST = 'Section List';
var $A_COMP_SECT_BLOG = 'Section Blog';
var $A_COMP_SECT_DELETE = 'Select a section to delete';
var $A_COMP_SECT_SEC = 'Sections(s)';
var $A_COMP_SECT_CANNOT = 'cannot be removed as they contain categories';
var $A_COMP_SECT_SUCCESS_DEL = 'successfully deleted';
var $A_COMP_SECT_TO = 'Select a section to';
var $A_COMP_SECT_CANNOT_PUB = 'Cannot Publish an Empty Section';
var $A_COMP_SECT_AND_ALL = 'and all its Categories and Items have been copied as';
var $A_COMP_SECT_IN_MENU = 'in menu';
var $A_COMP_SECT_CHANGES_SAVED = 'Changes to Section saved';//KEN ADDED
var $A_COMP_SECT_SECTION_SAVED = 'Section saved';//KEN ADDED

//components/com_statistics/admin.statistics.html.php
var $A_COMP_STAT_OS = 'Browser, OS, Domain Statistics';
var $A_COMP_STAT_BR_PAGE = 'Browsers';
var $A_COMP_STAT_BROWSER = 'Browser';
var $A_COMP_STAT_OS_PAGE = 'OS Stats';
var $A_COMP_STAT_OP_SYST = 'Operating System';
var $A_COMP_STAT_URL_PAGE = 'Domain Stats';
var $A_COMP_STAT_URL = 'Domain';
var $A_COMP_STAT_IMPR = 'Page Impression Statistics';
var $A_COMP_STAT_PG_IMPR = 'Page Impressions';
var $A_COMP_STAT_SCH_ENG = 'Search Engine Text';
var $A_COMP_STAT_LOG_IS = 'logging is';
var $A_COMP_STAT_ENABLED = 'Enabled';
var $A_COMP_STAT_DISABLED = 'Disabled';
var $A_COMP_STAT_SCH_TEXT = 'Search Text';
var $A_COMP_STAT_T_REQ = 'Times Requested';
var $A_COMP_STAT_R_RETURN = 'Results Returned';

//components/com_syndicate/admin.syndicate.html.php
var $A_COMP_SYND_SET = 'Syndication Settings';

//components/com_syndicate/admin.syndicate.php
var $A_COMP_SYND_SAVED = 'Settings successfully Saved';

//components/com_templates/admin.templates.html.php
var $A_COMP_TEMP_NO_PREVIEW = 'No preview available';
var $A_COMP_TEMP_INSTALL = 'Installed';
var $A_COMP_TEMP_TP = 'Templates';
var $A_COMP_TEMP_PREVIEW = 'Preview Template';
var $A_COMP_TEMP_ASSIGN = 'Assigned';
var $A_COMP_TEMP_AUTHOR_URL = 'Author URL';
var $A_COMP_TEMP_EDITOR = 'Template Editor';
var $A_COMP_TEMP_PATH = 'Path: templates';
var $A_COMP_TEMP_WRT = ' - Writeable';
var $A_COMP_TEMP_UNWRT = ' - Unwriteable';
var $A_COMP_TEMP_ST_EDITOR = 'Template Stylesheet Editor';
var $A_COMP_TEMP_NAME = 'Path';
var $A_COMP_TEMP_ASSIGN_TP = 'Assign template';
var $A_COMP_TEMP_TO_MENU = 'to menu items';
var $A_COMP_TEMP_PAGES = 'Page(s)';
var $A_COMP_TEMP_ = 'Position';

//components/com_templates/admin.templates.php
var $A_COMP_TEMP_CANNOT = 'You can not delete template in use.';
var $A_COMP_TEMP_NOT_OPEN = 'Operation Failed: Could not open';
var $A_COMP_TEMP_FLD_SPEC = 'Operation failed: No template specified.';
var $A_COMP_TEMP_FLD_EMPTY = 'Operation failed: Content empty.';
var $A_COMP_TEMP_FLD_WRT = 'Operation failed: Failed to open file for writing.';
var $A_COMP_TEMP_FLD_NOT = 'Operation failed: The file is not writable.';
var $A_COMP_TEMP_SAVED = 'Positions saved';

//components/com_typedcontent/admin.typedcontent.html.php
var $A_COMP_TYPED_STATIC = 'Static Content Manager';
var $A_COMP_TYPED_LINKS = 'Links';
var $A_COMP_TYPED_ARE_YOU = 'Are you sure you want to create a menu link to this Static Content item? \nAny unsaved changes to this content will be lost.';
var $A_COMP_TYPED_CONTENT = 'Typed Content';
var $A_COMP_TYPED_TEXT = 'Text: (required)';
var $A_COMP_TYPED_EXPIRES = 'Expires';
var $A_COMP_TYPED_WILL = 'This will create a \'Link - Static Content\' in the menu you select';
var $A_COMP_TYPED_ITEM = 'Static Content Item';

//components/com_typedcontent/admin.typedcontent.php
var $A_COMP_TYPED_SAVED = 'Typed Content Item saved';
var $A_COMP_TYPED_CHG_SAVED = 'Changes to Typed Content Item saved';

//components/com_users/admin.users.html.php
var $A_COMP_USERS_ID = 'UserID';
var $A_COMP_USERS_LOG_IN = 'Logged In';
var $A_COMP_USERS_LAST = 'Last Visit';
var $A_COMP_USERS_BLOCKED = 'Blocked';
var $A_COMP_USERS_YOU_MUST = 'You must provide a user login name.';
var $A_COMP_USERS_YOU_LOGIN = 'You login name contains invalid characters or is too short.';
var $A_COMP_USERS_MUST_EMAIL = 'You must provide an email address.';
var $A_COMP_USERS_ASSIGN = 'You must assign user to a group.';
var $A_COMP_USERS_NO_MATCH = 'Password do not match.';
var $A_COMP_USERS_NO_FRONTEND = 'Please Select another group as `Public Frontend` is not a selectable option';
var $A_COMP_USERS_NO_BACKEND = 'Please Select another group as `Public Backend` is not a selectable option';
var $A_COMP_USERS_DETAILS = 'User Details';
var $A_COMP_USERS_EMAIL = 'Email';
var $A_COMP_USERS_PASS = 'New Password';
var $A_COMP_USERS_VERIFY = 'Verify Password';
var $A_COMP_USERS_BLOCK = 'Block User';
var $A_COMP_USERS_SUBMI = 'Receive Submission Emails';
var $A_COMP_USERS_REG_DATE = 'Register Date';
var $A_COMP_USERS_VISIT_DATE = 'Last Visit Date';
var $A_COMP_USERS_CONTACT = 'Contact Information';
var $A_COMP_USERS_NO_DETAIL = 'No Contact details linked to this User:<br />See \'Components -> Contact -> Manage Contacts\' for details.';
var $A_COMP_USERS_CHANGE_CONTACT = 'change Contact Details';
var $A_COMP_USERS_CONTACT_INFO = 'Components -> Contact -> Manage Contacts';

//components/com_users/admin.users.php
var $A_COMP_USERS_SUPER_ADMIN = 'Super Administrator';
var $A_COMP_USERS_CANNOT = 'You cannot delete a Super Administrator';
var $A_COMP_USERS_NOT_DEL_SELF = 'You cannot delete Yourself!';
var $A_COMP_USERS_NOT_DEL_ADMIN = 'You cannot delete another `Administrator` only `Super Administrators` have this power';

//components/com_users/toolbar.users.html.php
var $A_COMP_USERS_LOGOUT = 'Force Logout';

//components/com_weblinks/admin.weblinks.html.php
var $A_COMP_WEBL_MANAGER = 'Weblink Manager';
var $A_COMP_WEBL_APPROVED = 'Approved';
var $A_COMP_WEBL_MUST_TITLE = 'Weblink item must have a title';
var $A_COMP_WEBL_MUST_CATEG = 'You must select a category.';
var $A_COMP_WEBL_MUST_URL = 'You must have a url.';
var $A_COMP_WEBL_WL = 'Weblink';

//components/com_installer/admin.installer.php
var $A_INSTALL_NOT_FOUND = "Installer not found for element ";
var $A_INSTALL_NOT_AVAIL = "Installer not available for element";
var $A_INSTALL_ENABLE_MSG = "The installer can't continue before file uploads are enabled. Please use the install from directory method.";
var $A_INSTALL_ERROR_MSG_TITLE = 'Installer - Error';
var $A_INSTALL_ZLIB_MSG = "The installer can't continue before zlib is installed";
var $A_INSTALL_NOFILE_MSG = 'No file selected';
var $A_INSTALL_NEWMODULE_ERROR_MSG_TITLE = 'Upload new module - error';
var $A_INSTALL_UPLOAD_PRE = 'Upload ';
var $A_INSTALL_UPLOAD_POST = ' - Upload Failed';
var $A_INSTALL_UPLOAD_POST2 = ' -  Upload Error';
var $A_INSTALL_SUCCESS = 'Success';
var $A_INSTALL_ERROR = 'Error';
var $A_INSTALL_FAILED = 'Failed';
var $A_INSTALL_SELECT_DIR = 'Please select a directory';
var $A_INSTALL_UPLOAD_NEW = 'Upload new ';
var $A_INSTALL_FAIL_PERMISSION = 'Failed to change the permissions of the uploaded file.';
var $A_INSTALL_FAIL_MOVE = 'Failed to move uploaded file to <code>/media</code> directory.';
var $A_INSTALL_FAIL_WRITE = 'Upload failed as <code>/media</code> directory is not writable.';
var $A_INSTALL_FAIL_EXIST = 'Upload failed as <code>/media</code> directory does not exist.';

//components/com_installer/admin.installer.html.php
var $A_INSTALL_WRITABLE = 'Writeable';
var $A_INSTALL_UNWRITABLE = 'Unwriteable';
var $A_INSTALL_CONTINUE = 'Continue ...';
var $A_INSTALL_UPLOAD_PACK_FILE = 'Upload Package File';
var $A_INSTALL_PACK_FILE = 'Package File:';
var $A_INSTALL_UPL_INSTALL = "Upload File &amp; Install";
var $A_INSTALL_FROM_DIR = 'Install from directory';
var $A_INSTALL_DIR = 'Install directory:';
var $A_INSTALL_DO_INSTALL = 'Install';

//components/com_installer/component/component.html.php
var $A_INSTALL_COMP_INSTALLED = 'Installed Components';
var $A_INSTALL_COMP_CURRENT = 'Currently Installed';
var $A_INSTALL_COMP_MENU = 'Component Menu Link';
var $A_INSTALL_COMP_AUTHOR = 'Author';
var $A_INSTALL_COMP_VERSION = 'Version';
var $A_INSTALL_COMP_DATE = 'Date';
var $A_INSTALL_COMP_AUTH_MAIL = 'Author Email';
var $A_INSTALL_COMP_AUTH_URL = 'Author URL';
var $A_INSTALL_COMP_NONE = 'There are no custom components installed';

//components/com_installer/component/component.php
var $A_INSTALL_COMP_UPL_NEW = 'Upload new component';

//components/com_installer/language/language.php
var $A_INSTALL_LANG = 'Upload new language';
var $A_INSTALL_BACK_LANG_MGR = 'Back to Language Manager';

//components/com_installer/language/language.class.php
var $A_INSTALL_LANG_NOREMOVE = 'Language id empty, cannot remove files';
var $A_INSTALL_LANG_UN_ERR = 'Uninstall -  error';
var $A_INSTALL_LANG_DELETING = 'Deleting';

//components/com_installer/mambot/mambot.html.php
var $A_INSTALL_MAMB_MAMBOTS = 'Mambots';
var $A_INSTALL_MAMB_CORE = 'Only those Mambots that can be uninstalled are displayed - some Core Mambots cannot be removed.';
var $A_INSTALL_MAMB_MAMBOT = 'Mambot';
var $A_INSTALL_MAMB_TYPE = 'Type';
var $A_INSTALL_MAMB_AUTHOR = 'Author';
var $A_INSTALL_MAMB_VERSION = 'Version';
var $A_INSTALL_MAMB_DATE = 'Date';
var $A_INSTALL_MAMB_AUTH_MAIL = 'Author Email';
var $A_INSTALL_MAMB_AUTH_URL = 'Author URL';
var $A_INSTALL_MOD_NO_MAMBOTS = 'There are no non-core, custom mambots installed.';

//components/com_installer/mambot/mambot.php
var $A_INSTALL_MAMB_INSTALL_MAMBOT = 'Install Mambot';

//components/com_installer/module/module.html.php
var $A_INSTALL_MOD_MODS = 'Modules';
var $A_INSTALL_MOD_FILTER = 'Filter:';
var $A_INSTALL_MOD_CORE = 'Only those Modules that can be uninstalled are displayed - some Core Modules cannot be removed.';
var $A_INSTALL_MOD_MOD = 'Module File';
var $A_INSTALL_MOD_CLIENT = 'Client';
var $A_INSTALL_MOD_AUTHOR = 'Author';
var $A_INSTALL_MOD_VERSION = 'Version';
var $A_INSTALL_MOD_DATE = 'Date';
var $A_INSTALL_MOD_AUTH_MAIL = 'Author Email';
var $A_INSTALL_MOD_AUTH_URL = 'Author URL';
var $A_INSTALL_MOD_NO_CUSTOM = 'No custom modules installed';

//components/com_installer/module/module.php
var $A_INSTALL_MOD_INSTALL_MOD = 'Install Module';
var $A_INSTALL_MOD_ADMIN_MOD = 'Admin Modules';

//components/com_install/template/template.php
var $A_INSTALL_TEMPL_INSTALL = 'Install new Template';
var $A_INSTALL_TEMPL_SITE_TEMPL = 'Site';
var $A_INSTALL_TEMPL_ADMIN_TEMPL = 'Administrator';
var $A_INSTALL_TEMPL_BACKTTO_TEMPL = 'Back to Templates';

//components/com_menus/admin.menus.html.php
var $A_COMP_MENUS_MAX_LVLS = 'Max Levels';
var $A_COMP_MENUS_MENU_ITEM = 'Menu Item';
var $A_COMP_MENUS_MENU_ORDER = 'Order';//KEN ADDED
var $A_COMP_MENUS_MENU_SAVE_ORDER = 'Save Order';//KEN ADDED
var $A_COMP_MENUS_MENU_ITEMID = 'Itemid';//KEN ADDED
var $A_COMP_MENUS_MENU_CID = 'CID';//KEN ADDED
var $A_COMP_MENUS_MENU_CONTENT = 'Contents';//KEN ADDED
var $A_COMP_MENUS_MENU_MISC = 'Miscellaneous';//KEN ADDED
var $A_COMP_MENUS_MENU_NOTE = '* Note that some menu types appear in more that one grouping, but they are still the same menu type.';//KEN ADDED
var $A_COMP_MENUS_MENU_COM = 'Components';//KEN ADDED
var $A_COMP_MENUS_MENU_LINKS = 'Links';//KEN ADDED
var $A_COMP_MENUS_MENU_ITEM_TYPE = 'Menu Item Type';//KEN ADDED
var $A_COMP_MENUS_MENU_HELP = 'Help';//KEN ADDED
var $A_COMP_MENUS_MENU_BLOGVIEW = 'What is a "Blog" view';//KEN ADDED
var $A_COMP_MENUS_MENU_TABLEVIEW = 'What is a "Table" view';//KEN ADDED
var $A_COMP_MENUS_MENU_LISTVIEW = 'What is a "List" view';//KEN ADDED
var $A_COMP_MENUS_ADD_ITEM = 'Add Menu Item';
var $A_COMP_MENUS_SELECT_ADD = 'Select a Component to Add';
var $A_COMP_MENUS_MOVE_ITEMS = 'Move Menu Items';
var $A_COMP_MENUS_MOVE_MENU = 'Move to Menu';
var $A_COMP_MENUS_BEING_MOVED = 'Menu Items being moved';
var $A_COMP_MENUS_COPY_ITEMS = 'Copy Menu Items';
var $A_COMP_MENUS_NEXT = 'Next';
var $A_COMP_MENUS_COPY_MENU = 'Copy to Menu';
var $A_COMP_MENUS_BEING_COPIED = 'Menu Items being copied';
var $A_COMP_MENUS_SELECT_TO = 'Select an item to ';
var $A_COMP_MENUS_SEFPATH = 'SEF Path';
var $A_COMP_MENUS_SEFPATH_TIP = 'Set up the Path of Search Engine Friendly Link';

//components/com_menus/admin.menus.php
var $A_COMP_MENUS_ITEM_SAVED = 'Menu item Saved';//KEN ADDED
var $A_COMP_MENUS_MOVED_TO = ' Menu Items moved to ';
var $A_COMP_MENUS_COPIED_TO = ' Menu Items Copied to ';
var $A_COMP_MENUS_WRAPPER = 'Wrapper';
var $A_COMP_MENUS_SEPERATOR = 'Separator / Placeholder';
var $A_COMP_MENUS_LINK = 'Link - ';
var $A_COMP_MENUS_STATIC = 'Static Content';
var $A_COMP_MENUS_URL = 'Url';
var $A_COMP_MENUS_CONTENT_ITEM = 'Content Item';
var $A_COMP_MENUS_COMP_ITEM = 'Component Item';
var $A_COMP_MENUS_CONT_ITEM = 'Contact Item';
var $A_COMP_MENUS_NEWSFEED = 'Newsfeed';
var $A_COMP_MENUS_COMP = 'Component';
var $A_COMP_MENUS_LIST = 'List';
var $A_COMP_MENUS_TABLE = 'Table';
var $A_COMP_MENUS_BLOG = 'Blog';
var $A_COMP_MENUS_CONT_SEC = 'Content Section';
var $A_COMP_MENUS_CONT_CAT = 'Content Category';
var $A_COMP_MENUS_CONTACT_CAT = 'Contact Category';
var $A_COMP_MENUS_WEBLINK_CAT = 'Weblink Category';
var $A_COMP_MENUS_NEWS_CAT = 'Newsfeed Category';
var $A_COMP_MENUS_NEW_ORDER_SAVED = 'New ordering saved';//KEN ADDED
var $A_COMP_MENUS_EDIT_NEWSFEED_TIP = 'Edit this Newsfeed';
var $A_COMP_MENUS_EDIT_CONTACT_TIP = 'Edit this Contact';
var $A_COMP_MENUS_EDIT_CONTENT_TIP = 'Edit this Content';
var $A_COMP_MENUS_EDIT_STATIC_TIP = 'Edit this Static Content';

//components/com_menus/component_item_link/component_item_link.menu.html.php
var $A_COMP_MENUS_CIL_LINK_NAME = 'Link must have a name';
var $A_COMP_MENUS_CIL_SELECT_COMP = 'You must select a Component to link to';
var $A_COMP_MENUS_CIL_LINK_COMP = 'Component to Link';
var $A_COMP_MENUS_CIL_ON_CLICK = 'On Click, Open in';
var $A_COMP_MENUS_CIL_PARENT = 'Parent Item';
var $A_DETAILS = 'Details';

//components/com_menus/components/components.menu.html.php
var $A_COMP_MENUS_CMP_ITEM_NAME = 'Item must have a name';
var $A_COMP_MENUS_CMP_SELECT_CMP = 'Please select a Component';
var $A_COMP_MENUS_PARAMETERS_AVAILABLE = 'Parameter list will be available once you save this New menu item';
var $A_COMP_MENUS_CMP_ITEM_COMP = 'Menu Item :: Component';

//components/com_menus/contact_category_table/contact_category_table.menu.html.php
var $A_COMP_MENUS_CMP_CCT_CATEG = 'You must select a category';
var $A_COMP_MENUS_CMP_CCT_TITLE = 'This Menu item must have a title';
var $A_COMP_MENUS_CMP_CCT_BLANK = 'If you leave this blank the Category name will be automatically used';
var $A_COMP_MENUS_CMP_CCT_THETITLE = 'Title:';
var $A_COMP_MENUS_CMP_CCT_THECAT = 'Category:';

//components/com_menus/contact_item_link/contact_item_link.menu.html.php
var $A_COMP_MENUS_CMP_CIL_LINK_NAME = 'Link must have a name';
var $A_COMP_MENUS_CMP_CIL_SEL_CONT = 'You must select a Contact to link to';
var $A_COMP_MENUS_CMP_CIL_CONTACT = 'Contact to Link:';
var $A_COMP_MENUS_CMP_CIL_ONCLICK = 'On Click, Open in:';
var $A_COMP_MENUS_CMP_CIL_HDR = 'Menu Item :: Link - Contact Item';

//components\com_menus\content_archive_section\content_archive_section.menu.html.php
var $A_COMP_MENUS_CMP_CAS_BLANK = 'If you leave this blank the Section name will be automatically used';

//components\com_menus\content_blog_category\content_blog_category.menu.html.php
var $A_COMP_MENUS_CMP_CBC_CATEG = 'You can select multiple Categories';

//components\com_menus\content_blog_section\content_blog_section.menu.html.php
var $A_COMP_MENUS_CMP_CBS_SECTION = 'You can select multiple Sections';

//components\com_menus\content_item_link\content_item_link.menu.html.php
var $A_COMP_MENUS_CMP_CIL_SEL_LINK = 'You must select a Content to link to';

//components/com_menus/wrapper/wrapper.menu.html.php
var $A_COMP_MENUS_WRAPPER_LINK = 'Wrapper Link';

//components/com_menus/separator/separator.menu.html.php
var $A_COMP_MENUS_SEPARATOR_PATTERN = 'Pattern/Name';

//components/com_menus/content_typed/content_typed.menu.html.php
var $A_COMP_MENUS_TYPED_CONTENT_TO_LINK = 'Typed Content to Link';

//components/com_menus/content_item_link/content_item_link.menu.html.php
var $A_COMP_MENUS_CONTENT_TO_LINK = 'Content to Link';

//components/com_menus/newsfeed_link/newsfeed_link.menu.html.php
var $A_COMP_MENUS_NEWSFEED_TO_LINK = 'Newsfeed to Link';
var $A_COMP_MENUS_NEWSFEED_SELECT_LINK = 'You must select a Newsfeed to link to';

//components\com_menus\url\url.menu.html.php
var $A_COMP_MENUS_URL_MUST = 'You must provide a url.';
var $A_COMP_MENUS_URL_LINK = 'Link';


	function adminLanguage()
	{
		global $TR_STRS;
		//Menu Caption Translation for initial mambo menutype
		$TR_STRS[strtolower('mainmenu')] = 'mainmenu';
		$TR_STRS[strtolower('othermenu')] = 'othermenu';
		$TR_STRS[strtolower('topmenu')] = 'topmenu';
		$TR_STRS[strtolower('usermenu')] = 'usermenu';
		
		//Components menu caption
		//Banners
		$TR_STRS[strtolower('Banners')] = 'Banners';
		$TR_STRS[strtolower('Manage Banners')] = 'Manage Banners';
		$TR_STRS[strtolower('Manage Clients')] = 'Manage Clients';

		//Web Links
		$TR_STRS[strtolower('Web Links')] = 'Web Links';
		$TR_STRS[strtolower('Weblink Items')] = 'Weblink Items';
		$TR_STRS[strtolower('Weblink Categories')] = 'Weblink Categories';

		//Contacts
		$TR_STRS[strtolower('Contacts')] = 'Contacts';
		$TR_STRS[strtolower('Manage Contacts')] = 'Manage Contacts';
		$TR_STRS[strtolower('Contact Categories')] = 'Contact Categories';

		//Polls
		$TR_STRS[strtolower('Polls')] = 'Polls';

		//News Feeds
		$TR_STRS[strtolower('News Feeds')] = 'News Feeds';
		$TR_STRS[strtolower('Manage News Feeds')] = 'Manage News Feeds';
		$TR_STRS[strtolower('Manage Categories')] = 'Manage Categories';

		//Syndicate
		$TR_STRS[strtolower('Syndicate')] = 'Syndicate';

		//Mass Mail
		$TR_STRS[strtolower('Mass Mail')] = 'Mass Mail';

		//modules XML file
		$TR_STRS[strtolower('Count')] = 'Count';
		$TR_STRS[strtolower('The number of items to display (default is 5)')] = 'The number of items to display (default is 5)';
		$TR_STRS[strtolower('The number of items to display (default is 10)')] = 'The number of items to display (default is 10)';
		$TR_STRS[strtolower('Enable Cache')] = 'Enable Cache';
		$TR_STRS[strtolower('Select whether to cache the content of this module')] = 'Select whether to cache the content of this module';
		$TR_STRS[strtolower('No')] = 'No';
		$TR_STRS[strtolower('Yes')] = 'Yes';
		$TR_STRS[strtolower('Module Class Suffix')] = 'Module Class Suffix';
		$TR_STRS[strtolower('A suffix to be applied to the css class of the module (table.moduletable), this allows individual module styling')] = 'A suffix to be applied to the css class of the module (table.moduletable), this allows individual module styling';
		$TR_STRS[strtolower('Banner')] = 'Banner';
		$TR_STRS[strtolower('Banner client')] = 'Banner client';
		$TR_STRS[strtolower("Reference to banner client id. Enter separated by ','!")] = "Reference to banner client id. Enter separated by ','!";
		$TR_STRS[strtolower('Latest News')] = 'Latest News';
		$TR_STRS[strtolower('This module shows a list of the latest published content items.')] = 'This module shows a list of the latest published content items.';
		$TR_STRS[strtolower('Most Read Content')] = 'Most Read Content';
		$TR_STRS[strtolower('This module shows a list of published content items that have been viewed the most.')] = 'This module shows a list of published content items that have been viewed the most.';
		$TR_STRS[strtolower('Both')] = 'Both';
		$TR_STRS[strtolower('Show')] = 'Show';
		$TR_STRS[strtolower('Hide')] = 'Hide';
		$TR_STRS[strtolower('Frontpage Items')] = 'Frontpage Items';
		$TR_STRS[strtolower('Show/Hide items designated for the Frontpage - only works when in Content Items only mode')] = 'Show/Hide items designated for the Frontpage - only works when in Content Items only mode';
		$TR_STRS[strtolower('Category ID')] = 'Category ID';
		$TR_STRS[strtolower('Selects items from a specific Category or set of Categories (to specify more than one Category, seperate with a comma , ).')] = 'Selects items from a specific Category or set of Categories (to specify more than one Category, seperate with a comma , ).';
		$TR_STRS[strtolower('Section ID')] = 'Section ID';
		$TR_STRS[strtolower('Selects items from a specific Secion or set of Sections (to specify more than one Section, seperate with a comma , ).')] = 'Selects items from a specific Secion or set of Sections (to specify more than one Section, seperate with a comma , ).';
		$TR_STRS[strtolower('Show Headline')] = 'Show Headline';
		$TR_STRS[strtolower('Show/Hide the first content item as headline')] = 'Show/Hide the first content item as headline';
		$TR_STRS[strtolower('Module Title')] = 'Module Title';
		$TR_STRS[strtolower('User defined module title, Only use when headline shown')] = 'User defined module title, Only use when headline shown';
		$TR_STRS[strtolower('Section/Category Style')] = 'Section/Category Style';
		$TR_STRS[strtolower('style of section/category: list or blog')] = 'style of section/category: list or blog';
		$TR_STRS[strtolower('List')] = 'List';
		$TR_STRS[strtolower('Blog')] = 'Blog';
		$TR_STRS[strtolower('Title Length')] = 'Title Length';
		$TR_STRS[strtolower('The max length of content title in chars to display, Default 40')] = 'The max length of item title in chars to display, Default 40';
		$TR_STRS[strtolower('Date Display')] = 'Date Display';
		$TR_STRS[strtolower('The display of item created date')] = 'The display of item created date';
		$TR_STRS[strtolower('Login Form')] = 'Login Form';
		$TR_STRS[strtolower('Module Layout')] = 'Module Layout';
		$TR_STRS[strtolower('The layout of login module')] = 'The layout of login module';
		$TR_STRS[strtolower('Vertical Compact')] = 'Vertical Compact';
		$TR_STRS[strtolower('Login Redirection URL')] = 'Login Redirection URL';
		$TR_STRS[strtolower('What page will the login redirect to after login, if let blank will load front page')] = 'What page will the login redirect to after login, if let blank will load front page';
		$TR_STRS[strtolower('Logout Redirection URL')] = 'Logout Redirection URL';
		$TR_STRS[strtolower('What page will the logout redirect to after logout, if let blank will load front page')] = 'What page will the logout redirect to after logout, if let blank will load front page';
		$TR_STRS[strtolower('Login Message')] = 'Login Message';
		$TR_STRS[strtolower('Show/Hide the javascript Pop-up indicating Login Success')] = 'Show/Hide the javascript Pop-up indicating Login Success';
		$TR_STRS[strtolower('Logout Message')] = 'Logout Message';
		$TR_STRS[strtolower('Show/Hide the javascript Pop-up indicating Logout Success')] = 'Show/Hide the javascript Pop-up indicating Logout Success';
		$TR_STRS[strtolower('Greeting')] = 'Greeting';
		$TR_STRS[strtolower('Show/Hide the simple greeting text')] = 'Show/Hide the simple greeting text';
		$TR_STRS[strtolower('Name/Username')] = 'Name/Username';
		$TR_STRS[strtolower('Username')] = 'Username';
		$TR_STRS[strtolower('Name')] = 'Name';
		$TR_STRS[strtolower('Main Menu')] = 'Main Menu';
		$TR_STRS[strtolower('Menu Class Suffix')] = 'Menu Class Suffix';
		$TR_STRS[strtolower('A suffix to be applied to the css class of the menu items')] = 'A suffix to be applied to the css class of the menu items';
		$TR_STRS[strtolower('Menu Name')] = 'Menu Name';
		$TR_STRS[strtolower("The name of the menu (default is 'mainmenu')")] = "The name of the menu (default is 'mainmenu')";
		$TR_STRS[strtolower('Menu Style')] = 'Menu Style';
		$TR_STRS[strtolower('The menu style')] = 'The menu style';
		$TR_STRS[strtolower('Vertical')] = 'Vertical';
		$TR_STRS[strtolower('Horizontal')] = 'Horizontal';
		$TR_STRS[strtolower('Flat List')] = 'Flat List';
		$TR_STRS[strtolower('Show Menu Icons')] = 'Show Menu Icons';
		$TR_STRS[strtolower('Show the Menu Icons you have selected for your menu items')] = 'Show the Menu Icons you have selected for your menu items';
		$TR_STRS[strtolower('Menu Icon Alignment')] = 'Menu Icon Alignment';
		$TR_STRS[strtolower('Alignment of the Menu Icons')] = 'Alignment of the Menu Icons';
		$TR_STRS[strtolower('Left')] = 'Left';
		$TR_STRS[strtolower('Right')] = 'Right';
		$TR_STRS[strtolower('Expand Menu')] = 'Expand Menu';
		$TR_STRS[strtolower('Expand the menu and make its sub-menus items always visible')] = 'Expand the menu and make its sub-menus items always visible';
		$TR_STRS[strtolower('Indent Image')] = 'Indent Image';
		$TR_STRS[strtolower('Choose which indent image system to utilise')] = 'Choose which indent image system to utilise';
		$TR_STRS[strtolower('Template')] = 'Template';
		$TR_STRS[strtolower('Mambo default images')] = 'Mambo default images';
		$TR_STRS[strtolower('Use params below')] = 'Use params below';
		$TR_STRS[strtolower('None')] = 'None';
		$TR_STRS[strtolower('Indent Image 1')] = 'Indent Image 1';
		$TR_STRS[strtolower('Image for the first sub-level')] = 'Image for the first sub-level';
		$TR_STRS[strtolower('Indent Image 2')] = 'Indent Image 2';
		$TR_STRS[strtolower('Image for the second sub-level')] = 'Image for the second sub-level';
		$TR_STRS[strtolower('Indent Image 3')] = 'Indent Image 3';
		$TR_STRS[strtolower('Image for the third sub-level')] = 'Image for the third sub-level';
		$TR_STRS[strtolower('Indent Image 4')] = 'Indent Image 4';
		$TR_STRS[strtolower('Image for the fourth sub-level')] = 'Image for the fourth sub-level';
		$TR_STRS[strtolower('Indent Image 5')] = 'Indent Image 5';
		$TR_STRS[strtolower('Image for the fifth sub-level')] = 'Image for the fifth sub-level';
		$TR_STRS[strtolower('Indent Image 6')] = 'Indent Image 6';
		$TR_STRS[strtolower('Image for the sixth sub-level')] = 'Image for the sixth sub-level';
		$TR_STRS[strtolower('Spacer')] = 'Spacer';
		$TR_STRS[strtolower('Spacer for Horizontal menu')] = 'Spacer for Horizontal menu';
		$TR_STRS[strtolower('End Spacer')] = 'End Spacer';
		$TR_STRS[strtolower('End Spacer for Horizontal menu')] = 'End Spacer for Horizontal menu';
		$TR_STRS[strtolower('Newsflash')] = 'Newsflash';
		$TR_STRS[strtolower('Category')] = 'Category';
		$TR_STRS[strtolower('A content cateogry')] = 'A content cateogry';
		$TR_STRS[strtolower('Style')] = 'Style';
		$TR_STRS[strtolower('The style to display the category')] = 'The style to display the category';
		$TR_STRS[strtolower('Randomly choose one at a time')] = 'Randomly choose one at a time';
		$TR_STRS[strtolower('Show images')] = 'Show images';
		$TR_STRS[strtolower('Display content item images')] = 'Display content item images';
		$TR_STRS[strtolower('Linked Titles')] = 'Linked Titles';
		$TR_STRS[strtolower('Make the Item titles linkable')] = 'Make the Item titles linkable';
		$TR_STRS[strtolower('Use Global')] = 'Use Global';
		$TR_STRS[strtolower('Read More')] = 'Read More';
		$TR_STRS[strtolower('Show/Hide the Read More button')] = 'Show/Hide the Read More button';
		$TR_STRS[strtolower('Item Title')] = 'Item Title';
		$TR_STRS[strtolower('Show item title')] = 'Show item title';
		$TR_STRS[strtolower('No. of Items')] = 'No. of Items';
		$TR_STRS[strtolower('No of items to display')] = 'No of items to display';
		$TR_STRS[strtolower('Poll')] = 'Poll';
		$TR_STRS[strtolower('Random Image')] = 'Random Image';
		$TR_STRS[strtolower('Image Type')] = 'Image Type';
		$TR_STRS[strtolower('Type of image PNG/GIF/JPG etc. (default is JPG)')] = 'Type of image PNG/GIF/JPG etc. (default is JPG)';
		$TR_STRS[strtolower('Image Folder')] = 'Image Folder';
		$TR_STRS[strtolower('Path to the image folder relative to the site url, eg: images/stories')] = 'Path to the image folder relative to the site url, eg: images/stories';
		$TR_STRS[strtolower('Link')] = 'Link';
		$TR_STRS[strtolower('A URL to redirect to if image is clicked on, eg: http://www.mamboserver.com')] = 'A URL to redirect to if image is clicked on, eg: http://www.mamboserver.com';
		$TR_STRS[strtolower('Width (px)')] = 'Width (px)';
		$TR_STRS[strtolower('Image width (forces all images to be displayed with this width)')] = 'Image width (forces all images to be displayed with this width)';
		$TR_STRS[strtolower('Height (px)')] = 'Height (px)';
		$TR_STRS[strtolower('Image height (forces all images to be displayed with the height)')] = 'Image height (forces all images to be displayed with the height)';
		$TR_STRS[strtolower('Related Items')] = 'Related Items';
		$TR_STRS[strtolower('Text')] = 'Text';
		$TR_STRS[strtolower('Enter the text to be displayed along with the RSS links')] = 'Enter the text to be displayed along with the RSS links';
		$TR_STRS[strtolower('Show/Hide RSS 0.91 Link')] = 'Show/Hide RSS 0.91 Link';
		$TR_STRS[strtolower('Show/Hide RSS 1.0 Link')] = 'Show/Hide RSS 1.0 Link';
		$TR_STRS[strtolower('Show/Hide RSS 2.0 Link')] = 'Show/Hide RSS 2.0 Link';
		$TR_STRS[strtolower('Show/Hide Atom 0.3 Link')] = 'Show/Hide Atom 0.3 Link';
		$TR_STRS[strtolower('Show/Hide OPML Link')] = 'Show/Hide OPML Link';
		$TR_STRS[strtolower('RSS 0.91 Image')] = 'RSS 0.91 Image';
		$TR_STRS[strtolower('Choose the image to be used')] = 'Choose the image to be used';
		$TR_STRS[strtolower('RSS 1.0 Image')] = 'RSS 1.0 Image';
		$TR_STRS[strtolower('RSS 2.0 Image')] = 'RSS 2.0 Image';
		$TR_STRS[strtolower('Atom Image')] = 'Atom Image';
		$TR_STRS[strtolower('OPML Image')] = 'OPML Image';
		$TR_STRS[strtolower('Search Module')] = 'Search Module';
		$TR_STRS[strtolower('Box Width')] = 'Box Width';
		$TR_STRS[strtolower('Size of the search text box')] = 'Size of the search text box';
		$TR_STRS[strtolower('The text that appears in the search text box, if left blank it will load _SEARCH_BOX from your language file')] = 'The text that appears in the search text box, if left blank it will load _SEARCH_BOX from your language file';
		$TR_STRS[strtolower('Search Button')] = 'Search Button';
		$TR_STRS[strtolower('Display a Search Button')] = 'Display a Search Button';
		$TR_STRS[strtolower('Button Position')] = 'Button Position';
		$TR_STRS[strtolower('Position of the button relative to the search box')] = 'Position of the button relative to the search box';
		$TR_STRS[strtolower('Top')] = 'Top';
		$TR_STRS[strtolower('Bottom')] = 'Bottom';
		$TR_STRS[strtolower('Button Text')] = 'Button Text';
		$TR_STRS[strtolower('The text that appears in the search button, if left blank it will load _SEARCH_TITLE from your language file')] = 'The text that appears in the search button, if left blank it will load _SEARCH_TITLE from your language file';
		$TR_STRS[strtolower('Sections')] = 'Sections';
		$TR_STRS[strtolower('Statistics')] = 'Statistics';
		$TR_STRS[strtolower('Server Info')] = 'Server Info';
		$TR_STRS[strtolower('Display server information')] = 'Display server information';
		$TR_STRS[strtolower('Site Info')] = 'Site Info';
		$TR_STRS[strtolower('Display site information')] = 'Display site information';
		$TR_STRS[strtolower('Hit Counter')] = 'Hit Counter';
		$TR_STRS[strtolower('Display hit counter')] = 'Display hit counter';
		$TR_STRS[strtolower('Increase counter')] = 'Increase counter';
		$TR_STRS[strtolower('Enter the amount of hits to increase counter by')] = 'Enter the amount of hits to increase counter by';
		$TR_STRS[strtolower('Template Chooser')] = 'Template Chooser';
		$TR_STRS[strtolower('Max. Name Length')] = 'Max. Name Length';
		$TR_STRS[strtolower('This is the maximum length of the template name to display (default 20)')] = 'This is the maximum length of the template name to display (default 20)';
		$TR_STRS[strtolower('Show Preview')] = 'Show Preview';
		$TR_STRS[strtolower('Template preview is to be shown')] = 'Template preview is to be shown';
		$TR_STRS[strtolower('This is the width of the preview image (default 140)')] = 'This is the width of the preview image (default 140)';
		$TR_STRS[strtolower('This is the height of the preview image (default 90)')] = 'This is the height of the preview image (default 90)';
		$TR_STRS[strtolower("Who's Online")] = "Who's Online";
		$TR_STRS[strtolower('Display')] = 'Display';
		$TR_STRS[strtolower('Select what shall be shown')] = 'Select what shall be shown';
		$TR_STRS[strtolower('# of Guests/Members<br>')] = '# of Guests/Members<br>';
		$TR_STRS[strtolower('Member Names<br>')] = 'Member Names<br>';
		$TR_STRS[strtolower('Wrapper Module')] = 'Wrapper Module';
		$TR_STRS[strtolower('Url')] = 'Url';
		$TR_STRS[strtolower('Url to site/file you wish to display within the Iframe')] = 'Url to site/file you wish to display within the Iframe';
		$TR_STRS[strtolower('Scroll Bars')] = 'Scroll Bars';
		$TR_STRS[strtolower('Show/Hide Horizontal & Vertical scroll bars.')] = 'Show/Hide Horizontal & Vertical scroll bars.';
		$TR_STRS[strtolower('Auto')] = 'Auto';
		$TR_STRS[strtolower('Width of the IFrame Window, you can enter an absolute figure in pixels, or a relative figure by adding a %')] = 'Width of the IFrame Window, you can enter an absolute figure in pixels, or a relative figure by adding a %';
		$TR_STRS[strtolower('Height of the IFrame Window')] = 'Height of the IFrame Window';
		$TR_STRS[strtolower('Auto Height')] = 'Auto Height';
		$TR_STRS[strtolower('The height will automatically be set to the size of the external page. This will only work for pages on your own domain.')] = 'The height will automatically be set to the size of the external page. This will only work for pages on your own domain.';
		$TR_STRS[strtolower('Auto Add')] = 'Auto Add';
		$TR_STRS[strtolower('By default http:// will be added unless it detects http:// or https:// in the url link you provide, this allow you to switch this ability off')] = 'By default http:// will be added unless it detects http:// or https:// in the url link you provide, this allow you to switch this ability off';

		$TR_STRS[strtolower('Search')] = 'Search';
		$TR_STRS[strtolower('User Menu')] = 'User Menu';
		$TR_STRS[strtolower('Top Menu')] = 'Top Menu';
		$TR_STRS[strtolower('Other Menu')] = 'Other Menu';
		$TR_STRS[strtolower('Wrapper')] = 'Wrapper';
		$TR_STRS[strtolower('Popular')] = 'Popular';

		$TR_STRS[strtolower('RSS URL')] = 'RSS URL';
		$TR_STRS[strtolower('Enter the URL of the RSS/RDF feed')] = 'Enter the URL of the RSS/RDF feed';
		$TR_STRS[strtolower('Feed Description')] = 'Feed Description';
		$TR_STRS[strtolower('Show the description text for the whole Feed')] = 'Show the description text for the whole Feed';
		$TR_STRS[strtolower('Feed Image')] = 'Feed Image';
		$TR_STRS[strtolower('Show the image associated with the whole Feed')] = 'Show the image associated with the whole Feed';
		$TR_STRS[strtolower('Items')] = 'Items';
		$TR_STRS[strtolower('Enter number of RSS items to display')] = 'Enter number of RSS items to display';
		$TR_STRS[strtolower('Item Description')] = 'Item Description';
		$TR_STRS[strtolower('Show the description or intro text of individual news items')] = 'Show the description or intro text of individual news items';

		//administrator/modules XML file
		$TR_STRS[strtolower('Logged')] = 'Logged';
		$TR_STRS[strtolower('Logged in Users')] = 'Logged in Users';
		$TR_STRS[strtolower('Components')] = 'Components';
		$TR_STRS[strtolower('Popular Items')] = 'Popular Items';
		$TR_STRS[strtolower('Latest Items')] = 'Latest Items';
		$TR_STRS[strtolower('Menu Stats')] = 'Menu Stats';
		$TR_STRS[strtolower('Unread Messages')] = 'Unread Messages';
		$TR_STRS[strtolower('Online Users')] = 'Online Users';
		$TR_STRS[strtolower('Quick Icons')] = 'Quick Icons';
		$TR_STRS[strtolower('System Message')] = 'System Message';
		$TR_STRS[strtolower('Pathway')] = 'Pathway';
		$TR_STRS[strtolower('Toolbar')] = 'Toolbar';
		$TR_STRS[strtolower('Full Menu')] = 'Full Menu';

		//mambots XML file
		$TR_STRS[strtolower('MOS Image')] = 'MOS Image';
		$TR_STRS[strtolower('Legacy Mambot Includer')] = 'Legacy Mambot Includer';
		$TR_STRS[strtolower('Code support')] = 'Code support';
		$TR_STRS[strtolower('SEF')] = 'SEF';
		$TR_STRS[strtolower('MOS Rating')] = 'MOS Rating';
		$TR_STRS[strtolower('Email Cloaking')] = 'Email Cloaking';
		$TR_STRS[strtolower('GeSHi')] = 'GeSHi';
		$TR_STRS[strtolower('Load Module Positions')] = 'Load Module Positions';
		$TR_STRS[strtolower('MOS Pagination')] = 'MOS Pagination';
		$TR_STRS[strtolower('No WYSIWYG Editor')] = 'No WYSIWYG Editor';
		$TR_STRS[strtolower('TinyMCE WYSIWYG Editor')] = 'TinyMCE WYSIWYG Editor';
		$TR_STRS[strtolower('MOS Image Editor Button')] = 'MOS Image Editor Button';
		$TR_STRS[strtolower('MOS Pagebreak Editor Button')] = 'MOS Pagebreak Editor Button';
		$TR_STRS[strtolower('Search Content')] = 'Search Content';
		$TR_STRS[strtolower('Search Weblinks')] = 'Search Weblinks';
		$TR_STRS[strtolower('Search Contacts')] = 'Search Contacts';
		$TR_STRS[strtolower('Search Categories')] = 'Search Categories';
		$TR_STRS[strtolower('Search Sections')] = 'Search Sections';
		$TR_STRS[strtolower('Search Newsfeeds')] = 'Search Newsfeeds';

		$TR_STRS[strtolower('Mode')] = 'Mode';
		$TR_STRS[strtolower('Select how the emails will be displayed')] = 'Select how the emails will be displayed';
		$TR_STRS[strtolower('Nonlinkable Text')] = 'Nonlinkable Text';
		$TR_STRS[strtolower('As linkable mailto address')] = 'As linkable mailto address';
		$TR_STRS[strtolower('Margin')] = 'Margin';
		$TR_STRS[strtolower('Margin in px, of Div surrounding Image & Caption - only applies if using a Caption')] = 'Margin in px, of Div surrounding Image & Caption - only applies if using a Caption';
		$TR_STRS[strtolower('Padding')] = 'Padding';
		$TR_STRS[strtolower('Padding in px, of Div surrounding Image & Caption - only applies if using a Caption')] = 'Padding in px, of Div surrounding Image & Caption - only applies if using a Caption';
		$TR_STRS[strtolower('Wrapped by Table - Column')] = 'Wrapped by Table - Column';
		$TR_STRS[strtolower('Wrapped by Table - Horizontal')] = 'Wrapped by Table - Horizontal';
		$TR_STRS[strtolower('Wrapped by Divs')] = 'Wrapped by Divs';
		$TR_STRS[strtolower('No wrapping - raw output')] = 'No wrapping - raw output';
		$TR_STRS[strtolower('Site Title')] = 'Site Title';
		$TR_STRS[strtolower('title and heading attibutes from mambot added to Site Title tag')] = 'title and heading attibutes from mambot added to Site Title tag';

		$TR_STRS[strtolower('Functionality')] = 'Functionality';
		$TR_STRS[strtolower('Select functionality')] = 'Select functionality';
		$TR_STRS[strtolower('Basic')] = 'Basic';
		$TR_STRS[strtolower('Advanced')] = 'Advanced';
		$TR_STRS[strtolower('Text Direction')] = 'Text Direction';
		$TR_STRS[strtolower('Ability to change text direction')] = 'Ability to change text direction';
		$TR_STRS[strtolower('Left to Right')] = 'Left to Right';
		$TR_STRS[strtolower('Right to Left')] = 'Right to Left';
		$TR_STRS[strtolower('Prohibited Elements')] = 'Prohibited Elements';
		$TR_STRS[strtolower('Elements that will be cleaned from the text')] = 'Elements that will be cleaned from the text';
		$TR_STRS[strtolower('Template CSS classes')] = 'Template CSS classes';
		$TR_STRS[strtolower('Load CSS classes from template_css.css')] = 'Load CSS classes from template_css.css';
		$TR_STRS[strtolower('Custom CSS Classes')] = 'Custom CSS Classes';
		$TR_STRS[strtolower('You can specify the loading of a custom CSS file - simply enter the FULL path to the css file you want loaded')] = 'You can specify the loading of a custom CSS file - simply enter the FULL path to the css file you want loaded';
		$TR_STRS[strtolower('Newlines')] = 'Newlines';
		$TR_STRS[strtolower('Newlines will be made into the selected option')] = 'Newlines will be made into the selected option';
		$TR_STRS[strtolower('BR Elements')] = 'BR Elements';
		$TR_STRS[strtolower('P Elements')] = 'P Elements';
		$TR_STRS[strtolower('Position of the toolbar')] = 'Position of the toolbar';
		$TR_STRS[strtolower('Popup Height')] = 'Popup Height';
		$TR_STRS[strtolower('Height of HTML mode pop-up window - only in Advanced Mode')] = 'Height of HTML mode pop-up window - only in Advanced Mode';
		$TR_STRS[strtolower('Popup Width')] = 'Popup Width';
		$TR_STRS[strtolower('Width of HTML mode pop-up window - only in Advanced Mode')] = 'Width of HTML mode pop-up window - only in Advanced Mode';

		//administrator/components/com_contact/contact.xml
		$TR_STRS[strtolower('Contact')] = 'Contact';
		$TR_STRS[strtolower('This component shows a listing of Contact Information')] = 'This component shows a listing of Contact Information';
		$TR_STRS[strtolower('Page Title')] = 'Page Title';
		$TR_STRS[strtolower('Show/Hide the pages Title')] = 'Show/Hide the pages Title';
		$TR_STRS[strtolower('Text to display at the top of the page. If left blank, the Menu name will be used instead')] = 'Text to display at the top of the page. If left blank, the Menu name will be used instead';
		$TR_STRS[strtolower('Category List - Category')] = 'Category List - Category';
		$TR_STRS[strtolower('Show/Hide the List of Categories in Table view page')] = 'Show/Hide the List of Categories in Table view page';
		$TR_STRS[strtolower('Category Description')] = 'Category Description';
		$TR_STRS[strtolower('Show/Hide the Description for the list of other catgeories')] = 'Show/Hide the Description for the list of other catgeories';
		$TR_STRS[strtolower('# Category Items')] = '# Category Items';
		$TR_STRS[strtolower('Show/Hide the number of items in each category')] = 'Show/Hide the number of items in each category';
		$TR_STRS[strtolower('Show/Hide the Description below')] = 'Show/Hide the Description below';
		$TR_STRS[strtolower('Description for page, if left blank it will load _WEBLINKS_DESC from your language file')] = 'Description for page, if left blank it will load _WEBLINKS_DESC from your language file';
		$TR_STRS[strtolower('Image for page, must be located in the /images/stories folder. Default will load web_links.jpg, No image will mean an image is not loaded')] = 'Image for page, must be located in the /images/stories folder. Default will load web_links.jpg, No image will mean an image is not loaded';
		$TR_STRS[strtolower('Image Align')] = 'Image Align';
		$TR_STRS[strtolower('Alignment of the image')] = 'Alignment of the image';
		$TR_STRS[strtolower('Table Headings')] = 'Table Headings';
		$TR_STRS[strtolower('Show/Hide the Table Headings')] = 'Show/Hide the Table Headings';
		$TR_STRS[strtolower('Position Column')] = 'Position Column';
		$TR_STRS[strtolower('Show/Hide the Position column')] = 'Show/Hide the Position column';
		$TR_STRS[strtolower('Email Column')] = 'Email Column';
		$TR_STRS[strtolower('Show/Hide the Email column')] = 'Show/Hide the Email column';
		$TR_STRS[strtolower('Telephone Column')] = 'Telephone Column';
		$TR_STRS[strtolower('Show/Hide the Telephone column')] = 'Show/Hide the Telephone column';
		$TR_STRS[strtolower('Fax Column')] = 'Fax Column';
		$TR_STRS[strtolower('Show/Hide the Fax column')] = 'Show/Hide the Fax column';

		//administrator/components/com_contact/contact_items.xml
		$TR_STRS[strtolower('Contact Items')] = 'Contact Items';
		$TR_STRS[strtolower('Parameters for individual Contact Items')] = 'Parameters for individual Contact Items';
		$TR_STRS[strtolower('Menu Image')] = 'Menu Image';
		$TR_STRS[strtolower('A small image to be placed to the left or right of your menu item, images must be in images/stories/')] = 'A small image to be placed to the left or right of your menu item, images must be in images/stories/';
		$TR_STRS[strtolower('Page Class Suffix')] = 'Page Class Suffix';
		$TR_STRS[strtolower('A suffix to be applied to the css classes of the page, this allows individual page styling')] = 'A suffix to be applied to the css classes of the page, this allows individual page styling';
		$TR_STRS[strtolower('Print Icon')] = 'Print Icon';
		$TR_STRS[strtolower('Show/Hide the item print button - only affects this page')] = 'Show/Hide the item print button - only affects this page';
		$TR_STRS[strtolower('Back Button')] = 'Back Button';
		$TR_STRS[strtolower('Show/Hide a Back Button, that returns you to the previously view page')] = 'Show/Hide a Back Button, that returns you to the previously view page';
		$TR_STRS[strtolower('Name')] = 'Name';
		$TR_STRS[strtolower('Show/Hide the name info')] = 'Show/Hide the name info';
		$TR_STRS[strtolower('Position')] = 'Position';
		$TR_STRS[strtolower('Show/Hide the position info')] = 'Show/Hide the position info';
		$TR_STRS[strtolower('Email')] = 'Email';
		$TR_STRS[strtolower('Show/Hide the email info, if you set to show the address will be protected from spambots by javascript cloaking')] = 'Show/Hide the email info, if you set to show the address will be protected from spambots by javascript cloaking';
		$TR_STRS[strtolower('Street Address')] = 'Street Address';
		$TR_STRS[strtolower('Show/Hide the street address info')] = 'Show/Hide the street address info';
		$TR_STRS[strtolower('Town/Suburb')] = 'Town/Suburb';
		$TR_STRS[strtolower('Show/Hide the suburb info')] = 'Show/Hide the suburb info';
		$TR_STRS[strtolower('State')] = 'State';
		$TR_STRS[strtolower('Show/Hide the state info')] = 'Show/Hide the state info';
		$TR_STRS[strtolower('Country')] = 'Country';
		$TR_STRS[strtolower('Show/Hide the country info')] = 'Show/Hide the country info';
		$TR_STRS[strtolower('Post/Zip Code')] = 'Post/Zip Code';
		$TR_STRS[strtolower('Show/Hide the post code info')] = 'Show/Hide the post code info';
		$TR_STRS[strtolower('Telephone')] = 'Telephone';
		$TR_STRS[strtolower('Show/Hide the telephone info')] = 'Show/Hide the telephone info';
		$TR_STRS[strtolower('Fax')] = 'Fax';
		$TR_STRS[strtolower('Show/Hide the fax info')] = 'Show/Hide the fax info';
		$TR_STRS[strtolower('Misc Info')] = 'Misc Info';
		$TR_STRS[strtolower('Show/Hide the misc info')] = 'Show/Hide the misc info';
		$TR_STRS[strtolower('Vcard')] = 'Vcard';
		$TR_STRS[strtolower('Show/Hide the Vcard')] = 'Show/Hide the Vcard';
		$TR_STRS[strtolower('Image')] = 'Image';
		$TR_STRS[strtolower('Show/Hide the image')] = 'Show/Hide the image';
		$TR_STRS[strtolower('Email description')] = 'Email description';
		$TR_STRS[strtolower('Show/Hide the Description Text below')] = 'Show/Hide the Description Text below';
		$TR_STRS[strtolower('Description text')] = 'Description text';
		$TR_STRS[strtolower('The Description text for the Email form, if left blank it will use the _EMAIL_DESCRIPTION language definition')] = 'The Description text for the Email form, if left blank it will use the _EMAIL_DESCRIPTION language definition';
		$TR_STRS[strtolower('Email Form')] = 'Email Form';
		$TR_STRS[strtolower('Show/Hide the email to form')] = 'Show/Hide the email to form';
		$TR_STRS[strtolower('Email Copy')] = 'Email Copy';
		$TR_STRS[strtolower('Show/Hide the checkbox to email a copy to the senders address')] = 'Show/Hide the checkbox to email a copy to the senders address';
		$TR_STRS[strtolower('Drop Down')] = 'Drop Down';
		$TR_STRS[strtolower('Show/Hide the Drop Down select list in Contact view')] = 'Show/Hide the Drop Down select list in Contact view';
		$TR_STRS[strtolower('Icons/text')] = 'Icons/text';
		$TR_STRS[strtolower('Use Icons, text or nothing next to the contact information displayed')] = 'Use Icons, text or nothing next to the contact information displayed';
		$TR_STRS[strtolower('Icons')] = 'Icons';
		$TR_STRS[strtolower('Address Icon')] = 'Address Icon';
		$TR_STRS[strtolower('Icon for the Address info')] = 'Icon for the Address info';
		$TR_STRS[strtolower('Email Icon')] = 'Email Icon';
		$TR_STRS[strtolower('Icon for the Email info')] = 'Icon for the Email info';
		$TR_STRS[strtolower('Telephone Icon')] = 'Telephone Icon';
		$TR_STRS[strtolower('Icon for the Telephone info')] = 'Icon for the Telephone info';
		$TR_STRS[strtolower('Fax Icon')] = 'Fax Icon';
		$TR_STRS[strtolower('Icon for the Fax info')] = 'Icon for the Fax info';
		$TR_STRS[strtolower('Misc Icon')] = 'Misc Icon';
		$TR_STRS[strtolower('Icon for the Misc info')] = 'Icon for the Misc info';

		//administrator/components/com_content XML files
		$TR_STRS[strtolower('Content Page')] = 'Content Page';
		$TR_STRS[strtolower('This shows a single content page')] = 'This shows a single content page';
		$TR_STRS[strtolower('Item Title')] = 'Item Title';
		$TR_STRS[strtolower('Show/Hide the items title')] = 'Show/Hide the items title';
		$TR_STRS[strtolower('Make your Item titles linkable')] = 'Make your Item titles linkable';
		$TR_STRS[strtolower('Intro Text')] = 'Intro Text';
		$TR_STRS[strtolower('Show/Hide the intro text')] = 'Show/Hide the intro text';
		$TR_STRS[strtolower('Section Name')] = 'Section Name';
		$TR_STRS[strtolower('Show/Hide the Section the item belongs to')] = 'Show/Hide the Section the item belongs to';
		$TR_STRS[strtolower('Section Name Linkable')] = 'Section Name Linkable';
		$TR_STRS[strtolower('Make the Section text a link to the actual section page')] = 'Make the Section text a link to the actual section page';
		$TR_STRS[strtolower('Category Name')] = 'Category Name';
		$TR_STRS[strtolower('Show/Hide the Category the item belongs to')] = 'Show/Hide the Category the item belongs to';
		$TR_STRS[strtolower('Category Name Linkable')] = 'Category Name Linkable';
		$TR_STRS[strtolower('Make the Category text a link to the actual Category page')] = 'Make the Category text a link to the actual Category page';
		$TR_STRS[strtolower('Item Rating')] = 'Item Rating';
		$TR_STRS[strtolower('Show/Hide the item rating - only affects this page')] = 'Show/Hide the item rating - only affects this page';
		$TR_STRS[strtolower('Author Names')] = 'Author Names';
		$TR_STRS[strtolower('Show/Hide the item author - only affects this page')] = 'Show/Hide the item author - only affects this page';
		$TR_STRS[strtolower('Created Date and Time')] = 'Created Date and Time';
		$TR_STRS[strtolower('Show/Hide the item creation date - only affects this page')] = 'Show/Hide the item creation date - only affects this page';
		$TR_STRS[strtolower('Modified Date and Time')] = 'Modified Date and Time';
		$TR_STRS[strtolower('Show/Hide the item modification date - only affects this page')] = 'Show/Hide the item modification date - only affects this page';
		$TR_STRS[strtolower('Show/Hide the item pdf button - only affects this page')] = 'Show/Hide the item pdf button - only affects this page';
		$TR_STRS[strtolower('Show/Hide the item email button - only affects this page')] = 'Show/Hide the item email button - only affects this page';
		$TR_STRS[strtolower('Key Reference')] = 'Key Reference';
		$TR_STRS[strtolower('A text key that an item may be referenced by (like a help reference)')] = 'A text key that an item may be referenced by (like a help reference)';

		//administrator/components/com_frontpage/frontpage.xml
		$TR_STRS[strtolower('Frontpage')] = 'Frontpage';
		$TR_STRS[strtolower('This component shows all the published content items from your site marked Show on Frontpage.')] = 'This component shows all the published content items from your site marked Show on Frontpage.';
		$TR_STRS[strtolower('Text to display at the top of the page')] = 'Text to display at the top of the page';
		$TR_STRS[strtolower('Show/Hide the Page title')] = 'Show/Hide the Page title';
		$TR_STRS[strtolower('# Leading')] = '# Leading';
		$TR_STRS[strtolower('Number of Items to display as a leading (full width) item. 0 will mean that no items will be displayed as leading.')] = 'Number of Items to display as a leading (full width) item. 0 will mean that no items will be displayed as leading.';
		$TR_STRS[strtolower('# Intro')] = '# Intro';
		$TR_STRS[strtolower('Number of Items to display with the introduction text shown.')] = 'Number of Items to display with the introduction text shown.';
		$TR_STRS[strtolower('Columns')] = 'Columns';
		$TR_STRS[strtolower('When displaying the intro text, how many columns to use per row')] = 'When displaying the intro text, how many columns to use per row';
		$TR_STRS[strtolower('# Links')] = '# Links';
		$TR_STRS[strtolower('Number of Items to display as Links.')] = 'Number of Items to display as Links.';
		$TR_STRS[strtolower('Items Order')] = 'Items Order';
		$TR_STRS[strtolower('Order that the items will be displayed in.')] = 'Order that the items will be displayed in.';
		$TR_STRS[strtolower('Pagination')] = 'Pagination';
		$TR_STRS[strtolower('Show/Hide Pagination support')] = 'Show/Hide Pagination support';
		$TR_STRS[strtolower('Pagination Results')] = 'Pagination Results';
		$TR_STRS[strtolower('Show/Hide Pagination Results info ( e.g 1-4 of 4 )')] = 'Show/Hide Pagination Results info ( e.g 1-4 of 4 )';
		$TR_STRS[strtolower('Item Titles')] = 'Item Titles';
		$TR_STRS[strtolower('Show/Hide the Read More link')] = 'Show/Hide the Read More link';
		$TR_STRS[strtolower('PDF Icon')] = 'PDF Icon';

		//administrator/components/com_login/login.xml
		$TR_STRS[strtolower('Login Page Title')] = 'Login Page Title';
		$TR_STRS[strtolower('Login JS Message')] = 'Login JS Message';
		$TR_STRS[strtolower('Login Description')] = 'Login Description';
		$TR_STRS[strtolower('Show/Hide the Login Description below')] = 'Show/Hide the Login Description below';
		$TR_STRS[strtolower('Login Description Text')] = 'Login Description Text';
		$TR_STRS[strtolower('Text to display on the login Page, if left blank _LOGIN_DESCRIPTION will be used')] = 'Text to display on the login Page, if left blank _LOGIN_DESCRIPTION will be used';
		$TR_STRS[strtolower('Login Image')] = 'Login Image';
		$TR_STRS[strtolower('Image for the Login Page')] = 'Image for the Login Page';
		$TR_STRS[strtolower('Login Image Align')] = 'Login Image Align';
		$TR_STRS[strtolower('Alignment for Login Image')] = 'Alignment for Login Image';
		$TR_STRS[strtolower('Logout Page Title')] = 'Logout Page Title';
		$TR_STRS[strtolower('What page will be redirected to after logout, if let blank will load front page')] = 'What page will be redirected to after logout, if let blank will load front page';
		$TR_STRS[strtolower('Logout JS Message')] = 'Logout JS Message';
		$TR_STRS[strtolower('Logout Description')] = 'Logout Description';
		$TR_STRS[strtolower('Show/Hide the Logout Description below')] = 'Show/Hide the Logout Description below';
		$TR_STRS[strtolower('Logout Description Text')] = 'Logout Description Text';
		$TR_STRS[strtolower('Text to display on the logout Page, if left blank _LOGOUT_DESCRIPTION will be used')] = 'Text to display on the logout Page, if left blank _LOGOUT_DESCRIPTION will be used';
		$TR_STRS[strtolower('Logout Image')] = 'Logout Image';
		$TR_STRS[strtolower('Image for the Logout Page')] = 'Image for the Logout Page';
		$TR_STRS[strtolower('Logout Image Align')] = 'Logout Image Align';
		$TR_STRS[strtolower('Alignment for Logout Image')] = 'Alignment for Logout Image';

		//administrator/components/com_newsfeeds/newsfeeds.xml
		$TR_STRS[strtolower('Newsfeeds')] = 'Newsfeeds';
		$TR_STRS[strtolower('This component manages RSS/RDF newsfeeds')] = 'This component manages RSS/RDF newsfeeds';
		$TR_STRS[strtolower('Name Column')] = 'Name Column';
		$TR_STRS[strtolower('Show/Hide the Feed Name column')] = 'Show/Hide the Feed Name column';
		$TR_STRS[strtolower('# Articles Column')] = '# Articles Column';
		$TR_STRS[strtolower('Show/Hide the # of articles in the feed')] = 'Show/Hide the # of articles in the feed';
		$TR_STRS[strtolower('Link Column')] = 'Link Column';
		$TR_STRS[strtolower('Show/Hide the Feed Link column')] = 'Show/Hide the Feed Link column';
		$TR_STRS[strtolower('Show/Hide the image of the feed')] = 'Show/Hide the image of the feed';
		$TR_STRS[strtolower('Show/Hide the description text of the feed')] = 'Show/Hide the description text of the feed';
		$TR_STRS[strtolower('Show/Hide the description or intro text of an item')] = 'Show/Hide the description or intro text of an item';

		//administrator/components/com_syndicate XML files
		$TR_STRS[strtolower('Syndicate')] = 'Syndicate';
		$TR_STRS[strtolower('This component controls the Syndication settings')] = 'This component controls the Syndication settings';
		$TR_STRS[strtolower('Cache')] = 'Cache';
		$TR_STRS[strtolower('Cache the feed files')] = 'Cache the feed files';
		$TR_STRS[strtolower('Cache Time')] = 'Cache Time';
		$TR_STRS[strtolower('Cache file will refresh every x seconds')] = 'Cache file will refresh every x seconds';
		$TR_STRS[strtolower('# Items')] = '# Items';
		$TR_STRS[strtolower('Number of Items to syndicate')] = 'Number of Items to syndicate';
		$TR_STRS[strtolower('Title')] = 'Title';
		$TR_STRS[strtolower('Syndication Title')] = 'Syndication Title';
		$TR_STRS[strtolower('Description')] = 'Description';
		$TR_STRS[strtolower('Syndication Description')] = 'Syndication Description';
		$TR_STRS[strtolower('Image to be included in feed')] = 'Image to be included in feed';
		$TR_STRS[strtolower('Image Alt')] = 'Image Alt';
		$TR_STRS[strtolower('Alt text for image')] = 'Alt text for image';
		$TR_STRS[strtolower('Limit Text')] = 'Limit Text';
		$TR_STRS[strtolower('Limit the article text to the value indicated below')] = 'Limit the article text to the value indicated below';
		$TR_STRS[strtolower('Text Length')] = 'Text Length';
		$TR_STRS[strtolower('The word length of the article text - 0 will show no text')] = 'The word length of the article text - 0 will show no text';
		$TR_STRS[strtolower('Order')] = 'Order';
		$TR_STRS[strtolower('Order that the items will be displayed')] = 'Order that the items will be displayed';
		$TR_STRS[strtolower('Default')] = 'Default';
		$TR_STRS[strtolower('Frontpage Ordering')] = 'Frontpage Ordering';
		$TR_STRS[strtolower('Oldest first')] = 'Oldest first';
		$TR_STRS[strtolower('Most recent first')] = 'Most recent first';
		$TR_STRS[strtolower('Title Alphabetical')] = 'Title Alphabetical';
		$TR_STRS[strtolower('Title Reverse-Alphabetical')] = 'Title Reverse-Alphabetical';
		$TR_STRS[strtolower('Author Alphabetical')] = 'Author Alphabetical';
		$TR_STRS[strtolower('Author Reverse-Alphabetical')] = 'Author Reverse-Alphabetical';
		$TR_STRS[strtolower('Most Hits')] = 'Most Hits';
		$TR_STRS[strtolower('Least Hits')] = 'Least Hits';
		$TR_STRS[strtolower('Ordering')] = 'Ordering';
		$TR_STRS[strtolower('Live Bookmarks')] = 'Live Bookmarks';
		$TR_STRS[strtolower('Activate support for Firefox Live Bookmarks functionality')] = 'Activate support for Firefox Live Bookmarks functionality';
		$TR_STRS[strtolower('Off')] = 'Off';
		$TR_STRS[strtolower('RSS 0.91')] = 'RSS 0.91';
		$TR_STRS[strtolower('RSS 1.0')] = 'RSS 1.0';
		$TR_STRS[strtolower('RSS 2.0')] = 'RSS 2.0';
		$TR_STRS[strtolower('ATOM 0.3')] = 'ATOM 0.3';
		$TR_STRS[strtolower('Bookmark file')] = 'Bookmark file';
		$TR_STRS[strtolower('Special file name, if empty the default will be used.')] = 'Special file name, if empty the default will be used.';

		//administrator/components/com_weblinks/weblinks.xml
		$TR_STRS[strtolower('Hits')] = 'Hits';
		$TR_STRS[strtolower('Show/Hide the Hits column')] = 'Show/Hide the Hits column';
		$TR_STRS[strtolower('Link Descriptions')] = 'Link Descriptions';
		$TR_STRS[strtolower('Show/Hide the Description text of the Links')] = 'Show/Hide the Description text of the Links';
		$TR_STRS[strtolower('Icon')] = 'Icon';
		$TR_STRS[strtolower('Icon to be used to the left of the url links in Table view')] = 'Icon to be used to the left of the url links in Table view';

		//administrator/components/com_weblinks/weblinks_item.xml
		$TR_STRS[strtolower('This component shows a listing of Weblinks')] = 'This component shows a listing of Weblinks';
		$TR_STRS[strtolower('Target')] = 'Target';
		$TR_STRS[strtolower('Target window when the link is clicked')] = 'Target window when the link is clicked';
		$TR_STRS[strtolower('Parent Window With Browser Navigation')] = 'Parent Window With Browser Navigation';
		$TR_STRS[strtolower('New Window With Browser Navigation')] = 'New Window With Browser Navigation';
		$TR_STRS[strtolower('New Window Without Browser Navigation')] = 'New Window Without Browser Navigation';

		//administrator/components/com_menus/contact_category_table/contact_category_table.xml
		$TR_STRS[strtolower('Other Categories')] = 'Other Categories';
		$TR_STRS[strtolower('When viewing a Category, Show/Hide the list of other Categories')] = 'When viewing a Category, Show/Hide the list of other Categories';

		//administrator/components/com_menus/content_blog_category/content_blog_category.xml
		$TR_STRS[strtolower('Show/Hide the Category Description')] = 'Show/Hide the Category Description';
		$TR_STRS[strtolower('Description Image')] = 'Dscription Image';
		$TR_STRS[strtolower('Show/Hide image of the Category Description')] = 'Show/Hide image of the Category Description';

		//administrator/components/com_menus/content_blog_section/content_blog_section.xml
		$TR_STRS[strtolower('Show/Hide the Section Description')] = 'Show/Hide the Section Description';
		$TR_STRS[strtolower('Show/Hide image of the Section Description')] = 'Show/Hide image of the Section Description';
		$TR_STRS[strtolower('Category List')] = 'Category List';
		$TR_STRS[strtolower('Show/Hide the category list of section')] = 'Show/Hide the category list of section';
		$TR_STRS[strtolower('Category Item Count')] = 'Category Item Count';
		$TR_STRS[strtolower('Show/Hide the item count of category')] = 'Show/Hide the item count of category';
		$TR_STRS[strtolower('Categories per Row')] = 'Categories per Row';
		$TR_STRS[strtolower('Number of categories to display per row')] = 'Number of categories to display per row';
		
		//administrator/components/com_menus/content_category/content_category.xml
		$TR_STRS[strtolower('Table - Content Category')] = 'Table - Content Category';
		$TR_STRS[strtolower('Shows a Table view of Content items for a particular Category')] = 'Shows a Table view of Content items for a particular Category';
		$TR_STRS[strtolower('Date Format')] = 'Date Format';
		$TR_STRS[strtolower('The format of the date displayed, using PHPs strftime Command Format - if left blank it will load the format from your language file')] = 'The format of the date displayed, using PHPs strftime Command Format - if left blank it will load the format from your language file';
		$TR_STRS[strtolower('Date Column')] = 'Date Column';
		$TR_STRS[strtolower('Show/Hide the Date column')] = 'Show/Hide the Date column';
		$TR_STRS[strtolower('Author Column')] = 'Author Column';
		$TR_STRS[strtolower('Show/Hide the Author column')] = 'Show/Hide the Author column';
		$TR_STRS[strtolower('Hits Column')] = 'Hits Column';
		$TR_STRS[strtolower('Show/Hide the Hits column')] = 'Show/Hide the Hits column';
		$TR_STRS[strtolower('Navigation Bar')] = 'Navigation Bar';
		$TR_STRS[strtolower('Show/Hide the Navigation bar')] = 'Show/Hide the Navigation bar';
		$TR_STRS[strtolower('Display Number')] = 'Display Number';
		$TR_STRS[strtolower('Number of items to be displayed by default')] = 'Number of items to be displayed by default';
		$TR_STRS[strtolower('Author')] = 'Author';
		
		//administrator/components/com_menus/content_section/content_section.xml
		$TR_STRS[strtolower('Table - Content Section')] = 'Table - Content Section';
		$TR_STRS[strtolower('Creates a listing of Content categories for a particular section')] = 'Creates a listing of Content categories for a particular section';
		$TR_STRS[strtolower('Item List of Category')] = 'Item List of Category';
		$TR_STRS[strtolower('Show/Hide the item list of category')] = 'Show/Hide the item list of category';
		$TR_STRS[strtolower('Item Count')] = 'Item Count';
		$TR_STRS[strtolower('The number of items to display in the item list of category(default is 5)')] = 'The number of items to display in the item list of category(default is 5)';
		$TR_STRS[strtolower('Item List of Section')] = 'Item List of Section';
		$TR_STRS[strtolower('Show/Hide the item list of section')] = 'Show/Hide the item list of section';

		//administrator/components/com_menus/newsfeed_category_table/newsfeed_category_table.xml
		$TR_STRS[strtolower('A small image to be placed to the left or right of your menu item, images must be in /images')] = 'A small image to be placed to the left or right of your menu item, images must be in /images';
		$TR_STRS[strtolower('Articles Column')] = 'Articles Column';
		$TR_STRS[strtolower('Show/Hide the Articles column')] = 'Show/Hide the Articles column';

		//administrator/components/com_menus/wrapper/wrapper.xml
		$TR_STRS[strtolower('Width')] = 'Width';
		$TR_STRS[strtolower('Height')] = 'Height';

		//administrator/components/com_menus all XML files' name and description
		$TR_STRS[strtolower('Link - Component Item')] = 'Link - Component Item';
		$TR_STRS[strtolower('Creates a link to an existing Mambo Component')] = 'Creates a link to an existing Mambo Component';
		$TR_STRS[strtolower('Component')] = 'Component';
		$TR_STRS[strtolower('Displays the frontend interface for a Component')] = 'Displays the frontend interface for a Component';
		$TR_STRS[strtolower('Table - Contact Category')] = 'Table - Contact Category';
		$TR_STRS[strtolower('Shows a Table view of Contact items for a particular Category')] = 'Shows a Table view of Contact items for a particular Category';
		$TR_STRS[strtolower('Link - Contact Item')] = 'Link - Contact Item';
		$TR_STRS[strtolower('Creates a link to a Published Contact Item')] = 'Creates a link to a Published Contact Item';
		$TR_STRS[strtolower('Blog - Content Category')] = 'Blog - Content Category';
		$TR_STRS[strtolower('Displays a page of content items from multiple categories in a blog format')] = 'Displays a page of content items from multiple categories in a blog format';
		$TR_STRS[strtolower('Blog - Content Section')] = 'Blog - Content Section';
		$TR_STRS[strtolower('Displays a page of content items from multiple sections in a blog format')] = 'Displays a page of content items from multiple sections in a blog format';
		$TR_STRS[strtolower('Table - Content Category')] = 'Table - Content Category';
		$TR_STRS[strtolower('Shows a Table view of Content items for a particular Category')] = 'Shows a Table view of Content items for a particular Category';
		$TR_STRS[strtolower('Link - Content Item')] = 'Link - Content Item';
		$TR_STRS[strtolower('Creates a link to a published Content Item in full view')] = 'Creates a link to a published Content Item in full view';
		$TR_STRS[strtolower('Table - Content Section')] = 'Table - Content Section';
		$TR_STRS[strtolower('Creates a listing of Content categories for a particular section')] = 'Creates a listing of Content categories for a particular section';
		$TR_STRS[strtolower('Link - Static Content')] = 'Link - Static Content';
		$TR_STRS[strtolower('Creates a link to Static Content Item')] = 'Creates a link to Static Content Item';
		$TR_STRS[strtolower('Table - Newsfeed Category')] = 'Table - Newsfeed Category';
		$TR_STRS[strtolower('Shows a Table view of Newsfeed items for a particular Category')] = 'Shows a Table view of Newsfeed items for a particular Category';
		$TR_STRS[strtolower('Link - Newsfeed')] = 'Link - Newsfeed';
		$TR_STRS[strtolower('Creates a link to an individual Published Newsfeed')] = 'Creates a link to an individual Published Newsfeed';
		$TR_STRS[strtolower('Separator / Placeholder')] = 'Separator / Placeholder';
		$TR_STRS[strtolower('Creates a menu placeholder or separator')] = 'Creates a menu placeholder or separator';
		$TR_STRS[strtolower('Link - Url')] = 'Link - Url';
		$TR_STRS[strtolower('Creates url link')] = 'Creates url link';
		$TR_STRS[strtolower('Table - Weblink Category')] = 'Table - Weblink Category';
		$TR_STRS[strtolower('Shows a Table view of Weblink items for a particular Weblink Category')] = 'Shows a Table view of Weblink items for a particular Weblink Category';
		$TR_STRS[strtolower('Wrapper')] = 'Wrapper';
		$TR_STRS[strtolower('Creates an IFrame that will wrap an external page/site into Mambo')] = 'Creates an IFrame that will wrap an external page/site into Mambo';

		$TR_STRS[strtolower('Mamhoo')] = 'Mamhoo';
		$TR_STRS[strtolower('Mamhoo User Manager')] = 'Mamhoo User Manager';
		$TR_STRS[strtolower('Mamhoo User Extended Config')] = 'Mamhoo User Extended Config';
		$TR_STRS[strtolower('Install/Uninstall Mamhooks')] = 'Install/Uninstall Mamhooks';
		$TR_STRS[strtolower('About Mamhoo')] = 'About Mamhoo';

	}


}

?>