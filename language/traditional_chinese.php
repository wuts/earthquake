<?php
/**
* @version $Id: traditional_chinese.php,v 1.8  2007/12/23 11:27:52 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2007 Mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software based on Mambo
* Powered By mambochina.net & mambors.org
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( '禁止直接訪問本文件！' );

// Name of CMS
DEFINE('_MAMBORS','曼波整站系統');
DEFINE('_MAMBORS_VERSION', _MAMBORS . $_VERSION->RELEASE . '.' . $_VERSION->DEV_LEVEL );
DEFINE('_D_MAMBORS','<a href="http://www.mambochina.net" target="_blank">' . _MAMBORS . '</a> 基於 <a href="http://mambo-foundation.org" target="_blank">Mambo</a> 開發，是免費的自由軟件，遵循 GNU/GPL 開源許可協議。<br />' . '<a href="http://www.mambochina.net" target="_blank">' . _MAMBORS_VERSION . '</a> 由 <a href="http://www.mambochina.net" target="_blank">Mambo中國</a> 和 <a href="http://www.mambors.org" target="_blank">Mambo Resource</a> 聯合增強開發。');

// Language and Encode of frontend language
DEFINE('_LANGUAGE','zh_TW');
DEFINE('_CHARSET','BIG5');
DEFINE('_ISO','charset=' . _CHARSET);

/** common */
DEFINE('_NOT_AUTH',"您無權訪問此資源");
DEFINE('_DO_LOGIN',"請登錄.");
DEFINE('_VALID_AZ09',"請輸入合法的%s. 不能有空格，長度大於%d個字符並且只包含0-9,a-z,A-Z。");
DEFINE('_CMN_YES',"是(Yes)");
DEFINE('_CMN_NO',"否(No)");
DEFINE('_CMN_SHOW','顯示');
DEFINE('_CMN_HIDE','隱藏');

DEFINE('_CMN_NAME',"名稱");
DEFINE('_CMN_DESCRIPTION',"描述");
DEFINE('_CMN_SAVE',"保存");
DEFINE('_CMN_CANCEL',"取消");
DEFINE('_CMN_PRINT',"打印");
DEFINE('_CMN_PDF',"輸出PDF");
DEFINE('_CMN_EMAIL',"E-mail");
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','上層結點');
DEFINE('_CMN_ORDERING',"排序");
DEFINE('_CMN_ACCESS',"權限級別");
DEFINE('_CMN_SELECT',"選擇");

DEFINE('_CMN_NEXT',"下一頁");
DEFINE('_CMN_NEXT_ARROW',"&gt;&gt;");
DEFINE('_CMN_PREV',"上一頁");
DEFINE('_CMN_PREV_ARROW',"&lt;&lt; ");

DEFINE('_CMN_SORT_NONE',"順序");
DEFINE('_CMN_SORT_ASC',"順序");
DEFINE('_CMN_SORT_DESC',"反序");

DEFINE('_CMN_NEW',"新建");
DEFINE('_CMN_NONE',"無");
DEFINE('_CMN_LEFT',"左對齊");
DEFINE('_CMN_RIGHT',"右對齊");
DEFINE('_CMN_CENTER',"居中");
DEFINE('_CMN_TOP','頂端');
DEFINE('_CMN_BOTTOM','底部');

DEFINE('_CMN_PUBLISHED',"已經發佈");
DEFINE('_CMN_UNPUBLISHED',"尚未發佈");

DEFINE('_CMN_EDIT_HTML','編輯 HTML');
DEFINE('_CMN_EDIT_CSS','編輯 CSS');
DEFINE('_CMN_DELETE','刪除');
DEFINE('_CMN_FOLDER',"目錄");
DEFINE('_CMN_SUBFOLDER',"子目錄");
DEFINE('_CMN_OPTIONAL',"可選");
DEFINE('_CMN_REQUIRED',"必須");

DEFINE('_CMN_CONTINUE',"繼續");

DEFINE('_CMN_NEW_ITEM_LAST','新建條目放在最後位置');
DEFINE('_CMN_NEW_ITEM_FIRST','新建條目放在最前位置');
DEFINE('_LOGIN_INCOMPLETE','請填寫姓名和密碼框.');
DEFINE('_LOGIN_BLOCKED','您的登錄被封鎖.請和管理員聯繫.');
DEFINE('_LOGIN_INCORRECT','用戶名或密碼不正確. 請再試一遍');
DEFINE('_LOGIN_NOADMINS','您不能登錄。系統尚未初始化.');
DEFINE('_CMN_JAVASCRIPT','警告！Javascript 功能必須打開，才能正常操作。');

DEFINE('_NEW_MESSAGE','有新短信。');
DEFINE('_MESSAGE_FAILED','用戶已經鎖住收件箱，短信發送失敗。');

DEFINE('_CMN_IFRAMES', '此選項將不能正常使用，非常遺憾，您的瀏覽器不支持嵌入楨(Inline Frames)');

DEFINE('_INSTALL_WARN','出於安全考慮，請完全刪除 installation 目錄中的所有文件和子目錄，然後刷新一下。');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>模版文件不存在！請查找：</b></font>');
DEFINE('_NO_PARAMS','此條目沒有參數');
DEFINE('_HANDLER','處理器未定義類型。');

/** mambots */
DEFINE('_TOC_JUMPTO',"跳轉");

/**  content */
DEFINE('_READ_MORE','閱讀全文...');
DEFINE('_READ_MORE_REGISTER','註冊後閱讀全文...');
DEFINE('_MORE','更多...');
DEFINE('_ON_NEW_CONTENT', "一篇新文章由[ %s ]提交，標題[ %s ]，單元[ %s ]，分類[ %s ]" );
DEFINE('_SEL_CATEGORY','- 選擇分類 -');
DEFINE('_SEL_SECTION','- 選擇單元 -');
DEFINE('_SEL_AUTHOR','- 選擇作者 -');
DEFINE('_SEL_POSITION','- 選擇位置 -');
DEFINE('_SEL_TYPE','- 選擇類型 -');
DEFINE('_EMPTY_CATEGORY','分類是空的');
DEFINE('_EMPTY_BLOG','沒有條目來顯示');
DEFINE('_NOT_EXIST','您訪問的頁面不存在.<br />請從主菜單選擇連接進入.');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','投票');
DEFINE('_BUTTON_RESULTS','結果');
DEFINE('_USERNAME','用戶名');
DEFINE('_LOST_PASSWORD','忘記密碼');
DEFINE('_PASSWORD','密碼');
DEFINE('_BUTTON_LOGIN','登錄');
DEFINE('_BUTTON_LOGOUT','退出登錄');
DEFINE('_NO_ACCOUNT','沒有賬戶？');
DEFINE('_CREATE_ACCOUNT','馬上註冊');
DEFINE('_VOTE_POOR','差');
DEFINE('_VOTE_BEST','好');
DEFINE('_USER_RATING','用戶評分');
DEFINE('_RATE_BUTTON','評分');
DEFINE('_REMEMBER_ME','記住我');

/** contact.php */
DEFINE('_ENQUIRY','問候');
DEFINE('_ENQUIRY_TEXT','這是一封問候信，通過 %s 來自：');
DEFINE('_COPY_TEXT','這是您發送給 %s 經由 %s 的消息的副本');
DEFINE('_COPY_SUBJECT','複製：');
DEFINE('_THANK_MESSAGE','感謝您的來信！');
DEFINE('_CLOAKING','此郵件地址受spam bots保護，需要使用 Javascript 功能來查閱。');
DEFINE('_CONTACT_HEADER_NAME','名稱');
DEFINE('_CONTACT_HEADER_POS','職務');
DEFINE('_CONTACT_HEADER_EMAIL','Email');
DEFINE('_CONTACT_HEADER_PHONE','電話');
DEFINE('_CONTACT_HEADER_FAX','傳真');
DEFINE('_CONTACTS_DESC','網站聯繫人信息列表');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','聯繫人');
DEFINE('_EMAIL_DESCRIPTION','發送 Email 給聯繫人：');
DEFINE('_NAME_PROMPT',' 請輸入您的名字：');
DEFINE('_EMAIL_PROMPT',' 請輸入您的email地址：');
DEFINE('_MESSAGE_PROMPT',' 請輸入您的消息內容：');
DEFINE('_SEND_BUTTON','發送');
DEFINE('_CONTACT_FORM_NC','請確認表單完整正確.');
DEFINE('_CONTACT_TELEPHONE','電話: ');
DEFINE('_CONTACT_MOBILE','手機：');
DEFINE('_CONTACT_FAX','傳真: ');
DEFINE('_CONTACT_EMAIL','Email：');
DEFINE('_CONTACT_NAME','姓名：');
DEFINE('_CONTACT_POSITION','職務：');
DEFINE('_CONTACT_ADDRESS','地址：');
DEFINE('_CONTACT_MISC','備註：');
DEFINE('_CONTACT_SEL','選擇聯繫人：');
DEFINE('_CONTACT_NONE','沒有聯繫人信息列表。');
DEFINE('_EMAIL_A_COPY','把此消息複製一份到您自己的 Email 地址');
DEFINE('_CONTACT_DOWNLOAD_AS','下載當前數據為');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_PAGE','頁面');
DEFINE('_PN_OF',' 共 ');
DEFINE('_PN_START','第一頁');
DEFINE('_PN_PREVIOUS','上一頁');
DEFINE('_PN_NEXT','下一頁');
DEFINE('_PN_END','最後一頁');
DEFINE('_PN_DISPLAY_NR','顯示');
DEFINE('_PN_RESULTS','第');

/** emailfriend */
DEFINE('_EMAIL_TITLE','發email給朋友');
DEFINE('_EMAIL_FRIEND','發email給朋友。');
DEFINE('_EMAIL_FRIEND_ADDR','您朋友的email：');
DEFINE('_EMAIL_YOUR_NAME','您的姓名：');
DEFINE('_EMAIL_YOUR_MAIL','您的email：');
DEFINE('_SUBJECT_PROMPT',' 標題：');
DEFINE('_BUTTON_SUBMIT_MAIL','發送email');
DEFINE('_BUTTON_CANCEL','取消');
DEFINE('_EMAIL_ERR_NOINFO','您必須輸入有效的email地址.');
DEFINE('_EMAIL_MSG',' 來自 "%s" 站點的文章。這是您的朋友 %s ( %s )發送給您的。請通過以下鏈接訪問： %s');
DEFINE('_EMAIL_INFO','發送人：');
DEFINE('_EMAIL_SENT','已經發送給：');
DEFINE('_PROMPT_CLOSE','關閉');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' 投稿：');
DEFINE('_WRITTEN_BY', ' 作者：');
DEFINE('_LAST_UPDATED', '最近更新');
DEFINE('_BACK','返回');
DEFINE('_LEGEND','圖例');
DEFINE('_DATE','日期');
DEFINE('_ORDER_DROPDOWN','排序');
DEFINE('_HEADER_TITLE','標題');
DEFINE('_HEADER_AUTHOR','作者');
DEFINE('_HEADER_SUBMITTED','提交');
DEFINE('_HEADER_HITS','點擊');
DEFINE('_E_EDIT','編輯');
DEFINE('_E_ADD','新增');
DEFINE('_E_WARNUSER','請取消或者保存現在編輯的內容。');
DEFINE('_E_WARNTITLE','必須輸入標題');
DEFINE('_E_WARNTEXT','必須輸入引言');
DEFINE('_E_WARNCAT','請選擇一個分類');
DEFINE('_E_CONTENT','內容');
DEFINE('_E_TITLE','標題:');
DEFINE('_E_SECTION','單元:');
DEFINE('_E_CATEGORY','分類:');
DEFINE('_E_INTRO','摘要');
DEFINE('_E_MAIN','正文');
DEFINE('_E_MOSIMAGE','插入 {mosimage}');
DEFINE('_E_IMAGES','圖片');
DEFINE('_E_GALLERY_IMAGES','圖庫圖片');
DEFINE('_E_CONTENT_IMAGES','正文圖片');
DEFINE('_E_EDIT_IMAGE','編輯圖片');
DEFINE('_E_INSERT','插入');
DEFINE('_E_UP','向上');
DEFINE('_E_DOWN','向下');
DEFINE('_E_REMOVE','刪除');
DEFINE('_E_SOURCE','來源：');
DEFINE('_E_ALIGN','排列：');
DEFINE('_E_ALT','懸浮文字：');
DEFINE('_E_BORDER','邊框：');
DEFINE('_E_CAPTION','標題');
DEFINE('_E_APPLY','應用');
DEFINE('_E_PUBLISHING','發佈');
DEFINE('_E_STATE','狀態：');
DEFINE('_E_AUTHOR_ALIAS','作者別名：');
DEFINE('_E_ACCESS_LEVEL','權限級別：');
DEFINE('_E_ORDERING','排序：');
DEFINE('_E_START_PUB','開始發佈：');
DEFINE('_E_FINISH_PUB','完成發佈：');
DEFINE('_E_SHOW_FP','在首頁顯示：');
DEFINE('_E_HIDE_TITLE','隱藏標題：');
DEFINE('_E_METADATA','元數據');
DEFINE('_E_M_DESC','描述：');
DEFINE('_E_M_KEY','關鍵詞：');
DEFINE('_E_SUBJECT','標題：');
DEFINE('_E_EXPIRES','有效期：');
DEFINE('_E_VERSION','版本：');
DEFINE('_E_ABOUT','關於');
DEFINE('_E_CREATED','創建：');
DEFINE('_E_LAST_MOD','最後更新：');
DEFINE('_E_HITS','點擊：');
DEFINE('_E_SAVE','保存');
DEFINE('_E_CANCEL','取消');
DEFINE('_E_REGISTERED','僅註冊用戶可訪問');
DEFINE('_E_ITEM_INFO','頁面信息');
DEFINE('_E_ITEM_SAVED','頁面已成功保存。');
DEFINE('_ITEM_PREVIOUS','&lt; 上一篇');
DEFINE('_ITEM_NEXT','下一篇 &gt;');


/** content.php */
DEFINE('_ORDER_DROPDOWN_DA','日期順序');
DEFINE('_ORDER_DROPDOWN_DD','日期降序');
DEFINE('_ORDER_DROPDOWN_TA','標題順序');
DEFINE('_ORDER_DROPDOWN_TD','標題降序');
DEFINE('_ORDER_DROPDOWN_HA','點擊順序');
DEFINE('_ORDER_DROPDOWN_HD','點擊降序');
DEFINE('_ORDER_DROPDOWN_AUA','作者順序');
DEFINE('_ORDER_DROPDOWN_AUD','作者降序');
DEFINE('_ORDER_DROPDOWN_O','排序');
DEFINE('_SELECT_CAT','選擇分類');
DEFINE('_SELECT_SEC','選擇單元');

/** poll.php */
DEFINE('_ALERT_ENABLED','必須打開cookie!');
DEFINE('_ALREADY_VOTE','今天您已經投過一票了!');
DEFINE('_NO_SELECTION','您還沒做任何選擇，請重新投票');
DEFINE('_THANKS',"感謝您的投票!");
DEFINE('_SELECT_POLL',"請在列表中選擇投票");

/** classes/html/poll.php */
DEFINE('_JAN','一月');
DEFINE('_FEB','二月');
DEFINE('_MAR','三月');
DEFINE('_APR','四月');
DEFINE('_MAY','五月');
DEFINE('_JUN','六月');
DEFINE('_JUL','七月');
DEFINE('_AUG','八月');
DEFINE('_SEP','九月');
DEFINE('_OCT','十月');
DEFINE('_NOV','十一月');
DEFINE('_DEC','十二月');
DEFINE('_POLL_TITLE','調查結果');
DEFINE('_SURVEY_TITLE','調查標題');
DEFINE('_NUM_VOTERS','投票數');
DEFINE('_FIRST_VOTE','第一張投票');
DEFINE('_LAST_VOTE','最後一張投票');
DEFINE('_SEL_POLL','請選擇投票');
DEFINE('_NO_RESULTS','本次調查還沒有投票記錄。');

/** registration.php */
DEFINE('_ERROR_PASS','對不起，未找到該用戶');
DEFINE('_NEWPASS_MSG','用戶 $checkusername 使用此email\n'
.'來自$mosConfig_live_site 的用戶請求發送一個新密碼.\n\n'
.' 您的新密碼是：$newpass\n\n 如果您沒有請求發送新密碼，別擔心，只有您自己看見這封信，沒有其他人。'
.' 如果是誤發送密碼的話，請您用此新密碼登錄，然後再更改密碼。');
DEFINE('_NEWPASS_SUB','$_sitename ：： $checkusername 的新密碼');
DEFINE('_NEWPASS_SENT','新的用戶密碼已經創建並發送！');
DEFINE('_REGWARN_NAME','請輸入您的名稱。');
DEFINE('_REGWARN_UNAME','請輸入用戶名。');
DEFINE('_REGWARN_MAIL','請輸入有效的email地址。');
DEFINE('_REGWARN_PASS','請輸入一個有效的密碼. 不能有空格，長度大於6位，並且只包含 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','請再次輸入您的密碼.');
DEFINE('_REGWARN_VPASS2','兩次輸入的密碼不符,請重新輸入.');
DEFINE('_REGWARN_INUSE','這個用戶名已經在使用了,請另取一個用戶名.');
DEFINE('_REGWARN_EMAIL_INUSE', '此 e-mail 已經用來註冊了。如果您忘記密碼的話，請點擊 "忘記密碼" 鏈接，新的密碼將發送給你。');
DEFINE('_SEND_SUB','%s用戶的詳細資料在%s');
DEFINE('_USEND_MSG_ACTIVATE','%s，您好！

感謝你在 %s 註冊，你的帳戶已經創建，在使用之前必須先激活它。
要激活帳戶，請點擊下面的鏈接，或把它複製到瀏覽器中打開：
%s

激活後您可以用以下用戶名和密碼登錄 %s ：

Username - %s
Password - %s');
DEFINE('_USEND_MSG', "%s，您好！

感謝你在 %s 註冊。

您可以用註冊的用戶名和密碼登錄 %s 。");
DEFINE('_USEND_MSG_NOPASS','$name，您好！,\n\n您已經成為 $mosConfig_live_site 的用戶。\n'
.'請您用註冊的用戶名和密碼登錄$mosConfig_live_site。\n\n'
.'請不要回復這封信，這是系統自動發送的。\n');
DEFINE('_ASEND_MSG','%s，您好！

有個新用戶剛在 %s 註冊。
以下是詳細信息：

名稱 - %s
e-mail - %s
用戶名 - %s

請不要回復這封信，這是系統自動發送的。');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">註冊完成！</div><br />&nbsp;&nbsp;'
.'您現在可以登錄了。<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">註冊完成！</div><br />您現在可以登錄了。');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">註冊完成！</div><br />您的帳戶已經創建，激活鏈接已經發送到您的 e-mail 地址。收到e-mail後請點擊激活鏈接，激活您的帳戶，然後才能登錄系統。');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">激活完成！</div><br />您的帳戶已經成功激活，您可以用註冊的用戶名和密碼登錄。');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">無效的激活鏈接！</div><br />系統數據庫中不存在此帳戶，或者該帳戶已經激活了。');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','忘記密碼了？');
DEFINE('_NEW_PASS_DESC','請輸入用戶名和email地址,然後點擊[發送密碼]按鈕.<br />'
.'您將很快收到一封包含新密碼的email，使用新密碼來登錄。');
DEFINE('_PROMPT_UNAME','用戶名：');
DEFINE('_PROMPT_EMAIL','E-mail 地址：');
DEFINE('_BUTTON_SEND_PASS','發送密碼');
DEFINE('_REGISTER_TITLE','用戶註冊');
DEFINE('_REGISTER_NAME','名稱：');
DEFINE('_REGISTER_UNAME','用戶名：');
DEFINE('_REGISTER_EMAIL','E-mail：');
DEFINE('_REGISTER_PASS','密碼：');
DEFINE('_REGISTER_VPASS','密碼校驗：');
DEFINE('_REGISTER_REQUIRED','有 (*) 號的數據項是必填項。');
DEFINE('_BUTTON_SEND_REG','註冊');
DEFINE('_SENDING_PASSWORD','新密碼將發送到上述email地址。<br />收到新密碼後您可以登錄，然後修改密碼。');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','搜索');
DEFINE('_PROMPT_KEYWORD','搜索關鍵詞');
DEFINE('_SEARCH_MATCHES','返回 %d 個匹配結果');
DEFINE('_CONCLUSION','一共找到 $totalRows 條匹配的記錄. <b>$searchword</b> ');
DEFINE('_NOKEYWORD','沒有找到匹配的記錄');
DEFINE('_IGNOREKEYWORD','在搜索時忽略了一個或數個常見的關鍵詞');
DEFINE('_SEARCH_ANYWORDS','任意關鍵詞');
DEFINE('_SEARCH_ALLWORDS','所有關鍵詞');
DEFINE('_SEARCH_PHRASE','精確短語');
DEFINE('_SEARCH_NEWEST','新的排在前面');
DEFINE('_SEARCH_OLDEST','舊的排在前面');
DEFINE('_SEARCH_POPULAR','最流行的');
DEFINE('_SEARCH_ALPHABETICAL','字母順序');
DEFINE('_SEARCH_CATEGORY','單元/分類');

/** templates/*.php */
DEFINE('_DATE_FORMAT','Y-m-d');  //Uses PHP's DATE Command Format - Depreciated
/**
* Modify this line to reflect how you want the date to appear in your site
*
*e.g. DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y %H：%M"); //Uses PHP's strftime Command Format
*/
DEFINE('_DATE_FORMAT_LC',"%Y-%m-%d"); //Uses PHP's strftime Command Format
DEFINE('_DATE_FORMAT_LC2',"%Y-%m-%d %H:%M");
DEFINE('_SEARCH_BOX','搜索...');
DEFINE('_NEWSFLASH_BOX','快訊！');
DEFINE('_MAINMENU_BOX','主菜單');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','用戶菜單');
DEFINE('_HI','您好, ');

/** user.php */
DEFINE('_SAVE_ERR','請完整填寫要求的每一項.');
DEFINE('_THANK_SUB','感謝您的提交. 您提交的內容會在發佈到站點之前經過審核,請耐心等待.');
DEFINE('_UP_SIZE','您不能上傳超過15K的文件.');
DEFINE('_UP_EXISTS','名為 $userfile_name 的圖片已經存在.請重新命名您的文件,再試一次.');
DEFINE('_UP_COPY_FAIL','拷貝失敗');
DEFINE('_UP_TYPE_WARN','您只能上傳JPG或者GIF格式的圖片');
DEFINE('_MAIL_SUB','新的待審核文章');
DEFINE('_MAIL_MSG','您好, $adminName,\n\nA 有一篇新的文章待審核 $type, $title (作者：$author )'
.'來自站點： $mosConfig_live_site .\n'
.'請您登錄 $mosConfig_live_site/administrator 來審核這篇 $type.\n\n'
.'請不要回復這封信，這是系統自動發送的。\n');
DEFINE('_PASS_VERR1','如果您修改了您的密碼,請再輸入一次確認修改.');
DEFINE('_PASS_VERR2','如果您修改了您的密碼,請確認兩次輸入的內容一致.');
DEFINE('_UNAME_INUSE','此用戶名已經被佔用.');
DEFINE('_UPDATE','更新');
DEFINE('_USER_DETAILS_SAVE','您的設置已經保存。');
DEFINE('_USER_LOGIN','用戶登錄');

/** components/com_user */
DEFINE('_EDIT_TITLE','修改您的詳細信息');
DEFINE('_YOUR_NAME','姓名：');
DEFINE('_EMAIL','e-mail：');
DEFINE('_UNAME','用戶名：');
DEFINE('_PASS','密碼：');
DEFINE('_VPASS','密碼確認：');
DEFINE('_SUBMIT_SUCCESS','提交成功 ');
DEFINE('_SUBMIT_SUCCESS_DESC','你提交的內容已經交給了管理員.在發佈在站點上之前,需要經過審核.請耐心等待.');
DEFINE('_WELCOME','歡迎!');
DEFINE('_WELCOME_DESC','歡迎進入本站用戶區');
DEFINE('_CONF_CHECKED_IN','您取出的條目現在都已全部放回了.');
DEFINE('_CHECK_TABLE','檢查表');
DEFINE('_CHECKED_IN','已經放回 ');
DEFINE('_CHECKED_IN_ITEMS',' 條目');
DEFINE('_PASS_MATCH','密碼不符');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','必須給客戶選擇一個名稱。');
DEFINE('_BNR_CONTACT','必須給客戶選擇一個聯繫人。');
DEFINE('_BNR_VALID_EMAIL','必須給客戶選擇一個有效的E-mail地址。');
DEFINE('_BNR_CLIENT','必須選擇一個客戶，');
DEFINE('_BNR_NAME','必須給旗幟廣告選擇一個名稱。');
DEFINE('_BNR_IMAGE','必須給旗幟廣告選擇一幅圖片。');
DEFINE('_BNR_URL','必須給旗幟廣告選擇 URL地址，或自定義的代碼。');
/** components/com_login */
DEFINE('_ALREADY_LOGIN','您已經登錄過了!');
DEFINE('_LOGOUT','點擊這裡退出');
DEFINE('_LOGIN_TEXT','請登錄,您才能完全訪問本站'); 
DEFINE('_LOGIN_SUCCESS','登錄成功 ');
DEFINE('_LOGOUT_SUCCESS','退出成功 ');
DEFINE('_LOGIN_DESCRIPTION','請登錄，才能訪問個人區域。');
DEFINE('_LOGOUT_DESCRIPTION','您已經登錄到個人區域。');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','鏈接');
DEFINE('_WEBLINKS_DESC','下面是一些相關站點,請點擊鏈接進入.');
DEFINE('_HEADER_TITLE_WEBLINKS','鏈接');
DEFINE('_SECTION','分類：');
DEFINE('_SUBMIT_LINK','增加一個新鏈接');
DEFINE('_URL','地址：');
DEFINE('_URL_DESC','描述：');
DEFINE('_NAME','名稱：');
DEFINE('_WEBLINK_EXIST','已經有同名的鏈接存在，請修改重試.');
DEFINE('_WEBLINK_TITLE','網站鏈接必須有標題。');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','新聞導入名稱');
DEFINE('_FEED_ARTICLES','文章數');
DEFINE('_FEED_LINK','新聞導入鏈接');

/** whos_online.php */
DEFINE('_WE_HAVE', '現在有 ');
DEFINE('_AND', ' 和');
DEFINE('_GUEST_COUNT','$guest_array 位訪客');
DEFINE('_GUESTS_COUNT','$guest_array 位訪客');
DEFINE('_MEMBER_COUNT','$user_array 位會員');
DEFINE('_MEMBERS_COUNT','$user_array 位會員');
DEFINE('_ONLINE',' 在線');
DEFINE('_NONE','無人在線');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','時間');
DEFINE('_MEMBERS_STAT','用戶');
DEFINE('_HITS_STAT','點擊');
DEFINE('_NEWS_STAT','新聞');
DEFINE('_LINKS_STAT','鏈接');
DEFINE('_VISITORS','訪問量');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* 此菜單[主菜單]的第一個發佈的菜單項，默認為網站的`首頁` *');
DEFINE('_MAINMENU_DEL','* 你不能刪除此 菜單 請選擇適當的操作*');
DEFINE('_MENU_GROUP','* 有些菜單類型出現在一個以上的組中 *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', '新用戶資料' );
DEFINE('_NEW_USER_MESSAGE', '%s，您好！


管理員在 %s 新增了一個用戶。

以下是用戶名和密碼，用來登錄 %s：

用戶名 - %s
密碼 - %s


請不要回復這封信，這是系統自動發送的。');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "來自 '%s' 的信件

消息：
" );

/** includes/mamboxml.php */
DEFINE('_DONT_USE_IMAGE','- 不使用圖片 -');
DEFINE('_USE_DEFAULT_IMAGE','- 使用默認圖片 -');

/** global frontend translation string */
global $TR_STRS;
if (!isset($TR_STRS)){
	$TR_STRS = array();
}
$TR_STRS[strtolower('Banners')] = '橫幅廣告';
$TR_STRS[strtolower('Search')] = '搜索';
$TR_STRS[strtolower('Main Menu')] = '主菜單';
$TR_STRS[strtolower('User Menu')] = '用戶菜單';
$TR_STRS[strtolower('Other Menu')] = '其它菜單';
$TR_STRS[strtolower('Login Form')] = '登錄表單';
$TR_STRS[strtolower('Syndicate')] = 'RSS 聚合';
$TR_STRS[strtolower('Statistics')] = '統計';
$TR_STRS[strtolower('Template Chooser')] = '模版選擇器';
$TR_STRS[strtolower('Sections')] = '單元';
$TR_STRS[strtolower('Related Items')] = '相關文章';
$TR_STRS[strtolower('Wrapper')] = '嵌入頁面';
$TR_STRS[strtolower('Newsflash')] = '新聞快訊';
$TR_STRS[strtolower('Polls')] = '在線調查';
$TR_STRS[strtolower("Who's Online")] = "誰在線";
$TR_STRS[strtolower('Random Image')] = '隨機圖片';
$TR_STRS[strtolower('Top Menu')] = '頂部菜單';
$TR_STRS[strtolower('Latest News')] = '最新文章';
$TR_STRS[strtolower('Popular')] = '熱門文章';

?>
