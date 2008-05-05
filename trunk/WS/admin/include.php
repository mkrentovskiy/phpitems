<?


	//
	// Common classes
	//

	require_once 'objects/control.php';
	require_once 'objects/session.php';
	require_once 'objects/database.php';
	require_once 'objects/extmanager.php';
	require_once 'objects/struct.php';
	require_once 'objects/system.php';
	require_once 'objects/file.php';
	require_once 'objects/txtfile.php';
	require_once 'objects/pattern.php';
	require_once 'objects/user.php';
	require_once 'objects/group.php';
	require_once 'objects/info.php';
	require_once 'objects/log.php';
	require_once 'objects/manager.php';
	require_once 'objects/xmlpage.php';
	require_once 'objects/functions.php';
	require_once 'objects/excelimport.php';
	
	//      	
	//
	//

	require_once 'objects/domains/_base.php';
	require_once 'objects/domains/e_aset.php';
	require_once 'objects/domains/e_bool.php';
	require_once 'objects/domains/e_datetime.php';
	require_once 'objects/domains/e_time.php';
	require_once 'objects/domains/e_filelink.php';
	require_once 'objects/domains/e_imagelink.php';
	require_once 'objects/domains/e_photolink.php';
	require_once 'objects/domains/e_key.php';
	require_once 'objects/domains/e_limit.php';
	require_once 'objects/domains/e_longtext.php';
	require_once 'objects/domains/e_number.php';
	require_once 'objects/domains/e_parkey.php';
	require_once 'objects/domains/e_selfparkey.php';
	require_once 'objects/domains/e_sparkey.php';
	require_once 'objects/domains/e_sset.php';
	require_once 'objects/domains/e_text.php';
	require_once 'objects/domains/e_title.php';
	require_once 'objects/domains/e_float.php';
	require_once 'objects/domains/e_setkey.php';
	require_once 'objects/domains/e_calendar.php';
	require_once 'objects/domains/e_vrichtext.php';
	require_once 'objects/domains/e_enum.php';
	require_once 'objects/domains/e_position.php';
	require_once 'objects/domains/e_dbtable.php';

	require_once 'objects/modules/_base.php';
	require_once 'objects/modules/a_backup.php';
	require_once 'objects/modules/a_filemanager.php';
	require_once 'objects/modules/a_xslt.php';
	require_once 'objects/modules/a_import.php';

	require_once 'objects/tables/_base.php';
	require_once 'objects/tables/o_common.php';
	require_once 'objects/tables/o_structed.php';	

	require_once 'objects/extern/Image_Toolbox.class.php';	

	//
	// Patterns
	//	
	$cat_pattern = 'misc/pattern.html';
	$cat_loginbox = 'misc/loginbox.html';

	//
	// Components
	//
	$cat_modlist = array(
		'ModBackup',
		'ModFileManager',
		'ModImport');

	$cat_tablist = array(
		'TabCommon',
		'TabStructed');

	$cat_domlist = array(
		'DomASet',
		'DomSSet',
		'DomDateTime',
		'DomTime',
		'DomKey',
		'DomParKey',
		'DomSelfParKey',
		'DomSParKey',
		'DomSText',
		'DomLongText',
		'DomTitle',
		'DomLimit',
		'DomBool',
		'DomFileLink',
		'DomImageLink',
		'DomPhotoLink',
		'DomNumber',
		'DomFloat',
		'DomSetKey',
		'DomCalendar',
		'DomVRichText',
		'DomEnum',
		'DomPosition',
		'DomDbTable'
	);

	//
	// Domain default size
	//
		
	$cat_domain_def = array(
		'DomASet' => 1,
		'DomSSet' => 1,
		'DomDateTime' => 1,
		'DomTime' => 1,
		'DomKey' => 8,
		'DomParKey' => 8,
		'DomSelfParKey' => 8,
		'DomSParKey' => 8,
		'DomSText' => 255,
		'DomLongText' => 255,
		'DomTitle' => 128,
		'DomLimit' => 16,
		'DomBool' => 1,
		'DomFileLink' => 128,
		'DomImageLink' => 128,
		'DomPhotoLink' => 128,
		'DomNumber' => 4,
		'DomFloat' => 1,
		'DomSetKey' => 8,
		'DomCalendar' => 1,
		'DomRichText' => 255,
		'DomVRichText' => 255,
		'DomEnum' => 255,
		'DomPosition' => 8,
		'DomDbTable' => 128
	);
		

?>