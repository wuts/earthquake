<?php
/**
* @version $Id: simplified_chinese_utf-8.php,v 1.8  2007/12/14 11:27:52 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2007 Mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software based on Mambo
* Powered By mambochina.net & mambors.org
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( '禁止直接访问本文件！' );

// Name of CMS
DEFINE('_MAMBORS','曼波整站系统');
DEFINE('_MAMBORS_VERSION', _MAMBORS . $_VERSION->RELEASE . '.' . $_VERSION->DEV_LEVEL );
DEFINE('_D_MAMBORS','<a href="http://www.mambochina.net" target="_blank">' . _MAMBORS . '</a> 基于 <a href="http://mambo-foundation.org" target="_blank">Mambo</a> 开发，是免费的自由软件，遵循 GNU/GPL 开源许可协议。<br />' . '<a href="http://www.mambochina.net" target="_blank">' . _MAMBORS_VERSION . '</a> 由 <a href="http://www.mambochina.net" target="_blank">Mambo中国</a> 和 <a href="http://www.mambors.org" target="_blank">Mambo Resource</a> 联合增强开发。');

// Language and Encode of frontend language
DEFINE('_LANGUAGE','zh_CN');
DEFINE('_CHARSET','UTF-8');
DEFINE('_ISO','charset=' . _CHARSET);

/** common */
DEFINE('_NOT_AUTH',"您无权访问此资源");
DEFINE('_DO_LOGIN',"请登录.");
DEFINE('_VALID_AZ09',"请输入合法的%s. 不能有空格，长度大于%d个字符并且只包含0-9,a-z,A-Z。");
DEFINE('_CMN_YES',"是(Yes)");
DEFINE('_CMN_NO',"否(No)");
DEFINE('_CMN_SHOW','显示');
DEFINE('_CMN_HIDE','隐藏');

DEFINE('_CMN_NAME',"名称");
DEFINE('_CMN_DESCRIPTION',"描述");
DEFINE('_CMN_SAVE',"保存");
DEFINE('_CMN_CANCEL',"取消");
DEFINE('_CMN_PRINT',"打印");
DEFINE('_CMN_PDF',"输出PDF");
DEFINE('_CMN_EMAIL',"E-mail");
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','上层结点');
DEFINE('_CMN_ORDERING',"排序");
DEFINE('_CMN_ACCESS',"权限级别");
DEFINE('_CMN_SELECT',"选择");

DEFINE('_CMN_NEXT',"下一页");
DEFINE('_CMN_NEXT_ARROW',"&gt;&gt;");
DEFINE('_CMN_PREV',"上一页");
DEFINE('_CMN_PREV_ARROW',"&lt;&lt; ");

DEFINE('_CMN_SORT_NONE',"顺序");
DEFINE('_CMN_SORT_ASC',"顺序");
DEFINE('_CMN_SORT_DESC',"反序");

DEFINE('_CMN_NEW',"新建");
DEFINE('_CMN_NONE',"无");
DEFINE('_CMN_LEFT',"左对齐");
DEFINE('_CMN_RIGHT',"右对齐");
DEFINE('_CMN_CENTER',"居中");
DEFINE('_CMN_TOP','顶端');
DEFINE('_CMN_BOTTOM','底部');

DEFINE('_CMN_PUBLISHED',"已经发布");
DEFINE('_CMN_UNPUBLISHED',"尚未发布");

DEFINE('_CMN_EDIT_HTML','编辑 HTML');
DEFINE('_CMN_EDIT_CSS','编辑 CSS');
DEFINE('_CMN_DELETE','删除');
DEFINE('_CMN_FOLDER',"目录");
DEFINE('_CMN_SUBFOLDER',"子目录");
DEFINE('_CMN_OPTIONAL',"可选");
DEFINE('_CMN_REQUIRED',"必须");

DEFINE('_CMN_CONTINUE',"继续");

DEFINE('_CMN_NEW_ITEM_LAST','新建条目放在最后位置');
DEFINE('_CMN_NEW_ITEM_FIRST','新建条目放在最前位置');
DEFINE('_LOGIN_INCOMPLETE','请填写姓名和密码框.');
DEFINE('_LOGIN_BLOCKED','您的登录被封锁.请和管理员联系.');
DEFINE('_LOGIN_INCORRECT','用户名或密码不正确. 请再试一遍');
DEFINE('_LOGIN_NOADMINS','您不能登录。系统尚未初始化.');
DEFINE('_CMN_JAVASCRIPT','警告！Javascript 功能必须打开，才能正常操作。');

DEFINE('_NEW_MESSAGE','有新短信。');
DEFINE('_MESSAGE_FAILED','用户已经锁住收件箱，短信发送失败。');

DEFINE('_CMN_IFRAMES', '此选项将不能正常使用，非常遗憾，您的浏览器不支持嵌入桢(Inline Frames)');

DEFINE('_INSTALL_WARN','出于安全考虑，请完全删除 installation 目录中的所有文件和子目录，然后刷新一下。');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>模版文件不存在！请查找：</b></font>');
DEFINE('_NO_PARAMS','此条目没有参数');
DEFINE('_HANDLER','处理器未定义类型。');

/** mambots */
DEFINE('_TOC_JUMPTO',"跳转");

/**  content */
DEFINE('_READ_MORE','阅读全文...');
DEFINE('_READ_MORE_REGISTER','注册后阅读全文...');
DEFINE('_MORE','更多...');
DEFINE('_ON_NEW_CONTENT', "一篇新文章由[ %s ]提交，标题[ %s ]，单元[ %s ]，分类[ %s ]" );
DEFINE('_SEL_CATEGORY','- 选择分类 -');
DEFINE('_SEL_SECTION','- 选择单元 -');
DEFINE('_SEL_AUTHOR','- 选择作者 -');
DEFINE('_SEL_POSITION','- 选择位置 -');
DEFINE('_SEL_TYPE','- 选择类型 -');
DEFINE('_EMPTY_CATEGORY','分类是空的');
DEFINE('_EMPTY_BLOG','没有条目来显示');
DEFINE('_NOT_EXIST','您访问的页面不存在.<br />请从主菜单选择连接进入.');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','投票');
DEFINE('_BUTTON_RESULTS','结果');
DEFINE('_USERNAME','用户名');
DEFINE('_LOST_PASSWORD','忘记密码');
DEFINE('_PASSWORD','密码');
DEFINE('_BUTTON_LOGIN','登录');
DEFINE('_BUTTON_LOGOUT','退出登录');
DEFINE('_NO_ACCOUNT','没有账户？');
DEFINE('_CREATE_ACCOUNT','马上注册');
DEFINE('_VOTE_POOR','差');
DEFINE('_VOTE_BEST','好');
DEFINE('_USER_RATING','用户评分');
DEFINE('_RATE_BUTTON','评分');
DEFINE('_REMEMBER_ME','记住我');

/** contact.php */
DEFINE('_ENQUIRY','问候');
DEFINE('_ENQUIRY_TEXT','这是一封问候信，通过 %s 来自：');
DEFINE('_COPY_TEXT','这是您发送给 %s 经由 %s 的消息的副本');
DEFINE('_COPY_SUBJECT','复制：');
DEFINE('_THANK_MESSAGE','感谢您的来信！');
DEFINE('_CLOAKING','此邮件地址受spam bots保护，需要使用 Javascript 功能来查阅。');
DEFINE('_CONTACT_HEADER_NAME','名称');
DEFINE('_CONTACT_HEADER_POS','职务');
DEFINE('_CONTACT_HEADER_EMAIL','Email');
DEFINE('_CONTACT_HEADER_PHONE','电话');
DEFINE('_CONTACT_HEADER_FAX','传真');
DEFINE('_CONTACTS_DESC','网站联系人信息列表');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','联系人');
DEFINE('_EMAIL_DESCRIPTION','发送 Email 给联系人：');
DEFINE('_NAME_PROMPT',' 请输入您的名字：');
DEFINE('_EMAIL_PROMPT',' 请输入您的email地址：');
DEFINE('_MESSAGE_PROMPT',' 请输入您的消息内容：');
DEFINE('_SEND_BUTTON','发送');
DEFINE('_CONTACT_FORM_NC','请确认表单完整正确.');
DEFINE('_CONTACT_TELEPHONE','电话: ');
DEFINE('_CONTACT_MOBILE','手机：');
DEFINE('_CONTACT_FAX','传真: ');
DEFINE('_CONTACT_EMAIL','Email：');
DEFINE('_CONTACT_NAME','姓名：');
DEFINE('_CONTACT_POSITION','职务：');
DEFINE('_CONTACT_ADDRESS','地址：');
DEFINE('_CONTACT_MISC','备注：');
DEFINE('_CONTACT_SEL','选择联系人：');
DEFINE('_CONTACT_NONE','没有联系人信息列表。');
DEFINE('_EMAIL_A_COPY','把此消息复制一份到您自己的 Email 地址');
DEFINE('_CONTACT_DOWNLOAD_AS','下载当前数据为');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_PAGE','页面');
DEFINE('_PN_OF',' 共 ');
DEFINE('_PN_START','第一页');
DEFINE('_PN_PREVIOUS','上一页');
DEFINE('_PN_NEXT','下一页');
DEFINE('_PN_END','最后一页');
DEFINE('_PN_DISPLAY_NR','显示');
DEFINE('_PN_RESULTS','第');

/** emailfriend */
DEFINE('_EMAIL_TITLE','发email给朋友');
DEFINE('_EMAIL_FRIEND','发email给朋友。');
DEFINE('_EMAIL_FRIEND_ADDR','您朋友的email：');
DEFINE('_EMAIL_YOUR_NAME','您的姓名：');
DEFINE('_EMAIL_YOUR_MAIL','您的email：');
DEFINE('_SUBJECT_PROMPT',' 标题：');
DEFINE('_BUTTON_SUBMIT_MAIL','发送email');
DEFINE('_BUTTON_CANCEL','取消');
DEFINE('_EMAIL_ERR_NOINFO','您必须输入有效的email地址.');
DEFINE('_EMAIL_MSG',' 来自 "%s" 站点的文章。这是您的朋友 %s ( %s )发送给您的。请通过以下链接访问： %s');
DEFINE('_EMAIL_INFO','发送人：');
DEFINE('_EMAIL_SENT','已经发送给：');
DEFINE('_PROMPT_CLOSE','关闭');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' 投稿：');
DEFINE('_WRITTEN_BY', ' 作者：');
DEFINE('_LAST_UPDATED', '最近更新');
DEFINE('_BACK','返回');
DEFINE('_LEGEND','图例');
DEFINE('_DATE','日期');
DEFINE('_ORDER_DROPDOWN','排序');
DEFINE('_HEADER_TITLE','标题');
DEFINE('_HEADER_AUTHOR','作者');
DEFINE('_HEADER_SUBMITTED','提交');
DEFINE('_HEADER_HITS','点击');
DEFINE('_E_EDIT','编辑');
DEFINE('_E_ADD','新增');
DEFINE('_E_WARNUSER','请取消或者保存现在编辑的内容。');
DEFINE('_E_WARNTITLE','必须输入标题');
DEFINE('_E_WARNTEXT','必须输入引言');
DEFINE('_E_WARNCAT','请选择一个分类');
DEFINE('_E_CONTENT','内容');
DEFINE('_E_TITLE','标题:');
DEFINE('_E_SECTION','单元:');
DEFINE('_E_CATEGORY','分类:');
DEFINE('_E_INTRO','摘要');
DEFINE('_E_MAIN','正文');
DEFINE('_E_MOSIMAGE','插入 {mosimage}');
DEFINE('_E_IMAGES','图片');
DEFINE('_E_GALLERY_IMAGES','图库图片');
DEFINE('_E_CONTENT_IMAGES','正文图片');
DEFINE('_E_EDIT_IMAGE','编辑图片');
DEFINE('_E_INSERT','插入');
DEFINE('_E_UP','向上');
DEFINE('_E_DOWN','向下');
DEFINE('_E_REMOVE','删除');
DEFINE('_E_SOURCE','来源：');
DEFINE('_E_ALIGN','排列：');
DEFINE('_E_ALT','悬浮文字：');
DEFINE('_E_BORDER','边框：');
DEFINE('_E_CAPTION','标题');
DEFINE('_E_APPLY','应用');
DEFINE('_E_PUBLISHING','发布');
DEFINE('_E_STATE','状态：');
DEFINE('_E_AUTHOR_ALIAS','作者别名：');
DEFINE('_E_ACCESS_LEVEL','权限级别：');
DEFINE('_E_ORDERING','排序：');
DEFINE('_E_START_PUB','开始发布：');
DEFINE('_E_FINISH_PUB','完成发布：');
DEFINE('_E_SHOW_FP','在首页显示：');
DEFINE('_E_HIDE_TITLE','隐藏标题：');
DEFINE('_E_METADATA','元数据');
DEFINE('_E_M_DESC','描述：');
DEFINE('_E_M_KEY','关键词：');
DEFINE('_E_SUBJECT','标题：');
DEFINE('_E_EXPIRES','有效期：');
DEFINE('_E_VERSION','版本：');
DEFINE('_E_ABOUT','关于');
DEFINE('_E_CREATED','创建：');
DEFINE('_E_LAST_MOD','最后更新：');
DEFINE('_E_HITS','点击：');
DEFINE('_E_SAVE','保存');
DEFINE('_E_CANCEL','取消');
DEFINE('_E_REGISTERED','仅注册用户可访问');
DEFINE('_E_ITEM_INFO','页面信息');
DEFINE('_E_ITEM_SAVED','页面已成功保存。');
DEFINE('_ITEM_PREVIOUS','&lt; 上一篇');
DEFINE('_ITEM_NEXT','下一篇 &gt;');


/** content.php */
DEFINE('_ORDER_DROPDOWN_DA','日期顺序');
DEFINE('_ORDER_DROPDOWN_DD','日期降序');
DEFINE('_ORDER_DROPDOWN_TA','标题顺序');
DEFINE('_ORDER_DROPDOWN_TD','标题降序');
DEFINE('_ORDER_DROPDOWN_HA','点击顺序');
DEFINE('_ORDER_DROPDOWN_HD','点击降序');
DEFINE('_ORDER_DROPDOWN_AUA','作者顺序');
DEFINE('_ORDER_DROPDOWN_AUD','作者降序');
DEFINE('_ORDER_DROPDOWN_O','排序');
DEFINE('_SELECT_CAT','选择分类');
DEFINE('_SELECT_SEC','选择单元');

/** poll.php */
DEFINE('_ALERT_ENABLED','必须打开cookie!');
DEFINE('_ALREADY_VOTE','今天您已经投过一票了!');
DEFINE('_NO_SELECTION','您还没做任何选择，请重新投票');
DEFINE('_THANKS',"感谢您的投票!");
DEFINE('_SELECT_POLL',"请在列表中选择投票");

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
DEFINE('_POLL_TITLE','调查结果');
DEFINE('_SURVEY_TITLE','调查标题');
DEFINE('_NUM_VOTERS','投票数');
DEFINE('_FIRST_VOTE','第一张投票');
DEFINE('_LAST_VOTE','最后一张投票');
DEFINE('_SEL_POLL','请选择投票');
DEFINE('_NO_RESULTS','本次调查还没有投票记录。');

/** registration.php */
DEFINE('_ERROR_PASS','对不起，未找到该用户');
DEFINE('_NEWPASS_MSG','用户 $checkusername 使用此email\n'
.'来自$mosConfig_live_site 的用户请求发送一个新密码.\n\n'
.' 您的新密码是：$newpass\n\n 如果您没有请求发送新密码，别担心，只有您自己看见这封信，没有其他人。'
.' 如果是误发送密码的话，请您用此新密码登录，然后再更改密码。');
DEFINE('_NEWPASS_SUB','$_sitename ：： $checkusername 的新密码');
DEFINE('_NEWPASS_SENT','新的用户密码已经创建并发送！');
DEFINE('_REGWARN_NAME','请输入您的名称。');
DEFINE('_REGWARN_UNAME','请输入用户名。');
DEFINE('_REGWARN_MAIL','请输入有效的email地址。');
DEFINE('_REGWARN_PASS','请输入一个有效的密码. 不能有空格，长度大于6位，并且只包含 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','请再次输入您的密码.');
DEFINE('_REGWARN_VPASS2','两次输入的密码不符,请重新输入.');
DEFINE('_REGWARN_INUSE','这个用户名已经在使用了,请另取一个用户名.');
DEFINE('_REGWARN_EMAIL_INUSE', '此 e-mail 已经用来注册了。如果您忘记密码的话，请点击 "忘记密码" 链接，新的密码将发送给你。');
DEFINE('_SEND_SUB','%s用户的详细资料在%s');
DEFINE('_USEND_MSG_ACTIVATE','%s，您好！

感谢你在 %s 注册，你的帐户已经创建，在使用之前必须先激活它。
要激活帐户，请点击下面的链接，或把它复制到浏览器中打开：
%s

激活后您可以用以下用户名和密码登录 %s ：

Username - %s
Password - %s');
DEFINE('_USEND_MSG', "%s，您好！

感谢你在 %s 注册。

您可以用注册的用户名和密码登录 %s 。");
DEFINE('_USEND_MSG_NOPASS','$name，您好！,\n\n您已经成为 $mosConfig_live_site 的用户。\n'
.'请您用注册的用户名和密码登录$mosConfig_live_site。\n\n'
.'请不要回复这封信，这是系统自动发送的。\n');
DEFINE('_ASEND_MSG','%s，您好！

有个新用户刚在 %s 注册。
以下是详细信息：

名称 - %s
e-mail - %s
用户名 - %s

请不要回复这封信，这是系统自动发送的。');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">注册完成！</div><br />&nbsp;&nbsp;'
.'您现在可以登录了。<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">注册完成！</div><br />您现在可以登录了。');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">注册完成！</div><br />您的帐户已经创建，激活链接已经发送到您的 e-mail 地址。收到e-mail后请点击激活链接，激活您的帐户，然后才能登录系统。');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">激活完成！</div><br />您的帐户已经成功激活，您可以用注册的用户名和密码登录。');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">无效的激活链接！</div><br />系统数据库中不存在此帐户，或者该帐户已经激活了。');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','忘记密码了？');
DEFINE('_NEW_PASS_DESC','请输入用户名和email地址,然后点击[发送密码]按钮.<br />'
.'您将很快收到一封包含新密码的email，使用新密码来登录。');
DEFINE('_PROMPT_UNAME','用户名：');
DEFINE('_PROMPT_EMAIL','E-mail 地址：');
DEFINE('_BUTTON_SEND_PASS','发送密码');
DEFINE('_REGISTER_TITLE','用户注册');
DEFINE('_REGISTER_NAME','名称：');
DEFINE('_REGISTER_UNAME','用户名：');
DEFINE('_REGISTER_EMAIL','E-mail：');
DEFINE('_REGISTER_PASS','密码：');
DEFINE('_REGISTER_VPASS','密码校验：');
DEFINE('_REGISTER_REQUIRED','有 (*) 号的数据项是必填项。');
DEFINE('_BUTTON_SEND_REG','注册');
DEFINE('_SENDING_PASSWORD','新密码将发送到上述email地址。<br />收到新密码后您可以登录，然后修改密码。');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','搜索');
DEFINE('_PROMPT_KEYWORD','搜索关键词');
DEFINE('_SEARCH_MATCHES','返回 %d 个匹配结果');
DEFINE('_CONCLUSION','一共找到 $totalRows 条匹配的记录. <b>$searchword</b> ');
DEFINE('_NOKEYWORD','没有找到匹配的记录');
DEFINE('_IGNOREKEYWORD','在搜索时忽略了一个或数个常见的关键词');
DEFINE('_SEARCH_ANYWORDS','任意关键词');
DEFINE('_SEARCH_ALLWORDS','所有关键词');
DEFINE('_SEARCH_PHRASE','精确短语');
DEFINE('_SEARCH_NEWEST','新的排在前面');
DEFINE('_SEARCH_OLDEST','旧的排在前面');
DEFINE('_SEARCH_POPULAR','最流行的');
DEFINE('_SEARCH_ALPHABETICAL','字母顺序');
DEFINE('_SEARCH_CATEGORY','单元/分类');

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
DEFINE('_NEWSFLASH_BOX','快讯！');
DEFINE('_MAINMENU_BOX','主菜单');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','用户菜单');
DEFINE('_HI','您好, ');

/** user.php */
DEFINE('_SAVE_ERR','请完整填写要求的每一项.');
DEFINE('_THANK_SUB','感谢您的提交. 您提交的内容会在发布到站点之前经过审核,请耐心等待.');
DEFINE('_UP_SIZE','您不能上传超过15K的文件.');
DEFINE('_UP_EXISTS','名为 $userfile_name 的图片已经存在.请重新命名您的文件,再试一次.');
DEFINE('_UP_COPY_FAIL','拷贝失败');
DEFINE('_UP_TYPE_WARN','您只能上传JPG或者GIF格式的图片');
DEFINE('_MAIL_SUB','新的待审核文章');
DEFINE('_MAIL_MSG','您好, $adminName,\n\nA 有一篇新的文章待审核 $type, $title (作者：$author )'
.'来自站点： $mosConfig_live_site .\n'
.'请您登录 $mosConfig_live_site/administrator 来审核这篇 $type.\n\n'
.'请不要回复这封信，这是系统自动发送的。\n');
DEFINE('_PASS_VERR1','如果您修改了您的密码,请再输入一次确认修改.');
DEFINE('_PASS_VERR2','如果您修改了您的密码,请确认两次输入的内容一致.');
DEFINE('_UNAME_INUSE','此用户名已经被占用.');
DEFINE('_UPDATE','更新');
DEFINE('_USER_DETAILS_SAVE','您的设置已经保存。');
DEFINE('_USER_LOGIN','用户登录');

/** components/com_user */
DEFINE('_EDIT_TITLE','修改您的详细信息');
DEFINE('_YOUR_NAME','姓名：');
DEFINE('_EMAIL','e-mail：');
DEFINE('_UNAME','用户名：');
DEFINE('_PASS','密码：');
DEFINE('_VPASS','密码确认：');
DEFINE('_SUBMIT_SUCCESS','提交成功');
DEFINE('_SUBMIT_SUCCESS_DESC','你提交的内容已经交给了管理员.在发布在站点上之前,需要经过审核.请耐心等待.');
DEFINE('_WELCOME','欢迎!');
DEFINE('_WELCOME_DESC','欢迎进入本站用户区');
DEFINE('_CONF_CHECKED_IN','您取出的条目现在都已全部放回了.');
DEFINE('_CHECK_TABLE','检查表');
DEFINE('_CHECKED_IN','已经放回 ');
DEFINE('_CHECKED_IN_ITEMS',' 条目');
DEFINE('_PASS_MATCH','密码不符');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','必须给客户选择一个名称。');
DEFINE('_BNR_CONTACT','必须给客户选择一个联系人。');
DEFINE('_BNR_VALID_EMAIL','必须给客户选择一个有效的E-mail地址。');
DEFINE('_BNR_CLIENT','必须选择一个客户，');
DEFINE('_BNR_NAME','必须给旗帜广告选择一个名称。');
DEFINE('_BNR_IMAGE','必须给旗帜广告选择一幅图片。');
DEFINE('_BNR_URL','必须给旗帜广告选择 URL地址，或自定义的代码。');
/** components/com_login */
DEFINE('_ALREADY_LOGIN','您已经登录过了!');
DEFINE('_LOGOUT','点击这里退出');
DEFINE('_LOGIN_TEXT','请登录,您才能完全访问本站'); 
DEFINE('_LOGIN_SUCCESS','登录成功');
DEFINE('_LOGOUT_SUCCESS','退出成功');
DEFINE('_LOGIN_DESCRIPTION','请登录，才能访问个人区域。');
DEFINE('_LOGOUT_DESCRIPTION','您已经登录到个人区域。');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','链接');
DEFINE('_WEBLINKS_DESC','下面是一些相关站点,请点击链接进入.');
DEFINE('_HEADER_TITLE_WEBLINKS','链接');
DEFINE('_SECTION','分类：');
DEFINE('_SUBMIT_LINK','增加一个新链接');
DEFINE('_URL','地址：');
DEFINE('_URL_DESC','描述：');
DEFINE('_NAME','名称：');
DEFINE('_WEBLINK_EXIST','已经有同名的链接存在，请修改重试.');
DEFINE('_WEBLINK_TITLE','网站链接必须有标题。');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','新闻导入名称');
DEFINE('_FEED_ARTICLES','文章数');
DEFINE('_FEED_LINK','新闻导入链接');

/** whos_online.php */
DEFINE('_WE_HAVE', '现在有 ');
DEFINE('_AND', ' 和');
DEFINE('_GUEST_COUNT','$guest_array 位访客');
DEFINE('_GUESTS_COUNT','$guest_array 位访客');
DEFINE('_MEMBER_COUNT','$user_array 位会员');
DEFINE('_MEMBERS_COUNT','$user_array 位会员');
DEFINE('_ONLINE',' 在线');
DEFINE('_NONE','无人在线');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','时间');
DEFINE('_MEMBERS_STAT','用户');
DEFINE('_HITS_STAT','点击');
DEFINE('_NEWS_STAT','新闻');
DEFINE('_LINKS_STAT','链接');
DEFINE('_VISITORS','访问量');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* 此菜单[主菜单]的第一个发布的菜单项，默认为网站的`首页` *');
DEFINE('_MAINMENU_DEL','* 你不能删除此 菜单 请选择适当的操作*');
DEFINE('_MENU_GROUP','* 有些菜单类型出现在一个以上的组中 *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', '新用户资料' );
DEFINE('_NEW_USER_MESSAGE', '%s，您好！


管理员在 %s 新增了一个用户。

以下是用户名和密码，用来登录 %s：

用户名 - %s
密码 - %s


请不要回复这封信，这是系统自动发送的。');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "来自 '%s' 的信件

消息：
" );

/** includes/mamboxml.php */
DEFINE('_DONT_USE_IMAGE','- 不使用图片 -');
DEFINE('_USE_DEFAULT_IMAGE','- 使用默认图片 -');

/** global frontend translation string */
global $TR_STRS;
if (!isset($TR_STRS)){
	$TR_STRS = array();
}
$TR_STRS[strtolower('Banners')] = '横幅广告';
$TR_STRS[strtolower('Search')] = '搜索';
$TR_STRS[strtolower('Main Menu')] = '主菜单';
$TR_STRS[strtolower('User Menu')] = '用户菜单';
$TR_STRS[strtolower('Other Menu')] = '其它菜单';
$TR_STRS[strtolower('Login Form')] = '登录表单';
$TR_STRS[strtolower('Syndicate')] = 'RSS 聚合';
$TR_STRS[strtolower('Statistics')] = '统计';
$TR_STRS[strtolower('Template Chooser')] = '模版选择器';
$TR_STRS[strtolower('Sections')] = '单元';
$TR_STRS[strtolower('Related Items')] = '相关文章';
$TR_STRS[strtolower('Wrapper')] = '嵌入页面';
$TR_STRS[strtolower('Newsflash')] = '新闻快讯';
$TR_STRS[strtolower('Polls')] = '在线调查';
$TR_STRS[strtolower("Who's Online")] = "谁在线";
$TR_STRS[strtolower('Random Image')] = '随机图片';
$TR_STRS[strtolower('Top Menu')] = '顶部菜单';
$TR_STRS[strtolower('Latest News')] = '最新文章';
$TR_STRS[strtolower('Popular')] = '热门文章';

?>
