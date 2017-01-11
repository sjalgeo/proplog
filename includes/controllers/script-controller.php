<?php

namespace PropLog\Controllers;

class Script_Controller {

	private $root_file;
	private $handle;
	private $script;

	function __construct( $root_file ) {
		$this->root_file = $root_file;
		$this->script = plugins_url( 'scripts/app.js', $this->root_file );
		$this->handle = 'freshpress-admin';
	}

	public function run() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
//		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
	}

	public function register_scripts( $hook ) {

//		if ( ! preg_match( '/^freshpress/', $hook ) AND 'toplevel_page_freshpress-settings' !== $hook ) {
//			return;
//		}

		wp_register_script( $this->handle, $this->script, null, null, false );
	}

	public function enqueue_admin_scripts( $hook ) {

//		if ( ! preg_match( '/^freshpress/', $hook ) AND 'toplevel_page_freshpress-settings' !== $hook ) {
//			return;
//		}

//		$pages = new Pages();
//		$pages = apply_filters( Plugin_Filters::ADMIN_PAGES, $pages->get_pages() );

//		wp_localize_script( $this->handle, 'freshpress_pages', $pages );
		wp_enqueue_script( $this->handle );

	}
}
