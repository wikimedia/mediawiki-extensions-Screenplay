<?php

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Screenplay',
	'author' => array( 'Bartosz Dziewoński', 'Calimonius the Estrange' ),
	'url' => 'https://github.com/MatmaRex/Screenplay',
	'descriptionmsg' => 'screenplay-desc',
);

$wgAutoloadClasses['Screenplay'] = __DIR__ . '/Screenplay.class.php';
$wgMessagesDirs['Screenplay'] = __DIR__ . '/i18n';
$wgHooks['ParserFirstCallInit'][] = 'Screenplay::init';

$wgResourceModules['ext.screenplay'] = array(
	'styles' => 'ext.screenplay.css',
	'localBasePath' => __DIR__ . '/resources',
	'remoteExtPath' => 'Screenplay/resources',
);
