<?php

namespace PropLog\Entity;

//use Doctrine\Common\Collections\ArrayCollection;
//use Doctrine\ORM\EntityRepository;
use DateTime;

/**
 * @Entity @Table(name="property")
 * @Entity(repositoryClass="PropLog\Repository\Property_Repository")
 **/
class Property {
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 *
	 */
	protected $id;

	/**
	 * @Column(type="string")
	 */
	protected $name;

	/**
	 * @Column(type="datetime")
	 */
	protected $created;

	public function __construct( $name ) {
		$this->created = new DateTime( 'now' );
		$this->name = $name;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_name(){
		return $this->name;
	}

}