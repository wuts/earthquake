<?php
	/**
	* @version $Id: fpdf_include.php,v 1.3 2004/06/10 09:31:08 rcastley Exp $
	* @package MOS_4.6
	* @subpackage fpdf_include
	* @copyright (C) 2000 - 2004 Miro International Pty Ltd
	* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
	* Mambo Open Source is Free Software
	*/
	 
	// ensure this file is being included by a parent file
	defined('_VALID_MOS' ) or die('Direct Access to this location is not allowed.' );
	global $mosConfig_absolute_path;
	if (!defined('RELATIVE_PATH')) define('RELATIVE_PATH',"$mosConfig_absolute_path/includes/fpdf/");
	if (!defined('FPDF_FONTPATH')) define('FPDF_FONTPATH',RELATIVE_PATH.'font/');
	require_once(RELATIVE_PATH.'chinese.php');
	//
	//HTML2PDF by Clément Lavoillotte
	//ac.lavoillotte@noos.fr
	//webmaster@streetpc.tk
	//http://www.streetpc.tk
	 
	//function hex2dec
	//returns an associative array (keys: R,G,B) from
	//a hex html code (e.g. #3FE5AA)
	
	//Modified by Eddy Chang (mambo.eyesofkids.net)
	//Last Updated 28062004
	
	function hex2dec($couleur = "#000000") {
		$R = substr($couleur, 1, 2);
		$rouge = hexdec($R);
		$V = substr($couleur, 3, 2);
		$vert = hexdec($V);
		$B = substr($couleur, 5, 2);
		$bleu = hexdec($B);
		$tbl_couleur = array();
		$tbl_couleur['R'] = $rouge;
		$tbl_couleur['G'] = $vert;
		$tbl_couleur['B'] = $bleu;
		return $tbl_couleur;
	}
	 
	//conversion pixel->millimeter in 72 dpi
	function px2mm($px) {
		return $px * 25.4/72;
	}
	 
	function txtentities($html) {
		$trans = get_html_translation_table(HTML_ENTITIES);
		$trans = array_flip($trans);
		return strtr($html, $trans);
	}
	////////////////////////////////////
	 
	class PDF extends PDF_Chinese {
		//variables of html parser
		var $B;
		var $I;
		var $U;
		var $HREF;
		var $inCell;
		var $fontList;
		var $issetfont;
		var $issetcolor;
		
	   function Header()
	   {
	   global $mosConfig_sitename;
	   	
	   
	   }

	   function Footer()
	  {
	  	global $mosConfig_live_site;
	  	$this->Line(2,280,208,280);
		//Position at 1.5 cm from bottom
	   
	   $this->SetY(-15);
	   //Arial italic 8
	   $this->SetFont('Arial','I',8);
	   //Page number
	   $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	   $this->Cell(0,10,$mosConfig_live_site,0,0,'R');
	   }
		 
		function PDF($orientation = 'P', $unit = 'mm', $format = 'A4') {
			//Call parent constructor
			$this->PDF_Chinese($orientation, $unit, $format);
			//Initialization
			$this->B = 0;
			$this->I = 0;
			$this->U = 0;
			$this->HREF = '';
			$this->inCell = 0;
			$this->inTable = 0;
			$this->fontlist = array("arial", "times", "courier", "helvetica", "symbol");
			$this->issetfont = false;
			$this->issetcolor = false;
		}
		 
		//////////////////////////////////////
		//html parser
		 
		function WriteHTML($html) {
			 
			$html = str_replace("<li>", "<BR>-", $html);
			$html = str_replace("<LI>", "<BR>-", $html);
			$html = str_replace("</LI>", "<BR>", $html);
			$html = str_replace("</li>", "<BR>", $html);
			$html = str_replace("</div>", "<BR>", $html);
			$html = str_replace("</DIV>", "<BR>", $html);

			$html = str_replace("<a href='javascript:window.close();'>Close Window</a>", "<BR>", $html);
			 
			$html = strip_tags($html, "<b><u><i><a><img><p><br><strong><em><font><table><tr><td><blockquote>"); //remove all unsupported tags
			$html = str_replace("\n", '', $html); 
		 
			$a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE); //explodes the string
			foreach($a as $i => $e) {
				if ($i%2 == 0) {
					//Text
					if ($this->inTable) {
						if ($this->inCell) {
							//$this->Cell(40, 6, txtentities($e), 5);
							
							
							$this->Cell(40, 6, txtentities($e),1);
							//$this->Cell(40, 6, $e,1);
							
						}
					} else {
						if ($this->HREF) {
							$this->PutLink($this->HREF, $e);
						} else {
							//$this->Write(5, addslashes(txtentities($e))));
						   
							
							//$this->Write(5, txtentities($e));
							
							$this->Write(5, $e);
						}
					}
				} else {
					//Tag
					if ($e {
						0 }
					== '/')
					$this->CloseTag(strtoupper(substr($e, 1)));
					else
						{
						//Extract attributes
						$a2 = explode(' ', $e);
						$tag = strtoupper(array_shift($a2));
						$attr = array();
						foreach($a2 as $v)
						if (ereg('^([^=]*)=["\']?([^"\']*)["\']?$', $v, $a3))
						$attr[strtoupper($a3[1])] = $a3[2];
						$this->OpenTag($tag, $attr);
					}
				}
			}
		}
		 
		function OpenTag($tag, $attr) {
			//  print_r ($tag);
			//Opening tag
			switch($tag) {
				case 'STRONG':
				$this->SetStyle('B', true);
				break;
				case 'EM':
				$this->SetStyle('I', true);
				break;
				case 'B':
				case 'I':
				case 'U':
				$this->SetStyle($tag, true);
				break;
				case 'A':
				$this->HREF = $attr['HREF'];
				break;
				case 'IMG':
				if (isset($attr['SRC']) and (isset($attr['WIDTH']) or isset($attr['HEIGHT']))) {
					if (!isset($attr['WIDTH']))
					$attr['WIDTH'] = 0;
					if (!isset($attr['HEIGHT']))
					$attr['HEIGHT'] = 0;
					$this->ln(2);
					$this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
					$xy = (getImageSize ($attr['SRC']));
					$height = explode ("=", $xy[3]);
					$moveY = str_replace("\"", "", $height[2]);
					$this->ln(px2mm($moveY)+1); // Cant work out how to wrap - so just put text under
					 
					 
				}
				break;
				case 'TABLE':
				$this->inTable = 1;
				break;
				case 'TR':
				$this->Ln(6);
				break;
				case 'TD':
				$this->inCell = 1;
				break;
				case 'BLOCKQUOTE':
				case 'BR':
				$this->Ln(5);
				break;
				case 'P':
				$this->Ln(10);
				break;
				case 'FONT':
				if (isset($attr['COLOR']) and $attr['COLOR'] != '') {
					$coul = hex2dec($attr['COLOR']);
					$this->SetTextColor($coul['R'], $coul['G'], $coul['B']);
					$this->issetcolor = true;
				}
				if (isset($attr['FACE']) and in_array(strtolower($attr['FACE']), $this->fontlist)) {
					$this->SetFont(strtolower($attr['FACE']));
					$this->issetfont = true;
				}
				break;
			}
		}
		 
		function CloseTag($tag) {
			//Closing tag
			if ($tag == 'STRONG')
			$tag = 'B';
			if ($tag == 'EM')
			$tag = 'I';
			if ($tag == 'B' or $tag == 'I' or $tag == 'U')
			$this->SetStyle($tag, false);
			if ($tag == 'A')
			$this->HREF = '';
			if ($tag == 'FONT') {
				if ($this->issetcolor == true) {
					$this->SetTextColor(0);
				}
				if ($this->issetfont) {
					$this->SetFont('arial');
					$this->issetfont = false;
				}
			}
			switch ($tag) {
				case 'TABLE':
				$this->inTable = 0;
				$this->Ln(6);
				break;
				case 'TD':
				$this->inCell = 0;
				break;
			}
		}
		 
		function SetStyle($tag, $enable) {
			//Modify style and select corresponding font
			$this->$tag += ($enable ? 1 : -1);
			$style = '';
			foreach(array('B', 'I', 'U') as $s)
			if ($this->$s > 0)
			$style .= $s;
			$this->SetFont('', $style);
		}
		 
		function PutLink($URL, $txt) {
			//Put a hyperlink
			$this->SetTextColor(0, 0, 255);
			$this->SetStyle('U', true);
			$this->Write(5, $txt, $URL);
			$this->SetStyle('U', false);
			$this->SetTextColor(0);
		}
	}
	//end of class
?>
