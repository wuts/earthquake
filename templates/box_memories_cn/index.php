<?php defined( "_VALID_MOS" ) or die( "Direct Access to this location is not allowed." );$iso = split( '=', _ISO );echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--
Site Name:
Developed By:
Date Created:
Last Updated:
Copyright:
-->

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php mosShowHead(); ?>
<script language='JavaScript'>
function bluring(){
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus();
}
document.onfocusin=bluring;
</script>

<!-- GET THE CSS-menu-->
<?php
require($mosConfig_absolute_path."/templates/box_business_blue_cn/mysplitcssmenu.php");
?>
	<title></title>
	
	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site;?>/templates/box_memories_cn/css/global.css" />
	
	<!--Lightbox CSS - Remove if not needed-->
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site;?>/templates/box_memories_cn/css/lightbox.css" media="screen" />

	
	<!--Character Encoding-->
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
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
	<!--Lightbox JS - Remove if not needed-->
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
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

<body>
	<!--Main Container - Centers Everything-->
	<div id="mainContainer">
		
		<!--Header-->
		<div id="header">
			<div id="logo">
			 <ul id="top_Nav">
				<!--Give your links uniqure IDs if using Image Replacement or Rollover-->
				<li id="navMap"><a href="/index.html"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/icons/icon_map.gif" /></a></li>

				<li id="navHome"><a href="#"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/icons/icon_home.gif" /></a></li>
				<li id="navMail"><a href="#"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/imagess/icons/icon_mail.gif" /></a></li>				
			  </ul>
			</div>
			<div id="theme">
              <span id="themeTitle">主打影片标题</span>			
			  <div id="themeCover"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/pictures/theme_cover.jpg" /></div>
			</div>
			<!--Nav-->

			<div class="clearThis"></div>
		
			<ul id="nav">
				<!--Give your links uniqure IDs if using Image Replacement or Rollover-->
				<li id="navAboutUs"><a href="/index.html">关于我们</a></li>
				<li id="navDirectorLog"><a href="#">导演手记</a></li>
				<li id="navWorks"><a href="#">相关作品</a></li>
				<li id="navPictureLog"><a href="#">图片日志</a></li>

				<li id="navThanks"><a href="#">特别鸣谢</a></li>
				<li id="navContact"><a href="#">联系我们</a></li>
			</ul>
			
		</div>
        <div id="topNav"> 
            <?php mosLoadModules ( 'top' );	?>
        </div>
		<!--Main Content-->
		<div id="mainContent">
			<div id="leftCol">
			  <h6>更新日志</h6>

			  <p class="title">标题标题标题标题标题</p>
			  <p class="title">标题标题标题标题标题</p>
			  <p class="title">标题标题标题标题标题</p>
			  <p id="readMore">Read More</p>
			</div>
			<div id="rightCol">
			<h6>作品系列</h6>

			<ul id="pictureNav">
				<!--Give your links uniqure IDs if using Image Replacement or Rollover-->
				<li><a href="#"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/pictures/work1.jpg" /><span></span></a></li>
				<li><a href="#"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/pictures/work2.jpg" /><span></span></a></li>
				<li><a href="#"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/pictures/work3.jpg" /><span></span></a></li>
				<li><a href="#"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/pictures/work4.jpg" /><span></span></a></li>
				<li><a href="#"><img src="templates/<?php echo $GLOBALS['cur_template']; ?>/images/pictures/work5.jpg" /><span></span></a></li>
			</ul>
			</div>

		</div>
		
		<!--Footer-->
		<div id="footer">
		   <p>版权信息</p>
		</div>
	</div>
</body>
</html>