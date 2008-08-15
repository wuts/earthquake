<?php
/**
* @version $Id: mod_quickicon.php,v 1.2 2005/10/20 01:08:31 cfraser Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $adminLanguage;

?>
<table width="100%" class="cpanel">
<tr>
	<td align="center" style="height:100px">
	<a href="index2.php?option=com_content&amp;sectionid=0" style="text-decoration:none;">
	<img src="images/addedit.png" width="48" height="48" align="middle" border="0"/>
	<br />
	<?php echo $adminLanguage->A_ALL_MANAGER;?>
	</a>
	</td>
	<td align="center" style="height:100px">
	<a href="index2.php?option=com_typedcontent" style="text-decoration:none;">
	<img src="images/addedit.png" width="48" height="48" align="middle" border="0"/>
	<br />
	<?php echo $adminLanguage->A_STATIC_MANAGER;?>
	</a>
	</td>
	<td align="center" style="height:100px">
	<a href="index2.php?option=com_frontpage" style="text-decoration:none;">
	<img src="images/frontpage.png" width="48" height="48" align="middle" border="0"/>
	<br />
	<?php echo $adminLanguage->A_FRONTPAGE_MANAGER;?>
	</a>
	</td>
	<td align="center" style="height:100px">
	<a href="index2.php?option=com_admin&amp;task=help" style="text-decoration:none;">
	<img src="images/support.png" width="48" height="48" align="middle" border="0"/>
	<br />
	<?php echo $adminLanguage->A_HELP;?>
	</a>
	</td>
</tr>
<tr>
	<td align="center" style="height:100px">
	<a href="index2.php?option=com_sections&amp;scope=content" style="text-decoration:none;">
	<img src="images/sections.png" width="48" height="48" align="middle" border="0"/>
	<br />
	<?php echo $adminLanguage->A_SECTION_MANAGER;?>
	</a>
	</td>
	<td align="center" style="height:100px">
	<a href="index2.php?option=com_categories&amp;section=content" style="text-decoration:none;">
	<img src="images/categories.png" width="48" height="48" align="middle" border="0"/>
	<br />
	<?php echo $adminLanguage->A_CATEGORY_MANAGER;?>
	</a>
	</td>
	<td align="center" style="height:100px">
	<a href="index2.php?option=com_media" style="text-decoration:none;">
	<img src="images/mediamanager.png" width="48" height="48" align="middle" border="0"/>
	<br />
	<?php echo $adminLanguage->A_MENU_MEDIA_MANAGE;?>
	</a>
	</td>
	<td align="center" style="height:100px">
	&nbsp;
	</td>
</tr>

<tr>
	<td align="center" style="height:100px">
	<?php
	if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_menumanager' ) ) {
		?>
		<a href="index2.php?option=com_menumanager" style="text-decoration:none;">
		<img src="images/menu.png" width="48" height="48" align="middle" border="0"/>
		<br />
		<?php echo $adminLanguage->A_MENU_MANAGER;?>
		</a>
		<?php
	}
	?>
	</td>
	<td align="center" style="height:100px">
	<?php
	if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
		?>
		<a href="index2.php?option=com_users" style="text-decoration:none;">
		<img src="images/user.png" width="48" height="48" align="middle" border="0"/>
		<br />
		<?php echo $adminLanguage->A_MENU_USER_MANAGE;?>
		</a>
		<?php
	}
	?>
	</td>
	<td align="center" style="height:100px">
	<?php
	if ( $acl->acl_check( 'administration', 'config', 'users', $my->usertype ) ) {
		?>
		<a href="index2.php?option=com_config&amp;hidemainmenu=1" style="text-decoration:none;">
		<img src="images/config.png" width="48" height="48" align="middle" border="0"/>
		<br />
		<?php echo $adminLanguage->A_GLOBAL_CONF;?>
		</a>
		<?php
	}
	?>
	</td>
	<td align="center" style="height:100px">
	&nbsp;
	</td>
</tr>
</table>