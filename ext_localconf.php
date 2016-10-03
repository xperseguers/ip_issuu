<?php
defined('TYPO3_MODE') || die();

// Configuring Frontend Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Ipf.' . $_EXTKEY,
	'pi1',
	array(
		'Index' => 'index'
	)
);
