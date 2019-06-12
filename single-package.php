<?php
/**
 * The template for displaying all single posts.
 *
 * @package Bootstrap to WordPress
 */

get_header(); ?>
<div class="breadcrumbs-box">
<div class="container">
<header class="entry-header">
		<center style="color:#ffffff;"><?php the_title( '<h2 class="entry-title">', '</h2>' ); ?></center>
</header><!-- .entry-header -->
</div>
</div>

	<!-- BLOG CONTENT
	================================================== -->
<section class="box white">	
			<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
			<div class="row">
			<div class="col-sm-12 no-padding">
			<div class="thumnail-sigle-package" style="background:url('<?php echo $featured_img_url; ?>');"> </div>
			
			</div>
			<div class="col-sm-8 white-sadow">

	<br>


<?php the_content(); ?>
				   <?php edit_post_link(); ?>
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
			
			<!-- SIDEBAR
			================================================== -->

		<?php if ( is_active_sidebar( 'single-package' ) ) : ?>
		<div class="col-sm-4 side-siggle">
    <?php dynamic_sidebar( 'single-package' ); ?>
	</div>
<?php endif; ?>
	
</div><!-- .row -->
	</div><!-- .container -->
</section>
<

<!-- costum loop untuk artikel terkait, isa -->
 
        <?php
        // get the custom post type's taxonomy terms
          
        $custom_taxterms = wp_get_object_terms( $post->ID, 'package_category', array('fields' => 'ids') );
 
        $args = array(
            'post_type' => 'package',
            'post_status' => 'publish',
            'posts_per_page' => 10, // you may edit this number
            'orderby' => 'rand',
            'post__not_in' => array ( $post->ID ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'package_category',
                    'field' => 'id',
                    'terms' => $custom_taxterms
                )
            )
        );

        $related_items = new WP_Query( $args ); ?>
		
					
			

<div class="container">	
<h4>Paket Tour Lainnya</h4>
	<div class="loop owl-carousel owl-theme">
	 <?php       // loop over query
        if ( $related_items->have_posts() ) : ?>
<?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>	
 <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>	
 <?php $durasi = get_post_meta( get_the_ID(), 'durasi', true ); ?>
		<div class="item">
			<div class="thumbnail">
 
				<div class="thumbnail-image">
					<div class="thumbnail-overlay"></div>   
						<img class="gambarpaket2" src="<?php echo $featured_img_url; ?>">
				</div>

			<div class="card-body">
				<div class="judul-utama center"><h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2></div>
				<div class="package_duration"> <i class="fa fa-tag" aria-hidden="true"></i> <?php $durasi = get_post_meta( get_the_ID(), 'durasi', true );
// Check if the custom field has a value.
if ( ! empty( $durasi ) ) {
    echo $durasi;
} ?>					</div>		
				<div class="card-text">	
<?php the_excerpt(); ?></div>							
			</div>
			</div>

		</div>
	<?php endwhile; ?>
	</div>


</div>

 <?php endif;
        // Reset Post Data
        wp_reset_postdata();
        ?> 
  
<!-- end custom related loop, isa -->
<script>
            jQuery(document).ready(function($) {
              $('.loop').owlCarousel({
                center: true,
                items: 4,
                loop: true,
                margin: 15,
                responsive : {
    // breakpoint from 0 up
    0 : {
        items: 1,
    },
    // breakpoint from 480 up
    480 : {
       items: 1,
    },
    // breakpoint from 768 up
    768 : {
        items: 3,
    }
}
              });
              $('.nonloop').owlCarousel({
                center: true,
                items: 2,
                loop: false,
                margin: 10,
                responsive: {
                  600: {
                    items: 4
                  }
                }
              });
            });
          </script>
<?php get_footer(); ?>
