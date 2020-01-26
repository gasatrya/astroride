<?php
/**
 * Hero area
 */

// Hero section
Kirki::add_section( 'astroride_hero_section', [
	'title'       => esc_html__( 'Hero', 'astroride' ),
	'priority'    => 135
] );

// Enable / disable hero area
Kirki::add_field( 'astroride_options', [
	'type'        => 'toggle',
	'settings'    => 'astroride_hero',
	'label'       => esc_html__( 'Enable', 'astroride' ),
	'section'     => 'astroride_hero_section',
	'default'     => '0'
] );

// Hero Title
Kirki::add_field( 'astroride_options', array(
	'type'      => 'text',
	'settings'  => 'astroride_hero_title',
	'label'     => esc_html__( 'Title', 'astroride' ),
	'section'   => 'astroride_hero_section',
	'transport' => 'postMessage',
	'js_vars'   => [
		[
			'element' => '.hero__title',
			'function' => 'html'
		]
	],
	'required'  => array(
		array(
			'setting'  => 'astroride_hero',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Hero Tagline
Kirki::add_field( 'astroride_options', array(
	'type'     => 'editor',
	'settings' => 'astroride_hero_tagline',
	'label'    => esc_html__( 'Tagline', 'astroride' ),
	'section'  => 'astroride_hero_section',
	'transport' => 'postMessage',
	'js_vars'   => [
		[
			'element' => '.hero__tagline',
			'function' => 'html'
		]
	],
	'required' => array(
		array(
			'setting'  => 'astroride_hero',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

// Color or Image
Kirki::add_field( 'astroride_options', [
	'type'        => 'radio-buttonset',
	'settings'    => 'astroride_hero_type',
	'label'       => esc_html__( 'Type', 'astroride' ),
	'section'     => 'astroride_hero_section',
	'default'     => 'color',
	'choices'     => [
		'color' => esc_html__( 'Color', 'astroride' ),
		'image' => esc_html__( 'Image', 'astroride' ),
	],
	'active_callback'  => [
		[
			'setting'  => 'astroride_hero',
			'operator' => '==',
			'value'    => true,
		]
	],
] );

// Background color
Kirki::add_field( 'astroride_options', [
	'type'        => 'color',
	'settings'    => 'astroride_hero_color',
	'label'       => esc_attr__( 'Background Color', 'astroride' ),
	'section'     => 'astroride_hero_section',
	'default'     => '#dddddd',
	'choices'     => [
		'alpha' => true,
	],
	'output'      => [
		[
			'element'  => '.hero',
			'property' => 'background-color',
			'exclude'  => [ '#dddddd' ]
		]
	],
	'transport'   => 'auto',
	'active_callback'  => [
		[
			'setting'  => 'astroride_hero_type',
			'operator' => '==',
			'value'    => 'color',
		],
		[
			'setting'  => 'astroride_hero',
			'operator' => '==',
			'value'    => true,
		]
	],
] );

// Background image.
Kirki::add_field( 'astroride_options', [
	'type'        => 'image',
	'settings'    => 'astroride_hero_image',
	'label'       => esc_html__( 'Background Image', 'astroride' ),
	'section'     => 'astroride_hero_section',
	'default'     => '',
	'choices'     => [
		'save_as' => 'id',
	],
	'active_callback'  => [
		[
			'setting'  => 'astroride_hero_type',
			'operator' => '==',
			'value'    => 'image',
		],
		[
			'setting'  => 'astroride_hero',
			'operator' => '==',
			'value'    => true,
		]
	],
] );

// Text color
Kirki::add_field( 'astroride_options', [
	'type'        => 'color',
	'settings'    => 'astroride_hero_text_color',
	'label'       => esc_attr__( 'Text Color', 'astroride' ),
	'section'     => 'astroride_hero_section',
	'default'     => '#ffffff',
	'choices'     => [
		'alpha' => true,
	],
	'output'      => [
		[
			'element'  => [ '.hero__title', '.hero__tagline' ],
			'property' => 'color',
			'exclude'  => [ '#ffffff' ]
		]
	],
	'transport'   => 'auto',
	'active_callback'  => [
		[
			'setting'  => 'astroride_hero',
			'operator' => '==',
			'value'    => true,
		]
	],
] );

// Text alignment
Kirki::add_field( 'astroride_options', [
	'type'        => 'radio-buttonset',
	'settings'    => 'astroride_hero_text_alignment',
	'label'       => esc_html__( 'Text Alignment', 'astroride' ),
	'section'     => 'astroride_hero_section',
	'default'     => 'left',
	'choices'     => [
		'left'   => esc_html__( 'Left', 'astroride' ),
		'center' => esc_html__( 'Center', 'astroride' ),
		'right'  => esc_html__( 'Right', 'astroride' ),
	],
	'output'      => [
		[
			'element'  => '.hero',
			'property' => 'text-align',
			'exclude'  => [ 'left' ]
		]
	],
	'active_callback'  => [
		[
			'setting'  => 'astroride_hero',
			'operator' => '==',
			'value'    => true,
		]
	],
] );
