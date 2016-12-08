<?php

/**
 * Fend of the Script Kiddies.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Fresh_Core_Autoload_Manager
 */
class PropLog_Autoload_Manager {

	const PLUGIN_SLUG = 'proplog';

	/**
	 * Determines the server path for the plugin's 'includes'
	 * folder based the location of the current file.
	 *
	 * @return string
	 */
	private static function determine_file_path() {
		$folder = realpath( plugin_dir_path( __FILE__ ) );
		$folder = str_replace( self::PLUGIN_SLUG . '/config', self::PLUGIN_SLUG, $folder );
		return $folder . DIRECTORY_SEPARATOR . 'includes';
	}

	/**
	 * Determines the path and filename of the required
	 * class based on its Name and Namespace.
	 *
	 * @param string $class_name    Class path referenced by Namespace.
	 * @return string               The name of the class file.
	 */
	private static function determine_class_name( $class_name ) {
		$class_name = str_replace( 'PropLog', '', $class_name );
		$class_name = str_replace( '_', '-', $class_name );
		$class_name = strtolower( $class_name );
		return $class_name . '.php';
	}

	/**
	 * Ensures the path to be required does not use anny double slashes.
	 * Replaces any form of slashes with the system directory separator.
	 *
	 * @param string $path      Current file path.
	 * @return string
	 */
	private static function validate_path( $path ) {
		return str_replace( array( '\\', '//' ), DIRECTORY_SEPARATOR, $path );
	}

	public static function determine_file_path_from_namespaced_class( $class_name ) {
		$full_path = self::determine_file_path() . self::determine_class_name( $class_name );
		return self::validate_path( $full_path );
	}

	/**
	 * Locates and autoloads the
	 * class files related to this project.
	 *
	 * @param string $class_name    The passed Class Name including Namespace.
	 */
	public static function autoload_function( $class_name ) {

		if ( false === strpos( $class_name, 'PropLog' ) ) {
			return;
		}

		$full_path = self::determine_file_path_from_namespaced_class( $class_name );

		if ( file_exists( $full_path ) ) {
			require_once( $full_path );
		} else {
			sja_debug( 'Failed: ' . $full_path );
		}
	}
}

spl_autoload_register( array( 'PropLog_Autoload_Manager', 'autoload_function' ) );