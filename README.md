# Wordpress-Post-Jquery-Tab

Here are sample snippites on how to create jquery tab shortcode base on post type or post

1. Generate a query 
```php
// WP_Query arguments
$args = array (
	'post_type'              => array( 'posts' ),
	'page_per_post'          => '4'
	'order'                  => 'ASC',
	'orderby'                => 'none',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		// do something
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
```
2. Create a Shortcode
```php
// Add Shortcode
function custom_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'post_type' => 'post',
			'page_per_post' => '4',
		), $atts )
	);
}
add_shortcode( 'post_tab', 'custom_shortcode' );
```

3. then insert the post type insde short code
```php
// Add Shortcode
function custom_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'post_type' => 'post',
			'page_per_post' => '4',
		), $atts )
	);
// WP_Query arguments
$args = array (
	'post_type'              => array( 'posts' ),
	'page_per_post'          => '4'
	'order'                  => 'ASC',
	'orderby'                => 'none',
);

// The Query
$query = new WP_Query( $args );

// The Loop 1
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		the_title()
	}
} else {
	// no posts found
}

// The Loop 2
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		the_content()
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();

}
add_shortcode( 'post_tab', 'custom_shortcode' );
```
4. Then add the css and javascript
```php
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
```

Thats its and good luck 
