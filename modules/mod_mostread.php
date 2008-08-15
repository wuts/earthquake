<?php
/**
* @version $Id: mod_mostread.php,v 1.3 2008/03/03 01:58:29 lang3 Exp $
* @package Mambors
* @copyright (C) 2004 - 2008 mambochina.net
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambors is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_offset, $mosConfig_live_site, $mainframe, $menuIdVars, $homeItemid;

$class_sfx	= trim( $params->get( 'moduleclass_sfx' ) );
$count 		= intval( $params->get( 'count', 5 ) );
$target		= intval( $params->get( 'target', 0 ) );
$catid 		= trim( $params->get( 'catid' ) );
$secid 		= trim( $params->get( 'secid' ) );
$show_front	= $params->get( 'show_front', 1 );
$show_headline = intval( $params->get( 'show_headline', 0 ) );
$moduletitle = $params->get( 'moduletitle' );
$seccat_style = intval( $params->get( 'seccat_style', 0 ) ); // style of section/category, 0 -- list, 1 -- blog
$count = $show_headline ? $count + 1 : $count;
// Title Length
$titlelength = intval( $params->get( 'titlelength', 40 ) );
$datedisplay = $params->get( 'datedisplay', 'm-d' );

$now 		= date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60 );

$more = _MORE . ( $show_headline ? $moduletitle : '' );

$linkmore = '';
if ($catid) {
	$pieces = explode(",", $catid);
	$id = intval($pieces[0]);
	if ($id) {
		$query = "SELECT section FROM #__categories WHERE id=$id";
		$database->setQuery( $query );
		$sectionid = $database->loadResult();
		$aItemid = getContentItemid( $sectionid, $id, 0 );
		if ($aItemid == $homeItemid) {
			if ($seccat_style) {
				$linkmore = "index.php?option=com_content&task=blogcategory&sectionid=$sectionid&id=$id";
			}
			else {
				$linkmore = "index.php?option=com_content&task=category&sectionid=$sectionid&id=$id";
			}
		}
		else {
			$linkmore = $menuIdVars[$aItemid]->link;
		}
		$linkmore .= "&Itemid=$aItemid";
		$linkmore = sefRelToAbs( $linkmore );
	}
}
else if ($secid) {
	$pieces = explode(",", $secid);
	$sectionid = intval($pieces[0]);
	if ($sectionid) {
		$aItemid = getContentItemid( $sectionid, 0, 0 );
		if ($seccat_style) {
			$linkmore = "index.php?option=com_content&task=blogsection&id=$sectionid";
		}
		else {
			$linkmore = "index.php?option=com_content&task=section&id=$sectionid";
		}
		$linkmore .= "&Itemid=$aItemid";
		$linkmore = sefRelToAbs( $linkmore );
	}
}

$target = $target ? ' target="_blank" ' : '';

$access = !$mainframe->getCfg( 'shownoauth' );

$query = "SELECT a.id, a.title, a.introtext, a.created_by_alias, a.created, a.urls, a.hits, a.sectionid, a.catid"
	. "\n FROM #__content AS a"
	. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id"
	. "\n WHERE ( a.state = '1' AND a.checked_out = '0' AND a.sectionid > '0' )"
	. ( $access ? "\n AND a.access <= '". $my->gid ."'" : '' )
	. ( $catid ? "\n AND ( a.catid IN (". $catid .") )" : '' )
	. ( $secid ? "\n AND ( a.sectionid IN (". $secid .") )" : '' )
	. ( $show_front == "0" ? "\n AND f.content_id IS NULL" : '' )
	. "\n ORDER BY a.hits DESC LIMIT $count"
	;
$database->setQuery( $query );
$rows = $database->loadObjectList();

if (!is_null($rows)) {
// Output begin
?>

	<table border=0 cellpadding=0 cellspacing=0>
	<tr> 
	<?php if ( $show_headline ) {
		$row = array_shift($rows);
		$id = $row->id;
		$sectionid = $row->sectionid;
		$catid = $row->catid;
		// get Itemid
		$_Itemid = getContentItemid( $sectionid, $catid, $id );
		// Blank itemid checker for SEF
		if ($_Itemid == NULL) {
			$_Itemid = '';
		} else {
			$_Itemid = "&Itemid=$_Itemid";
		}
		if ( $row->urls ) {
			$link_on = "index.php?option=com_content&task=wrapper&sectionid=$sectionid&catid=$catid&id=$id$_Itemid";
		}
		else {
			$link_on = "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id$_Itemid";
		}
		$link_on = sefRelToAbs($link_on);
		$Author = '&nbsp;&nbsp;' . $row->created_by_alias ? $row->created_by_alias : $row->author;
		$create_date = '&nbsp;&nbsp;' . mosFormatDate( $row->created );
	?>
		<td width="50%" align="left" valign="top">
			<table border="0" cellpadding="0" cellspacing="0">
			<?php if (!empty($moduletitle)) {?>
			<tr>
				<th align="left" valign="top">
				<?php 
				if ($linkmore) {
				?>
				<a href="<?php echo $linkmore; ?>" >
				<?php echo $moduletitle; ?>
				</a>
				<?php 
				}
				else {
					echo $moduletitle;
				}
				?>
				</th>
			</tr>
			<?php 
			}
			?>
			<tr>
				<td class="contentheading<?php echo $class_sfx; ?>" align="left" valign="top" width="100%">
				<a href="<?php echo $link_on;?>" <?php echo $target;?> class="contentpagetitle<?php echo $class_sfx; ?>">
				<?php echo $row->title;?>
				</a>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
				<span class="small"><?php echo $Author; ?></span>
				<span class="createdate"><?php echo $create_date; ?></span>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
				<?php
				// displays Item introtext
				echo $row->introtext;
				?>
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
				<a href="<?php echo $link_on;?>" <?php echo $target;?> class="readon<?php echo $class_sfx; ?>">
				<?php echo _READ_MORE;?>
				</a>
				</td>
			</tr>
			</table>
		</td>
	<?php } 
	?>
		<td align="left" valign="top">
			<ul class="latestnews<?php echo $class_sfx; ?>">
			<?php
			foreach ( $rows as $row ) {
				$sectionid = $row->sectionid;
				$catid = $row->catid;
				$id = $row->id;
				// get Itemid
				$_Itemid = getContentItemid( $sectionid, $catid, $id );
				// Blank itemid checker for SEF
				if ($_Itemid == NULL) {
					$_Itemid = '';
				} else {
					$_Itemid = "&Itemid=$_Itemid";
				}
				
				$link = sefRelToAbs( "index.php?option=com_content&task=view&sectionid=$sectionid&catid=$catid&id=$id$_Itemid" );
				?>
				<li class="latestnews<?php echo $class_sfx; ?>">
				<a href="<?php echo $link; ?>"<?php echo $target; ?> title="<?php echo $row->title;?>" class="latestnews<?php echo $class_sfx; ?>">
				<?php 
					$title =  $row->title;
					if (strlen($title) > $titlelength) {
						$title =  substr( $title, 0, $titlelength ) . "...";
					}
					$datestr = $datedisplay ? ' (' . date($datedisplay, strtotime( $row->created ) ) . ')' : '';
					echo $title . $datestr;
				?>
				</a>
				</li>
				<?php
			}

			// Show More
			if ($linkmore) {
				?>
				<div id="readmore"><a href="<?php echo $linkmore; ?>" >
				<?php echo $more; ?>
				</a>
				</div>
				<?php
			}
			?>
			
			</ul>
		</td>
	</tr>
	</table>
<?php
// end of output
}
?>