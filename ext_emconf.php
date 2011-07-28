<?php

########################################################################
# Extension Manager/Repository config file for ext "ip_issuu".
#
# Auto generated 27-06-2011 12:44
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'issuu Flash PDFs',
	'description' => 'Flip through your pdfs using issuu.com',
	'category' => 'plugin',
	'author' => 'Ingo Pfennigstorf',
	'author_email' => 'i.pfennigstorf@gmail.com',
	'shy' => '',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.1.1',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.5.0-4.6.99',
			'extbase' => '',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:11:{s:9:"ChangeLog";s:4:"d0eb";s:10:"README.txt";s:4:"d0a1";s:16:"ext_autoload.php";s:4:"c375";s:12:"ext_icon.gif";s:4:"2f2c";s:17:"ext_localconf.php";s:4:"b40c";s:14:"ext_tables.php";s:4:"f707";s:28:"Classes/Controller/Index.php";s:4:"dea1";s:29:"Classes/Domain/Model/Flip.php";s:4:"3637";s:42:"Configuration/Flexform/flexform_ds_pi1.xml";s:4:"50c4";s:44:"Resources/Private/Templates/Index/Index.html";s:4:"f590";s:14:"doc/manual.sxw";s:4:"cc83";}',
);

?>