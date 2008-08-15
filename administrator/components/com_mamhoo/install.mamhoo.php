<?php
/**
* $Id: install.mamhoo.php,v 3.0  2007-05-31
* @package Mamhoo3.0
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

function com_install() {
	global $database;
	global $mosConfig_absolute_path, $mosConfig_lang;
	global $g_errno, $g_errMsg;
	
	$langfile = $mosConfig_absolute_path . '/components/com_mamhoo/language/'.$mosConfig_lang.'.php';
	if ( file_exists ($langfile) ) {
		require_once( $langfile );
	} 
	else {
		require_once ( $mosConfig_absolute_path . '/components/com_mamhoo/language/english.php' ); 
	}



	// Change UserMenu items : 
	// 'index.php?option=com_user&task=UserDetails'
	// to 'index.php?option=com_mamhoo&task=UserDetails'
	$sql = "UPDATE #__menu 
			SET `link`='index.php?option=com_mamhoo&task=UserDetails'
			WHERE `link`='index.php?option=com_user&task=UserDetails' ";
	$database->setQuery($sql);
	$database->query();

	// Show installation result
	?>
	<center>
	<table width="100%" border="0">
	  <tr>
		<td>
		  <strong><?php echo _MAMHOO_COMPONENT; ?></strong><br/>
		  <?php echo _MAMHOO_LICENSE; ?><br/>
		</td>
	  </tr>
	  <tr>
		<td>
		  <?php echo _MAMHOO_INST_SUCC; ?>
		</td>
	  </tr>
	  <tr>
		<td>
		  <?php echo _MAMHOO_INST_DESC; ?>
		</td>
	  </tr>
	</table>
	</center>
<?php
}
?>