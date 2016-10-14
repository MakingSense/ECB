<?php
/**
 * @package Tea Page Content
 * @version 1.2.1
 */

return array(
	// Predefined default values, e.g. default parameters
	'defaults' => array(
		'widget' => array(
			'title' => '',
			'posts' => '',
                        'date' => '',
			'template' => 'default',
			'per-page' => -1,
			'caller' => 'widget',
		),
		'shortcode' => array(
			'title' => '',
			'posts' => '',
			'id' => '', // @deprecated since 1.1
                        'date' => '',
			'template' => 'default',
			'show_page_thumbnail' => true,
			'show_page_content' => true,
			'show_page_title' => true,
			'linked_page_title' => false,
			'linked_page_thumbnail' => false,
			'order' => 'desc',

			'caller' => 'shortcode',
		),
		'post-types' => array(
                        'public' => true
                        
		),

	),

	// Predefined system values, e.g. logical operators, needly constants or system paths
	'system' => array(
		'posts' => array(
			'types-operator' => 'or'
                    
		),
		'predefined-templates' => array(
			// @deprecated default-padded template, since 1.1
			'default', 'default-padded', 'bootstrap-3'
		),
		'template-variables' => array(
			'mask' => array(
				'name', 'type', 'defaults'
			),
		),
		'page-variables' => array(
			'prefix' => 'page_'
		),
		'template-directories' => array(
			'plugin' => TEA_PAGE_CONTENT_PATH . '/templates/',
			'theme' => get_template_directory() . '/templates/'
		),
		'versions' => array(
			'plugin' => '1.2.0',
			'scripts' => '1.2',
			'styles' => '1.2'
		)
	)
);