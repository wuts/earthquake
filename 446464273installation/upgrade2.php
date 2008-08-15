<?php

if ( !empty($_REQUEST['Submit']) ) {
	define( '_VALID_MOS', 1 );

	require_once( 'configuration.php' );
	require_once( 'includes/mambo.php' );

	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
	
	$queries =
	"ALTER TABLE `#__categories` DROP INDEX `idx_checkout` 
	ALTER TABLE `#__categories` DROP INDEX `idx_access` 
	ALTER TABLE `#__categories` DROP INDEX `idx_section` 
	ALTER TABLE `#__categories` DROP INDEX `cat_idx` , ADD INDEX `idx_section_pid` ( `section` , `parent_id` ) 
	
	ALTER TABLE `#__components` ADD INDEX `idx_name` ( `name` ) 
	
	ALTER TABLE `#__content` DROP INDEX `idx_mask`
	ALTER TABLE `#__content` DROP INDEX `idx_checkout` 
	ALTER TABLE `#__content` DROP INDEX `idx_section` , ADD INDEX `idx_sec_created` ( `sectionid` , `created` ) 
	ALTER TABLE `#__content` DROP INDEX `idx_catid` , ADD INDEX `idx_cat_created` ( `catid` , `created` ) 
	ALTER TABLE `#__content` ADD INDEX `idx_created` ( `created` ) 
	
	ALTER TABLE `#__core_acl_aro` CHANGE `section_value` `section_value` VARCHAR( 100 ) NOT NULL
	ALTER TABLE `#__core_acl_aro` CHANGE `value` `value` VARCHAR( 100 ) NOT NULL 
	
	ALTER TABLE `#__core_acl_aro_sections` CHANGE `value` `value` VARCHAR( 100 ) NOT NULL 
	ALTER TABLE `#__core_acl_aro_sections` CHANGE `name` `name` VARCHAR( 255 ) NOT NULL 
	
	ALTER TABLE `#__core_acl_groups_aro_map` CHANGE `section_value` `section_value` VARCHAR( 100 ) NOT NULL 
	
	ALTER TABLE `#__core_acl_aro` DROP INDEX `#__gacl_section_value_value_aro` 
	ALTER TABLE `#__core_acl_aro` DROP INDEX `#__gacl_hidden_aro`
	
	ALTER TABLE `#__core_acl_aro_groups` DROP INDEX `#__gacl_parent_id_aro_groups` 
	
	ALTER TABLE `#__core_acl_aro_sections` DROP INDEX `#__gacl_hidden_aro_sections`
	ALTER TABLE `#__core_acl_aro_sections` DROP INDEX `#__gacl_value_aro_sections` 
	
	ALTER TABLE `#__session` DROP INDEX `whosonline` , ADD INDEX `idx_whosonline` ( `guest` , `time` , `usertype` ) 
	
	ALTER TABLE `#__users` CHANGE `username` `username` VARCHAR( 50 ) NOT NULL 
	ALTER TABLE `#__users` ADD INDEX `idx_username` ( `username` ) 
	
	ALTER TABLE `#__weblinks` DROP INDEX `catid` , ADD INDEX `catid` ( `catid` , `published` )";

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
<title>升级成功！－ 升级曼波整站系统5.1.0 到曼波整站系统5.2.0</title>
</head>

<body>
升级成功！<br /><br />
为安全起见，请马上删除本升级文件 upgrade2.php 。
</body>
</html>
<?php

}
else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>升级曼波整站系统5.1.0 到曼波整站系统5.2.0</title>
</head>

<body>
<form name="form1" method="post" action="upgrade2.php">
  <p>升级曼波整站系统5.1.0 到曼波整站系统5.2.0</p>
  <p>
    <input type="submit" name="Submit" value="开始升级">
    </p>
</form>
</body>
</html>
<?php
}
?>