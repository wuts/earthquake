<?php
/**
* @version $Id: database.php,v 1.3 2005/07/22 03:36:09 eddieajau Exp $
* @package Mambo
* @subpackage Database
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* Database connector class
* @subpackage Database
* @package Mambo
*/
class database {
	/** @var string Internal variable to hold the query sql */
	var $_sql='';
	/** @var int Internal variable to hold the database error number */
	var $_errorNum=0;
	/** @var string Internal variable to hold the database error message */
	var $_errorMsg='';
	/** @var string Internal variable to hold the prefix used on all database tables */
	var $_table_prefix='';
	/** @var Internal variable to hold the connector resource */
	var $_resource='';
	/** @var Internal variable to hold the last query cursor */
	var $_cursor=null;
	/** @var boolean Debug option */
	var $_charset='latin1';
	/** @var boolean Debug option */
	var $_debug=0;
	/** @var array A log of queries */
	var $_log=array();
	/** @var string Null date */
	var $_null_date='0000-00-00 00:00:00';

	/**
	* Database object constructor
	* @param string Database host
	* @param string Database user name
	* @param string Database user password
	* @param string Database name
	* @param string Common prefix for all tables
	*/
	function database( $host='localhost', $user, $pass, $db, $table_prefix ) {
		$mysql_charsets['utf-8']='utf8';
		$mysql_charsets['iso-8859-1']='latin1';
		$mysql_charsets['iso-8859-15']='latin1';
		$mysql_charsets['koi8-r']='koi8r';
		$mysql_charsets['windows-1251']='cp1251';
		$mysql_charsets['cp1251']='cp1251';
		$mysql_charsets['gb2312']='gbk';
		$mysql_charsets['gb18030']='gbk';
		$mysql_charsets['gbk']='gbk';
		$mysql_charsets['big5-hkscs']='big5';
		$mysql_charsets['big5']='big5';
		$mysql_charsets['euc-tw']='big5';
		$mysql_charsets['iso-8859-2']='latin2';
		$mysql_charsets['windows-1250']='latin2';
		$mysql_charsets['iso-8859-7']='latin7';
		$mysql_charsets['iso-8859-8-i']='hebrew';
		$mysql_charsets['iso-8859-8']='hebrew';
		$mysql_charsets['sjis']='sjis';
		$mysql_charsets['windows-1257']='latin7';
		$mysql_charsets['iso-8859-13']='latin7';
		$mysql_charsets['cp-866']='cp1251';
		$mysql_charsets['iso-8859-5']='latin5';
		$mysql_charsets['koi8-u']='koi8r';
		$mysql_charsets['windows-1252']='latin1';
		$mysql_charsets['tis-620']='tis620';
		$mysql_charsets['iso-8859-9']='latin5';
		$mysql_charsets['windows-1256']='cp1256';
		$mysql_charsets['georgian-ps']='geostd8';
		$mysql_charsets['euc-jp']='eucjpms';
		$mysql_charsets['euc-kr']='euckr';
		$mysql_charsets['iso-8859-6']='cp1256';
		$mysql_charsets['windows-1258']='latin1'; //No better match
		// perform a number of fatality checks, then die gracefully
		if (!function_exists( 'mysql_connect' )) $this->forceOffline(1);
		if (!($this->_resource = @mysql_connect( $host, $user, $pass ))) $this->forceOffline(2);
		if (!mysql_select_db($db)) $this->forceOffline(3);
		$this->_table_prefix = $table_prefix;
		if(floatval(mysql_get_server_info())>=4.1){
			$charset = strtolower( _CHARSET );
			if ( $charset == 'utf8' ) $charset = 'utf-8';
			$cs=isset($mysql_charsets[$charset]) ? $mysql_charsets[$charset] : 'latin1';
			$this->_charset=$cs;
			mysql_query( "SET NAMES '" .$cs. "'" );
		}
	}

	function forceOffline ($error_number) {
			$mosSystemError = $error_number;
			$basePath = dirname( __FILE__ );
			include $basePath . '/../configuration.php';
			include $basePath . '/../offline.php';
			exit();
	}
	
	function getNullDate () {
	    return $this->_null_date;
	}
	/**
	* @param int
	*/
	function debug( $level ) {
	    $this->_debug = intval( $level );
	}

	function debug_trace () {
		trigger_error( $this->_errorNum, E_USER_NOTICE );
		//echo "<pre>" . $this->_sql . "</pre>\n";
		if (function_exists('debug_backtrace')) {
			foreach(debug_backtrace() as $back) {
			    if (@$back['file']) {
				    echo '<br />'.$back['file'].':'.$back['line'];
				}
			}
		}
	}
	/**
	* @return int The error number for the most recent query
	*/
	function getErrorNum() {
		return $this->_errorNum;
	}
	/**
	* @return string The error message for the most recent query
	*/
	function getErrorMsg() {
		return str_replace( array( "\n", "'" ), array( '\n', "\'" ), $this->_errorMsg );
	}
	/**
	* Get a database escaped string
	* @return string
	*/
	function getEscaped( $text ) {
	    if (phpversion() < '4.3.0') {
	        return mysql_escape_string( $text );
	    } else {
	        return mysql_real_escape_string( $text );
	    }
	}
	/**
	* Get a quoted database escaped string
	* @return string
	*/
	function Quote( $text ) {
	    if (phpversion() < '4.3.0') {
	        return '\'' . mysql_escape_string( $text ) . '\'';
	    } else {
	        return '\'' . mysql_real_escape_string( $text ) . '\'';
	    }
	}
	/**
	* Sets the SQL query string for later execution.
	*
	* @param string The SQL query
	*/
	function setBareQuery ($sql) {
		$this->_sql = $sql;
	}
	/**
	* Sets the SQL query string for later execution.
	*
	* This function replaces a string identifier <var>$prefix</var> with the
	* string held is the <var>_table_prefix</var> class variable.
	*
	* @param string The SQL query
	* @param string The common table prefix
	*/
	function setQuery( $sql, $prefix='#__' ) {
		$this->setBareQuery ($this->replacePrefix($sql, $prefix));
	}

	/**
	 * This function replaces a string identifier <var>$prefix</var> with the
	 * string held is the <var>_table_prefix</var> class variable.
	 *
	 * @param string The SQL query
	 * @param string The common table prefix
	 * @author thede, David McKinnis
	 */
	function replacePrefix( $sql, $prefix='#__' ) {
		$done = '';
		
		if(floatval(mysql_get_server_info())>=4.1) {
			if (preg_match ("/create( )+table/i", $sql)) {
				$charset = ' DEFAULT CHARACTER SET ' . $this->_charset;
				$sql = str_replace(';', '', $sql);
				$sql = $sql . $charset;
			}
		}
			
		while (strlen($sql)) {
			$single = preg_match("/\'([^\\\']|\\.)*'/", $sql,$matches_single,PREG_OFFSET_CAPTURE);
			if ($double = preg_match('/\"([^\\\"]|\\.)*"/', $sql,$matches_double,PREG_OFFSET_CAPTURE) OR $single) {
				if ($single == 0 OR ($double AND $matches_double[0][1] < $matches_single[0][1])) {
					$done .= str_replace($prefix, $this->_table_prefix, substr($sql,0,$matches_double[0][1])).$matches_double[0][0];
					$sql = substr($sql,$matches_double[0][1]+strlen($matches_double[0][0]));
				}
				else {
					$done .= str_replace($prefix, $this->_table_prefix, substr($sql,0,$matches_single[0][1])).$matches_single[0][0];
					$sql = substr($sql,$matches_single[0][1]+strlen($matches_single[0][0]));
				}
			}
			else return $done.str_replace($prefix, $this->_table_prefix,$sql);
		}
		return $done;
	}
	/**
	* @return string The current value of the internal SQL vairable
	*/
	function getQuery($sql='') {
		if ($sql == '') $sql = $this->_sql;
		return "<pre>" . htmlspecialchars( $sql ) . "</pre>";
	}
	/**
	* Execute the query
	* @return mixed A database resource if successful, FALSE if not.
	*/
	function query($sql = '') {
		global $mosConfig_debug;
		if ($sql == '') $sql = $this->_sql;
		if ($this->_debug) $this->_log[] = $sql;
		if ($this->_cursor = mysql_query($sql, $this->_resource)) {
			$this->_errorNum = 0;
			$this->_errorMsg = '';
			return $this->_cursor;
		}
		else {
			$this->_errorNum = mysql_errno( $this->_resource );
			$this->_errorMsg = mysql_error( $this->_resource )." SQL=$sql";
			if ($this->_debug) $this->debug_trace();
			return false;
		}
	}

	function query_batch( $abort_on_error=true, $p_transaction_safe = false) {
		$this->_errorNum = 0;
		$this->_errorMsg = '';
		if ($p_transaction_safe) {
			$si = mysql_get_server_info();
			preg_match_all( "/(\d+)\.(\d+)\.(\d+)/i", $si, $m );
			$prefix = '';
			if ($m[1] >= 4) $prefix = 'START TRANSACTION; ';
			elseif ($m[2] >= 23) {
				if ($m[3] >= 19) $prefix = 'BEGIN WORK; ';
				elseif ($m[3] >= 17) $prefix = 'BEGIN; ';
			}
			if ($prefix) $this->_sql = $prefix.$this->_sql.'; COMMIT;';
		}
		$query_split = preg_split ("/[;]+/", $this->_sql);
		$error = 0;
		foreach ($query_split as $command_line) {
			$command_line = trim( $command_line );
			if ($command_line != '') {
				if (!$this->query($command_line)) {
					$error = 1; echo 'xxx ';
					$this->_errorNum .= mysql_errno( $this->_resource ) . ' ';
					$this->_errorMsg .= mysql_error( $this->_resource )." SQL=$command_line <br />";
					if ($abort_on_error) {
						return $this->_cursor;
					}
				}
			}
		}
		return $error ? false : true;
	}

	/**
	* Diagnostic function
	*/
	function explain() {
		if (!($cur = $this->query("EXPLAIN ".$this->_sql))) return null;
		$headline = $header = $body = '';
		$buf = '<table cellspacing="1" cellpadding="2" border="0" bgcolor="#000000" align="center">';
		$buf .= $this->getQuery("EXPLAIN ".$this->_sql);
		while ($row = mysql_fetch_assoc($cur)) {
			$body .= "<tr>";
			foreach ($row as $k=>$v) {
				if ($headline == '') $header .= "<th bgcolor=\"#ffffff\">$k</th>";
				$body .= "<td bgcolor=\"#ffffff\">$v</td>";
			}
			$headline = $header;
			$body .= "</tr>";
		}
		$buf .= "<tr>$headline</tr>$body</table><br />&nbsp;";
		mysql_free_result( $cur );
		return "<div style=\"background-color:#FFFFCC\" align=\"left\">$buf</div>";
	}
	/**
	* @return int The number of rows returned from the most recent query - SELECT only
	*/
	function getNumRows( $cur=null ) {
		return mysql_num_rows( $cur ? $cur : $this->_cursor );
	}

	/**
	* @return int The number of rows affected by the most recent query - INSERT, UPDATE, DELETE
	*/
	function getAffectedRows(  ) {
		return mysql_affected_rows( $this->_resource );
	}

	/**
	* Load an array of retrieved database objects or values
	* @param int Database cursor
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function &retrieveResults ($key='', $max=0, $result_type='row') {
		$results = array();
		$sql_function = 'mysql_fetch_'.$result_type;
		if ($cur = $this->query()) {
			while ($row = $sql_function($cur)) {
				if ($key != '') {
					if ( is_array($row) ) {
						$results[$row[$key]] = $row;
					} else {
						$results[$row->$key] = $row;
					}
				} else {
					$results[] = $row;
				}
				if ($max AND count($results) >= $max) break;
			}
			mysql_free_result($cur);
		}
		return $results;
	}
	/**
	* This method loads the first field of the first row returned by the query.
	*
	* @return The value returned in the query or null if the query failed.
	*/
	function loadResult() {
		if (!($cur = $this->query())) {
			return null;
		}
		$ret = null;
		if ($row = mysql_fetch_row( $cur )) {
			$ret = $row[0];
		}
		mysql_free_result( $cur );
		return $ret;
	}
	/**
	* Load an array of single field results into an array
	*/
	function loadResultArray($numinarray = 0) {
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_row( $cur )) {
			$array[] = $row[$numinarray];
		}
		mysql_free_result( $cur );
		return $array;
	}
	/**
	* Load a assoc list of database rows
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	*/
	function loadAssocList( $key='' ) {
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_assoc( $cur )) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		mysql_free_result( $cur );
		return $array;
	}
	/**
	* This global function loads the first row of a query into an object
	*
	* If an object is passed to this function, the returned row is bound to the existing elements of <var>object</var>.
	* If <var>object</var> has a value of null, then all of the returned query fields returned in the object.
	* @param string The SQL query
	* @param object The address of variable
	*/
	function loadObject( &$object ) {
		if ($object != null) {
			if (!($cur = $this->query())) {
				return false;
			}
			if ($array = mysql_fetch_assoc( $cur )) {
				mysql_free_result( $cur );
				mosBindArrayToObject( $array, $object, null, null, false );
				return true;
			} else {
				return false;
			}
		} else {
			if ($cur = $this->query()) {
				if ($object = mysql_fetch_object( $cur )) {
					mysql_free_result( $cur );
					return true;
				} else {
					$object = null;
					return false;
				}
			} else {
				return false;
			}
		}
	}
	/**
	* Load a list of database objects
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function loadObjectList( $key='' ) {
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_object( $cur )) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		mysql_free_result( $cur );
		return $array;
	}
	/**
	* @return The first row of the query.
	*/
	function loadRow() {
		if (!($cur = $this->query())) {
			return null;
		}
		$ret = null;
		if ($row = mysql_fetch_row( $cur )) {
			$ret = $row;
		}
		mysql_free_result( $cur );
		return $ret;
	}
	/**
	* Load a list of database rows (numeric column indexing)
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function loadRowList( $key='' ) {
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_array( $cur )) {
			if ($key) {
				$array[$row[$key]] = $row;
			} else {
				$array[] = $row;
			}
		}
		mysql_free_result( $cur );
		return $array;
	}
	/**
	* Document::db_insertObject()
	*
	* { Description }
	*
	* @param [type] $keyName
	* @param [type] $verbose
	*/
	function insertObject( $table, &$object, $keyName = NULL, $verbose=false ) {
		$fmtsql = "INSERT INTO $table ( %s ) VALUES ( %s ) ";
		$fields = array();
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}
			if ($k[0] == '_') { // internal field
				continue;
			}
			$fields[] = "`$k`";
			$values[] = "'" . $this->getEscaped( $v ) . "'";
		}
		$this->setQuery( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
		($verbose) && print "$sql<br />\n";
		if (!$this->query()) {
			return false;
		}
		$id = mysql_insert_id();
		($verbose) && print "id=[$id]<br />\n";
		if ($keyName && $id) {
			$object->$keyName = $id;
		}
		return true;
	}

	/**
	* Document::db_updateObject()
	*
	* { Description }
	*
	* @param [type] $updateNulls
	*/
	function updateObject( $table, &$object, $keyName, $updateNulls=true ) {
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		$tmp = array();
		foreach (get_object_vars( $object ) as $k => $v) {
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
			if( $k == $keyName ) { // PK not to be updated
				$where = "$keyName='" . $this->getEscaped( $v ) . "'";
				continue;
			}
			if ($v === NULL && !$updateNulls) {
				continue;
			}
			if( $v == '' ) {
				$val = "''";
			} else {
				$val = "'" . $this->getEscaped( $v ) . "'";
			}
			$tmp[] = "`$k`=$val";
		}
		$this->setQuery( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}

	/**
	* @param boolean If TRUE, displays the last SQL statement sent to the database
	* @return string A standised error message
	*/
	function stderr( $showSQL = false ) {
		return "DB function failed with error number $this->_errorNum"
		."<br /><font color=\"red\">$this->_errorMsg</font>"
		.($showSQL ? "<br />SQL = <pre>$this->_sql</pre>" : '');
	}

	function insertid()
	{
		return mysql_insert_id();
	}

	function getVersion()
	{
		return mysql_get_server_info();
	}

	/**
	* Fudge method for ADOdb compatibility
	*/
	function GenID( $foo1=null, $foo2=null ) {
		return '0';
	}
	/**
	* @return array A list of all the tables in the database
	*/
	function getTableList() {
		$this->setQuery( 'SHOW tables' );
		$this->query();
		return $this->loadResultArray();
	}
	/**
	* @param array A list of table names
	* @return array A list the create SQL for the tables
	*/
	function getTableCreate( $tables ) {
		$result = array();

		foreach ($tables as $tblval) {
			$this->setQuery( 'SHOW CREATE table ' . $tblval );
			$this->query();
			$result[$tblval] = $this->loadResultArray( 1 );
		}

		return $result;
	}
	/**
	* @param array A list of table names
	* @return array An array of fields by table
	*/
	function getTableFields( $tables ) {
		$result = array();

		foreach ($tables as $tblval) {
			$this->setQuery( 'SHOW FIELDS FROM ' . $tblval );
			$this->query();
			$fields = $this->loadObjectList();
			foreach ($fields as $field) {
				$result[$tblval][$field->Field] = preg_replace("/[(0-9)]/",'', $field->Type );
			}
		}

		return $result;
	}

	function displayLogged () {
		echo '<br />' . count($this->_log).' queries executed<br />';
	 	foreach ($this->_log as $k=>$sql) {
	 	    echo $k+1 . "<br />" . $sql . '<hr />';
		}
	}

	/* Helper method - maybe should go into database itself */
	function doSQL ($sql) {
		$this->setQuery($sql);
		if (!$this->query()) {
			echo "<script> alert('".$this->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
	}

	/* Helper method - maybe could go into database itself */
	function &doSQLget ($sql, $classname) {
		$this->setQuery($sql);
		$rows = $this->loadObjectList();
		$target = get_class_vars($classname);
		if ($rows) {
			foreach ($rows as $row) {
				$next = new $classname(0);
				foreach ($target as $field=>$value) {
					if (isset($row->$field)) $next->$field = $row->$field;
				}
				$result[] = $next;
			}
		}
		else $result = array();
		return $result;
	}


}

/**
* mosDBTable Abstract Class.
* @abstract
* @package Mambo
* @subpackage Database
*
* Parent classes to all database derived objects.  Customisation will generally
* not involve tampering with this object.
* @package Mambo
* @author Andrew Eddie <eddieajau@users.sourceforge.net
*/
class mosDBTable {
	/** @var string Name of the table in the db schema relating to child class */
	var $_tbl = '';
	/** @var string Name of the primary key field in the table */
	var $_tbl_key = '';
	/** @var string Error message */
	var $_error = '';
	/** @var database Database connector */
	var $_db = null;

	/**
	*	Object constructor to set table and key field
	*
	*	Can be overloaded/supplemented by the child class
	*	@param string $table name of the table in the db schema relating to child class
	*	@param string $key name of the primary key field in the table
	*/
	function mosDBTable( $table, $key, &$db ) {
		$this->_tbl = $table;
		$this->_tbl_key = $key;
		$this->_db =& $db;
	}
	/**
	 * Filters public properties
	 * @access protected
	 * @param array List of fields to ignore
	 */
	function filter( $ignoreList=null ) {
		$ignore = is_array( $ignoreList );

		$iFilter = new InputFilter();
		foreach ($this->getPublicProperties() as $k) {
			if ($ignore && in_array( $k, $ignoreList ) ) {
				continue;
			}
			$this->$k = $iFilter->process( $this->$k );
		}
	}
	/**
	 *	@return string Returns the error message
	 */
	function getError() {
		return $this->_error;
	}
	/**
	* Gets the value of the class variable
	* @param string The name of the class variable
	* @return mixed The value of the class var (or null if no var of that name exists)
	*/
	function get( $_property ) {
		if(isset( $this->$_property )) {
			return $this->$_property;
		} else {
			return null;
		}
	}
	/**
	 * Returns an array of public properties
	 * @return array
	 */
	function getPublicProperties() {
		static $cache = null;
		if (is_null( $cache )) {
			$cache = array();
			foreach (get_class_vars( get_class( $this ) ) as $key=>$val) {
				if (substr( $key, 0, 1 ) != '_') {
					$cache[] = $key;
				}
			}
		}
		return $cache;
	}
	/**
	* Set the value of the class variable
	* @param string The name of the class variable
	* @param mixed The value to assign to the variable
	*/
	function set( $_property, $_value ) {
		$this->$_property = $_value;
	}
	/**
	*	binds a named array/hash to this object
	*
	*	can be overloaded/supplemented by the child class
	*	@param array $hash named array
	*	@return null|string	null is operation was satisfactory, otherwise returns an error
	*/
	function bind( $array, $ignore="" ) {
		if (!is_array( $array )) {
			$this->_error = strtolower(get_class( $this ))."::bind failed.";
			return false;
		} else {
			return mosBindArrayToObject( $array, $this, $ignore );
		}
	}

	/**
	*	binds an array/hash to this object
	*	@param int $oid optional argument, if not specifed then the value of current key is used
	*	@return any result from the database operation
	*/
	function load( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = $this->_db->getEscaped($oid);
		}
		$oid = $this->$k;
		if ($oid === null) {
			return false;
		}
		$this->_db->setQuery( "SELECT * FROM $this->_tbl WHERE $this->_tbl_key='$oid'" );
		return $this->_db->loadObject( $this );
	}

	/**
	*	generic check method
	*
	*	can be overloaded/supplemented by the child class
	*	@return boolean True if the object is ok
	*/
	function check() {
		return true;
	}

	/**
	* Inserts a new row if id is zero or updates an existing row in the database table
	*
	* Can be overloaded/supplemented by the child class
	* @param boolean If false, null object variables are not updated
	* @return null|string null if successful otherwise returns and error message
	*/
	function store( $updateNulls=false ) {
		$k = $this->_tbl_key;
		global $migrate;
		if( $this->$k && !$migrate) {
			$ret = $this->_db->updateObject( $this->_tbl, $this, $this->_tbl_key, $updateNulls );
		} else {
			$ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );
		}
		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->getErrorMsg();
			return false;
		} else {
			return true;
		}
	}
	/**
	*/
	function move( $dirn, $where='' ) {
		$k = $this->_tbl_key;

		$sql = "SELECT $this->_tbl_key, ordering FROM $this->_tbl";

		if ($dirn < 0) {
			$sql .= "\nWHERE ordering < $this->ordering";
			$sql .= ($where ? "\n	AND $where" : '');
			$sql .= "\nORDER BY ordering DESC\nLIMIT 1";
		} else if ($dirn > 0) {
			$sql .= "\nWHERE ordering > $this->ordering";
			$sql .= ($where ? "\n	AND $where" : '');
			$sql .= "\nORDER BY ordering\nLIMIT 1";
		} else {
			$sql .= "\nWHERE ordering = $this->ordering";
			$sql .= ($where ? "\n	AND $where" : '');
			$sql .= "\nORDER BY ordering\nLIMIT 1";
		}

		$this->_db->setQuery( $sql );
//echo 'A: ' . $this->_db->getQuery();


		$row = null;
		if ($this->_db->loadObject( $row )) {
			$this->_db->setQuery( "UPDATE $this->_tbl SET ordering='$row->ordering'"
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);

			if (!$this->_db->query()) {
			    $err = $this->_db->getErrorMsg();
			    die( $err );
			}
//echo 'B: ' . $this->_db->getQuery();

			$this->_db->setQuery( "UPDATE $this->_tbl SET ordering='$this->ordering'"
			. "\nWHERE $this->_tbl_key='".$row->$k."'"
			);
//echo 'C: ' . $this->_db->getQuery();

			if (!$this->_db->query()) {
			    $err = $this->_db->getErrorMsg();
			    die( $err );
			}

			$this->ordering = $row->ordering;
		} else {
			$this->_db->setQuery( "UPDATE $this->_tbl SET ordering='$this->ordering'"
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);
//echo 'D: ' . $this->_db->getQuery();


			if (!$this->_db->query()) {
			    $err = $this->_db->getErrorMsg();
			    die( $err );
			}
		}
	}
	/**
	* Compacts the ordering sequence of the selected records
	* @param string Additional where query to limit ordering to a particular subset of records
	*/
	function updateOrder( $where='' ) {
		$k = $this->_tbl_key;

		if (!array_key_exists( 'ordering', get_class_vars( strtolower(get_class( $this )) ) )) {
			$this->_error = "WARNING: ".strtolower(get_class( $this ))." does not support ordering.";
			return false;
		}

		if ($this->_tbl == "#__content_frontpage") {
			$order2 = ", content_id DESC";
		} else {
			$order2 = "";
		}

		$this->_db->setQuery( "SELECT $this->_tbl_key, ordering FROM $this->_tbl"
		. ($where ? "\nWHERE $where" : '')
		. "\nORDER BY ordering".$order2
		);
		if (!($orders = $this->_db->loadObjectList())) {
			$this->_error = $this->_db->getErrorMsg();
			return false;
		}
		// first pass, compact the ordering numbers
		for ($i=0, $n=count( $orders ); $i < $n; $i++) {
			if ($orders[$i]->ordering >= 0) {
				$orders[$i]->ordering = $i+1;
			}
		}

		$shift = 0;
		$n=count( $orders );
		for ($i=0; $i < $n; $i++) {
			//echo "i=$i id=".$orders[$i]->$k." order=".$orders[$i]->ordering;
			if ($orders[$i]->$k == $this->$k) {
				// place 'this' record in the desired location
				$orders[$i]->ordering = min( $this->ordering, $n );
				$shift = 1;
			} else if ($orders[$i]->ordering >= $this->ordering && $this->ordering > 0) {
				$orders[$i]->ordering++;
			}
		}
	//echo '<pre>';print_r($orders);echo '</pre>';
		// compact once more until I can find a better algorithm
		for ($i=0, $n=count( $orders ); $i < $n; $i++) {
			if ($orders[$i]->ordering >= 0) {
				$orders[$i]->ordering = $i+1;
				$this->_db->setQuery( "UPDATE $this->_tbl"
				. "\nSET ordering='".$orders[$i]->ordering."' WHERE $k='".$orders[$i]->$k."'"
				);
				$this->_db->query();
	//echo '<br />'.$this->_db->getQuery();
			}
		}

		// if we didn't reorder the current record, make it last
		if ($shift == 0) {
			$order = $n+1;
			$this->_db->setQuery( "UPDATE $this->_tbl"
			. "\nSET ordering='$order' WHERE $k='".$this->$k."'"
			);
			$this->_db->query();
	//echo '<br />'.$this->_db->getQuery();
		}
		return true;
	}
	/**
	*	Generic check for whether dependancies exist for this object in the db schema
	*
	*	can be overloaded/supplemented by the child class
	*	@param string $msg Error message returned
	*	@param int Optional key index
	*	@param array Optional array to compiles standard joins: format [label=>'Label',name=>'table name',idfield=>'field',joinfield=>'field']
	*	@return true|false
	*/
	function canDelete( $oid=null, $joins=null ) {
		$k = $this->_tbl_key;
		if ($oid) {
			$this->$k = intval( $oid );
		}
		if (is_array( $joins )) {
			$select = "$k";
			$join = "";
			foreach( $joins as $table ) {
				$select .= ",\nCOUNT(DISTINCT {$table['idfield']}) AS {$table['idfield']}";
				$join .= "\nLEFT JOIN {$table['name']} ON {$table['joinfield']} = $k";
			}
			$this->_db->setQuery( "SELECT $select\nFROM $this->_tbl\n$join\nWHERE $k = ".$this->$k." GROUP BY $k" );

			if ($obj = $this->_db->loadObject()) {
				$this->_error = $this->_db->getErrorMsg();
				return false;
			}
			$msg = array();
			foreach( $joins as $table ) {
				$k = $table['idfield'];
				if ($obj->$k) {
					$msg[] = $AppUI->_( $table['label'] );
				}
			}

			if (count( $msg )) {
				$this->_error = "noDeleteRecord" . ": " . implode( ', ', $msg );
				return false;
			} else {
				return true;
			}
		}

		return true;
	}

	/**
	*	Default delete method
	*
	*	can be overloaded/supplemented by the child class
	*	@return true if successful otherwise returns and error message
	*/
	function delete( $oid=null ) {
		//if (!$this->canDelete( $msg )) {
		//	return $msg;
		//}

		$k = $this->_tbl_key;
		if ($oid) {
			$this->$k = intval( $oid );
		}

		$this->_db->setQuery( "DELETE FROM $this->_tbl WHERE $this->_tbl_key = '".$this->$k."'" );

		if ($this->_db->query()) {
			return true;
		} else {
			$this->_error = $this->_db->getErrorMsg();
			return false;
		}
	}

	function checkout( $who, $oid=null ) {
		return true;
	}

/*
	function checkout( $who, $oid=null ) {
		if (!array_key_exists( 'checked_out', get_class_vars( strtolower(get_class( $this )) ) )) {
			$this->_error = "WARNING: ".strtolower(get_class( $this ))." does not support checkouts.";
			return false;
		}
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = $oid;
		}
		$time = date( "%Y-%m-%d H:i:s" );
		if (intval( $who )) {
			// new way of storing editor, by id
			$this->_db->setQuery( "UPDATE $this->_tbl"
			. "\nSET checked_out='$who', checked_out_time='$time'"
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);
		} else {
			// old way of storing editor, by name
			$this->_db->setQuery( "UPDATE $this->_tbl"
			. "\nSET checked_out='1', checked_out_time='$time', editor='".$who."' "
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);
		}
		return $this->_db->query();
	}
*/
	function checkin( $oid=null ) {
		if (!array_key_exists( 'checked_out', get_class_vars( strtolower(get_class( $this )) ) )) {
			$this->_error = "WARNING: ".strtolower(get_class( $this ))." does not support checkin.";
			return false;
		}
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = $oid;
		}
		$time = date("H:i:s");
		$this->_db->setQuery( "UPDATE $this->_tbl"
		. "\nSET checked_out='0', checked_out_time='0000-00-00 00:00:00'"
		. "\nWHERE $this->_tbl_key='".$this->$k."'"
		);
		return $this->_db->query();
	}

	function hit( $oid=null ) {
		global $mosConfig_enable_log_items;

		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = intval( $oid );
		}
		$this->_db->setQuery( "UPDATE $this->_tbl SET hits=(hits+1) WHERE $this->_tbl_key='$this->id'" );
		$this->_db->query();

		if (@$mosConfig_enable_log_items) {
			$now = date( "Y-m-d" );
			$this->_db->setQuery( "SELECT hits"
			. "\nFROM #__core_log_items"
			. "\nWHERE time_stamp='$now' AND item_table='$this->_tbl' AND item_id='".$this->$k."'"
			);
			$hits = intval( $this->_db->loadResult() );
			if ($hits) {
				$this->_db->setQuery( "UPDATE #__core_log_items SET hits=(hits+1)"
				. "\nWHERE time_stamp='$now' AND item_table='$this->_tbl' AND item_id='".$this->$k."'"
				);
				$this->_db->query();
			} else {
				$this->_db->setQuery( "INSERT INTO #__core_log_items VALUES"
				. "\n('$now','$this->_tbl','".$this->$k."','1')"
				);
				$this->_db->query();
			}
		}
	}

	/**
	* Generic save function
	* @param array Source array for binding to class vars
	* @param string Filter for the order updating
	* @returns TRUE if completely successful, FALSE if partially or not succesful.
	*/
	function save( $source, $order_filter ) {
		if (!$this->bind( $_POST )) {
			return false;
		}
		if (!$this->check()) {
			return false;
		}
		if (!$this->store()) {
			return false;
		}
		if (!$this->checkin()) {
			return false;
		}
		$filter_value = $this->$order_filter;
		$this->updateOrder( $order_filter ? "`$order_filter`='$filter_value'" : "" );
		$this->_error = '';
		return true;
	}

	/**
	* Generic Publish/Unpublish function
	* @param array An array of id numbers
	* @param integer 0 if unpublishing, 1 if publishing
	* @param integer The id of the user performnig the operation
	*/
	function publish_array( $cid=null, $publish=1, $myid=0 ) {
		if (!is_array( $cid ) || count( $cid ) < 1) {
			$this->_error = "No items selected.";
			return false;
		}

		$cids = implode( ',', $cid );

		$this->_db->setQuery( "UPDATE $this->_tbl SET published='$publish'"
		. "\nWHERE $this->_tbl_key IN ($cids) AND (checked_out=0 OR (checked_out='$myid'))"
		);
		if (!$this->_db->query()) {
			$this->_error = $this->_db->getErrorMsg();
			return false;
		}

		if (count( $cid ) == 1) {
			$this->checkin( $cid[0] );
		}
		$this->_error = '';
		return true;
	}

	/**
	* Export item list to xml
	* @param boolean Map foreign keys to text values
	*/
	function toXML( $mapKeysToText=false ) {
		$xml = '<record table="' . $this->_tbl . '"';
		if ($mapKeysToText) {
			$xml .= ' mapkeystotext="true"';
		}
		$xml .= '>';
		foreach (get_object_vars( $this ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}
			if ($k[0] == '_') { // internal field
				continue;
			}
			$xml .= '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>';
		}
		$xml .= '</record>';

		return $xml;
	}
}
?>