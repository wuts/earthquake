<?php defined( "_VALID_MOS" ) or die( "Direct Access to this location is not allowed." );$iso = split( '=', _ISO );echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php if ( $my->id ) { initEditor(); } ?>
<?php mosShowHead(); ?>

<link href="<?php echo $mosConfig_live_site;?>/templates/box_windmill_cn/css/template_css.css" rel="stylesheet" type="text/css" />
<script language='JavaScript'>
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>
</head>

<body class="bg_main">
<a name="top"></a> 
<div>
<div id="blank"></div>
<div id="logo_area">
<div id="logo"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/logo.gif" /></div>
<div id="search"><table border="0" cellpadding="0" cellspacing="0">
                    <form action="index.php" method="post">
                      <tbody>
                        <tr> 
                          <td align="right"><input class="searchbox" type="text" name="searchword" size="12" value="Search the site..."  onblur="if(this.value=='') this.value='Search the site...';" onfocus="if(this.value=='Search the site...') this.value='';" />
                <input type="hidden" name="option" value="search" /> </td>
                        </tr>
                      </tbody>
                    </form>
                  </table></div>
				  </div>
<div id="clr"></div>
<div id="header"><div id="headerpic"></div></div>
<div id="clr"></div>
<div id="midarea">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr> 
          <td width="30">&nbsp;</td>
          <td width="25" align="right" bgcolor="#FFFFFF" style="border-left:1px solid #CBCDCE;"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/iconpath.gif" width="9" height="9" /></td>
          <td bgcolor="#FFFFFF" style="border-right:1px solid #CBCDCE"><div id="can_pathway">
              <?php mosPathWay(); ?>
            </div></td>
          <td width="30">&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr> 
          <td width="30">&nbsp;</td>
          <td width="10" bgcolor="#FFFFFF" style="border-left:1px solid #CBCDCE">&nbsp;</td>
          <td width="170" align="left" valign="top" bgcolor="#FFFFFF"> <div id="leftmain"> 
            <?php mosLoadModules ( "left" ); ?>
          </div></td>
          <td width="20" bgcolor="#FFFFFF">&nbsp;</td>
          <td align="left" valign="top" bgcolor="#FFFFFF">
         <?php	if ( mosCountModules( 'top' ) ) { ?>
         <div id="newsflash"><?php mosLoadModules ( 'top' ); ?></div>
  <?php
				}
				?>
		  <?php	if ( mosCountModules( 'user1' ) ) { ?>
                            <div id="blocks"> 
                                <?php mosLoadModules ( "user1" ); ?>
                              </div> <div id="clr"></div>
  <?php
				}
				?>
<?php	if ( mosCountModules( 'user2' ) ) { ?>
                           <div id="blocks"><?php mosLoadModules ( "user2" ); ?></div><div id="clr"></div>
 <?php
				}
				?>
                          
				                       <div id="main_area"> 
                          <?php mosMainBody(); ?>
                        </div></td>
  <?php	if ( mosCountModules( 'right' ) ) { ?>
         <td width="20" bgcolor="#FFFFFF">&nbsp;</td>
          <td width="175" align="left" valign="top" bgcolor="#FFFFFF">
		  <div id="leftmain">
                    <?php mosLoadModules ( "right" ); ?>
                  </div></td>
<?php
				}
				?> 
				          <td width="10" bgcolor="#FFFFFF" style="border-right:1px solid #CBCDCE">&nbsp;</td>
          <td width="30">&nbsp;</td>
        </tr>
      </tbody>
    </table>
</div>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border-top:1px solid #CBCDCE">
    <tbody>
      <tr> 
        <td width="30">&nbsp;</td>
        <td bgcolor="#FFFFFF"><div id="botnavi"><?php mosLoadModules ( "user3" ); ?></div></td>
        <td width="30">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" bgcolor="#FFFFFF"><div id="bottomarea">Copyright Infotmation 
            overhere. | <a href="http://canaan-design.com" target="_blank">designed 
            by Magicbox</a> from <a href="http://www.mambochina.net/" target="_blank">Mambochina</a><br />
			  <?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?></div></td>
        <td>&nbsp;</td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>
