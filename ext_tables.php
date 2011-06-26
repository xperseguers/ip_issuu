<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

	// Registering as Plugin
Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'pi1',
	'issuu'
);

	// Flexform stuff
$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/Flexform/flexform_ds_pi1.xml');

?>