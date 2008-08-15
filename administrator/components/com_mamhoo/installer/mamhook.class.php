<?php
/**
* $Id:  mamhook.class.php,v 3.0  2007-05-31
* @package Mamhoo
* @Copyright (C) 2004 - 2007 mamhoo.com
* @Autor: lang3
* @URL: http://www.mamhoo.com
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mamhoo is free Software
**/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// path to mamhook directory
$mamhookBaseDir	= mosPathName( mosPathName( $mosConfig_absolute_path ) . "components/com_mamhoo/mamhooks" );

require_once ( $mosConfig_absolute_path . "/administrator/components/com_installer/installer.class.php" );

/**
* Module installer
* @package Mambo_4.5.1
*/
class mosInstallerMamhook extends mosInstaller {

	/**
	* Custom install method
	* @param boolean True if installing from directory
	*/
	function install( $p_fromdir = null ) {
		global $mamhookBaseDir, $database, $mosConfig_absolute_path, $client;

		if (!$this->preInstallCheck( $p_fromdir, 'mamhook' )) {
			return false;
		}

		$params = & new mosParameters ( $client );
		$addon_path = $params->get( "addon_relativepath" );
		$addon_path = mosPathName( mosPathName( $mosConfig_absolute_path ) . $addon_path );
		$mamhook_inc_file = $addon_path . "mamhook.inc";
		if (file_exists($mamhook_inc_file)) {
			$this->setError(1, sprintf( _MAMHOO_INSTALL_MAMHOOK_CONFIG_EXISTS, $mamhook_inc_file) );
			return false;
		}

		$addon_install_file = $this->installDir() . "addon_install.txt";
		if (! $this->hook_addon_install ($addon_path, $addon_install_file) ) {
			return false;
		}


		$xml = $this->xmlDoc();
		$mosinstall =& $xml->documentElement;

		// Set some vars
		$e = &$xml->getElementsByPath( 'name', 1 );
		$this->elementName( $e->getText() );

		$folder = $mosinstall->getAttribute( 'group' );
		$this->elementDir( mosPathName( $mamhookBaseDir . $folder ) );

		if(!file_exists($this->elementDir()) && !mosMakePath($this->elementDir())) {
			$this->setError( 1, sprintf( _MAMHOO_INSTALL_DIR_CREATE_ERROR, $this->elementDir() ) );
			return false;
		}

		if ($this->parseFiles( 'files', 'mamhook', _MAMHOO_INSTALL_NO_MARKED ) === false) {
			return false;
		}

		$element = $this->elementSpecial();


		$handle = fopen ($mamhook_inc_file, "w");
		if ( !$handle ) {
			$this->setError(1, sprintf( _MAMHOO_INSTALL_INC_CREATE_ERROR, $mamhook_inc_file) );
			return false;
		}
		$content = "<?php \n\n";
		$content .= '$MAMBO_ABSOLUTE_PATH = "' . addslashes( $mosConfig_absolute_path ) . "\";\n";
		$content .= '$MAMHOOKS_PATH = $MAMBO_ABSOLUTE_PATH . "/components/com_mamhoo/mamhooks/";' ."\n";
		$content .= 'require_once($MAMHOOKS_PATH . "' . "$folder/$element.inc" . '"); ' . "\n";
		$content .= "\n?>";

		if (!fwrite($handle, $content)) {
			$this->setError(1, sprintf( _MAMHOO_INSTALL_INC_WRITE_ERROR, $mamhook_inc_file) );
			return false;
		}

		fclose($handle);


		// Insert in module in DB
		$database->setQuery( "SELECT id FROM #__mamhooks WHERE element = '" . $this->elementName() . "'" );
		if (!$database->query()) {
			$this->setError( 1, _MAMHOO_INSTALL_SQL_ERROR . $database->stderr( true ) );
			return false;
		}

		$id = $database->loadResult();

		if (!$id) {
			$row = new mosMamhook( $database );
			$row->name = $this->elementName();
			$row->ordering = 0;
			$row->published = 1;
			$row->folder = $folder;
			$row->iscore = 0;
			$row->access = 0;
			$row->client_id = 0;
			$row->element = $element;
			$row->params = $client;

			if (!$row->store()) {
				$this->setError( 1, _MAMHOO_INSTALL_SQL_ERROR . $row->getError() );
				return false;
			}
		} else {
			$this->setError( 1, sprintf( _MAMHOO_INSTALL_MAMHOOK_EXISTS, $this->elementName() ) );
			return false;
		}
		if ($e = &$xml->getElementsByPath( 'description', 1 )) {
			$this->setError( 0, $this->elementName() . '<p>' . $e->getText() . '</p>' );
		}

		return $this->copySetupFile('front');
	}


	/**
	* Custom install method
	* @param int The id of the module
	* @param string The URL option
	* @param int The client id
	*/
	function uninstall( $id, $option, $client=0 ) {
		global $database, $mamhookBaseDir;

		$id = intval( $id );
		$database->setQuery( "SELECT name, folder, element, iscore FROM #__mamhooks WHERE id = '$id'" );

		$row = null;
		$database->loadObject( $row );
		if ($database->getErrorNum()) {
			HTML_installer::showInstallMessage( $database->stderr(), _MAMHOO_INSTALL_UNINST_ERROR,
			$this->returnTo( $option, 'mamhook', $client ) );
			exit();
		}

		if ($row == null) {
			HTML_installer::showInstallMessage( 'Invalid object id', 'Uninstall -	error',
			$this->returnTo( $option, 'mambot', $client ) );
			exit();
		}

		if (trim( $row->folder ) == '') {
			HTML_installer::showInstallMessage( _MAMHOO_INSTALL_FOLDER_EMPTY, _MAMHOO_INSTALL_UNINST_ERROR,
			$this->returnTo( $option, 'mamhook', $client ) );
			exit();
		}

		$basepath = mosPathName ( $mamhookBaseDir . $row->folder );
		$xmlfile = $basepath . $row->element . '.xml';

		// see if there is an xml install file, must be same name as element
		if (file_exists( $xmlfile )) {
			$this->i_xmldoc =& new DOMIT_Lite_Document();
			$this->i_xmldoc->resolveErrors( true );

			if ($this->i_xmldoc->loadXML( $xmlfile, false, true )) {
				$mosinstall =& $this->i_xmldoc->documentElement;
				// get the files element
				$files_element =& $mosinstall->getElementsByPath( 'files', 1 );
				if (!is_null( $files_element )) {
					$files = $files_element->childNodes;
					foreach ($files as $file) {
						// delete the files
						$filename = $file->getText();
						if (file_exists( $basepath . $filename )) {
							$parts = pathinfo( $filename );
							$subpath = $parts['dirname'];
							if ($subpath <> '' && $subpath <> '.' && $subpath <> '..') {
								echo _MAMHOO_INSTALL_DELETING . $basepath . $subpath;
								$result = deldir(mosPathName( $basepath . $subpath . '/' ));
							} else {
								echo _MAMHOO_INSTALL_DELETING . $basepath . $filename;
								$result = unlink( mosPathName ($basepath . $filename, false));
							}
							echo intval( $result );
						}
					}

					// remove XML file from front
					echo _MAMHOO_INSTALL_DELETING_XML . $xmlfile;
					@unlink( mosPathName ($xmlfile, false ) );

					// define folders that should not be removed
					$sysFolders = array( 'content', 'search' );
					if (!in_array( $row->folder, $sysFolders )) {
						// delete the non-system folders if empty
						if (count( mosReadDirectory( $basepath ) ) < 1) {
							deldir( $basepath );
						}
					}
				}
			}
		}

		if ($row->iscore) {
			HTML_installer::showInstallMessage( $row->name . _MAMHOO_INSTALL_CORE_NOT_UNINST,
			_MAMHOO_INSTALL_UNINST_ERROR, $this->returnTo( $option, 'mamhook', $client ) );
			exit();
		}

		$database->setQuery( "DELETE FROM #__mamhooks WHERE id = '$id'" );
		if (!$database->query()) {
			$msg = $database->stderr;
			die( $msg );
		}
		return true;
	}


	/**
	* method to process the hook script and modify the files
	* @param string The full path of addon
	* @param string The addon install file
	*/
	function hook_addon_install ( $addon_path, $addon_install_file ) {
		$current_command = '' ;
		$commands = array() ;
		$body = array() ;

		$in_header = false ;		// in the header of the command (the ## section)
		$line_num = 0 ;			// line number in the MOD script we are parsing
		// open the hook script and load an array with commands to execute
		$f_hook_script = fopen ( $addon_install_file, 'r');
		if ( !$f_hook_script ) {
			$this->setError(1, sprintf( _MAMHOO_INSTALL_CMD_READERROR, $addon_install_file) );
			return false;
		}
		while (!feof ($f_hook_script)) {
			$buffer = fgets($f_hook_script, 4096);
			$line_num++ ;

			// if the line starts with #, this is either a comment or an action command; will also tell us when
			//		we've hit the last search line of the target content for this command (meaning we've reached the
			//		next command)

			// after obtaining the command, skip any comments until we reach the command body
			if (($buffer[0] == '#') && ($in_header)) {
				// do nothing until we are out of the command header!!
			}

			// not in a header so this comment is either a random comment or start of a command header
			else if ($buffer[0] == '#') {
				// done with last command now that we've hit a comment (regardless if a new command or just a comment)
				if ( $current_command != '') {
					$current_command = '' ;
				}

				// if we find [ and ] on this line, then we can be reasonably sure it is an action command
				if ((strstr($buffer, '[')) && (strstr($buffer, ']'))) {

					//
					// we know it's an action, take appropriate steps for the action; see if the current command
					//	 is found on our list
					//

					if (strstr($buffer, 'OPEN')) {
						$current_command = 'OPEN' ;
					}
					else if (strstr($buffer, 'FIND')) {
						$current_command = 'FIND' ;
					}
					else if (strstr($buffer, 'AFTER, ADD')) {
						$current_command = 'AFTERADD' ;
					}
					else if (strstr($buffer, 'BEFORE, ADD')) {
						$current_command = 'BEFOREADD' ;
					}
					else if (strstr($buffer, 'REPLACE')) {
						$current_command = 'REPLACE' ;
					}
					else if (strstr($buffer, 'SAVE/CLOSE')) {
						$current_command = 'CLOSE' ;
					}

					// normal command processing
					if ( $current_command != '') {
						$in_header = true ;
						$commands[] = array( 'command' => $current_command, 'line' => $line_num) ;
						$body[] = array() ;
					}
				}
			}

			// not a comment or command so this is the body of the command
			else if ( $current_command != '') {
				// store this as this body of our command
				$in_header = false ;
				$body[ count($body)-1 ][] = $buffer ;
			}
		}
		fclose($f_hook_script);

		//
		// check if the files and directories exist and are writable
		//
		$srcfiles = array();
		$srcdirs = array();
		
		// loop through the command, get all files 
		for ($i=0; $i<count( $commands ); $i++) {
			$cur_command = $commands[$i]['command'];
			if ($cur_command == 'OPEN') {
				// strip the body of whitespace down and down to a single line
				$src_filenames = strip_whitespace( $body[$i], true) ;
				$src_filename = mosPathName( $addon_path . trim( $src_filenames[0] ), false );
				$src_filename_orig = $src_filename . '.orig';
				$src_dirname = dirname( $src_filename );
				$srcfiles[] = array('src_filename' => $src_filename, 'src_filename_orig' => $src_filename_orig );
				if ( !in_array($src_dirname, $srcdirs) ) {
					$srcdirs[] = $src_dirname;
				}
			}
		}
		// check if the directories exist and are writable
		$dir_notexists = '';
		$dir_notwritable = '';
		for ($i=0; $i<count( $srcdirs ); $i++) {
			$dir_name = $srcdirs[$i];
			if ( is_dir( $dir_name ) ) {
				if ( !is_writable( $dir_name ) ) {
					$dir_notwritable = $dir_notwritable ? $dir_notwritable . '<BR />' . $dir_name : $dir_name;
				}
			}
			else {
				$dir_notexists = $dir_notexists ? $dir_notexists . '<BR />' . $dir_name : $dir_name;
			}
		}
		// check if the files exist and are writable
		$file_notexists = '';
		$file_notwritable = '';
		for ($i=0; $i<count( $srcfiles ); $i++) {
			$src_filename = $srcfiles[$i]['src_filename'];
			$src_filename_orig = $srcfiles[$i]['src_filename_orig'];
			if ( is_file( $src_filename ) ) {
				if ( !is_writable( $src_filename ) ) {
					$file_notwritable = $file_notwritable ? $file_notwritable . '<BR />' . $src_filename : $src_filename;
				}
			}
			else {
				$file_notexists = $file_notexists ? $file_notexists . '<BR />' . $src_filename : $src_filename;
			}
			
			// original file
			if ( is_file( $src_filename_orig ) ) {
				if ( !is_writable( $src_filename_orig ) ) {
					$file_notwritable = $file_notwritable ? $file_notwritable . '<BR />' . $src_filename_orig : $src_filename_orig;
				}
			}
		}
		// report check result if invalid
		if ( $dir_notexists || $dir_notwritable || $file_notexists || $file_notwritable ) {
			$chkmsg = '';
			if ( $dir_notexists ) {
				$chkmsg = sprintf( _MAMHOO_INSTALL_CHK_DIR_NOT_EXISTS, $dir_notexists);
			}
			if ( $dir_notwritable ) {
				$chkmsg .= '<BR /><BR />' . sprintf( _MAMHOO_INSTALL_CHK_DIR_NOT_WRITABLE, $dir_notwritable);
			}
			if ( $file_notexists ) {
				$chkmsg .= '<BR /><BR />' . sprintf( _MAMHOO_INSTALL_CHK_FILE_NOT_EXISTS, $file_notexists);
			}
			if ( $file_notwritable ) {
				$chkmsg .= '<BR /><BR />' . sprintf( _MAMHOO_INSTALL_CHK_FILE_NOT_WRITABLE, $file_notwritable);
			}
			$this->setError(1, $chkmsg );
			return false;
		}
		// end of check
		
		//
		// now that we have the commands all set, let's start to process them
		//
		$src_filename = '';
		$dest_filenames = array();
		$dest_file_contents = array();

		$src_contents = array();
		$dest_contents = array();
		$search_contents = array() ;		// what we are searching for
		$found_contents = array() ;			// contains lines from a FIND which potentially contain our search target

		$file_openned = false ;
		$cur_src_line = 0 ;

		$search_not_found = false;
		$contents_not_found = array();
		
		// loop through the command
		for ($i=0; $i<count( $commands ); $i++) {
			$cur_command = $commands[$i]['command'];

			if ( ( $cur_command != 'OPEN') && $search_not_found ) {
				continue;
			}
			// protect against malformed script that didn't perform a CLOSE first
			// and perform OPEN twice, that is, a OPEN must has a CLOSE end
			if ( $file_openned	&& ( $cur_command == 'OPEN') ) {
				$this->setError(1, sprintf( _MAMHOO_INSTALL_CMD_OPENFIRST, $cur_command) );
				return false;
			}

			// protect against malformed script that didn't perform a OPEN first
			// and perform FIND and CLOSE
			if ( ( !$file_openned ) && ( ( $cur_command == 'FIND') || ( $cur_command == 'CLOSE') ) ) {
				$this->setError(1, sprintf( _MAMHOO_INSTALL_CMD_OPENFIRST, $cur_command) );
				return false;
			}

			// protect against malformed script that didn't perform a FIND first
			// and perform BEFOREADD, AFTERADD and REPLACE
			if ( ( count( $found_contents ) == 0 ) && ( ( $cur_command == 'BEFOREADD') || ( $cur_command == 'AFTERADD') || ( $cur_command == 'REPLACE') ) ) {
				$cur_command = $cur_command;
				$this->setError(1, sprintf( _MAMHOO_INSTALL_CMD_FINDFIRST, $cur_command) );
				return false;
			}

			// open addon file
			if ($cur_command == 'OPEN') {
				$search_not_found = false;
				// strip the body of whitespace down and down to a single line
				$body[$i] = strip_whitespace( $body[$i], true) ;

				$src_filename = mosPathName( $addon_path . trim( $body[$i][0] ), false );

				// open the file
				$handle = fopen ($src_filename, "r");
				// if can not read file, then show error
				if ( !$handle ) {
					$this->setError(1, sprintf( _MAMHOO_INSTALL_CMD_READERROR, $src_filename) );
					return false;
				}

				$file_openned = true;
				$src_contents = array();
				$dest_contents = array();
				$cur_src_line = 0;

				while (!feof ($handle)) {
					$src_contents[] = fgets($handle, 4096);
				}
				fclose ($handle);
			}

			//
			// find a string or sequential group of strings in the file
			//
			else if ($cur_command == 'FIND') {
				// reinit key vars
				$found_contents = array();

				// make sure we have something to search for; throw a warning if not
				$search_contents = strip_whitespace( $body[$i], false, true );
				$search_lines = count( $search_contents );
				if ( $search_lines == 0 ) {
					$this->setError(1, _MAMHOO_INSTALL_CMD_NOSEARCH );
					return false;
				}

				$matched = false;

				// do the find and see what happens
				for ( $j = $cur_src_line; $j < count($src_contents); $j++ ) {
					//first line matched
					if ( ( !$search_contents[0] && !trim( $src_contents[$j] ) ) || 
						( $search_contents[0] && trim( $src_contents[$j] ) && strpos( $src_contents[$j], $search_contents[0] ) !== false ) ) {
						$matched = true;
						$found_contents[] = $src_contents[$j];
						// if $search_lines is 1, match succsess, then break
						if ( $search_lines == 1 ) {
							$cur_src_line = $j + 1;
							break;
						}
						// else continue matching
						else {
							for ($k=1; $k<$search_lines; $k++) {
								if ( ( !$search_contents[$k] && !trim( $src_contents[$j+$k] ) ) || 
									( $search_contents[$k] && trim( $src_contents[$j+$k] ) && strpos( $src_contents[$j+$k], $search_contents[$k] ) !== false ) ) {
									$matched = true;
									$found_contents[] = $src_contents[$j+$k];
								}
								else {
									$matched = false;
									break;
								}
							}

							//match succsess, then break
							if ( $matched ) {
								$cur_src_line = $j + $search_lines;
								break;
							}
							//else
							else {
								//append the found contents into dest contents array
								array_append ($dest_contents, $found_contents);
								//adjust the src contents offset
								$j = $j + count($found_contents) - 1;
								//clear the found contents
								$found_contents = array();
							}
						}
					}
					else {
						$dest_contents[] = $src_contents[$j];
					}
				}

				if ( !$matched ) {
					$search_not_found = true;
					$file_openned = false;
					$search_content = implode("<BR />", $search_contents);
					$contents_not_found[] = array('src_filename' => $src_filename, 'search_content' => $search_content );
					continue;
				}

			}

			//
			// write out the find array then write the body
			//
			else if ($cur_command == 'AFTERADD') {
				//append the found contents into dest contents array
				array_append ($dest_contents, $found_contents);

				//append the add contents into dest contents array
				array_append ($dest_contents, $body[$i]);

				// clear the found contents array
				$found_contents = array() ;
			}

			//
			// write the body then write out the find array
			//
			else if ($cur_command == 'BEFOREADD') {
				//append the add contents into dest contents array
				array_append ($dest_contents, $body[$i]);

				//append the found contents into dest contents array
				array_append ($dest_contents, $found_contents);

				// clear the found contents array
				$found_contents = array() ;
			}

			//
			// write the body then throw out the find array!
			//
			else if ($cur_command == 'REPLACE') {
				//append the add contents into dest contents array
				array_append ($dest_contents, $body[$i]);

				// clear the found contents array
				$found_contents = array();
			}

			//
			// close up and stop processing
			//
			else if ($cur_command == 'CLOSE') {
				// if we haven't dumped the find_array, then do it now
				if ( count($found_contents) > 0 ) {
					//append the found contents into dest contents array
					array_append ($dest_contents, $found_contents);
					$found_contents = array() ;
				}

				array_append ($dest_contents, $src_contents, $cur_src_line);
		
				// store filename and contents into array
				$dest_filenames[] = $src_filename;
				$dest_file_contents[] = $dest_contents;
				
				$file_openned = false;
			}

		}
		
		// if contents not found, then report error msg
		if ( count( $contents_not_found ) ) {
			$chkmsg = _MAMHOO_INSTALL_CMD_NOMATCHED . '<BR /><BR />';
			for ($i=0; $i<count( $contents_not_found ); $i++) {
				$src_filename = $contents_not_found[$i]['src_filename'];
				$search_content = $contents_not_found[$i]['search_content'];
				$chkmsg .= $src_filename . '<BR />' . $search_content . '<BR /><BR />';
			}
			$this->setError( 1, $chkmsg );
			return false;
		}
		
		// finally, rename src files and create dest files
		for ($i=0; $i<count( $dest_filenames ); $i++) {
			$dest_filename = $dest_filenames[$i];
			$src_filename = $dest_filename . '.orig';
			//Rename the src filename to 'filename.orig'
			if ( file_exists($src_filename) ) {
				unlink ($src_filename);
			}
			if ( !rename ($dest_filename, $src_filename) ) {
				$this->setError(1, sprintf( _MAMHOO_INSTALL_CMD_CREATEERROR, $src_filename) );
				return false;
			}

			//create dest file
			if (!$handle = fopen($dest_filename, 'w')) {
				$this->setError(1, sprintf( _MAMHOO_INSTALL_CMD_CREATEERROR, $dest_filename) );
				return false;
			}
			//write contents into dest file
			foreach ( $dest_file_contents[$i] as $dest_content ) {
				if ( empty( $dest_content ) ) continue;
				if (!fwrite($handle, $dest_content)) {
					$this->setError(1, sprintf( _MAMHOO_INSTALL_CMD_WRITEERROR, $dest_content, $dest_filename) );
					return false;
				}
			}
			fclose($handle);
		}
		return true;
	}
}

	// Append the src_array to the dest_array, start from offset
	function array_append (&$dest_array, &$src_array, $offset=0) {
		for ($j=$offset; $j<count( $src_array ); $j++) {
			$dest_array[] = $src_array[$j] ;
		}
	}

	// strip the body array of a command down to the minimum
	function strip_whitespace( $body, $single_line=true, $keep_blank_line=false )
	{
		$new_array = array() ;
		$have_line = false ;

		// rebuild the array and drop the whitespace lines
		for ($i=0; $i<count($body); $i++)
		{
			// if we already have line and are only looking for one, then skip this line
			if (($have_line) && ($single_line))
			{
				// do nothing
			}

			// if the line has something on it, then we'll want to store it
			else if ( $keep_blank_line || ( strlen(trim($body[$i])) > 0 ) )
			{
				$new_array[] = trim($body[$i]) ;
				$have_line = true ;
			}

			// empty line so get this out of our body array
			else
			{
				// do nothing
			}
		}

		// the white space is now gone, return the result
		return $new_array ;
	}
?>
