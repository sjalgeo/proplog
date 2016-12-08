<?php

namespace PropLog\Model;

use Exception;
use Doctrine\ORM\Tools\SchemaTool;

class Schema {
	protected $doctrine;

	public function __construct( $doctrine ) {
		$this->doctrine = $doctrine;
	}

	public function get_diffs() {
		$conn = $this->doctrine->getConnection();
		$platform = $this->get_platform( $conn );
		$metadata = $this->doctrine->getMetadataFactory()->getAllMetadata();

		$tool = new SchemaTool( $this->doctrine );
		$from_schema = $conn->getSchemaManager()->createSchema();
		$to_schema = $tool->getSchemaFromMetadata( $metadata );

		$sqls = $from_schema->getMigrateToSql( $to_schema, $platform );
		$run_sqls = array();
		foreach ( $sqls as $sql ) {
			if (
				stripos( $sql, 'DROP TABLE' ) === false &&
				stripos( $sql, 'DROP FOREIGN KEY' ) === false
			) {
				$run_sqls[] = $sql;
			}
		}

		return $run_sqls;
	}

	public function migrate() {
		$conn = $this->doctrine->getConnection();
		$sqls = $this->get_diffs();

		foreach ( $sqls as $sql ) {
			try {
				$conn->exec( $sql );
			} catch (Exception $e) {
				// Sometimes Doctrine cries, we don't know why
				return $e->getMessage();
			}
		}
		return true;
	}

	public function execute( $sql ) {
		$conn = $this->doctrine->getConnection();
		$conn->exec( $sql );
	}

	protected function get_platform( $conn ) {
		$platform = $conn->getDatabasePlatform();
		$platform->registerDoctrineTypeMapping( 'enum', 'string' );
		$platform->registerDoctrineTypeMapping( 'set', 'string' );
		$platform->registerDoctrineTypeMapping( 'bit', 'string' );
		return $platform;
	}
}
