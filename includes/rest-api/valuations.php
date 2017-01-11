<?php

namespace PropLog\Rest_API;

use PropLog\Entity\Valuation;
use WP_REST_Request;
use WP_REST_Server;

class Valuations extends Endpoint {

	public function __construct( array $parameters = array() ) {
		parent::__construct( $parameters );
		$this->methods = WP_REST_Server::READABLE;
		$this->regex = 'valuations';
	}

	public function endpoint( WP_REST_Request $data ) {

		$entity_manager = $GLOBALS['em'];

		$list = $entity_manager->getRepository( Valuation::class )->find_orderby_date();

		return array_map( function( $item ) {
			$value = $item->get_value();
			$equity = $item->get_value() * 0.25;

			$created = $item->get_created();
//			$created = new \DateTime('now');
			$created = $created->getTimestamp();
//			$created = $created->format('jS M');
//			exit;

			return array(
				'value' => $value,
				'equity' => $equity,
				'debt' => ($value - $equity),
				'created' => $created,
			);
		}, $list );
	}

}