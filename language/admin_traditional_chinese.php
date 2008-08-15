<?php
/**
* @version $Id: admin_traditional_chinese.php,v 1.9 2008/04/21 11:27:52 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2007 Mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software based on Mambo
* Powered By mambochina.net & mambors.org
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( '禁止直接訪問本文件！' );

// Language and Encode of admin language
DEFINE('_A_LANGUAGE','zh_TW');
DEFINE('_A_ISO','charset=big5');

// needed for $alt text in toolbar item
DEFINE('_A_CANCEL','取消'); 
DEFINE('_A_SAVE','保存'); 
DEFINE('_A_APPLY','應用'); 
DEFINE('_A_CLOSE','關閉'); 
DEFINE('_A_COPY','複製'); 
DEFINE('_A_MOVE','移動'); 
DEFINE('_A_DELETE','刪除'); 
DEFINE('_A_NEXT','下一步'); 
DEFINE('_A_BACK','後退'); 
DEFINE('_A_DEFAULT','默認'); 
DEFINE('_A_RESTORE','恢復');

/**
* @location /../includes/mambo.php
* @desc Includes translations of several droplists and non-translated stuff
*/

//Droplist
DEFINE('_A_TOP','頂級');
DEFINE('_A_ALL','全部');
DEFINE('_A_NONE','無');
DEFINE('_A_SELECT_IMAGE','選擇圖片');
DEFINE('_A_NO_USER','沒有用戶');
DEFINE('_A_CREATE_CAT','必須先創建一個分類');
DEFINE('_A_PARENT_BROWSER_NAV','父窗口，帶瀏覽器導航');
DEFINE('_A_NEW_BROWSER_NAV','新窗口，帶瀏覽器導航');
DEFINE('_A_NEW_W_BROWSER_NAV','新窗口，不帶瀏覽器導航');

//Alt Hover
DEFINE('_A_PENDING','審理中');
DEFINE('_A_VISIBLE','可視的');
DEFINE('_A_FINISHED','已結束');
DEFINE('_A_MOVE_UP','上移');
DEFINE('_A_MOVE_DOWN','下移');


/**
* @desc Includes the main adminLanguage class which refers to var's for translations
*/
class adminLanguage {

var $RTLsupport = false;

var $A_MAIL = '信箱';

//templates/mambo_admin_blue/login.php
var $A_USERNAME = '用戶名';
var $A_PASSWORD = '密碼';
var $A_WELCOME_MAMBO = '<p>歡迎使用Mambo！</p><p>請使用有效的用戶名和密碼來登錄管理後台</p>';
var $A_WARNING_JAVASCRIPT = '！警告！ Javascript 功能必須打開，才能進行正常的管理操作。';

//templates/mambo_admin_blue/index.php
var $A_LOGIN = '登錄';
var $A_GENERATE_TIME = '頁面生成時間：%f 秒';
var $A_LOGOUT = '退出';

//popups/contentwindow.php
var $A_TITLE_CPRE = '內容預覽';
var $A_CLOSE = '關閉';
var $A_PRINT = '打印';

//popups/modulewindow.php
var $A_TITLE_MPRE = '模塊預覽';

//popups/pollwindow.php
var $A_TITLE_PPRE = '在線調查預覽';
var $A_VOTE = '投票';
var $A_RESULTS = '結果';

//popups/uploadimage.php
var $A_TITLE_UPLOAD = '上傳文件';
var $A_FILE_UPLOAD = '文件上傳';
var $A_UPLOAD = '上傳';
var $A_FILE_MAX_SIZE = '最大文件大小'; //Ken ADDED

//modules/mod_components.php
var $A_ERROR = '錯誤！';

//modules/mod_fullmenu.php
var $A_MENU_HOME = '首頁';
var $A_MENU_HOME_PAGE = '管理後台首頁';
var $A_MENU_CTRL_PANEL = '控制面板'; //KEN ADDED
var $A_MENU_SITE = '網站';
var $A_MENU_SITE_MENU = '網站菜單';
var $A_MENU_SITE_MANAGEMENT = '網站管理'; //KEN ADDED
var $A_MENU_CONFIGURATION = '配置';
var $A_MENU_LANGUAGES = '語言';
var $A_MENU_MANAGE_LANG = '管理語言';
var $A_MENU_LANG_MANAGE = '語言管理';
var $A_MENU_INSTALL = '安裝';
var $A_MENU_INSTALL_LANG = '安裝語言';
var $A_MENU_MEDIA_MANAGE = '媒體管理';
var $A_MENU_MANAGE_MEDIA = '管理媒體文件';
var $A_MENU_PREVIEW = '預覽';
var $A_MENU_NEW_WINDOW = '在新窗口打開';
var $A_MENU_INLINE = '嵌入窗口';
var $A_MENU_INLINE_POS = '嵌入窗口（位置）';
var $A_MENU_STATISTICS = '統計';
var $A_MENU_STATISTICS_SITE = '網站統計';
var $A_MENU_BROWSER = '瀏覽器、操作系統、域';
var $A_MENU_PAGE_IMP = '頁面瀏覽';
var $A_MENU_SEARCH_TEXT = '搜索文本';
var $A_MENU_TEMP_MANAGE = '模版管理';
var $A_MENU_TEMP_CHANGE = '更換網站模版';
var $A_MENU_INSTALL_TEMPLATES = '安裝網站模版';//KEN ADDED
var $A_MENU_SITE_TEMP = '網站模版';
var $A_MENU_ADMIN_TEMP = '管理後台模版';
var $A_MENU_ADMIN_CHANGE_TEMP = '更換管理後台模版';
var $A_MENU_INSTALL_ADMIN_TEMPLATES = '安裝後台模版';//KEN ADDED
var $A_MENU_MODUL_POS = '模塊位置';
var $A_MENU_TEMP_POS = '模版位置';
var $A_MENU_USER_MANAGE = '用戶管理';
var $A_MENU_MANAGE_USER = '管理用戶';
var $A_MENU_ADD_EDIT = '新增/編輯用戶';
var $A_MENU_MASS_MAIL = '群發郵件';
var $A_MENU_MAIL_USERS = '發送郵件給一個用戶或一組用戶';
var $A_MENU_MANAGE_STR = '管理網站結構';
var $A_MENU_MANAGEMENT = '菜單管理';//KEN ADDED
var $A_MENU_CONTENT = '內容';
var $A_MENU_CONTENT_MANAGE = '內容管理';
var $A_MENU_CONTENT_MANAGERS = '內容管理';
var $A_MENU_CONTENT_BY_SECTION = '單元內容'; //KEN ADDED
var $A_MENU_MANAGE_CONTENT = '管理內容條目';
var $A_MENU_ITEMS = '條目';
var $A_MENU_ADDNEDIT = '新增/編輯';
var $A_MENU_OTHER_MANAGE = '其它管理';
var $A_MENU_ITEMS_FRONT = '管理首頁條目';
var $A_MENU_ITEMS_CONTENT = '管理靜態內容條目';
var $A_MENU_CONTENT_SEC = '管理內容單元';
var $A_MENU_CONTENT_CAT = '管理內容分類';
var $A_MENU_CATEGORIES = '分類';
var $A_MENU_COMPONENTS = '組件';
var $A_MENU_COMPONENTS_MANAGEMENT = '組件管理';
var $A_MENU_INST_UNST = '安裝/卸載';
var $A_MENU_INST_UNST_COMPONENTS = '安裝/卸載組件';
var $A_MENU_MORE_COMP = '更多組件';
var $A_MENU_MORE_COMP2 = '更多組件...';//KEN ADDED
var $A_MENU_MODULES = '模塊';
var $A_MENU_INST_UNST_MODULES = '安裝/卸載模塊';//KEN ADDED
var $A_MENU_MODULES_MANAGEMENT = '模塊管理'; //KEN ADDED
var $A_MENU_INSTALL_CUST = '安裝定制模塊';
var $A_MENU_SITE_MOD = '網站模塊';
var $A_MENU_SITE_MOD_MANAGE = '管理網站模塊';
var $A_MENU_ADMIN_MOD = '後台模塊';
var $A_MENU_ADMIN_MOD_MANAGE = '管理後台模塊';
var $A_MENU_MAMBOTS = '觸發器';
var $A_MENU_INST_UNST_MAMBOTS = '安裝/卸載觸發器';//KEN ADDED
var $A_MENU_MAMBOTS_MANAGE = '觸發器管理'; //KEN ADDED
var $A_MENU_CUSTOM_MAMBOT = '安裝定制觸發器';
var $A_MENU_SITE_MAMBOT = '網站觸發器';
var $A_MENU_SITE_MAMBOTS = '網站觸發器';
var $A_MENU_MAMBOT_MANAGE = '管理網站觸發器';
var $A_MENU_INSTALLERS = '安裝';//KEN ADDED
var $A_MENU_INSTALLERS_LIST = '安裝列表';//KEN ADDED
var $A_MENU_TEMPLATES_SITE = '模版 - 網站';//KEN ADDED
var $A_MENU_TEMPLATES_SITE_INST = '安裝網站模版';//KEN ADDED
var $A_MENU_TEMPLATES_ADMIN = '模版 - 後台';//KEN ADDED
var $A_MENU_TEMPLATES_ADMIN_INST = '安裝後台模版';//KEN ADDED
var $A_MENU_MESSAGES = '短信';
var $A_MENU_MESSAGES_MANAGEMENT = '消息管理';//KEN ADDED
var $A_MENU_INBOX = '收件箱';
var $A_MENU_PRIV_MSG = '站內短信';
var $A_MENU_GLOBAL_CHECK = '全部放回';
var $A_MENU_CHECK_INOUT = '放回所有取出的條目';
var $A_MENU_SYSTEM_INFO = '系統信息';
var $A_MENU_CLEAN_CACHE = '清空緩存';
var $A_MENU_CLEAN_CACHE_ITEMS = '清空內容條目緩存';
var $A_MENU_BIG_THANKS = '衷心感謝參與者';
var $A_MENU_SUPPORT = '支持';
var $A_MENU_SYSTEM = '系統';
var $A_MENU_SYSTEM_MNG = '系統管理';

//modules/mod_latest.php
var $A_LATEST_ADDED = '最近新增的內容';

//modules/mod_logged.php
var $A_USER_LOGGED = '當前登錄用戶';
var $A_USER_FORCE_LOGOUT = '強制登出用戶';

//modules/mod_online.php
var $A_ONLINE_USERS = '在線用戶';

//modules/mod_popular.php
var $A_POPULAR_MOST = '熱門條目';
var $A_CREATED = '創建';
var $A_HITS = '點擊';

//modules/mod_quickicon.php
var $A_MENU_MANAGER = '菜單管理';
var $A_FRONTPAGE_MANAGER = '首頁管理';
var $A_STATIC_MANAGER = '靜態內容管理';
var $A_SECTION_MANAGER = '單元管理';
var $A_CATEGORY_MANAGER = '分類管理';
var $A_ALL_MANAGER = '內容條目管理';
var $A_GLOBAL_CONF = '全局配置';
var $A_HELP = '幫助';

//includes/menubar.html.php
var $A_NEW = '新增';
var $A_PUBLISH = '發佈';
var $A_DEFAULT = '默認';
var $A_ASSIGN = '分配';
var $A_UNPUBLISH = '取消發佈';
var $A_EDIT = '編輯';
var $A_DELETE = '刪除';
var $A_SAVE = '保存';
var $A_BACK = '後退';
var $A_CANCEL = '取消';

//Alerts
var $A_ALERT_SELECT_TO = '請從列表中選擇條目來';
var $A_ALERT_SELECT_PUB = '請從列表中選擇條目來發佈';
var $A_ALERT_SELECT_PUB_LIST = '請從列表中選擇條目來設為默認';
var $A_ALERT_ITEM_ASSIGN = '請選擇條目來分配';
var $A_ALERT_SELECT_UNPUBLISH = '請從列表中選擇條目來取消發佈';
var $A_ALERT_SELECT_EDIT = '請從列表中選擇條目來編輯';
var $A_ALERT_SELECT_DELETE = '請從列表中選擇條目來刪除';
var $A_ALERT_CONFIRM_DELETE = '確認刪除選中的條目？';

//Alerts
var $A_ALERT_ENTER_PASSWORD = '請輸入密碼'; 
var $A_ALERT_INCORRECT = '無效的用戶名、密碼或訪問級別，請重試';
var $A_ALERT_INCORRECT_TRY = '無效的用戶名或密碼，請重試';
var $A_ALERT_ALPHA = '文件名只能包含字母或數字，不能有空格。';
var $A_ALERT_IMAGE_UPLOAD = '請選擇圖片來上傳';
var $A_ALERT_IMAGE_EXISTS = "圖片 %s 已經存在";
var $A_ALERT_IMAGE_FILENAME = '文件類型必須是 gif, png, jpg, bmp, swf, doc, xls 或 ppt';
var $A_ALERT_UPLOAD_FAILED = "上傳 %s 失敗";
var $A_ALERT_UPLOAD_SUC = "上傳 %s 到 %s 成功 ";
var $A_ALERT_UPLOAD_SUC2 = "上傳 %s 到 %s 成功 ";

//includes/pageNavigation.php
var $A_OF = '/'; 
var $A_NO_RECORD_FOUND = '沒有找到記錄';
var $A_FIRST_PAGE = '第一頁';
var $A_PREVIOUS_PAGE = '上一頁';
var $A_NEXT_PAGE = '下一頁';
var $A_END_PAGE = '最後一頁';
var $A_PREVIOUS = '上一頁';
var $A_NEXT = '下一頁';
var $A_END = '最後一頁';
var $A_DISPLAY = '顯示';
var $A_MOVE_UP = '上移';
var $A_MOVE_DOWN = '下移';

//DIRECTORY COMPONENTS ALL FILES
var $A_COMP_CHECKED_OUT = '取出';
var $A_COMP_TITLE = '標題';
var $A_COMP_IMAGE = '圖片';
var $A_COMP_FRONT_PAGE = '首頁';
var $A_COMP_IMAGE_POSITION = '圖片位置';
var $A_COMP_FILTER = '篩選';
var $A_COMP_ORDERING = '顯示次序';
var $A_COMP_ACCESS_LEVEL = '訪問級別';
var $A_COMP_PUBLISHED = '發佈';
var $A_COMP_PUBLISH = '發佈';
var $A_COMP_UNPUBLISHED = '未發佈';
var $A_COMP_UNPUBLISH = '取消發佈';
var $A_COMP_REORDER = '重新排序';
var $A_COMP_ORDER = '次序';
var $A_COMP_SAVE_ORDER = '保存次序';
var $A_COMP_ACCESS = '訪問';
var $A_COMP_SECTION = '單元';
var $A_COMP_NB = '編號';
var $A_COMP_ACTIVE = '活動條目';
var $A_COMP_DESCRIPTION = '描述';
var $A_COMP_SELECT_MENU_TYPE = '請選擇菜單類型';
var $A_COMP_ENTER_MENU_NAME = '請輸入菜單項名稱';
var $A_COMP_CREATE_MENU_LINK = '確認創建鏈接到菜單？ \n任何對未保存的更改將丟失。';
var $A_COMP_LINK_TO_MENU = '鏈接到菜單';
var $A_COMP_CREATE_MENU = '將在你選擇的菜單上創建新的菜單項';
var $A_COMP_SELECT_MENU = '選擇菜單';
var $A_COMP_MENU_TYPE_SELECT = '選擇菜單類型';
var $A_COMP_MENU_NAME_ITEM = '菜單項名稱';
var $A_COMP_MENU_LINKS = '現有的菜單鏈接';
var $A_COMP_MENU_LINKS_AVAIL = '保存後菜單鏈接就可用';
var $A_COMP_NONE = '無';
var $A_COMP_MENU = '菜單';
var $A_COMP_TYPE = '類型';
var $A_COMP_EDIT = '編輯';
var $A_COMP_NEW = '新增';
var $A_COMP_ADD = '新增';
var $A_COMP_ITEM_NAME = '條目名稱';
var $A_COMP_STATE = '狀態';
var $A_COMP_NAME = '名稱';
var $A_COMP_DEFAULT = '默認';
var $A_COMP_CATEG = '分類';
var $A_COMP_LINK_USER = '關聯用戶';
var $A_COMP_CONTACT = '聯繫人';
var $A_COMP_EMAIL = 'E-mail';
var $A_COMP_PREVIEW = '預覽';
var $A_COMP_ITEMS = '條目';
var $A_COMP_ITEM = '條目';
var $A_COMP_ID = 'ID';
var $A_COMP_EXPIRED = '過期';
var $A_COMP_YES = '是';
var $A_COMP_NO = '否';
var $A_COMP_EDITING = '編輯';
var $A_COMP_ADDING = '新增';
var $A_COMP_HITS = '點擊';
var $A_COMP_SOURCE = '源文件';
var $A_COMP_SEL_ITEM = '選擇條目來';
var $A_COMP_DATE = '日期';
var $A_COMP_AUTHOR = '作者';
var $A_COMP_ANOTHER_ADMIN = '正在被其他管理員編輯。';
var $A_COMP_SAVE_UNWRT = '保存後設置文件為可寫';
var $A_COMP_OVERRIDE_SAVE = '保存時越過寫保護';
var $A_COMP_ORDER_SAVED = '新的次序已保存';
var $A_COMP_NO_PARAMETERS = '沒有參數';
var $A_COMP_POSITION = '位置';
var $A_COMP_SHOW_ADV_DETAILS = '顯示高級明細';
var $A_COMP_HIDE_ADV_DETAILS = '隱藏高級明細';

//components/com_admin/admin.admin.html.php
var $A_COMP_ADMIN_HOME = '首頁';
var $A_COMP_ADMIN_SIMP_MODE = '簡單模式';
var $A_COMP_ADMIN_SIMP_MODE_SELECTED = '簡單模式 (已選)';
var $A_COMP_ADMIN_SIMP_MODE_UNSELECTED = '簡單模式 (未選)';
var $A_COMP_ADMIN_ADV_MODE = '高級模式';
var $A_COMP_ADMIN_ADV_MODE_SELECTED = '高級模式 (已選)';
var $A_COMP_ADMIN_ADV_MODE_UNSELECTED = '高級模式 (未選)';
//var $A_COMP_ADMIN_TITLE = '控制面板';
var $A_COMP_ADMIN_INFO = '信息';
var $A_COMP_ADMIN_SYSTEM = '系統信息';
var $A_COMP_ADMIN_PHP_BUILT_ON = 'PHP系統環境：';
var $A_COMP_ADMIN_DB = '數據庫版本：';
var $A_COMP_ADMIN_PHP_VERSION = 'PHP版本：';
var $A_COMP_ADMIN_SERVER = 'Web服務器：';
var $A_COMP_ADMIN_SERVER_TO_PHP = 'Web服務器和PHP的接口：';
var $A_COMP_ADMIN_MAMBO_VERSION = 'Mambo 版本：';
var $A_COMP_ADMIN_AGENT = '客戶端：';
var $A_COMP_ADMIN_SETTINGS = '相關的PHP設置：';
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
var $A_COMP_ADMIN_WYSIWYG = '可視化編輯器:';
var $A_COMP_ADMIN_CONF_FILE = 'Mambo配置文件：';
var $A_COMP_ADMIN_PHP_INFO2 = 'PHP信息';
var $A_COMP_ADMIN_PHP_INFO = 'PHP信息';
var $A_COMP_ADMIN_PERMISSIONS='權限';
var $A_COMP_ADMIN_DIR_PERM = '目錄權限';
var $A_COMP_ADMIN_FOR_ALL = '為完全發揮Mambo的功能和特性，請將下列目錄設為可寫：';
var $A_COMP_ADMIN_CREDITS = '榮譽';
var $A_COMP_ADMIN_APP = '應用系統';
var $A_COMP_ADMIN_URL = '網址';
var $A_COMP_ADMIN_VERSION = '版本';
var $A_COMP_ADMIN_LICENSE = '許可';
var $A_COMP_ADMIN_CALENDAR = '日曆';
var $A_COMP_ADMIN_PUB_DOMAIN = '公眾域';
var $A_COMP_ADMIN_ICONS = '圖標';
var $A_COMP_ADMIN_INDEX = '索引';
var $A_COMP_ADMIN_SITE_PREVIEW = '網站預覽';
var $A_COMP_ADMIN_OPEN_NEW_WIN = '在新窗口打開';

//components/com_admin/admin.admin.php
var $A_COMP_ALERT_NO_LINK = '此條目沒有關聯的鏈接';

//components/com_banners/admin.banners.html.php
var $A_COMP_BANNERS_MANAGER = '橫幅廣告管理';
var $A_COMP_BANNERS_NAME = '橫幅廣告名稱';
var $A_COMP_BANNERS_IMPRESS_MADE = '已瀏覽數';
var $A_COMP_BANNERS_IMPRESS_LEFT = '剩餘瀏覽數';
var $A_COMP_BANNERS_CLICKS = '點擊';
var $A_COMP_BANNERS_CLICKS2 = '點擊%';
var $A_COMP_BANNERS_PUBLISHED = '發佈';
var $A_COMP_BANNERS_LOCK = '取出';
var $A_COMP_BANNERS_PROVIDE = '請輸入橫幅廣告名稱。';
var $A_COMP_BANNERS_SELECT_IMAGE = '請選擇圖片。';
var $A_COMP_BANNERS_FILL_URL = '請輸入橫幅廣告的網址。';
var $A_COMP_BANNERS_BANNER = '橫幅廣告';
var $A_COMP_BANNERS_DETAILS = '明細';
var $A_COMP_BANNERS_CLIENT = '客戶名稱';
var $A_COMP_BANNERS_PURCHASED = '購買的瀏覽數';
var $A_COMP_BANNERS_UNLIMITED = '無限制';
var $A_COMP_BANNERS_URL = '橫幅廣告網址';
var $A_COMP_BANNERS_SHOW = '顯示橫幅廣告';
var $A_COMP_BANNERS_CLICK_URL = '目標網址';
var $A_COMP_BANNERS_CUSTOM = '定制橫幅廣告代碼';
var $A_COMP_BANNERS_RESET_CLICKS = '點擊數歸零';
var $A_COMP_BANNERS_IMAGE = '橫幅廣告圖片';
var $A_COMP_BANNERS_CLIENT_MANAGER = '橫幅廣告客戶管理';
var $A_COMP_BANNERS_NO_ACTIVE = '激活的橫幅廣告數';
var $A_COMP_BANNERS_FILL_CL_NAME = '請輸入客戶名稱。';
var $A_COMP_BANNERS_FILL_CO_NAME = '請輸入聯繫人。';
var $A_COMP_BANNERS_FILL_CO_EMAIL = '請輸入Email。';
var $A_COMP_BANNERS_TITLE_CLIENT = '橫幅廣告客戶';
var $A_COMP_BANNERS_CONTACT_NAME = '聯繫人';
var $A_COMP_BANNERS_CONTACT_EMAIL = 'Email';
var $A_COMP_BANNERS_EXTRA = '備註';

//components/com_banners/admin.banners.php
var $A_COMP_BANNERS_SELECT_CLIENT = '選擇客戶';
var $A_COMP_BANNERS_THE_CLIENT = '客戶 [ ';
var $A_COMP_BANNERS_EDITED = ' ] 正在被其他管理員編輯。';
var $A_COMP_BANNERS_DEL_CLIENT = '無法刪除客戶，因為還有正在運作的橫幅廣告';

//components/com_categories/admin.categories.html.php
var $A_COMP_CATEG_MANAGER = '分類管理 <small><small>[ 內容: 全部 ]</small></small>';
var $A_COMP_CATEG_CATEGS = '分類管理 <small><small>[ %s ]</small></small>';
var $A_COMP_CATEG_NAME = '分類名稱';
var $A_COMP_CATEG_ID = '分類代碼';
var $A_COMP_CATEG_MUST_NAME = '分類必須有名稱';
var $A_COMP_CATEG_DETAILS = '分類明細';
var $A_COMP_CATEG_TITLE = '分類標題';
var $A_COMP_CATEG_TABLE = '分類列表';
var $A_COMP_CATEG_BLOG = '分類Blog風格';
var $A_COMP_CATEG_MESSAGE = '分類';
var $A_COMP_CATEG_MESSAGE2 = '正在被其他管理員編輯。';
var $A_COMP_CATEG_MOVE = '移動分類';
var $A_COMP_CATEG_MOVE_TO_SECTION = '移動到單元';
var $A_COMP_CATEG_BEING_MOVED = '移動的分類';
var $A_COMP_CATEG_CONTENT = '移動的內容條目';
var $A_COMP_CATEG_MOVE_CATEG = '將移動所列的分類';
var $A_COMP_CATEG_ALL_ITEMS = '以及分類中的所有條目（也就是所列的）';
var $A_COMP_CATEG_TO_SECTION = '到指定的單元。';
var $A_COMP_CATEG_COPY = '複製分類';
var $A_COMP_CATEG_COPY_TO_SECTION = '複製到單元';
var $A_COMP_CATEG_BEING_COPIED = '要複製的分類';
var $A_COMP_CATEG_ITEMS_COPIED = '複製的內容條目';
var $A_COMP_CATEG_COPY_CATEGS = '將複製所列的分類';

//components/com_categories/admin.categories.php
var $A_COMP_CATEG_DELETE = '選擇要刪除的分類';
var $A_COMP_CATEG_CATEG_S = '分類';
var $A_COMP_CATEG_CANNOT_REMOVE = '無法刪除，因其有下屬記錄';
var $A_COMP_CATEG_SELECT = '選擇分類來';
var $A_COMP_CATEG_ITEM_MOVE = '選擇條目來移動';
var $A_COMP_CATEG_MOVED_TO = '分類移動到';
var $A_COMP_CATEG_COPY_OF = '複製';
var $A_COMP_CATEG_COPIED_TO = '分類複製到';
var $A_COMP_CATEG_SELECT_TYPE = '選擇類型';
var $A_COMP_CATEG_CONTACT_CATEG_TABLE = '聯繫人分類列表';
var $A_COMP_CATEG_NEWSFEED_CATEG_TABLE = '新聞轉播分類列表';
var $A_COMP_CATEG_WEBLINK_CATEG_TABLE = '網站鏈接分類列表';
var $A_COMP_CATEG_CONTENT_CATEG_TABLE = '內容分類列表';
var $A_COMP_CATEG_CONTENT_CATEG_BLOG = '內容分類Blog風格';

//components/com_checkin/admin.checkin.php
var $A_COMP_CHECK_TITLE = '全部放回';
var $A_COMP_CHECK_DB_T = '數據庫表格';
var $A_COMP_CHECK_NB_ITEMS = '條目數';
var $A_COMP_CHECK_IN = '放回';
var $A_COMP_CHECK_TABLE = '檢查表格';
var $A_COMP_CHECK_DONE = '取出的條目已全部放回';

//components/com_config/admin.config.html.php
var $A_COMP_CONF_GC = '全局配置';
var $A_COMP_CONF_IS = '為';
var $A_COMP_CONF_WRT = '可寫';
var $A_COMP_CONF_UNWRT = '不可寫';
//var $A_COMP_CONF_SITE_PAGE = 'site-page';
var $A_COMP_CONF_OFFLINE = '網站離線';
var $A_COMP_CONF_OFFMESSAGE = '離線消息';
var $A_COMP_CONF_OFFMESSAGE_TIP = '網站離線時顯示的消息';
var $A_COMP_CONF_ERR_MESSAGE = '系統錯誤消息';
var $A_COMP_CONF_ERR_MESSAGE_TIP = 'Mambo無法連接數據庫時顯示的消息';
var $A_COMP_CONF_SITE_NAME = '網站名稱';
var $A_COMP_CONF_UN_LINKS = '顯示未授權的鏈接';
var $A_COMP_CONF_UN_LINKS_TIP = '將授權給註冊用戶閱讀的內容的鏈接，顯示給未登錄用戶，但只有用戶登錄後才能閱讀全文。';
var $A_COMP_CONF_USER_REG = '允許用戶註冊';
var $A_COMP_CONF_USER_REG_TIP = '允許用戶自己註冊';
var $A_COMP_CONF_AC_ACT = '使用帳戶激活';
var $A_COMP_CONF_AC_ACT_TIP = '用戶註冊後，將收到激活郵件，通過激活鏈接激活帳戶，然後才能登錄.';
var $A_COMP_CONF_REQ_EMAIL = '要求唯一的Email';
var $A_COMP_CONF_REQ_EMAIL_TIP = '用戶不能使用相同的 email 地址來註冊';
var $A_COMP_CONF_REG_SUBMIT = '允許註冊用戶發表文章';
var $A_COMP_CONF_REG_SUBMIT_TIP = '允許註冊用戶在前台發表文章';
var $A_COMP_CONF_DEBUG = '調試網站';
var $A_COMP_CONF_DEBUG_TIP = '顯示錯誤診斷信息和SQL錯誤信息，僅供開發人員調試用';
var $A_COMP_CONF_EDITOR = '可視化編輯器';
var $A_COMP_CONF_LENGTH = '列表條目數';
var $A_COMP_CONF_LENGTH_TIP = '管理後台默認的列表顯示條目數';
var $A_COMP_CONF_SITE_ICON = '網站圖標';
var $A_COMP_CONF_SITE_ICON_TIP = '如果留空或文件不存在，則使用系統默認的favicon.ico.';
//var $A_COMP_CONF_LOCAL_PG = 'Locale-page';
var $A_COMP_CONF_LOCALE = '本地';
var $A_COMP_CONF_LANG = '前台語言';
var $A_COMP_CONF_ALANG = '後台語言';
var $A_COMP_CONF_TIME_SET = '時差';
var $A_COMP_CONF_DATE = '當前日期/時間';
var $A_COMP_CONF_LOCAL = '國家代碼';
//var $A_COMP_CONF_CONT_PAGE = 'content-page';
var $A_COMP_CONF_CONTROL = '* 下列參數控制內容的顯示格式 *';
var $A_COMP_CONF_LINK_TITLES = '鏈接標題';
var $A_COMP_CONF_MORE_LINK = '閱讀全文鏈接';
var $A_COMP_CONF_MORE_LINK_TIP = '當內容條目有正文時，顯示閱讀全文鏈接';
var $A_COMP_CONF_RATE_VOTE = '條目評分/投票';
var $A_COMP_CONF_RATE_VOTE_TIP = '允許投票給內容條目';
var $A_COMP_CONF_AUTHOR = '作者名稱';
var $A_COMP_CONF_AUTHOR_TIP = '顯示作者名稱，這是全局設置，但可以在菜單和條目級別進行更改。';
var $A_COMP_CONF_CREATED = '創建日期和時間';
var $A_COMP_CONF_CREATED_TIP = '顯示內容條目的創建日期和時間，這是全局設置，但可以在菜單和條目級別進行更改。';
var $A_COMP_CONF_MOD_DATE = '修改日期和時間';
var $A_COMP_CONF_MOD_DATE_TIP = '顯示內容條目的修改日期和時間，這是全局設置，但可以在菜單和條目級別進行更改。';
var $A_COMP_CONF_HITS = '點擊';
var $A_COMP_CONF_HITS_TIP = '顯示內容條目的點擊閱讀數，這是全局設置，但可以在菜單和條目級別進行更改。';
var $A_COMP_CONF_PDF = 'PDF圖標';
var $A_COMP_CONF_OPT_MEDIA = '選項不可用，因為/media 目錄不可寫';
var $A_COMP_CONF_PRINT_ICON = '打印圖標';
var $A_COMP_CONF_EMAIL_ICON = 'Email圖標';
var $A_COMP_CONF_ICONS = '圖標';
var $A_COMP_CONF_USE_OR_TEXT = '打印、生成PDF和發送Email 的圖標或文本';
var $A_COMP_CONF_TBL_CONTENTS = '多頁內容條目表格';
var $A_COMP_CONF_BACK_BUTTON = '返回按鈕';
var $A_COMP_CONF_CONTENT_NAV = '內容條目導航';
var $A_COMP_CONF_HYPER = '使用超鏈接標題';
//var $A_COMP_CONF_DB_PAGE = 'db-page';
var $A_COMP_CONF_HOSTNAME = '主機名';
var $A_COMP_CONF_DB_USERNAME = '用戶名';
var $A_COMP_CONF_DB_PW = '密碼';
var $A_COMP_CONF_DB_NAME = '數據庫';
var $A_COMP_CONF_DB_PREFIX = '數據表前綴';
//Svar $A_COMP_CONF_S_PAGE = 'server-page';
var $A_COMP_CONF_ABS_PATH = '絕對路徑';
var $A_COMP_CONF_LIVE = '網站地址';
var $A_COMP_CONF_SECRET = '加密文本';
var $A_COMP_CONF_GZIP = '用 GZIP 壓縮頁面';
var $A_COMP_CONF_CP_BUFFER = '如果系統支持的話，壓縮緩衝輸出';
var $A_COMP_CONF_SESSION_TIME = 'session會話時間';
var $A_COMP_CONF_SEC = '秒';
var $A_COMP_CONF_AUTO_LOGOUT = '此時間內如果沒有活動將自動退出登錄';
var $A_COMP_CONF_ERR_REPORT = '錯誤報告';
var $A_COMP_CONF_REG_GLOBALS_EMU = 'Register Globals 模擬：';
var $A_COMP_CONF_REG_GLOBALS_EMU_DESC = 'Register globals 模擬，如果設置為 Off 的話，有些組件也許會停止工作。';
var $A_COMP_CONF_HELP_SERVER = '幫助服務器';
var $A_COMP_CONF_FILE_CREATION = '文件創建';
var $A_COMP_CONF_FILE_PERM = '文件權限';
var $A_COMP_CONF_FILE_DONT_CHMOD = '不改變新文件的權限 (使用服務器默認值)';
var $A_COMP_CONF_FILE_CHMOD = '改變新文件的權限';
var $A_COMP_CONF_FILE_CHMOD_TIP = '給新創建的文件定義權限標誌';
var $A_COMP_CONF_APPLY_FILE = '應用到現有文件';
var $A_COMP_CONF_APPLY_FILE_TIP = '應用權限標誌到網站的<em>所有現有文件</em>。<br/><b>不適當的使用將會造成網站失效！</b>';
var $A_COMP_CONF_DIR_CREATION = '目錄創建';
var $A_COMP_CONF_DIR_PERM = '目錄權限';
var $A_COMP_CONF_DIR_DONT_CHMOD = '不改變新目錄的權限 (使用服務器默認值)';
var $A_COMP_CONF_DIR_CHMOD = '改變新目錄的權限';
var $A_COMP_CONF_DIR_CHMOD_TIP = '給新創建的目錄定義權限標誌';
var $A_COMP_CONF_APPLY_DIR = '應用到現有目錄';
var $A_COMP_CONF_APPLY_DIR_TIP = '應用權限標誌到網站的<em>所有現有目錄</em>。<br/><b>不適當的使用將會造成網站失效！</b>';
var $A_COMP_CONF_USER = '所有者';
var $A_COMP_CONF_GROUP = '組';
var $A_COMP_CONF_WORLD = '公共';
var $A_COMP_CONF_READ = '讀取';
var $A_COMP_CONF_WRITE = '寫入';
var $A_COMP_CONF_EXECUTE = '執行';
var $A_COMP_CONF_SEARCH = '搜索';
//var $A_COMP_CONF_META_PAGE = 'metadata-page';
var $A_COMP_CONF_META_DESC = '網站全局元描述';
var $A_COMP_CONF_META_KEY = '網站全局元關鍵字';
var $A_COMP_CONF_META_TITLE = '顯示標題元標籤';
var $A_COMP_CONF_META_ITEMS = '瀏覽內容條目時顯示標題元標籤';
var $A_COMP_CONF_META_AUTHOR = '顯示作者元標籤';
var $A_COMP_CONF_META_AUTHOR_TIP = '瀏覽內容條目時顯示作者元標籤';
//var $A_COMP_CONF_MAIL_PAGE = 'mail-page';
var $A_COMP_CONF_MAIL = '郵件發送';
var $A_COMP_CONF_MAIL_FROM = '發件人Email地址';
var $A_COMP_CONF_MAIL_FROM_NAME = '發件人姓名';
var $A_COMP_CONF_MAIL_SENDMAIL_PATH = 'Sendmail路徑';
var $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP認證';
var $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP用戶';
var $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP密碼';
var $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP主機';
//var $A_COMP_CONF_CACHE_PAGE = 'cache-page';
var $A_COMP_CONF_CACHE = '使用緩存';
var $A_COMP_CONF_CACHE_FOLDER = '緩存目錄';
var $A_COMP_CONF_CACHE_DIR = '當前緩存目錄為';
var $A_COMP_CONF_CACHE_DIR_UNWRT = '緩存目錄為不可寫，在使用緩存功能之前請設置此目錄為CHMOD755';
var $A_COMP_CONF_CACHE_TIME = '緩存時間';
//var $A_COMP_CONF_STATS_PAGE = 'stats-page';
var $A_COMP_CONF_STATS = '統計';
var $A_COMP_CONF_STATS_ENABLE = '允許/禁止收集網站統計信息';
var $A_COMP_CONF_STATS_LOG_HITS = '按日期記錄內容點擊';
var $A_COMP_CONF_STATS_WARN_DATA = '警告：大量數據將被收集';
var $A_COMP_CONF_STATS_LOG_SEARCH = '記錄搜索文本';
//var $A_COMP_CONF_SEO_PAGE = 'seo-page';
var $A_COMP_CONF_SEO_LBL = '搜索引擎優化';
var $A_COMP_CONF_SEO = '搜索引擎優化';
var $A_COMP_CONF_SEO_SEFU = '搜索引擎友好鏈接';
var $A_COMP_CONF_SEO_APACHE = '只適用於Apache服務器! 激活前先把 htaccess.txt 改名為 .htaccess';
var $A_COMP_CONF_SEO_DYN = '動態頁面標題';
var $A_COMP_CONF_SEO_DYN_TITLE = '動態更新頁面標題，來更好表現當前的內容';
var $A_COMP_CONF_SERVER = '服務器';
var $A_COMP_CONF_METADATA = '元數據';
var $A_COMP_CONF_EMAIL = '郵件';
var $A_COMP_CONF_CACHE_TAB = '緩存';

//components/com_config/admin.config.php
var $A_COMP_CONF_HIDE = '隱藏';
var $A_COMP_CONF_SHOW = '顯示';
var $A_COMP_CONF_DEFAULT = '系統默認';
var $A_COMP_CONF_NONE = '無';
var $A_COMP_CONF_SIMPLE = '簡單';
var $A_COMP_CONF_MAX = '最大';
var $A_COMP_CONF_MAIL_FC = 'PHP郵件函數';
var $A_COMP_CONF_SEND = 'Sendmail';
var $A_COMP_CONF_SMTP = 'SMTP服務器';
var $A_COMP_CONF_UPDATED = '配置已被更新！';
var $A_COMP_CONF_ERR_OCC = '發生錯誤！無法打開配置文件來寫入！';

//components/com_contact/admin.contact.html.php
var $A_COMP_CONT_MANAGER = '聯繫人管理';
var $A_COMP_CONT_FILTER = '篩選';
var $A_COMP_CONT_YOUR_NAME = '必須輸入名稱。';
var $A_COMP_CONT_CATEG = '請選擇分類。';
var $A_COMP_CONT_DETAILS = '聯繫人明細';
var $A_COMP_CONT_POSITION = '職位';
var $A_COMP_CONT_ADDRESS = '地址';
var $A_COMP_CONT_TOWN = '城市';
var $A_COMP_CONT_STATE = '省份';
var $A_COMP_CONT_COUNTRY = '國家';
var $A_COMP_CONT_POSTAL_CODE = '郵編';
var $A_COMP_CONT_TEL = '電話';
var $A_COMP_CONT_FAX = '傳真';
var $A_COMP_CONT_INFO = '備註';
//var $A_COMP_CONT_PUBLISH = 'publish-page';
var $A_COMP_CONT_PUBLISHING = '發佈';
var $A_COMP_CONT_SITE_DEFAULT = '網站默認';
//var $A_COMP_CONT_IMG_PAGE = 'images-page';
var $A_COMP_CONT_IMG_INFO = '圖片';
var $A_COMP_CONT_PARAMS = '參數';
var $A_COMP_CONT_PARAMETERS = '參數';
var $A_COMP_CONT_PARAM_MESS = '* 下列參數控制聯繫人的明細顯示 *';
var $A_COMP_CONT_PUB_TAB = '發佈';
var $A_COMP_CONT_IMG_TAB = '圖片';

//components/com_contact/admin.contact.php
var $A_COMP_CONT_SELECT_REC = '選擇記錄來';

//components/com_content/admin.content.html.php
var $A_COMP_CONTENT_ITEMS_MNG = '內容條目管理';
var $A_COMP_CONTENT_ALL_ITEMS = '內容條目管理';
var $A_COMP_CONTENT_START_ALWAYS = '開始：總是';
var $A_COMP_CONTENT_START = '開始';
var $A_COMP_CONTENT_FIN_NOEXP = '結束：沒有過期';
var $A_COMP_CONTENT_FINISH = '結束';
var $A_COMP_CONTENT_PUBLISH_INFO = '發佈信息';
var $A_COMP_CONTENT_MANAGER = '管理';
var $A_COMP_CONTENT_ZERO = '確認重置點擊數為0？\n任何未保存的更改將丟失。';
var $A_COMP_CONTENT_MUST_TITLE = '內容條目必須輸入標題';
var $A_COMP_CONTENT_MUST_NAME = '內容條目必須輸入';
var $A_COMP_CONTENT_MUST_SECTION = '必須選擇單元。';
var $A_COMP_CONTENT_MUST_CATEG = '必須選擇分類。';
var $A_COMP_CONTENT_ITEMS = '內容條目';
var $A_COMP_CONTENT_IN = '內容在';
var $A_COMP_CONTENT_TITLE_ALIAS = '標題別名';
var $A_COMP_CONTENT_ITEM_DETAILS = '條目明細';
var $A_COMP_CONTENT_INTRO = '摘要：(必填)';
var $A_COMP_CONTENT_MAIN = '正文：(可選)';
var $A_COMP_CONTENT_PUB_INFO = '發佈';
var $A_COMP_CONTENT_FRONTPAGE = '顯示在首頁';
var $A_COMP_CONTENT_AUTHOR = '作者別名';
var $A_COMP_CONTENT_CREATOR = '更改創建者';
var $A_COMP_CONTENT_OVERRIDE = '更改創建時間';
var $A_COMP_CONTENT_START_PUB = '開始發佈時間';
var $A_COMP_CONTENT_FINISH_PUB = '結束發布時間';
var $A_COMP_CONTENT_ID = '內容條目ID';
var $A_COMP_CONTENT_DRAFT_UNPUB = '未發佈的草稿';
var $A_COMP_CONTENT_RESET_HIT = '重置點擊數';
var $A_COMP_CONTENT_REVISED = '修改';
var $A_COMP_CONTENT_TIMES = '次數';
var $A_COMP_CONTENT_CREATED = '創建';
var $A_COMP_CONTENT_BY = '由';
var $A_COMP_CONTENT_NEW_DOC = '新文檔';
var $A_COMP_CONTENT_LAST_MOD = '最新修改';
var $A_COMP_CONTENT_NOT_MOD = '未修改';
var $A_COMP_CONTENT_MOSIMAGE = 'Mambo圖片控制';
var $A_COMP_CONTENT_SUB_FOLDER = '子目錄';
var $A_COMP_CONTENT_GALLERY = '圖庫圖片';
var $A_COMP_CONTENT_IMAGES = '內容圖片';
var $A_COMP_CONTENT_UP = '向上';
var $A_COMP_CONTENT_DOWN = '向下';
var $A_COMP_CONTENT_REMOVE = '刪除';
var $A_COMP_CONTENT_EDIT_IMAGE = '編輯選擇的圖片';
var $A_COMP_CONTENT_IMG_ALIGN = '圖片對齊';
var $A_COMP_CONTENT_ALIGN = '對齊';
var $A_COMP_CONTENT_ALT = '替代文本';
var $A_COMP_CONTENT_BORDER = '邊框';
var $A_COMP_CONTENT_IMG_CAPTION = '標題';
var $A_COMP_CONTENT_IMG_CAPTION_POS = '標題位置';
var $A_COMP_CONTENT_IMG_CAPTION_ALIGN = '標題排列';
var $A_COMP_CONTENT_IMG_WIDTH = '圖片寬度';
var $A_COMP_CONTENT_APPLY = '應用';
var $A_COMP_CONTENT_PARAM = '參數控制';
var $A_COMP_CONTENT_PARAM_MESS = '* 下列參數只控制條目明細顯示 *';
var $A_COMP_CONTENT_META_DATA = '元數據';
var $A_COMP_CONTENT_KEYWORDS = '關鍵字';
//var $A_COMP_CONTENT_LINK_PAGE = 'link-page';
var $A_COMP_CONTENT_LINK_CI = '這將在選擇的菜單中創建一個 \'菜單項 - 內容條目\' 的鏈接';
var $A_COMP_CONTENT_LINK_NAME = '鏈接名稱';
var $A_COMP_CONTENT_SOMETHING = '請選擇';
var $A_COMP_CONTENT_MOVE_ITEMS = '移動條目';
var $A_COMP_CONTENT_MOVE_SECCAT = '移動到單元/分類';
var $A_COMP_CONTENT_ITEMS_MOVED = '移動的條目';
var $A_COMP_CONTENT_SECCAT = '請選擇單元/分類';
var $A_COMP_CONTENT_COPY_ITEMS = '複製內容條目';
var $A_COMP_CONTENT_COPY_SECCAT = '複製到單元/分類';
var $A_COMP_CONTENT_ITEMS_COPIED = '複製的條目';
var $A_COMP_CONTENT_PUBLISHING = '發佈';
var $A_COMP_CONTENT_IMAGES2 = '圖片';
var $A_COMP_CONTENT_META_INFO = '元數據';
var $A_COMP_CONTENT_ADD_ETC = '加入單元/分類/標題';
var $A_COMP_CONTENT_LINK_TO_MENU = '鏈接到菜單';
var $A_COMP_CONTENT_EDIT_CONTENT = '編輯內容';
var $A_COMP_CONTENT_EDIT_STATIC = '編輯靜態內容';
var $A_COMP_CONTENT_EDIT_SECTION = '編輯單元';
var $A_COMP_CONTENT_EDIT_CATEGORY = '編輯分類';
var $A_COMP_CONTENT_EDIT_USER = '編輯用戶';
//components/com_content/admin.content.php
var $A_COMP_CONTENT_CACHE = '緩存已清空';
var $A_COMP_CONTENT_MODULE = '模塊';
var $A_COMP_CONTENT_ANOTHER = '正在被其他管理員編輯。';
var $A_COMP_CONTENT_PUBLISHED = '條目成功發佈';
var $A_COMP_CONTENT_UNPUBLISHED = '條目成功取消發佈';
var $A_COMP_CONTENT_SEL_TOG = '選擇條目來打開';
var $A_COMP_CONTENT_SEL_DEL = '選擇條目來刪除';
var $A_COMP_CONTENT_SUCCESS_DEL = '條目成功刪除';
var $A_COMP_CONTENT_SEL_MOVE = '選擇條目來移動';
var $A_COMP_CONTENT_MOVED = '條目成功移動到單元';
var $A_COMP_CONTENT_ERR_OCCURRED = '發生錯誤';
var $A_COMP_CONTENT_COPIED = '條目成功複製到單元';
var $A_COMP_CONTENT_RESET_HIT_COUNT = '成功重置點擊數';
var $A_COMP_CONTENT_IN_MENU = '(菜單項 - 靜態內容) 鏈接';
var $A_COMP_CONTENT_SUCCESS = '成功創建';
var $A_COMP_CONTENT_SELECT_CAT = '選擇分類';
var $A_COMP_CONTENT_SELECT_SEC = '選擇單元';

//components/com_content/toolbar.content.html.php
var $A_COMP_CONTENT_BAR_MOVE = '移動';
var $A_COMP_CONTENT_BAR_COPY = '複製';
var $A_COMP_CONTENT_BAR_SAVE = '保存';

//components/com_frontpage/admin.frontpage.html.php
var $A_COMP_FRONT_PAGE_MNG = '首頁管理';
//var $A_COMP_FRONT_PAGE_ITEMS = '首頁條目';
var $A_COMP_FRONT_ORDER = '排序';

//components/com_frontpage/admin.frontpage.php
var $A_COMP_FRONT_COUNT_NUM = '參數 count 必須是數字';
var $A_COMP_FRONT_INTRO_NUM = '參數 intro 必須是數字';
var $A_COMP_FRONT_WELCOME = '歡迎光臨';
var $A_COMP_FRONT_IDONOT = '沒有內容';

//components/com_frontpage/toolbar.frontpage.html.php
var $A_COMP_FRONT_REMOVE = '移除';

//components/com_languages/admin.languages.html.php
var $A_COMP_LANG_INSTALL = '語言管理 <small><small>[ 網站 ]</small></small>';
var $A_COMP_LANG_LANG = '語言';
var $A_COMP_LANG_EMAIL = '作者 Email';
var $A_COMP_LANG_EDITOR = '語言編輯器';
var $A_COMP_LANG_FILE = '文件語言';

//components/com_languages/admin.languages.php
var $A_COMP_LANG_UPDATED = '配置成功更新！';
var $A_COMP_LANG_M_SURE = '錯誤！ 請確認 configuration.php 為可寫。';
var $A_COMP_LANG_CANNOT = '不能刪除正在使用的語言。';
var $A_COMP_LANG_FAILED_OPEN = '操作失敗：無法打開';
var $A_COMP_LANG_FAILED_SPEC = '操作失敗：沒有指定的語言。';
var $A_COMP_LANG_FAILED_EMPTY = '操作失敗：沒有內容';
var $A_COMP_LANG_FAILED_UNWRT = '操作失敗：文件不可寫。';
var $A_COMP_LANG_FAILED_FILE = '操作失敗：無法打開文件來寫入。';

//components/com_mambots/admin.mambots.html.php
var $A_COMP_MAMB_ADMIN = '管理';
var $A_COMP_MAMB_SITE = '網站';
var $A_COMP_MAMB_MANAGER = '觸發器管理';
var $A_COMP_MAMB_NAME = '觸發器名稱';
var $A_COMP_MAMB_FILE = '文件';
var $A_COMP_MAMB_MUST_NAME = '觸發器必須輸入名稱';
var $A_COMP_MAMB_MUST_FNAME = '觸發器必須輸入文件名稱';
var $A_COMP_MAMB_DETAILS = '觸發器明細';
var $A_COMP_MAMB_FOLDER = '目錄';
var $A_COMP_MAMB_MFILE = '觸發器文件';
var $A_COMP_MAMB_ORDER = '觸發器排序';

//components/com_mambots/admin.mambots.php
var $A_COMP_MAMB_EDIT = '正在被其他管理員編輯。';
var $A_COMP_MAMB_DEL = '選擇觸發器來刪除';
var $A_COMP_MAMB_TO = '選擇觸發器';
var $A_COMP_MAMB_PUB = '發佈';
var $A_COMP_MAMB_UNPUB = '取消發佈';
var $A_COMP_MAMB_SAVED_CHANGES = '成功保存觸發器的變更: '; //KEN ADDED
var $A_COMP_MAMB_SAVED = '成功保存觸發器: '; //KEN ADDED
var $A_COMP_MAMB_ORDERING = '新的條目默認排在最後，排列次序可以在條目保存後調整。'; //KEN ADDED
var $A_COMP_MAMB_ORDERING_SAVED = '成功保存觸發器: '; //KEN ADDED

//components/com_massmail/admin.massmail.html.php
var $A_COMP_MASS_SUBJECT = '請輸入主題';
var $A_COMP_MASS_SELECT_GROUP = '請選擇群組';
var $A_COMP_MASS_MESSAGE = '請輸入正文';
var $A_COMP_MASS_MAIL = '群發郵件';
var $A_COMP_MASS_GROUP = '群組';
var $A_COMP_MASS_DETAILS = '明細'; //KEN ADDED
var $A_COMP_MASS_CHILD = '發郵件給子群組';
var $A_COMP_MASS_HTML = '使用 HTML 格式發送'; //KEN ADDED
var $A_COMP_MASS_SUB = '主題';
var $A_COMP_MASS_MESS = '正文';

//components/com_massmail/toolbar.massmail.html.php
var $A_COMP_MASS_SEND = '發送';

//components/com_massmail/admin.massmail.php
var $A_COMP_MASS_ALL = '- 所有用戶群組 -';
var $A_COMP_MASS_FILL = '請正確填寫表單';
var $A_COMP_MASS_SENT = '收件人E-mail';
var $A_COMP_MASS_USERS = '用戶';

//components/com_media/admin.media.html.php
var $A_COMP_MEDIA_MG = '媒體管理';
var $A_COMP_MEDIA_DIR = '目錄';
var $A_COMP_MEDIA_UP = '向上';
var $A_COMP_MEDIA_UPLOAD = '上傳';
var $A_COMP_MEDIA_UPLOAD_MAX = '最大';
var $A_COMP_MEDIA_CODE = '代碼';
var $A_COMP_MEDIA_CDIR = '創建目錄';
var $A_COMP_MEDIA_PROBLEM = '配置問題';
var $A_COMP_MEDIA_EXIST = '不存在。';
var $A_COMP_MEDIA_DEL = '刪除';
var $A_COMP_MEDIA_INSERT = '在此輸入文本';
var $A_COMP_MEDIA_DEL_FILE = "刪除文件 \"+file+\"?";
var $A_COMP_MEDIA_DEL_ALL = "有 \"+numFiles+\" 個文件/目錄在 \"+folder+\"。請先刪除 \"+folder+\"中的所有文件/目錄  。";
var $A_COMP_MEDIA_DEL_FOLD = "刪除目錄 \"+folder+\"?";
var $A_COMP_MEDIA_NO_IMG = '沒有圖片。';

//components/com_media/admin.media.php
var $A_COMP_MEDIA_NO_HACK = '請不要修改';
var $A_COMP_MEDIA_DIR_SAFEMODE = '目錄禁止創建，系統環境為SAFE MODE模式，會導致問題。';
var $A_COMP_MEDIA_ALPHA = '目錄名稱只能包含字母或數字，不能有空格';
var $A_COMP_MEDIA_FAILED = '上傳失敗。文件已經存在';
var $A_COMP_MEDIA_ONLY = '只有類型為 gif, png, jpg, bmp, pdf, swf, doc, xls 或者 ppt 的文件才能上傳';
var $A_COMP_MEDIA_UP_FAILED = '上傳失敗';
var $A_COMP_MEDIA_UP_COMP = '上傳完成';
var $A_COMP_MEDIA_NOT_EMPTY = '<font color="red">無法刪除: 非空!</font>';//KEN ADDED
//components/com_media/toolbar.media.html.php
var $A_COMP_MEDIA_CREATE = '創建';

//components/com_menumanager/admin.menumanager.html.php
var $A_COMP_MENU_NAME = '菜單名稱';
var $A_COMP_MENU_TYPE = '菜單類型';
var $A_COMP_MENU_TITLE = '模塊標題';
var $A_COMP_MENU_ITEMS = '菜單項';//KEN ADDED
var $A_COMP_MENU_PUB = '發佈數';//KEN ADDED
var $A_COMP_MENU_UNPUB = '未發佈數';//KEN ADDED
var $A_COMP_MENU_MODULES = '模塊數';//KEN ADDED
var $A_COMP_MENU_EDIT_NAME = '編輯菜單名稱';//KEN ADDED
var $A_COMP_MENU_EDIT_ITEM = '編輯菜單項';//KEN ADDED
var $A_COMP_MENU_ID = '模塊代碼';
var $A_COMP_MENU_TIPS = '這是Mambo使用的鑒定名稱，用在源碼中識別此菜單 - 必須為唯一值。建議在菜單名稱中不要有任何空白字符';//KEN ADDED
var $A_COMP_MENU_TIPS2 = 'mod_mainmenu 模塊的顯示標題，必填項';//KEN ADDED
var $A_COMP_MENU_TIPS3 = '* 一個新的 mod_mainmenu 模塊，將在你保存此菜單時自動創建，使用你輸入的標題為標題。 *<br/><br/>新建模塊的參數可通過 "模塊管理 [網站]": 模塊 -> 網站模塊 來編輯';//KEN ADDED
var $A_COMP_MENU_ASSIGN = '沒有模塊分配到菜單';
var $A_COMP_MENU_ENTER = '請輸入菜單名稱';
var $A_COMP_MENU_ENTER_TYPE = '請輸入菜單類型';
var $A_COMP_MENU_ENTER_TITLE = '請輸入菜單的模塊名稱';
var $A_COMP_MENU_DETAILS = '菜單明細';
var $A_COMP_MENU_MAINMENU = '主菜單模塊，保存此菜單時，相同的名稱將自動創建/更新。';
var $A_COMP_MENU_DEL = '刪除菜單';
var $A_COMP_MENU_MODULE_DEL = '刪除的菜單/模塊';
var $A_COMP_MENU_ITEMS_DEL = '刪除的菜單項';
var $A_COMP_MENU_WILL = '* 將';
var $A_COMP_MENU_WILL2 = '此菜單，<br />及其所有菜單項和關聯的模塊 *';
var $A_COMP_MENU_YOU_SURE = '確認刪除此菜單？\n將刪除菜單、菜單項和模塊。';
var $A_COMP_MENU_NAME_MENU = '請輸入複製菜單的名稱';
var $A_COMP_MENU_NAME_MOD = '請輸入新模塊的名稱';
var $A_COMP_MENU_COPY = '複製菜單';
var $A_COMP_MENU_NEW = '新菜單名稱';
var $A_COMP_MENU_NEW_MOD = '新模塊名稱';//KEN ADDED
var $A_COMP_MENU_COPIED = '複製的菜單';
var $A_COMP_MENU_ITEMS_COPIED = '複製的菜單項';
var $A_COMP_MENU_MOD_MENU = '主菜單模塊，保存此菜單時，相同的名稱將自動創建/更改。';

//components/com_menumanager/admin.menumanager.php
var $A_COMP_MENU_CREATED = '新菜單創建了';
var $A_COMP_MENU_UPDATED = '菜單項和模塊已更新';
var $A_COMP_MENU_DETECTED = '菜單刪除了';
var $A_COMP_MENU_COPY_OF = '菜單的複製';
var $A_COMP_MENU_CONSIST = '創建了，包括';
var $A_COMP_MENU_RENAME_WARNING = '你不能重命名 mainmenu 菜單，因為這將破壞Mambo的正確操作';
var $A_COMP_MENU_EXISTS_WARNING = '具有此名稱的菜單已經存在 - 你必須輸入一個唯一的菜單名稱';

//components/com_menumanager/toolbar.menumanager.html.php
var $A_COMP_MENU_BAR_DEL = '刪除';

//components/com_modules/admin.modules.html.php
var $A_COMP_MOD_MANAGER = '模塊管理';
var $A_COMP_MOD_NAME = '模塊名稱';
var $A_COMP_MOD_POSITION = '位置';
var $A_COMP_MOD_PAGES = '所在頁面';
var $A_COMP_MOD_VARIES = '個別';
var $A_COMP_MOD_ALL = '全部';
var $A_COMP_MOD_USER = '用戶';
var $A_COMP_MOD_MUST_TITLE = '模塊必須有標題';
var $A_COMP_MOD_MODULE = '模塊';
var $A_COMP_MOD_DETAILS = '模塊明細';
var $A_COMP_MOD_SHOW_TITLE = '顯示標題';
var $A_COMP_MOD_ORDER = '模塊排序';
var $A_COMP_MOD_CONTENT = '內容';
var $A_COMP_MOD_PAGES_ITEMS = '菜單 / 菜單項';
var $A_COMP_MOD_CUSTOM_OUTPUT = '定制輸出';
var $A_COMP_MOD_MOD_POSITION = '模塊位置';
var $A_COMP_MOD_ITEM_LINK = '菜單項鏈接';
var $A_COMP_MOD_TAB_LBL = '版面';

//components/com_modules/admin.modules.php
var $A_COMP_MOD_MODULES = '模塊';
var $A_COMP_MOD_MOD_COPIED = '模塊已複製';//KEN ADDED
var $A_COMP_MOD_SAVED_CHANGES = '成功保存模塊的更改: ';//KEN ADDED
var $A_COMP_MOD_SAVED_MOD = '成功保存模塊: ';//KEN ADDED
var $A_COMP_MOD_CANNOT = '不能刪除，只能卸載，因為是Mambo核心模塊。';
var $A_COMP_MOD_SELECT_TO = '選擇模塊來';

//components/com_modules/toolbar.modules.html.php
var $A_COMP_MOD_PREVIEW = '預覽';
var $A_COMP_MOD_PREVIEW_TIP = '只能預覽自定義模塊。';

//components/com_newsfeeds/admin.newsfeeds.html.php
var $A_COMP_FEED_TITLE = '新聞轉播管理';
var $A_COMP_FEED_NEWS = '新聞轉播';
var $A_COMP_FEED_ARTICLES = '文章';
var $A_COMP_FEED_CACHE = '緩存時間(秒)';
var $A_COMP_FEED_EDIT_FEED = '編輯新聞轉播';//KEN ADDED
var $A_COMP_FEED_FILL_NAME = '請輸入新聞轉播名稱。';
var $A_COMP_FEED_SEL_CATEG = '請選擇分類。';
var $A_COMP_FEED_FILL_LINK = '請輸入新聞轉播鏈接。';
var $A_COMP_FEED_FILL_NB = '請輸入文章顯示數量。';
var $A_COMP_FEED_FILL_REFRESH = '請輸入緩存更新時間。';
var $A_COMP_FEED_LINK = '鏈接';
var $A_COMP_FEED_NB_ARTICLE = '文章數';
var $A_COMP_FEED_IN_SEC = '緩存時間(秒)';

//components/com_poll/admin.poll.html.php
var $A_COMP_POLL_MANAGER = '在線調查管理';
var $A_COMP_POLL_TITLE = '在線調查標題';
var $A_COMP_POLL_OPTIONS = '選項';
var $A_COMP_POLL_MUST_TITLE = '在線調查必須有標題';
var $A_COMP_POLL_NON_ZERO = '兩次投票之間必須有時間間隔';
var $A_COMP_POLL_POLL = '在線調查';
var $A_COMP_POLL_SHOW = '在菜單項顯示';
var $A_COMP_POLL_LAG = '間隔';
var $A_COMP_POLL_EDIT = '編輯在線調查';//KEN ADDED
var $A_COMP_POLL_BETWEEN = '(兩次投票之間的時間間隔：秒)';

//components/com_poll/admin.poll.php
var $A_COMP_POLL_THE = '在線調查';
var $A_COMP_POLL_BEING = '正在被其他管理員編輯。';

//components/com_poll/poll.class.php
var $A_COMP_POLL_TRY_AGAIN = '模塊名稱已存在，請重試。';

//components/com_sections/admin.sections.html.php
var $A_COMP_SECT_MANAGER = '單元管理';
var $A_COMP_SECT_NAME = '單元名稱';
var $A_COMP_SECT_ID = '單元代碼';
var $A_COMP_SECT_NB_CATEG = '分類';
var $A_COMP_SECT_NEW = '新單元';
var $A_COMP_SECT_SEL_MENU = '請選擇菜單';
var $A_COMP_SECT_MUST_NAME = '單元必須有名稱';
var $A_COMP_SECT_MUST_TITLE = '單元必須有標題';
var $A_COMP_SECT_DETAILS = '單元明細';
var $A_COMP_SECT_SCOPE = '範圍';
var $A_COMP_SECT_SHORT_NAME = '在菜單顯示的簡稱';
var $A_COMP_SECT_LONG_NAME = '在標題顯示的全稱';
var $A_COMP_SECT_COPY = '複製單元';
var $A_COMP_SECT_COPY_TO = '複製到單元';
var $A_COMP_SECT_NEW_NAME = '新單元名稱';
var $A_COMP_SECT_WILL_COPY = '將複製所列分類<br />以及分類中的所有條目（也就是所列的）<br />到新單元。';
var $A_COMP_SECT_MENU_LINK = '保存後菜單鏈接就可用';//KEN ADDED

//components/com_sections/admin.sections.php
var $A_COMP_SECT_THE = '單元';
var $A_COMP_SECT_LIST = '單元列表';
var $A_COMP_SECT_BLOG = '單元Blog風格';
var $A_COMP_SECT_DELETE = '選擇單元來刪除';
var $A_COMP_SECT_SEC = '單元';
var $A_COMP_SECT_CANNOT = '不能刪除，因其中還有分類';
var $A_COMP_SECT_SUCCESS_DEL = '成功刪除';
var $A_COMP_SECT_TO = '選擇單元來';
var $A_COMP_SECT_CANNOT_PUB = '不能發佈空單元';
var $A_COMP_SECT_AND_ALL = '及其所有分類和條目已複製';
var $A_COMP_SECT_IN_MENU = '在菜單';
var $A_COMP_SECT_CHANGES_SAVED = '單元的更改已保存';//KEN ADDED
var $A_COMP_SECT_SECTION_SAVED = '單元已保存';//KEN ADDED

//components/com_statistics/admin.statistics.html.php
var $A_COMP_STAT_OS = '瀏覽器、操作系統、域統計';
var $A_COMP_STAT_BR_PAGE = '瀏覽器統計';
var $A_COMP_STAT_BROWSER = '瀏覽器';
var $A_COMP_STAT_OS_PAGE = '操作系統統計';
var $A_COMP_STAT_OP_SYST = '操作系統';
var $A_COMP_STAT_URL_PAGE = '域統計';
var $A_COMP_STAT_URL = '域';
var $A_COMP_STAT_IMPR = '頁面瀏覽統計';
var $A_COMP_STAT_PG_IMPR = '頁面瀏覽';
var $A_COMP_STAT_SCH_ENG = '搜索文本統計';
var $A_COMP_STAT_LOG_IS = '記錄';
var $A_COMP_STAT_ENABLED = '啟用';
var $A_COMP_STAT_DISABLED = '禁用';
var $A_COMP_STAT_SCH_TEXT = '搜索文本';
var $A_COMP_STAT_T_REQ = '搜索次數';
var $A_COMP_STAT_R_RETURN = '返回結果';

//components/com_syndicate/admin.syndicate.html.php
var $A_COMP_SYND_SET = 'RSS 聚合設置';

//components/com_syndicate/admin.syndicate.php
var $A_COMP_SYND_SAVED = '設置成功保存';

//components/com_templates/admin.templates.html.php
var $A_COMP_TEMP_NO_PREVIEW = '沒有可用的預覽';
var $A_COMP_TEMP_INSTALL = '安裝';
var $A_COMP_TEMP_TP = '模版';
var $A_COMP_TEMP_PREVIEW = '預覽模版';
var $A_COMP_TEMP_ASSIGN = '分配';
var $A_COMP_TEMP_AUTHOR_URL = '作者網址';
var $A_COMP_TEMP_EDITOR = '模版編輯者';
var $A_COMP_TEMP_PATH = '路徑：templates';
var $A_COMP_TEMP_WRT = ' - 可寫';
var $A_COMP_TEMP_UNWRT = ' - 不可寫';
var $A_COMP_TEMP_ST_EDITOR = '模版 CSS 編輯器';
var $A_COMP_TEMP_NAME = '路徑';
var $A_COMP_TEMP_ASSIGN_TP = '分配模版';
var $A_COMP_TEMP_TO_MENU = '到菜單項';
var $A_COMP_TEMP_PAGES = '頁面';
var $A_COMP_TEMP_ = '位置';

//components/com_templates/admin.templates.php
var $A_COMP_TEMP_CANNOT = '無法刪除正在使用的模版。';
var $A_COMP_TEMP_NOT_OPEN = '操作失敗：無法打開';
var $A_COMP_TEMP_FLD_SPEC = '操作失敗：沒有指定的模版。';
var $A_COMP_TEMP_FLD_EMPTY = '操作失敗：空內容';
var $A_COMP_TEMP_FLD_WRT = '操作失敗：無法打開文件來寫入。';
var $A_COMP_TEMP_FLD_NOT = '操作失敗：文件不可寫。';
var $A_COMP_TEMP_SAVED = '位置保存了';

//components/com_typedcontent/admin.typedcontent.html.php
var $A_COMP_TYPED_STATIC = '靜態內容管理';
var $A_COMP_TYPED_LINKS = '鏈接';
var $A_COMP_TYPED_ARE_YOU = '確認創建菜單鏈接到靜態內容條目？ \n任何未保存的更改將丟失。';
var $A_COMP_TYPED_CONTENT = '靜態內容';
var $A_COMP_TYPED_TEXT = '正文：(必填)';
var $A_COMP_TYPED_EXPIRES = '過期';
var $A_COMP_TYPED_WILL = '將在選中的菜單創建 \'菜單項 - 靜態內容\' 的鏈接';
var $A_COMP_TYPED_ITEM = '靜態內容條目';

//components/com_typedcontent/admin.typedcontent.php
var $A_COMP_TYPED_SAVED = '靜態內容條目已保存';
var $A_COMP_TYPED_CHG_SAVED = '靜態內容條目的修改已保存';

//components/com_users/admin.users.html.php
var $A_COMP_USERS_ID = '用戶代碼';
var $A_COMP_USERS_LOG_IN = '登錄';
var $A_COMP_USERS_LAST = '最近訪問';
var $A_COMP_USERS_BLOCKED = '封鎖';
var $A_COMP_USERS_YOU_MUST = '必須輸入用戶名。';
var $A_COMP_USERS_YOU_LOGIN = '用戶名包含無效字符，或長度不夠。';
var $A_COMP_USERS_MUST_EMAIL = '必須輸入Email地址。';
var $A_COMP_USERS_ASSIGN = '必須分配用戶到一個群組。';
var $A_COMP_USERS_NO_MATCH = '密碼不匹配';
var $A_COMP_USERS_NO_FRONTEND = '請選擇另一個組，因為`Public Frontend`不是一個可選擇的選項';
var $A_COMP_USERS_NO_BACKEND = '請選擇另一個組，因為`Public Backend`不是一個可選擇的選項';
var $A_COMP_USERS_DETAILS = '用戶明細';
var $A_COMP_USERS_EMAIL = 'Email';
var $A_COMP_USERS_PASS = '密碼';
var $A_COMP_USERS_VERIFY = '密碼確認';
var $A_COMP_USERS_BLOCK = '封鎖用戶';
var $A_COMP_USERS_SUBMI = '接收通知郵件';
var $A_COMP_USERS_REG_DATE = '註冊日期';
var $A_COMP_USERS_VISIT_DATE = '最近訪問日期';
var $A_COMP_USERS_CONTACT = '聯繫人信息';
var $A_COMP_USERS_NO_DETAIL = '沒有此用戶關聯的聯繫人信息：<br />請到 \'組件 -> 聯繫人 -> 聯繫人管理\' 查閱詳細信息。';
var $A_COMP_USERS_CHANGE_CONTACT = '更改聯繫人信息';
var $A_COMP_USERS_CONTACT_INFO = '組件 -> 聯繫人 -> 聯繫人管理';

//components/com_users/admin.users.php
var $A_COMP_USERS_SUPER_ADMIN = 'Super Administrator';
var $A_COMP_USERS_CANNOT = '不能刪除超級管理員';
var $A_COMP_USERS_NOT_DEL_SELF = '你不能刪除你自己！';
var $A_COMP_USERS_NOT_DEL_ADMIN = '你不能刪除其他 `Administrator`，只有 `Super Administrators` 才有這個權限';

//components/com_users/toolbar.users.html.php
var $A_COMP_USERS_LOGOUT = '強制退出';

//components/com_weblinks/admin.weblinks.html.php
var $A_COMP_WEBL_MANAGER = '網站鏈接管理';
var $A_COMP_WEBL_APPROVED = '批准';
var $A_COMP_WEBL_MUST_TITLE = '網站鏈接條目必須輸入標題';
var $A_COMP_WEBL_MUST_CATEG = '請選擇分類.';
var $A_COMP_WEBL_MUST_URL = '必須輸入網址';
var $A_COMP_WEBL_WL = '網站鏈接';

//components/com_installer/admin.installer.php
var $A_INSTALL_NOT_FOUND = "元件的安裝文件未找到";
var $A_INSTALL_NOT_AVAIL = "元件的安裝文件不可用";
var $A_INSTALL_ENABLE_MSG = "文件上傳功能未啟用，安裝無法繼續。請使用「從目錄安裝」的方法來安裝。";
var $A_INSTALL_ERROR_MSG_TITLE = '安裝 - 錯誤';
var $A_INSTALL_ZLIB_MSG = "zlib未安裝，，安裝無法繼續。";
var $A_INSTALL_NOFILE_MSG = '尚未選擇文件';
var $A_INSTALL_NEWMODULE_ERROR_MSG_TITLE = '上傳新模塊 - 錯誤';
var $A_INSTALL_UPLOAD_PRE = '上傳 ';
var $A_INSTALL_UPLOAD_POST = ' - 上傳失敗';
var $A_INSTALL_UPLOAD_POST2 = ' -  上傳錯誤';
var $A_INSTALL_SUCCESS = '成功 ';
var $A_INSTALL_ERROR = '錯誤';
var $A_INSTALL_FAILED = '失敗';
var $A_INSTALL_SELECT_DIR = '請選擇目錄';
var $A_INSTALL_UPLOAD_NEW = '上傳新';
var $A_INSTALL_FAIL_PERMISSION = '無法改變上傳文件的權限。';
var $A_INSTALL_FAIL_MOVE = '無法移動上傳文件到<code>/media</code>目錄。';
var $A_INSTALL_FAIL_WRITE = '上傳失敗 - <code>/media</code> 目錄不可寫。';
var $A_INSTALL_FAIL_EXIST = '上傳失敗 - <code>/media</code> 目錄不存在。';

//components/com_installer/admin.installer.html.php
var $A_INSTALL_WRITABLE = '可寫';
var $A_INSTALL_UNWRITABLE = '不可寫';
var $A_INSTALL_CONTINUE = '繼續 ...';
var $A_INSTALL_UPLOAD_PACK_FILE = '上傳安裝包';
var $A_INSTALL_PACK_FILE = '安裝包：';
var $A_INSTALL_UPL_INSTALL = "上傳文件 &amp; 安裝";
var $A_INSTALL_FROM_DIR = '從目錄安裝';
var $A_INSTALL_DIR = '安裝目錄：';
var $A_INSTALL_DO_INSTALL = '安裝';

//components/com_installer/component/component.html.php
var $A_INSTALL_COMP_INSTALLED = '已安裝組件';
var $A_INSTALL_COMP_CURRENT = '當前已安裝';
var $A_INSTALL_COMP_MENU = '組件菜單鏈接';
var $A_INSTALL_COMP_AUTHOR = '作者';
var $A_INSTALL_COMP_VERSION = '版本';
var $A_INSTALL_COMP_DATE = '日期';
var $A_INSTALL_COMP_AUTH_MAIL = '作者Email';
var $A_INSTALL_COMP_AUTH_URL = '作者網址';
var $A_INSTALL_COMP_NONE = '尚未安裝第三方組件';

//components/com_installer/component/component.php
var $A_INSTALL_COMP_UPL_NEW = '上傳新組件';

//components/com_installer/language/language.php
var $A_INSTALL_LANG = '上傳新語言';
var $A_INSTALL_BACK_LANG_MGR = '返回語言管理';

//components/com_installer/language/language.class.php
var $A_INSTALL_LANG_NOREMOVE = '語言代碼為空，無法刪除文件。';
var $A_INSTALL_LANG_UN_ERR = '卸載 - 錯誤';
var $A_INSTALL_LANG_DELETING = '刪除';

//components/com_installer/mambot/mambot.html.php
var $A_INSTALL_MAMB_MAMBOTS = '觸發器';
var $A_INSTALL_MAMB_CORE = '只顯示那些可以卸載的觸發器 - 一些核心觸發器不能刪除。';
var $A_INSTALL_MAMB_MAMBOT = '觸發器';
var $A_INSTALL_MAMB_TYPE = '類型';
var $A_INSTALL_MAMB_AUTHOR = '作者';
var $A_INSTALL_MAMB_VERSION = '版本';
var $A_INSTALL_MAMB_DATE = '日期';
var $A_INSTALL_MAMB_AUTH_MAIL = '作者Email';
var $A_INSTALL_MAMB_AUTH_URL = '作者網址';
var $A_INSTALL_MOD_NO_MAMBOTS = '尚未有非核心、第三方觸發器安裝。';

//components/com_installer/mambot/mambot.php
var $A_INSTALL_MAMB_INSTALL_MAMBOT = '安裝觸發器';

//components/com_installer/module/module.html.php
var $A_INSTALL_MOD_MODS = '模塊';
var $A_INSTALL_MOD_FILTER = '篩選：';
var $A_INSTALL_MOD_CORE = '只顯示那些可以卸載的模塊 - 一些核心模塊不能刪除。';
var $A_INSTALL_MOD_MOD = '模塊文件';
var $A_INSTALL_MOD_CLIENT = '客戶';
var $A_INSTALL_MOD_AUTHOR = '作者';
var $A_INSTALL_MOD_VERSION = '版本';
var $A_INSTALL_MOD_DATE = '日期';
var $A_INSTALL_MOD_AUTH_MAIL = '作者Email';
var $A_INSTALL_MOD_AUTH_URL = '作者網址';
var $A_INSTALL_MOD_NO_CUSTOM = '尚未有第三方模塊安裝。';

//components/com_installer/module/module.php
var $A_INSTALL_MOD_INSTALL_MOD = '安裝模塊';
var $A_INSTALL_MOD_ADMIN_MOD = '管理模塊';

//components/com_install/template/template.php
var $A_INSTALL_TEMPL_INSTALL = '安裝新模版';
var $A_INSTALL_TEMPL_SITE_TEMPL = '網站模版';
var $A_INSTALL_TEMPL_ADMIN_TEMPL = '後台模版';
var $A_INSTALL_TEMPL_BACKTTO_TEMPL = '返回模版管理';

//components/com_menus/admin.menus.html.php
var $A_COMP_MENUS_MAX_LVLS = '最大級數';
var $A_COMP_MENUS_MENU_ITEM = '菜單項';
var $A_COMP_MENUS_MENU_ORDER = '次序';//KEN ADDED
var $A_COMP_MENUS_MENU_SAVE_ORDER = '保存次序';//KEN ADDED
var $A_COMP_MENUS_MENU_ITEMID = '條目ID';//KEN ADDED
var $A_COMP_MENUS_MENU_CID = '組件ID';//KEN ADDED
var $A_COMP_MENUS_MENU_CONTENT = '內容';//KEN ADDED
var $A_COMP_MENUS_MENU_MISC = '雜項';//KEN ADDED
var $A_COMP_MENUS_MENU_NOTE = '* 註：有些菜單類型出現在多個組中，但它們仍是相同的菜單類型。';//KEN ADDED
var $A_COMP_MENUS_MENU_COM = '組件';//KEN ADDED
var $A_COMP_MENUS_MENU_LINKS = '鏈接';//KEN ADDED
var $A_COMP_MENUS_MENU_ITEM_TYPE = '菜單項類型';//KEN ADDED
var $A_COMP_MENUS_MENU_HELP = '幫助';//KEN ADDED
var $A_COMP_MENUS_MENU_BLOGVIEW = '什麼是 "Blog" 視圖';//KEN ADDED
var $A_COMP_MENUS_MENU_TABLEVIEW = '什麼是 "表格" 視圖';//KEN ADDED
var $A_COMP_MENUS_MENU_LISTVIEW = '什麼是 "列表" 視圖';//KEN ADDED
var $A_COMP_MENUS_ADD_ITEM = '新增菜單項';
var $A_COMP_MENUS_SELECT_ADD = '選擇組件來新增';
var $A_COMP_MENUS_MOVE_ITEMS = '移動菜單項';
var $A_COMP_MENUS_MOVE_MENU = '移動到菜單';
var $A_COMP_MENUS_BEING_MOVED = '移動的菜單項';
var $A_COMP_MENUS_COPY_ITEMS = '複製菜單項';
var $A_COMP_MENUS_NEXT = '下一步';
var $A_COMP_MENUS_COPY_MENU = '複製到菜單';
var $A_COMP_MENUS_BEING_COPIED = '複製的菜單項';
var $A_COMP_MENUS_SELECT_TO = '請選擇菜單項來';
var $A_COMP_MENUS_SEFPATH = 'SEF路徑';
var $A_COMP_MENUS_SEFPATH_TIP = '設置搜索引擎友好鏈接的路徑';

//components/com_menus/admin.menus.php
var $A_COMP_MENUS_ITEM_SAVED = '菜單項已保存';//KEN ADDED
var $A_COMP_MENUS_MOVED_TO = ' 菜單項移動到';
var $A_COMP_MENUS_COPIED_TO = ' 菜單項複製到';
var $A_COMP_MENUS_WRAPPER = '嵌入頁面';
var $A_COMP_MENUS_SEPERATOR = '分隔符/佔位符';
var $A_COMP_MENUS_LINK = '鏈接 - ';
var $A_COMP_MENUS_STATIC = '靜態內容';
var $A_COMP_MENUS_URL = '網址';
var $A_COMP_MENUS_CONTENT_ITEM = '內容條目';
var $A_COMP_MENUS_COMP_ITEM = '組件條目';
var $A_COMP_MENUS_CONT_ITEM = '聯繫人條目';
var $A_COMP_MENUS_NEWSFEED = '新聞轉播';
var $A_COMP_MENUS_COMP = '組件';
var $A_COMP_MENUS_LIST = '列表';
var $A_COMP_MENUS_TABLE = '表格';
var $A_COMP_MENUS_BLOG = 'Blog風格';
var $A_COMP_MENUS_CONT_SEC = '內容單元';
var $A_COMP_MENUS_CONT_CAT = '內容分類';
var $A_COMP_MENUS_CONTACT_CAT = '聯繫人分類';
var $A_COMP_MENUS_WEBLINK_CAT = '網站鏈接分類';
var $A_COMP_MENUS_NEWS_CAT = '新聞轉播分類';
var $A_COMP_MENUS_NEW_ORDER_SAVED = '新的次序已保存';//KEN ADDED
var $A_COMP_MENUS_EDIT_NEWSFEED_TIP = '編輯此新聞轉播';
var $A_COMP_MENUS_EDIT_CONTACT_TIP = '編輯此聯繫人';
var $A_COMP_MENUS_EDIT_CONTENT_TIP = '編輯此內容';
var $A_COMP_MENUS_EDIT_STATIC_TIP = '編輯此靜態內容';

//components/com_menus/component_item_link/component_item_link.menu.html.php
var $A_COMP_MENUS_CIL_LINK_NAME = '鏈接必須輸入名稱';
var $A_COMP_MENUS_CIL_SELECT_COMP = '必須選擇組件來鏈接';
var $A_COMP_MENUS_CIL_LINK_COMP = '組件';
var $A_COMP_MENUS_CIL_ON_CLICK = '點擊打開方式';
var $A_COMP_MENUS_CIL_PARENT = '父菜單項';
var $A_DETAILS = '明細';

//components/com_menus/components/components.menu.html.php
var $A_COMP_MENUS_CMP_ITEM_NAME = '必須輸入名稱';
var $A_COMP_MENUS_CMP_SELECT_CMP = '請選擇組件';
var $A_COMP_MENUS_PARAMETERS_AVAILABLE = '一旦保存此新的菜單項，下列參數就可用了';
var $A_COMP_MENUS_CMP_ITEM_COMP = '菜單項 :: 組件';

//components/com_menus/contact_category_table/contact_category_table.menu.html.php
var $A_COMP_MENUS_CMP_CCT_CATEG = '必須選擇分類';
var $A_COMP_MENUS_CMP_CCT_TITLE = '菜單項必須有名稱';
var $A_COMP_MENUS_CMP_CCT_BLANK = '如果留空，將自動使用分類名稱。';
var $A_COMP_MENUS_CMP_CCT_THETITLE = '標題：';
var $A_COMP_MENUS_CMP_CCT_THECAT = '分類：';

//components/com_menus/contact_item_link/contact_item_link.menu.html.php
var $A_COMP_MENUS_CMP_CIL_LINK_NAME = '鏈接必須有名稱';
var $A_COMP_MENUS_CMP_CIL_SEL_CONT = '必須選擇一個聯繫人來鏈接。';
var $A_COMP_MENUS_CMP_CIL_CONTACT = '鏈接聯繫人';
var $A_COMP_MENUS_CMP_CIL_ONCLICK = '點擊打開方式';
var $A_COMP_MENUS_CMP_CIL_HDR = '菜單項 :: 鏈接 - 聯繫人';

//components\com_menus\content_archive_section\content_archive_section.menu.html.php
var $A_COMP_MENUS_CMP_CAS_BLANK = '如果留空，將自動使用單元名稱。';

//components\com_menus\content_blog_category\content_blog_category.menu.html.php
var $A_COMP_MENUS_CMP_CBC_CATEG = '可以選擇多個分類';

//components\com_menus\content_blog_section\content_blog_section.menu.html.php
var $A_COMP_MENUS_CMP_CBS_SECTION = '可以選擇多個單元';

//components\com_menus\content_item_link\content_item_link.menu.html.php
var $A_COMP_MENUS_CMP_CIL_SEL_LINK = '必須選擇一個內容條目來鏈接。';

//components/com_menus/wrapper/wrapper.menu.html.php
var $A_COMP_MENUS_WRAPPER_LINK = '嵌入頁面網址';

//components/com_menus/separator/separator.menu.html.php
var $A_COMP_MENUS_SEPARATOR_PATTERN = '模式/名稱';

//components/com_menus/content_typed/content_typed.menu.html.php
var $A_COMP_MENUS_TYPED_CONTENT_TO_LINK = '鏈接靜態內容';

//components/com_menus/content_item_link/content_item_link.menu.html.php
var $A_COMP_MENUS_CONTENT_TO_LINK = '鏈接內容';

//components/com_menus/newsfeed_link/newsfeed_link.menu.html.php
var $A_COMP_MENUS_NEWSFEED_TO_LINK = '鏈接新聞轉播';
var $A_COMP_MENUS_NEWSFEED_SELECT_LINK = '必須選擇一個新聞轉播來鏈接。';

//components\com_menus\url\url.menu.html.php
var $A_COMP_MENUS_URL_MUST = '必須輸入網址';
var $A_COMP_MENUS_URL_LINK = '鏈接網址';


	function adminLanguage()
	{
		global $TR_STRS;
		//Menu Caption Translation for initial mambo menutype
		$TR_STRS[strtolower('mainmenu')] = '主菜單';
		$TR_STRS[strtolower('othermenu')] = '其它菜單';
		$TR_STRS[strtolower('topmenu')] = '頂部菜單';
		$TR_STRS[strtolower('usermenu')] = '用戶菜單';

		//Components menu caption
		//Banners
		$TR_STRS[strtolower('Banners')] = '橫幅廣告';
		$TR_STRS[strtolower('Manage Banners')] = '管理橫幅廣告';
		$TR_STRS[strtolower('Manage Clients')] = '管理客戶';

		//Web Links
		$TR_STRS[strtolower('Web Links')] = '網站鏈接';
		$TR_STRS[strtolower('Weblink Items')] = '網站鏈接條目';
		$TR_STRS[strtolower('Weblink Categories')] = '網站鏈接分類';

		//Contacts
		$TR_STRS[strtolower('Contacts')] = '聯繫人';
		$TR_STRS[strtolower('Manage Contacts')] = '管理聯繫人';
		$TR_STRS[strtolower('Contact Categories')] = '聯繫人分類';

		//Polls
		$TR_STRS[strtolower('Polls')] = '在線調查';

		//News Feeds
		$TR_STRS[strtolower('News Feeds')] = '新聞轉播';
		$TR_STRS[strtolower('Manage News Feeds')] = '管理新聞轉播';
		$TR_STRS[strtolower('Manage Categories')] = '管理分類';

		//Syndicate
		$TR_STRS[strtolower('Syndicate')] = 'RSS 聚合';

		//Mass Mail
		$TR_STRS[strtolower('Mass Mail')] = '群發郵件';

		//modules XML file
		$TR_STRS[strtolower('Count')] = '數量';
		$TR_STRS[strtolower('The number of items to display (default is 5)')] = '最大列表數(默認為 5)';
		$TR_STRS[strtolower('The number of items to display (default is 10)')] = '最大列表數(默認為 10)';
		$TR_STRS[strtolower('Enable Cache')] = '啟用緩存';
		$TR_STRS[strtolower('Select whether to cache the content of this module')] = '是否為本模塊的內容使用緩存';
		$TR_STRS[strtolower('No')] = '否';
		$TR_STRS[strtolower('Yes')] = '是';
		$TR_STRS[strtolower('Module Class Suffix')] = '模塊css後綴';
		$TR_STRS[strtolower('A suffix to be applied to the css class of the module (table.moduletable), this allows individual module styling')] = '應用到模塊的css類的後綴(table.moduletable)，這樣允許模塊使用獨自的css風格';
		$TR_STRS[strtolower('Banner')] = '橫幅廣告';
		$TR_STRS[strtolower('Banner client')] = '廣告客戶';
		$TR_STRS[strtolower("Reference to banner client id. Enter separated by ','!")] = "關聯到橫幅廣告的客戶ID. 如有多個ID則用','分隔!";
		$TR_STRS[strtolower('Latest News')] = '最新文章';
		$TR_STRS[strtolower('This module shows a list of the latest published content items.')] = '本模塊顯示最新發佈的文章列表。';
		$TR_STRS[strtolower('Most Read Content')] = '熱門文章';
		$TR_STRS[strtolower('This module shows a list of published content items that have been viewed the most.')] = '本模塊顯示最熱門(瀏覽最多)的文章列表。';
		$TR_STRS[strtolower('Both')] = '兩者都有';
		$TR_STRS[strtolower('Show')] = '顯示';
		$TR_STRS[strtolower('Hide')] = '隱藏';
		$TR_STRS[strtolower('Frontpage Items')] = '首頁條目';
		$TR_STRS[strtolower('Show/Hide items designated for the Frontpage - only works when in Content Items only mode')] = '顯示/隱藏指定給首頁的條目 - 僅為內容條目模式有效';
		$TR_STRS[strtolower('Category ID')] = '分類ID';
		$TR_STRS[strtolower('Selects items from a specific Category or set of Categories (to specify more than one Category, seperate with a comma , ).')] = '從一個指定分類或一組分類選擇條目 (如有多個ID則用逗號隔開)';
		$TR_STRS[strtolower('Section ID')] = '單元ID';
		$TR_STRS[strtolower('Selects items from a specific Secion or set of Sections (to specify more than one Section, seperate with a comma , ).')] = '從一個指定單元或一組單元選擇條目 (如有多個ID則用逗號隔開)';
		$TR_STRS[strtolower('Show Headline')] = '顯示頭條';
		$TR_STRS[strtolower('Show/Hide the first content item as headline')] = '顯示/隱藏第一篇文章條目作為頭條新聞';
		$TR_STRS[strtolower('Module Title')] = '模塊標題';
		$TR_STRS[strtolower('User defined module title, Only use when headline shown')] = '用戶自定義的模塊標題，僅當頭條顯示時使用';
		$TR_STRS[strtolower('Section/Category Style')] = '單元/分類風格';
		$TR_STRS[strtolower('style of section/category: list or blog')] = '單元/分類風格: 列表或博客風格';
		$TR_STRS[strtolower('List')] = '列表風格';
		$TR_STRS[strtolower('Blog')] = '博客風格';
		$TR_STRS[strtolower('Title Length')] = '標題長度';
		$TR_STRS[strtolower('The max length of item title in chars to display, Default 40')] = '文章標題顯示的最大長度，默認為40個字符';
		$TR_STRS[strtolower('Date Display')] = '日期顯示';
		$TR_STRS[strtolower('The display of item created date')] = '文章創建日期的顯示';
		$TR_STRS[strtolower('Login Form')] = '登錄表單';
		$TR_STRS[strtolower('Module Layout')] = '模塊佈局';
		$TR_STRS[strtolower('The layout of login module')] = '登錄模塊的佈局';
		$TR_STRS[strtolower('Vertical Compact')] = '豎向緊湊';
		$TR_STRS[strtolower('Login Redirection URL')] = '登錄轉向網址';
		$TR_STRS[strtolower('What page will the login redirect to after login, if let blank will load front page')] = '登錄後轉向的頁面，如果留空將裝載首頁';
		$TR_STRS[strtolower('Logout Redirection URL')] = '退出轉向網址';
		$TR_STRS[strtolower('What page will the logout redirect to after logout, if let blank will load front page')] = '退出後轉向的頁面，如果留空將裝載首頁';
		$TR_STRS[strtolower('Login Message')] = '登錄提示';
		$TR_STRS[strtolower('Show/Hide the javascript Pop-up indicating Login Success')] = '顯示/隱藏 javascript 彈出窗口來提示登錄成功 ';
		$TR_STRS[strtolower('Logout Message')] = '退出提示';
		$TR_STRS[strtolower('Show/Hide the javascript Pop-up indicating Logout Success')] = '顯示/隱藏 javascript 彈出窗口來提示退出成功 ';
		$TR_STRS[strtolower('Greeting')] = '問候語';
		$TR_STRS[strtolower('Show/Hide the simple greeting text')] = '顯示/隱藏簡單的問候文本';
		$TR_STRS[strtolower('Name/Username')] = '姓名/用戶名';
		$TR_STRS[strtolower('Username')] = '用戶名';
		$TR_STRS[strtolower('Name')] = '姓名';
		$TR_STRS[strtolower('Main Menu')] = '主菜單';
		$TR_STRS[strtolower('Menu Class Suffix')] = '菜單css後綴';
		$TR_STRS[strtolower('A suffix to be applied to the css class of the menu items')] = '應用到菜單項的css類的後綴';
		$TR_STRS[strtolower('Menu Name')] = '菜單名稱';
		$TR_STRS[strtolower("The name of the menu (default is 'mainmenu')")] = "菜單的名稱(默認為主菜單)";
		$TR_STRS[strtolower('Menu Style')] = '菜單風格';
		$TR_STRS[strtolower('The menu style')] = '菜單風格';
		$TR_STRS[strtolower('Vertical')] = '豎向';
		$TR_STRS[strtolower('Horizontal')] = '橫向';
		$TR_STRS[strtolower('Flat List')] = '縱向列表';
		$TR_STRS[strtolower('Show Menu Icons')] = '顯示菜單圖標';
		$TR_STRS[strtolower('Show the Menu Icons you have selected for your menu items')] = '顯示您為菜單項設置的圖標';
		$TR_STRS[strtolower('Menu Icon Alignment')] = '菜單圖標對齊';
		$TR_STRS[strtolower('Alignment of the Menu Icons')] = '菜單圖標對齊';
		$TR_STRS[strtolower('Left')] = '左';
		$TR_STRS[strtolower('Right')] = '右';
		$TR_STRS[strtolower('Expand Menu')] = '展開菜單';
		$TR_STRS[strtolower('Expand the menu and make its sub-menus items always visible')] = '展開菜單，使子菜單總是顯示出來';
		$TR_STRS[strtolower('Indent Image')] = '縮進圖片';
		$TR_STRS[strtolower('Choose which indent image system to utilise')] = '選擇使用哪個縮進圖片系統';
		$TR_STRS[strtolower('Template')] = '模版';
		$TR_STRS[strtolower('Mambo default images')] = '曼波默認圖片';
		$TR_STRS[strtolower('Use params below')] = '使用以下參數';
		$TR_STRS[strtolower('None')] = '無';
		$TR_STRS[strtolower('Indent Image 1')] = '縮進圖片1';
		$TR_STRS[strtolower('Image for the first sub-level')] = '第1級子菜單的圖標';
		$TR_STRS[strtolower('Indent Image 2')] = '縮進圖片2';
		$TR_STRS[strtolower('Image for the second sub-level')] = '第2級子菜單的圖標';
		$TR_STRS[strtolower('Indent Image 3')] = '縮進圖片3';
		$TR_STRS[strtolower('Image for the third sub-level')] = '第3級子菜單的圖標';
		$TR_STRS[strtolower('Indent Image 4')] = '縮進圖片4';
		$TR_STRS[strtolower('Image for the fourth sub-level')] = '第4級子菜單的圖標';
		$TR_STRS[strtolower('Indent Image 5')] = '縮進圖片5';
		$TR_STRS[strtolower('Image for the fifth sub-level')] = '第5級子菜單的圖標';
		$TR_STRS[strtolower('Indent Image 6')] = '縮進圖片6';
		$TR_STRS[strtolower('Image for the sixth sub-level')] = '第6級子菜單的圖標';
		$TR_STRS[strtolower('Spacer')] = '間隔符';
		$TR_STRS[strtolower('Spacer for Horizontal menu')] = '橫向菜單的間隔符';
		$TR_STRS[strtolower('End Spacer')] = '末端間隔符';
		$TR_STRS[strtolower('End Spacer for Horizontal menu')] = '橫向菜單的末端間隔符';
		$TR_STRS[strtolower('Newsflash')] = '新聞快訊';
		$TR_STRS[strtolower('Category')] = '分類';
		$TR_STRS[strtolower('A content cateogry')] = '一個內容分類';
		$TR_STRS[strtolower('Style')] = '風格';
		$TR_STRS[strtolower('The style to display the category')] = '分類顯示的風格';
		$TR_STRS[strtolower('Randomly choose one at a time')] = '每次隨機選擇';
		$TR_STRS[strtolower('Show images')] = '顯示圖片';
		$TR_STRS[strtolower('Display content item images')] = '顯示內容條目的圖片';
		$TR_STRS[strtolower('Linked Titles')] = '鏈接標題';
		$TR_STRS[strtolower('Make the Item titles linkable')] = '使條目的標題可鏈接';
		$TR_STRS[strtolower('Use Global')] = '使用全局設置';
		$TR_STRS[strtolower('Read More')] = '閱讀全文';
		$TR_STRS[strtolower('Show/Hide the Read More button')] = '顯示/隱藏閱讀全文按鈕';
		$TR_STRS[strtolower('Item Title')] = '條目標題';
		$TR_STRS[strtolower('Show item title')] = '顯示條目標題';
		$TR_STRS[strtolower('No. of Items')] = '條目數';
		$TR_STRS[strtolower('No of items to display')] = '顯示的條目數';
		$TR_STRS[strtolower('Poll')] = '在線調查';
		$TR_STRS[strtolower('Random Image')] = '隨機圖片';
		$TR_STRS[strtolower('Image Type')] = '圖片類型';
		$TR_STRS[strtolower('Type of image PNG/GIF/JPG etc. (default is JPG)')] = '圖片類型如 PNG/GIF/JPG 等。（默認為 JPG）';
		$TR_STRS[strtolower('Image Folder')] = '圖片文件夾';
		$TR_STRS[strtolower('Path to the image folder relative to the site url, eg: images/stories')] = '圖片文件夾相對於網站鏈接的路徑，如 images/stories';
		$TR_STRS[strtolower('Link')] = '鏈接';
		$TR_STRS[strtolower('A URL to redirect to if image is clicked on, eg: http://www.mamboserver.com')] = '點擊圖片時轉向的鏈接，如 http://www.mamboserver.com';
		$TR_STRS[strtolower('Width (px)')] = '寬度 (px)';
		$TR_STRS[strtolower('Image width (forces all images to be displayed with this width)')] = '圖片寬度 （強制所有圖片顯示在此寬度）';
		$TR_STRS[strtolower('Height (px)')] = '高度 (px)';
		$TR_STRS[strtolower('Image height (forces all images to be displayed with the height)')] = '圖片高度 （強制所有圖片顯示在此高度）';
		$TR_STRS[strtolower('Related Items')] = '相關文章';
		$TR_STRS[strtolower('Text')] = '文本';
		$TR_STRS[strtolower('Enter the text to be displayed along with the RSS links')] = '輸入和 RSS 鏈接一起顯示的文本';
		$TR_STRS[strtolower('Show/Hide RSS 0.91 Link')] = '顯示/隱藏 RSS 0.91 鏈接';
		$TR_STRS[strtolower('Show/Hide RSS 1.0 Link')] = '顯示/隱藏 RSS 1.0 鏈接';
		$TR_STRS[strtolower('Show/Hide RSS 2.0 Link')] = '顯示/隱藏 RSS 2.0 鏈接';
		$TR_STRS[strtolower('Show/Hide Atom 0.3 Link')] = '顯示/隱藏 Atom 0.3 鏈接';
		$TR_STRS[strtolower('Show/Hide OPML Link')] = '顯示/隱藏 OPML 鏈接';
		$TR_STRS[strtolower('RSS 0.91 Image')] = 'RSS 0.91 圖片';
		$TR_STRS[strtolower('Choose the image to be used')] = '選擇要使用的圖標';
		$TR_STRS[strtolower('RSS 1.0 Image')] = 'RSS 1.0 圖片';
		$TR_STRS[strtolower('RSS 2.0 Image')] = 'RSS 2.0 圖片';
		$TR_STRS[strtolower('Atom Image')] = 'Atom 圖片';
		$TR_STRS[strtolower('OPML Image')] = 'OPML 圖片';
		$TR_STRS[strtolower('Search Module')] = '搜索模塊';
		$TR_STRS[strtolower('Box Width')] = '搜索框寬度';
		$TR_STRS[strtolower('Size of the search text box')] = '搜索文本框的尺寸';
		$TR_STRS[strtolower('The text that appears in the search text box, if left blank it will load _SEARCH_BOX from your language file')] = '顯示在搜索文本框中的文本，如留空則載入您的語言文件中的 _SEARCH_BOX';
		$TR_STRS[strtolower('Search Button')] = '搜索按鈕';
		$TR_STRS[strtolower('Display a Search Button')] = '顯示一個搜索按鈕';
		$TR_STRS[strtolower('Button Position')] = '按鈕位置';
		$TR_STRS[strtolower('Position of the button relative to the search box')] = '按鈕位置相對於搜索框';
		$TR_STRS[strtolower('Top')] = '頂部';
		$TR_STRS[strtolower('Bottom')] = '底部';
		$TR_STRS[strtolower('Button Text')] = '按鈕文本';
		$TR_STRS[strtolower('The text that appears in the search button, if left blank it will load _SEARCH_TITLE from your language file')] = '顯示在搜索按鈕上的文本，如留空則載入您的語言文件中的 _SEARCH_TITLE';
		$TR_STRS[strtolower('Sections')] = '單元';
		$TR_STRS[strtolower('Statistics')] = '統計';
		$TR_STRS[strtolower('Server Info')] = '服務器信息';
		$TR_STRS[strtolower('Display server information')] = '顯示服務器信息';
		$TR_STRS[strtolower('Site Info')] = '站點信息';
		$TR_STRS[strtolower('Display site information')] = '顯示站點信息';
		$TR_STRS[strtolower('Hit Counter')] = '點擊數';
		$TR_STRS[strtolower('Display hit counter')] = '顯示點擊計數器';
		$TR_STRS[strtolower('Increase counter')] = '增加計數器';
		$TR_STRS[strtolower('Enter the amount of hits to increase counter by')] = '輸入點擊的總數來增加計數器';
		$TR_STRS[strtolower('Template Chooser')] = '模版選擇器';
		$TR_STRS[strtolower('Max. Name Length')] = '名稱最大長度';
		$TR_STRS[strtolower('This is the maximum length of the template name to display (default 20)')] = '模板名稱顯示的最大長度（默認為 20）';
		$TR_STRS[strtolower('Show Preview')] = '顯示預覽';
		$TR_STRS[strtolower('Template preview is to be shown')] = '顯示模版的預覽';
		$TR_STRS[strtolower('This is the width of the preview image (default 140)')] = '預覽圖片的寬度（默認為 140）';
		$TR_STRS[strtolower('This is the height of the preview image (default 90)')] = '預覽圖片的長度（默認為 90）';
		$TR_STRS[strtolower("Who's Online")] = "在線情況";
		$TR_STRS[strtolower('Display')] = '顯示';
		$TR_STRS[strtolower('Select what shall be shown')] = '選擇要顯示的內容';
		$TR_STRS[strtolower('# of Guests/Members<br>')] = '現有#位訪客/會員在線<br>';
		$TR_STRS[strtolower('Member Names<br>')] = '會員名稱<br>';
		$TR_STRS[strtolower('Wrapper Module')] = '嵌入頁面模塊';
		$TR_STRS[strtolower('Url')] = '網址';
		$TR_STRS[strtolower('Url to site/file you wish to display within the Iframe')] = '在Iframe中顯示的網站/文件的網址';
		$TR_STRS[strtolower('Scroll Bars')] = '滾動條';
		$TR_STRS[strtolower('Show/Hide Horizontal & Vertical scroll bars.')] = '顯示/隱藏水平和垂直滾動條.';
		$TR_STRS[strtolower('Auto')] = '自動';
		$TR_STRS[strtolower('Width of the IFrame Window, you can enter an absolute figure in pixels, or a relative figure by adding a %')] = 'IFrame窗口的寬度, 你可以輸入絕對的像素數值或相對的百分比數值';
		$TR_STRS[strtolower('Height of the IFrame Window')] = 'IFrame窗口的高度';
		$TR_STRS[strtolower('Auto Height')] = '自動高度';
		$TR_STRS[strtolower('The height will automatically be set to the size of the external page. This will only work for pages on your own domain.')] = '窗口的高度將根據外部頁面自動設定，僅對你自己域名下的網頁有效。';
		$TR_STRS[strtolower('Auto Add')] = '自動增加';
		$TR_STRS[strtolower('By default http:// will be added unless it detects http:// or https:// in the url link you provide, this allow you to switch this ability off')] = '默認增加 http://，除非檢測到您提供的網址為 http:// 或者 https://，這允許你關掉這個功能';

		$TR_STRS[strtolower('Search')] = '搜索';
		$TR_STRS[strtolower('User Menu')] = '用戶菜單';
		$TR_STRS[strtolower('Top Menu')] = '頂部菜單';
		$TR_STRS[strtolower('Other Menu')] = '其它菜單';
		$TR_STRS[strtolower('Wrapper')] = '嵌入頁面';
		$TR_STRS[strtolower('Popular')] = '熱門文章';

		$TR_STRS[strtolower('RSS URL')] = 'RSS 網址';
		$TR_STRS[strtolower('Enter the URL of the RSS/RDF feed')] = '輸入 RSS/RDF 轉播的網址';
		$TR_STRS[strtolower('Feed Description')] = '轉播描述';
		$TR_STRS[strtolower('Show the description text for the whole Feed')] = '顯示整個轉播的描述文本';
		$TR_STRS[strtolower('Feed Image')] = '轉播圖片';
		$TR_STRS[strtolower('Show the image associated with the whole Feed')] = '顯示與整個轉播關聯的圖片';
		$TR_STRS[strtolower('Items')] = '條目';
		$TR_STRS[strtolower('Enter number of RSS items to display')] = '輸入要顯示的 RSS 條目的數量';
		$TR_STRS[strtolower('Item Description')] = '條目描述';
		$TR_STRS[strtolower('Show the description or intro text of individual news items')] = '顯示單獨的新聞條目的描述或介紹文本';

		//administrator/modules XML file
		$TR_STRS[strtolower('Logged')] = '已登錄';
		$TR_STRS[strtolower('Logged in Users')] = '已登錄用戶';
		$TR_STRS[strtolower('Components')] = '組件';
		$TR_STRS[strtolower('Popular Items')] = '熱門條目';
		$TR_STRS[strtolower('Latest Items')] = '最新條目';
		$TR_STRS[strtolower('Menu Stats')] = '菜單統計';
		$TR_STRS[strtolower('Unread Messages')] = '未讀消息';
		$TR_STRS[strtolower('Online Users')] = '在線用戶';
		$TR_STRS[strtolower('Quick Icons')] = '快捷圖標';
		$TR_STRS[strtolower('System Message')] = '系統消息';
		$TR_STRS[strtolower('Pathway')] = '導航路徑';
		$TR_STRS[strtolower('Toolbar')] = '工具欄';
		$TR_STRS[strtolower('Full Menu')] = '全部菜單';

		//mambots XML file
		$TR_STRS[strtolower('MOS Image')] = 'Mambo 圖片';
		$TR_STRS[strtolower('Legacy Mambot Includer')] = '原有觸發器置入';
		$TR_STRS[strtolower('Code support')] = '代碼支持';
		$TR_STRS[strtolower('SEF')] = '搜索引擎友好鏈接';
		$TR_STRS[strtolower('MOS Rating')] = 'Mambo 文章評級';
		$TR_STRS[strtolower('Email Cloaking')] = 'Email 掩飾';
		$TR_STRS[strtolower('GeSHi')] = 'GeSHi';
		$TR_STRS[strtolower('Load Module Positions')] = '裝載模塊位置';
		$TR_STRS[strtolower('MOS Pagination')] = 'Mambo 分頁';
		$TR_STRS[strtolower('No WYSIWYG Editor')] = '非所見即所得編輯器';
		$TR_STRS[strtolower('TinyMCE WYSIWYG Editor')] = 'TinyMCE 所見即所得編輯器';
		$TR_STRS[strtolower('MOS Image Editor Button')] = 'Mambo 圖片編輯器按鈕';
		$TR_STRS[strtolower('MOS Pagebreak Editor Button')] = 'Mambo 分頁編輯器按鈕';
		$TR_STRS[strtolower('Search Content')] = '搜索內容';
		$TR_STRS[strtolower('Search Weblinks')] = '搜索網站鏈接';
		$TR_STRS[strtolower('Search Contacts')] = '搜索聯繫人';
		$TR_STRS[strtolower('Search Categories')] = '搜索分類';
		$TR_STRS[strtolower('Search Sections')] = '搜索單元';
		$TR_STRS[strtolower('Search Newsfeeds')] = '搜索新聞轉播';

		$TR_STRS[strtolower('Mode')] = '模式';
		$TR_STRS[strtolower('Select how the emails will be displayed')] = '選擇 emails 的顯示方式';
		$TR_STRS[strtolower('Nonlinkable Text')] = '不可鏈接的文本';
		$TR_STRS[strtolower('As linkable mailto address')] = '可鏈接的 mailto 地址';
		$TR_STRS[strtolower('Margin')] = '頁邊距';
		$TR_STRS[strtolower('Margin in px, of Div surrounding Image & Caption - only applies if using a Caption')] = '圍繞圖片和標題的 Div 的頁邊距，以像素為單位 - 僅在使用標題時有效';
		$TR_STRS[strtolower('Padding')] = '填充';
		$TR_STRS[strtolower('Padding in px, of Div surrounding Image & Caption - only applies if using a Caption')] = '圍繞圖片和標題的 Div 的填充，以像素為單位 - 僅在使用標題時有效';
		$TR_STRS[strtolower('Wrapped by Table - Column')] = '用表格包裝 - 列';
		$TR_STRS[strtolower('Wrapped by Table - Horizontal')] = '用表格包裝 - 水平的';
		$TR_STRS[strtolower('Wrapped by Divs')] = '用 Divs 包裝';
		$TR_STRS[strtolower('No wrapping - raw output')] = '沒有包裝 - 原始輸出';
		$TR_STRS[strtolower('Site Title')] = '網站標題';
		$TR_STRS[strtolower('title and heading attibutes from mambot added to Site Title tag')] = '從觸發器增加到網站標題標籤的標題(title)和小標題(heading)屬性';

		$TR_STRS[strtolower('Functionality')] = '功能';
		$TR_STRS[strtolower('Select functionality')] = '選擇功能';
		$TR_STRS[strtolower('Basic')] = '基本';
		$TR_STRS[strtolower('Advanced')] = '高級';
		$TR_STRS[strtolower('Text Direction')] = '文字方向';
		$TR_STRS[strtolower('Ability to change text direction')] = '改變文字方向的能力';
		$TR_STRS[strtolower('Left to Right')] = '從左到右';
		$TR_STRS[strtolower('Right to Left')] = '從右到左';
		$TR_STRS[strtolower('Prohibited Elements')] = '禁止的元素';
		$TR_STRS[strtolower('Elements that will be cleaned from the text')] = '將被從文本中清除的元素';
		$TR_STRS[strtolower('Template CSS classes')] = '模版 CSS 樣式';
		$TR_STRS[strtolower('Load CSS classes from template_css.css')] = '從 template_css.css 讀取 CSS 樣式';
		$TR_STRS[strtolower('Custom CSS Classes')] = '自定義 CSS 樣式';
		$TR_STRS[strtolower('You can specify the loading of a custom CSS file - simply enter the FULL path to the css file you want loaded')] = '可以導入指定的自定義 CSS 文件 - 只須輸入該 CSS 文件完整的路徑';
		$TR_STRS[strtolower('Newlines')] = '新行';
		$TR_STRS[strtolower('Newlines will be made into the selected option')] = '選擇新行的建立方法';
		$TR_STRS[strtolower('BR Elements')] = '用BR分行';
		$TR_STRS[strtolower('P Elements')] = '用P分行';
		$TR_STRS[strtolower('Position of the toolbar')] = '工具條位置';
		$TR_STRS[strtolower('Popup Height')] = '彈出窗口高度';
		$TR_STRS[strtolower('Height of HTML mode pop-up window - only in Advanced Mode')] = 'HTML 模式的彈出窗口高度 - 僅在高級模式中顯示';
		$TR_STRS[strtolower('Popup Width')] = '彈出窗口寬度';
		$TR_STRS[strtolower('Width of HTML mode pop-up window - only in Advanced Mode')] = 'HTML 模式的彈出窗口寬度 - 僅在高級模式中顯示';

		//administrator/components/com_contact/contact.xml
		$TR_STRS[strtolower('Contact')] = '聯繫信息';
		$TR_STRS[strtolower('This component shows a listing of Contact Information')] = '本組件顯示一個聯繫信息列表';
		$TR_STRS[strtolower('Page Title')] = '頁面標題';
		$TR_STRS[strtolower('Show/Hide the pages Title')] = '顯示/隱藏頁面標題';
		$TR_STRS[strtolower('Text to display at the top of the page. If left blank, the Menu name will be used instead')] = '顯示在頁面頂部的文本，如果留空，將使用菜單名稱';
		$TR_STRS[strtolower('Category List - Category')] = '分類列表 - 分類';
		$TR_STRS[strtolower('Show/Hide the List of Categories in Table view page')] = '在以表格風格顯示的頁面中顯示/隱藏分類列表';
		$TR_STRS[strtolower('Category Description')] = '分類描述';
		$TR_STRS[strtolower('Show/Hide the Description for the list of other catgeories')] = '顯示/隱藏其它分類列表的描述';
		$TR_STRS[strtolower('# Category Items')] = '分類條目數';
		$TR_STRS[strtolower('Show/Hide the number of items in each category')] = '顯示/隱藏每個分類的條目數';
		$TR_STRS[strtolower('Show/Hide the Description below')] = '顯示/隱藏下面的描述';
		$TR_STRS[strtolower('Description for page, if left blank it will load _WEBLINKS_DESC from your language file')] = '頁面的描述，如果留空，則讀取語言文件的網站描述';
		$TR_STRS[strtolower('Image for page, must be located in the /images/stories folder. Default will load web_links.jpg, No image will mean an image is not loaded')] = '頁面的圖片，必須放在目錄 /images/stories 中。默認讀取 web_links.jpg，沒有圖片意味著沒有裝載圖片。';
		$TR_STRS[strtolower('Image Align')] = '圖片對齊';
		$TR_STRS[strtolower('Alignment of the image')] = '圖片對齊';
		$TR_STRS[strtolower('Table Headings')] = '表頭';
		$TR_STRS[strtolower('Show/Hide the Table Headings')] = '顯示/隱藏表頭';
		$TR_STRS[strtolower('Position Column')] = '職務欄';
		$TR_STRS[strtolower('Show/Hide the Position column')] = '顯示/隱藏職務欄';
		$TR_STRS[strtolower('Email Column')] = 'Email欄';
		$TR_STRS[strtolower('Show/Hide the Email column')] = '顯示/隱藏Email欄';
		$TR_STRS[strtolower('Telephone Column')] = '電話欄';
		$TR_STRS[strtolower('Show/Hide the Telephone column')] = '顯示/隱藏電話欄';
		$TR_STRS[strtolower('Fax Column')] = '傳真欄';
		$TR_STRS[strtolower('Show/Hide the Fax column')] = '顯示/隱藏傳真欄';

		//administrator/components/com_contact/contact_items.xml
		$TR_STRS[strtolower('Contact Items')] = '聯繫條目';
		$TR_STRS[strtolower('Parameters for individual Contact Items')] = '個人聯繫條目的參數';
		$TR_STRS[strtolower('Menu Image')] = '菜單圖片';
		$TR_STRS[strtolower('A small image to be placed to the left or right of your menu item, images must be in images/stories/')] = '一個小圖片，放在菜單項的左邊或右邊，圖片必須在目錄 images/stories/ 中';
		$TR_STRS[strtolower('Page Class Suffix')] = '頁面css後綴';
		$TR_STRS[strtolower('A suffix to be applied to the css classes of the page, this allows individual page styling')] = '應用到頁面的css類的後綴，這樣允許頁面使用獨自的css風格';
		$TR_STRS[strtolower('Print Icon')] = '打印圖標';
		$TR_STRS[strtolower('Show/Hide the item print button - only affects this page')] = '顯示/隱藏打印圖標 - 只影響該頁面';
		$TR_STRS[strtolower('Back Button')] = '返回按鈕';
		$TR_STRS[strtolower('Show/Hide a Back Button, that returns you to the previously view page')] = '顯示/隱藏返回按鈕，允許返回上一個頁面';
		$TR_STRS[strtolower('Name')] = '姓名';
		$TR_STRS[strtolower('Show/Hide the name info')] = '顯示/隱藏姓名';
		$TR_STRS[strtolower('Position')] = '職務';
		$TR_STRS[strtolower('Show/Hide the position info')] = '顯示/隱藏職務欄';
		$TR_STRS[strtolower('Email')] = 'Email';
		$TR_STRS[strtolower('Show/Hide the email info, if you set to show the address will be protected from spambots by javascript cloaking')] = '顯示/隱藏Email欄';
		$TR_STRS[strtolower('Street Address')] = '地址';
		$TR_STRS[strtolower('Show/Hide the street address info')] = '顯示/隱藏地址信息';
		$TR_STRS[strtolower('Town/Suburb')] = '城市';
		$TR_STRS[strtolower('Show/Hide the suburb info')] = '顯示/隱藏城市信息';
		$TR_STRS[strtolower('State')] = '省份';
		$TR_STRS[strtolower('Show/Hide the state info')] = '顯示/隱藏省份信息';
		$TR_STRS[strtolower('Country')] = '國家';
		$TR_STRS[strtolower('Show/Hide the country info')] = '顯示/隱藏國家信息';
		$TR_STRS[strtolower('Post/Zip Code')] = '郵編';
		$TR_STRS[strtolower('Show/Hide the post code info')] = '顯示/隱藏郵編';
		$TR_STRS[strtolower('Telephone')] = '電話';
		$TR_STRS[strtolower('Show/Hide the telephone info')] = '顯示/隱藏電話信息';
		$TR_STRS[strtolower('Fax')] = '傳真';
		$TR_STRS[strtolower('Show/Hide the fax info')] = '顯示/隱藏傳真信息';
		$TR_STRS[strtolower('Misc Info')] = '備註';
		$TR_STRS[strtolower('Show/Hide the misc info')] = '顯示/隱藏備註信息';
		$TR_STRS[strtolower('Vcard')] = 'Vcard';
		$TR_STRS[strtolower('Show/Hide the Vcard')] = '顯示/隱藏 Vcard';
		$TR_STRS[strtolower('Image')] = '圖片';
		$TR_STRS[strtolower('Show/Hide the image')] = '顯示/隱藏圖片';
		$TR_STRS[strtolower('Email description')] = 'Email描述';
		$TR_STRS[strtolower('Show/Hide the Description Text below')] = '顯示/隱藏 下面的Email描述';
		$TR_STRS[strtolower('Description text')] = '描述文本';
		$TR_STRS[strtolower('The Description text for the Email form, if left blank it will use the _EMAIL_DESCRIPTION language definition')] = 'Email表單的描述文本，如果留空，將使用語言文件的 _EMAIL_DESCRIPTION';
		$TR_STRS[strtolower('Email Form')] = 'Email表單';
		$TR_STRS[strtolower('Show/Hide the email to form')] = '顯示/隱藏Email表單';
		$TR_STRS[strtolower('Email Copy')] = 'Email複製';
		$TR_STRS[strtolower('Show/Hide the checkbox to email a copy to the senders address')] = '顯示/隱藏把email複製到發件人地址的復選框';
		$TR_STRS[strtolower('Drop Down')] = '下拉選擇';
		$TR_STRS[strtolower('Show/Hide the Drop Down select list in Contact view')] = '顯示/隱藏聯繫人的下拉選擇';
		$TR_STRS[strtolower('Icons/text')] = '圖標/文本';
		$TR_STRS[strtolower('Use Icons, text or nothing next to the contact information displayed')] = '使用圖標、文本或者空信息，在聯繫人信息旁邊';
		$TR_STRS[strtolower('Icons')] = '圖標';
		$TR_STRS[strtolower('Address Icon')] = '地址圖標';
		$TR_STRS[strtolower('Icon for the Address info')] = '地址信息的圖標';
		$TR_STRS[strtolower('Email Icon')] = 'Email圖標';
		$TR_STRS[strtolower('Icon for the Email info')] = 'Email信息的圖標';
		$TR_STRS[strtolower('Telephone Icon')] = '電話圖標';
		$TR_STRS[strtolower('Icon for the Telephone info')] = '電話信息的圖標';
		$TR_STRS[strtolower('Fax Icon')] = '傳真圖標';
		$TR_STRS[strtolower('Icon for the Fax info')] = '傳真信息的圖標';
		$TR_STRS[strtolower('Misc Icon')] = '備註圖標';
		$TR_STRS[strtolower('Icon for the Misc info')] = '備註信息的圖標';

		//administrator/components/com_content XML files
		$TR_STRS[strtolower('Content Page')] = '內容頁面';
		$TR_STRS[strtolower('This shows a single content page')] = '顯示一個單獨的內容頁面';
		$TR_STRS[strtolower('Item Title')] = '條目標題';
		$TR_STRS[strtolower('Show/Hide the items title')] = '顯示/隱藏條目標題';
		$TR_STRS[strtolower('Make your Item titles linkable')] = '使條目標題可鏈接';
		$TR_STRS[strtolower('Intro Text')] = '摘要';
		$TR_STRS[strtolower('Show/Hide the intro text')] = '顯示/隱藏摘要';
		$TR_STRS[strtolower('Section Name')] = '單元名稱';
		$TR_STRS[strtolower('Show/Hide the Section the item belongs to')] = '顯示/隱藏條目所屬的單元';
		$TR_STRS[strtolower('Section Name Linkable')] = '單元名稱可鏈接';
		$TR_STRS[strtolower('Make the Section text a link to the actual section page')] = '使單元名稱鏈接到其單元頁面';
		$TR_STRS[strtolower('Category Name')] = '分類名稱';
		$TR_STRS[strtolower('Show/Hide the Category the item belongs to')] = '顯示/隱藏條目所屬的分類';
		$TR_STRS[strtolower('Category Name Linkable')] = '分類名稱可鏈接';
		$TR_STRS[strtolower('Make the Category text a link to the actual Category page')] = '使分類名稱鏈接到其分類頁面';
		$TR_STRS[strtolower('Item Rating')] = '文章評級';
		$TR_STRS[strtolower('Show/Hide the item rating - only affects this page')] = '顯示/隱藏文章評級 - 只影響該頁面';
		$TR_STRS[strtolower('Author Names')] = '作者名稱';
		$TR_STRS[strtolower('Show/Hide the item author - only affects this page')] = '顯示/隱藏作者名稱 - 只影響該頁面';
		$TR_STRS[strtolower('Created Date and Time')] = '創建日期時間';
		$TR_STRS[strtolower('Show/Hide the item creation date - only affects this page')] = '顯示/隱藏創建日期時間 - 只影響該頁面';
		$TR_STRS[strtolower('Modified Date and Time')] = '更改日期時間';
		$TR_STRS[strtolower('Show/Hide the item modification date - only affects this page')] = '顯示/隱藏更改日期時間 - 只影響該頁面';
		$TR_STRS[strtolower('Show/Hide the item pdf button - only affects this page')] = '顯示/隱藏PDF圖標 - 只影響該頁面';
		$TR_STRS[strtolower('Show/Hide the item email button - only affects this page')] = '顯示/隱藏Email圖標 - 只影響該頁面';
		$TR_STRS[strtolower('Key Reference')] = '參考資料';
		$TR_STRS[strtolower('A text key that an item may be referenced by (like a help reference)')] = '文章所涉及或參考的資料';

		//administrator/components/com_frontpage/frontpage.xml
		$TR_STRS[strtolower('Frontpage')] = '首頁';
		$TR_STRS[strtolower('This component shows all the published content items from your site marked Show on Frontpage.')] = '本組件顯示本站點所有標記為顯示在首頁的已發佈內容.';
		$TR_STRS[strtolower('Text to display at the top of the page')] = '顯示在頁面頂部的文本';
		$TR_STRS[strtolower('Show/Hide the Page title')] = '顯示/隱藏頁面標題';
		$TR_STRS[strtolower('# Leading')] = '頭條數';
		$TR_STRS[strtolower('Number of Items to display as a leading (full width) item. 0 will mean that no items will be displayed as leading.')] = '顯示頭條文章(占行全寬)的數量，0 表示沒有使用頭條方式顯示。';
		$TR_STRS[strtolower('# Intro')] = '摘要數';
		$TR_STRS[strtolower('Number of Items to display with the introduction text shown.')] = '顯示文章摘要的數量。';
		$TR_STRS[strtolower('Columns')] = '摘要列數';
		$TR_STRS[strtolower('When displaying the intro text, how many columns to use per row')] = '每行可顯示的摘要數量。';
		$TR_STRS[strtolower('# Links')] = '鏈接條數';
		$TR_STRS[strtolower('Number of Items to display as Links.')] = '顯示文章標題鏈接的數量';
		$TR_STRS[strtolower('Items Order')] = '文章排序';
		$TR_STRS[strtolower('Order that the items will be displayed in.')] = '內容條目的顯示次序。';
		$TR_STRS[strtolower('Pagination')] = '分頁';
		$TR_STRS[strtolower('Show/Hide Pagination support')] = '顯示/隱藏分頁支持';
		$TR_STRS[strtolower('Pagination Results')] = '分頁結果';
		$TR_STRS[strtolower('Show/Hide Pagination Results info ( e.g 1-4 of 4 )')] = '顯示/隱藏分頁結果信息(如：1-4 / 4 )';
		$TR_STRS[strtolower('Item Titles')] = '文章標題';
		$TR_STRS[strtolower('Show/Hide the Read More link')] = '顯示/隱藏閱讀全文鏈接';
		$TR_STRS[strtolower('PDF Icon')] = 'PDF圖標';

		//administrator/components/com_login/login.xml
		$TR_STRS[strtolower('Login Page Title')] = '登錄頁面標題';
		$TR_STRS[strtolower('Login JS Message')] = '登錄後的 JS 信息';
		$TR_STRS[strtolower('Login Description')] = '登錄描述';
		$TR_STRS[strtolower('Show/Hide the Login Description below')] = '顯示/隱藏登錄後的描述信息';
		$TR_STRS[strtolower('Login Description Text')] = '登錄提示文本';
		$TR_STRS[strtolower('Text to display on the login Page, if left blank _LOGIN_DESCRIPTION will be used')] = '設置登錄提示的文本, 如果留空，則直接讀取你設置的語言文件中的 _LOGIN_DESCRIPTION 的設定值';
		$TR_STRS[strtolower('Login Image')] = '登錄圖片';
		$TR_STRS[strtolower('Image for the Login Page')] = '登錄頁面的圖片';
		$TR_STRS[strtolower('Login Image Align')] = '登錄圖片位置';
		$TR_STRS[strtolower('Alignment for Login Image')] = '登錄頁面的圖片位置';
		$TR_STRS[strtolower('Logout Page Title')] = '退出頁面標題';
		$TR_STRS[strtolower('What page will be redirected to after logout, if let blank will load front page')] = '設置退出後自動跳轉的頁面，如果留空，則直接返回到當前頁';
		$TR_STRS[strtolower('Logout JS Message')] = '退出後的 JS 信息';
		$TR_STRS[strtolower('Logout Description')] = '退出描述';
		$TR_STRS[strtolower('Show/Hide the Logout Description below')] = '顯示/隱藏退出後的描述信息';
		$TR_STRS[strtolower('Logout Description Text')] = '退出提示文本';
		$TR_STRS[strtolower('Text to display on the logout Page, if left blank _LOGOUT_DESCRIPTION will be used')] = '設置退出提示的文本, 如果留空，則直接讀取你設置的語言文件中的 _LOGOUT_DESCRIPTION 的設定值';
		$TR_STRS[strtolower('Logout Image')] = '退出圖片';
		$TR_STRS[strtolower('Image for the Logout Page')] = '退出頁面圖片';
		$TR_STRS[strtolower('Logout Image Align')] = '退出圖片位置';
		$TR_STRS[strtolower('Alignment for Logout Image')] = '退出頁面的圖片位置';

		//administrator/components/com_newsfeeds/newsfeeds.xml
		$TR_STRS[strtolower('Newsfeeds')] = '新聞轉播';
		$TR_STRS[strtolower('This component manages RSS/RDF newsfeeds')] = '本組件管理 RSS/RDF 新聞轉播';
		$TR_STRS[strtolower('Name Column')] = '名稱欄';
		$TR_STRS[strtolower('Show/Hide the Feed Name column')] = '顯示/隱藏轉播名稱欄';
		$TR_STRS[strtolower('# Articles Column')] = '文章數欄';
		$TR_STRS[strtolower('Show/Hide the # of articles in the feed')] = '顯示/隱藏轉播中的文章數';
		$TR_STRS[strtolower('Link Column')] = '鏈接欄';
		$TR_STRS[strtolower('Show/Hide the Feed Link column')] = '顯示/隱藏轉播鏈接欄';
		$TR_STRS[strtolower('Show/Hide the image of the feed')] = '顯示/隱藏轉播圖片';
		$TR_STRS[strtolower('Show/Hide the description text of the feed')] = '顯示/隱藏轉播的描述文本';
		$TR_STRS[strtolower('Show/Hide the description or intro text of an item')] = '顯示/隱藏條目的描述或介紹文本';

		//administrator/components/com_syndicate XML files
		$TR_STRS[strtolower('Syndicate')] = 'RSS 聚合';
		$TR_STRS[strtolower('This component controls the Syndication settings')] = '本組件控制 RSS 聚合設置';
		$TR_STRS[strtolower('Cache')] = '緩存';
		$TR_STRS[strtolower('Cache the feed files')] = '緩存轉播文件';
		$TR_STRS[strtolower('Cache Time')] = '緩存時間';
		$TR_STRS[strtolower('Cache file will refresh every x seconds')] = '緩存文件的刷新時間(單位：秒)';
		$TR_STRS[strtolower('# Items')] = '條目數量';
		$TR_STRS[strtolower('Number of Items to syndicate')] = 'RSS 聚合條目數量';
		$TR_STRS[strtolower('Title')] = '標題';
		$TR_STRS[strtolower('Syndication Title')] = 'RSS 聚合標題';
		$TR_STRS[strtolower('Description')] = '描述';
		$TR_STRS[strtolower('Syndication Description')] = 'RSS 聚合描述';
		$TR_STRS[strtolower('Image to be included in feed')] = '包含在轉播中的圖片';
		$TR_STRS[strtolower('Image Alt')] = '圖片替代文本';
		$TR_STRS[strtolower('Alt text for image')] = '圖片替代文本';
		$TR_STRS[strtolower('Limit Text')] = '限制文本';
		$TR_STRS[strtolower('Limit the article text to the value indicated below')] = '根據下面的數值限制文章文本長度';
		$TR_STRS[strtolower('Text Length')] = '文本長度';
		$TR_STRS[strtolower('The word length of the article text - 0 will show no text')] = '文章文本的字符長度 - 0 將不顯示內容';
		$TR_STRS[strtolower('Order')] = '次序';
		$TR_STRS[strtolower('Order that the items will be displayed')] = '條目顯示的次序';
		$TR_STRS[strtolower('Default')] = '默認';
		$TR_STRS[strtolower('Frontpage Ordering')] = '首頁條目次序';
		$TR_STRS[strtolower('Oldest first')] = '日期順序';
		$TR_STRS[strtolower('Most recent first')] = '日期反序';
		$TR_STRS[strtolower('Title Alphabetical')] = '標題字母順序';
		$TR_STRS[strtolower('Title Reverse-Alphabetical')] = '標題字母反序';
		$TR_STRS[strtolower('Author Alphabetical')] = '作者字母順序';
		$TR_STRS[strtolower('Author Reverse-Alphabetical')] = '作者字母反序';
		$TR_STRS[strtolower('Most Hits')] = '點擊最多的在前';
		$TR_STRS[strtolower('Least Hits')] = '點擊最少的在前';
		$TR_STRS[strtolower('Ordering')] = '條目次序';
		$TR_STRS[strtolower('Live Bookmarks')] = '動態書籤(Live Bookmarks)';
		$TR_STRS[strtolower('Activate support for Firefox Live Bookmarks functionality')] = '激活 Firefox 動態書籤(Live Bookmarks)功能的支持';
		$TR_STRS[strtolower('Off')] = '關';
		$TR_STRS[strtolower('RSS 0.91')] = 'RSS 0.91';
		$TR_STRS[strtolower('RSS 1.0')] = 'RSS 1.0';
		$TR_STRS[strtolower('RSS 2.0')] = 'RSS 2.0';
		$TR_STRS[strtolower('ATOM 0.3')] = 'ATOM 0.3';
		$TR_STRS[strtolower('Bookmark file')] = '書籤文件';
		$TR_STRS[strtolower('Special file name, if empty the default will be used.')] = '指定文件名稱,留空則採用默認名稱.';

		//administrator/components/com_weblinks/weblinks.xml
		$TR_STRS[strtolower('Hits')] = '點擊數';
		$TR_STRS[strtolower('Show/Hide the Hits column')] = '顯示/隱藏點擊欄數';
		$TR_STRS[strtolower('Link Descriptions')] = '鏈接描述';
		$TR_STRS[strtolower('Show/Hide the Description text of the Links')] = '顯示/隱藏鏈接描述文本';
		$TR_STRS[strtolower('Icon')] = '圖標';
		$TR_STRS[strtolower('Icon to be used to the left of the url links in Table view')] = '在表格視圖中的網址鏈接左邊顯示的圖標';

		//administrator/components/com_weblinks/weblinks_item.xml
		$TR_STRS[strtolower('This component shows a listing of Weblinks')] = '顯示網站鏈接列表';
		$TR_STRS[strtolower('Target')] = '目標窗口';
		$TR_STRS[strtolower('Target window when the link is clicked')] = '點擊連接後打開頁面的目標窗口';
		$TR_STRS[strtolower('Parent Window With Browser Navigation')] = '帶有瀏覽器導航欄的父窗口';
		$TR_STRS[strtolower('New Window With Browser Navigation')] = '帶有瀏覽器導航欄的新窗口';
		$TR_STRS[strtolower('New Window Without Browser Navigation')] = '不帶瀏覽器導航欄的新窗口';

		//administrator/components/com_menus/contact_category_table/contact_category_table.xml
		$TR_STRS[strtolower('Other Categories')] = '其它分類';
		$TR_STRS[strtolower('When viewing a Category, Show/Hide the list of other Categories')] = '瀏覽一個分類時，顯示/隱藏其它分類列表';
		
		//administrator/components/com_menus/content_blog_category/content_blog_category.xml
		$TR_STRS[strtolower('Show/Hide the Category Description')] = '顯示/隱藏分類的描述';
		$TR_STRS[strtolower('Description Image')] = '描述圖片';
		$TR_STRS[strtolower('Show/Hide image of the Category Description')] = '顯示/隱藏分類描述的圖片';

		//administrator/components/com_menus/content_blog_section/content_blog_section.xml
		$TR_STRS[strtolower('Show/Hide the Section Description')] = '顯示/隱藏單元的描述';
		$TR_STRS[strtolower('Show/Hide image of the Section Description')] = '顯示/隱藏單元描述的圖片';
		$TR_STRS[strtolower('Category List')] = '分類列表';
		$TR_STRS[strtolower('Show/Hide the category list of section')] = '顯示/隱藏單元的分類列表';
		$TR_STRS[strtolower('Category Item Count')] = '分類文章數';
		$TR_STRS[strtolower('Show/Hide the item count of category')] = '顯示/隱藏分類的文章數';
		$TR_STRS[strtolower('Categories per Row')] = '每行分類數';
		$TR_STRS[strtolower('Number of categories to display per row')] = '每行顯示的分類數';

		//administrator/components/com_menus/content_category/content_category.xml
		$TR_STRS[strtolower('Table - Content Category')] = '表格 - 內容分類';
		$TR_STRS[strtolower('Shows a Table view of Content items for a particular Category')] = '為特定分類以表格風格顯示內容項目';
		$TR_STRS[strtolower('Date Format')] = '日期格式';
		$TR_STRS[strtolower('The format of the date displayed, using PHPs strftime Command Format - if left blank it will load the format from your language file')] = '日期顯示的格式，使用PHP的 strftime 命令格式 - 如果留空的話，就使用語言文件中的日期格式';
		$TR_STRS[strtolower('Date Column')] = '日期欄';
		$TR_STRS[strtolower('Show/Hide the Date column')] = '顯示/隱藏日期欄';
		$TR_STRS[strtolower('Author Column')] = '作者欄';
		$TR_STRS[strtolower('Show/Hide the Author column')] = '顯示/隱藏作者欄';
		$TR_STRS[strtolower('Hits Column')] = '點擊欄';
		$TR_STRS[strtolower('Show/Hide the Hits column')] = '顯示/隱藏點擊欄';
		$TR_STRS[strtolower('Navigation Bar')] = '分頁導航條';
		$TR_STRS[strtolower('Show/Hide the Navigation bar')] = '顯示/隱藏分頁導航條';
		$TR_STRS[strtolower('Display Number')] = '顯示數';
		$TR_STRS[strtolower('Number of items to be displayed by default')] = '默認的條目顯示數';
		$TR_STRS[strtolower('Author')] = '作者';

		//administrator/components/com_menus/content_section/content_section.xml
		$TR_STRS[strtolower('Table - Content Section')] = '表格 - 內容單元';
		$TR_STRS[strtolower('Creates a listing of Content categories for a particular section')] = '為特定的單元創建內容分類列表';
		$TR_STRS[strtolower('Item List of Category')] = '分類文章列表';
		$TR_STRS[strtolower('Show/Hide the item list of category')] = '顯示/隱藏分類的文章列表';
		$TR_STRS[strtolower('Item Count')] = '列表文章數';
		$TR_STRS[strtolower('The number of items to display in the item list of category(default is 5)')] = '分類文章列表要顯示的文章數量(默認是5)';
		$TR_STRS[strtolower('Item List of Section')] = '單元文章列表';
		$TR_STRS[strtolower('Show/Hide the item list of section')] = '顯示/隱藏單元的文章列表';

		//administrator/components/com_menus/newsfeed_category_table/newsfeed_category_table.xml
		$TR_STRS[strtolower('A small image to be placed to the left or right of your menu item, images must be in /images')] = '一個小圖片，放在菜單項的左邊或右邊，圖片必須在目錄 /images 中';
		$TR_STRS[strtolower('Articles Column')] = '文章數欄';
		$TR_STRS[strtolower('Show/Hide the Articles column')] = '顯示/隱藏文章數欄';

		//administrator/components/com_menus/wrapper/wrapper.xml
		$TR_STRS[strtolower('Width')] = '寬度';
		$TR_STRS[strtolower('Height')] = '高度';

		//administrator/components/com_menus all XML files' name and description
		$TR_STRS[strtolower('Link - Component Item')] = '鏈接 - 組件條目';
		$TR_STRS[strtolower('Creates a link to an existing Mambo Component')] = '創建一個鏈接到現有的曼波組件';
		$TR_STRS[strtolower('Component')] = '組件';
		$TR_STRS[strtolower('Displays the frontend interface for a Component')] = '為組件顯示前台界面';
		$TR_STRS[strtolower('Table - Contact Category')] = '表格 - 聯繫人分類';
		$TR_STRS[strtolower('Shows a Table view of Contact items for a particular Category')] = '以表格方式顯示一個特定分類的聯繫人條目';
		$TR_STRS[strtolower('Link - Contact Item')] = '鏈接 - 聯繫人條目';
		$TR_STRS[strtolower('Creates a link to a Published Contact Item')] = '創建一個鏈接到一個已發佈的聯繫人條目';
		$TR_STRS[strtolower('Blog - Content Category')] = '博客風格 - 內容分類';
		$TR_STRS[strtolower('Displays a page of content items from multiple categories in a blog format')] = '以博客風格在一個頁面中顯示多個分類的內容條目';
		$TR_STRS[strtolower('Blog - Content Section')] = '博客風格 - 內容單元';
		$TR_STRS[strtolower('Displays a page of content items from multiple sections in a blog format')] = '以博客風格在一個頁面中顯示多個單元的內容條目';
		$TR_STRS[strtolower('Table - Content Category')] = '表格 - 內容分類';
		$TR_STRS[strtolower('Shows a Table view of Content items for a particular Category')] = '以表格風格顯示一個特定分類的內容條目';
		$TR_STRS[strtolower('Link - Content Item')] = '鏈接 - 內容條目';
		$TR_STRS[strtolower('Creates a link to a published Content Item in full view')] = '創建一個鏈接到一個已發佈的內容條目，顯示全文';
		$TR_STRS[strtolower('Table - Content Section')] = '表格 - 內容單元';
		$TR_STRS[strtolower('Creates a listing of Content categories for a particular section')] = '以表格風格顯示一個特定單元的內容條目';
		$TR_STRS[strtolower('Link - Static Content')] = '鏈接 - 靜態內容';
		$TR_STRS[strtolower('Creates a link to Static Content Item')] = '創建一個鏈接到靜態內容條目';
		$TR_STRS[strtolower('Table - Newsfeed Category')] = '表格 - 新聞轉播分類';
		$TR_STRS[strtolower('Shows a Table view of Newsfeed items for a particular Category')] = '以表格風格顯示一個特定分類的新聞轉播條目';
		$TR_STRS[strtolower('Link - Newsfeed')] = '鏈接 - 新聞轉播';
		$TR_STRS[strtolower('Creates a link to an individual Published Newsfeed')] = '創建一個鏈接到一個已發佈的新聞轉播條目';
		$TR_STRS[strtolower('Separator / Placeholder')] = '分隔符 / 佔位符';
		$TR_STRS[strtolower('Creates a menu placeholder or separator')] = '建立一個菜單佔位符或分隔符';
		$TR_STRS[strtolower('Link - Url')] = '鏈接 - 網址';
		$TR_STRS[strtolower('Creates url link')] = '創建網址鏈接';
		$TR_STRS[strtolower('Table - Weblink Category')] = '表格 - 網站鏈接分類';
		$TR_STRS[strtolower('Shows a Table view of Weblink items for a particular Weblink Category')] = '以表格風格顯示一個特定網站鏈接分類的網站鏈接條目';
		$TR_STRS[strtolower('Wrapper')] = '嵌入頁面';
		$TR_STRS[strtolower('Creates an IFrame that will wrap an external page/site into Mambo')] = '創建一個 Iframe，包裝一個外部頁面/網站進入曼波網站';

		$TR_STRS[strtolower('Mamhoo')] = '曼虎';
		$TR_STRS[strtolower('Mamhoo User Manager')] = '曼虎用戶管理';
		$TR_STRS[strtolower('Mamhoo User Extended Config')] = '曼虎用戶擴展設置';
		$TR_STRS[strtolower('Install/Uninstall Mamhooks')] = '安裝/卸載曼虎鉤子';
		$TR_STRS[strtolower('About Mamhoo')] = '關於曼虎';

	}


}

?>