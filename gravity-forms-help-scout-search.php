<?php
/*
 * Plugin Name: Gravity Forms - Help Scout Docs Search Field
 * Description: Adds a special text field for searching Help Scout docs
 * Author: Pippin Williamson and Zack Katz
 * Version: 3.0.1
 * License: GPLv3
 */

class PW_GF_HS_Search {

	/**
	 * Help Scout sub-domain. Find yours in Help Scout > Manage > Docs > Site Settings > Sub-domain
	 * @var string Help Scout Docs subdomain, example: "https://{subdomain}.helpscoutdocs.com"
	 * @since 3.0
	 */
	private $subdomain = '';

	/**
	 * @var array Array of Help Scout Docs Collection IDs, if you want to limit results to a set of collections.
	 */
	private $collections = array();

	const field_css_class = 'helpscout-docs';

	const version = '3.0.1';

	public function __construct() {

		$subdomain     = defined( 'HELPSCOUT_DOCS_SUBDOMAIN' ) ? HELPSCOUT_DOCS_SUBDOMAIN : '';
		$collections = defined( 'GF_HELPSCOUT_DOCS_COLLECTIONS' ) ? explode( ':', GF_HELPSCOUT_DOCS_COLLECTIONS ) : array();

		if ( $subdomain = apply_filters( 'gf_helpscout_docs_subdomain', $subdomain ) ) {

			$this->subdomain = $subdomain;

			$this->collections  = apply_filters( 'gf_helpscout_docs_collections', $collections );

			$this->init();

		} else {
			_doing_it_wrong( __METHOD__, __( 'The Help Scout Docs Search Field plugin requires a base URL. Define it using the `HELPSCOUT_DOCS_BASE_URL` constant, or set it using the `gf_helpscout_docs_base_url` filter' ), self::version );
		}

	}

	public function init() {

		// Use `init` so that is also available on Gravity Forms Preview page
		add_action( 'init', array( $this, 'register_script' ), 1 );

		// Enqueue only when display a Gravity Forms form
		add_action( 'gform_pre_enqueue_scripts', array( $this, 'scripts' ) );

		// Trigger scripts being printed on Gravity Forms Preview page
		add_filter( 'gform_preview_footer', array( $this, 'print_footer_scripts' ), 10 );
	}

	/**
	 * Register the script
	 * @since 1.2
	 * @return void
	 */
	public function register_script() {
		$min = ( defined('SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		wp_register_script( 'gf-hs-search', plugins_url( 'gf-hs-search' . $min . '.js', __FILE__ ), array( 'jquery', 'gform_gravityforms' ), self::version, true );
	}

	/**
	 * Check if the form has a text field with a Custom CSS Class that contains 'helpscout-docs'
	 *
	 * @param array $form
	 *
	 * @return bool True: yes, it does. False: nope.
	 */
	private function has_docs_field( $form ) {

		$text_fields = GFCommon::get_fields_by_type( $form, 'text' );

		foreach( $text_fields as $text_field ) {
			if( strpos( rgar( $text_field, 'cssClass' ), self::field_css_class ) !== false ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Enqueue script and localize variables
	 *
	 * @param array $form The Form Object
	 *
	 * @return void
	 */
	public function scripts( $form = array(), $ajax = false ) {

		if( ! $this->has_docs_field( $form ) || wp_script_is( 'gf-hs-search' ) ) {
			return;
		}

		wp_enqueue_script( 'gf-hs-search' );

		$script_settings = apply_filters( 'gf_helpscout_docs_script_settings', array(
			'debug' => false, // Print debug logs or not
			'searchDelay' => 750, // Delay time in ms after a user stops typing and before search is performed
			'minLength' => 3, // Minimum number of characters required to trigger search
			'limit' => 25, // Max limit for # of results to show
			'text' => array(
				'result_found' => __('We found {count} article that may help:'),
				'results_found' => __('We found {count} articles that may help:'),
				'no_results_found' => __('No results found&hellip;'),
				'enter_search' => __('Please enter a search term.'),
				'not_long_enough' => __('Search must be at least {minLength} characters.'),
				'error' => __('There was an error fetching search results.'),
			),
			'template' => array(
				'wrap_class' => 'docs-search-wrap',
				'before' => '<ul class="docs-search-results">',
				'item' => '<li class="article"><a href="{url}" title="{preview}" target="_blank">{name}</a></li>',
				'after' => '</ul>',
				'results_found' => '<span class="{css_class}">{text}</span>',
			),
			'collections' => $this->collections, // The collection IDs to search in

			// Do not modify
			'_subdomain' => esc_js( $this->subdomain ),
		) );

		wp_localize_script( 'gf-hs-search', 'GF_HS_Settings', $script_settings );
	}

	/**
	 * Print scripts on the Gravity Forms preview page
	 *
	 * @since 1.2
	 *
	 * @return void
	 */
	public function print_footer_scripts() {
		wp_print_scripts( 'gf-hs-search' );
	}

}

new PW_GF_HS_Search;
