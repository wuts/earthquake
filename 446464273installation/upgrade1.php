<?php

if ( !empty($_REQUEST['Submit']) ) {
	define( '_VALID_MOS', 1 );

	require_once( 'configuration.php' );
	require_once( 'includes/mambo.php' );

	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
	$query = "SELECT id FROM `#__mambots` WHERE element = 'mambofck'";
	$database->setQuery( $query );
	$hasmambofck = $database->loadResult();

	if ( empty($hasmambofck) ) {
		//Insert mambofck info into mambots table
		$query = "INSERT INTO `#__mambots` VALUES (0, 'FCKEditor WYSIWYG Editor', 'mambofck', 'editors', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 's:SkinPath=default\nAutoDetectLanguage=1\ns:DefaultLanguage=default\ns:ContentLangDirection=ltr\nProcessHTMLEntities=1\nIncludeLatinEntities=1\nIncludeGreekEntities=1\nFillEmptyBlocks=1\nFormatSource=1\nFormatOutput=1\nFormatIndentator=''    ''\nForceStrongEm=1\nGeckoUseSPAN=0\nForcePasteAsPlainText=0\nAutoDetectPasteFromWord=1\nForceSimpleAmpersand=0\nTabSpaces=0\nShowBorders=1\nSourcePopup=0\nUseBROnCarriageReturn=0\nToolbarStartExpanded=1\nToolbarCanCollapse=1\nIgnoreEmptyParagraphValue=1\nPreserveSessionOnFileBrowser=0\nFloatingPanelsZIndex=10000\nToolbarSet=[ [''Undo'',''Redo''], [''Cut'',''Copy'',''Paste'',''PasteText'',''PasteWord''], [''Bold'',''Italic'',''Underline'',''StrikeThrough'',''-'',''Subscript'',''Superscript'',''-'',''OrderedList'',''UnorderedList'',''-'',''Outdent'',''Indent''], [''JustifyLeft'',''JustifyCenter'',''JustifyRight'',''JustifyFull''], ''/'', [''Link'',''Unlink'',''Anchor''], [''Image'',''Flash'',''Table'',''Rule'',''Smiley'',''SpecialChar'',''UniversalKey''], [''TextColor'',''BGColor''], [''mosimage'', ''mospage''], [''Source'',''About''] ]\nContextMenu=[''Generic'',''Link'',''Anchor'',''Image'',''Flash'',''BulletedList'',''NumberedList'',''Table'']\ns:FontColors=000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,808080,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF\ns:FontNames=Arial;Comic Sans MS;Courier New;Tahoma;Times New Roman;Verdana\ns:FontSizes=1/xx-small;2/x-small;3/small;4/medium;5/large;6/x-large;7/xx-large\ns:FontFormats=p;div;pre;address;h1;h2;h3;h4;h5;h6\nSpellChecker=''ieSpell''\ns:IeSpellDownloadUrl=http://iespell.huhbw.com/ieSpellSetup220647.exe\nMaxUndoLevels=15\nDisableObjectResizing=0\nDisableFFTableHandles=1\nLinkDlgHideTarget=0\nLinkDlgHideAdvanced=0\nImageDlgHideLink=0\nImageDlgHideAdvanced=0\nFlashDlgHideAdvanced=0\nLinkBrowser=1\nImageBrowser=1\nFlashBrowser=1\nLinkUpload=1\nImageUpload=1\nFlashUpload=1');
	";
		$database->setQuery( $query );
		if (!$database->query()) {
			die($database->stderr(true));
		}
	}

	// Create Mamhoo's Tables
	$querys1 = array();
	$querys1[] = "
	CREATE TABLE IF NOT EXISTS `#__mamhoo` (
	  `user_id` int(11) NOT NULL default '1',
	  `f01` varchar(255) default NULL,
	  `f02` varchar(255) default NULL,
	  `f03` varchar(255) default NULL,
	  `f04` varchar(255) default NULL,
	  `f05` varchar(255) default NULL,
	  `f06` varchar(255) default NULL,
	  `f07` varchar(255) default NULL,
	  `f08` varchar(255) default NULL,
	  `f09` varchar(255) default NULL,
	  `f10` varchar(255) default NULL,
	  `f11` varchar(255) default NULL,
	  `f12` varchar(255) default NULL,
	  `f13` varchar(255) default NULL,
	  `f14` varchar(255) default NULL,
	  `f15` varchar(255) default NULL,
	  `f16` varchar(255) default NULL,
	  `f17` varchar(255) default NULL,
	  `f18` varchar(255) default NULL,
	  `f19` varchar(255) default NULL,
	  `f20` varchar(255) default NULL,
	  `f21` varchar(255) default NULL,
	  `f22` varchar(255) default NULL,
	  `f23` varchar(255) default NULL,
	  `f24` varchar(255) default NULL,
	  `f25` varchar(255) default NULL,
	  `f26` varchar(255) default NULL,
	  `f27` varchar(255) default NULL,
	  `f28` varchar(255) default NULL,
	  `f29` varchar(255) default NULL,
	  `f30` varchar(255) default NULL,
	  `f31` varchar(255) default NULL,
	  `f32` varchar(255) default NULL,
	  `f33` varchar(255) default NULL,
	  `f34` varchar(255) default NULL,
	  `f35` varchar(255) default NULL,
	  `f36` varchar(255) default NULL,
	  `f37` varchar(255) default NULL,
	  `f38` varchar(255) default NULL,
	  `f39` varchar(255) default NULL,
	  `f40` varchar(255) default NULL,
	  `f41` varchar(255) default NULL,
	  `f42` varchar(255) default NULL,
	  `f43` varchar(255) default NULL,
	  `f44` varchar(255) default NULL,
	  `f45` varchar(255) default NULL,
	  `f46` varchar(255) default NULL,
	  `f47` varchar(255) default NULL,
	  `f48` varchar(255) default NULL,
	  `f49` varchar(255) default NULL,
	  `f50` varchar(255) default NULL,
	  PRIMARY KEY  (`user_id`)
	) TYPE=MyISAM;
	";

	$querys1[] = "
	CREATE TABLE IF NOT EXISTS `#__mamhoo_config` (
	  `id` int(11) NOT NULL default '0',
	  `fieldname` varchar(255) NOT NULL default '',
	  `fieldlabel` varchar(255) default NULL,
	  `fieldshow` char(1) NOT NULL default '0',
	  `fieldtype` varchar(255) default NULL,
	  `fieldrequired` char(1) default '0',
	  `fieldsize` int(11) NOT NULL default '30',
	  `fieldvalue` varchar(255) default NULL,
	  PRIMARY KEY  (`id`)
	) TYPE=MyISAM;
	";

	$querys1[] = "
	CREATE TABLE IF NOT EXISTS `#__mamhoo_salt` (
	  `user_id` int(11) NOT NULL default '0',
	  `password` varchar(100) NOT NULL default '',
	  `salt` varchar(100) NOT NULL default '',
	  `saltapp` varchar(100) NOT NULL default '',
	  PRIMARY KEY  (`user_id`)
	) TYPE=MyISAM;
	";

	$querys1[] = "
	CREATE TABLE IF NOT EXISTS `#__mamhooks` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL default '',
	  `element` varchar(100) NOT NULL default '',
	  `folder` varchar(100) NOT NULL default '',
	  `access` tinyint(3) unsigned NOT NULL default '0',
	  `ordering` int(11) NOT NULL default '0',
	  `published` tinyint(3) NOT NULL default '1',
	  `iscore` tinyint(3) NOT NULL default '0',
	  `client_id` tinyint(3) NOT NULL default '0',
	  `checked_out` int(11) unsigned NOT NULL default '0',
	  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
	  `params` text NOT NULL,
	  PRIMARY KEY  (`id`),
	  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
	) TYPE=MyISAM;
	";

	foreach ($querys1 as $query) {
		$database->setQuery( $query );
		if (!$database->query()) {
			die($database->stderr(true));
		}
	}


	$query = "DELETE FROM `#__components` WHERE `name` like '%Mamhoo%'";
	$database->setQuery( $query );
	if (!$database->query()) {
		die($database->stderr(true));
	}
	
	$query = "SELECT max(id)+1 FROM `#__components`";
	$database->setQuery( $query );
	$Maxid = $database->loadResult();

	$querys2 = array();
	$querys2[] = "
	INSERT INTO `#__components` VALUES ($Maxid, 'Mamhoo', 'option=com_mamhoo', 0, 0, 'option=com_mamhoo', 'Mamhoo', 'com_mamhoo', 0, 'js/ThemeOffice/component.png', 0, '');
	";

	$querys2[] = "
	INSERT INTO `#__components` VALUES ($Maxid+1, 'Mamhoo User Manager', '', 0, $Maxid, 'option=com_mamhoo', 'Mamhoo User Manager', 'com_mamhoo', 0, 'js/ThemeOffice/user.png', 0, '');
	";

	$querys2[] = "
	INSERT INTO `#__components` VALUES ($Maxid+2, 'Mamhoo User Extended Config', '', 0, $Maxid, 'option=com_mamhoo&task=config', 'Mamhoo Config', 'com_mamhoo', 1, 'js/ThemeOffice/config.png', 0, '');
	";

	$querys2[] = "
	INSERT INTO `#__components` VALUES ($Maxid+3, 'Install/Uninstall Mamhooks', '', 0, $Maxid, 'option=com_mamhoo&element=mamhook', 'Install/Uninstall Mamhooks', 'com_mamhoo', 2, 'js/ThemeOffice/install.png', 0, '');
	";

	$querys2[] = "
	INSERT INTO `#__components` VALUES ($Maxid+4, 'About Mamhoo', '', 0, $Maxid, 'option=com_mamhoo&task=about', 'About Mamhoo', 'com_mamhoo', 3, 'js/ThemeOffice/credits.png', 0, '');
	";

	foreach ($querys2 as $query) {
		$database->setQuery( $query );
		if (!$database->query()) {
			die($database->stderr(true));
		}
	}


	$query = "
	UPDATE `#__menu` SET
	`link` = 'index.php?option=com_mamhoo&task=UserDetails'
	WHERE `link` = 'index.php?option=com_user&task=UserDetails';
	";
	$database->setQuery( $query );
	if (!$database->query()) {
		die($database->stderr(true));
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>升级成功！－ 升级曼波4.5.x 或曼波整站系统5.0.0 到曼波整站系统5.1.0</title>
</head>

<body>
升级成功！<br /><br />
为安全起见，请马上删除本升级文件 upgrade1.php 。
</body>
</html>
<?php

}
else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>升级曼波4.5.x 或曼波整站系统5.0.0 到曼波整站系统5.1.0</title>
</head>

<body>
<form name="form1" method="post" action="upgrade1.php">
  <p>升级曼波4.5.x 或曼波整站系统5.0.0 到曼波整站系统5.1.0</p>
  <p>
    <input type="submit" name="Submit" value="开始升级">
    </p>
</form>
</body>
</html>
<?php
}
?>