<?php defined('BASEPATH') OR exit('No direct script access allowed');

// --------------------------------------------------

/**
 * @param $var
 */
function debug_r( $var ) {
	echo "<pre>";
	var_dump( $var );
	echo "</pre>";
}

// ---------------------------------------------------

/**
 * @param string $input
 * @param bool $trace
 * @param bool $halt
 */
function debugger( $input, $trace = false, $halt = false ) {
	ob_start();

	echo "<br>----- DEBUG DUMP -----";
	echo "<pre>";
	var_dump( $input );
	echo "</pre>";

	if ( $trace ) {
		if ( is_php( '5.3.6' ) ) {
			$debug = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
		} else {
			$debug = debug_backtrace( false );
		}

		echo "<br>-----STACK TRACE-----";
		echo "<pre>";
		var_dump( $debug );
		echo "</pre>";
	}

	echo "</pre>";
	echo "---------------------------<br>";

	$ret = ob_get_contents();
	ob_end_clean();

	echo $ret;

	if ( $halt == true ) {
		exit();
	}
}

/**
 * Debug Helper
 *
 * Outputs the given variable with formatting and location
 */
function dump()
{
	list($callee) = debug_backtrace();
	$arguments = $callee['args'];
	$total_arguments = count($arguments);

	echo '<fieldset style="background: #fefefe !important; border:2px red solid; padding:5px">';
	echo '<legend style="background:lightgrey; padding:5px;">' . $callee['file'] . ' @ line: ' . $callee['line'] . '</legend><pre>';

	$i = 0;
	foreach ($arguments as $argument)
	{
		if (is_array($argument))
		{
			array_walk_recursive($argument, function (&$v) {
				if (is_string($v))
				{
					$v = html_escape($v);
				}
			});
		}
		else if ( is_string($argument))
		{
			$argument = html_escape($argument);
		}

		echo '<br/><strong>Debug #' . (++ $i) . ' of ' . $total_arguments . '</strong>: ';
		var_dump($argument);
	}

	echo '</pre>';
	echo '</fieldset>';
}
