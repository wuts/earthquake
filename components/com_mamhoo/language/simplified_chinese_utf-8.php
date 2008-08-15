<?php
/**
* @version $Id: simplified_chinese_utf-8.php,v 3.0  2007-05-31
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
DEFINE('_MAMHOO','曼虎');
DEFINE('_MAMHOO_USER_MANAGE','曼虎用户管理');
DEFINE('_MAMHOO_DETAILS','曼虎用户资料');
DEFINE('_MAMHOO_CORE_DETAILS','基本资料');
DEFINE('_MAMHOO_EXTENDED_DETAILS','扩展资料');
DEFINE('_MAMHOO_STORE_FAILED','保存失败');
DEFINE('_MAMHOO_CONFIG','曼虎用户扩展设置');
DEFINE('_MAMHOO_ABOUT','关于曼虎');
DEFINE('_MAMHOO_LABEL','标签');
DEFINE('_MAMHOO_SHOW','显示');
DEFINE('_MAMHOO_TYPE','类型');
DEFINE('_MAMHOO_REQUIRED','必填');
DEFINE('_MAMHOO_SIZE','长度');
DEFINE('_MAMHOO_INITIAL','初始值');
DEFINE('_MAMHOO_ISREQUIRED',' 为必填项！');

DEFINE('_MAMHOO_FILTER', ' 筛选');
DEFINE('_MAMHOO_NB', '编号');
DEFINE('_MAMHOO_USERS_NAME', '名称');
DEFINE('_MAMHOO_USERS_USERNAME', '用户名');
DEFINE('_MAMHOO_USERS_LOG_IN', '已登录');
DEFINE('_MAMHOO_USERS_GROUP', '群组');
DEFINE('_MAMHOO_USERS_EMAIL', '电子邮件');
DEFINE('_MAMHOO_USERS_REGISTER', '注册日期');
DEFINE('_MAMHOO_USERS_LAST', '最近访问');
DEFINE('_MAMHOO_USERS_ENABLED', '启用');
DEFINE('_MAMHOO_USERS_BLOCKED', '封锁');

DEFINE('_MAMHOO_USERS_NAME_MUST', '必须输入名称。');
DEFINE('_MAMHOO_USERS_USERNAME_MUST', '必须输入用户名。');
DEFINE('_MAMHOO_USERS_USERNAME_INVALID', '用户名包含无效字符，或长度不够。');
DEFINE('_MAMHOO_USERS_EMAIL_MUST', '必须输入Email地址。');
DEFINE('_MAMHOO_USERS_ASSIGN', '必须分配用户到一个群组。');
DEFINE('_MAMHOO_USERS_NO_MATCH', '密码不匹配');
DEFINE('_MAMHOO_EDIT', '编辑');
DEFINE('_MAMHOO_NEW', '新增');
DEFINE('_MAMHOO_USERS_USERINFO', '用户资料');
DEFINE('_MAMHOO_USERS_PASS', '新密码');
DEFINE('_MAMHOO_USERS_VERIFY', '密码确认');
DEFINE('_MAMHOO_USERS_BLOCK', '封锁用户');
DEFINE('_MAMHOO_USERS_SUBMI', '接收通知邮件');
DEFINE('_MAMHOO_USERS_REG_DATE', '注册日期');
DEFINE('_MAMHOO_USERS_VISIT_DATE', '最近访问');

//administrator/components/com_mamhoo/admin.mamhoo.php
DEFINE('_MAMHOO_USERS_SUPER_ADMIN', 'Super Administrator');
DEFINE('_MAMHOO_ITEM_SEL_DEL', '选择条目来删除');
DEFINE('_MAMHOO_SEL_ITEM', '选择条目来');
DEFINE('_MAMHOO_USERS_CANNOT', '不能删除超级管理员');
DEFINE('_MAMHOO_USERS_NOT_DEL_SELF', '你不能删除你自己！');
DEFINE('_MAMHOO_USERS_NOT_DEL_ADMIN', '你不能删除其他管理员，只有超级管理员才具有这个权限');
DEFINE('_MAMHOO_FLOGOUT_SUCC','强制退出成功！');
DEFINE('_MAMHOO_SELECT_USER','请先选择用户！');
DEFINE('_MAMHOO_CONFIG_SAVE','曼虎设置已保存');

//administrator/components/com_mamhoo/toolbar.mamhoo.html.php
DEFINE('_MAMHOO_FLOGOUT','强制退出');

//administrator/components/com_mamhoo/install.mamhoo.php
DEFINE('_MAMHOO_INST_UNINST_MAMHOOKS','安装/卸载曼虎钩子');
DEFINE('_MAMHOO_USER_DETAILS','曼虎个人资料');
DEFINE('_MAMHOO_CHECK_IN','曼虎放回条目');
DEFINE('_MAMHOO_COMPONENT','曼虎组件');
DEFINE('_MAMHOO_LICENSE','Copyright &copy; 2007 <a href="http://www.mamhoo.com/">mamhoo.com</a>，曼虎组件是免费的自由软件，遵循 GNU/GPL 开源许可协议</a>.');
DEFINE('_MAMHOO_INST_SUCC','安装: <font color="green">成功！</font>');
DEFINE('_MAMHOO_INST_DESC','安装程序取消发布了用户菜单项：`个人资料`');

//administrator/components/com_mamhoo/uninstall.mamhoo.php
DEFINE('_MAMHOO_UNINST_SUCC','卸载: <font color="green">成功！</font>');
DEFINE('_MAMHOO_UNINST_DESC','卸载程序恢复发布了用户菜单项：`个人资料`');


//administrator/components/com_mamhoo/installer/mamhook.html.php
DEFINE('_MAMHOO_INSTALL_MAMHOOKS','曼虎钩子');
DEFINE('_MAMHOO_INSTALL_CORE','只显示能被卸载的曼虎钩子 - 核心的曼虎钩子是不能删除的');
DEFINE('_MAMHOO_INSTALL_MAMHOOK','曼虎钩子');
DEFINE('_MAMHOO_INSTALL_TYPE','类型');
DEFINE('_MAMHOO_INSTALL_AUTHOR','作者');
DEFINE('_MAMHOO_INSTALL_VERSION','版本');
DEFINE('_MAMHOO_INSTALL_DATE','日期');
DEFINE('_MAMHOO_INSTALL_AUTH_MAIL','Email');
DEFINE('_MAMHOO_INSTALL_AUTH_URL','网址');
DEFINE('_MAMHOO_INSTALL_NO_MAMHOOKS','尚未安装核心的或定制的曼虎钩子。');
DEFINE('_MAMHOO_INSTALL_ADDON_CONFIG','第三方系统配置');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX','第三方系统表前缀');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH','第三方系统相对路径');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_EG',' ( 例如：phpbb_ )');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH_EG',' ( 例如 addons/phpbb2 )');
DEFINE('_MAMHOO_INSTALL_ADDON_NEXT','下一步');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_REQUIRED','请输入第三方系统表前缀！');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_INVALID','无效的第三方系统表前缀！');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH_REQUIRED','请输入第三方系统相对路径！');
DEFINE('_MAMHOO_INSTALL_ADDON_PATH_NOTEXIST','第三方系统路径不存在： ');

DEFINE('_MAMHOO_INSTALL_WRITABLE', '可写');
DEFINE('_MAMHOO_INSTALL_UNWRITABLE', '不可写');
DEFINE('_MAMHOO_INSTALL_CONTINUE', '继续 ...');
DEFINE('_MAMHOO_INSTALL_UPLOAD_PACK_FILE', '上传安装包');
DEFINE('_MAMHOO_INSTALL_PACK_FILE', '安装包：');
DEFINE('_MAMHOO_INSTALL_UPL_INSTALL', '上传文件 &amp; 安装');
DEFINE('_MAMHOO_INSTALL_FROM_DIR', '从目录安装');
DEFINE('_MAMHOO_INSTALL_DIR', '安装目录：');
DEFINE('_MAMHOO_INSTALL_DO_INSTALL', '安装');

//administrator/components/com_mamhoo/installer/mamhook.php
DEFINE('_MAMHOO_INSTALL_INSTALL_MAMHOOK','安装曼虎钩子');

DEFINE('_MAMHOO_INSTALL_NOT_FOUND', '钩子的安装文件未找到');
DEFINE('_MAMHOO_INSTALL_NOT_AVAIL', '钩子的安装文件不可用');
DEFINE('_MAMHOO_INSTALL_ENABLE_MSG', '文件上传功能未启用，安装无法继续。请使用“从目录安装”的方法来安装。');
DEFINE('_MAMHOO_INSTALL_ERROR_MSG_TITLE', '安装 - 错误');
DEFINE('_MAMHOO_INSTALL_ZLIB_MSG', 'zlib未安装，，安装无法继续。');
DEFINE('_MAMHOO_INSTALL_NOFILE_MSG', '尚未选择文件');
DEFINE('_MAMHOO_INSTALL_NEWMODULE_ERROR_MSG_TITLE', '上传新模块 - 错误');
DEFINE('_MAMHOO_INSTALL_UPLOAD_PRE', '上传 ');
DEFINE('_MAMHOO_INSTALL_UPLOAD_POST', ' - 上传失败');
DEFINE('_MAMHOO_INSTALL_UPLOAD_POST2', ' -  上传错误');
DEFINE('_MAMHOO_INSTALL_SUCCESS', '成功');
DEFINE('_MAMHOO_INSTALL_ERROR', '错误');
DEFINE('_MAMHOO_INSTALL_FAILED', '失败');
DEFINE('_MAMHOO_INSTALL_SELECT_DIR', '请选择目录');
DEFINE('_MAMHOO_INSTALL_UPLOAD_NEW', '上传新');
DEFINE('_MAMHOO_INSTALL_FAIL_PERMISSION', '无法改变上传文件的权限。');
DEFINE('_MAMHOO_INSTALL_FAIL_MOVE', '无法移动上传文件到<code>/media</code>目录。');
DEFINE('_MAMHOO_INSTALL_FAIL_WRITE', '上传失败 - <code>/media</code> 目录不可写。');
DEFINE('_MAMHOO_INSTALL_FAIL_EXIST', '上传失败 - <code>/media</code> 目录不存在。');

//administrator/components/com_mamhoo/installer/mamhook.class.php
DEFINE('_MAMHOO_INSTALL_MAMHOOK_CONFIG_EXISTS','曼虎钩子配置文件 " %s " 已经存在！');
DEFINE('_MAMHOO_INSTALL_INC_CREATE_ERROR','无法创建inc文件 " %s "！');
DEFINE('_MAMHOO_INSTALL_INC_WRITE_ERROR','无法写入inc文件 " %s "！');
DEFINE('_MAMHOO_INSTALL_DIR_CREATE_ERROR','无法创建目录 " %s "！');
DEFINE('_MAMHOO_INSTALL_NO_MARKED','没有文件标志为 mamhook 文件');
DEFINE('_MAMHOO_INSTALL_SQL_ERROR','SQL 错误: ');
DEFINE('_MAMHOO_INSTALL_MAMHOOK_EXISTS','曼虎钩子 " %s " 已经存在！');
DEFINE('_MAMHOO_INSTALL_UNINST_ERROR','卸载 - 错误');
DEFINE('_MAMHOO_INSTALL_FOLDER_EMPTY','Folder 字段内容为空，无法删除文件');
DEFINE('_MAMHOO_INSTALL_DELETING','<br />删除: ');
DEFINE('_MAMHOO_INSTALL_DELETING_XML','删除 XML 文件: ');
DEFINE('_MAMHOO_INSTALL_CORE_NOT_UNINST',' 是核心元素，不能卸载。<br />如果不想使用的话，可以取消发布它。');
DEFINE('_MAMHOO_INSTALL_CHK_DIR_NOT_EXISTS','目录不存在：<BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_DIR_NOT_WRITABLE','目录不可写：<BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_FILE_NOT_EXISTS','文件不存在：<BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_FILE_NOT_WRITABLE','文件不可写：<BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CMD_OPENFIRST','请先处理命令 "OPEN" ，再处理命令 "%s" ！');
DEFINE('_MAMHOO_INSTALL_CMD_FINDFIRST','请先处理命令 "FIND" ，再处理命令 "%s" ！');
DEFINE('_MAMHOO_INSTALL_CMD_READERROR','无法读取文件："%s" ！');
DEFINE('_MAMHOO_INSTALL_CMD_NOSEARCH','没有条件来搜索！');
DEFINE('_MAMHOO_INSTALL_CMD_NOMATCHED','文件内容没有匹配：');
DEFINE('_MAMHOO_INSTALL_CMD_CREATEERROR','无法创建文件："%s" ！');
DEFINE('_MAMHOO_INSTALL_CMD_WRITEERROR','无法写入文件："%s" ！');

//components/com_mamhoo/mamhoo.php
DEFINE('_MAMHOO_USER_NOT_EXISTS','用户不存在！');

?>