<?php

use Laminas\Escaper\Escaper;
use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod\SocketPost;

defined( 'BASEPATH' ) or exit( 'No direct script access allowed.' );

// ------------------------------------------------------------------------
// pagination helper
// ------------------------------------------------------------------------

if ( ! function_exists( 'create_pagination' ) ) {
	/**
	 * The Pagination helper cuts out some of the bumf of normal pagination
	 *
	 * @param string $uri The current URI.
	 * @param int $total_rows The total of the items to paginate.
	 * @param int|null $limit How many to show at a time.
	 * @param int $uri_segment The current page.
	 *
	 * @return array The pagination array.
	 * @see Pagination::create_links()
	 */
	function create_pagination( $uri, $total_rows, $limit = null, int $uri_segment = 4 ) {
		$CI = &get_instance();
		$CI->load->library( 'pagination' );

		$current_page = $CI->uri->segment( $uri_segment, 0 );
		$suffix       = $CI->config->item( 'url_suffix' );

		$limit = $limit === null ? $CI->setting->records_per_page : $limit;

		// Initialize pagination
		$CI->pagination->initialize( [
				'suffix'             => $suffix,
				'base_url'           => ( ! $suffix ) ? rtrim( site_url( $uri ), $suffix ) : site_url( $uri ),
				'total_rows'         => $total_rows,
				'per_page'           => $limit,
				'uri_segment'        => $uri_segment,
				'use_page_numbers'   => true,
				'reuse_query_string' => true,
		] );

		$offset = $limit * ( $current_page - 1 );

		//avoid having a negative offset
		if ( $offset < 0 ) {
			$offset = 0;
		}

		return [
				'current_page' => $current_page,
				'per_page'     => $limit,
				'limit'        => $limit,
				'offset'       => $offset,
				'links'        => $CI->pagination->create_links()
		];
	}
}

// ------------------------------------------------------------------------
// text helper
// ------------------------------------------------------------------------

if ( ! function_exists( 'remove_empty_tags' ) ) {
	/**
	 * @param $html
	 *
	 * @return null|string|string[]
	 */
	function remove_empty_tags( $html ) {
		do {
			$tmp  = $html;
			$html = preg_replace( '#<([^ >]+)[^>]*>([[:space:]]|&nbsp;)*</\1>#', '', $html );
		} while ( $html !== $tmp );

		return $html;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'nl2p' ) ) {
	/**
	 * Replaces new lines with <p> HTML element.
	 *
	 * @param string $str The input string.
	 *
	 * @return string The HTML string.
	 */
	function nl2p( $str ) {
		return str_replace( '<p></p>', '', '<p>' . nl2br( preg_replace( '#(\r?\n){2,}#', '</p><p>', $str ) ) . '</p>' );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'br2nl' ) ) {
	/**
	 * @param string $buff
	 *
	 * @return mixed|string
	 */
	function br2nl( $buff = '' ) {
		$buff = preg_replace( '#<br[/\s]*>#si', "\n", $buff );
		$buff = trim( $buff );

		return $buff;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'html_excerpt' ) ) {
	/**
	 * https://developer.wordpress.org/reference/functions/wp_html_excerpt/
	 *
	 * @param $str
	 * @param $count
	 * @param null $more
	 *
	 * @return bool|string|string[]|null
	 */
	function html_excerpt( $str, $count, $more = null ) {
		if ( null === $more ) {
			$more = '';
		}

		$str     = strip_all_tags( $str, true );
		$excerpt = mb_substr( $str, 0, $count );

		// remove part of an entity at the end
		$excerpt = preg_replace( '/&[^;\s]{0,6}$/', '', $excerpt );
		if ( $str != $excerpt ) {
			$excerpt = trim( $excerpt ) . $more;
		}

		return $excerpt;
	}
}

//-------------------------------------------------------------

if ( ! function_exists( 'w_url_title' ) ) {
	/**
	 * @param string $str
	 * @param string $separator
	 * @param bool $lowercase
	 *
	 * @return string
	 */
	function w_url_title( string $str, string $separator = '-', bool $lowercase = true ): string {
		return url_title( remove_accents( $str ), $separator, $lowercase );
	}
}

//-------------------------------------------------------------

/**
 * @param $url
 *
 * @return bool
 */
function is_image( $url ) {

	$headers = @get_headers( $url, 1 ); // @ to suppress errors. Remove when debugging.
	if ( isset( $headers['Content-Type'] ) ) {
		if ( strpos( $headers['Content-Type'], 'image/' ) === false ) {
			return false;
		} else {
			return true;
		}
	}

	return false;
}

//-------------------------------------------------------------

if ( ! function_exists( 'strip_empty_tags' ) ) {
	/**
	 * @param $html
	 *
	 * @return array|string|string[]|null
	 */
	function strip_empty_tags( $html ) {
		$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";

		return preg_replace( $pattern, '', $html );
	}
}

//-------------------------------------------------------------

if ( ! function_exists( 'strip_tags_content' ) ) {
	/**
	 * @param $text
	 * @param string $tags
	 * @param false $invert
	 *
	 * @return array|mixed|string|string[]|null
	 */
	function strip_tags_content( $text, $tags = '', $invert = false ) {
		preg_match_all( '/<(.+?)[\s]*\/?[\s]*>/si', trim( $tags ), $tags );
		$tags = array_unique( (array) $tags[1] );

		if ( is_array( $tags ) and count( $tags ) > 0 ) {
			if ( $invert == false ) {
				return preg_replace( '@<(?!(?:' . implode( '|', $tags ) . ')\b)(\w+)\b.*?>.*?</\1>@si', '', $text );
			} else {
				return preg_replace( '@<(' . implode( '|', $tags ) . ')\b.*?>.*?</\1>@si', '', $text );
			}
		} elseif ( $invert == false ) {
			return preg_replace( '@<(\w+)\b.*?>.*?</\1>@si', '', $text );
		}

		return $text;
	}
}

//-------------------------------------------------------------

if ( ! function_exists( 'remove_accents' ) ) {
	/**
	 * @param $string
	 * @param null $locale
	 *
	 * @return array|mixed|string|string[]
	 */
	function remove_accents( $string, $locale = null ) {
		if ( ! preg_match( '/[\x80-\xff]/', $string ) ) {
			return $string;
		}

		if ( seems_utf8( $string ) ) {
			$chars = array(
				// Decompositions for Latin-1 Supplement.
					'ª' => 'a',
					'º' => 'o',
					'À' => 'A',
					'Á' => 'A',
					'Â' => 'A',
					'Ã' => 'A',
					'Ä' => 'A',
					'Å' => 'A',
					'Æ' => 'AE',
					'Ç' => 'C',
					'È' => 'E',
					'É' => 'E',
					'Ê' => 'E',
					'Ë' => 'E',
					'Ì' => 'I',
					'Í' => 'I',
					'Î' => 'I',
					'Ï' => 'I',
					'Ð' => 'D',
					'Ñ' => 'N',
					'Ò' => 'O',
					'Ó' => 'O',
					'Ô' => 'O',
					'Õ' => 'O',
					'Ö' => 'O',
					'Ù' => 'U',
					'Ú' => 'U',
					'Û' => 'U',
					'Ü' => 'U',
					'Ý' => 'Y',
					'Þ' => 'TH',
					'ß' => 's',
					'à' => 'a',
					'á' => 'a',
					'â' => 'a',
					'ã' => 'a',
					'ä' => 'a',
					'å' => 'a',
					'æ' => 'ae',
					'ç' => 'c',
					'è' => 'e',
					'é' => 'e',
					'ê' => 'e',
					'ë' => 'e',
					'ì' => 'i',
					'í' => 'i',
					'î' => 'i',
					'ï' => 'i',
					'ð' => 'd',
					'ñ' => 'n',
					'ò' => 'o',
					'ó' => 'o',
					'ô' => 'o',
					'õ' => 'o',
					'ö' => 'o',
					'ø' => 'o',
					'ù' => 'u',
					'ú' => 'u',
					'û' => 'u',
					'ü' => 'u',
					'ý' => 'y',
					'þ' => 'th',
					'ÿ' => 'y',
					'Ø' => 'O',
				// Decompositions for Latin Extended-A.
					'Ā' => 'A',
					'ā' => 'a',
					'Ă' => 'A',
					'ă' => 'a',
					'Ą' => 'A',
					'ą' => 'a',
					'Ć' => 'C',
					'ć' => 'c',
					'Ĉ' => 'C',
					'ĉ' => 'c',
					'Ċ' => 'C',
					'ċ' => 'c',
					'Č' => 'C',
					'č' => 'c',
					'Ď' => 'D',
					'ď' => 'd',
					'Đ' => 'D',
					'đ' => 'd',
					'Ē' => 'E',
					'ē' => 'e',
					'Ĕ' => 'E',
					'ĕ' => 'e',
					'Ė' => 'E',
					'ė' => 'e',
					'Ę' => 'E',
					'ę' => 'e',
					'Ě' => 'E',
					'ě' => 'e',
					'Ĝ' => 'G',
					'ĝ' => 'g',
					'Ğ' => 'G',
					'ğ' => 'g',
					'Ġ' => 'G',
					'ġ' => 'g',
					'Ģ' => 'G',
					'ģ' => 'g',
					'Ĥ' => 'H',
					'ĥ' => 'h',
					'Ħ' => 'H',
					'ħ' => 'h',
					'Ĩ' => 'I',
					'ĩ' => 'i',
					'Ī' => 'I',
					'ī' => 'i',
					'Ĭ' => 'I',
					'ĭ' => 'i',
					'Į' => 'I',
					'į' => 'i',
					'İ' => 'I',
					'ı' => 'i',
					'Ĳ' => 'IJ',
					'ĳ' => 'ij',
					'Ĵ' => 'J',
					'ĵ' => 'j',
					'Ķ' => 'K',
					'ķ' => 'k',
					'ĸ' => 'k',
					'Ĺ' => 'L',
					'ĺ' => 'l',
					'Ļ' => 'L',
					'ļ' => 'l',
					'Ľ' => 'L',
					'ľ' => 'l',
					'Ŀ' => 'L',
					'ŀ' => 'l',
					'Ł' => 'L',
					'ł' => 'l',
					'Ń' => 'N',
					'ń' => 'n',
					'Ņ' => 'N',
					'ņ' => 'n',
					'Ň' => 'N',
					'ň' => 'n',
					'ŉ' => 'n',
					'Ŋ' => 'N',
					'ŋ' => 'n',
					'Ō' => 'O',
					'ō' => 'o',
					'Ŏ' => 'O',
					'ŏ' => 'o',
					'Ő' => 'O',
					'ő' => 'o',
					'Œ' => 'OE',
					'œ' => 'oe',
					'Ŕ' => 'R',
					'ŕ' => 'r',
					'Ŗ' => 'R',
					'ŗ' => 'r',
					'Ř' => 'R',
					'ř' => 'r',
					'Ś' => 'S',
					'ś' => 's',
					'Ŝ' => 'S',
					'ŝ' => 's',
					'Ş' => 'S',
					'ş' => 's',
					'Š' => 'S',
					'š' => 's',
					'Ţ' => 'T',
					'ţ' => 't',
					'Ť' => 'T',
					'ť' => 't',
					'Ŧ' => 'T',
					'ŧ' => 't',
					'Ũ' => 'U',
					'ũ' => 'u',
					'Ū' => 'U',
					'ū' => 'u',
					'Ŭ' => 'U',
					'ŭ' => 'u',
					'Ů' => 'U',
					'ů' => 'u',
					'Ű' => 'U',
					'ű' => 'u',
					'Ų' => 'U',
					'ų' => 'u',
					'Ŵ' => 'W',
					'ŵ' => 'w',
					'Ŷ' => 'Y',
					'ŷ' => 'y',
					'Ÿ' => 'Y',
					'Ź' => 'Z',
					'ź' => 'z',
					'Ż' => 'Z',
					'ż' => 'z',
					'Ž' => 'Z',
					'ž' => 'z',
					'ſ' => 's',
				// Decompositions for Latin Extended-B.
					'Ș' => 'S',
					'ș' => 's',
					'Ț' => 'T',
					'ț' => 't',
				// Euro sign.
					'€' => 'E',
				// GBP (Pound) sign.
					'£' => '',
				// Vowels with diacritic (Vietnamese).
				// Unmarked.
					'Ơ' => 'O',
					'ơ' => 'o',
					'Ư' => 'U',
					'ư' => 'u',
				// Grave accent.
					'Ầ' => 'A',
					'ầ' => 'a',
					'Ằ' => 'A',
					'ằ' => 'a',
					'Ề' => 'E',
					'ề' => 'e',
					'Ồ' => 'O',
					'ồ' => 'o',
					'Ờ' => 'O',
					'ờ' => 'o',
					'Ừ' => 'U',
					'ừ' => 'u',
					'Ỳ' => 'Y',
					'ỳ' => 'y',
				// Hook.
					'Ả' => 'A',
					'ả' => 'a',
					'Ẩ' => 'A',
					'ẩ' => 'a',
					'Ẳ' => 'A',
					'ẳ' => 'a',
					'Ẻ' => 'E',
					'ẻ' => 'e',
					'Ể' => 'E',
					'ể' => 'e',
					'Ỉ' => 'I',
					'ỉ' => 'i',
					'Ỏ' => 'O',
					'ỏ' => 'o',
					'Ổ' => 'O',
					'ổ' => 'o',
					'Ở' => 'O',
					'ở' => 'o',
					'Ủ' => 'U',
					'ủ' => 'u',
					'Ử' => 'U',
					'ử' => 'u',
					'Ỷ' => 'Y',
					'ỷ' => 'y',
				// Tilde.
					'Ẫ' => 'A',
					'ẫ' => 'a',
					'Ẵ' => 'A',
					'ẵ' => 'a',
					'Ẽ' => 'E',
					'ẽ' => 'e',
					'Ễ' => 'E',
					'ễ' => 'e',
					'Ỗ' => 'O',
					'ỗ' => 'o',
					'Ỡ' => 'O',
					'ỡ' => 'o',
					'Ữ' => 'U',
					'ữ' => 'u',
					'Ỹ' => 'Y',
					'ỹ' => 'y',
				// Acute accent.
					'Ấ' => 'A',
					'ấ' => 'a',
					'Ắ' => 'A',
					'ắ' => 'a',
					'Ế' => 'E',
					'ế' => 'e',
					'Ố' => 'O',
					'ố' => 'o',
					'Ớ' => 'O',
					'ớ' => 'o',
					'Ứ' => 'U',
					'ứ' => 'u',
				// Dot below.
					'Ạ' => 'A',
					'ạ' => 'a',
					'Ậ' => 'A',
					'ậ' => 'a',
					'Ặ' => 'A',
					'ặ' => 'a',
					'Ẹ' => 'E',
					'ẹ' => 'e',
					'Ệ' => 'E',
					'ệ' => 'e',
					'Ị' => 'I',
					'ị' => 'i',
					'Ọ' => 'O',
					'ọ' => 'o',
					'Ộ' => 'O',
					'ộ' => 'o',
					'Ợ' => 'O',
					'ợ' => 'o',
					'Ụ' => 'U',
					'ụ' => 'u',
					'Ự' => 'U',
					'ự' => 'u',
					'Ỵ' => 'Y',
					'ỵ' => 'y',
				// Vowels with diacritic (Chinese, Hanyu Pinyin).
					'ɑ' => 'a',
				// Macron.
					'Ǖ' => 'U',
					'ǖ' => 'u',
				// Acute accent.
					'Ǘ' => 'U',
					'ǘ' => 'u',
				// Caron.
					'Ǎ' => 'A',
					'ǎ' => 'a',
					'Ǐ' => 'I',
					'ǐ' => 'i',
					'Ǒ' => 'O',
					'ǒ' => 'o',
					'Ǔ' => 'U',
					'ǔ' => 'u',
					'Ǚ' => 'U',
					'ǚ' => 'u',
				// Grave accent.
					'Ǜ' => 'U',
					'ǜ' => 'u',
			);

			if ( in_array( $locale, array( 'de_DE', 'de_DE_formal', 'de_CH', 'de_CH_informal', 'de_AT' ), true ) ) {
				$chars['Ä'] = 'Ae';
				$chars['ä'] = 'ae';
				$chars['Ö'] = 'Oe';
				$chars['ö'] = 'oe';
				$chars['Ü'] = 'Ue';
				$chars['ü'] = 'ue';
				$chars['ß'] = 'ss';
			} elseif ( 'da_DK' === $locale ) {
				$chars['Æ'] = 'Ae';
				$chars['æ'] = 'ae';
				$chars['Ø'] = 'Oe';
				$chars['ø'] = 'oe';
				$chars['Å'] = 'Aa';
				$chars['å'] = 'aa';
			} elseif ( 'ca' === $locale ) {
				$chars['l·l'] = 'll';
			} elseif ( 'sr_RS' === $locale || 'bs_BA' === $locale ) {
				$chars['Đ'] = 'DJ';
				$chars['đ'] = 'dj';
			}

			$string = strtr( $string, $chars );
		} else {
			$chars = array();
			// Assume ISO-8859-1 if not UTF-8.
			$chars['in'] = "\x80\x83\x8a\x8e\x9a\x9e"
						   . "\x9f\xa2\xa5\xb5\xc0\xc1\xc2"
						   . "\xc3\xc4\xc5\xc7\xc8\xc9\xca"
						   . "\xcb\xcc\xcd\xce\xcf\xd1\xd2"
						   . "\xd3\xd4\xd5\xd6\xd8\xd9\xda"
						   . "\xdb\xdc\xdd\xe0\xe1\xe2\xe3"
						   . "\xe4\xe5\xe7\xe8\xe9\xea\xeb"
						   . "\xec\xed\xee\xef\xf1\xf2\xf3"
						   . "\xf4\xf5\xf6\xf8\xf9\xfa\xfb"
						   . "\xfc\xfd\xff";

			$chars['out'] = 'EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy';

			$string              = strtr( $string, $chars['in'], $chars['out'] );
			$double_chars        = array();
			$double_chars['in']  = array( "\x8c", "\x9c", "\xc6", "\xd0", "\xde", "\xdf", "\xe6", "\xf0", "\xfe" );
			$double_chars['out'] = array( 'OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th' );
			$string              = str_replace( $double_chars['in'], $double_chars['out'], $string );
		}

		return $string;
	}
}

//-------------------------------------------------------------

if ( ! function_exists( 'seems_utf8' ) ) {
	/**
	 * Checks to see if a string is utf8 encoded.
	 *
	 * NOTE: This function checks for 5-Byte sequences, UTF8
	 *       has Bytes Sequences with a maximum length of 4.
	 *
	 * @param string $str The string to be checked
	 *
	 * @return bool True if $str fits a UTF-8 model, false otherwise.
	 * @author bmorel at ssi dot fr (modified)
	 *
	 */
	function seems_utf8( $str ) {
		mbstring_binary_safe_encoding();
		$length = strlen( $str );
		mbstring_binary_safe_encoding( true );
		for ( $i = 0; $i < $length; $i ++ ) {
			$c = ord( $str[ $i ] );
			if ( $c < 0x80 ) {
				$n = 0; // 0bbbbbbb
			} elseif ( ( $c & 0xE0 ) == 0xC0 ) {
				$n = 1; // 110bbbbb
			} elseif ( ( $c & 0xF0 ) == 0xE0 ) {
				$n = 2; // 1110bbbb
			} elseif ( ( $c & 0xF8 ) == 0xF0 ) {
				$n = 3; // 11110bbb
			} elseif ( ( $c & 0xFC ) == 0xF8 ) {
				$n = 4; // 111110bb
			} elseif ( ( $c & 0xFE ) == 0xFC ) {
				$n = 5; // 1111110b
			} else {
				return false; // Does not match any model.
			}
			for ( $j = 0; $j < $n; $j ++ ) { // n bytes matching 10bbbbbb follow ?
				if ( ( ++ $i == $length ) || ( ( ord( $str[ $i ] ) & 0xC0 ) != 0x80 ) ) {
					return false;
				}
			}
		}

		return true;
	}
}

//-------------------------------------------------------------

if ( ! function_exists( 'mbstring_binary_safe_encoding' ) ) {
	/**
	 * Set the mbstring internal encoding to a binary safe encoding when func_overload
	 * is enabled.
	 *
	 * When mbstring.func_overload is in use for multi-byte encodings, the results from
	 * strlen() and similar functions respect the utf8 characters, causing binary data
	 * to return incorrect lengths.
	 *
	 * This function overrides the mbstring encoding to a binary-safe encoding, and
	 * resets it to the users expected encoding afterwards through the
	 * `reset_mbstring_encoding` function.
	 *
	 * It is safe to recursively call this function, however each
	 * `mbstring_binary_safe_encoding()` call must be followed up with an equal number
	 * of `reset_mbstring_encoding()` calls.
	 *
	 * @param bool $reset Optional. Whether to reset the encoding back to a previously-set encoding.
	 *                    Default false.
	 *
	 *
	 *
	 */
	function mbstring_binary_safe_encoding( $reset = false ) {
		static $encodings = array();
		static $overloaded = null;

		if ( is_null( $overloaded ) ) {
			$overloaded = function_exists( 'mb_internal_encoding' ) && ( ini_get( 'mbstring.func_overload' ) & 2 ); // phpcs:ignore PHPCompatibility.IniDirectives.RemovedIniDirectives.mbstring_func_overloadDeprecated
		}

		if ( false === $overloaded ) {
			return;
		}

		if ( ! $reset ) {
			$encoding = mb_internal_encoding();
			array_push( $encodings, $encoding );
			mb_internal_encoding( 'ISO-8859-1' );
		}

		if ( $reset && $encodings ) {
			$encoding = array_pop( $encodings );
			mb_internal_encoding( $encoding );
		}
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'strip_all_tags' ) ) {
	/**
	 * https://developer.wordpress.org/reference/functions/wp_strip_all_tags/
	 *
	 * @param $string
	 * @param bool $remove_breaks
	 *
	 * @return string
	 */
	function strip_all_tags( $string, bool $remove_breaks = false ) {
		$string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
		$string = strip_tags( $string );

		if ( $remove_breaks ) {
			$string = preg_replace( '/[\r\n\t ]+/', ' ', $string );
		}

		return trim( $string );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'normalize_whitespace' ) ) {
	/**
	 * https://developer.wordpress.org/reference/functions/normalize_whitespace/
	 *
	 * @param $str
	 *
	 * @return mixed|string|string[]|null
	 */
	function normalize_whitespace( $str ) {
		$str = trim( $str );
		$str = str_replace( "\r", "\n", $str );
		$str = preg_replace( [ '/\n+/', '/[ \t]+/' ], [ "\n", ' ' ], $str );

		return $str;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'js_escape' ) ) {
	/**
	 * Normalize the string for JavaScript string value
	 *
	 * @param $text
	 *
	 * @return mixed|string|string[]|null
	 */
	function js_escape( $text ) {
		$safe_text = (string) $text;
		$safe_text = htmlspecialchars( $safe_text, ENT_COMPAT, config_item( 'charset' ), false );
		$safe_text = preg_replace( '/&#(x)?0*(?(1)27|39);?/i', "'", stripslashes( $safe_text ) );
		$safe_text = str_replace( "\r", '', $safe_text );
		$safe_text = str_replace( "\n", '\\n', addslashes( $safe_text ) );

		return $safe_text;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'escape_html' ) ) {
	/**
	 * https://docs.zendframework.com/zend-escaper/escaping-html/
	 *
	 * @param $text
	 *
	 * @return string
	 */
	function escape_html( $text ) {
		static $_escaper;
		if ( $_escaper === null ) {
			$_escaper[0] = new Escaper( strtolower( config_item( 'charset' ) ) );
		}

		return $_escaper[0]->escapeHtml( $text );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'escape_html_attr' ) ) {
	/**
	 * https://docs.zendframework.com/zend-escaper/escaping-html-attributes/
	 *
	 * @param $text
	 *
	 * @return string
	 */
	function escape_html_attr( $text ) {
		static $_escaper;
		if ( $_escaper === null ) {
			$_escaper[0] = new Escaper( strtolower( config_item( 'charset' ) ) );
		}

		return $_escaper[0]->escapeHtmlAttr( $text );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'escape_js' ) ) {
	/**
	 * https://docs.zendframework.com/zend-escaper/escaping-javascript/
	 *
	 * @param $text
	 *
	 * @return string
	 */
	function escape_js( $text ) {
		static $_escaper;
		if ( $_escaper === null ) {
			$_escaper[0] = new Escaper( strtolower( config_item( 'charset' ) ) );
		}

		return $_escaper[0]->escapeJs( $text );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'escape_css' ) ) {
	/**
	 * CSS escaping excludes only basic alphanumeric characters
	 * and escapes all other characters into valid CSS hexadecimal escapes.
	 * https://docs.zendframework.com/zend-escaper/escaping-css/
	 *
	 * @param $text
	 *
	 * @return string
	 */
	function escape_css( $text ) {
		static $_escaper;
		if ( $_escaper === null ) {
			$_escaper[0] = new Escaper( strtolower( config_item( 'charset' ) ) );
		}

		return $_escaper[0]->escapeCss( $text );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'escape_url' ) ) {
	/**
	 * URL escaping applies to data being inserted into a URL
	 * and not to the whole URL itself.
	 * https://docs.zendframework.com/zend-escaper/escaping-url/
	 *
	 * @param $text
	 *
	 * @return string
	 */
	function escape_url( $text ) {
		static $_escaper;
		if ( $_escaper === null ) {
			$_escaper[0] = new Escaper( strtolower( config_item( 'charset' ) ) );
		}

		return $_escaper[0]->escapeUrl( $text );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'process_data_jmr1' ) ) {

	// Set PCRE recursion limit to sane value = STACKSIZE / 500 (256KB stack. Win32 Apache or  8MB stack. *nix)
	ini_set( 'pcre.recursion_limit', ( strtolower( substr( PHP_OS, 0, 3 ) ) === 'win' ? '524' : '16777' ) );

	/**
	 * Process data JMR1
	 *
	 * Minifying final HTML output
	 *
	 * @param string $text The HTML output
	 *
	 * @return string  The HTML without white spaces or the input text if its is too big to your SO proccess.
	 * @author Alan Moore, ridgerunner
	 * @author Marcos Coelho <marcos@marcoscoelho.com>
	 * @see http://stackoverflow.com/q/5312349
	 */
	function process_data_jmr1( $text = '' ) {
		$re = '%                            # Collapse whitespace everywhere but in blacklisted elements.
        (?>                                 # Match all whitespans other than single space.
          [^\S]\s*                          # Either one [\t\r\n\f\v] and zero or more ws,
          |\s{2,}                           # or two or more consecutive-any-whitespace.
        )				                    # Note: The remaining regex consumes no text at all...
        (?=                                 # Ensure we are not in a blacklist tag.
          [^<]*+                            # Either zero or more non-"<" {normal*}
          (?:                               # Begin {(special normal*)*} construct
            <                               # or a < starting a non-blacklist tag.
            (?!/?(?:textarea|pre|script)\b)
            [^<]*+                          # more non-"<" {normal*}
          )*+                               # Finish "unrolling-the-loop"
          (?:                               # Begin alternation group.
            <                               # Either a blacklist start tag.
            (?>textarea|pre|script)\b
            |\z                             # or end of file.
          )                                 # End alternation group.
        )                                   # If we made it here, we are not in a blacklist tag.
        %Six';

		if ( ( $data = preg_replace( $re, ' ', $text ) ) === null ) {
			log_message( 'error', 'PCRE Error! Output of the page "' . uri_string() . '" is too big.' );

			return $text;
		}

		return $data;
	}
}

// -------------------------------------------------------------
// view helper
// -------------------------------------------------------------

if ( ! function_exists( '_post' ) ) {
	/**
	 * @param string $name
	 * @param string $default
	 * @param bool $_escape
	 *
	 * @return mixed|string
	 */
	function _post( $name, $default = '', bool $_escape = true ) {
		if ( ! isset( $_POST[ $name ] ) ) {
			return $default;
		}

		if ( $_escape == true ) {
			return escape_html( ci()->input->post( $name, true ) );
		}

		return ci()->input->post( $name, true );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( '_get' ) ) {
	/**
	 * @param $name
	 * @param string $default
	 *
	 * @return mixed|string
	 */
	function _get( $name, $default = '', bool $_escape = true ) {
		if ( ! isset( $_GET[ $name ] ) ) {
			return $default;
		}

		if ( $_escape == true ) {
			return escape_html( ci()->input->get( $name, true ) );
		}

		return ci()->input->get( $name, true );
	}
}

// ------------------------------------------------------------------------
// string helper
// ------------------------------------------------------------------------

if ( ! function_exists( 'trim_s' ) ) {
	/**
	 * @param string $str
	 * @param string $space
	 *
	 * @return string|string[]|null
	 */
	function trim_s( $str, $space = '' ) {
		$str = (string) $str;
		$str = trim( $str );

		return preg_replace( '/\s+/', $space, $str );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'uuid' ) ) {
	/**
	 * Universally Unique Identifier
	 *
	 * A UUID is a 16-octet (128-bit) number.
	 * In its canonical form, a UUID is represented by 32 hexadecimal digits, displayed in five groups separated by hyphens,
	 * in the form 8-4-4-4-12 for a total of 36 characters (32 alphanumeric characters and four hyphens).
	 *
	 * @return string
	 */
	function uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
				mt_rand( 0, 0xffff ),
				mt_rand( 0, 0x0C2f ) | 0x4000,
				mt_rand( 0, 0x3fff ) | 0x8000,
				mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
		);
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'sanitize_html_class' ) ) {
	/**
	 * https://developer.wordpress.org/reference/functions/sanitize_html_class/
	 *
	 * @param $class
	 * @param string $fallback
	 *
	 * @return string|string[]|null
	 */
	function sanitize_html_class( $class, $fallback = '' ) {
		//Strip out any % encoded octets
		$sanitized = preg_replace( '|%[a-fA-F0-9][a-fA-F0-9]|', '', $class );

		//Limit to A-Z,a-z,0-9,_,-
		$sanitized = preg_replace( '/[^A-Za-z0-9_-]/', '', $sanitized );

		if ( '' == $sanitized && $fallback ) {
			return sanitize_html_class( $fallback );
		}

		return $sanitized;
	}
}

// -------------------------------------------------------------
// array helper
// -------------------------------------------------------------

if ( ! function_exists( 'array_object_merge' ) ) {
	/**
	 * Merge an array or an object into another object
	 *
	 * @param object $object The object to act as host for the merge.
	 * @param object|array $array The object or the array to merge.
	 */
	function array_object_merge( &$object, $array ) {
		// Make sure we are dealing with an array.
		is_array( $array ) or $array = get_object_vars( $array );
		foreach ( $array as $key => $value ) {
			$object->{$key} = $value;
		}
	}

}

// -------------------------------------------------------------
// directory helper
// -------------------------------------------------------------

if ( ! function_exists( 'recurse_copy' ) ) {
	/**
	 * @param $src
	 * @param $dst
	 */
	function recurse_copy( $src, $dst ) {
		$dir = opendir( $src );
		if ( ! file_exists( $dst ) ) {
			mkdir( $dst, 0755, true );
		}

		while ( false !== ( $file = readdir( $dir ) ) ) {
			if ( ( $file != '.' ) && ( $file != '..' ) ) {
				if ( is_dir( $src . '/' . $file ) ) {
					recurse_copy( $src . '/' . $file, $dst . '/' . $file );
				} else {
					copy( $src . '/' . $file, $dst . '/' . $file );
				}
			}
		}

		closedir( $dir );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'create_directory' ) ) {
	/**
	 * recursively create a long directory path
	 *
	 * @param $path
	 *
	 * @return bool
	 */
	function create_directory( $path ) {
		if ( is_dir( $path ) ) {
			return true;
		}

		$prev_path = substr( $path, 0, strrpos( $path, '/', - 2 ) + 1 );
		$return    = create_directory( $prev_path );

		return ( $return && is_really_writable( $prev_path ) ) ? mkdir( $path ) : false;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'normalize_path' ) ) {
	/**
	 * Normalize the given path. On Windows servers backslash will be replaced
	 * with slash. Removes unnecessary double slashes and double dots. Removes
	 * last slash if it exists.
	 *
	 * Examples:
	 * path::normalize("C:\\any\\path\\") returns "C:/any/path"
	 * path::normalize("/your/path/..//home/") returns "/your/home"
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	function normalize_path( $path ) {
		// Backslash to slash convert
		if ( strtoupper( substr( PHP_OS, 0, 3 ) ) == "WIN" ) {
			$path = preg_replace( '/([^\\\])\\\+([^\\\])/s', "$1/$2", $path );
			if ( substr( $path, - 1 ) == "\\" ) {
				$path = substr( $path, 0, - 1 );
			}
			if ( substr( $path, 0, 1 ) == "\\" ) {
				$path = "/" . substr( $path, 1 );
			}
		}

		$path = preg_replace( '/\/+/s', "/", $path );

		$path = "/$path";
		if ( substr( $path, - 1 ) != "/" ) {
			$path .= "/";
		}

		$expr = '/\/([^\/]{1}|[^\.\/]{2}|[^\/]{3,})\/\.\.\//s';
		while ( preg_match( $expr, $path ) ) {
			$path = preg_replace( $expr, "/", $path );
		}

		$path = substr( $path, 0, - 1 );
		$path = substr( $path, 1 );

		return $path;
	}
}

// -------------------------------------------------------------
// file helper
// -------------------------------------------------------------

if ( ! function_exists( 'pixel_img' ) ) {
	/**
	 * @param string $img_url
	 *
	 * @return string
	 */
	function pixel_img( $img_url = '' ) {
		if ( file_exists( $img_url ) ) {
			return $img_url;
		}

		return site_url( '/' ) . "uploads/pixel.png";
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'valid_image' ) ) {
	/**
	 * @param $src_file_name
	 * @param array $supported_ext_image
	 *
	 * @return bool
	 */
	function valid_image( $src_file_name, $supported_ext_image = [] ) {
		if ( ! is_array( $supported_ext_image ) or empty( $supported_ext_image ) ) {
			$supported_ext_image = [
					'gif',
					'jpg',
					'jpeg',
					'png'
			];
		}

		$ext = get_file_extension( $src_file_name, false );
		if ( in_array( $ext, $supported_ext_image ) ) {
			return true;
		}

		return false;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'get_file_extension' ) ) {
	/**
	 * @param $filename
	 * @param bool $include_dot
	 *
	 * @return string
	 */
	function get_file_extension( $filename, bool $include_dot = true ) {
		$dot = '';
		if ( $include_dot == true ) {
			$dot = '.';
		}

		if ( is_php( '5.4' ) ) {
			return $dot . strtolower( ( new SplFileInfo( $filename ) )->getExtension() );
		}

		return $dot . strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'standard_phone' ) ) {
	/**
	 * @param $phone
	 *
	 * @return string
	 */
	function standard_phone( $phone ) {
		return preg_replace( '/[^0-9]+/', '', $phone );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'strposa' ) ) {
	/**
	 * @param $haystack
	 * @param $needle
	 * @param int $offset
	 *
	 * @return bool
	 */
	function strposa( $haystack, $needle, int $offset = 0 ) {
		if ( ! is_array( $needle ) ) {
			$needle = [ $needle ];
		}

		foreach ( $needle as $query ) {
			if ( strpos( $haystack, $query, $offset ) !== false ) {
				return true;
			} // stop on first true result
		}

		return false;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'str_to_bool' ) ) {
	/**
	 * Converts various string bools to a true bool
	 *
	 * @param string $value
	 *
	 * @return bool
	 */
	function str_to_bool( $value = '' ) {
		return filter_var( $value, FILTER_VALIDATE_BOOLEAN );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'verified_phone' ) ) {
	/**
	 * @param $phone
	 *
	 * @return string
	 */
	function verified_phone( $phone ) {
		$preg = preg_replace( '/[^0-9]+/', '', $phone );

		return substr( $preg, - 9, 9 );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'compare_phone' ) ) {
	/**
	 * @param $dbphone
	 * @param $phone
	 *
	 * @return bool
	 */
	function compare_phone( $dbphone, $phone ) {
		$dbphone = preg_replace( '/[^0-9]+/', '', $dbphone );
		$phone   = preg_replace( '/[^0-9]+/', '', $phone );

		if ( strcmp( substr( $dbphone, - 9, 9 ), substr( $phone, - 9, 9 ) ) === 0 ) {
			return true;
		}

		return false;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'get_file_name' ) ) {
	/**
	 * @param $filename
	 * @param bool $include_ext
	 *
	 * @return string
	 */
	function get_file_name( $filename, bool $include_ext = false ) {
		if ( is_php( '5.4' ) ) {
			return $include_ext ? ( new SplFileInfo( $filename ) )->getFilename() : ( new SplFileInfo( $filename ) )->getBasename( get_file_extension( $filename ) );
		}

		return $include_ext ? pathinfo( $filename, PATHINFO_FILENAME ) . get_file_extension( $filename ) : pathinfo( $filename, PATHINFO_FILENAME );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'make_upload_file' ) ) {
	/**
	 * @param $new_path
	 * @param $new_file_name
	 * @param $tmp_file
	 *
	 * @return bool
	 */
	function make_upload_file( $new_path, $new_file_name, $tmp_file ) {
		if ( create_directory( $new_path ) ) {
			// we'll attempt to use copy() first. If that fails
			// we'll use move_uploaded_file().
			if ( ! @copy( $tmp_file, rtrim( $new_path, '/' ) . '/' . $new_file_name ) ) {
				if ( ! @move_uploaded_file( $tmp_file, rtrim( $new_path, '/' ) . '/' . $new_file_name ) ) {
					return false;
				}
			}

			return true;
		}

		return false;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'array_for_select' ) ) {
	/**
	 * @return array|bool
	 */
	function array_for_select() {
		$args   = func_get_args();
		$return = [];
		switch ( count( $args ) ) {
			case 3:
				foreach ( $args[0] as $itteration ):
					if ( is_object( $itteration ) ) {
						$itteration = (array) $itteration;
					}
					$return[ $itteration[ $args[1] ] ] = $itteration[ $args[2] ];
				endforeach;
				break;

			case 2:
				foreach ( $args[0] as $key => $itteration ):
					if ( is_object( $itteration ) ) {
						$itteration = (array) $itteration;
					}
					$return[ $key ] = $itteration[ $args[1] ];
				endforeach;
				break;

			case 1:
				foreach ( $args[0] as $itteration ):
					$return[ $itteration ] = $itteration;
				endforeach;
				break;

			default:
				return false;
		}

		return $return;
	}

}

// -------------------------------------------------------------
// inflector helper
// -------------------------------------------------------------

if ( ! function_exists( 'keywords' ) ) {
	/**
	 * Keywords
	 *
	 * Takes multiple words separated by spaces and changes them to keywords
	 * Makes sure the keywords are separated by a comma followed by a space.
	 *
	 * @param string $str The keywords as a string, separated by whitespace.
	 *
	 * @return string The list of keywords in a comma separated string form.
	 */
	function keywords( $str ) {
		return preg_replace( '/[\s]+/', ', ', trim( $str ) );
	}
}

// -------------------------------------------------------------
// recaptcha verify helper
// -------------------------------------------------------------

if ( ! function_exists( 'recaptcha_verify' ) ) {
	/**
	 * @param string $response
	 *
	 * @return bool
	 */
	function recaptcha_verify( $response = '' ) {
		$CI = &get_instance();
		$response or $response = $CI->input->post( 'g-recaptcha-response' );
		if ( $response ) {
			// Create an instance of the service using your secret
			$recaptcha = new ReCaptcha( $CI->setting->recaptcha_secretkey );
			if ( ! function_exists( 'file_get_contents' ) ) {
				// This makes use of fsockopen() instead.
				$recaptcha = new ReCaptcha( $CI->setting->recaptcha_secretkey, new SocketPost() );
			}

			// Make the call to verify the response and also pass the user's IP address
			$resp = $recaptcha->setExpectedHostname( $_SERVER['SERVER_NAME'] )->verify( $response, ip_address() );
			if ( $resp->isSuccess() ) {
				return true;
			}
		}

		return false;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'is_ajax_request' ) ) {
	/**
	 * @return mixed
	 */
	function is_ajax_request() {
		$CI = &get_instance();

		return $CI->input->is_ajax_request();
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( '__' ) ) {
	/**
	 * @param string $line
	 * @param string $for
	 * @param array $attributes
	 * @param string $extra
	 *
	 * @return string
	 */
	function __( $line = '', $for = '', array $attributes = [], $extra = "" ) {
		if ( substr( $line, 0, 5 ) == 'lang:' ) {
			$line = substr( $line, 5 );
		}

		$lang = lang( $line, $for, $attributes );
		if ( ! $lang ) {
			return $extra . $line . $extra;
		}

		return $lang;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'esc__' ) ) {
	/**
	 * @param string $line
	 * @param string $for
	 * @param array $attributes
	 * @param string $extra
	 *
	 * @return mixed
	 */
	function esc__( $line = '', $for = '', array $attributes = [], $extra = "" ) {
		return escape_html( __( $line, $for, $attributes, $extra ) );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'display_name' ) ) {
	/**
	 * @param $user
	 *
	 * @return mixed
	 */
	function display_name( $user ) {
		return $user->fullname ?: $user->phone ?: $user->email;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'redirect_get' ) ) {
	/**
	 * @param string $url
	 * @param string $redirect
	 *
	 * @return string
	 */
	function redirect_get( $url = '/', $redirect = 'redirect_to' ) {
		return '?' . $redirect . '=' . urlencode( $url );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'esc_attr_' ) ) {
	/**
	 * @param string $line
	 * @param string $for
	 * @param array $attributes
	 * @param string $extra
	 *
	 * @return mixed
	 */
	function esc_attr_( $line = '', $for = '', array $attributes = [], $extra = "" ) {
		return escape_html_attr( __( $line, $for, $attributes, $extra ) );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( '_e' ) ) {
	/**
	 * @param string $line
	 * @param string $for
	 * @param array $attributes
	 * @param string $extra
	 */
	function _e( $line = '', $for = '', array $attributes = [], $extra = "" ) {
		echo __( $line, $for, $attributes, $extra );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'esc_e' ) ) {
	/**
	 * @param string $line
	 * @param string $for
	 * @param array $attributes
	 * @param string $extra
	 */
	function esc_e( $line = '', $for = '', array $attributes = [], $extra = "" ) {
		echo esc__( $line, $for, $attributes, $extra );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'esc_attr_e' ) ) {
	/**
	 * @param string $line
	 * @param string $for
	 * @param array $attributes
	 * @param string $extra
	 */
	function esc_attr_e( $line = '', $for = '', array $attributes = [], $extra = "" ) {
		echo esc_attr_( $line, $for, $attributes, $extra );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( '_f' ) ) {
	/**
	 * @param $line
	 * @param array $variables
	 *
	 * @return mixed
	 */
	function _f( $line, array $variables = [] ) {
		return sprintf_lang( $line, $variables );
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists( 'sprintf_lang' ) ) {
	/**
	 * @param $line
	 * @param array $variables
	 *
	 * @return mixed
	 */
	function sprintf_lang( $line, array $variables = [] ) {
		is_array( $variables ) or $variables = [ $variables ];
		array_unshift( $variables, __( $line ) );

		return call_user_func_array( 'sprintf', $variables );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'asset_js' ) ) {
	/**
	 * @param $script
	 * @param bool $script_min
	 * @param string $group
	 */
	function asset_js( $script, bool $script_min = false, $group = 'global' ) {
		echo get_asset_js( $script, $script_min, $group );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'get_asset_js' ) ) {
	/**
	 * @param $script
	 * @param bool $script_min
	 * @param string $group
	 *
	 * @return string|null
	 */
	function get_asset_js( $script, bool $script_min = false, $group = 'global' ) {
		if ( ! class_exists( 'Asset' ) ) {
			return '';
		}

		Asset::js( $script, $script_min, $group );

		return Asset::render_js( $group );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'asset_css' ) ) {
	/**
	 * @param $sheet
	 * @param bool $sheet_min
	 * @param string $group
	 */
	function asset_css( $sheet, bool $sheet_min = false, $group = 'global' ) {
		echo get_asset_css( $sheet, $sheet_min, $group );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'get_asset_css' ) ) {
	/**
	 * @param $sheet
	 * @param bool $sheet_min
	 * @param string $group
	 *
	 * @return string
	 */
	function get_asset_css( $sheet, bool $sheet_min = false, $group = 'global' ) {
		if ( ! class_exists( 'Asset' ) ) {
			return '';
		}

		Asset::css( $sheet, $sheet_min, $group );

		return Asset::render_css( $group );
	}
}

// -------------------------------------------------------------

/**
 * @return bool
 */
function __return_true() {
	return true;
}

// -------------------------------------------------------------

/**
 * @return bool
 */
function __return_false() {
	return false;
}

// -------------------------------------------------------------

/**
 * @return int
 */
function __return_zero() {
	return 0;
}

// -------------------------------------------------------------

/**
 * @return array
 */
function __return_empty_array() {
	return [];
}

// -------------------------------------------------------------

/**
 * @return null
 */
function __return_null() {
	return null;
}

// -------------------------------------------------------------

/**
 * @return string
 */
function __return_empty_string() {
	return '';
}

// -------------------------------------------------------------
// -------------------------------------------------------------
// -------------------------------------------------------------

/**
 * @param $ID
 * @param string $class
 */
function vote_action( $ID, $class = '' ) {
	$CI =& get_instance();

	$post_id = $ID;
	$_query  = $CI->db->where( 'post_id', $post_id )->get( 'hd_post_vote' );
	$results = $_query->result();
	$total   = 0;
	$values  = 0;
	foreach ( $results as $item ) :
		if ( $item->vote_value ) :
			$total  = $total + 1;
			$values = $values + $item->vote_value;
		endif;
	endforeach;

	if ( $total == 0 ) {
		$x = 0;
	} else {
		$x = $values / $total;
	}
	$x_format = @number_format( $x, 1 );
	?>
	<div class="rating--inner <?= $class ?>" data-id="<?= $ID ?>">
		<ul>
			<?php for ( $i = 5; $i > 0; $i -- ) :
				$_tmp = round( $x );
				?>
				<li<?php if ( $_tmp == $i ) {
					echo ' class="active"';
				} ?> data-star="<?= $i ?>"><i class="fal fa-star"></i></li>
			<?php endfor; ?>
		</ul>
		<div class="votes">Kết quả <?= $x_format ?>/5 (<?= $total ?> đánh giá)</div>
	</div>
	<?php
}

// -------------------------------------------------------------

/**
 * @param $ID
 * @param string $class
 */
function vote_display( $ID, $class = '' ) {

	$CI =& get_instance();

	$post_id = $ID;
	$_query  = $CI->db->where( 'post_id', $post_id )->get( 'hd_post_vote' );
	$results = $_query->result();
	$total   = 0;
	$values  = 0;
	foreach ( $results as $item ) :
		if ( $item->vote_value ) :
			$total  = $total + 1;
			$values = $values + $item->vote_value;
		endif;
	endforeach;

	if ( $total == 0 ) {
		$x = 0;
	} else {
		$x = $values / $total;
	}
	$x_format = @number_format( $values / $total, 1 );

	?>
	<div class="rating--inner selected <?= $class ?>" data-id="<?= $ID ?>">
		<div class="ul-rating">
			<ul>
				<?php for ( $i = 1; $i < 6; $i ++ ) : ?>
					<li data-star="<?= $i ?>"><i class="fal fa-star"></i></li>
				<?php endfor; ?>
			</ul>
			<ul class="rated" style="width: <?php echo ( ( $x * 100 ) / 5 ) . '%'; ?>">
				<?php for ( $i = 1; $i < 6; $i ++ ) : ?>
					<li data-star="<?= $i ?>"><i class="fas fa-star"></i></li>
				<?php endfor; ?>
			</ul>
		</div>
		<div class="votes">Kết quả <?= $x_format ?>/5 (<?= $total ?> đánh giá)</div>
	</div>
	<?php
}
