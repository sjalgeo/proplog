<?php

namespace PropLog\Repository;

use Doctrine\ORM\EntityRepository;

class Valuation_Repository extends EntityRepository {

	public function find_orderby_date() {

		$result = $this
			->createQueryBuilder( 'v' )
			->orderBy( 'v.created', 'ASC' )
			->getQuery()
			->getResult();

		return $result;
	}
}