<?php

$content = elgg_view('output/longtext', array(
	'value' => $vars['value']
));

echo elgg_view_layout('one_column', array(
	'title' => elgg_echo('editor_preview:preview'),
	'content' => $content,
));
