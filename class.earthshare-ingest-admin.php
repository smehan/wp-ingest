<?php

/**
 * Created by PhpStorm.
 * User: shawnmehan
 * Date: 1/7/16
 * Time: 2:29 PM
 */
class Earthshare_Ingest_Admin {
	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
		}
	}

	public static function init_hooks() {
		add_action( 'admin_menu', 'dummy_menu_add_page' );

		function dummy_menu_add_page() {
			add_menu_page( 'Earthshare Ingest', 'Earthshare Ingest', 'manage_options', 'es-ingest', 'es_admin_do_page' );
		}

		function es_admin_do_page() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
			}

			include 'base.php'; // all the base functions for getting data in.

			echo '<div class="wrap">';
			echo '<p>This is a stub for the Earthshare Ingest Plugin.</p>';
			echo '</div>';

			print_files();
			//print_json();
		}

		function print_files() {

			$data = array(); //should declare array to be used to hold valid input files

			echo '<b>Ingesting the data files that are in the data directory!</b>';
			echo '<br>*******************************************************<br>';

			$dirfiles = listdir( ES__PLUGIN_DIR . "data" );
			if ( $dirfiles ) {
				foreach ( $dirfiles as $key => $filename ) {
					if ( substr( $filename, - 4 ) == '.txt' && ! is_dir( $filename ) ) {
						$data[ $filename ] = php_strip_whitespace( $filename );
						$theData = make_post($filename);
						insert_post( $theData );
						echo "<br>";
						echo "<br>Finished.";
						echo "<br>";
					} else {
						$other[ $filename ] = ( ! is_dir( $filename ) ) ? file_get_contents( $filename ) : '';
					}
				}
				$myFile  = ES__PLUGIN_DIR . "/data/test.txt";
				$fh      = fopen( $myFile, 'r' );
				$theData = fread( $fh, filesize( $myFile ) );
				fclose( $fh );

			}

			insert_post( $theData );
			echo "<br>";
			echo "<br>Finished.";
			echo "<br>";

		}

		function print_json() {
			$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

			var_dump( json_decode( $json ) );
			var_dump( json_decode( $json, true ) );
		}


	}



}

