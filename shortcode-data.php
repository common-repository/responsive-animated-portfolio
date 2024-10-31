<?php
function section_port_shortcode( $atts ) {
extract( shortcode_atts( array( 'limit' => -1, 'type' => 'post', 'width' => '400px', 'height' => '400px', 'column' => '3'), $atts ) );
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
query_posts(  array ( 
    'posts_per_page' => $limit, 
    'post_type' => portfolio,  
    'order' => 'ASC', 
    'orderby' =>'menu_order', 
    'paged' => $paged ) );

$list = ' ';   
$i=1;
while ( have_posts() ) {
    the_post();    $terms = get_the_terms( $post->ID, 'port_tags' );
    $terms_string = '';
    if ( $terms ) {
        foreach ( $terms as $term )
            $terms_string .= $term->slug . ' ';
    }    $string = get_the_content('');
    $newString = substr($string, 0, 50);
    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    $list .= '<li class="slide'.$i.'">' 
    . '<a href="#"><img src="'. $feat_image . '" style="width:'. $width.';height:'. $height.';"/>'
    . '	<div class="gal-port-imgs">'
    . '<img src="'. $feat_image . '" style="width:'. $width.';height:'. $height.';" alt=""/>'
	
	.'</div>'
	.'<div class="image-text text-center">'
    . '<h4>'. get_the_title() .'</h4>';	
	
    $tags = get_the_tags($post->ID);	
	$list .= '<div class="gray-letters gray-border-top inline-block">';	
	foreach ( $tags as $tag )    
	{      
	$list .= $tag->name.',';	 
	}	   
	$list .= '</div>';
	$list .=  '</div>';  
	$list .= '</a>';  
	$list .= '</li>';	
	$i++;
}
return 
'<div id="main">'
.'<div class="full-width-container white-bg">' 
.'<div class="gallery-main-wrap">'
.'<div class="gallery-inner-wrap">'
.'<ul id="grid" class="margin0 padding0 no-style square-portfolio columns-'. $column . '">'
.$list
.'</ul>'
.'<div class="clearfix"></div>'
. '</div>'
. '</div>'
. '</div>'
. '</div>'.

wp_reset_query();

}

add_shortcode( 'pre-portfolio', 'section_port_shortcode' );
?>