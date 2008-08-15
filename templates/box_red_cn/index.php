<?php defined( "_VALID_MOS" ) or die( "Direct Access to this location is not allowed." );$iso = split( '=', _ISO );echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;<?php echo _ISO; ?>" />
<?php if ( $my->id ) { initEditor(); } 
$user1 = 0;
$user2 = 0;
$colspan = 0;

//user1 and user2
if ( mosCountModules( 'user1' ) + mosCountModules( 'user2' ) == 2) {
	$user1 = 2;
	$user2 = 2;
	$colspan = 2;
} elseif ( mosCountModules( 'user1' ) == 1 ) {
	$user1 = 1;
	$colspan = 1;
} elseif ( mosCountModules( 'user2' ) == 1 ) {
	$user2 = 1;
	$colspan = 1;
}
?>
<?php mosShowHead(); ?>
<link href="<?php echo $mosConfig_live_site;?>/templates/box_red_cn/css/template_css.css" rel="stylesheet" type="text/css" />
<script language='JavaScript'>
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>
<?php // Custom MainMenu extension...
$database->setQuery("SELECT * FROM #__menu WHERE menutype = 'mainmenu' AND published ='1' AND parent = '0' ORDER BY ordering");
$mymenu_rows = $database->loadObjectList();
$mymenu_content = "";
foreach($mymenu_rows as $mymenu_row) {
	// print_r($mymenu_rows);
	$mymenulink = $mymenu_row->link;
	if ($mymenu_row->type != "url") {
		$mymenulink .= "&Itemid=$mymenu_row->id";
	}
	if ($mymenu_row->type != "separator") {
		$mymenu_content .= " <a href=\"".sefRelToAbs($mymenulink)."\" class=\"bar\">$mymenu_row->name</a>";
	}
}
$mymenu_content = substr($mymenu_content,0,strlen($mymenu_content)-2);
?>
</head>
<body class="page_bg">
<a name="top" id="top"></a>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody><tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td width="23" height="24"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/corner_top1.gif" width="23" height="24"></td>
    <td width="713" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_topedge.gif">&nbsp;</td>
    <td width="24" height="24"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/corner_top2.gif" width="24" height="24"></td>
  </tr></tbody>
</table>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr> 
      <td width="20" height="24" valign="top" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_left.gif"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_left.gif" width="20" height="87"></td>
      <td width="720" valign="top" bgcolor="#FFFFFF"><table width="712" border="0" align="center" cellpadding="0" cellspacing="0">
          <tbody>
            <tr> 
              <td width="173" height="126" align="right" valign="top" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_flash.jpg"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/logo.jpg" width="153" height="106"></td>
              <td align="center" valign="top" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_flash2.jpg" style="background-repeat:no-repeat;background-position:top right">&nbsp;</td>
            </tr>
          </tbody>
        </table>
        <table width="720" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr> 
              <td width="554" height="31" style="border-bottom:solid 1px #981209;border-top:solid 1px #981209;border-right:solid 1px #981209"><table width="552" border="0" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr> 
                      <td width="20" bgcolor="#961206">&nbsp;</td>
                      <td width="532" height="25" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_navi.gif" bgcolor="#961206" style="background-repeat:no-repeat;background-position:bottom right;"><?php echo $mymenu_content ?></td>
                    </tr>
                  </tbody>
                </table></td>
              <td width="157" align="center" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_flash2.jpg" style="background-repeat:no-repeat;background-position:bottom right;border-bottom:solid 1px #981209"><?php echo mosCurrentDate(); ?></td>
              <td width="4" style="border-bottom:solid 1px #981209"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/spacer.png" width="4" height="5"></td>
            </tr>
          </tbody>
        </table>
        <table width="720" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr> 
              <td width="555" valign="top" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_grey.gif" style="border-right:solid 1px #981209;background-position:top right;"><table width="555" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr bgcolor="#F1F3F2"> 
                      <td height="24" colspan="2" align="right" style="padding-right:8px;border-bottom:solid 1px #D0D0D0"> 
                        <?php mosPathWay(); ?>
                      </td>
                    </tr>
                       </tbody>
                </table>
<table width="543" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:3px;margin-bottom:3px">
  <tbody>
  								<?php 
								if ($colspan > 0) {
								?>
										<tr valign="top" class="line">
											<?php
										if ( $user1 > 0 ) {
											?>
											<td width="50%">
                <?php mosLoadModules ( 'user1' ); ?>
			  											<?php
										}	
										if ( $colspan == 2) {
											 ?>
												<td width="1" style="border-left:solid 1px #C47A74">
													<img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/spacer.png" alt="" title="spacer" border="0" height="10" width="1">	
												</td>
											<?php
											}
										if ( $user2 > 0 ) {
											?>
											<td width="50%">
                <?php mosLoadModules ( 'user2'); ?>
			  											<?php
										}	
											?>
								  </tr>
												<?php
												}
											?>
												<tr>
												<td colspan="<?php echo $colspan; ?>">
												</td>
											</tr>

  </tbody>
</table>                
                <table width="555" border="0" cellspacing="0" cellpadding="0" style="border-top:solid 1px #961309;border-bottom:solid 1px #961309">
                  <tbody>
                    <tr> 
                      <td width="18" valign="top" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/pic_justsimple.gif"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/pic_justsimple.gif" width="18" height="305"></td>
                      <td align="center" valign="top" style="padding-left:4px;padding-right:4px"> 
                        <?php
					mosMainBody();
					?>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table width="545" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table></td>
              <td width="162" align="center" valign="top" bgcolor="#F5F5F5"><table width="157" border="0" cellpadding="0" cellspacing="0" bgcolor="#971106" style="margin-top:2px;margin-bottom:5px">
                  <form action='index.php' method='post'>
                    <tbody>
                      <tr> 
                        <td height="25" align="center"> <input size="18" class="searchbox" type="text" name="searchword" style="width:150px;" value="search..."  onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" /> 
                          <input type="hidden" name="option" value="search" /> 
                        </td>
                      </tr>
                    </tbody>
                  </form>
                </table>
                <?php mosLoadModules ( 'left' ); ?>
              </td>
            </tr>
          </tbody>
        </table></td>
      <td width="20" height="24" valign="top" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_right.gif"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_right.gif" width="20" height="87"></td>
    </tr>
  </tbody>
</table>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="23"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/corner_bom1.gif" width="23" height="5" /></td>
    <td width="553" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_grey.gif" bgcolor="#FFFFFF" style="border-right:solid 1px #961206;background-position:top right;"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/spacer.png" width="33" height="5" /></td>
    <td width="158" bgcolor="#F5F5F5"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/spacer.png" width="33" height="5" /></td>
    <td width="24"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/corner_bom2.gif" width="24" height="5" /></td>
  </tr>
</table>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr> 
      <td width="23" height="19" valign="top"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/corner_bom1a.gif" width="23" height="19"></td>
      <td width="716" align="center" valign="top" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/bg_bomedge.gif" bgcolor="#FFFFFF">&nbsp;</td>
      <td width="24" height="19" valign="top"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/corner_bom2a.gif" width="24" height="19" /></td>
    </tr>
  </tbody>
</table>
<div align="center">Your information here | Design 
        by <a href="http://canaan-design.com" target="_blank"><strong>Magicbox</strong></a> from 
        <strong><a href="http://www.mambochina.net/" target="_blank">MamboChina Team</a></strong><br />
			  <?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?></div></body>
</html>
