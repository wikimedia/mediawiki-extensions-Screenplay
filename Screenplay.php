<?php

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'Screenplay',
	'author' => array( 'Bartosz Dziewoński' ),
	'url' => 'https://github.com/MatmaRex/Screenplay',
	'descriptionmsg' => 'screenplay-desc',
);

$wgAutoloadClasses['Screenplay'] = __DIR__ . '/Screenplay.class.php';
$wgMessagesDirs['Screenplay'] = __DIR__ . '/i18n';
$wgHooks['ParserFirstCallInit'][] = 'Screenplay::init';
