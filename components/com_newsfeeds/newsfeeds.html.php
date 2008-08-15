<?php
/** 
* version $Id: newsfeeds.html.php,v 1.1 2005/07/22 01:54:50 eddieajau Exp $
* @package Mambo
* @subpackage Newsfeeds
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* 
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Newsfeeds
*/
class HTML_newsfeed {

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
		<form action="index.php" method="post" name="adminForm">

		<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>">
		<tr>
			<td width="60%" valign="top" class="contentdescription<?php echo $params->get( 'pageclass_sfx' ); ?>" colspan="2">
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
		<tr>
			<td>
			<?php
			if ( count( $rows ) ) {
				HTML_newsfeed::showTable( $params, $rows, $catid, $tabclass );
			}
			?>
			</td>
		</tr>
		<tr>	
			<td>&nbsp;
						
			</td>
		</tr>
		<tr>
			<td>
			<?php
			// Displays listing of Categories
			if ( empty( $catid ) || $params->get( 'other_cat' ) ) {
				HTML_newsfeed::showCategories( $params, $categories, $catid );
			}
			?>
			</td>
		</tr>
		</table>
		</form>
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
		$img = mosAdminMenus::ImageCheck( 'con_info.png', '/images/M_images/', $params->get( 'icon' ) );
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<?php
		if ( $params->get( 'headings' ) ) {
			?>
			<tr>
				<?php 
				if ( $params->get( 'name' ) ) {
					?>
					<td height="20" class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>">
					<?php echo _FEED_NAME; ?>
					</td>
					<?php 
				}
				?>
				<?php 
				if ( $params->get( 'articles' ) ) {
					?>
					<td height="20" class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>" align="center">
					<?php echo _FEED_ARTICLES; ?>
					</td>
					<?php 
				}
				?>
				<?php 
				if ( $params->get( 'link' ) ) {
					?>
					<td height="20" class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>">
					<?php echo _FEED_LINK; ?>
					</td>
					<?php 
				}
				?>
				<td width="100%" class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>"></td>
			</tr>
			<?php 
		} 

		$k = 0;
		foreach ($rows as $row) {
			$link = 'index.php?option=com_newsfeeds&amp;task=view&amp;catid='. $catid . '&amp;feedid='. $row->id .'&amp;Itemid='. $Itemid;
			?>
			<tr>
				<?php 
				if ( $params->get( 'name' ) ) {
					?>
					<td width="30%" height="20" class="<?php echo $tabclass[$k]; ?>"> 
					<a href="<?php echo sefRelToAbs( $link ); ?>" class="category<?php echo $params->get( 'pageclass_sfx' ); ?>">
					<?php echo $row->name; ?> 
					</a> 
					</td>
					<?php 
				} 
				?>
				<?php 
				if ( $params->get( 'articles' ) ) {
					?>
					<td width="20%" class="<?php echo $tabclass[$k]; ?>" align="center">
					<?php echo $row->numarticles; ?>
					</td>
					<?php 
				} 
				?>
				<?php 
				if ( $params->get( 'link' ) ) {
					?>
					<td width="50%" class="<?php echo $tabclass[$k]; ?>">
					<?php echo $row->link; ?>
					</td>
					<?php 
				} 
				?>
				<td width="100%"></td>
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
	function showCategories( &$params, &$categories, $catid ) {
		global $mosConfig_live_site, $Itemid;
		?>
		<ul>
		<?php
		foreach ( $categories as $cat ) {
			if ( $catid == $cat->catid ) {
				?>	
				<li>
					<b>
					<?php echo $cat->title;?>
					</b>
					&nbsp;
					<span class="small">
					(<?php echo $cat->numlinks;?>)
					</span>
				</li>
				<?php		
			} else {
				$link = 'index.php?option=com_newsfeeds&amp;catid='. $cat->catid .'&amp;Itemid='. $Itemid;
				?>	
				<li>
					<a href="<?php echo sefRelToAbs( $link ); ?>" class="category<?php echo $params->get( 'pageclass_sfx' ); ?>">
					<?php echo $cat->title;?> 
					</a>
					<?php
					if ( $params->get( 'cat_items' ) ) {
						?>
						&nbsp;
						<span class="small">
						(<?php echo $cat->numlinks;?>)
						</span>
						<?php
					}
					?>
					<?php
					// Writes Category Description
					if ( $params->get( 'cat_description' ) ) {
						echo '<br />';
						echo $cat->description;
					}
					?>
				</li>
				<?php		
			}
		}
		?>
		</ul>
		<?php
	}


	function showNewsfeeds( &$newsfeeds, $LitePath, $cacheDir, &$params ) {
		global $mosConfig_live_site, $mosConfig_absolute_path;
		?>
		<table width="100%" class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>">	
		<?php 
		if ( $params->get( 'header' ) ) {
			?>
			<tr>
				<td class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>" colspan="2">
				<?php echo $params->get( 'header' ); ?>
				</td>
			</tr>
			<?php
		}
		
		//get mambo charset
		$temps = explode('=', _ISO);
		$MAMBO_CHARSET = strtoupper( trim( $temps[1] ) );
		if ( $MAMBO_CHARSET == 'UTF8' ) $MAMBO_CHARSET = 'UTF-8';

		foreach ( $newsfeeds as $newsfeed ) {
			// full RSS parser used to access image information
			$rssDoc =& new xml_domit_rss_document();
			$rssDoc->useCacheLite( true, $LitePath, $cacheDir, $newsfeed->cache_time );
			$rssDoc->loadRSS( $newsfeed->link );
			$totalChannels = $rssDoc->getChannelCount();
			
			$xmldoc =& $rssDoc->node;
			$xmlstring = strtoupper($xmldoc->xmldeclaration->nodeValue);
			$xmlstrings =& new mosParameters( str_replace(' ', "\n", $xmlstring) );
			$feedEncoding = strtoupper($xmlstrings->get('ENCODING', 'GB2312'));
			if ( $feedEncoding == 'UTF8' ) $feedEncoding = 'UTF-8';

			for ( $i = 0; $i < $totalChannels; $i++ ) {
				$currChannel	=& $rssDoc->getChannel($i);
				$elements 		= $currChannel->getElementList();
				$descrip 		= 0;
				$iUrl			= 0;
				foreach ( $elements as $element ) {
					//image handling				
					if ( $element == 'image' ) {
						$image =& $currChannel->getElement( DOMIT_RSS_ELEMENT_IMAGE );
						$iUrl	= $image->getUrl();
						$iTitle	= $image->getTitle();
						if (($feedEncoding != $MAMBO_CHARSET) && ($feedEncoding != 'ISO-8859-1') && ($feedEncoding == 'UTF-8' || $MAMBO_CHARSET == 'UTF-8')) {
							$iTitle = mos_convert_encoding($iTitle, $MAMBO_CHARSET, $feedEncoding);
						}
					}
					if ( $element == 'description' ) {
						$descrip = 1;
						// hide com_rss descrip in 4.5.0 feeds
						if ( $currChannel->getDescription() == 'com_rss' ) {
							$descrip = 0;
						}						
					}
				}
				
				?>
				<tr>
					<td class="contentheading<?php echo $params->get( 'pageclass_sfx' ); ?>">
					<a href="<?php echo $currChannel->getLink(); ?>" target="_child">
					<?php 
						$cTitle = $currChannel->getTitle();
						if (($feedEncoding != $MAMBO_CHARSET) && ($feedEncoding != 'ISO-8859-1') && ($feedEncoding == 'UTF-8' || $MAMBO_CHARSET == 'UTF-8')) {
							$cTitle = mos_convert_encoding($cTitle, $MAMBO_CHARSET, $feedEncoding);
						}
						echo $cTitle; 
					?>
					</a>
					</td>
				</tr>
				<?php 
				// feed description
				if ( $descrip && $params->get( 'feed_descr' ) ) {
					?>
					<tr>
						<td>
						<?php
						$cDescription = $currChannel->getDescription();
						if (($feedEncoding != $MAMBO_CHARSET) && ($feedEncoding != 'ISO-8859-1') && ($feedEncoding == 'UTF-8' || $MAMBO_CHARSET == 'UTF-8')) {
							$cDescription = mos_convert_encoding($cDescription, $MAMBO_CHARSET, $feedEncoding);
						}
						echo $cDescription; 
						?>
						<br /><br />
						</td>
					</tr>
					<?php
				}
				// feed image
				if ( $iUrl && $params->get( 'feed_image' ) ) {
					?>
					<tr>
						<td>
						<image src="<?php echo $iUrl; ?>" alt="<?php echo $iTitle; ?>" />
						</td>
					</tr>
					<?php
				}
				$actualItems 	= $currChannel->getItemCount();
				$setItems 		= $newsfeed->numarticles;
				if ( $setItems > $actualItems ) {
					$totalItems = $actualItems;
				} else {
					$totalItems = $setItems;
				}
				?>
				<tr>
					<td>
					<ul>
					<?php
					for ( $j = 0; $j < $totalItems; $j++ ) {
						$currItem =& $currChannel->getItem($j);
						?>
							<li>
							<a href="<?php echo $currItem->getLink(); ?>" target="_child">
							<?php 
								$itemTitle = $currItem->getTitle();
								if (($feedEncoding != $MAMBO_CHARSET) && ($feedEncoding != 'ISO-8859-1') && ($feedEncoding == 'UTF-8' || $MAMBO_CHARSET == 'UTF-8')) {
									$itemTitle = mos_convert_encoding($itemTitle, $MAMBO_CHARSET, $feedEncoding);
								}
								echo $itemTitle; 
							?>			
							</a> 
							<?php 
							// item description
							if ( $params->get( 'item_descr' ) ) {
								$itemDescription = $currItem->getDescription();
								if (($feedEncoding != $MAMBO_CHARSET) && ($feedEncoding != 'ISO-8859-1') && ($feedEncoding == 'UTF-8' || $MAMBO_CHARSET == 'UTF-8')) {
									$itemDescription = mos_convert_encoding($itemDescription, $MAMBO_CHARSET, $feedEncoding);
								}
								echo $itemTitle; 
								$itemDescription 	= html_entity_decode( $itemDescription );

								?>
								<br />
								<?php echo $itemDescription; ?>						
								<br/><br/>
								<?php
							}
							?>
							</li>
						<?php
					}
					?>
					</ul>
					</td>
				</tr>
				<tr>
					<td>
					<br />
					</td>
				</tr>
				<?php
			}
		}
		?>
		</table>
		<?php
		// displays back button
		mosHTML::BackButton ( $params );
	}

}
?>