<?php defined( "_VALID_MOS" ) or die( "Direct Access to this location is not allowed." );$iso = split( '=', _ISO );echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<meta http-equiv="Content-Type" content="text/html;<?php echo _ISO; ?>" />
<script language='JavaScript'>
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>
<link href="<?php echo $mosConfig_live_site;?>/templates/box_mychildhood_cn/css/template_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="main_div">
<div align="left" id="top_bg"></div>
		<div class="clr"></div>
  <table width="939" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr> 
      <td width="56" align="center" valign="bottom" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/index_r2_c1.gif"><div align="right"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/index_r5_c1.gif" width="56" height="442" /></div></td>
      <td width="157" align="center" valign="top"><div align="center"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/main01_02.gif" width="157" height="93" /></div>
         <div class="clr"></div>
       <div id="left_outline"> 
      <?php mosLoadModules ( 'left' );	?>
        </div>

	   	   <div align="right"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/main01_08.gif" width="157" height="92" /></div>
	   </td>
       <td width="36" valign="top" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/index_r4_c3.gif"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/index_r2_c3.gif" width="36" height="103" /></td>
      <td width="443" valign="top"> 
	   <div id="pathrow"> 
	   <div id="pathway"> 
          <?php mosPathWay(); ?>
        </div>
				<div id="search">
		<?php mosLoadModules ( 'user4', -1 ); ?>
		</div></div>
        <div class="clr"></div>
        <div id="header_area"> 
          <div id="header"> 
            <?php mosLoadModules ( 'user5' );	?>
          </div>
          <div id="scroll_bg"> 
            <?php mosLoadModules ( 'top' );	?>
          </div>
        </div>
        <div class="clr"></div>
        <hr color="#CCCCCC" size="1" width="100%" /> 
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tbody>
  								<?php 
								if ($colspan > 0) {
								?>
										<tr valign="top">
											<?php
										if ( $user1 > 0 ) {
											?>
											<td width="50%">
                <?php mosLoadModules ( 'user1' ); ?>
			  											<?php
										}	
										if ( $colspan == 2) {
											 ?>
												<td width="3">
													<img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/spacer.png" alt="" title="spacer" border="0" height="10" width="1">												</td>
											<?php
											}
										if ( $user2 > 0 ) {
											?>
											<td width="50%">
                <?php mosLoadModules ( 'user2'); ?>
								  <?php
										}	
											?>								  </tr>
												<?php
												}
											?>
												<tr>
												<td colspan="<?php echo $colspan; ?>">												</td>
											</tr>
  </tbody>
</table>					
					<div class="clr"></div>
		<div class="content_area"> 
          <?php mosMainBody(); ?>
        </div>
        <div class="clr"></div></td>
      <td width="240" valign="bottom" background="templates/<?php echo $GLOBALS['cur_template']; ?>/images/index_r3_c5.gif"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/dh.gif" width="233" height="336" /></td>
    </tr>
  </table>
</div>
					<div class="clr"></div>
<div id="bottom">
<?php include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' ); ?>
</div>
<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>
