<?php
/**
* @version $Id: pageNavigation.php,v 1.1 2005/07/22 01:53:54 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Page navigation support class
* @package Mambo
*/
class mosPageNav {
	/** @var int The record number to start dislpaying from */
	var $limitstart = null;
	/** @var int Number of rows to display per page */
	var $limit = null;
	/** @var int Total number of rows */
	var $total = null;

	function mosPageNav( $total, $limitstart, $limit ) {
		$this->total = intval( $total );
                $this->limitstart = max( intval($limitstart), 0 );
                $this->limit = max( intval($limit), 1 );
		if ($this->limit > $this->total) {
			$this->limitstart = 0;
		}
		if (($this->limit-1)*$this->limitstart > $this->total) {
			$this->limitstart -= $this->limitstart % $this->limit;
		}
	}
	/**
	* @return string The html for the limit # input box
	*/
	function getLimitBox () {
		$limits = array();
		for ($i=5; $i <= 30; $i+=5) {
			$limits[] = mosHTML::makeOption( "$i" );
		}
		$limits[] = mosHTML::makeOption( "50" );

		// build the html select list
		$html = mosHTML::selectList( $limits, 'limit', 'class="inputbox" size="1" onchange="document.adminForm.submit();"',
		'value', 'text', $this->limit );
		$html .= "\n<input type=\"hidden\" name=\"limitstart\" value=\"$this->limitstart\" />";
		return $html;
	}
	/**
	* Writes the html limit # input box
	*/
	function writeLimitBox () {
		echo mosPageNav::getLimitBox();
	}
	function writePagesCounter() {
		echo $this->getPagesCounter();
	}
	/**
	* @return string The html for the pages counter, eg, Results 1-10 of x
	*/
	function getPagesCounter() {
		global $adminLanguage;
	    $html = '';
		$from_result = $this->limitstart+1;
		if ($this->limitstart + $this->limit < $this->total) {
			$to_result = $this->limitstart + $this->limit;
		} else {
			$to_result = $this->total;
		}
		if ($this->total > 0) {
			$html .= "\n".$adminLanguage->A_RESULTS." " . $from_result . " - " . $to_result . " ".$adminLanguage->A_OF." " . $this->total;
		} else {
			$html .= "\n".$adminLanguage->A_NO_RECORD_FOUND;
		}
		return $html;
	}
	/**
	* Writes the html for the pages counter, eg, Results 1-10 of x
	*/
	function writePagesLinks() {
	    echo $this->getPagesLinks();
	}
	/**
	* @return string The html links for pages, eg, previous, next, 1 2 3 ... x
	*/
	function getPagesLinks() {
		global $adminLanguage;
	    $html = '';
		$displayed_pages = 10;
		$total_pages = ceil( $this->total / $this->limit );
		$this_page = ceil( ($this->limitstart+1) / $this->limit );
		$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			$html .= "\n<a href=\"#beg\" class=\"pagenav\" title=\"".$adminLanguage->A_FIRST_PAGE."\" onclick=\"javascript: document.adminForm.limitstart.value=0; document.adminForm.submit();return false;\"><< ".$adminLanguage->A_COMP_CONTENT_START."</a>";
			$html .= "\n<a href=\"#prev\" class=\"pagenav\" title=\"".$adminLanguage->A_PREVIOUS_PAGE."\" onclick=\"javascript: document.adminForm.limitstart.value=$page; document.adminForm.submit();return false;\">< ".$adminLanguage->A_PREVIOUS."</a>";
		} else {
			$html .= "\n<span class=\"pagenav\"><< ".$adminLanguage->A_COMP_CONTENT_START."</span>";
			$html .= "\n<span class=\"pagenav\">< ".$adminLanguage->A_PREVIOUS."</span>";
		}

		for ($i=$start_loop; $i <= $stop_loop; $i++) {
			$page = ($i - 1) * $this->limit;
			if ($i == $this_page) {
				$html .= "\n<span class=\"pagenav\"> $i </span>";
			} else {
				$html .= "\n<a href=\"#$i\" class=\"pagenav\" onclick=\"javascript: document.adminForm.limitstart.value=$page; document.adminForm.submit();return false;\"><strong>$i</strong></a>";
			}
		}

		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;
			$html .= "\n<a href=\"#next\" class=\"pagenav\" title=\"".$adminLanguage->A_NEXT_PAGE."\" onclick=\"javascript: document.adminForm.limitstart.value=$page; document.adminForm.submit();return false;\"> ".$adminLanguage->A_NEXT." ></a>";
			$html .= "\n<a href=\"#end\" class=\"pagenav\" title=\"".$adminLanguage->A_END_PAGE."\" onclick=\"javascript: document.adminForm.limitstart.value=$end_page; document.adminForm.submit();return false;\"> ".$adminLanguage->A_END." >></a>";
		} else {
			$html .= "\n<span class=\"pagenav\">".$adminLanguage->A_NEXT." ></span>";
			$html .= "\n<span class=\"pagenav\">".$adminLanguage->A_END." >></span>";
		}
		return $html;
	}
	
	function getListFooter() {
		global $adminLanguage;
	    $html = '<table class="adminlist"><tr><th colspan="3">';
		$html .= $this->getPagesLinks();
		$html .= '</th></tr><tr>';
		$html .= '<td nowrap="true" width="48%" align="'.($adminLanguage->RTLsupport ? 'left' : 'right').'">'.$adminLanguage->A_DISPLAY.' #</td>'; /* rtl change */
		$html .= '<td>' .$this->getLimitBox() . '</td>';
		$html .= '<td nowrap="true" width="48%" align="'.($adminLanguage->RTLsupport ? 'right' : 'left').'">' . $this->getPagesCounter() . '</td>'; /* rtl change */
		$html .= '</tr></table>';
  		return $html;
	}
/**
* @param int The row index
* @return int
*/
	function rowNumber( $i ) {
		return $i + 1 + $this->limitstart;
	}
/**
* @param int The row index
* @param string The task to fire
* @param string The alt text for the icon
* @return string
*/
	function orderUpIcon( $i, $condition=true, $task='orderup', $alt=_A_MOVE_UP ) {
		if (($i > 0 || ($i+$this->limitstart > 0)) && $condition) {
		    return '<a href="#reorder" onClick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'">
				<img src="images/uparrow.png" width="12" height="12" border="0" alt="'.$alt.'">
			</a>';
  		} else {
  		    return '&nbsp;';
		}
	}
/**
* @param int The row index
* @param int The number of items in the list
* @param string The task to fire
* @param string The alt text for the icon
* @return string
*/
	function orderDownIcon( $i, $n, $condition=true, $task='orderdown', $alt=_A_MOVE_DOWN ) {
		if (($i < $n-1 || $i+$this->limitstart < $this->total-1) && $condition) {
			return '<a href="#reorder" onClick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'">
				<img src="images/downarrow.png" width="12" height="12" border="0" alt="'.$alt.'">
			</a>';
  		} else {
  		    return '&nbsp;';
		}
	}
}
?>
