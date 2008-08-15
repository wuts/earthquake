<?php
/**
* @version $Id: admin_simplified_chinese.php,v 1.9 2008/04/21 11:27:52 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2007 Mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software based on Mambo
* Powered By mambochina.net & mambors.org
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( '禁止直接访问本文件！' );

// Language and Encode of admin language
DEFINE('_A_LANGUAGE','zh_CN');
DEFINE('_A_ISO','charset=gb2312');

// needed for $alt text in toolbar item
DEFINE('_A_CANCEL','取消'); 
DEFINE('_A_SAVE','保存'); 
DEFINE('_A_APPLY','应用'); 
DEFINE('_A_CLOSE','关闭'); 
DEFINE('_A_COPY','复制'); 
DEFINE('_A_MOVE','移动'); 
DEFINE('_A_DELETE','删除'); 
DEFINE('_A_NEXT','下一步'); 
DEFINE('_A_BACK','后退'); 
DEFINE('_A_DEFAULT','默认'); 
DEFINE('_A_RESTORE','恢复');

/**
* @location /../includes/mambo.php
* @desc Includes translations of several droplists and non-translated stuff
*/

//Droplist
DEFINE('_A_TOP','顶级');
DEFINE('_A_ALL','全部');
DEFINE('_A_NONE','无');
DEFINE('_A_SELECT_IMAGE','选择图片');
DEFINE('_A_NO_USER','没有用户');
DEFINE('_A_CREATE_CAT','必须先创建一个分类');
DEFINE('_A_PARENT_BROWSER_NAV','父窗口，带浏览器导航');
DEFINE('_A_NEW_BROWSER_NAV','新窗口，带浏览器导航');
DEFINE('_A_NEW_W_BROWSER_NAV','新窗口，不带浏览器导航');

//Alt Hover
DEFINE('_A_PENDING','审理中');
DEFINE('_A_VISIBLE','可视的');
DEFINE('_A_FINISHED','已结束');
DEFINE('_A_MOVE_UP','上移');
DEFINE('_A_MOVE_DOWN','下移');


/**
* @desc Includes the main adminLanguage class which refers to var's for translations
*/
class adminLanguage {

var $RTLsupport = false;

var $A_MAIL = '信箱';

//templates/mambo_admin_blue/login.php
var $A_USERNAME = '用户名';
var $A_PASSWORD = '密码';
var $A_WELCOME_MAMBO = '<p>欢迎使用Mambo！</p><p>请使用有效的用户名和密码来登录管理后台</p>';
var $A_WARNING_JAVASCRIPT = '！警告！ Javascript 功能必须打开，才能进行正常的管理操作。';

//templates/mambo_admin_blue/index.php
var $A_LOGIN = '登录';
var $A_GENERATE_TIME = '页面生成时间：%f 秒';
var $A_LOGOUT = '退出';

//popups/contentwindow.php
var $A_TITLE_CPRE = '内容预览';
var $A_CLOSE = '关闭';
var $A_PRINT = '打印';

//popups/modulewindow.php
var $A_TITLE_MPRE = '模块预览';

//popups/pollwindow.php
var $A_TITLE_PPRE = '在线调查预览';
var $A_VOTE = '投票';
var $A_RESULTS = '结果';

//popups/uploadimage.php
var $A_TITLE_UPLOAD = '上传文件';
var $A_FILE_UPLOAD = '文件上传';
var $A_UPLOAD = '上传';
var $A_FILE_MAX_SIZE = '最大文件大小'; //Ken ADDED

//modules/mod_components.php
var $A_ERROR = '错误！';

//modules/mod_fullmenu.php
var $A_MENU_HOME = '首页';
var $A_MENU_HOME_PAGE = '管理后台首页';
var $A_MENU_CTRL_PANEL = '控制面板'; //KEN ADDED
var $A_MENU_SITE = '网站';
var $A_MENU_SITE_MENU = '网站菜单';
var $A_MENU_SITE_MANAGEMENT = '网站管理'; //KEN ADDED
var $A_MENU_CONFIGURATION = '配置';
var $A_MENU_LANGUAGES = '语言';
var $A_MENU_MANAGE_LANG = '管理语言';
var $A_MENU_LANG_MANAGE = '语言管理';
var $A_MENU_INSTALL = '安装';
var $A_MENU_INSTALL_LANG = '安装语言';
var $A_MENU_MEDIA_MANAGE = '媒体管理';
var $A_MENU_MANAGE_MEDIA = '管理媒体文件';
var $A_MENU_PREVIEW = '预览';
var $A_MENU_NEW_WINDOW = '在新窗口打开';
var $A_MENU_INLINE = '嵌入窗口';
var $A_MENU_INLINE_POS = '嵌入窗口（位置）';
var $A_MENU_STATISTICS = '统计';
var $A_MENU_STATISTICS_SITE = '网站统计';
var $A_MENU_BROWSER = '浏览器、操作系统、域';
var $A_MENU_PAGE_IMP = '页面浏览';
var $A_MENU_SEARCH_TEXT = '搜索文本';
var $A_MENU_TEMP_MANAGE = '模版管理';
var $A_MENU_TEMP_CHANGE = '更换网站模版';
var $A_MENU_INSTALL_TEMPLATES = '安装网站模版';//KEN ADDED
var $A_MENU_SITE_TEMP = '网站模版';
var $A_MENU_ADMIN_TEMP = '管理后台模版';
var $A_MENU_ADMIN_CHANGE_TEMP = '更换管理后台模版';
var $A_MENU_INSTALL_ADMIN_TEMPLATES = '安装后台模版';//KEN ADDED
var $A_MENU_MODUL_POS = '模块位置';
var $A_MENU_TEMP_POS = '模版位置';
var $A_MENU_USER_MANAGE = '用户管理';
var $A_MENU_MANAGE_USER = '管理用户';
var $A_MENU_ADD_EDIT = '新增/编辑用户';
var $A_MENU_MASS_MAIL = '群发邮件';
var $A_MENU_MAIL_USERS = '发送邮件给一个用户或一组用户';
var $A_MENU_MANAGE_STR = '管理网站结构';
var $A_MENU_MANAGEMENT = '菜单管理';//KEN ADDED
var $A_MENU_CONTENT = '内容';
var $A_MENU_CONTENT_MANAGE = '内容管理';
var $A_MENU_CONTENT_MANAGERS = '内容管理';
var $A_MENU_CONTENT_BY_SECTION = '单元内容'; //KEN ADDED
var $A_MENU_MANAGE_CONTENT = '管理内容条目';
var $A_MENU_ITEMS = '条目';
var $A_MENU_ADDNEDIT = '新增/编辑';
var $A_MENU_OTHER_MANAGE = '其它管理';
var $A_MENU_ITEMS_FRONT = '管理首页条目';
var $A_MENU_ITEMS_CONTENT = '管理静态内容条目';
var $A_MENU_CONTENT_SEC = '管理内容单元';
var $A_MENU_CONTENT_CAT = '管理内容分类';
var $A_MENU_CATEGORIES = '分类';
var $A_MENU_COMPONENTS = '组件';
var $A_MENU_COMPONENTS_MANAGEMENT = '组件管理';
var $A_MENU_INST_UNST = '安装/卸载';
var $A_MENU_INST_UNST_COMPONENTS = '安装/卸载组件';
var $A_MENU_MORE_COMP = '更多组件';
var $A_MENU_MORE_COMP2 = '更多组件...';//KEN ADDED
var $A_MENU_MODULES = '模块';
var $A_MENU_INST_UNST_MODULES = '安装/卸载模块';//KEN ADDED
var $A_MENU_MODULES_MANAGEMENT = '模块管理'; //KEN ADDED
var $A_MENU_INSTALL_CUST = '安装定制模块';
var $A_MENU_SITE_MOD = '网站模块';
var $A_MENU_SITE_MOD_MANAGE = '管理网站模块';
var $A_MENU_ADMIN_MOD = '后台模块';
var $A_MENU_ADMIN_MOD_MANAGE = '管理后台模块';
var $A_MENU_MAMBOTS = '触发器';
var $A_MENU_INST_UNST_MAMBOTS = '安装/卸载触发器';//KEN ADDED
var $A_MENU_MAMBOTS_MANAGE = '触发器管理'; //KEN ADDED
var $A_MENU_CUSTOM_MAMBOT = '安装定制触发器';
var $A_MENU_SITE_MAMBOT = '网站触发器';
var $A_MENU_SITE_MAMBOTS = '网站触发器';
var $A_MENU_MAMBOT_MANAGE = '管理网站触发器';
var $A_MENU_INSTALLERS = '安装';//KEN ADDED
var $A_MENU_INSTALLERS_LIST = '安装列表';//KEN ADDED
var $A_MENU_TEMPLATES_SITE = '模版 - 网站';//KEN ADDED
var $A_MENU_TEMPLATES_SITE_INST = '安装网站模版';//KEN ADDED
var $A_MENU_TEMPLATES_ADMIN = '模版 - 后台';//KEN ADDED
var $A_MENU_TEMPLATES_ADMIN_INST = '安装后台模版';//KEN ADDED
var $A_MENU_MESSAGES = '短信';
var $A_MENU_MESSAGES_MANAGEMENT = '消息管理';//KEN ADDED
var $A_MENU_INBOX = '收件箱';
var $A_MENU_PRIV_MSG = '站内短信';
var $A_MENU_GLOBAL_CHECK = '全部放回';
var $A_MENU_CHECK_INOUT = '放回所有取出的条目';
var $A_MENU_SYSTEM_INFO = '系统信息';
var $A_MENU_CLEAN_CACHE = '清空缓存';
var $A_MENU_CLEAN_CACHE_ITEMS = '清空内容条目缓存';
var $A_MENU_BIG_THANKS = '衷心感谢参与者';
var $A_MENU_SUPPORT = '支持';
var $A_MENU_SYSTEM = '系统';
var $A_MENU_SYSTEM_MNG = '系统管理';

//modules/mod_latest.php
var $A_LATEST_ADDED = '最近新增的内容';

//modules/mod_logged.php
var $A_USER_LOGGED = '当前登录用户';
var $A_USER_FORCE_LOGOUT = '强制登出用户';

//modules/mod_online.php
var $A_ONLINE_USERS = '在线用户';

//modules/mod_popular.php
var $A_POPULAR_MOST = '热门条目';
var $A_CREATED = '创建';
var $A_HITS = '点击';

//modules/mod_quickicon.php
var $A_MENU_MANAGER = '菜单管理';
var $A_FRONTPAGE_MANAGER = '首页管理';
var $A_STATIC_MANAGER = '静态内容管理';
var $A_SECTION_MANAGER = '单元管理';
var $A_CATEGORY_MANAGER = '分类管理';
var $A_ALL_MANAGER = '内容条目管理';
var $A_GLOBAL_CONF = '全局配置';
var $A_HELP = '帮助';

//includes/menubar.html.php
var $A_NEW = '新增';
var $A_PUBLISH = '发布';
var $A_DEFAULT = '默认';
var $A_ASSIGN = '分配';
var $A_UNPUBLISH = '取消发布';
var $A_EDIT = '编辑';
var $A_DELETE = '删除';
var $A_SAVE = '保存';
var $A_BACK = '后退';
var $A_CANCEL = '取消';

//Alerts
var $A_ALERT_SELECT_TO = '请从列表中选择条目来';
var $A_ALERT_SELECT_PUB = '请从列表中选择条目来发布';
var $A_ALERT_SELECT_PUB_LIST = '请从列表中选择条目来设为默认';
var $A_ALERT_ITEM_ASSIGN = '请选择条目来分配';
var $A_ALERT_SELECT_UNPUBLISH = '请从列表中选择条目来取消发布';
var $A_ALERT_SELECT_EDIT = '请从列表中选择条目来编辑';
var $A_ALERT_SELECT_DELETE = '请从列表中选择条目来删除';
var $A_ALERT_CONFIRM_DELETE = '确认删除选中的条目？';

//Alerts
var $A_ALERT_ENTER_PASSWORD = '请输入密码'; 
var $A_ALERT_INCORRECT = '无效的用户名、密码或访问级别，请重试';
var $A_ALERT_INCORRECT_TRY = '无效的用户名或密码，请重试';
var $A_ALERT_ALPHA = '文件名只能包含字母或数字，不能有空格。';
var $A_ALERT_IMAGE_UPLOAD = '请选择图片来上传';
var $A_ALERT_IMAGE_EXISTS = "图片 %s 已经存在";
var $A_ALERT_IMAGE_FILENAME = '文件类型必须是 gif, png, jpg, bmp, swf, doc, xls 或 ppt';
var $A_ALERT_UPLOAD_FAILED = "上传 %s 失败";
var $A_ALERT_UPLOAD_SUC = "上传 %s 到 %s 成功";
var $A_ALERT_UPLOAD_SUC2 = "上传 %s 到 %s 成功";

//includes/pageNavigation.php
var $A_OF = '/'; 
var $A_NO_RECORD_FOUND = '没有找到记录';
var $A_FIRST_PAGE = '第一页';
var $A_PREVIOUS_PAGE = '上一页';
var $A_NEXT_PAGE = '下一页';
var $A_END_PAGE = '最后一页';
var $A_PREVIOUS = '上一页';
var $A_NEXT = '下一页';
var $A_END = '最后一页';
var $A_DISPLAY = '显示';
var $A_MOVE_UP = '上移';
var $A_MOVE_DOWN = '下移';

//DIRECTORY COMPONENTS ALL FILES
var $A_COMP_CHECKED_OUT = '取出';
var $A_COMP_TITLE = '标题';
var $A_COMP_IMAGE = '图片';
var $A_COMP_FRONT_PAGE = '首页';
var $A_COMP_IMAGE_POSITION = '图片位置';
var $A_COMP_FILTER = '筛选';
var $A_COMP_ORDERING = '显示次序';
var $A_COMP_ACCESS_LEVEL = '访问级别';
var $A_COMP_PUBLISHED = '发布';
var $A_COMP_PUBLISH = '发布';
var $A_COMP_UNPUBLISHED = '未发布';
var $A_COMP_UNPUBLISH = '取消发布';
var $A_COMP_REORDER = '重新排序';
var $A_COMP_ORDER = '次序';
var $A_COMP_SAVE_ORDER = '保存次序';
var $A_COMP_ACCESS = '访问';
var $A_COMP_SECTION = '单元';
var $A_COMP_NB = '编号';
var $A_COMP_ACTIVE = '活动条目';
var $A_COMP_DESCRIPTION = '描述';
var $A_COMP_SELECT_MENU_TYPE = '请选择菜单类型';
var $A_COMP_ENTER_MENU_NAME = '请输入菜单项名称';
var $A_COMP_CREATE_MENU_LINK = '确认创建链接到菜单？ \n任何对未保存的更改将丢失。';
var $A_COMP_LINK_TO_MENU = '链接到菜单';
var $A_COMP_CREATE_MENU = '将在你选择的菜单上创建新的菜单项';
var $A_COMP_SELECT_MENU = '选择菜单';
var $A_COMP_MENU_TYPE_SELECT = '选择菜单类型';
var $A_COMP_MENU_NAME_ITEM = '菜单项名称';
var $A_COMP_MENU_LINKS = '现有的菜单链接';
var $A_COMP_MENU_LINKS_AVAIL = '保存后菜单链接就可用';
var $A_COMP_NONE = '无';
var $A_COMP_MENU = '菜单';
var $A_COMP_TYPE = '类型';
var $A_COMP_EDIT = '编辑';
var $A_COMP_NEW = '新增';
var $A_COMP_ADD = '新增';
var $A_COMP_ITEM_NAME = '条目名称';
var $A_COMP_STATE = '状态';
var $A_COMP_NAME = '名称';
var $A_COMP_DEFAULT = '默认';
var $A_COMP_CATEG = '分类';
var $A_COMP_LINK_USER = '关联用户';
var $A_COMP_CONTACT = '联系人';
var $A_COMP_EMAIL = 'E-mail';
var $A_COMP_PREVIEW = '预览';
var $A_COMP_ITEMS = '条目';
var $A_COMP_ITEM = '条目';
var $A_COMP_ID = 'ID';
var $A_COMP_EXPIRED = '过期';
var $A_COMP_YES = '是';
var $A_COMP_NO = '否';
var $A_COMP_EDITING = '编辑';
var $A_COMP_ADDING = '新增';
var $A_COMP_HITS = '点击';
var $A_COMP_SOURCE = '源文件';
var $A_COMP_SEL_ITEM = '选择条目来';
var $A_COMP_DATE = '日期';
var $A_COMP_AUTHOR = '作者';
var $A_COMP_ANOTHER_ADMIN = '正在被其他管理员编辑。';
var $A_COMP_SAVE_UNWRT = '保存后设置文件为可写';
var $A_COMP_OVERRIDE_SAVE = '保存时越过写保护';
var $A_COMP_ORDER_SAVED = '新的次序已保存';
var $A_COMP_NO_PARAMETERS = '没有参数';
var $A_COMP_POSITION = '位置';
var $A_COMP_SHOW_ADV_DETAILS = '显示高级明细';
var $A_COMP_HIDE_ADV_DETAILS = '隐藏高级明细';

//components/com_admin/admin.admin.html.php
var $A_COMP_ADMIN_HOME = '首页';
var $A_COMP_ADMIN_SIMP_MODE = '简单模式';
var $A_COMP_ADMIN_SIMP_MODE_SELECTED = '简单模式 (已选)';
var $A_COMP_ADMIN_SIMP_MODE_UNSELECTED = '简单模式 (未选)';
var $A_COMP_ADMIN_ADV_MODE = '高级模式';
var $A_COMP_ADMIN_ADV_MODE_SELECTED = '高级模式 (已选)';
var $A_COMP_ADMIN_ADV_MODE_UNSELECTED = '高级模式 (未选)';
//var $A_COMP_ADMIN_TITLE = '控制面板';
var $A_COMP_ADMIN_INFO = '信息';
var $A_COMP_ADMIN_SYSTEM = '系统信息';
var $A_COMP_ADMIN_PHP_BUILT_ON = 'PHP系统环境：';
var $A_COMP_ADMIN_DB = '数据库版本：';
var $A_COMP_ADMIN_PHP_VERSION = 'PHP版本：';
var $A_COMP_ADMIN_SERVER = 'Web服务器：';
var $A_COMP_ADMIN_SERVER_TO_PHP = 'Web服务器和PHP的接口：';
var $A_COMP_ADMIN_MAMBO_VERSION = 'Mambo 版本：';
var $A_COMP_ADMIN_AGENT = '客户端：';
var $A_COMP_ADMIN_SETTINGS = '相关的PHP设置：';
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
var $A_COMP_ADMIN_WYSIWYG = '可视化编辑器:';
var $A_COMP_ADMIN_CONF_FILE = 'Mambo配置文件：';
var $A_COMP_ADMIN_PHP_INFO2 = 'PHP信息';
var $A_COMP_ADMIN_PHP_INFO = 'PHP信息';
var $A_COMP_ADMIN_PERMISSIONS='权限';
var $A_COMP_ADMIN_DIR_PERM = '目录权限';
var $A_COMP_ADMIN_FOR_ALL = '为完全发挥Mambo的功能和特性，请将下列目录设为可写：';
var $A_COMP_ADMIN_CREDITS = '荣誉';
var $A_COMP_ADMIN_APP = '应用系统';
var $A_COMP_ADMIN_URL = '网址';
var $A_COMP_ADMIN_VERSION = '版本';
var $A_COMP_ADMIN_LICENSE = '许可';
var $A_COMP_ADMIN_CALENDAR = '日历';
var $A_COMP_ADMIN_PUB_DOMAIN = '公众域';
var $A_COMP_ADMIN_ICONS = '图标';
var $A_COMP_ADMIN_INDEX = '索引';
var $A_COMP_ADMIN_SITE_PREVIEW = '网站预览';
var $A_COMP_ADMIN_OPEN_NEW_WIN = '在新窗口打开';

//components/com_admin/admin.admin.php
var $A_COMP_ALERT_NO_LINK = '此条目没有关联的链接';

//components/com_banners/admin.banners.html.php
var $A_COMP_BANNERS_MANAGER = '横幅广告管理';
var $A_COMP_BANNERS_NAME = '横幅广告名称';
var $A_COMP_BANNERS_IMPRESS_MADE = '已浏览数';
var $A_COMP_BANNERS_IMPRESS_LEFT = '剩余浏览数';
var $A_COMP_BANNERS_CLICKS = '点击';
var $A_COMP_BANNERS_CLICKS2 = '点击%';
var $A_COMP_BANNERS_PUBLISHED = '发布';
var $A_COMP_BANNERS_LOCK = '取出';
var $A_COMP_BANNERS_PROVIDE = '请输入横幅广告名称。';
var $A_COMP_BANNERS_SELECT_IMAGE = '请选择图片。';
var $A_COMP_BANNERS_FILL_URL = '请输入横幅广告的网址。';
var $A_COMP_BANNERS_BANNER = '横幅广告';
var $A_COMP_BANNERS_DETAILS = '明细';
var $A_COMP_BANNERS_CLIENT = '客户名称';
var $A_COMP_BANNERS_PURCHASED = '购买的浏览数';
var $A_COMP_BANNERS_UNLIMITED = '无限制';
var $A_COMP_BANNERS_URL = '横幅广告网址';
var $A_COMP_BANNERS_SHOW = '显示横幅广告';
var $A_COMP_BANNERS_CLICK_URL = '目标网址';
var $A_COMP_BANNERS_CUSTOM = '定制横幅广告代码';
var $A_COMP_BANNERS_RESET_CLICKS = '点击数归零';
var $A_COMP_BANNERS_IMAGE = '横幅广告图片';
var $A_COMP_BANNERS_CLIENT_MANAGER = '横幅广告客户管理';
var $A_COMP_BANNERS_NO_ACTIVE = '激活的横幅广告数';
var $A_COMP_BANNERS_FILL_CL_NAME = '请输入客户名称。';
var $A_COMP_BANNERS_FILL_CO_NAME = '请输入联系人。';
var $A_COMP_BANNERS_FILL_CO_EMAIL = '请输入Email。';
var $A_COMP_BANNERS_TITLE_CLIENT = '横幅广告客户';
var $A_COMP_BANNERS_CONTACT_NAME = '联系人';
var $A_COMP_BANNERS_CONTACT_EMAIL = 'Email';
var $A_COMP_BANNERS_EXTRA = '备注';

//components/com_banners/admin.banners.php
var $A_COMP_BANNERS_SELECT_CLIENT = '选择客户';
var $A_COMP_BANNERS_THE_CLIENT = '客户 [ ';
var $A_COMP_BANNERS_EDITED = ' ] 正在被其他管理员编辑。';
var $A_COMP_BANNERS_DEL_CLIENT = '无法删除客户，因为还有正在运作的横幅广告';

//components/com_categories/admin.categories.html.php
var $A_COMP_CATEG_MANAGER = '分类管理 <small><small>[ 内容: 全部 ]</small></small>';
var $A_COMP_CATEG_CATEGS = '分类管理 <small><small>[ %s ]</small></small>';
var $A_COMP_CATEG_NAME = '分类名称';
var $A_COMP_CATEG_ID = '分类代码';
var $A_COMP_CATEG_MUST_NAME = '分类必须有名称';
var $A_COMP_CATEG_DETAILS = '分类明细';
var $A_COMP_CATEG_TITLE = '分类标题';
var $A_COMP_CATEG_TABLE = '分类列表';
var $A_COMP_CATEG_BLOG = '分类Blog风格';
var $A_COMP_CATEG_MESSAGE = '分类';
var $A_COMP_CATEG_MESSAGE2 = '正在被其他管理员编辑。';
var $A_COMP_CATEG_MOVE = '移动分类';
var $A_COMP_CATEG_MOVE_TO_SECTION = '移动到单元';
var $A_COMP_CATEG_BEING_MOVED = '移动的分类';
var $A_COMP_CATEG_CONTENT = '移动的内容条目';
var $A_COMP_CATEG_MOVE_CATEG = '将移动所列的分类';
var $A_COMP_CATEG_ALL_ITEMS = '以及分类中的所有条目（也就是所列的）';
var $A_COMP_CATEG_TO_SECTION = '到指定的单元。';
var $A_COMP_CATEG_COPY = '复制分类';
var $A_COMP_CATEG_COPY_TO_SECTION = '复制到单元';
var $A_COMP_CATEG_BEING_COPIED = '要复制的分类';
var $A_COMP_CATEG_ITEMS_COPIED = '复制的内容条目';
var $A_COMP_CATEG_COPY_CATEGS = '将复制所列的分类';

//components/com_categories/admin.categories.php
var $A_COMP_CATEG_DELETE = '选择要删除的分类';
var $A_COMP_CATEG_CATEG_S = '分类';
var $A_COMP_CATEG_CANNOT_REMOVE = '无法删除，因其有下属记录';
var $A_COMP_CATEG_SELECT = '选择分类来';
var $A_COMP_CATEG_ITEM_MOVE = '选择条目来移动';
var $A_COMP_CATEG_MOVED_TO = '分类移动到';
var $A_COMP_CATEG_COPY_OF = '复制';
var $A_COMP_CATEG_COPIED_TO = '分类复制到';
var $A_COMP_CATEG_SELECT_TYPE = '选择类型';
var $A_COMP_CATEG_CONTACT_CATEG_TABLE = '联系人分类列表';
var $A_COMP_CATEG_NEWSFEED_CATEG_TABLE = '新闻转播分类列表';
var $A_COMP_CATEG_WEBLINK_CATEG_TABLE = '网站链接分类列表';
var $A_COMP_CATEG_CONTENT_CATEG_TABLE = '内容分类列表';
var $A_COMP_CATEG_CONTENT_CATEG_BLOG = '内容分类Blog风格';

//components/com_checkin/admin.checkin.php
var $A_COMP_CHECK_TITLE = '全部放回';
var $A_COMP_CHECK_DB_T = '数据库表格';
var $A_COMP_CHECK_NB_ITEMS = '条目数';
var $A_COMP_CHECK_IN = '放回';
var $A_COMP_CHECK_TABLE = '检查表格';
var $A_COMP_CHECK_DONE = '取出的条目已全部放回';

//components/com_config/admin.config.html.php
var $A_COMP_CONF_GC = '全局配置';
var $A_COMP_CONF_IS = '为';
var $A_COMP_CONF_WRT = '可写';
var $A_COMP_CONF_UNWRT = '不可写';
//var $A_COMP_CONF_SITE_PAGE = 'site-page';
var $A_COMP_CONF_OFFLINE = '网站离线';
var $A_COMP_CONF_OFFMESSAGE = '离线消息';
var $A_COMP_CONF_OFFMESSAGE_TIP = '网站离线时显示的消息';
var $A_COMP_CONF_ERR_MESSAGE = '系统错误消息';
var $A_COMP_CONF_ERR_MESSAGE_TIP = 'Mambo无法连接数据库时显示的消息';
var $A_COMP_CONF_SITE_NAME = '网站名称';
var $A_COMP_CONF_UN_LINKS = '显示未授权的链接';
var $A_COMP_CONF_UN_LINKS_TIP = '将授权给注册用户阅读的内容的链接，显示给未登录用户，但只有用户登录后才能阅读全文。';
var $A_COMP_CONF_USER_REG = '允许用户注册';
var $A_COMP_CONF_USER_REG_TIP = '允许用户自己注册';
var $A_COMP_CONF_AC_ACT = '使用帐户激活';
var $A_COMP_CONF_AC_ACT_TIP = '用户注册后，将收到激活邮件，通过激活链接激活帐户，然后才能登录.';
var $A_COMP_CONF_REQ_EMAIL = '要求唯一的Email';
var $A_COMP_CONF_REQ_EMAIL_TIP = '用户不能使用相同的 email 地址来注册';
var $A_COMP_CONF_REG_SUBMIT = '允许注册用户发表文章';
var $A_COMP_CONF_REG_SUBMIT_TIP = '允许注册用户在前台发表文章';
var $A_COMP_CONF_DEBUG = '调试网站';
var $A_COMP_CONF_DEBUG_TIP = '显示错误诊断信息和SQL错误信息，仅供开发人员调试用';
var $A_COMP_CONF_EDITOR = '可视化编辑器';
var $A_COMP_CONF_LENGTH = '列表条目数';
var $A_COMP_CONF_LENGTH_TIP = '管理后台默认的列表显示条目数';
var $A_COMP_CONF_SITE_ICON = '网站图标';
var $A_COMP_CONF_SITE_ICON_TIP = '如果留空或文件不存在，则使用系统默认的favicon.ico.';
//var $A_COMP_CONF_LOCAL_PG = 'Locale-page';
var $A_COMP_CONF_LOCALE = '本地';
var $A_COMP_CONF_LANG = '前台语言';
var $A_COMP_CONF_ALANG = '后台语言';
var $A_COMP_CONF_TIME_SET = '时差';
var $A_COMP_CONF_DATE = '当前日期/时间';
var $A_COMP_CONF_LOCAL = '国家代码';
//var $A_COMP_CONF_CONT_PAGE = 'content-page';
var $A_COMP_CONF_CONTROL = '* 下列参数控制内容的显示格式 *';
var $A_COMP_CONF_LINK_TITLES = '链接标题';
var $A_COMP_CONF_MORE_LINK = '阅读全文链接';
var $A_COMP_CONF_MORE_LINK_TIP = '当内容条目有正文时，显示阅读全文链接';
var $A_COMP_CONF_RATE_VOTE = '条目评分/投票';
var $A_COMP_CONF_RATE_VOTE_TIP = '允许投票给内容条目';
var $A_COMP_CONF_AUTHOR = '作者名称';
var $A_COMP_CONF_AUTHOR_TIP = '显示作者名称，这是全局设置，但可以在菜单和条目级别进行更改。';
var $A_COMP_CONF_CREATED = '创建日期和时间';
var $A_COMP_CONF_CREATED_TIP = '显示内容条目的创建日期和时间，这是全局设置，但可以在菜单和条目级别进行更改。';
var $A_COMP_CONF_MOD_DATE = '修改日期和时间';
var $A_COMP_CONF_MOD_DATE_TIP = '显示内容条目的修改日期和时间，这是全局设置，但可以在菜单和条目级别进行更改。';
var $A_COMP_CONF_HITS = '点击';
var $A_COMP_CONF_HITS_TIP = '显示内容条目的点击阅读数，这是全局设置，但可以在菜单和条目级别进行更改。';
var $A_COMP_CONF_PDF = 'PDF图标';
var $A_COMP_CONF_OPT_MEDIA = '选项不可用，因为/media 目录不可写';
var $A_COMP_CONF_PRINT_ICON = '打印图标';
var $A_COMP_CONF_EMAIL_ICON = 'Email图标';
var $A_COMP_CONF_ICONS = '图标';
var $A_COMP_CONF_USE_OR_TEXT = '打印、生成PDF和发送Email 的图标或文本';
var $A_COMP_CONF_TBL_CONTENTS = '多页内容条目表格';
var $A_COMP_CONF_BACK_BUTTON = '返回按钮';
var $A_COMP_CONF_CONTENT_NAV = '内容条目导航';
var $A_COMP_CONF_HYPER = '使用超链接标题';
//var $A_COMP_CONF_DB_PAGE = 'db-page';
var $A_COMP_CONF_HOSTNAME = '主机名';
var $A_COMP_CONF_DB_USERNAME = '用户名';
var $A_COMP_CONF_DB_PW = '密码';
var $A_COMP_CONF_DB_NAME = '数据库';
var $A_COMP_CONF_DB_PREFIX = '数据表前缀';
//Svar $A_COMP_CONF_S_PAGE = 'server-page';
var $A_COMP_CONF_ABS_PATH = '绝对路径';
var $A_COMP_CONF_LIVE = '网站地址';
var $A_COMP_CONF_SECRET = '加密文本';
var $A_COMP_CONF_GZIP = '用 GZIP 压缩页面';
var $A_COMP_CONF_CP_BUFFER = '如果系统支持的话，压缩缓冲输出';
var $A_COMP_CONF_SESSION_TIME = 'session会话时间';
var $A_COMP_CONF_SEC = '秒';
var $A_COMP_CONF_AUTO_LOGOUT = '此时间内如果没有活动将自动退出登录';
var $A_COMP_CONF_ERR_REPORT = '错误报告';
var $A_COMP_CONF_REG_GLOBALS_EMU = 'Register Globals 模拟：';
var $A_COMP_CONF_REG_GLOBALS_EMU_DESC = 'Register globals 模拟，如果设置为 Off 的话，有些组件也许会停止工作。';
var $A_COMP_CONF_HELP_SERVER = '帮助服务器';
var $A_COMP_CONF_FILE_CREATION = '文件创建';
var $A_COMP_CONF_FILE_PERM = '文件权限';
var $A_COMP_CONF_FILE_DONT_CHMOD = '不改变新文件的权限 (使用服务器默认值)';
var $A_COMP_CONF_FILE_CHMOD = '改变新文件的权限';
var $A_COMP_CONF_FILE_CHMOD_TIP = '给新创建的文件定义权限标志';
var $A_COMP_CONF_APPLY_FILE = '应用到现有文件';
var $A_COMP_CONF_APPLY_FILE_TIP = '应用权限标志到网站的<em>所有现有文件</em>。<br/><b>不适当的使用将会造成网站失效！</b>';
var $A_COMP_CONF_DIR_CREATION = '目录创建';
var $A_COMP_CONF_DIR_PERM = '目录权限';
var $A_COMP_CONF_DIR_DONT_CHMOD = '不改变新目录的权限 (使用服务器默认值)';
var $A_COMP_CONF_DIR_CHMOD = '改变新目录的权限';
var $A_COMP_CONF_DIR_CHMOD_TIP = '给新创建的目录定义权限标志';
var $A_COMP_CONF_APPLY_DIR = '应用到现有目录';
var $A_COMP_CONF_APPLY_DIR_TIP = '应用权限标志到网站的<em>所有现有目录</em>。<br/><b>不适当的使用将会造成网站失效！</b>';
var $A_COMP_CONF_USER = '所有者';
var $A_COMP_CONF_GROUP = '组';
var $A_COMP_CONF_WORLD = '公共';
var $A_COMP_CONF_READ = '读取';
var $A_COMP_CONF_WRITE = '写入';
var $A_COMP_CONF_EXECUTE = '执行';
var $A_COMP_CONF_SEARCH = '搜索';
//var $A_COMP_CONF_META_PAGE = 'metadata-page';
var $A_COMP_CONF_META_DESC = '网站全局元描述';
var $A_COMP_CONF_META_KEY = '网站全局元关键字';
var $A_COMP_CONF_META_TITLE = '显示标题元标签';
var $A_COMP_CONF_META_ITEMS = '浏览内容条目时显示标题元标签';
var $A_COMP_CONF_META_AUTHOR = '显示作者元标签';
var $A_COMP_CONF_META_AUTHOR_TIP = '浏览内容条目时显示作者元标签';
//var $A_COMP_CONF_MAIL_PAGE = 'mail-page';
var $A_COMP_CONF_MAIL = '邮件发送';
var $A_COMP_CONF_MAIL_FROM = '发件人Email地址';
var $A_COMP_CONF_MAIL_FROM_NAME = '发件人姓名';
var $A_COMP_CONF_MAIL_SENDMAIL_PATH = 'Sendmail路径';
var $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP认证';
var $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP用户';
var $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP密码';
var $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP主机';
//var $A_COMP_CONF_CACHE_PAGE = 'cache-page';
var $A_COMP_CONF_CACHE = '使用缓存';
var $A_COMP_CONF_CACHE_FOLDER = '缓存目录';
var $A_COMP_CONF_CACHE_DIR = '当前缓存目录为';
var $A_COMP_CONF_CACHE_DIR_UNWRT = '缓存目录为不可写，在使用缓存功能之前请设置此目录为CHMOD755';
var $A_COMP_CONF_CACHE_TIME = '缓存时间';
//var $A_COMP_CONF_STATS_PAGE = 'stats-page';
var $A_COMP_CONF_STATS = '统计';
var $A_COMP_CONF_STATS_ENABLE = '允许/禁止收集网站统计信息';
var $A_COMP_CONF_STATS_LOG_HITS = '按日期记录内容点击';
var $A_COMP_CONF_STATS_WARN_DATA = '警告：大量数据将被收集';
var $A_COMP_CONF_STATS_LOG_SEARCH = '记录搜索文本';
//var $A_COMP_CONF_SEO_PAGE = 'seo-page';
var $A_COMP_CONF_SEO_LBL = '搜索引擎优化';
var $A_COMP_CONF_SEO = '搜索引擎优化';
var $A_COMP_CONF_SEO_SEFU = '搜索引擎友好链接';
var $A_COMP_CONF_SEO_APACHE = '只适用于Apache服务器! 激活前先把 htaccess.txt 改名为 .htaccess';
var $A_COMP_CONF_SEO_DYN = '动态页面标题';
var $A_COMP_CONF_SEO_DYN_TITLE = '动态更新页面标题，来更好表现当前的内容';
var $A_COMP_CONF_SERVER = '服务器';
var $A_COMP_CONF_METADATA = '元数据';
var $A_COMP_CONF_EMAIL = '邮件';
var $A_COMP_CONF_CACHE_TAB = '缓存';

//components/com_config/admin.config.php
var $A_COMP_CONF_HIDE = '隐藏';
var $A_COMP_CONF_SHOW = '显示';
var $A_COMP_CONF_DEFAULT = '系统默认';
var $A_COMP_CONF_NONE = '无';
var $A_COMP_CONF_SIMPLE = '简单';
var $A_COMP_CONF_MAX = '最大';
var $A_COMP_CONF_MAIL_FC = 'PHP邮件函数';
var $A_COMP_CONF_SEND = 'Sendmail';
var $A_COMP_CONF_SMTP = 'SMTP服务器';
var $A_COMP_CONF_UPDATED = '配置已被更新！';
var $A_COMP_CONF_ERR_OCC = '发生错误！无法打开配置文件来写入！';

//components/com_contact/admin.contact.html.php
var $A_COMP_CONT_MANAGER = '联系人管理';
var $A_COMP_CONT_FILTER = '筛选';
var $A_COMP_CONT_YOUR_NAME = '必须输入名称。';
var $A_COMP_CONT_CATEG = '请选择分类。';
var $A_COMP_CONT_DETAILS = '联系人明细';
var $A_COMP_CONT_POSITION = '职位';
var $A_COMP_CONT_ADDRESS = '地址';
var $A_COMP_CONT_TOWN = '城市';
var $A_COMP_CONT_STATE = '省份';
var $A_COMP_CONT_COUNTRY = '国家';
var $A_COMP_CONT_POSTAL_CODE = '邮编';
var $A_COMP_CONT_TEL = '电话';
var $A_COMP_CONT_FAX = '传真';
var $A_COMP_CONT_INFO = '备注';
//var $A_COMP_CONT_PUBLISH = 'publish-page';
var $A_COMP_CONT_PUBLISHING = '发布';
var $A_COMP_CONT_SITE_DEFAULT = '网站默认';
//var $A_COMP_CONT_IMG_PAGE = 'images-page';
var $A_COMP_CONT_IMG_INFO = '图片';
var $A_COMP_CONT_PARAMS = '参数';
var $A_COMP_CONT_PARAMETERS = '参数';
var $A_COMP_CONT_PARAM_MESS = '* 下列参数控制联系人的明细显示 *';
var $A_COMP_CONT_PUB_TAB = '发布';
var $A_COMP_CONT_IMG_TAB = '图片';

//components/com_contact/admin.contact.php
var $A_COMP_CONT_SELECT_REC = '选择记录来';

//components/com_content/admin.content.html.php
var $A_COMP_CONTENT_ITEMS_MNG = '内容条目管理';
var $A_COMP_CONTENT_ALL_ITEMS = '内容条目管理';
var $A_COMP_CONTENT_START_ALWAYS = '开始：总是';
var $A_COMP_CONTENT_START = '开始';
var $A_COMP_CONTENT_FIN_NOEXP = '结束：没有过期';
var $A_COMP_CONTENT_FINISH = '结束';
var $A_COMP_CONTENT_PUBLISH_INFO = '发布信息';
var $A_COMP_CONTENT_MANAGER = '管理';
var $A_COMP_CONTENT_ZERO = '确认重置点击数为0？\n任何未保存的更改将丢失。';
var $A_COMP_CONTENT_MUST_TITLE = '内容条目必须输入标题';
var $A_COMP_CONTENT_MUST_NAME = '内容条目必须输入';
var $A_COMP_CONTENT_MUST_SECTION = '必须选择单元。';
var $A_COMP_CONTENT_MUST_CATEG = '必须选择分类。';
var $A_COMP_CONTENT_ITEMS = '内容条目';
var $A_COMP_CONTENT_IN = '内容在';
var $A_COMP_CONTENT_TITLE_ALIAS = '标题别名';
var $A_COMP_CONTENT_ITEM_DETAILS = '条目明细';
var $A_COMP_CONTENT_INTRO = '摘要：(必填)';
var $A_COMP_CONTENT_MAIN = '正文：(可选)';
var $A_COMP_CONTENT_PUB_INFO = '发布';
var $A_COMP_CONTENT_FRONTPAGE = '显示在首页';
var $A_COMP_CONTENT_AUTHOR = '作者别名';
var $A_COMP_CONTENT_CREATOR = '更改创建者';
var $A_COMP_CONTENT_OVERRIDE = '更改创建时间';
var $A_COMP_CONTENT_START_PUB = '开始发布时间';
var $A_COMP_CONTENT_FINISH_PUB = '结束发布时间';
var $A_COMP_CONTENT_ID = '内容条目ID';
var $A_COMP_CONTENT_DRAFT_UNPUB = '未发布的草稿';
var $A_COMP_CONTENT_RESET_HIT = '重置点击数';
var $A_COMP_CONTENT_REVISED = '修改';
var $A_COMP_CONTENT_TIMES = '次数';
var $A_COMP_CONTENT_CREATED = '创建';
var $A_COMP_CONTENT_BY = '由';
var $A_COMP_CONTENT_NEW_DOC = '新文档';
var $A_COMP_CONTENT_LAST_MOD = '最新修改';
var $A_COMP_CONTENT_NOT_MOD = '未修改';
var $A_COMP_CONTENT_MOSIMAGE = 'Mambo图片控制';
var $A_COMP_CONTENT_SUB_FOLDER = '子目录';
var $A_COMP_CONTENT_GALLERY = '图库图片';
var $A_COMP_CONTENT_IMAGES = '内容图片';
var $A_COMP_CONTENT_UP = '向上';
var $A_COMP_CONTENT_DOWN = '向下';
var $A_COMP_CONTENT_REMOVE = '删除';
var $A_COMP_CONTENT_EDIT_IMAGE = '编辑选择的图片';
var $A_COMP_CONTENT_IMG_ALIGN = '图片对齐';
var $A_COMP_CONTENT_ALIGN = '对齐';
var $A_COMP_CONTENT_ALT = '替代文本';
var $A_COMP_CONTENT_BORDER = '边框';
var $A_COMP_CONTENT_IMG_CAPTION = '标题';
var $A_COMP_CONTENT_IMG_CAPTION_POS = '标题位置';
var $A_COMP_CONTENT_IMG_CAPTION_ALIGN = '标题排列';
var $A_COMP_CONTENT_IMG_WIDTH = '图片宽度';
var $A_COMP_CONTENT_APPLY = '应用';
var $A_COMP_CONTENT_PARAM = '参数控制';
var $A_COMP_CONTENT_PARAM_MESS = '* 下列参数只控制条目明细显示 *';
var $A_COMP_CONTENT_META_DATA = '元数据';
var $A_COMP_CONTENT_KEYWORDS = '关键字';
//var $A_COMP_CONTENT_LINK_PAGE = 'link-page';
var $A_COMP_CONTENT_LINK_CI = '这将在选择的菜单中创建一个 \'菜单项 - 内容条目\' 的链接';
var $A_COMP_CONTENT_LINK_NAME = '链接名称';
var $A_COMP_CONTENT_SOMETHING = '请选择';
var $A_COMP_CONTENT_MOVE_ITEMS = '移动条目';
var $A_COMP_CONTENT_MOVE_SECCAT = '移动到单元/分类';
var $A_COMP_CONTENT_ITEMS_MOVED = '移动的条目';
var $A_COMP_CONTENT_SECCAT = '请选择单元/分类';
var $A_COMP_CONTENT_COPY_ITEMS = '复制内容条目';
var $A_COMP_CONTENT_COPY_SECCAT = '复制到单元/分类';
var $A_COMP_CONTENT_ITEMS_COPIED = '复制的条目';
var $A_COMP_CONTENT_PUBLISHING = '发布';
var $A_COMP_CONTENT_IMAGES2 = '图片';
var $A_COMP_CONTENT_META_INFO = '元数据';
var $A_COMP_CONTENT_ADD_ETC = '加入单元/分类/标题';
var $A_COMP_CONTENT_LINK_TO_MENU = '链接到菜单';
var $A_COMP_CONTENT_EDIT_CONTENT = '编辑内容';
var $A_COMP_CONTENT_EDIT_STATIC = '编辑静态内容';
var $A_COMP_CONTENT_EDIT_SECTION = '编辑单元';
var $A_COMP_CONTENT_EDIT_CATEGORY = '编辑分类';
var $A_COMP_CONTENT_EDIT_USER = '编辑用户';
//components/com_content/admin.content.php
var $A_COMP_CONTENT_CACHE = '缓存已清空';
var $A_COMP_CONTENT_MODULE = '模块';
var $A_COMP_CONTENT_ANOTHER = '正在被其他管理员编辑。';
var $A_COMP_CONTENT_PUBLISHED = '条目成功发布';
var $A_COMP_CONTENT_UNPUBLISHED = '条目成功取消发布';
var $A_COMP_CONTENT_SEL_TOG = '选择条目来打开';
var $A_COMP_CONTENT_SEL_DEL = '选择条目来删除';
var $A_COMP_CONTENT_SUCCESS_DEL = '条目成功删除';
var $A_COMP_CONTENT_SEL_MOVE = '选择条目来移动';
var $A_COMP_CONTENT_MOVED = '条目成功移动到单元';
var $A_COMP_CONTENT_ERR_OCCURRED = '发生错误';
var $A_COMP_CONTENT_COPIED = '条目成功复制到单元';
var $A_COMP_CONTENT_RESET_HIT_COUNT = '成功重置点击数';
var $A_COMP_CONTENT_IN_MENU = '(菜单项 - 静态内容) 链接';
var $A_COMP_CONTENT_SUCCESS = '成功创建';
var $A_COMP_CONTENT_SELECT_CAT = '选择分类';
var $A_COMP_CONTENT_SELECT_SEC = '选择单元';

//components/com_content/toolbar.content.html.php
var $A_COMP_CONTENT_BAR_MOVE = '移动';
var $A_COMP_CONTENT_BAR_COPY = '复制';
var $A_COMP_CONTENT_BAR_SAVE = '保存';

//components/com_frontpage/admin.frontpage.html.php
var $A_COMP_FRONT_PAGE_MNG = '首页管理';
//var $A_COMP_FRONT_PAGE_ITEMS = '首页条目';
var $A_COMP_FRONT_ORDER = '排序';

//components/com_frontpage/admin.frontpage.php
var $A_COMP_FRONT_COUNT_NUM = '参数 count 必须是数字';
var $A_COMP_FRONT_INTRO_NUM = '参数 intro 必须是数字';
var $A_COMP_FRONT_WELCOME = '欢迎光临';
var $A_COMP_FRONT_IDONOT = '没有内容';

//components/com_frontpage/toolbar.frontpage.html.php
var $A_COMP_FRONT_REMOVE = '移除';

//components/com_languages/admin.languages.html.php
var $A_COMP_LANG_INSTALL = '语言管理 <small><small>[ 网站 ]</small></small>';
var $A_COMP_LANG_LANG = '语言';
var $A_COMP_LANG_EMAIL = '作者 Email';
var $A_COMP_LANG_EDITOR = '语言编辑器';
var $A_COMP_LANG_FILE = '文件语言';

//components/com_languages/admin.languages.php
var $A_COMP_LANG_UPDATED = '配置成功更新！';
var $A_COMP_LANG_M_SURE = '错误！ 请确认 configuration.php 为可写。';
var $A_COMP_LANG_CANNOT = '不能删除正在使用的语言。';
var $A_COMP_LANG_FAILED_OPEN = '操作失败：无法打开';
var $A_COMP_LANG_FAILED_SPEC = '操作失败：没有指定的语言。';
var $A_COMP_LANG_FAILED_EMPTY = '操作失败：没有内容';
var $A_COMP_LANG_FAILED_UNWRT = '操作失败：文件不可写。';
var $A_COMP_LANG_FAILED_FILE = '操作失败：无法打开文件来写入。';

//components/com_mambots/admin.mambots.html.php
var $A_COMP_MAMB_ADMIN = '管理';
var $A_COMP_MAMB_SITE = '网站';
var $A_COMP_MAMB_MANAGER = '触发器管理';
var $A_COMP_MAMB_NAME = '触发器名称';
var $A_COMP_MAMB_FILE = '文件';
var $A_COMP_MAMB_MUST_NAME = '触发器必须输入名称';
var $A_COMP_MAMB_MUST_FNAME = '触发器必须输入文件名称';
var $A_COMP_MAMB_DETAILS = '触发器明细';
var $A_COMP_MAMB_FOLDER = '目录';
var $A_COMP_MAMB_MFILE = '触发器文件';
var $A_COMP_MAMB_ORDER = '触发器排序';

//components/com_mambots/admin.mambots.php
var $A_COMP_MAMB_EDIT = '正在被其他管理员编辑。';
var $A_COMP_MAMB_DEL = '选择触发器来删除';
var $A_COMP_MAMB_TO = '选择触发器';
var $A_COMP_MAMB_PUB = '发布';
var $A_COMP_MAMB_UNPUB = '取消发布';
var $A_COMP_MAMB_SAVED_CHANGES = '成功保存触发器的变更: '; //KEN ADDED
var $A_COMP_MAMB_SAVED = '成功保存触发器: '; //KEN ADDED
var $A_COMP_MAMB_ORDERING = '新的条目默认排在最后，排列次序可以在条目保存后调整。'; //KEN ADDED
var $A_COMP_MAMB_ORDERING_SAVED = '成功保存触发器: '; //KEN ADDED

//components/com_massmail/admin.massmail.html.php
var $A_COMP_MASS_SUBJECT = '请输入主题';
var $A_COMP_MASS_SELECT_GROUP = '请选择群组';
var $A_COMP_MASS_MESSAGE = '请输入正文';
var $A_COMP_MASS_MAIL = '群发邮件';
var $A_COMP_MASS_GROUP = '群组';
var $A_COMP_MASS_DETAILS = '明细'; //KEN ADDED
var $A_COMP_MASS_CHILD = '发邮件给子群组';
var $A_COMP_MASS_HTML = '使用 HTML 格式发送'; //KEN ADDED
var $A_COMP_MASS_SUB = '主题';
var $A_COMP_MASS_MESS = '正文';

//components/com_massmail/toolbar.massmail.html.php
var $A_COMP_MASS_SEND = '发送';

//components/com_massmail/admin.massmail.php
var $A_COMP_MASS_ALL = '- 所有用户群组 -';
var $A_COMP_MASS_FILL = '请正确填写表单';
var $A_COMP_MASS_SENT = '收件人E-mail';
var $A_COMP_MASS_USERS = '用户';

//components/com_media/admin.media.html.php
var $A_COMP_MEDIA_MG = '媒体管理';
var $A_COMP_MEDIA_DIR = '目录';
var $A_COMP_MEDIA_UP = '向上';
var $A_COMP_MEDIA_UPLOAD = '上传';
var $A_COMP_MEDIA_UPLOAD_MAX = '最大';
var $A_COMP_MEDIA_CODE = '代码';
var $A_COMP_MEDIA_CDIR = '创建目录';
var $A_COMP_MEDIA_PROBLEM = '配置问题';
var $A_COMP_MEDIA_EXIST = '不存在。';
var $A_COMP_MEDIA_DEL = '删除';
var $A_COMP_MEDIA_INSERT = '在此输入文本';
var $A_COMP_MEDIA_DEL_FILE = "删除文件 \"+file+\"?";
var $A_COMP_MEDIA_DEL_ALL = "有 \"+numFiles+\" 个文件/目录在 \"+folder+\"。请先删除 \"+folder+\"中的所有文件/目录  。";
var $A_COMP_MEDIA_DEL_FOLD = "删除目录 \"+folder+\"?";
var $A_COMP_MEDIA_NO_IMG = '没有图片。';

//components/com_media/admin.media.php
var $A_COMP_MEDIA_NO_HACK = '请不要修改';
var $A_COMP_MEDIA_DIR_SAFEMODE = '目录禁止创建，系统环境为SAFE MODE模式，会导致问题。';
var $A_COMP_MEDIA_ALPHA = '目录名称只能包含字母或数字，不能有空格';
var $A_COMP_MEDIA_FAILED = '上传失败。文件已经存在';
var $A_COMP_MEDIA_ONLY = '只有类型为 gif, png, jpg, bmp, pdf, swf, doc, xls 或者 ppt 的文件才能上传';
var $A_COMP_MEDIA_UP_FAILED = '上传失败';
var $A_COMP_MEDIA_UP_COMP = '上传完成';
var $A_COMP_MEDIA_NOT_EMPTY = '<font color="red">无法删除: 非空!</font>';//KEN ADDED
//components/com_media/toolbar.media.html.php
var $A_COMP_MEDIA_CREATE = '创建';

//components/com_menumanager/admin.menumanager.html.php
var $A_COMP_MENU_NAME = '菜单名称';
var $A_COMP_MENU_TYPE = '菜单类型';
var $A_COMP_MENU_TITLE = '模块标题';
var $A_COMP_MENU_ITEMS = '菜单项';//KEN ADDED
var $A_COMP_MENU_PUB = '发布数';//KEN ADDED
var $A_COMP_MENU_UNPUB = '未发布数';//KEN ADDED
var $A_COMP_MENU_MODULES = '模块数';//KEN ADDED
var $A_COMP_MENU_EDIT_NAME = '编辑菜单名称';//KEN ADDED
var $A_COMP_MENU_EDIT_ITEM = '编辑菜单项';//KEN ADDED
var $A_COMP_MENU_ID = '模块代码';
var $A_COMP_MENU_TIPS = '这是Mambo使用的鉴定名称，用在源码中识别此菜单 - 必须为唯一值。建议在菜单名称中不要有任何空白字符';//KEN ADDED
var $A_COMP_MENU_TIPS2 = 'mod_mainmenu 模块的显示标题，必填项';//KEN ADDED
var $A_COMP_MENU_TIPS3 = '* 一个新的 mod_mainmenu 模块，将在你保存此菜单时自动创建，使用你输入的标题为标题。 *<br/><br/>新建模块的参数可通过 "模块管理 [网站]": 模块 -> 网站模块 来编辑';//KEN ADDED
var $A_COMP_MENU_ASSIGN = '没有模块分配到菜单';
var $A_COMP_MENU_ENTER = '请输入菜单名称';
var $A_COMP_MENU_ENTER_TYPE = '请输入菜单类型';
var $A_COMP_MENU_ENTER_TITLE = '请输入菜单的模块名称';
var $A_COMP_MENU_DETAILS = '菜单明细';
var $A_COMP_MENU_MAINMENU = '主菜单模块，保存此菜单时，相同的名称将自动创建/更新。';
var $A_COMP_MENU_DEL = '删除菜单';
var $A_COMP_MENU_MODULE_DEL = '删除的菜单/模块';
var $A_COMP_MENU_ITEMS_DEL = '删除的菜单项';
var $A_COMP_MENU_WILL = '* 将';
var $A_COMP_MENU_WILL2 = '此菜单，<br />及其所有菜单项和关联的模块 *';
var $A_COMP_MENU_YOU_SURE = '确认删除此菜单？\n将删除菜单、菜单项和模块。';
var $A_COMP_MENU_NAME_MENU = '请输入复制菜单的名称';
var $A_COMP_MENU_NAME_MOD = '请输入新模块的名称';
var $A_COMP_MENU_COPY = '复制菜单';
var $A_COMP_MENU_NEW = '新菜单名称';
var $A_COMP_MENU_NEW_MOD = '新模块名称';//KEN ADDED
var $A_COMP_MENU_COPIED = '复制的菜单';
var $A_COMP_MENU_ITEMS_COPIED = '复制的菜单项';
var $A_COMP_MENU_MOD_MENU = '主菜单模块，保存此菜单时，相同的名称将自动创建/更改。';

//components/com_menumanager/admin.menumanager.php
var $A_COMP_MENU_CREATED = '新菜单创建了';
var $A_COMP_MENU_UPDATED = '菜单项和模块已更新';
var $A_COMP_MENU_DETECTED = '菜单删除了';
var $A_COMP_MENU_COPY_OF = '菜单的复制';
var $A_COMP_MENU_CONSIST = '创建了，包括';
var $A_COMP_MENU_RENAME_WARNING = '你不能重命名 mainmenu 菜单，因为这将破坏Mambo的正确操作';
var $A_COMP_MENU_EXISTS_WARNING = '具有此名称的菜单已经存在 - 你必须输入一个唯一的菜单名称';

//components/com_menumanager/toolbar.menumanager.html.php
var $A_COMP_MENU_BAR_DEL = '删除';

//components/com_modules/admin.modules.html.php
var $A_COMP_MOD_MANAGER = '模块管理';
var $A_COMP_MOD_NAME = '模块名称';
var $A_COMP_MOD_POSITION = '位置';
var $A_COMP_MOD_PAGES = '所在页面';
var $A_COMP_MOD_VARIES = '个别';
var $A_COMP_MOD_ALL = '全部';
var $A_COMP_MOD_USER = '用户';
var $A_COMP_MOD_MUST_TITLE = '模块必须有标题';
var $A_COMP_MOD_MODULE = '模块';
var $A_COMP_MOD_DETAILS = '模块明细';
var $A_COMP_MOD_SHOW_TITLE = '显示标题';
var $A_COMP_MOD_ORDER = '模块排序';
var $A_COMP_MOD_CONTENT = '内容';
var $A_COMP_MOD_PAGES_ITEMS = '菜单 / 菜单项';
var $A_COMP_MOD_CUSTOM_OUTPUT = '定制输出';
var $A_COMP_MOD_MOD_POSITION = '模块位置';
var $A_COMP_MOD_ITEM_LINK = '菜单项链接';
var $A_COMP_MOD_TAB_LBL = '版面';

//components/com_modules/admin.modules.php
var $A_COMP_MOD_MODULES = '模块';
var $A_COMP_MOD_MOD_COPIED = '模块已复制';//KEN ADDED
var $A_COMP_MOD_SAVED_CHANGES = '成功保存模块的更改: ';//KEN ADDED
var $A_COMP_MOD_SAVED_MOD = '成功保存模块: ';//KEN ADDED
var $A_COMP_MOD_CANNOT = '不能删除，只能卸载，因为是Mambo核心模块。';
var $A_COMP_MOD_SELECT_TO = '选择模块来';

//components/com_modules/toolbar.modules.html.php
var $A_COMP_MOD_PREVIEW = '预览';
var $A_COMP_MOD_PREVIEW_TIP = '只能预览自定义模块。';

//components/com_newsfeeds/admin.newsfeeds.html.php
var $A_COMP_FEED_TITLE = '新闻转播管理';
var $A_COMP_FEED_NEWS = '新闻转播';
var $A_COMP_FEED_ARTICLES = '文章';
var $A_COMP_FEED_CACHE = '缓存时间(秒)';
var $A_COMP_FEED_EDIT_FEED = '编辑新闻转播';//KEN ADDED
var $A_COMP_FEED_FILL_NAME = '请输入新闻转播名称。';
var $A_COMP_FEED_SEL_CATEG = '请选择分类。';
var $A_COMP_FEED_FILL_LINK = '请输入新闻转播链接。';
var $A_COMP_FEED_FILL_NB = '请输入文章显示数量。';
var $A_COMP_FEED_FILL_REFRESH = '请输入缓存更新时间。';
var $A_COMP_FEED_LINK = '链接';
var $A_COMP_FEED_NB_ARTICLE = '文章数';
var $A_COMP_FEED_IN_SEC = '缓存时间(秒)';

//components/com_poll/admin.poll.html.php
var $A_COMP_POLL_MANAGER = '在线调查管理';
var $A_COMP_POLL_TITLE = '在线调查标题';
var $A_COMP_POLL_OPTIONS = '选项';
var $A_COMP_POLL_MUST_TITLE = '在线调查必须有标题';
var $A_COMP_POLL_NON_ZERO = '两次投票之间必须有时间间隔';
var $A_COMP_POLL_POLL = '在线调查';
var $A_COMP_POLL_SHOW = '在菜单项显示';
var $A_COMP_POLL_LAG = '间隔';
var $A_COMP_POLL_EDIT = '编辑在线调查';//KEN ADDED
var $A_COMP_POLL_BETWEEN = '(两次投票之间的时间间隔：秒)';

//components/com_poll/admin.poll.php
var $A_COMP_POLL_THE = '在线调查';
var $A_COMP_POLL_BEING = '正在被其他管理员编辑。';

//components/com_poll/poll.class.php
var $A_COMP_POLL_TRY_AGAIN = '模块名称已存在，请重试。';

//components/com_sections/admin.sections.html.php
var $A_COMP_SECT_MANAGER = '单元管理';
var $A_COMP_SECT_NAME = '单元名称';
var $A_COMP_SECT_ID = '单元代码';
var $A_COMP_SECT_NB_CATEG = '分类';
var $A_COMP_SECT_NEW = '新单元';
var $A_COMP_SECT_SEL_MENU = '请选择菜单';
var $A_COMP_SECT_MUST_NAME = '单元必须有名称';
var $A_COMP_SECT_MUST_TITLE = '单元必须有标题';
var $A_COMP_SECT_DETAILS = '单元明细';
var $A_COMP_SECT_SCOPE = '范围';
var $A_COMP_SECT_SHORT_NAME = '在菜单显示的简称';
var $A_COMP_SECT_LONG_NAME = '在标题显示的全称';
var $A_COMP_SECT_COPY = '复制单元';
var $A_COMP_SECT_COPY_TO = '复制到单元';
var $A_COMP_SECT_NEW_NAME = '新单元名称';
var $A_COMP_SECT_WILL_COPY = '将复制所列分类<br />以及分类中的所有条目（也就是所列的）<br />到新单元。';
var $A_COMP_SECT_MENU_LINK = '保存后菜单链接就可用';//KEN ADDED

//components/com_sections/admin.sections.php
var $A_COMP_SECT_THE = '单元';
var $A_COMP_SECT_LIST = '单元列表';
var $A_COMP_SECT_BLOG = '单元Blog风格';
var $A_COMP_SECT_DELETE = '选择单元来删除';
var $A_COMP_SECT_SEC = '单元';
var $A_COMP_SECT_CANNOT = '不能删除，因其中还有分类';
var $A_COMP_SECT_SUCCESS_DEL = '成功删除';
var $A_COMP_SECT_TO = '选择单元来';
var $A_COMP_SECT_CANNOT_PUB = '不能发布空单元';
var $A_COMP_SECT_AND_ALL = '及其所有分类和条目已复制';
var $A_COMP_SECT_IN_MENU = '在菜单';
var $A_COMP_SECT_CHANGES_SAVED = '单元的更改已保存';//KEN ADDED
var $A_COMP_SECT_SECTION_SAVED = '单元已保存';//KEN ADDED

//components/com_statistics/admin.statistics.html.php
var $A_COMP_STAT_OS = '浏览器、操作系统、域统计';
var $A_COMP_STAT_BR_PAGE = '浏览器统计';
var $A_COMP_STAT_BROWSER = '浏览器';
var $A_COMP_STAT_OS_PAGE = '操作系统统计';
var $A_COMP_STAT_OP_SYST = '操作系统';
var $A_COMP_STAT_URL_PAGE = '域统计';
var $A_COMP_STAT_URL = '域';
var $A_COMP_STAT_IMPR = '页面浏览统计';
var $A_COMP_STAT_PG_IMPR = '页面浏览';
var $A_COMP_STAT_SCH_ENG = '搜索文本统计';
var $A_COMP_STAT_LOG_IS = '记录';
var $A_COMP_STAT_ENABLED = '启用';
var $A_COMP_STAT_DISABLED = '禁用';
var $A_COMP_STAT_SCH_TEXT = '搜索文本';
var $A_COMP_STAT_T_REQ = '搜索次数';
var $A_COMP_STAT_R_RETURN = '返回结果';

//components/com_syndicate/admin.syndicate.html.php
var $A_COMP_SYND_SET = 'RSS 聚合设置';

//components/com_syndicate/admin.syndicate.php
var $A_COMP_SYND_SAVED = '设置成功保存';

//components/com_templates/admin.templates.html.php
var $A_COMP_TEMP_NO_PREVIEW = '没有可用的预览';
var $A_COMP_TEMP_INSTALL = '安装';
var $A_COMP_TEMP_TP = '模版';
var $A_COMP_TEMP_PREVIEW = '预览模版';
var $A_COMP_TEMP_ASSIGN = '分配';
var $A_COMP_TEMP_AUTHOR_URL = '作者网址';
var $A_COMP_TEMP_EDITOR = '模版编辑者';
var $A_COMP_TEMP_PATH = '路径：templates';
var $A_COMP_TEMP_WRT = ' - 可写';
var $A_COMP_TEMP_UNWRT = ' - 不可写';
var $A_COMP_TEMP_ST_EDITOR = '模版 CSS 编辑器';
var $A_COMP_TEMP_NAME = '路径';
var $A_COMP_TEMP_ASSIGN_TP = '分配模版';
var $A_COMP_TEMP_TO_MENU = '到菜单项';
var $A_COMP_TEMP_PAGES = '页面';
var $A_COMP_TEMP_ = '位置';

//components/com_templates/admin.templates.php
var $A_COMP_TEMP_CANNOT = '无法删除正在使用的模版。';
var $A_COMP_TEMP_NOT_OPEN = '操作失败：无法打开';
var $A_COMP_TEMP_FLD_SPEC = '操作失败：没有指定的模版。';
var $A_COMP_TEMP_FLD_EMPTY = '操作失败：空内容';
var $A_COMP_TEMP_FLD_WRT = '操作失败：无法打开文件来写入。';
var $A_COMP_TEMP_FLD_NOT = '操作失败：文件不可写。';
var $A_COMP_TEMP_SAVED = '位置保存了';

//components/com_typedcontent/admin.typedcontent.html.php
var $A_COMP_TYPED_STATIC = '静态内容管理';
var $A_COMP_TYPED_LINKS = '链接';
var $A_COMP_TYPED_ARE_YOU = '确认创建菜单链接到静态内容条目？ \n任何未保存的更改将丢失。';
var $A_COMP_TYPED_CONTENT = '静态内容';
var $A_COMP_TYPED_TEXT = '正文：(必填)';
var $A_COMP_TYPED_EXPIRES = '过期';
var $A_COMP_TYPED_WILL = '将在选中的菜单创建 \'菜单项 - 静态内容\' 的链接';
var $A_COMP_TYPED_ITEM = '静态内容条目';

//components/com_typedcontent/admin.typedcontent.php
var $A_COMP_TYPED_SAVED = '静态内容条目已保存';
var $A_COMP_TYPED_CHG_SAVED = '静态内容条目的修改已保存';

//components/com_users/admin.users.html.php
var $A_COMP_USERS_ID = '用户代码';
var $A_COMP_USERS_LOG_IN = '登录';
var $A_COMP_USERS_LAST = '最近访问';
var $A_COMP_USERS_BLOCKED = '封锁';
var $A_COMP_USERS_YOU_MUST = '必须输入用户名。';
var $A_COMP_USERS_YOU_LOGIN = '用户名包含无效字符，或长度不够。';
var $A_COMP_USERS_MUST_EMAIL = '必须输入Email地址。';
var $A_COMP_USERS_ASSIGN = '必须分配用户到一个群组。';
var $A_COMP_USERS_NO_MATCH = '密码不匹配';
var $A_COMP_USERS_NO_FRONTEND = '请选择另一个组，因为`Public Frontend`不是一个可选择的选项';
var $A_COMP_USERS_NO_BACKEND = '请选择另一个组，因为`Public Backend`不是一个可选择的选项';
var $A_COMP_USERS_DETAILS = '用户明细';
var $A_COMP_USERS_EMAIL = 'Email';
var $A_COMP_USERS_PASS = '密码';
var $A_COMP_USERS_VERIFY = '密码确认';
var $A_COMP_USERS_BLOCK = '封锁用户';
var $A_COMP_USERS_SUBMI = '接收通知邮件';
var $A_COMP_USERS_REG_DATE = '注册日期';
var $A_COMP_USERS_VISIT_DATE = '最近访问日期';
var $A_COMP_USERS_CONTACT = '联系人信息';
var $A_COMP_USERS_NO_DETAIL = '没有此用户关联的联系人信息：<br />请到 \'组件 -> 联系人 -> 联系人管理\' 查阅详细信息。';
var $A_COMP_USERS_CHANGE_CONTACT = '更改联系人信息';
var $A_COMP_USERS_CONTACT_INFO = '组件 -> 联系人 -> 联系人管理';

//components/com_users/admin.users.php
var $A_COMP_USERS_SUPER_ADMIN = 'Super Administrator';
var $A_COMP_USERS_CANNOT = '不能删除超级管理员';
var $A_COMP_USERS_NOT_DEL_SELF = '你不能删除你自己！';
var $A_COMP_USERS_NOT_DEL_ADMIN = '你不能删除其他 `Administrator`，只有 `Super Administrators` 才有这个权限';

//components/com_users/toolbar.users.html.php
var $A_COMP_USERS_LOGOUT = '强制退出';

//components/com_weblinks/admin.weblinks.html.php
var $A_COMP_WEBL_MANAGER = '网站链接管理';
var $A_COMP_WEBL_APPROVED = '批准';
var $A_COMP_WEBL_MUST_TITLE = '网站链接条目必须输入标题';
var $A_COMP_WEBL_MUST_CATEG = '请选择分类.';
var $A_COMP_WEBL_MUST_URL = '必须输入网址';
var $A_COMP_WEBL_WL = '网站链接';

//components/com_installer/admin.installer.php
var $A_INSTALL_NOT_FOUND = "元件的安装文件未找到";
var $A_INSTALL_NOT_AVAIL = "元件的安装文件不可用";
var $A_INSTALL_ENABLE_MSG = "文件上传功能未启用，安装无法继续。请使用“从目录安装”的方法来安装。";
var $A_INSTALL_ERROR_MSG_TITLE = '安装 - 错误';
var $A_INSTALL_ZLIB_MSG = "zlib未安装，，安装无法继续。";
var $A_INSTALL_NOFILE_MSG = '尚未选择文件';
var $A_INSTALL_NEWMODULE_ERROR_MSG_TITLE = '上传新模块 - 错误';
var $A_INSTALL_UPLOAD_PRE = '上传 ';
var $A_INSTALL_UPLOAD_POST = ' - 上传失败';
var $A_INSTALL_UPLOAD_POST2 = ' -  上传错误';
var $A_INSTALL_SUCCESS = '成功';
var $A_INSTALL_ERROR = '错误';
var $A_INSTALL_FAILED = '失败';
var $A_INSTALL_SELECT_DIR = '请选择目录';
var $A_INSTALL_UPLOAD_NEW = '上传新';
var $A_INSTALL_FAIL_PERMISSION = '无法改变上传文件的权限。';
var $A_INSTALL_FAIL_MOVE = '无法移动上传文件到<code>/media</code>目录。';
var $A_INSTALL_FAIL_WRITE = '上传失败 - <code>/media</code> 目录不可写。';
var $A_INSTALL_FAIL_EXIST = '上传失败 - <code>/media</code> 目录不存在。';

//components/com_installer/admin.installer.html.php
var $A_INSTALL_WRITABLE = '可写';
var $A_INSTALL_UNWRITABLE = '不可写';
var $A_INSTALL_CONTINUE = '继续 ...';
var $A_INSTALL_UPLOAD_PACK_FILE = '上传安装包';
var $A_INSTALL_PACK_FILE = '安装包：';
var $A_INSTALL_UPL_INSTALL = "上传文件 &amp; 安装";
var $A_INSTALL_FROM_DIR = '从目录安装';
var $A_INSTALL_DIR = '安装目录：';
var $A_INSTALL_DO_INSTALL = '安装';

//components/com_installer/component/component.html.php
var $A_INSTALL_COMP_INSTALLED = '已安装组件';
var $A_INSTALL_COMP_CURRENT = '当前已安装';
var $A_INSTALL_COMP_MENU = '组件菜单链接';
var $A_INSTALL_COMP_AUTHOR = '作者';
var $A_INSTALL_COMP_VERSION = '版本';
var $A_INSTALL_COMP_DATE = '日期';
var $A_INSTALL_COMP_AUTH_MAIL = '作者Email';
var $A_INSTALL_COMP_AUTH_URL = '作者网址';
var $A_INSTALL_COMP_NONE = '尚未安装第三方组件';

//components/com_installer/component/component.php
var $A_INSTALL_COMP_UPL_NEW = '上传新组件';

//components/com_installer/language/language.php
var $A_INSTALL_LANG = '上传新语言';
var $A_INSTALL_BACK_LANG_MGR = '返回语言管理';

//components/com_installer/language/language.class.php
var $A_INSTALL_LANG_NOREMOVE = '语言代码为空，无法删除文件。';
var $A_INSTALL_LANG_UN_ERR = '卸载 - 错误';
var $A_INSTALL_LANG_DELETING = '删除';

//components/com_installer/mambot/mambot.html.php
var $A_INSTALL_MAMB_MAMBOTS = '触发器';
var $A_INSTALL_MAMB_CORE = '只显示那些可以卸载的触发器 - 一些核心触发器不能删除。';
var $A_INSTALL_MAMB_MAMBOT = '触发器';
var $A_INSTALL_MAMB_TYPE = '类型';
var $A_INSTALL_MAMB_AUTHOR = '作者';
var $A_INSTALL_MAMB_VERSION = '版本';
var $A_INSTALL_MAMB_DATE = '日期';
var $A_INSTALL_MAMB_AUTH_MAIL = '作者Email';
var $A_INSTALL_MAMB_AUTH_URL = '作者网址';
var $A_INSTALL_MOD_NO_MAMBOTS = '尚未有非核心、第三方触发器安装。';

//components/com_installer/mambot/mambot.php
var $A_INSTALL_MAMB_INSTALL_MAMBOT = '安装触发器';

//components/com_installer/module/module.html.php
var $A_INSTALL_MOD_MODS = '模块';
var $A_INSTALL_MOD_FILTER = '筛选：';
var $A_INSTALL_MOD_CORE = '只显示那些可以卸载的模块 - 一些核心模块不能删除。';
var $A_INSTALL_MOD_MOD = '模块文件';
var $A_INSTALL_MOD_CLIENT = '客户';
var $A_INSTALL_MOD_AUTHOR = '作者';
var $A_INSTALL_MOD_VERSION = '版本';
var $A_INSTALL_MOD_DATE = '日期';
var $A_INSTALL_MOD_AUTH_MAIL = '作者Email';
var $A_INSTALL_MOD_AUTH_URL = '作者网址';
var $A_INSTALL_MOD_NO_CUSTOM = '尚未有第三方模块安装。';

//components/com_installer/module/module.php
var $A_INSTALL_MOD_INSTALL_MOD = '安装模块';
var $A_INSTALL_MOD_ADMIN_MOD = '管理模块';

//components/com_install/template/template.php
var $A_INSTALL_TEMPL_INSTALL = '安装新模版';
var $A_INSTALL_TEMPL_SITE_TEMPL = '网站模版';
var $A_INSTALL_TEMPL_ADMIN_TEMPL = '后台模版';
var $A_INSTALL_TEMPL_BACKTTO_TEMPL = '返回模版管理';

//components/com_menus/admin.menus.html.php
var $A_COMP_MENUS_MAX_LVLS = '最大级数';
var $A_COMP_MENUS_MENU_ITEM = '菜单项';
var $A_COMP_MENUS_MENU_ORDER = '次序';//KEN ADDED
var $A_COMP_MENUS_MENU_SAVE_ORDER = '保存次序';//KEN ADDED
var $A_COMP_MENUS_MENU_ITEMID = '条目ID';//KEN ADDED
var $A_COMP_MENUS_MENU_CID = '组件ID';//KEN ADDED
var $A_COMP_MENUS_MENU_CONTENT = '内容';//KEN ADDED
var $A_COMP_MENUS_MENU_MISC = '杂项';//KEN ADDED
var $A_COMP_MENUS_MENU_NOTE = '* 注：有些菜单类型出现在多个组中，但它们仍是相同的菜单类型。';//KEN ADDED
var $A_COMP_MENUS_MENU_COM = '组件';//KEN ADDED
var $A_COMP_MENUS_MENU_LINKS = '链接';//KEN ADDED
var $A_COMP_MENUS_MENU_ITEM_TYPE = '菜单项类型';//KEN ADDED
var $A_COMP_MENUS_MENU_HELP = '帮助';//KEN ADDED
var $A_COMP_MENUS_MENU_BLOGVIEW = '什么是 "Blog" 视图';//KEN ADDED
var $A_COMP_MENUS_MENU_TABLEVIEW = '什么是 "表格" 视图';//KEN ADDED
var $A_COMP_MENUS_MENU_LISTVIEW = '什么是 "列表" 视图';//KEN ADDED
var $A_COMP_MENUS_ADD_ITEM = '新增菜单项';
var $A_COMP_MENUS_SELECT_ADD = '选择组件来新增';
var $A_COMP_MENUS_MOVE_ITEMS = '移动菜单项';
var $A_COMP_MENUS_MOVE_MENU = '移动到菜单';
var $A_COMP_MENUS_BEING_MOVED = '移动的菜单项';
var $A_COMP_MENUS_COPY_ITEMS = '复制菜单项';
var $A_COMP_MENUS_NEXT = '下一步';
var $A_COMP_MENUS_COPY_MENU = '复制到菜单';
var $A_COMP_MENUS_BEING_COPIED = '复制的菜单项';
var $A_COMP_MENUS_SELECT_TO = '请选择菜单项来';
var $A_COMP_MENUS_SEFPATH = 'SEF路径';
var $A_COMP_MENUS_SEFPATH_TIP = '设置搜索引擎友好链接的路径';

//components/com_menus/admin.menus.php
var $A_COMP_MENUS_ITEM_SAVED = '菜单项已保存';//KEN ADDED
var $A_COMP_MENUS_MOVED_TO = ' 菜单项移动到';
var $A_COMP_MENUS_COPIED_TO = ' 菜单项复制到';
var $A_COMP_MENUS_WRAPPER = '嵌入页面';
var $A_COMP_MENUS_SEPERATOR = '分隔符/占位符';
var $A_COMP_MENUS_LINK = '链接 - ';
var $A_COMP_MENUS_STATIC = '静态内容';
var $A_COMP_MENUS_URL = '网址';
var $A_COMP_MENUS_CONTENT_ITEM = '内容条目';
var $A_COMP_MENUS_COMP_ITEM = '组件条目';
var $A_COMP_MENUS_CONT_ITEM = '联系人条目';
var $A_COMP_MENUS_NEWSFEED = '新闻转播';
var $A_COMP_MENUS_COMP = '组件';
var $A_COMP_MENUS_LIST = '列表';
var $A_COMP_MENUS_TABLE = '表格';
var $A_COMP_MENUS_BLOG = 'Blog风格';
var $A_COMP_MENUS_CONT_SEC = '内容单元';
var $A_COMP_MENUS_CONT_CAT = '内容分类';
var $A_COMP_MENUS_CONTACT_CAT = '联系人分类';
var $A_COMP_MENUS_WEBLINK_CAT = '网站链接分类';
var $A_COMP_MENUS_NEWS_CAT = '新闻转播分类';
var $A_COMP_MENUS_NEW_ORDER_SAVED = '新的次序已保存';//KEN ADDED
var $A_COMP_MENUS_EDIT_NEWSFEED_TIP = '编辑此新闻转播';
var $A_COMP_MENUS_EDIT_CONTACT_TIP = '编辑此联系人';
var $A_COMP_MENUS_EDIT_CONTENT_TIP = '编辑此内容';
var $A_COMP_MENUS_EDIT_STATIC_TIP = '编辑此静态内容';

//components/com_menus/component_item_link/component_item_link.menu.html.php
var $A_COMP_MENUS_CIL_LINK_NAME = '链接必须输入名称';
var $A_COMP_MENUS_CIL_SELECT_COMP = '必须选择组件来链接';
var $A_COMP_MENUS_CIL_LINK_COMP = '组件';
var $A_COMP_MENUS_CIL_ON_CLICK = '点击打开方式';
var $A_COMP_MENUS_CIL_PARENT = '父菜单项';
var $A_DETAILS = '明细';

//components/com_menus/components/components.menu.html.php
var $A_COMP_MENUS_CMP_ITEM_NAME = '必须输入名称';
var $A_COMP_MENUS_CMP_SELECT_CMP = '请选择组件';
var $A_COMP_MENUS_PARAMETERS_AVAILABLE = '一旦保存此新的菜单项，下列参数就可用了';
var $A_COMP_MENUS_CMP_ITEM_COMP = '菜单项 :: 组件';

//components/com_menus/contact_category_table/contact_category_table.menu.html.php
var $A_COMP_MENUS_CMP_CCT_CATEG = '必须选择分类';
var $A_COMP_MENUS_CMP_CCT_TITLE = '菜单项必须有名称';
var $A_COMP_MENUS_CMP_CCT_BLANK = '如果留空，将自动使用分类名称。';
var $A_COMP_MENUS_CMP_CCT_THETITLE = '标题：';
var $A_COMP_MENUS_CMP_CCT_THECAT = '分类：';

//components/com_menus/contact_item_link/contact_item_link.menu.html.php
var $A_COMP_MENUS_CMP_CIL_LINK_NAME = '链接必须有名称';
var $A_COMP_MENUS_CMP_CIL_SEL_CONT = '必须选择一个联系人来链接。';
var $A_COMP_MENUS_CMP_CIL_CONTACT = '链接联系人';
var $A_COMP_MENUS_CMP_CIL_ONCLICK = '点击打开方式';
var $A_COMP_MENUS_CMP_CIL_HDR = '菜单项 :: 链接 - 联系人';

//components\com_menus\content_archive_section\content_archive_section.menu.html.php
var $A_COMP_MENUS_CMP_CAS_BLANK = '如果留空，将自动使用单元名称。';

//components\com_menus\content_blog_category\content_blog_category.menu.html.php
var $A_COMP_MENUS_CMP_CBC_CATEG = '可以选择多个分类';

//components\com_menus\content_blog_section\content_blog_section.menu.html.php
var $A_COMP_MENUS_CMP_CBS_SECTION = '可以选择多个单元';

//components\com_menus\content_item_link\content_item_link.menu.html.php
var $A_COMP_MENUS_CMP_CIL_SEL_LINK = '必须选择一个内容条目来链接。';

//components/com_menus/wrapper/wrapper.menu.html.php
var $A_COMP_MENUS_WRAPPER_LINK = '嵌入页面网址';

//components/com_menus/separator/separator.menu.html.php
var $A_COMP_MENUS_SEPARATOR_PATTERN = '模式/名称';

//components/com_menus/content_typed/content_typed.menu.html.php
var $A_COMP_MENUS_TYPED_CONTENT_TO_LINK = '链接静态内容';

//components/com_menus/content_item_link/content_item_link.menu.html.php
var $A_COMP_MENUS_CONTENT_TO_LINK = '链接内容';

//components/com_menus/newsfeed_link/newsfeed_link.menu.html.php
var $A_COMP_MENUS_NEWSFEED_TO_LINK = '链接新闻转播';
var $A_COMP_MENUS_NEWSFEED_SELECT_LINK = '必须选择一个新闻转播来链接。';

//components\com_menus\url\url.menu.html.php
var $A_COMP_MENUS_URL_MUST = '必须输入网址';
var $A_COMP_MENUS_URL_LINK = '链接网址';


	function adminLanguage()
	{
		global $TR_STRS;
		//Menu Caption Translation for initial mambo menutype
		$TR_STRS[strtolower('mainmenu')] = '主菜单';
		$TR_STRS[strtolower('othermenu')] = '其它菜单';
		$TR_STRS[strtolower('topmenu')] = '顶部菜单';
		$TR_STRS[strtolower('usermenu')] = '用户菜单';

		//Components menu caption
		//Banners
		$TR_STRS[strtolower('Banners')] = '横幅广告';
		$TR_STRS[strtolower('Manage Banners')] = '管理横幅广告';
		$TR_STRS[strtolower('Manage Clients')] = '管理客户';

		//Web Links
		$TR_STRS[strtolower('Web Links')] = '网站链接';
		$TR_STRS[strtolower('Weblink Items')] = '网站链接条目';
		$TR_STRS[strtolower('Weblink Categories')] = '网站链接分类';

		//Contacts
		$TR_STRS[strtolower('Contacts')] = '联系人';
		$TR_STRS[strtolower('Manage Contacts')] = '管理联系人';
		$TR_STRS[strtolower('Contact Categories')] = '联系人分类';

		//Polls
		$TR_STRS[strtolower('Polls')] = '在线调查';

		//News Feeds
		$TR_STRS[strtolower('News Feeds')] = '新闻转播';
		$TR_STRS[strtolower('Manage News Feeds')] = '管理新闻转播';
		$TR_STRS[strtolower('Manage Categories')] = '管理分类';

		//Syndicate
		$TR_STRS[strtolower('Syndicate')] = 'RSS 聚合';

		//Mass Mail
		$TR_STRS[strtolower('Mass Mail')] = '群发邮件';

		//modules XML file
		$TR_STRS[strtolower('Count')] = '数量';
		$TR_STRS[strtolower('The number of items to display (default is 5)')] = '最大列表数(默认为 5)';
		$TR_STRS[strtolower('The number of items to display (default is 10)')] = '最大列表数(默认为 10)';
		$TR_STRS[strtolower('Enable Cache')] = '启用缓存';
		$TR_STRS[strtolower('Select whether to cache the content of this module')] = '是否为本模块的内容使用缓存';
		$TR_STRS[strtolower('No')] = '否';
		$TR_STRS[strtolower('Yes')] = '是';
		$TR_STRS[strtolower('Module Class Suffix')] = '模块css后缀';
		$TR_STRS[strtolower('A suffix to be applied to the css class of the module (table.moduletable), this allows individual module styling')] = '应用到模块的css类的后缀(table.moduletable)，这样允许模块使用独自的css风格';
		$TR_STRS[strtolower('Banner')] = '横幅广告';
		$TR_STRS[strtolower('Banner client')] = '广告客户';
		$TR_STRS[strtolower("Reference to banner client id. Enter separated by ','!")] = "关联到横幅广告的客户ID. 如有多个ID则用','分隔!";
		$TR_STRS[strtolower('Latest News')] = '最新文章';
		$TR_STRS[strtolower('This module shows a list of the latest published content items.')] = '本模块显示最新发布的文章列表。';
		$TR_STRS[strtolower('Most Read Content')] = '热门文章';
		$TR_STRS[strtolower('This module shows a list of published content items that have been viewed the most.')] = '本模块显示最热门(浏览最多)的文章列表。';
		$TR_STRS[strtolower('Both')] = '两者都有';
		$TR_STRS[strtolower('Show')] = '显示';
		$TR_STRS[strtolower('Hide')] = '隐藏';
		$TR_STRS[strtolower('Frontpage Items')] = '首页条目';
		$TR_STRS[strtolower('Show/Hide items designated for the Frontpage - only works when in Content Items only mode')] = '显示/隐藏指定给首页的条目 - 仅为内容条目模式有效';
		$TR_STRS[strtolower('Category ID')] = '分类ID';
		$TR_STRS[strtolower('Selects items from a specific Category or set of Categories (to specify more than one Category, seperate with a comma , ).')] = '从一个指定分类或一组分类选择条目 (如有多个ID则用逗号隔开)';
		$TR_STRS[strtolower('Section ID')] = '单元ID';
		$TR_STRS[strtolower('Selects items from a specific Secion or set of Sections (to specify more than one Section, seperate with a comma , ).')] = '从一个指定单元或一组单元选择条目 (如有多个ID则用逗号隔开)';
		$TR_STRS[strtolower('Show Headline')] = '显示头条';
		$TR_STRS[strtolower('Show/Hide the first content item as headline')] = '显示/隐藏第一篇文章条目作为头条新闻';
		$TR_STRS[strtolower('Module Title')] = '模块标题';
		$TR_STRS[strtolower('User defined module title, Only use when headline shown')] = '用户自定义的模块标题，仅当头条显示时使用';
		$TR_STRS[strtolower('Section/Category Style')] = '单元/分类风格';
		$TR_STRS[strtolower('style of section/category: list or blog')] = '单元/分类风格: 列表或博客风格';
		$TR_STRS[strtolower('List')] = '列表风格';
		$TR_STRS[strtolower('Blog')] = '博客风格';
		$TR_STRS[strtolower('Title Length')] = '标题长度';
		$TR_STRS[strtolower('The max length of item title in chars to display, Default 40')] = '文章标题显示的最大长度，默认为40个字符';
		$TR_STRS[strtolower('Date Display')] = '日期显示';
		$TR_STRS[strtolower('The display of item created date')] = '文章创建日期的显示';
		$TR_STRS[strtolower('Login Form')] = '登录表单';
		$TR_STRS[strtolower('Module Layout')] = '模块布局';
		$TR_STRS[strtolower('The layout of login module')] = '登录模块的布局';
		$TR_STRS[strtolower('Vertical Compact')] = '竖向紧凑';
		$TR_STRS[strtolower('Login Redirection URL')] = '登录转向网址';
		$TR_STRS[strtolower('What page will the login redirect to after login, if let blank will load front page')] = '登录后转向的页面，如果留空将装载首页';
		$TR_STRS[strtolower('Logout Redirection URL')] = '退出转向网址';
		$TR_STRS[strtolower('What page will the logout redirect to after logout, if let blank will load front page')] = '退出后转向的页面，如果留空将装载首页';
		$TR_STRS[strtolower('Login Message')] = '登录提示';
		$TR_STRS[strtolower('Show/Hide the javascript Pop-up indicating Login Success')] = '显示/隐藏 javascript 弹出窗口来提示登录成功';
		$TR_STRS[strtolower('Logout Message')] = '退出提示';
		$TR_STRS[strtolower('Show/Hide the javascript Pop-up indicating Logout Success')] = '显示/隐藏 javascript 弹出窗口来提示退出成功';
		$TR_STRS[strtolower('Greeting')] = '问候语';
		$TR_STRS[strtolower('Show/Hide the simple greeting text')] = '显示/隐藏简单的问候文本';
		$TR_STRS[strtolower('Name/Username')] = '姓名/用户名';
		$TR_STRS[strtolower('Username')] = '用户名';
		$TR_STRS[strtolower('Name')] = '姓名';
		$TR_STRS[strtolower('Main Menu')] = '主菜单';
		$TR_STRS[strtolower('Menu Class Suffix')] = '菜单css后缀';
		$TR_STRS[strtolower('A suffix to be applied to the css class of the menu items')] = '应用到菜单项的css类的后缀';
		$TR_STRS[strtolower('Menu Name')] = '菜单名称';
		$TR_STRS[strtolower("The name of the menu (default is 'mainmenu')")] = "菜单的名称(默认为主菜单)";
		$TR_STRS[strtolower('Menu Style')] = '菜单风格';
		$TR_STRS[strtolower('The menu style')] = '菜单风格';
		$TR_STRS[strtolower('Vertical')] = '竖向';
		$TR_STRS[strtolower('Horizontal')] = '横向';
		$TR_STRS[strtolower('Flat List')] = '纵向列表';
		$TR_STRS[strtolower('Show Menu Icons')] = '显示菜单图标';
		$TR_STRS[strtolower('Show the Menu Icons you have selected for your menu items')] = '显示您为菜单项设置的图标';
		$TR_STRS[strtolower('Menu Icon Alignment')] = '菜单图标对齐';
		$TR_STRS[strtolower('Alignment of the Menu Icons')] = '菜单图标对齐';
		$TR_STRS[strtolower('Left')] = '左';
		$TR_STRS[strtolower('Right')] = '右';
		$TR_STRS[strtolower('Expand Menu')] = '展开菜单';
		$TR_STRS[strtolower('Expand the menu and make its sub-menus items always visible')] = '展开菜单，使子菜单总是显示出来';
		$TR_STRS[strtolower('Indent Image')] = '缩进图片';
		$TR_STRS[strtolower('Choose which indent image system to utilise')] = '选择使用哪个缩进图片系统';
		$TR_STRS[strtolower('Template')] = '模版';
		$TR_STRS[strtolower('Mambo default images')] = '曼波默认图片';
		$TR_STRS[strtolower('Use params below')] = '使用以下参数';
		$TR_STRS[strtolower('None')] = '无';
		$TR_STRS[strtolower('Indent Image 1')] = '缩进图片1';
		$TR_STRS[strtolower('Image for the first sub-level')] = '第1级子菜单的图标';
		$TR_STRS[strtolower('Indent Image 2')] = '缩进图片2';
		$TR_STRS[strtolower('Image for the second sub-level')] = '第2级子菜单的图标';
		$TR_STRS[strtolower('Indent Image 3')] = '缩进图片3';
		$TR_STRS[strtolower('Image for the third sub-level')] = '第3级子菜单的图标';
		$TR_STRS[strtolower('Indent Image 4')] = '缩进图片4';
		$TR_STRS[strtolower('Image for the fourth sub-level')] = '第4级子菜单的图标';
		$TR_STRS[strtolower('Indent Image 5')] = '缩进图片5';
		$TR_STRS[strtolower('Image for the fifth sub-level')] = '第5级子菜单的图标';
		$TR_STRS[strtolower('Indent Image 6')] = '缩进图片6';
		$TR_STRS[strtolower('Image for the sixth sub-level')] = '第6级子菜单的图标';
		$TR_STRS[strtolower('Spacer')] = '间隔符';
		$TR_STRS[strtolower('Spacer for Horizontal menu')] = '横向菜单的间隔符';
		$TR_STRS[strtolower('End Spacer')] = '末端间隔符';
		$TR_STRS[strtolower('End Spacer for Horizontal menu')] = '横向菜单的末端间隔符';
		$TR_STRS[strtolower('Newsflash')] = '新闻快讯';
		$TR_STRS[strtolower('Category')] = '分类';
		$TR_STRS[strtolower('A content cateogry')] = '一个内容分类';
		$TR_STRS[strtolower('Style')] = '风格';
		$TR_STRS[strtolower('The style to display the category')] = '分类显示的风格';
		$TR_STRS[strtolower('Randomly choose one at a time')] = '每次随机选择';
		$TR_STRS[strtolower('Show images')] = '显示图片';
		$TR_STRS[strtolower('Display content item images')] = '显示内容条目的图片';
		$TR_STRS[strtolower('Linked Titles')] = '链接标题';
		$TR_STRS[strtolower('Make the Item titles linkable')] = '使条目的标题可链接';
		$TR_STRS[strtolower('Use Global')] = '使用全局设置';
		$TR_STRS[strtolower('Read More')] = '阅读全文';
		$TR_STRS[strtolower('Show/Hide the Read More button')] = '显示/隐藏阅读全文按钮';
		$TR_STRS[strtolower('Item Title')] = '条目标题';
		$TR_STRS[strtolower('Show item title')] = '显示条目标题';
		$TR_STRS[strtolower('No. of Items')] = '条目数';
		$TR_STRS[strtolower('No of items to display')] = '显示的条目数';
		$TR_STRS[strtolower('Poll')] = '在线调查';
		$TR_STRS[strtolower('Random Image')] = '随机图片';
		$TR_STRS[strtolower('Image Type')] = '图片类型';
		$TR_STRS[strtolower('Type of image PNG/GIF/JPG etc. (default is JPG)')] = '图片类型如 PNG/GIF/JPG 等。（默认为 JPG）';
		$TR_STRS[strtolower('Image Folder')] = '图片文件夹';
		$TR_STRS[strtolower('Path to the image folder relative to the site url, eg: images/stories')] = '图片文件夹相对于网站链接的路径，如 images/stories';
		$TR_STRS[strtolower('Link')] = '链接';
		$TR_STRS[strtolower('A URL to redirect to if image is clicked on, eg: http://www.mamboserver.com')] = '点击图片时转向的链接，如 http://www.mamboserver.com';
		$TR_STRS[strtolower('Width (px)')] = '宽度 (px)';
		$TR_STRS[strtolower('Image width (forces all images to be displayed with this width)')] = '图片宽度 （强制所有图片显示在此宽度）';
		$TR_STRS[strtolower('Height (px)')] = '高度 (px)';
		$TR_STRS[strtolower('Image height (forces all images to be displayed with the height)')] = '图片高度 （强制所有图片显示在此高度）';
		$TR_STRS[strtolower('Related Items')] = '相关文章';
		$TR_STRS[strtolower('Text')] = '文本';
		$TR_STRS[strtolower('Enter the text to be displayed along with the RSS links')] = '输入和 RSS 链接一起显示的文本';
		$TR_STRS[strtolower('Show/Hide RSS 0.91 Link')] = '显示/隐藏 RSS 0.91 链接';
		$TR_STRS[strtolower('Show/Hide RSS 1.0 Link')] = '显示/隐藏 RSS 1.0 链接';
		$TR_STRS[strtolower('Show/Hide RSS 2.0 Link')] = '显示/隐藏 RSS 2.0 链接';
		$TR_STRS[strtolower('Show/Hide Atom 0.3 Link')] = '显示/隐藏 Atom 0.3 链接';
		$TR_STRS[strtolower('Show/Hide OPML Link')] = '显示/隐藏 OPML 链接';
		$TR_STRS[strtolower('RSS 0.91 Image')] = 'RSS 0.91 图片';
		$TR_STRS[strtolower('Choose the image to be used')] = '选择要使用的图标';
		$TR_STRS[strtolower('RSS 1.0 Image')] = 'RSS 1.0 图片';
		$TR_STRS[strtolower('RSS 2.0 Image')] = 'RSS 2.0 图片';
		$TR_STRS[strtolower('Atom Image')] = 'Atom 图片';
		$TR_STRS[strtolower('OPML Image')] = 'OPML 图片';
		$TR_STRS[strtolower('Search Module')] = '搜索模块';
		$TR_STRS[strtolower('Box Width')] = '搜索框宽度';
		$TR_STRS[strtolower('Size of the search text box')] = '搜索文本框的尺寸';
		$TR_STRS[strtolower('The text that appears in the search text box, if left blank it will load _SEARCH_BOX from your language file')] = '显示在搜索文本框中的文本，如留空则载入您的语言文件中的 _SEARCH_BOX';
		$TR_STRS[strtolower('Search Button')] = '搜索按钮';
		$TR_STRS[strtolower('Display a Search Button')] = '显示一个搜索按钮';
		$TR_STRS[strtolower('Button Position')] = '按钮位置';
		$TR_STRS[strtolower('Position of the button relative to the search box')] = '按钮位置相对于搜索框';
		$TR_STRS[strtolower('Top')] = '顶部';
		$TR_STRS[strtolower('Bottom')] = '底部';
		$TR_STRS[strtolower('Button Text')] = '按钮文本';
		$TR_STRS[strtolower('The text that appears in the search button, if left blank it will load _SEARCH_TITLE from your language file')] = '显示在搜索按钮上的文本，如留空则载入您的语言文件中的 _SEARCH_TITLE';
		$TR_STRS[strtolower('Sections')] = '单元';
		$TR_STRS[strtolower('Statistics')] = '统计';
		$TR_STRS[strtolower('Server Info')] = '服务器信息';
		$TR_STRS[strtolower('Display server information')] = '显示服务器信息';
		$TR_STRS[strtolower('Site Info')] = '站点信息';
		$TR_STRS[strtolower('Display site information')] = '显示站点信息';
		$TR_STRS[strtolower('Hit Counter')] = '点击数';
		$TR_STRS[strtolower('Display hit counter')] = '显示点击计数器';
		$TR_STRS[strtolower('Increase counter')] = '增加计数器';
		$TR_STRS[strtolower('Enter the amount of hits to increase counter by')] = '输入点击的总数来增加计数器';
		$TR_STRS[strtolower('Template Chooser')] = '模版选择器';
		$TR_STRS[strtolower('Max. Name Length')] = '名称最大长度';
		$TR_STRS[strtolower('This is the maximum length of the template name to display (default 20)')] = '模板名称显示的最大长度（默认为 20）';
		$TR_STRS[strtolower('Show Preview')] = '显示预览';
		$TR_STRS[strtolower('Template preview is to be shown')] = '显示模版的预览';
		$TR_STRS[strtolower('This is the width of the preview image (default 140)')] = '预览图片的宽度（默认为 140）';
		$TR_STRS[strtolower('This is the height of the preview image (default 90)')] = '预览图片的长度（默认为 90）';
		$TR_STRS[strtolower("Who's Online")] = "在线情况";
		$TR_STRS[strtolower('Display')] = '显示';
		$TR_STRS[strtolower('Select what shall be shown')] = '选择要显示的内容';
		$TR_STRS[strtolower('# of Guests/Members<br>')] = '现有#位访客/会员在线<br>';
		$TR_STRS[strtolower('Member Names<br>')] = '会员名称<br>';
		$TR_STRS[strtolower('Wrapper Module')] = '嵌入页面模块';
		$TR_STRS[strtolower('Url')] = '网址';
		$TR_STRS[strtolower('Url to site/file you wish to display within the Iframe')] = '在Iframe中显示的网站/文件的网址';
		$TR_STRS[strtolower('Scroll Bars')] = '滚动条';
		$TR_STRS[strtolower('Show/Hide Horizontal & Vertical scroll bars.')] = '显示/隐藏水平和垂直滚动条.';
		$TR_STRS[strtolower('Auto')] = '自动';
		$TR_STRS[strtolower('Width of the IFrame Window, you can enter an absolute figure in pixels, or a relative figure by adding a %')] = 'IFrame窗口的宽度, 你可以输入绝对的像素数值或相对的百分比数值';
		$TR_STRS[strtolower('Height of the IFrame Window')] = 'IFrame窗口的高度';
		$TR_STRS[strtolower('Auto Height')] = '自动高度';
		$TR_STRS[strtolower('The height will automatically be set to the size of the external page. This will only work for pages on your own domain.')] = '窗口的高度将根据外部页面自动设定，仅对你自己域名下的网页有效。';
		$TR_STRS[strtolower('Auto Add')] = '自动增加';
		$TR_STRS[strtolower('By default http:// will be added unless it detects http:// or https:// in the url link you provide, this allow you to switch this ability off')] = '默认增加 http://，除非检测到您提供的网址为 http:// 或者 https://，这允许你关掉这个功能';

		$TR_STRS[strtolower('Search')] = '搜索';
		$TR_STRS[strtolower('User Menu')] = '用户菜单';
		$TR_STRS[strtolower('Top Menu')] = '顶部菜单';
		$TR_STRS[strtolower('Other Menu')] = '其它菜单';
		$TR_STRS[strtolower('Wrapper')] = '嵌入页面';
		$TR_STRS[strtolower('Popular')] = '热门文章';

		$TR_STRS[strtolower('RSS URL')] = 'RSS 网址';
		$TR_STRS[strtolower('Enter the URL of the RSS/RDF feed')] = '输入 RSS/RDF 转播的网址';
		$TR_STRS[strtolower('Feed Description')] = '转播描述';
		$TR_STRS[strtolower('Show the description text for the whole Feed')] = '显示整个转播的描述文本';
		$TR_STRS[strtolower('Feed Image')] = '转播图片';
		$TR_STRS[strtolower('Show the image associated with the whole Feed')] = '显示与整个转播关联的图片';
		$TR_STRS[strtolower('Items')] = '条目';
		$TR_STRS[strtolower('Enter number of RSS items to display')] = '输入要显示的 RSS 条目的数量';
		$TR_STRS[strtolower('Item Description')] = '条目描述';
		$TR_STRS[strtolower('Show the description or intro text of individual news items')] = '显示单独的新闻条目的描述或介绍文本';

		//administrator/modules XML file
		$TR_STRS[strtolower('Logged')] = '已登录';
		$TR_STRS[strtolower('Logged in Users')] = '已登录用户';
		$TR_STRS[strtolower('Components')] = '组件';
		$TR_STRS[strtolower('Popular Items')] = '热门条目';
		$TR_STRS[strtolower('Latest Items')] = '最新条目';
		$TR_STRS[strtolower('Menu Stats')] = '菜单统计';
		$TR_STRS[strtolower('Unread Messages')] = '未读消息';
		$TR_STRS[strtolower('Online Users')] = '在线用户';
		$TR_STRS[strtolower('Quick Icons')] = '快捷图标';
		$TR_STRS[strtolower('System Message')] = '系统消息';
		$TR_STRS[strtolower('Pathway')] = '导航路径';
		$TR_STRS[strtolower('Toolbar')] = '工具栏';
		$TR_STRS[strtolower('Full Menu')] = '全部菜单';

		//mambots XML file
		$TR_STRS[strtolower('MOS Image')] = 'Mambo 图片';
		$TR_STRS[strtolower('Legacy Mambot Includer')] = '原有触发器置入';
		$TR_STRS[strtolower('Code support')] = '代码支持';
		$TR_STRS[strtolower('SEF')] = '搜索引擎友好链接';
		$TR_STRS[strtolower('MOS Rating')] = 'Mambo 文章评级';
		$TR_STRS[strtolower('Email Cloaking')] = 'Email 掩饰';
		$TR_STRS[strtolower('GeSHi')] = 'GeSHi';
		$TR_STRS[strtolower('Load Module Positions')] = '装载模块位置';
		$TR_STRS[strtolower('MOS Pagination')] = 'Mambo 分页';
		$TR_STRS[strtolower('No WYSIWYG Editor')] = '非所见即所得编辑器';
		$TR_STRS[strtolower('TinyMCE WYSIWYG Editor')] = 'TinyMCE 所见即所得编辑器';
		$TR_STRS[strtolower('MOS Image Editor Button')] = 'Mambo 图片编辑器按钮';
		$TR_STRS[strtolower('MOS Pagebreak Editor Button')] = 'Mambo 分页编辑器按钮';
		$TR_STRS[strtolower('Search Content')] = '搜索内容';
		$TR_STRS[strtolower('Search Weblinks')] = '搜索网站链接';
		$TR_STRS[strtolower('Search Contacts')] = '搜索联系人';
		$TR_STRS[strtolower('Search Categories')] = '搜索分类';
		$TR_STRS[strtolower('Search Sections')] = '搜索单元';
		$TR_STRS[strtolower('Search Newsfeeds')] = '搜索新闻转播';

		$TR_STRS[strtolower('Mode')] = '模式';
		$TR_STRS[strtolower('Select how the emails will be displayed')] = '选择 emails 的显示方式';
		$TR_STRS[strtolower('Nonlinkable Text')] = '不可链接的文本';
		$TR_STRS[strtolower('As linkable mailto address')] = '可链接的 mailto 地址';
		$TR_STRS[strtolower('Margin')] = '页边距';
		$TR_STRS[strtolower('Margin in px, of Div surrounding Image & Caption - only applies if using a Caption')] = '围绕图片和标题的 Div 的页边距，以像素为单位 - 仅在使用标题时有效';
		$TR_STRS[strtolower('Padding')] = '填充';
		$TR_STRS[strtolower('Padding in px, of Div surrounding Image & Caption - only applies if using a Caption')] = '围绕图片和标题的 Div 的填充，以像素为单位 - 仅在使用标题时有效';
		$TR_STRS[strtolower('Wrapped by Table - Column')] = '用表格包装 - 列';
		$TR_STRS[strtolower('Wrapped by Table - Horizontal')] = '用表格包装 - 水平的';
		$TR_STRS[strtolower('Wrapped by Divs')] = '用 Divs 包装';
		$TR_STRS[strtolower('No wrapping - raw output')] = '没有包装 - 原始输出';
		$TR_STRS[strtolower('Site Title')] = '网站标题';
		$TR_STRS[strtolower('title and heading attibutes from mambot added to Site Title tag')] = '从触发器增加到网站标题标签的标题(title)和小标题(heading)属性';

		$TR_STRS[strtolower('Functionality')] = '功能';
		$TR_STRS[strtolower('Select functionality')] = '选择功能';
		$TR_STRS[strtolower('Basic')] = '基本';
		$TR_STRS[strtolower('Advanced')] = '高级';
		$TR_STRS[strtolower('Text Direction')] = '文字方向';
		$TR_STRS[strtolower('Ability to change text direction')] = '改变文字方向的能力';
		$TR_STRS[strtolower('Left to Right')] = '从左到右';
		$TR_STRS[strtolower('Right to Left')] = '从右到左';
		$TR_STRS[strtolower('Prohibited Elements')] = '禁止的元素';
		$TR_STRS[strtolower('Elements that will be cleaned from the text')] = '将被从文本中清除的元素';
		$TR_STRS[strtolower('Template CSS classes')] = '模版 CSS 样式';
		$TR_STRS[strtolower('Load CSS classes from template_css.css')] = '从 template_css.css 读取 CSS 样式';
		$TR_STRS[strtolower('Custom CSS Classes')] = '自定义 CSS 样式';
		$TR_STRS[strtolower('You can specify the loading of a custom CSS file - simply enter the FULL path to the css file you want loaded')] = '可以导入指定的自定义 CSS 文件 - 只须输入该 CSS 文件完整的路径';
		$TR_STRS[strtolower('Newlines')] = '新行';
		$TR_STRS[strtolower('Newlines will be made into the selected option')] = '选择新行的建立方法';
		$TR_STRS[strtolower('BR Elements')] = '用BR分行';
		$TR_STRS[strtolower('P Elements')] = '用P分行';
		$TR_STRS[strtolower('Position of the toolbar')] = '工具条位置';
		$TR_STRS[strtolower('Popup Height')] = '弹出窗口高度';
		$TR_STRS[strtolower('Height of HTML mode pop-up window - only in Advanced Mode')] = 'HTML 模式的弹出窗口高度 - 仅在高级模式中显示';
		$TR_STRS[strtolower('Popup Width')] = '弹出窗口宽度';
		$TR_STRS[strtolower('Width of HTML mode pop-up window - only in Advanced Mode')] = 'HTML 模式的弹出窗口宽度 - 仅在高级模式中显示';

		//administrator/components/com_contact/contact.xml
		$TR_STRS[strtolower('Contact')] = '联系信息';
		$TR_STRS[strtolower('This component shows a listing of Contact Information')] = '本组件显示一个联系信息列表';
		$TR_STRS[strtolower('Page Title')] = '页面标题';
		$TR_STRS[strtolower('Show/Hide the pages Title')] = '显示/隐藏页面标题';
		$TR_STRS[strtolower('Text to display at the top of the page. If left blank, the Menu name will be used instead')] = '显示在页面顶部的文本，如果留空，将使用菜单名称';
		$TR_STRS[strtolower('Category List - Category')] = '分类列表 - 分类';
		$TR_STRS[strtolower('Show/Hide the List of Categories in Table view page')] = '在以表格风格显示的页面中显示/隐藏分类列表';
		$TR_STRS[strtolower('Category Description')] = '分类描述';
		$TR_STRS[strtolower('Show/Hide the Description for the list of other catgeories')] = '显示/隐藏其它分类列表的描述';
		$TR_STRS[strtolower('# Category Items')] = '分类条目数';
		$TR_STRS[strtolower('Show/Hide the number of items in each category')] = '显示/隐藏每个分类的条目数';
		$TR_STRS[strtolower('Show/Hide the Description below')] = '显示/隐藏下面的描述';
		$TR_STRS[strtolower('Description for page, if left blank it will load _WEBLINKS_DESC from your language file')] = '页面的描述，如果留空，则读取语言文件的网站描述';
		$TR_STRS[strtolower('Image for page, must be located in the /images/stories folder. Default will load web_links.jpg, No image will mean an image is not loaded')] = '页面的图片，必须放在目录 /images/stories 中。默认读取 web_links.jpg，没有图片意味着没有装载图片。';
		$TR_STRS[strtolower('Image Align')] = '图片对齐';
		$TR_STRS[strtolower('Alignment of the image')] = '图片对齐';
		$TR_STRS[strtolower('Table Headings')] = '表头';
		$TR_STRS[strtolower('Show/Hide the Table Headings')] = '显示/隐藏表头';
		$TR_STRS[strtolower('Position Column')] = '职务栏';
		$TR_STRS[strtolower('Show/Hide the Position column')] = '显示/隐藏职务栏';
		$TR_STRS[strtolower('Email Column')] = 'Email栏';
		$TR_STRS[strtolower('Show/Hide the Email column')] = '显示/隐藏Email栏';
		$TR_STRS[strtolower('Telephone Column')] = '电话栏';
		$TR_STRS[strtolower('Show/Hide the Telephone column')] = '显示/隐藏电话栏';
		$TR_STRS[strtolower('Fax Column')] = '传真栏';
		$TR_STRS[strtolower('Show/Hide the Fax column')] = '显示/隐藏传真栏';

		//administrator/components/com_contact/contact_items.xml
		$TR_STRS[strtolower('Contact Items')] = '联系条目';
		$TR_STRS[strtolower('Parameters for individual Contact Items')] = '个人联系条目的参数';
		$TR_STRS[strtolower('Menu Image')] = '菜单图片';
		$TR_STRS[strtolower('A small image to be placed to the left or right of your menu item, images must be in images/stories/')] = '一个小图片，放在菜单项的左边或右边，图片必须在目录 images/stories/ 中';
		$TR_STRS[strtolower('Page Class Suffix')] = '页面css后缀';
		$TR_STRS[strtolower('A suffix to be applied to the css classes of the page, this allows individual page styling')] = '应用到页面的css类的后缀，这样允许页面使用独自的css风格';
		$TR_STRS[strtolower('Print Icon')] = '打印图标';
		$TR_STRS[strtolower('Show/Hide the item print button - only affects this page')] = '显示/隐藏打印图标 - 只影响该页面';
		$TR_STRS[strtolower('Back Button')] = '返回按钮';
		$TR_STRS[strtolower('Show/Hide a Back Button, that returns you to the previously view page')] = '显示/隐藏返回按钮，允许返回上一个页面';
		$TR_STRS[strtolower('Name')] = '姓名';
		$TR_STRS[strtolower('Show/Hide the name info')] = '显示/隐藏姓名';
		$TR_STRS[strtolower('Position')] = '职务';
		$TR_STRS[strtolower('Show/Hide the position info')] = '显示/隐藏职务栏';
		$TR_STRS[strtolower('Email')] = 'Email';
		$TR_STRS[strtolower('Show/Hide the email info, if you set to show the address will be protected from spambots by javascript cloaking')] = '显示/隐藏Email栏';
		$TR_STRS[strtolower('Street Address')] = '地址';
		$TR_STRS[strtolower('Show/Hide the street address info')] = '显示/隐藏地址信息';
		$TR_STRS[strtolower('Town/Suburb')] = '城市';
		$TR_STRS[strtolower('Show/Hide the suburb info')] = '显示/隐藏城市信息';
		$TR_STRS[strtolower('State')] = '省份';
		$TR_STRS[strtolower('Show/Hide the state info')] = '显示/隐藏省份信息';
		$TR_STRS[strtolower('Country')] = '国家';
		$TR_STRS[strtolower('Show/Hide the country info')] = '显示/隐藏国家信息';
		$TR_STRS[strtolower('Post/Zip Code')] = '邮编';
		$TR_STRS[strtolower('Show/Hide the post code info')] = '显示/隐藏邮编';
		$TR_STRS[strtolower('Telephone')] = '电话';
		$TR_STRS[strtolower('Show/Hide the telephone info')] = '显示/隐藏电话信息';
		$TR_STRS[strtolower('Fax')] = '传真';
		$TR_STRS[strtolower('Show/Hide the fax info')] = '显示/隐藏传真信息';
		$TR_STRS[strtolower('Misc Info')] = '备注';
		$TR_STRS[strtolower('Show/Hide the misc info')] = '显示/隐藏备注信息';
		$TR_STRS[strtolower('Vcard')] = 'Vcard';
		$TR_STRS[strtolower('Show/Hide the Vcard')] = '显示/隐藏 Vcard';
		$TR_STRS[strtolower('Image')] = '图片';
		$TR_STRS[strtolower('Show/Hide the image')] = '显示/隐藏图片';
		$TR_STRS[strtolower('Email description')] = 'Email描述';
		$TR_STRS[strtolower('Show/Hide the Description Text below')] = '显示/隐藏 下面的Email描述';
		$TR_STRS[strtolower('Description text')] = '描述文本';
		$TR_STRS[strtolower('The Description text for the Email form, if left blank it will use the _EMAIL_DESCRIPTION language definition')] = 'Email表单的描述文本，如果留空，将使用语言文件的 _EMAIL_DESCRIPTION';
		$TR_STRS[strtolower('Email Form')] = 'Email表单';
		$TR_STRS[strtolower('Show/Hide the email to form')] = '显示/隐藏Email表单';
		$TR_STRS[strtolower('Email Copy')] = 'Email复制';
		$TR_STRS[strtolower('Show/Hide the checkbox to email a copy to the senders address')] = '显示/隐藏把email复制到发件人地址的复选框';
		$TR_STRS[strtolower('Drop Down')] = '下拉选择';
		$TR_STRS[strtolower('Show/Hide the Drop Down select list in Contact view')] = '显示/隐藏联系人的下拉选择';
		$TR_STRS[strtolower('Icons/text')] = '图标/文本';
		$TR_STRS[strtolower('Use Icons, text or nothing next to the contact information displayed')] = '使用图标、文本或者空信息，在联系人信息旁边';
		$TR_STRS[strtolower('Icons')] = '图标';
		$TR_STRS[strtolower('Address Icon')] = '地址图标';
		$TR_STRS[strtolower('Icon for the Address info')] = '地址信息的图标';
		$TR_STRS[strtolower('Email Icon')] = 'Email图标';
		$TR_STRS[strtolower('Icon for the Email info')] = 'Email信息的图标';
		$TR_STRS[strtolower('Telephone Icon')] = '电话图标';
		$TR_STRS[strtolower('Icon for the Telephone info')] = '电话信息的图标';
		$TR_STRS[strtolower('Fax Icon')] = '传真图标';
		$TR_STRS[strtolower('Icon for the Fax info')] = '传真信息的图标';
		$TR_STRS[strtolower('Misc Icon')] = '备注图标';
		$TR_STRS[strtolower('Icon for the Misc info')] = '备注信息的图标';

		//administrator/components/com_content XML files
		$TR_STRS[strtolower('Content Page')] = '内容页面';
		$TR_STRS[strtolower('This shows a single content page')] = '显示一个单独的内容页面';
		$TR_STRS[strtolower('Item Title')] = '条目标题';
		$TR_STRS[strtolower('Show/Hide the items title')] = '显示/隐藏条目标题';
		$TR_STRS[strtolower('Make your Item titles linkable')] = '使条目标题可链接';
		$TR_STRS[strtolower('Intro Text')] = '摘要';
		$TR_STRS[strtolower('Show/Hide the intro text')] = '显示/隐藏摘要';
		$TR_STRS[strtolower('Section Name')] = '单元名称';
		$TR_STRS[strtolower('Show/Hide the Section the item belongs to')] = '显示/隐藏条目所属的单元';
		$TR_STRS[strtolower('Section Name Linkable')] = '单元名称可链接';
		$TR_STRS[strtolower('Make the Section text a link to the actual section page')] = '使单元名称链接到其单元页面';
		$TR_STRS[strtolower('Category Name')] = '分类名称';
		$TR_STRS[strtolower('Show/Hide the Category the item belongs to')] = '显示/隐藏条目所属的分类';
		$TR_STRS[strtolower('Category Name Linkable')] = '分类名称可链接';
		$TR_STRS[strtolower('Make the Category text a link to the actual Category page')] = '使分类名称链接到其分类页面';
		$TR_STRS[strtolower('Item Rating')] = '文章评级';
		$TR_STRS[strtolower('Show/Hide the item rating - only affects this page')] = '显示/隐藏文章评级 - 只影响该页面';
		$TR_STRS[strtolower('Author Names')] = '作者名称';
		$TR_STRS[strtolower('Show/Hide the item author - only affects this page')] = '显示/隐藏作者名称 - 只影响该页面';
		$TR_STRS[strtolower('Created Date and Time')] = '创建日期时间';
		$TR_STRS[strtolower('Show/Hide the item creation date - only affects this page')] = '显示/隐藏创建日期时间 - 只影响该页面';
		$TR_STRS[strtolower('Modified Date and Time')] = '更改日期时间';
		$TR_STRS[strtolower('Show/Hide the item modification date - only affects this page')] = '显示/隐藏更改日期时间 - 只影响该页面';
		$TR_STRS[strtolower('Show/Hide the item pdf button - only affects this page')] = '显示/隐藏PDF图标 - 只影响该页面';
		$TR_STRS[strtolower('Show/Hide the item email button - only affects this page')] = '显示/隐藏Email图标 - 只影响该页面';
		$TR_STRS[strtolower('Key Reference')] = '参考资料';
		$TR_STRS[strtolower('A text key that an item may be referenced by (like a help reference)')] = '文章所涉及或参考的资料';

		//administrator/components/com_frontpage/frontpage.xml
		$TR_STRS[strtolower('Frontpage')] = '首页';
		$TR_STRS[strtolower('This component shows all the published content items from your site marked Show on Frontpage.')] = '本组件显示本站点所有标记为显示在首页的已发布内容.';
		$TR_STRS[strtolower('Text to display at the top of the page')] = '显示在页面顶部的文本';
		$TR_STRS[strtolower('Show/Hide the Page title')] = '显示/隐藏页面标题';
		$TR_STRS[strtolower('# Leading')] = '头条数';
		$TR_STRS[strtolower('Number of Items to display as a leading (full width) item. 0 will mean that no items will be displayed as leading.')] = '显示头条文章(占行全宽)的数量，0 表示没有使用头条方式显示。';
		$TR_STRS[strtolower('# Intro')] = '摘要数';
		$TR_STRS[strtolower('Number of Items to display with the introduction text shown.')] = '显示文章摘要的数量。';
		$TR_STRS[strtolower('Columns')] = '摘要列数';
		$TR_STRS[strtolower('When displaying the intro text, how many columns to use per row')] = '每行可显示的摘要数量。';
		$TR_STRS[strtolower('# Links')] = '链接条数';
		$TR_STRS[strtolower('Number of Items to display as Links.')] = '显示文章标题链接的数量';
		$TR_STRS[strtolower('Items Order')] = '文章排序';
		$TR_STRS[strtolower('Order that the items will be displayed in.')] = '内容条目的显示次序。';
		$TR_STRS[strtolower('Pagination')] = '分页';
		$TR_STRS[strtolower('Show/Hide Pagination support')] = '显示/隐藏分页支持';
		$TR_STRS[strtolower('Pagination Results')] = '分页结果';
		$TR_STRS[strtolower('Show/Hide Pagination Results info ( e.g 1-4 of 4 )')] = '显示/隐藏分页结果信息(如：1-4 / 4 )';
		$TR_STRS[strtolower('Item Titles')] = '文章标题';
		$TR_STRS[strtolower('Show/Hide the Read More link')] = '显示/隐藏阅读全文链接';
		$TR_STRS[strtolower('PDF Icon')] = 'PDF图标';

		//administrator/components/com_login/login.xml
		$TR_STRS[strtolower('Login Page Title')] = '登录页面标题';
		$TR_STRS[strtolower('Login JS Message')] = '登录后的 JS 信息';
		$TR_STRS[strtolower('Login Description')] = '登录描述';
		$TR_STRS[strtolower('Show/Hide the Login Description below')] = '显示/隐藏登录后的描述信息';
		$TR_STRS[strtolower('Login Description Text')] = '登录提示文本';
		$TR_STRS[strtolower('Text to display on the login Page, if left blank _LOGIN_DESCRIPTION will be used')] = '设置登录提示的文本, 如果留空，则直接读取你设置的语言文件中的 _LOGIN_DESCRIPTION 的设定值';
		$TR_STRS[strtolower('Login Image')] = '登录图片';
		$TR_STRS[strtolower('Image for the Login Page')] = '登录页面的图片';
		$TR_STRS[strtolower('Login Image Align')] = '登录图片位置';
		$TR_STRS[strtolower('Alignment for Login Image')] = '登录页面的图片位置';
		$TR_STRS[strtolower('Logout Page Title')] = '退出页面标题';
		$TR_STRS[strtolower('What page will be redirected to after logout, if let blank will load front page')] = '设置退出后自动跳转的页面，如果留空，则直接返回到当前页';
		$TR_STRS[strtolower('Logout JS Message')] = '退出后的 JS 信息';
		$TR_STRS[strtolower('Logout Description')] = '退出描述';
		$TR_STRS[strtolower('Show/Hide the Logout Description below')] = '显示/隐藏退出后的描述信息';
		$TR_STRS[strtolower('Logout Description Text')] = '退出提示文本';
		$TR_STRS[strtolower('Text to display on the logout Page, if left blank _LOGOUT_DESCRIPTION will be used')] = '设置退出提示的文本, 如果留空，则直接读取你设置的语言文件中的 _LOGOUT_DESCRIPTION 的设定值';
		$TR_STRS[strtolower('Logout Image')] = '退出图片';
		$TR_STRS[strtolower('Image for the Logout Page')] = '退出页面图片';
		$TR_STRS[strtolower('Logout Image Align')] = '退出图片位置';
		$TR_STRS[strtolower('Alignment for Logout Image')] = '退出页面的图片位置';

		//administrator/components/com_newsfeeds/newsfeeds.xml
		$TR_STRS[strtolower('Newsfeeds')] = '新闻转播';
		$TR_STRS[strtolower('This component manages RSS/RDF newsfeeds')] = '本组件管理 RSS/RDF 新闻转播';
		$TR_STRS[strtolower('Name Column')] = '名称栏';
		$TR_STRS[strtolower('Show/Hide the Feed Name column')] = '显示/隐藏转播名称栏';
		$TR_STRS[strtolower('# Articles Column')] = '文章数栏';
		$TR_STRS[strtolower('Show/Hide the # of articles in the feed')] = '显示/隐藏转播中的文章数';
		$TR_STRS[strtolower('Link Column')] = '链接栏';
		$TR_STRS[strtolower('Show/Hide the Feed Link column')] = '显示/隐藏转播链接栏';
		$TR_STRS[strtolower('Show/Hide the image of the feed')] = '显示/隐藏转播图片';
		$TR_STRS[strtolower('Show/Hide the description text of the feed')] = '显示/隐藏转播的描述文本';
		$TR_STRS[strtolower('Show/Hide the description or intro text of an item')] = '显示/隐藏条目的描述或介绍文本';

		//administrator/components/com_syndicate XML files
		$TR_STRS[strtolower('Syndicate')] = 'RSS 聚合';
		$TR_STRS[strtolower('This component controls the Syndication settings')] = '本组件控制 RSS 聚合设置';
		$TR_STRS[strtolower('Cache')] = '缓存';
		$TR_STRS[strtolower('Cache the feed files')] = '缓存转播文件';
		$TR_STRS[strtolower('Cache Time')] = '缓存时间';
		$TR_STRS[strtolower('Cache file will refresh every x seconds')] = '缓存文件的刷新时间(单位：秒)';
		$TR_STRS[strtolower('# Items')] = '条目数量';
		$TR_STRS[strtolower('Number of Items to syndicate')] = 'RSS 聚合条目数量';
		$TR_STRS[strtolower('Title')] = '标题';
		$TR_STRS[strtolower('Syndication Title')] = 'RSS 聚合标题';
		$TR_STRS[strtolower('Description')] = '描述';
		$TR_STRS[strtolower('Syndication Description')] = 'RSS 聚合描述';
		$TR_STRS[strtolower('Image to be included in feed')] = '包含在转播中的图片';
		$TR_STRS[strtolower('Image Alt')] = '图片替代文本';
		$TR_STRS[strtolower('Alt text for image')] = '图片替代文本';
		$TR_STRS[strtolower('Limit Text')] = '限制文本';
		$TR_STRS[strtolower('Limit the article text to the value indicated below')] = '根据下面的数值限制文章文本长度';
		$TR_STRS[strtolower('Text Length')] = '文本长度';
		$TR_STRS[strtolower('The word length of the article text - 0 will show no text')] = '文章文本的字符长度 - 0 将不显示内容';
		$TR_STRS[strtolower('Order')] = '次序';
		$TR_STRS[strtolower('Order that the items will be displayed')] = '条目显示的次序';
		$TR_STRS[strtolower('Default')] = '默认';
		$TR_STRS[strtolower('Frontpage Ordering')] = '首页条目次序';
		$TR_STRS[strtolower('Oldest first')] = '日期顺序';
		$TR_STRS[strtolower('Most recent first')] = '日期反序';
		$TR_STRS[strtolower('Title Alphabetical')] = '标题字母顺序';
		$TR_STRS[strtolower('Title Reverse-Alphabetical')] = '标题字母反序';
		$TR_STRS[strtolower('Author Alphabetical')] = '作者字母顺序';
		$TR_STRS[strtolower('Author Reverse-Alphabetical')] = '作者字母反序';
		$TR_STRS[strtolower('Most Hits')] = '点击最多的在前';
		$TR_STRS[strtolower('Least Hits')] = '点击最少的在前';
		$TR_STRS[strtolower('Ordering')] = '条目次序';
		$TR_STRS[strtolower('Live Bookmarks')] = '动态书签(Live Bookmarks)';
		$TR_STRS[strtolower('Activate support for Firefox Live Bookmarks functionality')] = '激活 Firefox 动态书签(Live Bookmarks)功能的支持';
		$TR_STRS[strtolower('Off')] = '关';
		$TR_STRS[strtolower('RSS 0.91')] = 'RSS 0.91';
		$TR_STRS[strtolower('RSS 1.0')] = 'RSS 1.0';
		$TR_STRS[strtolower('RSS 2.0')] = 'RSS 2.0';
		$TR_STRS[strtolower('ATOM 0.3')] = 'ATOM 0.3';
		$TR_STRS[strtolower('Bookmark file')] = '书签文件';
		$TR_STRS[strtolower('Special file name, if empty the default will be used.')] = '指定文件名称,留空则采用默认名称.';

		//administrator/components/com_weblinks/weblinks.xml
		$TR_STRS[strtolower('Hits')] = '点击数';
		$TR_STRS[strtolower('Show/Hide the Hits column')] = '显示/隐藏点击栏数';
		$TR_STRS[strtolower('Link Descriptions')] = '链接描述';
		$TR_STRS[strtolower('Show/Hide the Description text of the Links')] = '显示/隐藏链接描述文本';
		$TR_STRS[strtolower('Icon')] = '图标';
		$TR_STRS[strtolower('Icon to be used to the left of the url links in Table view')] = '在表格视图中的网址链接左边显示的图标';

		//administrator/components/com_weblinks/weblinks_item.xml
		$TR_STRS[strtolower('This component shows a listing of Weblinks')] = '显示网站链接列表';
		$TR_STRS[strtolower('Target')] = '目标窗口';
		$TR_STRS[strtolower('Target window when the link is clicked')] = '点击连接后打开页面的目标窗口';
		$TR_STRS[strtolower('Parent Window With Browser Navigation')] = '带有浏览器导航栏的父窗口';
		$TR_STRS[strtolower('New Window With Browser Navigation')] = '带有浏览器导航栏的新窗口';
		$TR_STRS[strtolower('New Window Without Browser Navigation')] = '不带浏览器导航栏的新窗口';

		//administrator/components/com_menus/contact_category_table/contact_category_table.xml
		$TR_STRS[strtolower('Other Categories')] = '其它分类';
		$TR_STRS[strtolower('When viewing a Category, Show/Hide the list of other Categories')] = '浏览一个分类时，显示/隐藏其它分类列表';
		
		//administrator/components/com_menus/content_blog_category/content_blog_category.xml
		$TR_STRS[strtolower('Show/Hide the Category Description')] = '显示/隐藏分类的描述';
		$TR_STRS[strtolower('Description Image')] = '描述图片';
		$TR_STRS[strtolower('Show/Hide image of the Category Description')] = '显示/隐藏分类描述的图片';

		//administrator/components/com_menus/content_blog_section/content_blog_section.xml
		$TR_STRS[strtolower('Show/Hide the Section Description')] = '显示/隐藏单元的描述';
		$TR_STRS[strtolower('Show/Hide image of the Section Description')] = '显示/隐藏单元描述的图片';
		$TR_STRS[strtolower('Category List')] = '分类列表';
		$TR_STRS[strtolower('Show/Hide the category list of section')] = '显示/隐藏单元的分类列表';
		$TR_STRS[strtolower('Category Item Count')] = '分类文章数';
		$TR_STRS[strtolower('Show/Hide the item count of category')] = '显示/隐藏分类的文章数';
		$TR_STRS[strtolower('Categories per Row')] = '每行分类数';
		$TR_STRS[strtolower('Number of categories to display per row')] = '每行显示的分类数';

		//administrator/components/com_menus/content_category/content_category.xml
		$TR_STRS[strtolower('Table - Content Category')] = '表格 - 内容分类';
		$TR_STRS[strtolower('Shows a Table view of Content items for a particular Category')] = '为特定分类以表格风格显示内容项目';
		$TR_STRS[strtolower('Date Format')] = '日期格式';
		$TR_STRS[strtolower('The format of the date displayed, using PHPs strftime Command Format - if left blank it will load the format from your language file')] = '日期显示的格式，使用PHP的 strftime 命令格式 - 如果留空的话，就使用语言文件中的日期格式';
		$TR_STRS[strtolower('Date Column')] = '日期栏';
		$TR_STRS[strtolower('Show/Hide the Date column')] = '显示/隐藏日期栏';
		$TR_STRS[strtolower('Author Column')] = '作者栏';
		$TR_STRS[strtolower('Show/Hide the Author column')] = '显示/隐藏作者栏';
		$TR_STRS[strtolower('Hits Column')] = '点击栏';
		$TR_STRS[strtolower('Show/Hide the Hits column')] = '显示/隐藏点击栏';
		$TR_STRS[strtolower('Navigation Bar')] = '分页导航条';
		$TR_STRS[strtolower('Show/Hide the Navigation bar')] = '显示/隐藏分页导航条';
		$TR_STRS[strtolower('Display Number')] = '显示数';
		$TR_STRS[strtolower('Number of items to be displayed by default')] = '默认的条目显示数';
		$TR_STRS[strtolower('Author')] = '作者';

		//administrator/components/com_menus/content_section/content_section.xml
		$TR_STRS[strtolower('Table - Content Section')] = '表格 - 内容单元';
		$TR_STRS[strtolower('Creates a listing of Content categories for a particular section')] = '为特定的单元创建内容分类列表';
		$TR_STRS[strtolower('Item List of Category')] = '分类文章列表';
		$TR_STRS[strtolower('Show/Hide the item list of category')] = '显示/隐藏分类的文章列表';
		$TR_STRS[strtolower('Item Count')] = '列表文章数';
		$TR_STRS[strtolower('The number of items to display in the item list of category(default is 5)')] = '分类文章列表要显示的文章数量(默认是5)';
		$TR_STRS[strtolower('Item List of Section')] = '单元文章列表';
		$TR_STRS[strtolower('Show/Hide the item list of section')] = '显示/隐藏单元的文章列表';

		//administrator/components/com_menus/newsfeed_category_table/newsfeed_category_table.xml
		$TR_STRS[strtolower('A small image to be placed to the left or right of your menu item, images must be in /images')] = '一个小图片，放在菜单项的左边或右边，图片必须在目录 /images 中';
		$TR_STRS[strtolower('Articles Column')] = '文章数栏';
		$TR_STRS[strtolower('Show/Hide the Articles column')] = '显示/隐藏文章数栏';

		//administrator/components/com_menus/wrapper/wrapper.xml
		$TR_STRS[strtolower('Width')] = '宽度';
		$TR_STRS[strtolower('Height')] = '高度';

		//administrator/components/com_menus all XML files' name and description
		$TR_STRS[strtolower('Link - Component Item')] = '链接 - 组件条目';
		$TR_STRS[strtolower('Creates a link to an existing Mambo Component')] = '创建一个链接到现有的曼波组件';
		$TR_STRS[strtolower('Component')] = '组件';
		$TR_STRS[strtolower('Displays the frontend interface for a Component')] = '为组件显示前台界面';
		$TR_STRS[strtolower('Table - Contact Category')] = '表格 - 联系人分类';
		$TR_STRS[strtolower('Shows a Table view of Contact items for a particular Category')] = '以表格方式显示一个特定分类的联系人条目';
		$TR_STRS[strtolower('Link - Contact Item')] = '链接 - 联系人条目';
		$TR_STRS[strtolower('Creates a link to a Published Contact Item')] = '创建一个链接到一个已发布的联系人条目';
		$TR_STRS[strtolower('Blog - Content Category')] = '博客风格 - 内容分类';
		$TR_STRS[strtolower('Displays a page of content items from multiple categories in a blog format')] = '以博客风格在一个页面中显示多个分类的内容条目';
		$TR_STRS[strtolower('Blog - Content Section')] = '博客风格 - 内容单元';
		$TR_STRS[strtolower('Displays a page of content items from multiple sections in a blog format')] = '以博客风格在一个页面中显示多个单元的内容条目';
		$TR_STRS[strtolower('Table - Content Category')] = '表格 - 内容分类';
		$TR_STRS[strtolower('Shows a Table view of Content items for a particular Category')] = '以表格风格显示一个特定分类的内容条目';
		$TR_STRS[strtolower('Link - Content Item')] = '链接 - 内容条目';
		$TR_STRS[strtolower('Creates a link to a published Content Item in full view')] = '创建一个链接到一个已发布的内容条目，显示全文';
		$TR_STRS[strtolower('Table - Content Section')] = '表格 - 内容单元';
		$TR_STRS[strtolower('Creates a listing of Content categories for a particular section')] = '以表格风格显示一个特定单元的内容条目';
		$TR_STRS[strtolower('Link - Static Content')] = '链接 - 静态内容';
		$TR_STRS[strtolower('Creates a link to Static Content Item')] = '创建一个链接到静态内容条目';
		$TR_STRS[strtolower('Table - Newsfeed Category')] = '表格 - 新闻转播分类';
		$TR_STRS[strtolower('Shows a Table view of Newsfeed items for a particular Category')] = '以表格风格显示一个特定分类的新闻转播条目';
		$TR_STRS[strtolower('Link - Newsfeed')] = '链接 - 新闻转播';
		$TR_STRS[strtolower('Creates a link to an individual Published Newsfeed')] = '创建一个链接到一个已发布的新闻转播条目';
		$TR_STRS[strtolower('Separator / Placeholder')] = '分隔符 / 占位符';
		$TR_STRS[strtolower('Creates a menu placeholder or separator')] = '建立一个菜单占位符或分隔符';
		$TR_STRS[strtolower('Link - Url')] = '链接 - 网址';
		$TR_STRS[strtolower('Creates url link')] = '创建网址链接';
		$TR_STRS[strtolower('Table - Weblink Category')] = '表格 - 网站链接分类';
		$TR_STRS[strtolower('Shows a Table view of Weblink items for a particular Weblink Category')] = '以表格风格显示一个特定网站链接分类的网站链接条目';
		$TR_STRS[strtolower('Wrapper')] = '嵌入页面';
		$TR_STRS[strtolower('Creates an IFrame that will wrap an external page/site into Mambo')] = '创建一个 Iframe，包装一个外部页面/网站进入曼波网站';

		$TR_STRS[strtolower('Mamhoo')] = '曼虎';
		$TR_STRS[strtolower('Mamhoo User Manager')] = '曼虎用户管理';
		$TR_STRS[strtolower('Mamhoo User Extended Config')] = '曼虎用户扩展设置';
		$TR_STRS[strtolower('Install/Uninstall Mamhooks')] = '安装/卸载曼虎钩子';
		$TR_STRS[strtolower('About Mamhoo')] = '关于曼虎';

	}


}

?>