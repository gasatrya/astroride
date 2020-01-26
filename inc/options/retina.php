<?php
// Retina logo.
Kirki::add_field( 'astroride_options', [
	'type'        => 'image',
	'settings'    => 'astroride_retina_logo',
	'label'       => esc_html__( 'Logo Retina', 'astroride' ),
	'section'     => 'title_tagline',
	'default'     => '',
	'choices'     => [
		'save_as' => 'id',
	],
	'priority'    => 9,
] );
