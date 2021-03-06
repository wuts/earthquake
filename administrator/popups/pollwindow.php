<?php
/**
* @version $Id: pollwindow.php,v 1.1 2005/07/22 01:54:00 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** Set flag that this is a parent file */
define( "_VALID_MOS", 1 );

require_once("../includes/auth.php");

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

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
$database->debug( $mosConfig_debug );

$pollid = mosGetParam( $_REQUEST, 'pollid', 0 );
$css = mosGetParam( $_REQUEST, 't', '' );

$database->setQuery( "SELECT title FROM #__polls WHERE id='$pollid'" );
$title = $database->loadResult();

$database->setQuery( "SELECT text FROM #__poll_data WHERE pollid='$pollid' order by id" );
$options = $database->loadResultArray();

$iso = split( '=', _A_ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _A_ISO; ?>" />
	<title><?php echo $adminLanguage->A_TITLE_PPRE;?></title>
	<link rel="stylesheet" href="../../templates/<?php echo $css; ?>/css/template_css.css" type="text/css">
</head>

<body>
<form>
<table align="center" width="90%" cellspacing="2" cellpadding="2" border="0" >
	<tr>
	    <td class="moduleheading" colspan="2"><?php echo $title; ?></td>
	</tr>
	<?php foreach ($options as $text)
	{
		if ($text <> "")
		{?>
		<tr>
	    	<td valign="top" height="30"><input type="radio" name="poll" value="<?php echo $text; ?>"></td>
			<td class="poll" width="100%" valign="top"><?php echo $text; ?></td>
		</tr>
		<?php }
	} ?>
	<tr>
	    <td valign="middle" height="50" colspan="2" align="center"><input type="button" name="submit" value="<?php echo $adminLanguage->A_VOTE;?>">&nbsp;&nbsp;<input type="button" name="result" value="<?php echo $adminLanguage->A_RESULTS;?>"></td>
	</tr>
	<tr>
	    <td align="center" colspan="2"><a href="#" onClick="window.close()"><?php echo $adminLanguage->A_CLOSE;?></a></td>
	</tr>
</table>
</form>

</body>
</html>
