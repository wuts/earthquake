<?php
// $Id: pdf.php,v 1.17 2004/04/07 11:56:02 rcastley Exp $
/**
* PDF code
* @package Mambo Open Source
* @Copyright (C) 2000 - 2003 Miro International Pty Ltd
* @ All rights reserved
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.17 $
* Created by Phil Taylor me@phil-taylor.com
* Support file to display PDF Text Only using class from - http://www.ros.co.nz/pdf/readme.pdf
* HTMLDoc is available from: http://www.easysw.com/htmldoc and needs installing on the server for better HTML to PDF conversion
**/

//Modified by Eddy Chang (mambo.eyesofkids.net)
//Last Updated 28062004


// THIS IS NOT A STANDARD MAMBO CORE FILE BY HAS BEEN MODIFIED BY PHIL TAYLOR <mambo@phil-taylor.com>

// ensure this file is being included by a parent file



defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang, $mosConfig_offset, $mosConfig_hideAuthor, $mosConfig_hideModifyDate, $mosConfig_hideCreateDate, $mosConfig_live_site;

dofreePDF ($database);

function dofreePDF ($database) {
	global $mosConfig_lang, $mosConfig_live_site, $mosConfig_sitename, $mosConfig_offset, $mosConfig_hideCreateDate,
		$mosConfig_hideAuthor, $mosConfig_hideModifyDate, $mosConfig_absolute_path, $cur_template;

	$id = strtolower( trim( mosGetParam( $_REQUEST, 'id',1 ) ) );
	$row = new mosContent( $database );
	$row->load($id);
	$row->text = $row->introtext . $row->fulltext;

	ob_start();
	
	//bellow: Copy from old version pdf.php	
	//Find Author Name
	$users_rows = new mosUser( $database );
	$users_rows->load($row->created_by);
	$row->author = $users_rows->name;
	$row->usertype = $users_rows->usertype;
	
	$txt1 = $row->title;
	//$pdf->ezText($txt1,14);

	$txt2=null;
	$mod_date = null; $create_date = null;
	if (intval( $row->modified ) <> 0) {
		$mod_date = mosFormatDate($row->modified);
	}
	if (intval( $row->created ) <> 0) {
		$create_date = mosFormatDate($row->created);
	}

	if ($mosConfig_hideCreateDate == "0") {
		$txt2 .= "(".$create_date.") - ";
	}

	if ($mosConfig_hideAuthor == "0") {
		if ($row->author != "" && $mosConfig_hideAuthor == "0") {
			$txt2 .=  $row->created_by_alias ? $row->created_by_alias : $row->author;
		}
	}

	if ($mosConfig_hideModifyDate == "0" && $mod_date!="0") {
		$txt2 .= " - " . _LAST_UPDATED." (".$mod_date.") ";
	}
	//up: copy from old version pdf.php
	
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title><?php echo $txt1; ?><?php echo $txt2; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $cur_template;?>/css/template_css.css" />
	</head>
	<body class="contentpane">
	<P>
	<?php echo PDF_mosimage($row);?>
	</body></html>
	<?
	$row->html = ob_get_contents();
	ob_end_clean();
  
	require($mosConfig_absolute_path."/includes/fpdf/fpdf_include.php" );

	$pdf = new PDF();

	switch ($mosConfig_lang) {
		case 'simplified_chinese':
			$pdf->AliasNbPages(); 
			$pdf->AddGBhwFont();
			$pdf->Open();
			$pdf->SetFont('GB-hw', '', 12);
			$row->html = str_replace('&ldquo;', '¡°', $row->html );
			$row->html = str_replace('&rdquo;', '¡±', $row->html );
			break;
		case 'simplified_chinese_utf-8':
			$pdf->AliasNbPages(); 
			$pdf->AddGBhwFont();
			$pdf->Open();
			$pdf->SetFont('GB-hw', '', 12);
			$row->html = mos_convert_encoding($row->html, 'GB2312', 'UTF-8');
			$row->html = str_replace('&ldquo;', '¡°', $row->html );
			$row->html = str_replace('&rdquo;', '¡±', $row->html );
			break;
		case 'traditional_chinese':
			$pdf->AliasNbPages(); 
			$pdf->AddBig5hwFont();
			$pdf->Open();
			$pdf->SetFont('Big5-hw', '', 12);
			$row->html = str_replace('&ldquo;', '¡°', $row->html );
			$row->html = str_replace('&rdquo;', '¡±', $row->html );
			break;
		case 'traditional_chinese_utf-8':
			$pdf->AliasNbPages(); 
			$pdf->AddBig5hwFont();
			$pdf->Open();
			$pdf->SetFont('Big5-hw', '', 12);
			$row->html = mos_convert_encoding($row->html, 'BIG5', 'UTF-8');
			$row->html = str_replace('&ldquo;', '¡°', $row->html );
			$row->html = str_replace('&rdquo;', '¡±', $row->html );
			break;
		default:
			$pdf->Open();
			$pdf->SetFont('Arial', '', 11);
			break;
	}
	//end switch
		
	$pdf->AddPage();
	$row->html = html_entity_decode( $row->html );
	$pdf->WriteHTML($row->html);
	//save and redirect
	// filename, dest (I = Inline, D = download, F = Save to local file, S = return as string)
	$pdf->Output("mambors-content$id.pdf","I");
}

function decodeHTML($string) {
	$string = strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
	$string = preg_replace("/&#([0-9]+);/me", "chr('\\1')", $string);
	return $string;
}

function get_php_setting($val) {
	$r =  (ini_get($val) == '1' ? 1 : 0);
	return $r ? 'ON' : 'OFF';
}

function PDF_mosimage( $row ) {
	global $mosConfig_live_site, $mosConfig_absolute_path;

	$row->images = explode( "\n", $row->images );
	$images = array();

	foreach ($row->images as $img) {
		$img = trim( $img );
		if ($img) {
			$temp = explode( '|', trim( $img ) );
			if (!isset( $temp[1] )) {
				$temp[1] = "left";
			}
			if (!isset( $temp[2] )) {
				$temp[2] = "Image";
			} else {
				$temp[2] = htmlspecialchars( $temp[2] );
			}
			if (!isset( $temp[3] )) {
				$temp[3] = "0";
			}
			$size = '';
			if (function_exists( 'getimagesize' )) {
				$size = @getimagesize( "$mosConfig_absolute_path/images/stories/$temp[0]" );
				if (is_array( $size )) {
					$size = "width=\"$size[0]\" height=\"$size[1]\"";
				}
			}
			$images[] = "<img src=\"$mosConfig_live_site/images/stories/$temp[0]\" $size align=\"$temp[1]\"  hspace=\"6\" alt=\"$temp[2]\" border=\"$temp[3]\" />";
		}
	}

	$text = explode( '{mosimage}', $row->text );

	$row->text = $text[0];

	for ($i=0, $n=count( $text )-1; $i < $n; $i++) {
		if (isset( $images[$i] )) {
			$row->text .= $images[$i];
		}
		if (isset( $text[$i+1] )) {
			$row->text .= $text[$i+1];
		}
	}
	unset( $text );
	return $row->text;
}
?>
