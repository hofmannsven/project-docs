<?php
/**
 * Project Docs
 *
 * @package   project-docs
 * @author    Sven Hofmann <info@hofmannsven.com>
 * @license   GPL-3.0+
 * @link      https://github.com/hofmannsven/project-docs
 * @copyright 2014 Sven Hofmann
 *
 * @wordpress-plugin
 * Plugin Name:       Project Docs
 * Plugin URI:        https://github.com/hofmannsven/project-docs
 * Description:       Skeleton for documentation inside of WordPress.
 * Version:           1.0.0
 * Author:            <a href="http://hofmannsven.com" target="_blank">Sven Hofmann</a>
 * Author URI:        http://hofmannsven.com
 * Text Domain:       project-docs
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/hofmannsven/project-docs
 */

if ( !defined( 'WPINC' ) )
	die;

new project_docs;

class project_docs {

	const name = 'Docs';
	const version = '1.0.0';
	const textdomain = 'project-docs';

	protected $loaded_textdomain = false;

	public function __construct() {

		if ( is_admin() ) :
			// $this->load_plugin_textdomain();
			add_action( 'admin_enqueue_scripts', array ( $this, 'docs_styles' ) );
			add_action( 'admin_enqueue_scripts', array ( $this, 'docs_scripts' ) );
			add_action( 'admin_menu', array( $this, 'docs_menu' ) );
		endif;
	}

	protected function load_plugin_textdomain() {
		if ( !$this->loaded_textdomain ) {
			load_plugin_textdomain( self::textdomain, false, self::textdomain . '/languages' );
			$this->loaded_textdomain = true;
		}
	}

	public function docs_styles() {
		wp_register_style( 'docs_styles', plugin_dir_url(__FILE__) . '/css/docs.css', array(), self::version, 'all' );
		wp_enqueue_style( 'docs_styles' );

		wp_register_style( 'docs_print_styles', plugin_dir_url(__FILE__) . '/css/print.css', array(), self::version, 'print' );
		wp_enqueue_style( 'docs_print_styles' );
	}

	public function docs_scripts() {
		wp_register_script( 'docs_scripts', plugin_dir_url(__FILE__) . '/js/docs.js', array( 'jquery' ), self::version, false );
		wp_enqueue_script( 'docs_scripts' );
	}

	public function docs_menu() {
	    add_menu_page(
		    self::name,
		    self::name,
		    'manage_options',
		    'docs',
		    array ( $this, 'docs_page' ),
		    'dashicons-info',
		    3
	    );
	}

	public function docs_page() {
		echo '<div class="wrap">';
		// docs title
		echo '<h2>' . $docs_title = apply_filters( 'docs_title', __('Documentation', self::textdomain) ) . '</h2>';
		echo '</div><!-- /.wrap -->';

		echo '<div class="wrap docs-wrapper">';

		// docs content
		echo apply_filters( 'docs_content', __('Please check out the <a href="#">docs</a> and add your documentation within your plugin or theme.', self::textdomain) );

		// docs navigation
		$docs_nav = apply_filters( 'docs_nav', array() );
		if ( $docs_nav ) :
			echo '<div class="navigation do-not-print">';
			echo '<h2>' . __('Quick Links', self::textdomain) . '</h2>';
	            echo '<ul class="docs-quicklinks">';

				foreach ( $docs_nav as $nav_id => $nav_name ) :
					echo '<li><a href="' . $nav_id . '">' . $nav_name . '</a></li>';
				endforeach;

    	        echo '</ul>';
    	    echo '</div><!-- /.navigation -->';
		endif; // end of $docs_nav

		echo '</div><!-- .wrap -->';
	}

}