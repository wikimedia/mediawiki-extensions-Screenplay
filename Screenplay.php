<?php
if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'Screenplay' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['Screenplay'] = __DIR__ . '/i18n';
	wfWarn(
		'Deprecated PHP entry point used for Screenplay extension. Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the Screenplay extension requires MediaWiki 1.25+' );
}
