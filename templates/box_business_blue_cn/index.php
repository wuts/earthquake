<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// needed to seperate the ISO number from the language file constant _ISO
$iso = split( '=', _ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php
if ( $my->id ) {
	initEditor();
}
?>
<?php mosShowHead(); ?>
<script language='JavaScript'>
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>
<link href="<?php echo $mosConfig_live_site;?>/templates/box_business_blue_cn/css/template_css.css" rel="stylesheet" type="text/css" />
<!-- GET THE CSS-menu-->
<?php
require($mosConfig_absolute_path."/templates/box_business_blue_cn/mysplitcssmenu.php");
?>
</head>
<body class="bg">
<a name="top" id="top"></a><table width="760" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
  <tr>
   <td width="5">&nbsp;</td>
  <td width="547" align="right" valign="top" style="border-right:2px solid #7e7e7e;border-left:1px solid #d7d7d7">
		<div id="logo_bg"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/logo.gif" width="202" height="47" vspace="5" /></div>
		<div class="clr"></div>
	<div id="hr"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/line_hor.gif" /></div>
		<div class="clr"></div>
	<div id="banner"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/banner.jpg" width="536" height="64" /></div>
		<div class="clr"></div>
	<div id="hr"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/line_hor.gif" /></div>
		<div class="clr"></div>
	<div class="navcontainer"><?php echo  $mycssONLY_PRI_menu ?></div>
		<div class="clr"></div>
	<div id="intro_area">
        <table width="423" border="0" cellspacing="0" cellpadding="0" align="right" style="padding-right:10px">
  <tr>
    <td><font color="#FF6600" style="line-height:24px"><strong>welcome to</strong></font><strong> 
          Company Name</strong><br />
              We listen and effectively respond to your needs and those of your 
              clients. We are experts at translating those needs into marketing 
              solutions that work, look great and communicate well. Each day brings 
              increased opportunity to increase business in current as well as 
              new. <img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/arrow.gif" /> 
              <strong><font color="#FF6600"><a href="#">read more</a></font></strong></td>
  </tr>
</table>
      </div>
		<div class="clr"></div>
	<div id="pathway"><?php mosPathWay(); ?></div>
		<div class="clr"></div>
					<div id="mainbody">
						<?php
					if ( mosCountModules( 'user1' ) ) {
						?>
						<div id="user1">
							<?php mosLoadModules ( 'user1' ); ?>
						</div>
						<?php
					}
					if (mosCountModules( 'user2' )) {
						?>
						<div id="user2">
							<?php mosLoadModules ( 'user2' ); ?>
						</div>
						<?php
					}
					?></div>
					<div class="clr"></div>
          <?php mosMainBody(); ?>
        <div class="clr"></div>
		
	<div id="hr"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/line_hor.gif" /></div>
		<div class="clr"></div>
<table id="bottom" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">	<div id="bnavi"> <a href="<?php echo $mosConfig_live_site;?>/index.php?option=com_frontpage&Itemid=1">Home</a> | <a href="#">Service</a> 
              | <a href="#">Sitemap</a> | <a href="#">Contactus</a> </div>
		<div class="clr"></div>
	        <div id="copyright">(c)2004 Your company name | Designed by <a href="http://canaan-design.com/" target="_blank">Magicbox</a> 
              from <a href="http://www.mambochina.net/" target="_blank">MamboChina</a><br />
			  <?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
			  </div></td>
          <td valign="top"><a href="#top"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/top.gif" border="0" /></a></td>
  </tr>
</table>
</td>
    <td width="205" align="center" valign="top" bgcolor="#f3f3f3" style="padding-left:2px;padding-right:3px;border-left:2px solid #ffffff;border-right:3px solid #ffffff;">
	<div id="smallnav">
        <div class="snavtext"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $mosConfig_live_site;?>/index.php?option=com_frontpage&Itemid=1">home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">aboutus</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $mosConfig_live_site;?>/index.php?option=com_contact&Itemid=3">contact</a></div>
      </div>
		<div class="clr"></div>
<table width="190" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px">
  <form action='index.php' method='post'><tr>
    <td width="145" align="right"><input size="15" class="search" type="text" name="searchword" value="search..."  onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" />
                  <input type="hidden" name="option" value="search" /></td>
    <td width="40"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/search.gif" /></td>
  </tr>
</form></table>
		<div class="clr"></div>
      <div class="rightside">    <?php mosLoadModules ( 'left' );	?></div>
</td>
  </tr>
</table>
</body>
</html>
