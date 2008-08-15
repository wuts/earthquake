<?php

if ( !empty($_REQUEST['Submit']) ) {
	define( '_VALID_MOS', 1 );

	require_once( 'configuration.php' );
	require_once( 'includes/mambo.php' );

	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
	
	$query = "SELECT id FROM #__content WHERE state = -2";
	$database->setQuery( $query );
	$contentids = $database->loadResultArray();
	if ($contentids) {
		$contentids=implode(', ', $contentids);
		$query = "DELETE FROM #__content_frontpage WHERE content_id IN ( $contentids )";
		$database->setQuery( $query );
		$database->query();
	}
	
	$queries =
	"ALTER TABLE `#__menu` ADD `sefpath` VARCHAR( 255 ) AFTER `name`
	UPDATE `#__components` SET `admin_menu_link` = 'option=categories&section=com_contact' WHERE `admin_menu_link` ='option=categories&section=com_contact_details'
	UPDATE `#__categories` SET `section` = 'com_contact' WHERE `section` ='com_contact_details'
	DROP TABLE #__messages
	DROP TABLE #__messages_cfg
	DELETE FROM #__modules WHERE module ='mod_unread'
	DELETE FROM #__content WHERE state = -2
	DELETE FROM #__menu WHERE published = -2
	UPDATE #__banner SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__bannerclient SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__categories SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__contact_details SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__content SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__mambots SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__mamhooks SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__menu SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__modules SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__newsfeeds SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__polls SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__sections SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	UPDATE #__weblinks SET checked_out='0', checked_out_time='0000-00-00 00:00:00'
	DELETE FROM #__menu WHERE link='index.php?option=com_user&task=CheckIn'";

	$queries = explode("\n", $queries);
	
	foreach ($queries as $query) {
		if (!empty($query)) {
			$database->setQuery( $query );
			if (!$database->query()) {
				//die($database->stderr(true));
			}
		}
	}


	$query = "SELECT `catid`, count( * ) as `catcount`
						FROM `#__content`
						WHERE `state`=1
						GROUP BY `catid`";

	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	foreach ($rows as $row) {
		$query = "UPDATE `#__categories` c1
							SET c1.`count`='" . $row->catcount . "'
							WHERE c1.`id`='" . $row->catid . "'";
		$database->setQuery( $query );
		if (!$database->query()) {
			die($database->stderr(true));
		}
	}
	
	$query = "SELECT `sectionid`, count( * ) as `seccount`
						FROM `#__content`
						WHERE `state`=1
						GROUP BY `sectionid`";

	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	foreach ($rows as $row) {
		$query = "UPDATE `#__sections` s1
							SET s1.`count`='" . $row->seccount . "'
							WHERE s1.`id`='" . $row->sectionid . "'";
		$database->setQuery( $query );
		if (!$database->query()) {
			die($database->stderr(true));
		}
	}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>升级成功！－ 升级曼波整站系统5.4.0 到曼波整站系统5.5.0</title>
</head>

<body>
升级成功！<br /><br />
为安全起见，请马上删除本升级文件 upgrade3.php 。
</body>
</html>
<?php

}
else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>升级曼波整站系统5.4.0 到曼波整站系统5.5.0</title>
</head>

<body>
<form name="form1" method="post" action="upgrade3.php">
  <p>升级曼波整站系统5.4.0 到曼波整站系统5.5.0</p>
  <p>
    <input type="submit" name="Submit" value="开始升级">
    </p>
</form>
</body>
</html>
<?php
}
?>