<?php
/**
* @version $Id: contentwindow.php,v 1.1 2005/07/22 03:19:43 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** Set flag that this is a parent file */
define( "_VALID_MOS", 1 );

require_once( '../includes/auth.php' );
include_once ( $mosConfig_absolute_path . '/language/' . $mosConfig_lang . '.php' );

// adminLanguage Language
if ($mosConfig_alang === NULL) {
	include_once ($mosConfig_absolute_path."/language/admin_english.php"); 
}
else {
	if (file_exists ($mosConfig_absolute_path."/language/admin_".$mosConfig_alang.".php")) {
		include_once ($mosConfig_absolute_path."/language/admin_".$mosConfig_alang.".php");
	}
}

$adminLanguage =& new adminLanguage();

$css = mosGetParam( $_REQUEST, 't', '' );

$iso = split( '=', _A_ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _A_ISO; ?>" />
<title><?php echo $adminLanguage->A_TITLE_CPRE;?></title>
<link rel="stylesheet" href="../../templates/<?php echo $css.(!$adminLanguage->RTLsupport ? '/css/template_css.css' : '/css/template_css_rtl.css'); ?>" type="text/css" /> <!-- rtl change -->
	<script>
		var form = window.opener.document.adminForm
		var title = form.title.value;

		var alltext = form.introtext.value;
		if (form.fulltext) {
			alltext += form.fulltext.value;
		}

		// do the images
		var temp = new Array();
		for (var i=0, n=form.imagelist.options.length; i < n; i++) {
			value = form.imagelist.options[i].value;
			parts = value.split( '|' );

			temp[i] = '<img src="../../images/stories/' + parts[0] + '" align="' + parts[1] + '" border="' + parts[3] + '" alt="' + parts[2] + '" hspace="6" />';
		}

		var temp2 = alltext.split( '{mosimage}' );

		var alltext = temp2[0];

		for (var i=0, n=temp2.length-1; i < n; i++) {
			alltext += temp[i] + temp2[i+1];
		}
	</script>
</head>
<body style="background-color:#FFFFFF">
<table align="center" width="90%" cellspacing="2" cellpadding="2" border="0">
	<tr>
		<td class="contentheading" colspan="2"><script>document.write(title);</script></td>
	</tr>
	<tr>
		<script>document.write("<td valign=\"top\" height=\"90%\" colspan=\"2\">" + alltext + "</td>");</script>
	</tr>
	<tr>
		<td align="right"><a href="#" onClick="window.close()"><?php echo $adminLanguage->A_CLOSE;?></a></td>
		<td align="left"><a href="javascript:;" onClick="window.print(); return false"><?php echo $adminLanguage->A_PRINT;?></a></td>
	</tr>
</table>
</body>
</html>