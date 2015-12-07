<?php
function dynamic_shortcode( $atts ) {
    ob_start();
$query = new WP_Query( array(
        'post_type' => 'post',
	'order' => 'ASC',
	'posts_per_page' => -1,
    ) );
    if ( $query->have_posts() ) { ?>
<div id="tabs">
<ul class="tab-nav">
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
<li><a href="#post-<?php echo get_the_ID(); ?>"><?php the_title(); ?></a></li>
  <?php endwhile; ?>
 </ul>
<?php }
    if ( $query->have_posts() ) { ?>
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
  <div id="post-<?php echo get_the_ID(); ?>">
    <div class="the-content">
      <?php the_content(); ?>
    </div>

  </div>
  <?php endwhile;
            wp_reset_query(); ?>
</div>
<?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
add_shortcode( 'dynamic_section', 'dynamic_shortcode' );

// Jquery UI tab

// Register Script
function custom_scripts() {

	wp_register_script( 'jquery-ui', '//code.jquery.com/ui/1.11.4/jquery-ui.js', false, false, true );
	wp_enqueue_script( 'jquery-ui' );

	wp_register_script( 'jquery-1.10.2', '//code.jquery.com/jquery-1.10.2.js', false, false, true );
	wp_enqueue_script( 'jquery-1.10.2' );

}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );
  
// Register Style
function custom_styles() {

	wp_register_style( 'style_name', get_template_directory_uri() . '/resources/demos/style.css', false, false );
	wp_enqueue_style( 'style_name' );

	wp_register_style( 'jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css', false, false );
	wp_enqueue_style( 'jquery-ui' );

}
add_action( 'wp_enqueue_scripts', 'custom_styles' );

  
  // Adding Script into Foote php
  function add_script(){ ?>
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
  <?php }
add_action('wp_footer', 'add_script');
