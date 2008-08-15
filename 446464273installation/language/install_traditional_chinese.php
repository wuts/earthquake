<?php
/**
* @version $Id: install_traditional_chinese.php,v 1.5 2007/05/31 22:21:13 lang3 Exp $
* @package MMLi
* @copyright (C) 2000 - 2004 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @edited by mic (developer@mamboworld.net) www.mamboworld.net
* Mambo is Free Software
*/
// edited for Mambo 4.5.3 by Akarawuth Tamrareang  http://www.mambohub.com
// edited by mic (mic@mamboworld.net) - 2005.01.07

/*
 install_traditional_chinese.php
 曼波整站系統(Mambors)安裝簡體中文語言文件
 Mambo中國項目組 http://www.mambochina.net
 2007-05-31
*/

//-- Common
define ('_INSTALL_ISO','BIG5');
define ('_INSTALL_YES', "是");
define ('_INSTALL_NO', "否");
define ('_INSTALL_AVAILABLE', "可用");
define ('_INSTALL_UNAVAILABLE', "不可用");
define ('_INSTALL_WRITABLE', "可寫");
define ('_INSTALL_ON', "開啟");
define ('_INSTALL_OFF', "關閉");
define ('_INSTALL_UNWRITABLE', "不可寫");
define ('_INSTALL_NEXT', "下一步 >>");
define ('_INSTALL_BACK', '<< 上一步'); // ##### new

//--Language choice
define ('_INSTALL_LANGUAGE_SECTION', "Mambo 安裝語言");
define ('_INSTALL_LANGUAGE_DESCRIPTION', "安裝程序根據瀏覽器的設置自動選擇安裝語言，但您仍可選擇另一種語言來安裝。");
define ('_INSTALL_LANGUAGE_LABEL', "安裝語言");
define ('_INSTALL_LANGUAGE_CHECK','語言檢查');
define ('_INSTALL_LANGUAGE_CHOOSE','- 請選擇 -');

//-- Index.php
	//--Left menu
define ('_INSTALL_LICENSE_ALERT', "請閱讀/接受許可協議以繼續安裝");
define ('_MAMBO_WEB_INSTALLER', _MAMBORS_VERSION . " - 網站安裝程序 :: ");  //  Add Title  by Ak.
define ('_INSTALL_MAMBO', "Mambo 安裝程序");
define ('_INSTALL_STEP_PRECHECK', "安裝前的檢查");
define ('_INSTALL_STEP_LICENSE', "許可協議");
define ('_INSTALL_STEP_1', "第一步");
define ('_INSTALL_STEP_2', "第二步");
define ('_INSTALL_STEP_3', "第三步");
define ('_INSTALL_STEP_4', "第四步");
	//--Pre-check zone
define ('_INSTALL_PRECHECK_TITLE', "安裝前的檢查");
define ('_INSTALL_PRECHECK_SECTION', "安裝前的檢查");
define ('_INSTALL_PRECHECK_DESCRIPTION', "如任一項有紅色提示，請修改該項以確保正常安裝！");
define ('_INSTALL_PHP_VERSION','- <strong>PHP</strong> 版本 >= 4.1.0');
define ('_INSTALL_PHP_ZLIB', '- <strong>zlib</strong> 壓縮支持');
define ('_INSTALL_PHP_XML', '- <strong>XML</strong> 支持');
define ('_INSTALL_PHP_MYSQL', '- <strong>MySQL</strong> 支持');
define ('_INSTALL_CONFIG_FILE','- <strong>Mambo</strong> 配置文件');
define ('_INSTALL_PHP_CONF', "安裝仍然可以繼續，配置信息將在安裝的最後顯示，只需複製配置信息保存為configuration.php上傳即可.");
define ('_INSTALL_SESSION', "- Session 保存路徑");
define ('_INSTALL_SESSION_NOT_SET','未設置');

	//--recommanded
define ('_INSTALL_PHP_SETTINGS_TITLE', "推薦設置:");
define ('_INSTALL_PHP_SETTINGS_DESCRIPTION', "以下是保證對 Mambo 兼容的 PHP 推薦設置，但 Mambo 仍有可能在設置不完全一致的情況下運行。");
define ('_INSTALL_PHP_FONCTION', "PHP設置");
define ('_INSTALL_PHP_FONCTION_IDEAL', "推薦設置");
define ('_INSTALL_PHP_FONCTION_ACTUAL', "實際設置");
define ('_INSTALL_PHP_MODE', "Safe Mode:");
define ('_INSTALL_PHP_ERRORS', "Display Errors:");
define ('_INSTALL_PHP_UPLOAD', "File Uploads:");
define ('_INSTALL_PHP_QUOTES_GPC', "Magic Quotes GPC:");
define ('_INSTALL_PHP_QUOTES_RUNTIME', "Magic Quotes Runtime:");
define ('_INSTALL_PHP_GLOBALS', "Register Globals:");
define ('_INSTALL_PHP_OUTBUFFER', "Output Buffering:");
define ('_INSTALL_PHP_AUTOSTART_SESSION', "Session auto start:");
	//--file permission
define ('_INSTALL_DIRFILE_PERMS', "目錄和文件的權限:");
define ('_INSTALL_DIRFILE_PERMS_INFO', "以下文件夾必須有可寫的權限, Mambo 才能正常運行。如果您看到「不可寫」，請在服務器上修改它的屬性為可寫！[如: 通過FTP軟件更改文件屬性(CHMOD)為0777]。");

//--Install.php
define ('_INSTALL_LICENSE_TITLE', "許可協議");
define ('_INSTALL_LICENSE_TYPE', "GNU/GPL 許可協議:");
define ('_INSTALL_LICENSE_CONDITION', "*** 繼續安裝 Mambo 之前您必須接受該協議 ***");
define ('_INSTALL_LICENSE_AGREE', "我接受 GPL 許可協議");

//--Install1.php
define ('_INSTALL_DB_JS_HOSTNAME', '請輸入主機名稱');
define ('_INSTALL_DB_JS_USERNAME', '請輸入數據庫用戶名');
define ('_INSTALL_DB_JS_BASENAME', '請輸入數據庫名稱');
define ('_INSTALL_DB_JS_PASSWORD', '請輸入數據庫密碼');
define('_INSTALL_DB_PASSWORD_VERRIFY',"校驗 MySQL 密碼");    // Add by ninekrit
define ('_INSTALL_DB_JS_WARNING', '您確定所有的設置都正確嗎?\nMambo現在將根據您提供的設置建立數據庫');
define ('_INSTALL_DB_SECTION', "MySQL 數據庫配置:");
define ('_INSTALL_DB_HOSTNAME', "MySQL 主機名稱");
define ('_INSTALL_DB_HOSTNAME_DESCRIPTION', '通常為 localhost');
define ('_INSTALL_DB_USERNAME', "MySQL 用戶名");
define('_INSTALL_DB_USERNAME_DESC', "使用 root 用戶或者空間商提供的用戶名");
define ('_INSTALL_DB_PASSWORD', "MySQL 密碼");
define ('_INSTALL_DB_BASENAME', "MySQL 數據庫名稱");
define ('_INSTALL_DB_PREFIX', "MySQL 數據表前綴");
define ('_INSTALL_DB_PREFIX_DESC', "有些虛擬主機只有一個數據庫，我們可以用不同的表前綴來區分和安裝多個曼波系統。<br />注意：不能用表前綴 'old_' ，因為這用於備份數據表。");
define ('_INSTALL_DB_DROPTABLES', "刪除舊的數據表？");
define ('_INSTALL_DB_BACKUP', "備份舊的數據表？");
define ('_INSTALL_DB_BACKUP_DESCRIPTION', "保留之前安裝的曼波系統數據庫，表前綴將改為 old_");
define ('_INSTALL_DB_SAMPLE_DATA', "安裝樣本數據？");
define ('_INSTALL_DB_SAMPLE_DATA_DESC',"樣本數據能讓您快速瞭解曼波整站系統，如果您不熟悉曼波，請不要取消！");


//--Install2.php
define ('_INSTALL_DB_ERROR1', "數據庫設置錯誤或尚未設置。");
define ('_INSTALL_DB_ERROR2', "MySql用戶名或密碼錯誤。");
define ('_INSTALL_DB_ERROR3', "尚未填寫數據庫名稱。");
define ('_INSTALL_DB_ERROR4', "數據庫錯誤: ");
define ('INSTALL_DB_ERROR5', "提供的數據庫密碼不匹配，請再試一次。");
define ('_INSTALL_DB_DATAERROR', "數據庫插入數據出錯!<br />無法繼續安裝。");
define ('_INSTALL_DB_LOGERROR', "<br /><br />錯誤記錄:<br />\n");

define ('_INSTALL_SITE_NONAME', "尚未輸入網站名稱");
define ('_INSTALL_JS_SITENAME', "請輸入站點名稱");
define ('_INSTALL_JS_SITEURL', "請輸入站點網址");
define ('_INSTALL_JS_PATH', "請輸入站點的絕對路徑");
define ('_INSTALL_JS_EMAIL', "請輸入站點管理員的聯絡Email");
define ('_INSTALL_JS_PASSWORD', "請輸入管理員密碼");
define ('_INSTALL_SITE_SECTION', "設置站點的名稱、網址、絕對路徑和管理員Email");
define ('_INSTALL_SITE_DESCRIPTION', "通常，默認的網址和絕對路徑都是正確的，請不要修改。如果不正確，請咨詢空間商或者管理員。");
define ('_INSTALL_SITE_NAME', "站點名稱");
define ('_INSTALL_SITE_PATH', "絕對路徑");
define ('_INSTALL_SITE_URL', "站點網址");
define ('_INSTALL_SUPERADMIN_EMAIL', "管理員Email");
define ('_INSTALL_SUPERADMIN_PASSWORD', "管理員密碼");
define ('_INSTALL_ADMIN_PW','[注: 建議把密碼改為你想要的]');

//--Install3.php
define ('_INSTALL_JS_CHECKEMAIL', "必須提供一個有效的Email地址。");
define ('_INSTALL_JS_CHECKDB', "數據庫設置錯誤或尚未設置");
define ('_INSTALL_JS_CHECKSITENAME', "請輸入站點名稱");
define ('_INSTALL_CONF_SITE_MAINTAIN', "'本站正在維護當中。<br /> 請稍候再來。'");
define ('_INSTALL_CONF_SITE_UNAVAILABLE', "'本站臨時出現問題。<br /> 請通知管理員。'");
define ('_INSTALL_CONF_METADESC', "'Mambo - 曼波智能建站系統'");
define ('_INSTALL_CONF_METAKEYS', "'mambo, Mambo, Mambo中國, mambochina, mambo中國, php, mysql, 智能建站, 自助建站'");
define ('_INSTALL_CONF_LANGUAGE_REF', "zh_CN");
define ('_INSTALL_CHMOD_DIR', "<u>提示</u>: 目錄權限成功更改。");
define ('_INSTALL_CHMOD_DIR_FAIL', "<u>提示</u>: 目錄權限無法更改，請手工更改以下目錄的權限為0777:<br />");
define ('_INSTALL_JS_CHECKURL', "尚未輸入站點網址");
define ('_INSTALL_CONGRATULATION', "恭喜你，" . _MAMBORS_VERSION . "安裝成功！");
define ('_INSTALL_DESCRIPTION', "<p>點擊「瀏覽站點」就可以瀏覽你的Mambo站了。或者點擊「管理站點」進行管理後台登錄。</p>");
define ('_INSTALL_LOGIN', "管理員帳號密碼");
define ('_INSTALL_ADMIN_USERNAME', "用戶名: admin");
define ('_INSTALL_ADMIN_PASSWORD', "密碼: ");
define ('_INSTALL_VIEWSITE', "瀏覽站點");
define ('_INSTALL_LOGINADMIN', "管理站點");
define ('_INSTALL_ALERT', '您的configuration.php配置文件或目錄不可寫，請複製下框的內容，保存為configuration.php，然後上傳到服務器的Mambo目錄中。');

define ('_INSTALL_MAIL_DEL_INSTALLDIR','注意: 為了安全起見，請刪除 installation 目錄，包括其中的所有文件和子目錄!');
define ('_INSTALL_MAIL_DEL_INSTALLDIR_RENAME','注意: "installation" 目錄已改名為 " %s "，一旦不再需要，請立即刪除它！'); // +++++ new

?>
