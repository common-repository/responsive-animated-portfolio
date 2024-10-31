<?php
/* Plugin Name: Responsive animated Portfolio
Plugin URI: http://www.templategraphy.com
Description: Add a animated responsive portfolio to your website with a user-friendly UI and shortcodes.
Version: 1.0
Author: Template Graphy
Author URI: http://www.templategraphy.com
*/
add_action('wp_enqueue_scripts', 'port_tab_init');
function port_tab_init()
{
wp_enqueue_style('bootstrap.min', plugins_url('/css/bootstrap.min.css', __FILE__));
wp_enqueue_style('style', plugins_url('/css/style.css', __FILE__));

}
add_action('wp_enqueue_scripts', 'port_query_init');

function port_query_init()
{
wp_register_script('bootstrap', plugins_url('/js/bootstrap.min.js', __FILE__));
wp_register_script('mixitup', plugins_url('/js/jquery.mixitup.js', __FILE__));
wp_register_script('owl.carousel', plugins_url('/js/owl.carousel.js', __FILE__));
wp_register_script('magnific-popup', plugins_url('/js/jquery.magnific-popup.js', __FILE__));
wp_register_script('plugins', plugins_url('/js/plugins.js', __FILE__));
wp_register_script('custom', plugins_url('/js/custom.js', __FILE__));


wp_enqueue_script('jquery');
wp_enqueue_script('mixitup');
wp_enqueue_script('owl.carousel');
wp_enqueue_script('magnific-popup');
wp_enqueue_script('plugins');
wp_enqueue_script('custom');
};


function port_remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'port_remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'port_remove_cssjs_ver', 10, 2 );

function port_jquery()
{
?>
	<script>
(function($){
	//Portfolio Engine
    $('#grid').mixitup({
      transitionSpeed : 800
    });

   
})(jQuery);
		
	</script>
<?php
}

add_action('wp_footer', 'port_jquery');

include( plugin_dir_path( __FILE__ ) . 'custom-data.php');
include( plugin_dir_path( __FILE__ ) . 'shortcode-data.php');
?>