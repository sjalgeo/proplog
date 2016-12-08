<?php

namespace PropLog\Controllers;

use Doctrine\Common\EventManager as DoctrineEventManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Doctrine\ORM\Tools\Setup;
use PropLog\Model\Table_Prefix;

class Database_Controller {

	public function __construct( $root_file ) {
		$this->root_file = $root_file;

		global $wpdb;
		$this->database_prefix = $wpdb->prefix;

		## Determine directory where managed entities reside.
		$this->entity_directory = str_replace( 'proplog.php', '', $this->root_file );
		$this->entity_directory = $this->entity_directory . 'includes/entity';
	}

	public function run() {

		$is_dev_mode = true;

		$connection_params = array(
			'dbname' => DB_NAME,
			'user' => DB_USER,
			'password' => DB_PASSWORD,
			'host' => DB_HOST,
			'driver' => 'pdo_mysql',
		);

		$environment_manager = new DoctrineEventManager();
		$table_prefix = new Table_Prefix( $this->database_prefix . 'proplog_' );
		$environment_manager->addEventListener( Events::loadClassMetadata, $table_prefix );

		$config = Setup::createAnnotationMetadataConfiguration(
			array( $this->entity_directory ),
			$is_dev_mode
//			EASYPRESSOR_CACHE_DIR,
//			null,
//			false
		);

		## Give Entity Manager to the Global Namespace (probably not best practise?)
		$GLOBALS['em'] = EntityManager::create( $connection_params, $config, $environment_manager );
	}
}