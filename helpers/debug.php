<?php

function sja_debug( $item, $title = 'debug' ) {

	$class = is_object( $item ) ? get_class( $item ) : null;

	if (  strstr( $class, 'PropLog\\Entity\\' ) ) {
		\Doctrine\Common\Util\Debug::dump($item);
		return;
	} elseif ( defined( 'WP_CLI' ) and WP_CLI ) {
		print_r( "\r\n" . "+----------- $title -----------+" . "\r\n" );
		var_dump( $item );
		print_r( '' . "\r\n" );
	} elseif ( is_admin() ) {
		echo '<pre style="margin-left: 180px;margin-top:15px;background-color: white;padding:15px;">';
		var_dump( $item );
		echo '</pre>';
	} else {
		echo '<pre>';
		var_dump( $item );
		echo '</pre>';
	}
}
