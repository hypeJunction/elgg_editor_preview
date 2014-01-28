//<script>

	elgg.provide('elgg.editor_preview');


	elgg.editor_preview.init = function() {

		$('.editor-preview-toggle').live('click', elgg.editor_preview.preview);

	}

	elgg.editor_preview.preview = function() {

		var $toggle = $(this);
		var $input = $($toggle.attr('href'));
		var value = (typeof tinyMCE !== "undefined") ? tinyMCE.get($input.attr('id')).getContent() : $input.val();
		var $preview = $('<div id="editor-preview-window" />');

		elgg.ajax('ajax/view/editor_preview/preview', {
			data: {
				value: value
			},
			beforeSend: function() {
				$.fancybox.showActivity();
			},
			success: function(data) {
				$preview.html(data);
				$.fancybox({
					content: $preview,
					margin: 20
				});
			},
			error: function() {
				elgg.register_error(elgg.echo('editor_preview:preview_error'));
				$.fancybox.close();
			}
		})
	};

	elgg.register_hook_handler('init', 'system', elgg.editor_preview.init);
