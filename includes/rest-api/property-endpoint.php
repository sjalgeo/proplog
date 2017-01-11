<?php

namespace PropLog\Rest_API;

use PropLog\Entity\Property;
use PropLog\Entity\Valuation;
use WP_REST_Request;
use WP_REST_Server;

class Property_Endpoint extends Endpoint {

	public function __construct( array $parameters = array() ) {
		parent::__construct( $parameters );
		$this->methods = WP_REST_Server::READABLE;
		$this->regex = 'property';
	}

	public function endpoint( WP_REST_Request $data ) {

		$entity_manager = $GLOBALS['em'];

		$list = $entity_manager->getRepository( Property::class )->findAll();

		return array_map( function( $item ) {
			return array(
				'id' => $item->get_id(),
				'name' => $item->get_name()
			);
		}, $list );
	}

}