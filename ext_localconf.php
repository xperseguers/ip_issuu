<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}
	// Configuring Frontend Plugin
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'pi1',
	array(
		'Index' => 'index'
	)
);

?>