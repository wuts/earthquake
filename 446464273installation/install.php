<?php
/**
* @version $Id: install.php,v 1.6 2005/02/18 09:21:56 mic Exp $
* @package MMLi
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* @edited mic (developer@mamboworld.net) www.mamboworld.net
*/

define( "_VALID_MOS", 1 );

if (file_exists( "../configuration.php" ) && filesize( "../configuration.php" ) > 10) {
	header( "Location: ../index.php" );
	exit();
}
/** Include common.php */
include_once( "common.php" );

$language_install = trim( mosGetParam( $_POST, 'language_install', '' ) );
$detected_lang = trim( mosGetParam( $_POST, 'detected_lang', '' ) );
$install_iso = trim( mosGetParam( $_POST, 'install_iso', '' ) );
include_once ( 'language_detection.php' );

if ( file_exists( 'language/install_'.$language_install.'.php')) {
	require_once( '../language/'.$language_install.'.php' );
	require_once( 'language/install_'.$language_install.'.php' );
} else {
	require_once( '../language/english.php' );
	require_once( 'language/install_english.php' );
}

echo "<?xml version=\"1.0\" encoding=\"".$install_iso."\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $install_iso; ?>" />
<title><?php echo _MAMBO_WEB_INSTALLER . _INSTALL_STEP_LICENSE; ?></title>
<link rel="shortcut icon" href="../../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script language="JavaScript" type="text/javascript">
<!--
var checkobj

function agreesubmit(el){
	checkobj=el
	//alert("<?php echo html_convert( _INSTALL_LICENSE_ALERT ); ?>")


	if (document.all||document.getElementById){
		for (i=0;i<checkobj.form.length;i++){  //hunt down submit button
		var tempobj=checkobj.form.elements[i];
		if(tempobj.type.toLowerCase()=="submit")
		tempobj.disabled=!checkobj.checked;
		}
	}
}

function defaultagree(el){
	if (!document.all&&!document.getElementById){
		if (window.checkobj&&checkobj.checked)
		return true;
		else{
			alert("<?php echo html_convert( _INSTALL_LICENSE_ALERT ); ?>");
			return false;
		}
	}
}
// -->
</script>
</head>
<body onload="document.adminForm.next.disabled=true;">
<?php
if( file_exists( 'images/header_' . substr( $language_install, 0, 3 ) . '_install.png' ) ){
	$install_img = 'images/header_' . substr( $language_install, 0, 3 ). '_install.png';
}else $install_img = 'images/header_eng_install.png'; ?>
<div id="wrapper">
	<div id="header">
		<div id="mambo">
    		<img src="<?php echo $install_img ; ?>" alt="<?php echo _INSTALL_MAMBO; ?>" />
    		<?php echo '<font color="#FF9900"><strong><a href="http://www.mambochina.net" target="_blank">' . _MAMBORS_VERSION . '</a></strong></font>'; ?>
    	</div>
	</div>
</div>
<div id="ctr" align="center">
    <form action="install1.php" method="post" name="adminForm" id="adminForm" onSubmit="return defaultagree(this)">
    	<input type="hidden" name="language_install" value="<?php echo $language_install; ?>">
    	<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
    	<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
	<div class="install">
    <div id="stepbar">
      	<div class="step-off"><?php echo _INSTALL_STEP_PRECHECK ; ?></div>
		<div class="step-on"><?php echo _INSTALL_STEP_LICENSE ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_1 ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_2 ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_3 ; ?></div>
      </div>
      <div id="right">

      <div id="step"><?php echo _INSTALL_LICENSE_TITLE ; ?></div>

      <div class="far-right">
        <input class="button" type="submit" name="next" value="<?php echo _INSTALL_NEXT ;?>" disabled="disabled" />
      </div>
        <div class="clr"></div>
          <h1><?php echo _INSTALL_LICENSE_TYPE ; ?></h1>
          <div class="licensetext">
    			 <?php 
    			 $Mambors_License = split ('<br />', _D_MAMBORS);
    			 echo $Mambors_License[0] ; 
    			 ?>
    			 <div class="error"><?php echo _INSTALL_LICENSE_CONDITION ; ?></div>

          </div>
          <div class="clr"></div>
          <div class="license-form">
            <div class="form-block" style="padding: 0px;">
				<?php
					if( file_exists( 'language/license/gpl_' . $language_install . '.html' ) ) {
	 					echo '<iframe src="language/license/gpl_' . $language_install . '.html" class="license" frameborder="0" scrolling="auto"></iframe>';
					} else {
						echo '<iframe src="language/license/gpl_english.html" class="license" frameborder="0" scrolling="auto"></iframe>';
					}
				?>
    		</div>
          </div>
          <div class="clr"></div>
          <div class="ctr">
    			   <input type="checkbox" name="agreecheck" class="inputbox" onClick="agreesubmit(this)" />
    		     <?php echo _INSTALL_LICENSE_AGREE ; ?>
    			 </div>
          <div class="clr"></div>
        </div>
        <div id="break"></div>
      <div class="clr"></div>
    <div class="clr"></div>
    </form>

</div>
  <div class="ctr">
	<?php echo _D_MAMBORS ; ?>
  </div>
</body>
</html>
