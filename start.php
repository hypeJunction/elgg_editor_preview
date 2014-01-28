<?php

/**
 * Egitor Preview
 *
 * @author Ismayil Khayredinov <ismayil.khayredinov@gmail.com>
 * @copyright Copyrigh (c) 2011-2014, Ismayil Khayredinov
 */
elgg_register_event_handler('init', 'system', 'elgg_editor_preview_init');

function elgg_editor_preview_init() {

	elgg_register_simplecache_view('js/editor_preview/preview');
	elgg_register_js('editor_preview', elgg_get_simplecache_url('js', 'editor_preview/preview'));

	elgg_extend_view('css/elgg', 'editor_preview/css');
	
	elgg_register_ajax_view('editor_preview/preview');
	elgg_register_plugin_hook_handler('register', 'menu:longtext', 'elgg_editor_preview_menu_setup');
}

/**
 * Add a menu item to toggle output preview
 *
 * @param string $hook	Equals 'register'
 * @param string $type	Equals 'menu:longtext'
 * @param array $menu	Current menu items
 * @param array $params	Additional params
 * @return array Updated menu
 */
function elgg_editor_preview_menu_setup($hook, $type, $menu, $params) {

	$id = elgg_extract('id', $params);

	$menu[] = ElggMenuItem::factory(array(
				'name' => 'editor_preview',
				'text' => elgg_echo('editor_preview:preview'),
				'href' => "#{$id}",
				'class' => 'elgg-longtext-control editor-preview-toggle',
				'priority' => 600
	));

	elgg_load_js('lightbox');
	elgg_load_css('lightbox');
	elgg_load_js('editor_preview');

	return $menu;
}
