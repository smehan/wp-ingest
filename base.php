<?php
/**
 * Created by PhpStorm.
 * User: shawnmehan
 * Date: 1/8/16
 * Time: 9:52 AM
 */

function listdir( $dir ) {
	$files = array();
	$dir_iterator = new RecursiveDirectoryIterator( $dir );
	$iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

	foreach ($iterator as $file) {
		array_push( $files, $file->getPathname() );
	}
	return $files;
}

function insert_post( $body ) {
	$title = preg_split('/\r\n|\r|\n/', $body, 2);
	$my_post = array(
		'post_title'    => $title[0],
		'post_content'  => $body,
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_category' => array(2,3)
	);

	$wp_error = true;
	$post_id = wp_insert_post( $my_post, $wp_error );
	echo "<p>Inserted post number ", $post_id, "</p>";
}

function make_post( $filename ) {
	$fh      = fopen( $filename, 'r' );
	$theData = fread( $fh, filesize( $filename ) );
	fclose( $fh );

	return $theData;
}