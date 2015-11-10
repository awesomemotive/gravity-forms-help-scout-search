<?php
/*
 * Plugin Name: Gravity Forms - Help Scout Docs Search Field
 * Description: Adds a special text field for searching HelpScout docs
 * Author: Pippin Williamson
 * Version: 1.0
 * License: GPLv3
 */

class PW_GF_HS_Search {

	public function __construct() {
		$this->init();
	}

	public function init() {

		add_action( 'gform_pre_enqueue_scripts', array( $this,'scripts' ) );
		add_filter( 'wp_footer', array( $this, 'add_js' ), 10 );

	}

	public function scripts() {
		wp_enqueue_script( 'jquery' );
	}
	
	public function add_js() {

		if ( ! wp_script_is( 'gform_gravityforms' ) ) {
			return;
		}

		$settings = get_option( 'gravityformsaddon_gravityformshelpscout_settings' );
?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {

				var wrap      = $('.gform_body .gfield.helpscout-docs');
				var paging    = $('.gform_body .gform_page_footer');
				var hidden    = $('.gform_body .gfield.helpscout-docs').next().find('input');
				var field     = wrap.find('input[type="text"]');
				var searching = false;

				paging.hide();

				$('body').on('click', '.gform_body #need-help-contact', function(e) {
					e.preventDefault();
					paging.show();
				});

				wrap.append( '<div class="docs-search-wrap"></div>' );
				field.attr( 'autocomplete', 'off' );
				field.keyup(function() {
					query = $(this).val();

					if( query.length < 4 ) {
						return;
					}
						
					var html = '<ul class="docs-search-results">';

					if( ! searching ) {

						$.ajax({
							url: 'https://docsapi.helpscout.net/v1/search/articles?collectionId=548f192ae4b07d03cb25088e&query=' + query,
							headers: {
								'Authorization': 'Basic <?php echo base64_encode( $settings["api_key"] . ":X" ); ?>'
							},
							xhrFields: {
								withCredentials: false
							},
							beforeSend: function() {
								searching = true;
							},
							success: function(results) {
								$.each( results.articles.items, function( key, article ) {
									html = html + '<li class="article"><a href="' + article.url + '" title="' + article.preview + '">' + article.name + '</a><li>';
								});
							}
						}).done(function() {
							html = html + '</ul>'
							html = html + '<p class="show-contact-form-wrap"><a href="#" id="need-help-contact">Still need help?</a></p>';
							wrap.find('.docs-search-wrap').html( html );
							searching = false;
						});

					}

				});
			});

		</script>
<?php

	}

}
new PW_GF_HS_Search;