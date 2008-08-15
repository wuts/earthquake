<?php
/**
* @version $Id: install_simplified_chinese_utf-8.php,v 1.5 2007/05/31 22:21:13 lang3 Exp $
* @package MMLi
* @copyright (C) 2000 - 2004 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @edited by mic (developer@mamboworld.net) www.mamboworld.net
* Mambo is Free Software
*/
// edited for Mambo 4.5.3 by Akarawuth Tamrareang  http://www.mambohub.com
// edited by mic (mic@mamboworld.net) - 2005.01.07

/*
 install_simplified_chinese.php
 曼波整站系统(Mambors)安装简体中文语言文件
 Mambo中国项目组 http://www.mambochina.net
 2007-05-31
*/

//-- Common
define ('_INSTALL_ISO','UTF-8');
define ('_INSTALL_YES', "是");
define ('_INSTALL_NO', "否");
define ('_INSTALL_AVAILABLE', "可用");
define ('_INSTALL_UNAVAILABLE', "不可用");
define ('_INSTALL_WRITABLE', "可写");
define ('_INSTALL_ON', "开启");
define ('_INSTALL_OFF', "关闭");
define ('_INSTALL_UNWRITABLE', "不可写");
define ('_INSTALL_NEXT', "下一步 >>");
define ('_INSTALL_BACK', '<< 上一步'); // ##### new

//--Language choice
define ('_INSTALL_LANGUAGE_SECTION', "Mambo 安装语言");
define ('_INSTALL_LANGUAGE_DESCRIPTION', "安装程序根据浏览器的设置自动选择安装语言，但您仍可选择另一种语言来安装。");
define ('_INSTALL_LANGUAGE_LABEL', "安装语言");
define ('_INSTALL_LANGUAGE_CHECK','语言检查');
define ('_INSTALL_LANGUAGE_CHOOSE','- 请选择 -');

//-- Index.php
	//--Left menu
define ('_INSTALL_LICENSE_ALERT', "请阅读/接受许可协议以继续安装");
define ('_MAMBO_WEB_INSTALLER', _MAMBORS_VERSION . " - 网站安装程序 :: ");  //  Add Title  by Ak.
define ('_INSTALL_MAMBO', "Mambo 安装程序");
define ('_INSTALL_STEP_PRECHECK', "安装前的检查");
define ('_INSTALL_STEP_LICENSE', "许可协议");
define ('_INSTALL_STEP_1', "第一步");
define ('_INSTALL_STEP_2', "第二步");
define ('_INSTALL_STEP_3', "第三步");
define ('_INSTALL_STEP_4', "第四步");
	//--Pre-check zone
define ('_INSTALL_PRECHECK_TITLE', "安装前的检查");
define ('_INSTALL_PRECHECK_SECTION', "安装前的检查");
define ('_INSTALL_PRECHECK_DESCRIPTION', "如任一项有红色提示，请修改该项以确保正常安装！");
define ('_INSTALL_PHP_VERSION','- <strong>PHP</strong> 版本 >= 4.1.0');
define ('_INSTALL_PHP_ZLIB', '- <strong>zlib</strong> 压缩支持');
define ('_INSTALL_PHP_XML', '- <strong>XML</strong> 支持');
define ('_INSTALL_PHP_MYSQL', '- <strong>MySQL</strong> 支持');
define ('_INSTALL_CONFIG_FILE','- <strong>Mambo</strong> 配置文件');
define ('_INSTALL_PHP_CONF', "安装仍然可以继续，配置信息将在安装的最后显示，只需复制配置信息保存为configuration.php上传即可.");
define ('_INSTALL_SESSION', "- Session 保存路径");
define ('_INSTALL_SESSION_NOT_SET','未设置');

	//--recommanded
define ('_INSTALL_PHP_SETTINGS_TITLE', "推荐设置:");
define ('_INSTALL_PHP_SETTINGS_DESCRIPTION', "以下是保证对 Mambo 兼容的 PHP 推荐设置，但 Mambo 仍有可能在设置不完全一致的情况下运行。");
define ('_INSTALL_PHP_FONCTION', "PHP设置");
define ('_INSTALL_PHP_FONCTION_IDEAL', "推荐设置");
define ('_INSTALL_PHP_FONCTION_ACTUAL', "实际设置");
define ('_INSTALL_PHP_MODE', "Safe Mode:");
define ('_INSTALL_PHP_ERRORS', "Display Errors:");
define ('_INSTALL_PHP_UPLOAD', "File Uploads:");
define ('_INSTALL_PHP_QUOTES_GPC', "Magic Quotes GPC:");
define ('_INSTALL_PHP_QUOTES_RUNTIME', "Magic Quotes Runtime:");
define ('_INSTALL_PHP_GLOBALS', "Register Globals:");
define ('_INSTALL_PHP_OUTBUFFER', "Output Buffering:");
define ('_INSTALL_PHP_AUTOSTART_SESSION', "Session auto start:");
	//--file permission
define ('_INSTALL_DIRFILE_PERMS', "目录和文件的权限:");
define ('_INSTALL_DIRFILE_PERMS_INFO', "以下文件夹必须有可写的权限, Mambo 才能正常运行。如果您看到“不可写”，请在服务器上修改它的属性为可写！[如: 通过FTP软件更改文件属性(CHMOD)为0777]。");

//--Install.php
define ('_INSTALL_LICENSE_TITLE', "许可协议");
define ('_INSTALL_LICENSE_TYPE', "GNU/GPL 许可协议:");
define ('_INSTALL_LICENSE_CONDITION', "*** 继续安装 Mambo 之前您必须接受该协议 ***");
define ('_INSTALL_LICENSE_AGREE', "我接受 GPL 许可协议");

//--Install1.php
define ('_INSTALL_DB_JS_HOSTNAME', '请输入主机名称');
define ('_INSTALL_DB_JS_USERNAME', '请输入数据库用户名');
define ('_INSTALL_DB_JS_BASENAME', '请输入数据库名称');
define ('_INSTALL_DB_JS_PASSWORD', '请输入数据库密码');
define('_INSTALL_DB_PASSWORD_VERRIFY',"校验 MySQL 密码");    // Add by ninekrit
define ('_INSTALL_DB_JS_WARNING', '您确定所有的设置都正确吗?\nMambo现在将根据您提供的设置建立数据库');
define ('_INSTALL_DB_SECTION', "MySQL 数据库配置:");
define ('_INSTALL_DB_HOSTNAME', "MySQL 主机名称");
define ('_INSTALL_DB_HOSTNAME_DESCRIPTION', '通常为 localhost');
define ('_INSTALL_DB_USERNAME', "MySQL 用户名");
define('_INSTALL_DB_USERNAME_DESC', "使用 root 用户或者空间商提供的用户名");
define ('_INSTALL_DB_PASSWORD', "MySQL 密码");
define ('_INSTALL_DB_BASENAME', "MySQL 数据库名称");
define ('_INSTALL_DB_PREFIX', "MySQL 数据表前缀");
define ('_INSTALL_DB_PREFIX_DESC', "有些虚拟主机只有一个数据库，我们可以用不同的表前缀来区分和安装多个曼波系统。<br />注意：不能用表前缀 'old_' ，因为这用于备份数据表。");
define ('_INSTALL_DB_DROPTABLES', "删除旧的数据表？");
define ('_INSTALL_DB_BACKUP', "备份旧的数据表？");
define ('_INSTALL_DB_BACKUP_DESCRIPTION', "保留之前安装的曼波系统数据库，表前缀将改为 old_");
define ('_INSTALL_DB_SAMPLE_DATA', "安装样本数据？");
define ('_INSTALL_DB_SAMPLE_DATA_DESC',"样本数据能让您快速了解曼波整站系统，如果您不熟悉曼波，请不要取消！");


//--Install2.php
define ('_INSTALL_DB_ERROR1', "数据库设置错误或尚未设置。");
define ('_INSTALL_DB_ERROR2', "MySql用户名或密码错误。");
define ('_INSTALL_DB_ERROR3', "尚未填写数据库名称。");
define ('_INSTALL_DB_ERROR4', "数据库错误: ");
define ('INSTALL_DB_ERROR5', "提供的数据库密码不匹配，请再试一次。");
define ('_INSTALL_DB_DATAERROR', "数据库插入数据出错!<br />无法继续安装。");
define ('_INSTALL_DB_LOGERROR', "<br /><br />错误记录:<br />\n");

define ('_INSTALL_SITE_NONAME', "尚未输入网站名称");
define ('_INSTALL_JS_SITENAME', "请输入站点名称");
define ('_INSTALL_JS_SITEURL', "请输入站点网址");
define ('_INSTALL_JS_PATH', "请输入站点的绝对路径");
define ('_INSTALL_JS_EMAIL', "请输入站点管理员的联络Email");
define ('_INSTALL_JS_PASSWORD', "请输入管理员密码");
define ('_INSTALL_SITE_SECTION', "设置站点的名称、网址、绝对路径和管理员Email");
define ('_INSTALL_SITE_DESCRIPTION', "通常，默认的网址和绝对路径都是正确的，请不要修改。如果不正确，请咨询空间商或者管理员。");
define ('_INSTALL_SITE_NAME', "站点名称");
define ('_INSTALL_SITE_PATH', "绝对路径");
define ('_INSTALL_SITE_URL', "站点网址");
define ('_INSTALL_SUPERADMIN_EMAIL', "管理员Email");
define ('_INSTALL_SUPERADMIN_PASSWORD', "管理员密码");
define ('_INSTALL_ADMIN_PW','[注: 建议把密码改为你想要的]');

//--Install3.php
define ('_INSTALL_JS_CHECKEMAIL', "必须提供一个有效的Email地址。");
define ('_INSTALL_JS_CHECKDB', "数据库设置错误或尚未设置");
define ('_INSTALL_JS_CHECKSITENAME', "请输入站点名称");
define ('_INSTALL_CONF_SITE_MAINTAIN', "'本站正在维护当中。<br /> 请稍候再来。'");
define ('_INSTALL_CONF_SITE_UNAVAILABLE', "'本站临时出现问题。<br /> 请通知管理员。'");
define ('_INSTALL_CONF_METADESC', "'Mambo - 曼波智能建站系统'");
define ('_INSTALL_CONF_METAKEYS', "'mambo, Mambo, Mambo中国, mambochina, mambo中国, php, mysql, 智能建站, 自助建站'");
define ('_INSTALL_CONF_LANGUAGE_REF', "zh_CN");
define ('_INSTALL_CHMOD_DIR', "<u>提示</u>: 目录权限成功更改。");
define ('_INSTALL_CHMOD_DIR_FAIL', "<u>提示</u>: 目录权限无法更改，请手工更改以下目录的权限为0777:<br />");
define ('_INSTALL_JS_CHECKURL', "尚未输入站点网址");
define ('_INSTALL_CONGRATULATION', "恭喜你，" . _MAMBORS_VERSION . "安装成功！");
define ('_INSTALL_DESCRIPTION', "<p>点击“浏览站点”就可以浏览你的Mambo站了。或者点击“管理站点”进行管理后台登录。</p>");
define ('_INSTALL_LOGIN', "管理员帐号密码");
define ('_INSTALL_ADMIN_USERNAME', "用户名: admin");
define ('_INSTALL_ADMIN_PASSWORD', "密码: ");
define ('_INSTALL_VIEWSITE', "浏览站点");
define ('_INSTALL_LOGINADMIN', "管理站点");
define ('_INSTALL_ALERT', '您的configuration.php配置文件或目录不可写，请复制下框的内容，保存为configuration.php，然后上传到服务器的Mambo目录中。');

define ('_INSTALL_MAIL_DEL_INSTALLDIR','注意: 为了安全起见，请删除 installation 目录，包括其中的所有文件和子目录!');
define ('_INSTALL_MAIL_DEL_INSTALLDIR_RENAME','注意: "installation" 目录已改名为 " %s "，一旦不再需要，请立即删除它！'); // +++++ new

?>
