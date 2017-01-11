<?php

namespace PropLog\Rest_API;

use WP_REST_Request;

abstract class Endpoint {

	protected $methods;
	protected $regex;
	protected $namespace = 'proplog/v1';

	public function __construct( $parameters = array() ) {
		$this->parse_parameters( $parameters );
	}

	private function parse_parameters( $parameters ) {
		if ( isset( $parameters['method'] ) ) {
			$this->methods = $parameters['method'];
		}
		if ( isset( $parameters['regex'] ) ) {
			$this->regex = $parameters['regex'];
		}
		if ( isset( $parameters['namespace'] ) ) {
			$this->namespace = $parameters['namespace'];
		}
	}

	public function run() {
		add_action( 'rest_api_init', array( $this, 'register_endpoint' ) );
	}

	/**
	 * Each authentication object has different checks depending
	 * on what's required for the specific route.
	 *
	 * @return mixed
	 */
	public function permissions_check() {
		return true;
		return is_user_logged_in();
	}

	/**
	 * Sets up the REST Endpoint by pointing to the appropriate callbacks.
	 */
	public function register_endpoint() {

		$args = array(
			'methods'             => $this->methods,
			'callback'            => array( $this, 'endpoint' ),
			'permission_callback' => array( $this, 'permissions_check' ),
		);

		register_rest_route( $this->namespace, $this->regex, $args );
	}

	abstract public function endpoint( WP_REST_Request $data );
}
