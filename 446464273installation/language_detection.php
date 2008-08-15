<?php
/**
* @version $Id: language_detection.php,v 1.2 2005/02/19 23:23:00 mic Exp $
* @package MMLi & MGFi
* @copyright (C) 2005 mamboworld.net
* @license http://creativecommons.org
* @author mic (developer@mamboworld.net) www.mamboworld.net
* Mambo is Free Software
*/

/** 2004.12.24	win codes added
	2005-01.23	phpversion check added
	2005.02.19	some improvements and german as standard
*/

	if ( $language_install == '') {
	    $det_lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$lang_nav = strtolower(substr($det_lang, 0, 2));

		switch( $lang_nav ){
			case 'ar':
				$language_install = 'arabian';
				break;
			case 'bg':
				$language_install = 'bulgarian';
				break;
			case 'br':
				$language_install = 'brasilian';
				break;
			case 'cs':
				$language_install = 'czech';
				break;
			case 'da':
				$language_install = 'danish';
				break;
			case 'de':
				$language_install = 'germanf';
				break;
			case 'en':
				$language_install = 'english';
				break;
			case 'es':
				$language_install = 'spanish';
				break;
			case 'fi':
				$language_install = 'finnish';
				break;
			case 'fr':
				$language_install = 'french';
				break;
			case 'hr':
				$language_install = 'croatian';
				break;
			case 'hu':
				$language_install = 'hungarian';
				break;
			case 'it':
				$language_install = 'italian';
				break;
			case 'nl':
				$language_install = 'dutch';
				break;
			case 'no':
				$language_install = 'norwegian';
				break;
			case 'pt':
				$language_install = 'portuguese';
				break;
			case 'ro':
				$language_install = 'romanian';
				break;
			case 'ru':
				$language_install = 'russian';
				break;
			case 'sv':
				$language_install = 'swedish';
				break;
			case 'th':
				$language_install = 'thai';
				break;
			case 'zh':
				$language_install = 'simplified_chinese';
				break;
			default:
				$language_install = 'english';
	  	} // switch
	}

	// checking for correct german definition and image
	if( strtolower( substr( $language_install, 0, 6 )) == 'german' ){
		$language_install_img = 'german';
	} else $language_install_img = $language_install;

// check for older phpversions ( < 4.3 )
if( phpversion() >= '4.3' ){
	// check for serversettings belonging to display dates and times
	$lng_code = array();
	// arabic
	$lng_code['ar']['lng'] = 'AR';
	$lng_code['ar']['loc'] = setlocale ( LC_TIME, 'ar_AA', 'ar_AE', 'ar_BH', 'ar_DZ', 'ar_EG', 'ar_IN', 'ar_IQ', 'ar_JO', 'ar_KW', 'ar_LB', 'ar_LY', 'ar_MA', 'ar_OM', 'ar_QA', 'ar_SA', 'ar_SD', 'ar_SY', 'ar_TN', 'ar_YE', 'ar_AA.ISO8859-6', 'Ar_AA.IBM-1046', 'ar_AE.UTF-8', 'ar_BH.UTF-8', 'ar_DZ.UTF-8', 'ar_EG.UTF-8', 'ar_IQ.UTF-8', 'ar_JO.UTF-8', 'ar_KW.UTF-8', 'ar_LB.UTF-8', 'ar_LY.UTF-8', 'ar_MA.UTF-8', 'ar_OM.UTF-8', 'ar_QA.UTF-8', 'ar_SA.UTF-8', 'ar_SD.UTF-8', 'ar_SY.UTF-8', 'ar_TN.UTF-8', 'ar_YE.UTF-8', 'arabian' );
	if( $language_install == 'arabian' ){
		$detected_lang = $lng_code['ar']['loc'];
		$install_iso = 'ISO8859-6';
	}
	// bulgarian
	$lng_code['bg']['lng'] = 'BG';
	$lng_code['bg']['loc'] = setlocale ( LC_TIME, 'bg_BG', 'BG_BG', 'bgr_BGR', 'bulgarian');
	if( $language_install == 'bulgarian' ){
		$detected_lang = $lng_code['bg']['loc'];
		$install_iso = 'ISO8856-5';
	}
	// simplified chinese
	$lng_code['cn']['lng'] = 'CN';
	$lng_code['cn']['loc'] = setlocale ( LC_TIME, 'zh_CN' );
	if( strtolower( $language_install ) == 'simplified_chinese' ){
		$detected_lang = $lng_code['cn']['loc'];
		$install_iso = 'gb2312';
	}
	if( strtolower( $language_install ) == 'simplified_chinese_utf-8' ){
		$detected_lang = $lng_code['cn']['loc'];
		$install_iso = 'UTF-8';
	}
	// traditional chinese
	$lng_code['tw']['lng'] = 'TW';
	$lng_code['tw']['loc'] = setlocale ( LC_TIME, 'zh_TW' );
	if( strtolower( $language_install ) == 'traditional_chinese' ){
		$detected_lang = $lng_code['tw']['loc'];
		$install_iso = 'BIG5';
	}
	if( strtolower( $language_install ) == 'traditional_chinese_utf-8' ){
		$detected_lang = $lng_code['tw']['loc'];
		$install_iso = 'UTF-8';
	}
	// czech
	$lng_code['cs']['lng'] = 'CS';
	$lng_code['cs']['loc'] = setlocale ( LC_TIME, 'cs', 'cs_CZ', 'CS_CZ', 'csy', 'czech' );
	if( strtolower( $language_install ) == 'czechiso' ){
		$detected_lang = $lng_code['cs']['loc'];
		$install_iso = 'iso-8859-2';
	}elseif( strtolower( $language_install ) == 'czech1250' ){
		$detected_lang = $lng_code['cs']['loc'];
		$install_iso = 'windows-1250';
	}
	// danish
	$lng_code['da']['lng'] = 'DA';
	$lng_code['da']['loc'] = setlocale ( LC_TIME, 'da_dk', 'da_DK', 'Da_DK', 'DA_DK', 'da_DK.ISO8859-1', 'da_DK.ISO.8859-1', 'da_DK.ISO8859-15', 'da_DK.IBM-850', 'dan', 'danish' );
	if( $language_install == 'danish' ){
		$detected_lang = $lng_code['da']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// german - deutsch
	$lng_code['de']['lng'] = 'DE';
	$lng_code['de']['loc'] = setlocale ( LC_TIME, 'de_DE', 'ge', 'de', 'DE_DE', 'de_AT', 'de_BE', 'de_CH', 'de_LU', 'GE', 'DE', 'deu', 'Deu', 'DEU', 'german_GERMANY', 'german_Germany', 'de_DE@euro', 'de_DE.UTF-8', 'german', 'German', 'GERMAN', 'de_DE.ISO_8859-1', 'de_DE.ISO8859-1', 'de_DE.ISO8859-15', 'de_DE.ISO_8859-15', 'de_AT.ISO8859-1', 'de_AT.ISO_8859-1', 'de_AT.ISO_8859-15', 'de_CH.ISO8859-1', 'de_CH.ISO_8859-1', 'de_CH.ISO8859-15', 'de_CH.ISO_8859-15', 'de_DE.roman8', 'de_AT.UTF-8', 'de_AT.UTF-8@euro', 'de_BE.UTF-8', 'de_BE.UTF-8@euro', 'de_BE@euro', 'de_CH.UTF-8', 'de_DE.UTF-8@euro', 'de_LU.UTF-8', 'de_LU.UTF-8@euro', 'de_LU@euro', 'dea', 'german-austria', 'des', 'german-swiss', 'swiss' );
	if( substr( $language_install, 0, 6 ) == 'german' ){
		$detected_lang = $lng_code['de']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// english
	$lng_code['en']['lng'] = 'EN';
	$lng_code['en']['loc'] = setlocale ( LC_TIME, 'en_GB', 'en_US', 'en_AU', 'en_BE', 'en_BW', 'en_CA', 'en_DK', 'en_IE', 'en_IN', 'en_NZ', 'en_PH', 'en_SG', 'en_ZA', 'En_GB', 'En_US', 'en_GB.UTF-8', 'en_US.UTF-8', 'en_US.iso885915', 'english', 'English', 'ENGLISH', 'en_AU.UTF-8', 'en_BW.UTF-8', 'en_CA.UTF-8', 'en_DK.UTF-8', 'en_GB.ISO-8859-15', 'en_HK.UTF-8', 'en_IE.UTF-8', 'en_IE.UTF-8@euro', 'en_IE@euro', 'en_NZ.UTF-8', 'en_PH.UTF-8', 'en_SG.UTF-8', 'en_US.ISO-8859-15', 'en_ZA.UTF-8', 'en_ZW.UTF-8', 'australian', 'ena', 'englich-aus', 'canadian', 'enc', 'english-can', 'english-nz', 'enz', 'eng', 'english-uk', 'uk', 'american', 'american english', 'american-english', 'english-american', 'english-us', 'english-usa', 'enu', 'us', 'usa' );
	if( $language_install == 'english' ){
		$detected_lang = $lng_code['en']['loc'];
		$install_iso = 'iso-8859-1';
	}
	if( $language_install == 'english_utf-8' ){
		$detected_lang = $lng_code['en']['loc'];
		$install_iso = 'UTF-8';
	}
	// spainish
	$lng_code['es']['lng'] = 'ES';
	$lng_code['es']['loc'] = setlocale ( LC_TIME, 'es_ES', 'ES_ES', 'es-ES', 'es_AR', 'es_BO', 'es_CL', 'es_CO', 'es_CR', 'es_DO', 'es_EC', 'es_ES', 'es_GT', 'es_HN', 'es_MX', 'es_NI', 'es_PA', 'es_PE', 'es_PR', 'es_PY', 'es_SV', 'es_US', 'es_UY', 'es_VE', 'spain', 'spanish', 'Spanish', 'SPANISH', 'es_ES.ISO8859-15', 'es_ES.ISO_8859-1', 'es_ES.ISO8859-1', 'es_AR.UTF-8', 'es_BO.UTF-8', 'es_CL.UTF-8', 'es_CO.UTF-8', 'es_CR.UTF-8', 'es_DO.UTF-8', 'es_EC.UTF-8', 'es_ES.UTF-8', 'es_ES.UTF-8@euro', 'es_ES@euro', 'es_GT.UTF-8', 'es_HN.UTF-8', 'es_MX.UTF-8', 'es_NI.UTF-8', 'es_PA.UTF-8', 'es_PE.UTF-8', 'es_PR.UTF-8', 'es_PY.UTF-8', 'es_SV.UTF-8', 'es_US.UTF-8', 'es_UY.UTF-8', 'es_VE.UTF-8', 'esp', 'esm', 'spanish-mexican', 'esn', 'spanish-modern' );
	if( $language_install == 'spainish' ){
		$detected_lang = $lng_code['es']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// finnish
	$lng_code['fi']['lng'] = 'FI';
	$lng_code['fi']['loc'] = setlocale ( LC_TIME, 'fi_FI', 'FI_FI', 'fin', 'finnish' );
	if( $language_install == 'finnish' ){
		$detected_lang = $lng_code['fi']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// french
	$lng_code['fr']['lng'] = 'FR';
	$lng_code['fr']['loc'] = setlocale ( LC_TIME, 'fr_FR', 'Fr_FR', 'fr_BE', 'Fr_BE', 'fr_ca', 'fr_CA', 'Fr_CA', 'fr_LU', 'fr_CH', 'Fr_CH', 'fr', 'FR', 'french', 'fra', 'france', 'french', 'French', 'FRENCH', 'fr_FR.ISO8859-1', 'fr_FR.ISO_8859-1', 'fr_FR.UTF-8', 'fr_BE.UTF-8', 'fr_BE.UTF-8@euro', 'fr_BE@euro', 'fr_CA.UTF-8', 'fr_CH.UTF-8', 'fr_FR.UTF-8@euro', 'fr_FR@euro', 'fr_LU.UTF-8', 'fr_LU.UTF-8@euro', 'fr_LU@euro', 'fra', 'frb', 'french-belgian', 'frc', 'french-canadian', 'french-swiss', 'frs' );
	if( $language_install == 'french' ){
		$detected_lang = $lng_code['fr']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// croation
	$lng_code['hr']['lng'] = 'HR';
	$lng_code['hr']['loc'] = setlocale ( LC_TIME, 'hr_HR', 'HR_HR', 'hr', 'croatian', 'croatia' );
	if( $language_install == 'croatian' ){
		$detected_lang = $lng_code['hr']['loc'];
		$install_iso = 'iso-8859-2';
	}
	// hungarian
	$lng_code['hu']['lng'] = 'HU';
	$lng_code['hu']['loc'] = setlocale ( LC_TIME, 'hu_HU', 'HU_HU', 'hu', 'hun', 'hungarian', 'hungary' );
	if( $language_install == 'hungarian' ) $detected_lang = $lng_code['hu']['loc'];
	if( substr( $language_install, 0, 9 ) == 'hungarian' ){
		$detected_lang = $lng_code['hu']['loc'];
		$install_iso = 'iso-8859-2';
	}
	// italian
	$lng_code['it']['lng'] = 'IT';
	$lng_code['it']['loc'] = setlocale ( LC_TIME, 'it_IT', 'IT_IT', 'It_IT', 'it_CH', 'italian', 'Italian', 'ITALIAN', 'it_IT.ISO8859-1', 'it_IT.ISO8859-15', 'it_IT.UTF-8', 'it_CH.UTF-8', 'it_IT.UTF-8@euro', 'it_IT@euro', 'ita', 'italian-swiss', 'its' );
	if( $language_install == 'italian' ){
		$detected_lang = $lng_code['it']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// lithuanian
	$lng_code['lt']['lng'] = 'LT';
	$lng_code['lt']['loc'] = setlocale ( LC_TIME, 'lt_lt', 'lt_LT', 'Lt_LT', 'LT_LT', 'lt_LT.Windows-1257', 'lt_LT.IBM-921', 'lt_LT.UTF-8', 'lithuanian' );
	if( $language_install == 'lithuanian' ){
		$detected_lang = $lng_code['lt']['loc'];
		$install_iso = 'Windows-1257';
	}
	// dutch
	$lng_code['nl']['lng'] = 'NL';
	$lng_code['nl']['loc'] = setlocale ( LC_TIME, 'nl_nl', 'nl_NL', 'Nl_NL', 'NL_NL', 'nl_be', 'nl_BE', 'Nl_BE',  'dutch', 'Dutch', 'DUTCH', 'nl_NL.ISO8859-1', 'nl_BE.UTF-8@euro', 'nl_BE@euro', 'nl_NL.UTF-8', 'nl_NL.UTF-8@euro', 'nl_NL@euro', 'nld', 'nld_nld', 'belgian', 'dutch-belgian' );
	if( $language_install == 'dutch' ){
		$detected_lang = $lng_code['nl']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// norwegian
	$lng_code['no']['lng'] = 'NO';
	$lng_code['no']['loc'] = setlocale ( LC_TIME, 'no_NO', 'NO_NO', 'norwegian', 'nor', 'norwegian-bokmal', 'non', 'norwegian-nynorsk', 'no_NO.ISO8859-1' );
	if( $language_install == 'norwegian' ){
		$detected_lang = $lng_code['no']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// polish
	$lng_code['pl']['lng'] = 'PL';
	$lng_code['pl']['loc'] = setlocale ( LC_TIME, 'pl_PL', 'PL_PL', 'polish', 'Polish', 'POLISH', 'pl_PL.ISO8859-2', 'pl_PL.UTF-8', 'Polish_Poland.28592', 'plk' );
	if( $language_install == 'polish' ){
		$detected_lang = $lng_code['pl']['loc'];
		$install_iso = 'iso-8859-2';
	}
	// portuguese
	$lng_code['pt']['lng'] = 'PT';
	$lng_code['pt']['loc'] = setlocale ( LC_TIME, 'pt_pt', 'pt_PT', 'Pt_PT', 'PT_PT', 'pt_br', 'pt_BR', 'pt_BR.ISO-8859-1', 'pt_PT.ISO8859-1', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese', 'pt_BR.UTF-8', 'pt_PT.UTF-8', 'pt_PT.UTF-8@euro', 'pt_PT@euro', 'ptg', 'portuguese-brazil', 'ptb' );
	if( $language_install == 'portuguese' ){
		$detected_lang = $lng_code['pt']['loc'];
		$install_iso = 'iso-8859-1';
	}
	// romanian
	$lng_code['ro']['lng'] = 'RO';
	$lng_code['ro']['loc'] = setlocale ( LC_TIME, 'ro_RO', 'RO_RO', 'ro_RO.ISO8859-2', 'romanian', 'ro_RO.UTF-8' );
	if( $language_install == 'romanian' ){
		$detected_lang = $lng_code['ro']['loc'];
		$install_iso = 'iso-8859-2';
	}
	// russian
	$lng_code['ru']['lng'] = 'RU';
	$lng_code['ru']['loc'] = setlocale ( LC_TIME, 'ru_RU', 'RU_RU', 'ru_UA', 'ru_RU.ISO8859-5', 'ru_RU.ANSI1251', 'ru_RU.KOI8-R', 'ru_RU.UTF-8', 'ru_UA.UTF-8', 'russian', 'rus' );
	if( $language_install == 'russian' ){
		$detected_lang = $lng_code['ru']['loc'];
		$install_iso = 'iso-8859-5';
	}
	// swedisch
	$lng_code['sv']['lng'] = 'SV';
	$lng_code['sv']['loc'] = setlocale ( LC_TIME, 'sv_SE', 'SV_SE', 'Sv_SE', 'sv_FI', 'swedish', 'Swedish', 'SWEDISH', 'sv_SE.ISO8859-1', 'sv_SE.ISO8859-15', 'sv_SE.UTF-8', 'sv_FI.UTF-8', 'sv_FI.UTF-8@euro', 'sv_FI@euro', 'sv_SE.ISO-8859-15', 'sve' );
	if( $language_install == 'swedish' ){
		$detected_lang = $lng_code['sv']['loc'];
		$install_iso = 'iso-8859-1';
	}
// Thai
	$lng_code['th']['lng'] = 'TH';
	$lng_code['th']['loc'] = setlocale ( LC_TIME, 'en_GB' );
	if( $language_install == 'thai' ){
		$detected_lang = $lng_code['th']['loc'];
		$install_iso = 'tis-620';
	}

	/* further codes for future implementation
	* turkish	-
	* slovak 	- 'sky', 'slovak'
	* greek		- 'ell', 'greek'
	*/

	/*
    if ( file_exists( 'language/install_'.$language_install.'.php')) {
    	include 'language/install_'.$language_install.'.php';
    } else {
		include 'language/install_english.php';
	}
	*/
}else{
	// fallback if phpversion is older than 4.3 !!
	// has to be adopt if standard is english or another language -> in this case took some of the code above and replace!
	// english
	/*
	$lng_code['en']['lng'] = 'EN';
	$lng_code['en']['loc'] = setlocale ( LC_TIME, 'en_GB');
	$detected_lang = $lng_code['en']['loc'];
	$install_iso = 'iso-8859-1';
	*/
	// here we have german as standard >> disable if not german is standard
	$lng_code['de']['lng'] = 'DE';
	$lng_code['de']['loc'] = setlocale ( LC_TIME, 'de_DE', 'ge', 'de', 'DE_DE', 'de_AT', 'de_BE', 'de_CH', 'de_LU', 'GE', 'DE', 'deu', 'Deu', 'DEU', 'german_GERMANY', 'german_Germany', 'de_DE@euro', 'de_DE.UTF-8', 'german', 'German', 'GERMAN', 'de_DE.ISO_8859-1', 'de_DE.ISO8859-1', 'de_DE.ISO8859-15', 'de_DE.ISO_8859-15', 'de_AT.ISO8859-1', 'de_AT.ISO_8859-1', 'de_AT.ISO_8859-15', 'de_CH.ISO8859-1', 'de_CH.ISO_8859-1', 'de_CH.ISO8859-15', 'de_CH.ISO_8859-15', 'de_DE.roman8', 'de_AT.UTF-8', 'de_AT.UTF-8@euro', 'de_BE.UTF-8', 'de_BE.UTF-8@euro', 'de_BE@euro', 'de_CH.UTF-8', 'de_DE.UTF-8@euro', 'de_LU.UTF-8', 'de_LU.UTF-8@euro', 'de_LU@euro', 'dea', 'german-austria', 'des', 'german-swiss', 'swiss' );
	if( substr( $language_install, 0, 6 ) == 'german' ){
		$detected_lang = $lng_code['de']['loc'];
		$install_iso = 'iso-8859-1';
	}
}
?>