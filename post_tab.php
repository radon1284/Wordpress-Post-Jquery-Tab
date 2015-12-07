<?php
function dynamic_shortcode( $atts ) {
    ob_start();
$query = new WP_Query( array(
        'post_type' => 'sections',
		'order' => 'ASC',
		'posts_per_page' => -1,
    ) );
    if ( $query->have_posts() ) { ?>
    <style>
	.ui-tabs-vertical .ui-tabs-nav li {
		width:auto !important;
		}
		li.ui-state-default, li.ui-corner-left {
			background-color: #439bf4;
		}
		.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active {
    	border: 1px solid #fff;
    	border-radius: 5px;
    	display: inline-block !important;
    	margin: 0 0.5%;
    	padding: 2%;
			}
		 li.ui-state-active {
		background-color: #68D6ED;
		 }
    </style>
<div id="tabs">
<ul class="tab-nav">
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
<li><a href="#post-<?php echo get_the_ID(); ?>"><?php the_title(); ?></a></li>
  <?php endwhile; ?>
 </ul>
<?php 
    }
	
    if ( $query->have_posts() ) { ?>
  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
  
    
  <div id="post-<?php echo get_the_ID(); ?>" data-id="post-<?php echo get_the_ID(); ?>" data-type="<?php echo custom_taxonomy_terms_slugs('nvtype'); ?>">
    <div class="one-third">
      <?php the_field('left_content'); ?>
    </div>
    <div class="two-third">
      <?php the_field('right_content'); ?>
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
