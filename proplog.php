<?php
/**
Plugin Name: Property Logger
Plugin URI:
Description: stuff
Version: 0.0.1
Tested up to: 4.7.0
 */

require_once( 'helpers/debug.php' );
require_once( 'vendor/autoload.php' );
require_once( 'config/autoload.php' );

use PropLog\Controllers\Database_Controller;
use PropLog\Model\Schema;

$controller = new Database_Controller( __FILE__ );
$controller->run();

//$entity_manager = $GLOBALS['em'];
//$schema = new Schema( $entity_manager );
//$schema->migrate();

use PropLog\Entity\Valuation;

$valuation = new Valuation();
$valuation->set_property(1);
$valuation->set_value(68000);

$entity_manager = $GLOBALS['em'];
$entity_manager->persist($valuation);
$entity_manager->flush();