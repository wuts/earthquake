<?php
/**
* @version $Id: weblinks.html.php,v 1.1 2005/07/22 01:54:57 eddieajau Exp $
* @package Mambo
* @subpackage Weblinks
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/HTML_toolbar.php' );

/**
* @package Mambo
* @subpackage Weblinks
*/
class HTML_weblinks {

	function displaylist( &$categories, &$rows, $catid, $currentcat=NULL, &$params, $tabclass ) {
		global $Itemid, $mosConfig_live_site, $hide_js;
		if ( $params->get( 'page_title' ) ) {
			?>
			<div class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>">
			<?php echo $currentcat->header; ?>
			</div>
			<?php
		}
		?>

		<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>">
		<tr>
			<td width="100%" valign="top" class="contentdescription<?php echo $params->get( 'pageclass_sfx' ); ?>" >
			<?php
			// show image
			if ( $currentcat->img ) {
				?>
				<img src="<?php echo $currentcat->img; ?>" align="<?php echo $currentcat->align; ?>" hspace="6" alt="<?php echo _WEBLINKS_TITLE; ?>" />
				<?php
			}
			echo $currentcat->descrip;
			?>
			</td>
		</tr>
		<?php if ( $catid && count( $rows ) ) {	?>
		<tr>
			<td><?php HTML_weblinks::showTable( $params, $rows, $catid, $tabclass ); ?>
			</td>
		</tr>
		<?php }	?>
		<tr>
			<td>
			<?php
			// Displays listing of Categories
			if ( empty( $catid ) || $params->get( 'other_cat' ) ) {
				HTML_weblinks::showCategories( $params, $categories, $catid, $rows );
			}
			?>
			</td>
		</tr>
		</table>
		<?php
		// displays back button
		mosHTML::BackButton ( $params, $hide_js );
	}

	/**
	* Display Table of items
	*/
	function showTable( &$params, &$rows, $catid, $tabclass ) {
		global $mosConfig_live_site, $Itemid;
		// icon in table display
		if ( $params->get( 'weblink_icons' ) <> -1 ) {
			$img = mosAdminMenus::ImageCheck( 'weblink.png', '/images/M_images/', $params->get( 'weblink_icons' ) );
		} else {
			$img = NULL;
		}
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?php
		if ( $params->get( 'headings' ) ) {
			?>
			<tr>
				<?php
				if ( $img ) {
					?>
					<td width="5%" class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>">&nbsp;

					</td>
					<?php
				}
				?>
				<td width="90%" class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>">
				<?php echo _HEADER_TITLE_WEBLINKS; ?>
				</td>
				<?php
				if ( $params->get( 'hits' ) ) {
					?>
					<td width="5%" class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>" >
					<?php echo _HEADER_HITS; ?>
					</td>
					<?php
				}
				?>
			</tr>
			<?php
		}

		$k = 0;
		foreach ($rows as $row) {
			//$iparams =& new mosParameters( $row->params );

			$link = sefRelToAbs( 'index.php?option=com_weblinks&task=view&catid='. $catid .'&id='. $row->id . '&Itemid='. $Itemid );
			$menuclass = 'category'.$params->get( 'pageclass_sfx' );
			$txt = '<a href="'. $link .'" target="_blank" class="'. $menuclass .'">'. $row->title .'</a>';
			/*
			switch ($iparams->get( 'target' )) {
				// cases are slightly different
				case 1:
				// open in a new window
				$txt = '<a href="'. $link .'" target="_blank" class="'. $menuclass .'">'. $row->title .'</a>';
				break;

				case 2:
				// open in a popup window
				$txt = "<a href=\"#\" onclick=\"javascript: window.open('". $link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\">". $row->title ."</a>\n";
				break;

				default:	// formerly case 2
				// open in parent window
				$txt = '<a href="'. $link .'" class="'. $menuclass .'">'. $row->title .'</a>';
				break;
			}
			*/
			?>
			<tr class="<?php echo $tabclass[$k]; ?>">
				<?php
				if ( $img ) {
					?>
					<td align="center">
					&nbsp;&nbsp;<?php echo $img;?>&nbsp;&nbsp;
					</td>
					<?php
				}
				?>
				<td>
				<?php echo $txt; ?>
				<?php
				if ( $params->get( 'item_description' ) ) {
					?>
					<br />
					<?php echo $row->description; ?>
					<?php
				}
				?>
				</td>
				<?php
				if ( $params->get( 'hits' ) ) {
					?>
					<td>
					<?php echo $row->hits; ?>
					</td>
					<?php
				}
				?>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php
	}

	/**
	* Display links to categories
	*/
	function showCategories( &$params, &$categories, $catid, &$rows ) {
		global $mosConfig_live_site, $Itemid;
		if ($catid) {
			?>
			<ul>
			<?php
			foreach ( $categories as $cat ) {
				if ( $catid == $cat->id ) {
					?>
					<li>
						<b>
						<?php echo $cat->name;?>
						</b>
						&nbsp;
						<span class="small">
						(<?php echo $cat->numlinks;?>)
						</span>
					</li>
					<?php
				} else {
					$link = 'index.php?option=com_weblinks&catid='. $cat->id .'&Itemid='. $Itemid;
					?>
					<li>
						<a href="<?php echo sefRelToAbs( $link ); ?>" class="category<?php echo $params->get( 'pageclass_sfx' ); ?>">
						<?php echo $cat->name;?>
						</a>
						&nbsp;
						<span class="small">
						(<?php echo $cat->numlinks;?>)
						</span>
					</li>
					<?php
				}
			}
			?>
			</ul>
			<?php
		}
		else {
			?>
			<table>
			<?php
			foreach ( $categories as $cat ) {
				$link = sefRelToAbs('index.php?option=com_weblinks&catid='. $cat->id .'&Itemid='. $Itemid);
				$cattext = '<a href="'. $link .'" class="category'. $params->get( 'pageclass_sfx' ) .'">'. $cat->name . '</a>';
				$catmore = '<a href="'. $link .'" class="category'. $params->get( 'pageclass_sfx' ) .'">'. _MORE . '</a>';
				?>
				<tr>
					<td>
						<?php echo $cattext;?>&nbsp;<span class="small">(<?php echo $cat->numlinks;?>)</span>
					</td>
					<td>
				<?php
				foreach ($rows[$cat->id] as $row) {
					$link = sefRelToAbs( 'index.php?option=com_weblinks&task=view&catid='. $cat->id .'&id='. $row->id );
					$menuclass = 'category'.$params->get( 'pageclass_sfx' );
					// open in a new window
					$txt = '&nbsp;&nbsp;<a href="'. $link .'" target="_blank" class="'. $menuclass .'">'. $row->title .'</a>';
					echo $txt;
				}
				echo '&nbsp;&nbsp;' . $catmore;
				?>
					</td>
				</tr>
				<?php
				
			}
			?>
			</table>
			<?php
		}
	}

	/**
	* Writes the edit form for new and existing record (FRONTEND)
	*
	* A new record is defined when <var>$row</var> is passed with the <var>id</var>
	* property set to 0.
	* @param mosWeblink The weblink object
	* @param string The html for the categories select list
	*/
	function editWeblink( $option, &$row, &$lists ) {
		$Returnid = intval( mosGetParam( $_REQUEST, 'Returnid', 0 ) );
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (form.title.value == ""){
				alert( "Weblink item must have a title" );
			} else if (getSelectedValue('adminForm','catid') < 1) {
				alert( "You must select a category." );
			} else if (form.url.value == ""){
				alert( "You must have a url." );
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<form action="<?php echo sefRelToAbs("index.php"); ?>" method="post" name="adminForm" id="adminForm">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td class="contentheading">
			<?php echo _SUBMIT_LINK;?>
			</td>
			<td width="10%">
			<?php
			mosToolBar::startTable();
			mosToolBar::spacer();
			mosToolBar::save();
			mosToolBar::cancel();
			mosToolBar::endtable();
			?>
			</td>
		</tr>
		</table>

		<table cellpadding="4" cellspacing="1" border="0" width="100%">
		<tr>
			<td width="20%" align="right">
			<?php echo _NAME; ?>
			</td>
			<td width="80%">
			<input class="inputbox" type="text" name="title" size="50" maxlength="250" value="<?php echo htmlspecialchars( $row->title, ENT_QUOTES );?>" />
			</td>
		</tr>
		<tr>
			<td valign="top" align="right">
			<?php echo _SECTION; ?>
			</td>
			<td>
			<?php echo $lists['catid']; ?>
			</td>
		</tr>
		<tr>
			<td valign="top" align="right">
			<?php echo _URL; ?>
			</td>
			<td>
			<input class="inputbox" type="text" name="url" value="<?php echo $row->url; ?>" size="50" maxlength="250" />
			</td>
		</tr>
		<tr>
			<td valign="top" align="right">
			<?php echo _URL_DESC; ?>
			</td>
			<td>
			<textarea class="inputbox" cols="30" rows="6" name="description" style="width:300px" width="300"><?php echo htmlspecialchars( $row->description, ENT_QUOTES );?></textarea>
			</td>
		</tr>
		</table>

		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="ordering" value="<?php echo $row->ordering; ?>" />
		<input type="hidden" name="Returnid" value="<?php echo $Returnid; ?>" />
		</form>
		<?php
	}

}
?>