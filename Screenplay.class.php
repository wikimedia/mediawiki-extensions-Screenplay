<?php

class Screenplay {
	/**
	 * @param Parser $parser
	 * @return bool true
	 */
	public static function init( Parser &$parser ) {
		$parser->setHook( 'screenplay', array( 'Screenplay', 'render' ) );
		return true;
	}

	/**
	 * @param string $input
	 * @param array $args
	 * @param Parser $parser
	 * @param PPFrame $frame
	 * @return string
	 */
	public static function render( $input, array $args, Parser $parser, PPFrame $frame ) {
		// Things that would normally be wrapped in <p>s are wrapped in <div>s with classes as follows:
		// * 'setting': first four letters are 'INT.' or 'EXT.'
		// * 'line': begins all caps (until a single \n) that is not a setting; single linebreaks within these delimit further <div> wrappers as follows:
		//   * 'line-speaker': everything until the first single \n
		//   * 'line-paren': any line wrapped in parentheses that is not a speaker
		//   * 'line-text': any other line within a 'line'
		// * 'block': anything else

		$blocks = explode( "\n\n", trim( $input ) );

		$blocks = array_map( function ( $block ) use ( $parser, $frame ) {
			$block = trim( $block );
			if ( $block == '' ) {
				return '';
			}

			// 'setting': first four letters are 'INT.' or 'EXT.'
			if ( preg_match( '/^(?:INT\.|EXT\.)/', $block ) ) {
				return
					'<div class="sp-setting">' .
						$parser->recursiveTagParse( $block, $frame ) .
					'</div>';
			}

			// 'line': begins all caps (until a single \n) that is not a setting; single linebreaks within these delimit further <div> wrappers as follows:
			// * 'line-speaker': everything until the first single \n
			// * 'line-paren': any line wrapped in parentheses that is not a speaker
			// * 'line-text': any other line within a 'line'

			// Anything but a lowercase letter. http://www.regular-expressions.info/unicode.html
			if ( preg_match( '/^[^\p{Ll}]+?\n/', $block ) ) {
				$lines = explode( "\n", $block );
				$speaker = array_shift( $lines );

				$lines = array_map( function ( $line ) use ( $parser, $frame ) {
					if ( preg_match( '/^\(.+\)$/', $line ) ) {
						return
							'<div class="sp-line-paren">' .
								$parser->recursiveTagParse( $line, $frame ) .
							'</div>';
					} else {
						return
							'<div class="sp-line-text">' .
								$parser->recursiveTagParse( $line, $frame ) .
							'</div>';
					}
				}, $lines );

				return
					'<div class="sp-line">' .
						'<div class="sp-line-speaker">' .
							$parser->recursiveTagParse( $speaker, $frame ) .
						'</div>' .
						implode( '', $lines ) .
					'</div>';
			}

			// 'block': anything else
			return
				'<div class="sp-block">' .
					$parser->recursiveTagParse( $block, $frame ) .
				'</div>';
		}, $blocks );

		$parser->getOutput()->addModuleStyles( 'ext.screenplay' );

		return
			'<div class="screenplay">' .
				implode( '', $blocks ) .
			'</div>';
	}
}
