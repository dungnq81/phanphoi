!function ($) {
    'use strict';

	$(function () {
		if($("textarea.tinymce").length) {

			// init tinyMCE5
			tinymce.init({
				selector: "textarea.tinymce",
				plugins: [
					"advlist anchor autolink autosave image imagetools charmap",
					"code codesample directionality emoticons responsivefilemanager",
					"fullscreen help hr imagetools importcss insertdatetime",
					"legacyoutput link lists nonbreaking noneditable pagebreak paste",
					"preview print quickbars save searchreplace spellchecker tabfocus table",
					"template textpattern toc visualblocks visualchars wordcount"
				],
				toolbar: [
					"formatselect bold italic underline strikethrough blockquote bullist numlist alignjustify alignleft aligncenter alignright link unlink fullscreen",
					"print removeformat searchreplace charmap table forecolor backcolor hr superscript subscript codesample responsivefilemanager visualchars code help"
				],
				block_formats: 'Paragraph=p;H1=h1;H2=h2;H3=h3;H4=h4;H5=h5;H6=h6;Preformatted=pre;Div=div;',
				quickbars_insert_toolbar: false,
				quickbars_selection_toolbar: "bold italic quicklink removeformat h2 h3 forecolor blockquote",
				help_tabs: ['shortcuts'],
				browser_spellcheck : true,
				relative_urls : false,
				remove_script_host: false,
				menubar: false,
				min_height: 500,
				//visualblocks_default_state: true,
				content_style: ".mce-content-body {font-size: 18px;}",
				convert_urls: false,
				forced_root_block : 'p',

				// End container block element when pressing enter inside an empty block
				end_container_on_empty_block: true,

				// responsivefilemanager plugin
				external_filemanager_path: BASE_URL + "filemanager/",
				filemanager_title: "Media Manager" ,
				external_plugins: {
					"responsivefilemanager": BASE_URL + "assets/admin/plugins/tinymce/plugins/responsivefilemanager/plugin.min.js",
					"filemanager": BASE_URL + "filemanager/plugin.min.js",
				},
				filemanager_access_key: 'adkey_dmsKHpm5624sf',
			});
		}
	});
}(jQuery);
