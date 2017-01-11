<?php

namespace PropLog\App;

abstract class Custom_Page {

	/**
	 * Saves the options container and sets up some WP hooks
	 */
	public function __construct( $options ) {
		$this->options = $options;

		// add our rewrite rules
		add_filter( 'generate_rewrite_rules', array( $this, 'custom_page_generate_rewrite_rules' ) );
		// add our custom query variable to the whitelist
		add_filter( 'query_vars', array( $this, 'custom_page_query_vars' ) );
		// dont pull in a full listing of posts in the main query, there's no need
		// ( you can comment this out if you're not using a theme template to render content )
		add_filter( 'pre_get_posts', array( $this, 'custom_page_paging_issue' ) );
		// call render_page() when needed
		add_action( 'template_redirect', array( $this, 'custom_page_template_redirect' ) );
	}

	/**
	 * Add our rewrite rules
	 */
	function custom_page_generate_rewrite_rules( $wp_rewrite ) {
		$page_name = $this->options['pagename'];
		$custom_page_rules = array(
			$this->options['url'] => 'index.php?custom_page='.$page_name.'&posts_per_page=1&paged=1'
		);
		$wp_rewrite->rules = $custom_page_rules + $wp_rewrite->rules;
	}

	/**
	 * Filter that inserts our query variable into the $wp_query
	 */
	function custom_page_query_vars( $qvars ) {
		$qvars[] = 'custom_page';
		return $qvars;
	}

	/**
	 * fix page loops if pulling in a theme template
	 */
	function custom_page_paging_issue( $query ) {

		if ( !empty( $query->query_vars['custom_page'] ) ) {
			$query->set( 'posts_per_page', 1 );
		}
	}

	/**
	 * Filter that maps the query variable to a template
	 */
	function custom_page_template_redirect() {
		$pagename = $this->options['pagename'];
		global $wp_query;

		$custom_page = $wp_query->query_vars['custom_page'];
		if ( $custom_page == $pagename ) {
			// we've found our page, call render_page and exit
			$this->render_page();
			exit;
		}
	}

	/**
	 * Displays the content, extend this class and implement this function as needed
	 */
	public abstract function render_page();

}