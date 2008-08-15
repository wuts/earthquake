<?php
/**
* @version $Id: CHANGELOG.php,v 5.5 2008-04-22 01:48:46 lang3 Exp $
* @package Mambors_5.5
* @copyright (C) 2004 - 2008 mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>

曼波整站系统改动日志

-------------------- 5.5.0 --------------------------------------------------
2008-04-22

一、修正bugs

1. 整合discuz后，当主站使用顶级域名，论坛使用二级域名，在论坛点击注册时，没有转向正确的注册链接。现已解决。

2. 查询的时候，将查询的结果显示在首页上，同时显示首页的模块， 而其他版本查询的时候，查询的结果显示在新的页面上，不显示其他的模块。类似的情况还有在前台提交或编辑文章时也发生，现都已解决。

3. 解决曼波5.4.0 修改帖子时的日期问题
最近安装了mambo5.4，使用中发现：
修改帖子后发帖日期被改为2004年，不知如何更改回来？

4. 解决在80端口之外的端口使用时，图片路径错误问题：
我在本机上使用了8080端口，前期一切正常。但是稍微改点配置。所有图片显示不了，并且如同所示，所有的图片连接地址多错误，
http://192.168.88.86:8080:8080/images/M_images/rss10.gif，多出一个8080


二、增强功能

1. 优化数据库处理，减少sql查询次数，首页调入由原来的35次sql查询，减少为22次。首页打开速度飞快，配合SEF模拟静态网址的使用，可以和静态页面相媲美。

2. 重写编码转换函数 mos_convert_encoding，参数和 mb_convert_encoding 的一致，先判断 mb_convert_encoding, iconv 函数是否存在，才使用，如都不存在就返回原值。这样只要php支持 mb_string 或 iconv 就能使用，提高兼容性，原来的只使用 mb_string。

3. 增强SEF静态网址功能，目录层次结构的静态网址，支持中英文路径，直观易懂，更易于搜索引擎收录。

1) 实现了曼波核心的常用组件的增强SEF静态链接，包括内容、首页、网站链接com_weblink, 联系人com_contact, 新闻转播com_newsfeeds等组件。

每个组件都可通过自己的sef.php文件来定义各自的静态链接，那些没有制作sef.php文件的组件，将采用系统默认的静态链接处理。欢迎开发人员参考曼波核心组件的 sef.php ，为第三方组件制作增强的SEF静态链接。

2) 路径可以自己在后台定义：菜单表 mos_menu 加 sefpath 字段，用于自定义菜单项的SEF路径；内容和组件的SEF路径，通过设置单元名称、分类名称来实现。

4. 改进 pathway 生成方法，增加全局变量 $curPathway, $pathwaySeperator，速度有所提高。

5. 修改内容在创建分类下拉列表时，用分类标题，而不是用原来的分类名称

6. 修改 ComponentCategory 函数，在创建分类下拉列表时，用分类标题，而不是用原来的分类名称。
影响到用到曼波分类的组件： com_newsfeeds, com_contact, com_weblinks等

7. 改进联系人组件

1) 联系人分类管理、创建菜单时用的是 com_contact_details, 改为 com_contact

2) 页面标题改为：菜单项 - 分类标题

3) 删除参数other_cat_section

4) 联系人参数 vcard 默认为 0，国内用不着 vcard

8. 改进新闻转播组件

1) 页面标题改为：菜单项 - 分类标题

2) 删除参数other_cat_section

9. 改进网站链接组件 com_weblinks，页面标题改为：菜单项 - 分类标题

10. 改进搜索组件，页面标题改为：菜单项

11. 改进帮助系统

后台点击帮助，已经不会找不到帮助文件，只不过还是旧版英文的帮助信息。
现在曼波系统已经完善，可以开始写中文帮助手册了，或在wiki知识库协作写手册。

12. 改进数据库表结构，使能在 MySQL5 严格约束(strict mode)环境下运行

根据 mysql5.0 strict mode (STRICT_TRANS_TABLES) 的限制：
不支持对not null字段插入null值
不支持对自增长字段插入''值，可插入null值
不支持 text 字段有默认值

对数据库结构进行以下改进:

1) 给所有not null字段都设置非null默认值，字符串默认值为 ''，数值默认值为 0，日期默认值为 '0000-00-00 00:00:00'

2) 修改\administrator\components\com_installer\component\component.class.php 文件中的212行

3) 把 text 字段设置为可空，并去掉默认值

4) 规范化改进: 把 title 字段统一改为 varchar(255)，把有默认值的字段改为 not null 字段

至此，曼波整站系统完全支持MySQL5。由于时间仓促，也许会存在未发现的bugs，请到论坛指正。
另外，只有新装的曼波整站系统5.5.0才完全支持MySQL5，由于改动表结构的地方较多，没有在升级程序中实现，因此从低版本升级到曼波整站系统5.5.0的还是不能在 MySQL5 严格约束(strict mode)环境下运行。


三、淘汰功能
    
1. 取消后台短信（管理员之间大都用qq、msn联系，此功能没人用，多余了）
        删除 administrator/components/com_messages 目录
        删除 components/com_messages 目录
        编辑 administrator/modules/mod_fullmenu.php，删除“短信”菜单项
        删除 administrator/modules/mod_unread.php 模块文件
        编辑 components/com_content/content.php，删除提交新文章发送短消息给管理员的那段语句
        删除安装文件mambo_english.sql中的
            表 #__messages, #__messages_cfg
            INSERT INTO `#__modules` VALUES (23, 'Unread Messages', '', 1, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_unread', 0, 99, 1, '', 1, 1); 
        删除安装文件drop_table.sql中的 表 #__messages, #__messages_cfg
        删除语言文件中 com_messages 组件的相关语句

2. 取消回收站
回收站没有多少必要，不想显示的内容，取消发布就是，不想要的内容，删掉就是。放入回收站，久了都想不起来，直接删掉得了，如担心误删除，经常做数据库备份就是，删错了可以马上恢复。

        删除 administrator/components/com_trash 目录
        修改 administrator/modules/mod_fullmenu.php，删除“回收站”菜单项
        修改 administrator/modules/mod_quickicon.php，删除“回收站”图标
        修改 administrator/components/com_content/admin.content.php 和 toolbar.content.html.php
        修改 administrator/components/com_typedcontent/admin.typedcontent.php 和 toolbar.typedcontent.html.php
        修改 administrator/components/com_menus/admin.menus.php 和 toolbar.menus.html.php
        修改 administrator/components/com_menumanager/admin.menumanager.php 和admin.menumanager.html.php
        修改 administrator/includes/menubar.html.php
        修改 includes/mambo.php, gacl.class.php
        删除语言文件中 com_trash 组件的相关语句

3. 取消取出/放回的功能（此功能是最让新手困惑的，除了带来使用上的不便外，没什么太大用处）

        涉及13个表和很多文件，暂时先取消功能，不改动表结构，不删除文件，等1个版本的广泛使用测试，如没问题，再彻底删除
        修改 includes/mambo.php 的 function CheckedOutProcessing
        修改 includes/database.php 的 function checkout, 不做任何处理
        修改 administrator/modules/mod_fullmenu.php，删除“系统”、“全部放回”菜单项



-------------------- 5.4.0 --------------------------------------------------
2008-03-08

一、修正bugs

1. 最新文章模块/热门文章模块读取单元或分类的菜单项Itemid值有误（当上级菜单是单元，下级菜单是分类时，发生此bug）

2. 消除 PHP 的 notice 提示

1) 消除首页、blog风格中出现的
Notice: Undefined variable: Author in W:\www\mambors5.3.0test1\components\com_content\content.html.php on line 760

2) 消除当内容选项显示作者但不显示创建日期时出现的
Notice: Undefined variable: create_date in W:\www\so.mambochina.net\components\com_content\content.html.php on line 763

3. 触发器编辑时选择发布，保存后并没有发布

4. 点击“网站触发器”，显示全部触发器列表，但选择类型那里却显示 search 类型

5. 文章明细中没有显示作者

6. 网站使用UTF-8编码，后台新建或编辑内容条目时，点击上方菜单栏的“上传”会出现乱码，查看了charset，是GB2312，不是UTF-8

7. 编辑内容条目时，“更改创建日期”处显示的是创建时默认的日期（比如 2008-01-11 16:13:53），而保存以后创建日期会自动变成04年的记录（比如 2004-08-31 21:11:22），前台的文章排到最后面去了，如果“更改创建日期”留空；创建日期就变成当前的时间，前台文章又排到最前面来了，十分麻烦


二、增强功能

1. 优化菜单项Itemid的获取方法，总体减少sql查询次数30%以上，有效提高访问速度。系统默认样例数据安装后，优化前首页的sql查询为74次，优化后首页的sql查询为35次，其它页面都有不同程度的减少。

2. 后台的“预览”菜单项提升到顶级菜单，方便使用

3. 增强SEF静态链接功能，使用菜单项名称、单元名称、分类名称等做为链接路径，使链接有语义，支持中文名称，直观易懂，更方便搜索引擎收录。

每个组件都可通过自己的sef.php文件来定义各自的静态链接，那些没有自己的sef.php文件的组件，将采用系统默认的静态链接处理。目前实现了内容、首页等组件的增强SEF静态链接，其它核心组件以及第三方组件仍使用系统原来默认的SEF。欢迎广大开发人员为第三方组件增强开发SEF静态链接功能，具体方法可参照 includes/sef.php 和 components/com_content/sef.php

4. 动态设置首页网址 $mosConfig_live_site ，使多个域名能共用一个网站（不是转发）

5. 改进内容组件

1) 更改内容明细url链接为
index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id&Itemid=$Itemid

2) 更改分类博客风格url链接为
index.php?option=com_content&task=blogcategory&sectionid=$sectionid&id=$id&Itemid=$Itemid

3) 更改分类列表风格url链接为
index.php?option=com_content&task=category&sectionid=$sectionid&id=$id&Itemid=$Itemid



-------------------- 5.3.0 --------------------------------------------------
2007-12-23


一、修正bugs 

1. 把 mosDatabase 类名恢复为原来的 database
有些组件直接调用  database 类，改名会造成无法正常使用，权衡再三，还是改回来的好。


2. 网站链接组件的分类显示警告:
Warning: Missing argument 4 for showcategories() in
components/com_weblinks/weblinks.html.php on line 182


3. 后台管理联系人出错


4. SEF 在内容分类列表选择文章数时，url 出错


5. 编辑器的插入分页无效：点击 '*p' 按钮，插入的是 {mospage}, 浏览器会直接显示出来，没有分页效果。把 {mospage} 改为 {mospagebreak} 后，就可以分页了。


6. 清除全部已知的 notice 提示

前台
    content
	Notice: Undefined variable: docinfo in W:\www\mambors5.3.0\components\com_content\content.html.php on line 1111
	blogsection Notice:
	blogcategory  Notice:
后台
    content
	Notice: Undefined index: simple_editing in W:\www\mambors5.3.0\administrator\components\com_content\admin.content.html.php on line 373
    xml
	Notice: Only variables should be assigned by reference in W:\www\mambors5.3.0\includes\domit\xml_domit_lite_parser.php on line 1670
	Notice: Only variable references should be returned by reference in W:\www\mambors5.3.0\includes\domit\xml_domit_getelementsbypath.php on line 100
    安装组件、模块、钩子等
	Notice: Only variables should be assigned by reference in W:\www\mambors5.3.0pro\administrator\includes\pcl\pclzip.lib.php on line 652
	Notice: Only variables should be assigned by reference in W:\www\mambors5.3.0pro\administrator\components\com_installer\installer.class.php on line 259


7. 模版 box_windmill_cn 编码bug


8. 登录错误时没有提示框或提示框乱码

1) 如果用户名错误则白屏，状态栏js报错误：
行: 1
字符: 57
错误: 未结束的字符串常量
代码: 0

2) 如果用户名正确，密码错误
不提示任何信息返回首页

经测试，中文 utf-8 编码确实存在bug，不过gb2312的正常。
原因可能是没给 js 脚本指定编码，缺省情况下，js好像不认中文 utf-8。
把思路延伸了一下，所有用到js提示框的地方，在中文utf-8编码，都有问题


9. 投票组件的时间显示格式有误


10. php5+mysqlclient5+mysql4 环境无法安装曼波520


11. php5环境，曼波为gb2312编码，安装中文模块后，编辑模块时，参数标签乱码(实际为utf8编码)


12. blog风格单元和分类的 META KEY, DESCRIPTION 生成问题：
把当前页面所有文章的META KEY, DESCRIPTION都累加起来，造成长度过长、关键词重复和描述难阅读等缺陷



二、增强功能

1. 允许在全局配置中设置注册用户是否可发表文章，默认为不可发表


2. 改进 .htaccess


3. 增强 session 处理，使 sid 不再出现在 url 中(搜索引擎也许会认为是作弊)


4. 统一cookie处理：使用setcookie的地方统一改用 mamhooCookie，在 session_start() 之前，先设置一下session_name 和 cookie参数

有用户反映：投票功能使用有故障， 系统提示"必须打开cookie!"。而我们使用正常，没有试出此故障，不过统一cookie处理后，此bug应该解决了，请出现故障的用户测试一下，如有问题请反馈给我们


5. 改进最新文章模块

1) 增加鼠标置上时显示完整标题
2) 增加时间显示可选参数：无, mm-dd, yyyy-mm-dd, yy-mm-dd, hh:mm
3) 取消参数“模块模式”
4) 汉化模块，加到后台语言文件中


6. 改进热门文章模块，照搬了最新文章模块的功能


7. 后台内容单元管理提速


8. 后台内容分类管理提速


9. 后台新增单元，保存时单元的次序由原来的最前改为最后


10. 后台新增分类，保存时分类的次序由原来的最前改为最后


11. 后台新增newsfeed，保存时newsfeed的次序由原来的最前改为最后


12. 改进模版 mc_simple, mc_simple_right 的 css 文件，增加：

ul {
	margin: 0;
	padding: 0;
	list-style: none;
}


li {
	line-height: 18px;
	margin-left:0px;
	padding-left: 15px;
	padding-top: 0px;
	background-image: url(../images/arrow.png) ;
	background-repeat: no-repeat;
	background-position: 0px 0px;
}


13. 增强 RSS 聚合功能

1) 解决RSS 中文输出乱码
2) 可生成指定单元或分类的内容聚合（原来的只能生成首页内容聚合）
在 RSS 聚合模块中指定单元或分类id，就可使用，可以复制为多个模块来使用。
其实模块的作用只是方便产生RSS链接，了解链接后可以单独做个RSS内容页面，把多个单元或分类的文章聚合链接集中起来，就可以像很多大站点那样提供RSS内容聚合服务

3) 聚合内容增加创建日期


14. 改进首页组件菜单

1) 删除参数“分类排序orderby_pri”
2) 参数“整体次序orderby_sec” 改名为 “文章排序orderby”
3) 删除参数 单元名称、单元名称可链接、分类名称、分类名称可链接
4) 汉化措词修正：
“最主要条目数 ”改为“头条数”
“介绍条目数”改为“摘要数”
“列数”改为“摘要列数”
“链接条目数”改为“链接条数”


15. 改进内容分类博客风格

1) 删除参数“分类排序orderby_pri”
2) 参数“整体次序orderby_sec” 改名为 “文章排序orderby”
3) 删除参数“分类名称category”
4) 删除参数“分类名称可链接category_link”
5) 删除参数“Mambo图片image”
6) 汉化修改：
“最主要条目数 ”改为“头条数”
“介绍条目数”改为“摘要数”
“列数”改为“摘要列数”
“链接条目数”改为“链接条数”


16. 改进内容单元博客风格

1) 增加是否在顶部显示分类列表的参数
2) 增加是否在分类名称后面加上文章数的参数
3) 增加每行分类数参数
4) 删除参数“分类排序orderby_pri”
5) 参数“整体次序orderby_sec” 改名为 “文章排序orderby”
6) 删除参数“Mambo图片image”
7) 汉化修改：
“最主要条目数 ”改为“头条数”
“介绍条目数”改为“摘要数”
“列数”改为“摘要列数”
“链接条目数”改为“链接条数”

    
17. 改进内容分类列表风格

1) 删除参数“其它分类other_cat”、“空的分类empty_cat”、“分类条目数cat_items”
2) 删除参数“排序选择框order_select”、“显示选择框display”，前台不再显示这两个选择框供用户选择，统一由管理员在后台设定。


18. 改进内容单元列表风格

1) 增加参数控制是否在顶部显示分类列表
2) 增加参数控制是否在分类名称后面加上文章数
3) 增加参数控制每行分类数
4) 增加参数控制是否显示分类文章列表
5) 增加参数控制分类的文章列表条目数，控制各分类显示的文章数
6) 增加参数控制列表的文章标题长度
7) 增加参数控制是否显示文章创建日期
8) 增加参数控制是否显示单元的所有文章列表
9) 删除参数“其它分类other_cat”、“空的分类empty_cat”、“分类条目数cat_items”
10) 删除参数“分类列表 - 单元other_cat_section”
11) 删除参数“排序选择框order_select”、“显示选择框display”，前台不再显示这两个选择框供用户选择，统一由管理员在后台设定。

    
19. 改进登录模块

1)去掉参数“登录框前内容”、“登录框后内容”
1)改进模块的版面布局，提供三种布局：竖向、竖向紧凑、横向，在参数中设置使用


20. 后台群发email时，主题由原来的“网站名称 / 标题”改为“标题 - 网站名称”


21. 把后台的 '系统信息' 菜单项移到 '网站' 菜单项下


22. 增加全局变量 $gCharset, 其值是前台编码, 方便和加速编码处理
    


-------------------- 5.2.0 --------------------------------------------------
2007-08-05

一、修正bugs 
1. FCKEditor编辑器插入图片出现调用asp文件错误，正确应该调用php。

2. 曼波登录bug
1) 如果输入的用户名存在，密码错误，就会弹出提示；如果用户名不存在，就白屏
2) 在本机使用时，如果用 http://localhost/ 访问，前台无法登录

3. 单元和分类的博客风格不能正确分页。
原因：为了提高文章内容处理速度，直接读取单元和分类表的文章数量，没有动态统计文章数量，但是单元和分类表的文章数量没有随着文章的增加或减少进行动态更新。
解决：
1) 升级时计算分类和单元的文章数量
2) 使用时，新增、编辑、删除、发布、取消发布文章，单元和分类文章数都要做相应的增减。

	
二、增强功能

1. 提高文章内容组件速度，轻松应付50万级文章数，样板网站: www.webbor.com
1) 内容 blog 风格菜单项只能选择一个单元或一个分类，取消 header 参数(页面标题)
2) 取消使用 publish_up 和 publish_down 字段
3) 改进 com_frontpage, 单元blog风格, 分类blog风格的处理，提高速度
4) 列表风格取消前台'过滤'功能

2. 首页、表格风格、博客风格的内容菜单项增加点击弹出参数，设置是否弹出新窗口来显示文章正文

3. 修改权限，注册用户可以提交文章

4. 增强最新文章模块的功能
1) 增加点击弹出参数，设置是否弹出新窗口来显示文章正文
2) 增加头条显示参数，设置是否显示第一篇文章的摘要
3) 增加模块标题参数，当设置显示头条时，不再显示标准的模块标题，而是显示本参数设置的标题
4) 增加单元/分类风格参数，设置点击更多时，是显示blog风格的单元/分类，还是显示表格风格的单元/分类
5) 增加文章标题长度参数，默认是40字符，当文章标题超出时，超出部分被截去，并在后面显示省略号 '...'
具体效果可参阅 www.webbor.com, www.jouyo.com, www.mambochina.net 等网站的首页

5. 升级编辑器 FCKEditor2.4.2 到 2.4.3

6. 修改FCKEditor功能键：回车键为<br />, SHIFT+回车键为 <p></p>

7. 新闻转播newsfeed 增强
1) 解决编码乱码，当feed编码和网站编码不同时，自动转码(需要 php 的 mb_string 模块)
2) 删除字数参数

8. 解决pdf 导出中文内容乱码
1) 可处理 gif 图片
2) 支持 UTF-8 简繁体中文编码

9. 改进网站链接组件 com_weblinks
1) 在分类列表页面的分类同一行显示前几个链接（数量可由参数设置），行末显示“更多”链接
2) 简化后台审核操作，可以在列表中点击网站，弹出新窗口显示网站
3) 去掉archived, approved 字段

10. 使在mysql5.0.xx 环境正常安装使用
1) 解决索引过长问题，把4个 acl 表的字段 section_value  和 value  统一为 varchar(100)，字段 name 统一为 varchar(255)
2) 优化表，清除没用的或重复的索引
3) 改进数据库类(includes/database.php)：根据语言编码指定字符集，创建表时根据语言编码指定默认字符集，有效解决乱码问题
4) 改进安装程序，在创建表时根据语言编码指定默认字符集


三、增加功能

1. 增加 box_mychildhood_cn 模版，原作者 magicbox，版主 nemo_sha 做了一些改进



-------------------- 5.1.0 --------------------------------------------------
2007-06-12

一、修补bugs 

1. 部分模版乱码在使用 utf-8 编码时，ie浏览器出现乱码

2. 后台模块管理，点击某个模块，应是进入模块编辑界面，但却进入模块新增界面，

二、增强功能

1. 改进安装程序
        语言选择简化为一个选择框
        数据库密码输入错误返回时，清空2个密码框
        安装步骤减少为三个：原第二、三步骤合并为一个步骤
        安装后新目录文件权限默认为777
        更改底部版权信息
        简化措辞

2. database 类改名为 mosDatabase, 避免与其它系统同名
        注意：那些用到new database 类的语句，可要改名了！

3. FCKEditor 编辑器从 2.3.1 升级到 2.4.2

4. FCKEditor 编辑器增加样式、字体和大小等选择框和一些实用按钮

5. 改进 mc_simple 和 mc_simple_right 模版，增加 top 位置

三、增加功能 

1. 增加 com_mamhoo 曼虎整合组件
首先值得庆祝的是，曼虎组件3.0公开源代码，由之前的遵循曼虎商业许可，改为遵循 GNU 开源许可协议。因此得以加入开源的曼波系统中，成为曼波的核心组件，给曼波增加了强大的系统整合的功能，简化了系统整合的难度。整合只需要安装相应的曼虎钩子即可。曼虎源代码的公开，希望更多的技术人员一起来开发和丰富曼虎钩子，整合更多的系统。

以下是曼虎组件3.0的一些改进：

    安装程序取消修改 Mambo index.php, index2.php 文件
    用曼虎的 sef.php 替代 Mambors 的 sef.php，SEF 变为 .html 为后缀，效果更佳
    sefbot.inc 移到 includes 目录
    取消checkin处理，搬到 mambo来处理
    取消类 mamhooSession ，搬到 mambo.php
    取消类 mamhooMainFrame ，搬到 mambo.php
    删除 sefbot.inc, sef.php, addon_install.txt, mamhooks/mamhoo_common.php 文件
    改进mamhoo用户管理
    修改语言文件的相关描述
    mamhoo login form 和 login form 模块合并
    mamhoo_useronline 和 useronline 模块合并



-------------------- 5.0.0 --------------------------------------------------
2007-03-31

曼波整站系统第一个版本是 5.0.0，在 Mambo4.5.5 全球版基础上开发，具体如下：

一、修补 Mambo4.5.5 全球版存在的以下 bugs 

1. 浏览分类的条目列表时，其它分类列表的itemid还是本类的itemid 
解决：去掉其它分类列表，以后可以通过开发专门的模块来使用。 

2. 新闻转播组件的分类不可用 

3. 后台模版编码问题 

4. 后台 js 编码问题 

5. 安装时显示的版本还是4.5.4 

二、淘汰功能 

1. 去掉 tinymce 编辑器 

2. 去掉内容存档功能 content archive 

3. 去掉内容 cache 处理 (Mambo 的cache比较弱，没起到加速的功效，反而会增加负担，加速应该由专业的 Optimizer / eAccelerator 来做) 

三、增强功能 

1. 后台内容菜单项调整：去掉“单元内容”菜单项，把 “单元管理”、“分类管理”菜单项移到首位 

2. 后台全局配置的数据库标签下的改为不可编辑，SMTP 密码改为暗码显示 

3. 重排后台首页面板的图标位置，去掉“简单模式 / 高级模式” 

4. 后台中文语言 "所有内容条目" 改为 "内容条目管理" 

5. 前台内容表格显示：日期/标题/点击顺序不太符合中国习惯，修改为 ：标题/日期/点击次序 

6. 前台发表文章可选择单元和分类 

7. 单元分类列表，显示指定单元的每个分类的文章列表 

8. 改进导航 Pathway 处理，使内容的导航更合理 

9. 系统性能优化，大大提高运行速度，能轻松支持十万级文章数的内容管理，如：网博资讯网、周游旅游网、Newsfeed Online 等 

四、增加功能 

1. 增加 FCKEditor 编辑器 

五、模版调整 

1. 增加 Mambo4.5.2.3 黄金版自带的 rhuk_solarflare_ii 模版 

2. 增加 magicbox 制作的4个模版: box_business_blue_cn, box_memories_cn, box_red_cn, box_windmill_cn 

3. 增加 lang3 制作的2个简单模版: mc_simple, mc_simple_right 

4. 删除 Mambo4.5.5 自带的模版: waterandstone, waterandstone800 

