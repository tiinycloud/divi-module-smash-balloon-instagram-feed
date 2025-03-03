<?php

/*
Plugin Name: Divi Module Smash Balloon Instagram Feed
Plugin URI:  https://tiinycloud.com
Description: View shortcode result as divi builder module.
Version:     1.1.0
Author:      TiinyCloud
Author URI:  https://tiinycloud.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wd-shortcode-module
Domain Path: /languages
*/


    define('WDSC_TEXT_DOMAIN', 'wd-shortcode-module');  
    
    if ( !function_exists( 'wd_initialize_shortcode_view_extension' ) ) {
        /**
         * Creates the extension's main class instance.
         *
         * @since 1.0.0
         */
        function wd_initialize_shortcode_view_extension()
        {
            require_once plugin_dir_path( __FILE__ ) . 'includes/ShortcodeView.php';
        }
        
        add_action( 'divi_extensions_init', 'wd_initialize_shortcode_view_extension' );
    }
	
	add_action( 'wp_enqueue_scripts', 'wd_enqueue_divi_scripts_handler' );
	
	function wd_enqueue_divi_scripts_handler() {
		?>
        <script type="text/javascript">
		  function wd_resizeIframe(iframe, prheight) {
			  var ifh = iframe.contentWindow.document.body.scrollHeight + "px";//alert(ifh);
			  iframe.height = ifh;
			  window.requestAnimationFrame(() => wd_resizeIframe(iframe));
		  }
		</script>  
        <?php
	}
	
    if ( !function_exists( 'wd_shortcode_view' ) ) {
        add_action( 'wp_ajax_wd_shortcode_view', 'wd_shortcode_view' );
		add_action( 'wp_ajax_nopriv_wd_shortcode_view', 'wd_shortcode_view' );
        function wd_shortcode_view()  {
			$output = array();
			ob_start();
			unset($_POST['action']);
			echo '<iframe  onload="wd_resizeIframe(this)" style="width:100%;" src="'.esc_url( add_query_arg( $_POST,  plugins_url( 'front.php', __FILE__ )) ). '"></iframe>';
			//echo get_home_url();
			$output['html'] = ob_get_contents();
			ob_get_clean();
			header("Content-Type: application/json");
            echo  json_encode( $output ) ;
            exit();
        }
    	//add_filter( 'widget_text', 'do_shortcode' );
    }
	//add_shortcode('feed', 'wd_display_instagram');
	function wd_display_instagram( $atts = array() ) {}