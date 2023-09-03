<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

use croox\wde\utils\Arr;

function watp_get_css_property( $key = null, $filename = null ) {
	if ( null === $key )
		return;
	$filename = null === $filename ? 'watp_frontend' : $filename;
	return Arr::get( array(
		'watp_editor' => array( 
			'blue' => '#0073AA',
			'indigo' => '#6610f2',
			'purple' => '#6f42c1',
			'pink' => '#e83e8c',
			'red' => '#dc3545',
			'orange' => '#fd7e14',
			'yellow' => '#ffc107',
			'green' => '#28a745',
			'teal' => '#20c997',
			'cyan' => '#17a2b8',
			'white' => '#fff',
			'gray' => '#7c8690',
			'gray-dark' => '#23282d',
			'primary' => '#0073AA',
			'secondary' => '#7c8690',
			'success' => '#28a745',
			'info' => '#17a2b8',
			'warning' => '#ffc107',
			'danger' => '#dc3545',
			'light' => '#d7dade',
			'dark' => '#23282d',
			'breakpoint-xs' => '0',
			'breakpoint-sm' => '576px',
			'breakpoint-md' => '768px',
			'breakpoint-lg' => '992px',
			'breakpoint-xl' => '1200px',
			'font-family-sans-serif' => '"GlacialIndifference", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
			'font-family-monospace' => 'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace', 
		),
		'watp_frontend' => array( 
			'blue' => '#0073AA',
			'indigo' => '#6610f2',
			'purple' => '#6f42c1',
			'pink' => '#e83e8c',
			'red' => '#dc3545',
			'orange' => '#fd7e14',
			'yellow' => '#ffc107',
			'green' => '#28a745',
			'teal' => '#20c997',
			'cyan' => '#17a2b8',
			'white' => '#fff',
			'gray' => '#7c8690',
			'gray-dark' => '#23282d',
			'primary' => '#0073AA',
			'secondary' => '#7c8690',
			'success' => '#28a745',
			'info' => '#17a2b8',
			'warning' => '#ffc107',
			'danger' => '#dc3545',
			'light' => '#d7dade',
			'dark' => '#23282d',
			'breakpoint-xs' => '0',
			'breakpoint-sm' => '576px',
			'breakpoint-md' => '768px',
			'breakpoint-lg' => '992px',
			'breakpoint-xl' => '1200px',
			'font-family-sans-serif' => '"GlacialIndifference", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"',
			'font-family-monospace' => 'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace', 
		),
	), array( $filename, $key ) );
}
