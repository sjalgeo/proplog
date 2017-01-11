<?php

namespace PropLog\App;

class App_Page extends Custom_Page {

	public function render_page() {
		echo '<html><head>';

		echo'</head><body>';

		echo '<div id="app">Loading...</div>';
		echo '<script src="' . plugins_url( 'proplog/scripts/admin.min.js' ) . '"></script>';
		echo '</body></html>';
	}
}