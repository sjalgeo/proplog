<?php

namespace PropLog\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * @Entity @Table(name="valuation")
 * @Entity(repositoryClass="PropLog\Repository\Valuation_Repository")
 **/
class Valuation {
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 *
	 */
	protected $id;

	/**
	 * @var string
	 * @Column(type="integer")
	 */
	protected $value;

	/**
	 * @Column(type="integer")
	 */
	protected $property;

	/**
	 * @Column(type="datetime")
	 */
	protected $created;

	public function __construct() {
		$this->created = new \DateTime( 'now' );;
	}

	public function get_id() {
		return $this->id;
	}

	public function set_value( $value ) {
		$this->value = $value;
	}

	public function set_property($property) {
		$this->property = $property;
	}

	public function get_value() {
		return $this->value;
	}

	public function get_created() {
		return $this->created;
	}
}