<?php
/**
* @version $Id: traditional_chinese_utf-8.php,v 3.0  2007-05-31
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
DEFINE('_MAMHOO_USER_MANAGE','曼虎用戶管理');
DEFINE('_MAMHOO_DETAILS','曼虎用戶資料');
DEFINE('_MAMHOO_CORE_DETAILS','基本資料');
DEFINE('_MAMHOO_EXTENDED_DETAILS','擴展資料');
DEFINE('_MAMHOO_STORE_FAILED','保存失敗');
DEFINE('_MAMHOO_CONFIG','曼虎用戶擴展設置');
DEFINE('_MAMHOO_ABOUT','關於曼虎');
DEFINE('_MAMHOO_LABEL','標籤');
DEFINE('_MAMHOO_SHOW','顯示');
DEFINE('_MAMHOO_TYPE','類型');
DEFINE('_MAMHOO_REQUIRED','必填');
DEFINE('_MAMHOO_SIZE','長度');
DEFINE('_MAMHOO_INITIAL','初始值');
DEFINE('_MAMHOO_ISREQUIRED',' 為必填項！');

DEFINE('_MAMHOO_FILTER', ' 篩選');
DEFINE('_MAMHOO_NB', '編號');
DEFINE('_MAMHOO_USERS_NAME', '名稱');
DEFINE('_MAMHOO_USERS_USERNAME', '用戶名');
DEFINE('_MAMHOO_USERS_LOG_IN', '已登錄');
DEFINE('_MAMHOO_USERS_GROUP', '群組');
DEFINE('_MAMHOO_USERS_EMAIL', '電子郵件');
DEFINE('_MAMHOO_USERS_REGISTER', '註冊日期');
DEFINE('_MAMHOO_USERS_LAST', '最近訪問');
DEFINE('_MAMHOO_USERS_ENABLED', '啟用');
DEFINE('_MAMHOO_USERS_BLOCKED', '封鎖');

DEFINE('_MAMHOO_USERS_NAME_MUST', '必須輸入名稱。');
DEFINE('_MAMHOO_USERS_USERNAME_MUST', '必須輸入用戶名。');
DEFINE('_MAMHOO_USERS_USERNAME_INVALID', '用戶名包含無效字符，或長度不夠。');
DEFINE('_MAMHOO_USERS_EMAIL_MUST', '必須輸入Email地址。');
DEFINE('_MAMHOO_USERS_ASSIGN', '必須分配用戶到一個群組。');
DEFINE('_MAMHOO_USERS_NO_MATCH', '密碼不匹配');
DEFINE('_MAMHOO_EDIT', '編輯');
DEFINE('_MAMHOO_NEW', '新增');
DEFINE('_MAMHOO_USERS_USERINFO', '用戶資料');
DEFINE('_MAMHOO_USERS_PASS', '新密碼');
DEFINE('_MAMHOO_USERS_VERIFY', '密碼確認');
DEFINE('_MAMHOO_USERS_BLOCK', '封鎖用戶');
DEFINE('_MAMHOO_USERS_SUBMI', '接收通知郵件');
DEFINE('_MAMHOO_USERS_REG_DATE', '註冊日期');
DEFINE('_MAMHOO_USERS_VISIT_DATE', '最近訪問');

//administrator/components/com_mamhoo/admin.mamhoo.php
DEFINE('_MAMHOO_USERS_SUPER_ADMIN', 'Super Administrator');
DEFINE('_MAMHOO_ITEM_SEL_DEL', '選擇條目來刪除');
DEFINE('_MAMHOO_SEL_ITEM', '選擇條目來');
DEFINE('_MAMHOO_USERS_CANNOT', '不能刪除超級管理員');
DEFINE('_MAMHOO_USERS_NOT_DEL_SELF', '你不能刪除你自己！');
DEFINE('_MAMHOO_USERS_NOT_DEL_ADMIN', '你不能刪除其他管理員，只有超級管理員才具有這個權限');
DEFINE('_MAMHOO_FLOGOUT_SUCC','強制退出成功！');
DEFINE('_MAMHOO_SELECT_USER','請先選擇用戶！');
DEFINE('_MAMHOO_CONFIG_SAVE','曼虎設置已保存');

//administrator/components/com_mamhoo/toolbar.mamhoo.html.php
DEFINE('_MAMHOO_FLOGOUT','強制退出');

//administrator/components/com_mamhoo/install.mamhoo.php
DEFINE('_MAMHOO_INST_UNINST_MAMHOOKS','安裝/卸載曼虎鉤子');
DEFINE('_MAMHOO_USER_DETAILS','曼虎個人資料');
DEFINE('_MAMHOO_CHECK_IN','曼虎放回條目');
DEFINE('_MAMHOO_COMPONENT','曼虎組件');
DEFINE('_MAMHOO_LICENSE','Copyright &copy; 2007 <a href="http://www.mamhoo.com/">mamhoo.com</a>，曼虎組件是免費的自由軟件，遵循 GNU/GPL 開源許可協議</a>.');
DEFINE('_MAMHOO_INST_SUCC','安裝: <font color="green">成功！</font>');
DEFINE('_MAMHOO_INST_DESC','安裝程序取消發佈了用戶菜單項：`個人資料`');

//administrator/components/com_mamhoo/uninstall.mamhoo.php
DEFINE('_MAMHOO_UNINST_SUCC','卸載: <font color="green">成功！</font>');
DEFINE('_MAMHOO_UNINST_DESC','卸載程序恢復發佈了用戶菜單項：`個人資料`');


//administrator/components/com_mamhoo/installer/mamhook.html.php
DEFINE('_MAMHOO_INSTALL_MAMHOOKS','曼虎鉤子');
DEFINE('_MAMHOO_INSTALL_CORE','只顯示能被卸載的曼虎鉤子 - 核心的曼虎鉤子是不能刪除的');
DEFINE('_MAMHOO_INSTALL_MAMHOOK','曼虎鉤子');
DEFINE('_MAMHOO_INSTALL_TYPE','類型');
DEFINE('_MAMHOO_INSTALL_AUTHOR','作者');
DEFINE('_MAMHOO_INSTALL_VERSION','版本');
DEFINE('_MAMHOO_INSTALL_DATE','日期');
DEFINE('_MAMHOO_INSTALL_AUTH_MAIL','Email');
DEFINE('_MAMHOO_INSTALL_AUTH_URL','網址');
DEFINE('_MAMHOO_INSTALL_NO_MAMHOOKS','尚未安裝核心的或定制的曼虎鉤子。');
DEFINE('_MAMHOO_INSTALL_ADDON_CONFIG','第三方系統配置');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX','第三方系統表前綴');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH','第三方系統相對路徑');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_EG',' ( 例如：phpbb_ )');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH_EG',' ( 例如 addons/phpbb2 )');
DEFINE('_MAMHOO_INSTALL_ADDON_NEXT','下一步');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_REQUIRED','請輸入第三方系統表前綴！');
DEFINE('_MAMHOO_INSTALL_ADDON_TABLEPREFIX_INVALID','無效的第三方系統表前綴！');
DEFINE('_MAMHOO_INSTALL_ADDON_RELATIVE_PATH_REQUIRED','請輸入第三方系統相對路徑！');
DEFINE('_MAMHOO_INSTALL_ADDON_PATH_NOTEXIST','第三方系統路徑不存在： ');

DEFINE('_MAMHOO_INSTALL_WRITABLE', '可寫');
DEFINE('_MAMHOO_INSTALL_UNWRITABLE', '不可寫');
DEFINE('_MAMHOO_INSTALL_CONTINUE', '繼續 ...');
DEFINE('_MAMHOO_INSTALL_UPLOAD_PACK_FILE', '上傳安裝包');
DEFINE('_MAMHOO_INSTALL_PACK_FILE', '安裝包：');
DEFINE('_MAMHOO_INSTALL_UPL_INSTALL', '上傳文件 &amp; 安裝');
DEFINE('_MAMHOO_INSTALL_FROM_DIR', '從目錄安裝');
DEFINE('_MAMHOO_INSTALL_DIR', '安裝目錄：');
DEFINE('_MAMHOO_INSTALL_DO_INSTALL', '安裝');

//administrator/components/com_mamhoo/installer/mamhook.php
DEFINE('_MAMHOO_INSTALL_INSTALL_MAMHOOK','安裝曼虎鉤子');

DEFINE('_MAMHOO_INSTALL_NOT_FOUND', '鉤子的安裝文件未找到');
DEFINE('_MAMHOO_INSTALL_NOT_AVAIL', '鉤子的安裝文件不可用');
DEFINE('_MAMHOO_INSTALL_ENABLE_MSG', '文件上傳功能未啟用，安裝無法繼續。請使用「從目錄安裝」的方法來安裝。');
DEFINE('_MAMHOO_INSTALL_ERROR_MSG_TITLE', '安裝 - 錯誤');
DEFINE('_MAMHOO_INSTALL_ZLIB_MSG', 'zlib未安裝，，安裝無法繼續。');
DEFINE('_MAMHOO_INSTALL_NOFILE_MSG', '尚未選擇文件');
DEFINE('_MAMHOO_INSTALL_NEWMODULE_ERROR_MSG_TITLE', '上傳新模塊 - 錯誤');
DEFINE('_MAMHOO_INSTALL_UPLOAD_PRE', '上傳 ');
DEFINE('_MAMHOO_INSTALL_UPLOAD_POST', ' - 上傳失敗');
DEFINE('_MAMHOO_INSTALL_UPLOAD_POST2', ' -  上傳錯誤');
DEFINE('_MAMHOO_INSTALL_SUCCESS', '成功');
DEFINE('_MAMHOO_INSTALL_ERROR', '錯誤');
DEFINE('_MAMHOO_INSTALL_FAILED', '失敗');
DEFINE('_MAMHOO_INSTALL_SELECT_DIR', '請選擇目錄');
DEFINE('_MAMHOO_INSTALL_UPLOAD_NEW', '上傳新');
DEFINE('_MAMHOO_INSTALL_FAIL_PERMISSION', '無法改變上傳文件的權限。');
DEFINE('_MAMHOO_INSTALL_FAIL_MOVE', '無法移動上傳文件到<code>/media</code>目錄。');
DEFINE('_MAMHOO_INSTALL_FAIL_WRITE', '上傳失敗 - <code>/media</code> 目錄不可寫。');
DEFINE('_MAMHOO_INSTALL_FAIL_EXIST', '上傳失敗 - <code>/media</code> 目錄不存在。');

//administrator/components/com_mamhoo/installer/mamhook.class.php
DEFINE('_MAMHOO_INSTALL_MAMHOOK_CONFIG_EXISTS','曼虎鉤子配置文件 " %s " 已經存在！');
DEFINE('_MAMHOO_INSTALL_INC_CREATE_ERROR','無法創建inc文件 " %s "！');
DEFINE('_MAMHOO_INSTALL_INC_WRITE_ERROR','無法寫入inc文件 " %s "！');
DEFINE('_MAMHOO_INSTALL_DIR_CREATE_ERROR','無法創建目錄 " %s "！');
DEFINE('_MAMHOO_INSTALL_NO_MARKED','沒有文件標誌為 mamhook 文件');
DEFINE('_MAMHOO_INSTALL_SQL_ERROR','SQL 錯誤: ');
DEFINE('_MAMHOO_INSTALL_MAMHOOK_EXISTS','曼虎鉤子 " %s " 已經存在！');
DEFINE('_MAMHOO_INSTALL_UNINST_ERROR','卸載 - 錯誤');
DEFINE('_MAMHOO_INSTALL_FOLDER_EMPTY','Folder 字段內容為空，無法刪除文件');
DEFINE('_MAMHOO_INSTALL_DELETING','<br />刪除: ');
DEFINE('_MAMHOO_INSTALL_DELETING_XML','刪除 XML 文件: ');
DEFINE('_MAMHOO_INSTALL_CORE_NOT_UNINST',' 是核心元素，不能卸載。<br />如果不想使用的話，可以取消發佈它。');
DEFINE('_MAMHOO_INSTALL_CHK_DIR_NOT_EXISTS','目錄不存在：<BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_DIR_NOT_WRITABLE','目錄不可寫：<BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_FILE_NOT_EXISTS','文件不存在：<BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CHK_FILE_NOT_WRITABLE','文件不可寫：<BR /> %s ');
DEFINE('_MAMHOO_INSTALL_CMD_OPENFIRST','請先處理命令 "OPEN" ，再處理命令 "%s" ！');
DEFINE('_MAMHOO_INSTALL_CMD_FINDFIRST','請先處理命令 "FIND" ，再處理命令 "%s" ！');
DEFINE('_MAMHOO_INSTALL_CMD_READERROR','無法讀取文件："%s" ！');
DEFINE('_MAMHOO_INSTALL_CMD_NOSEARCH','沒有條件來搜索！');
DEFINE('_MAMHOO_INSTALL_CMD_NOMATCHED','文件內容沒有匹配：');
DEFINE('_MAMHOO_INSTALL_CMD_CREATEERROR','無法創建文件："%s" ！');
DEFINE('_MAMHOO_INSTALL_CMD_WRITEERROR','無法寫入文件："%s" ！');

//components/com_mamhoo/mamhoo.php
DEFINE('_MAMHOO_USER_NOT_EXISTS','用戶不存在！');

?>