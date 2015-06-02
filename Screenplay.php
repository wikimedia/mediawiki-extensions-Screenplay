<?php

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Screenplay',
	'author' => array( 'Bartosz Dziewoński', 'Calimonius the Estrange' ),
	'url' => 'https://www.mediawiki.org/wiki/Extension:Screenplay',
	'descriptionmsg' => 'screenplay-desc',
	'license-name' => 'MIT',
	'version' => .3,
);

$wgAutoloadClasses['Screenplay'] = __DIR__ . '/Screenplay.class.php';
$wgExtensionMessagesFiles['Screenplay'] = __DIR__ . '/Screenplay.i18n.php';
$wgMessagesDirs['Screenplay'] = __DIR__ . '/i18n';
$wgHooks['ParserFirstCallInit'][] = 'Screenplay::init';

$wgResourceModules['ext.screenplay'] = array(
	'styles' => 'ext.screenplay.css',
	'position' => 'top',
	'localBasePath' => __DIR__ . '/resources',
	'remoteExtPath' => 'Screenplay/resources',
);
