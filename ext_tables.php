<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';

	// Registering as Plugin
Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'pi1',
	'issuu'
);

	// Flexform stuff
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] ='pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:'.$_EXTKEY . '/Configuration/Flexform/flexform_ds_pi1.xml');
?>