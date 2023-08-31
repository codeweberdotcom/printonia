<?php 
add_shortcode( 'basemodels', 'shortcode_basemodels' );

function shortcode_basemodels($atts) {
    $atts = shortcode_atts( array(
		'ids' => '',
	), $atts );
	ob_start();

$ids = $atts['ids'];
if($ids) : 
$params = array('posts_per_page' => 20, 'post__in' => [ $ids ], 'post_type' => 'product', 'post_status' => 'publish', 'product_cat' => 'bazovye-modeli'); // (1)
else :
$params = array('orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => 20, 'post_type' => 'product', 'post_status' => 'publish', 'product_cat' => 'bazovye-modeli'); // (1)
endif;

$wc_query = new WP_Query($params); // (2)
?>


<?php if ($wc_query->have_posts()) : // (3) ?>
<section class="wrapper bg-light">
  <div class="container py-14 pt-md-16">
	<div class="row g-4 isotope">	
<?php while ($wc_query->have_posts()) : ?>
     <?php $wc_query->the_post();  ?>
    <?php global $product;?>
    <?php global $post; ?>
<div class="col-md-12 project item">
	
<div class="card base_model_item">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-9 align-self-center mb-5 mb-lg-0">
            <h2 class="text-dark h2 post-title mb-3"><?php the_title(); ?></h2>
			  
			   <p class="mb-6 text-dark">
				<?php 
                 $description = get_field( 'tekst_dlya_arhiva' );
	 echo $description;
			  ?></p>
			  <div class="d-flex flex-row align-items-center">
			  <?php if ( have_rows( 'czvet' ) ) {
			 while ( have_rows( 'czvet' ) ){ the_row(); 
		$base_models_color = get_sub_field( 'czvet' ); ?>
	<span class="avatar w-7 h-7 me-1 border border-soft-navy" style="background: <?php echo $base_models_color; ?>"></span>
<?php } ?>
          <?php } ?>
			  </div>
			  <?php  
global $product;
$WC_Cart = new WC_Cart(); ?>
	  
<hr class="my-4" />
			  
			  
			  
<a href="<?php echo get_permalink(); ?>" class="btn btn-expand btn-primary rounded-pill">
	<i class="uil uil-arrow-right"></i>
	<span>Розница <?php echo $WC_Cart->get_product_price( $product ); ?></span>
</a>
			    
           
	
			  
          </div>
          <!-- /column -->
          <div class="col-lg-3 align-self-center">
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id()), 'sandbox_about_4' );?>
            <figure><img class="img-fluid rounded" src="<?php  echo $image[0]; ?>" srcset="<?php  echo $image[0]; ?>" alt="" /></figure>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!--/.card-body -->
    </div>
    <!--/.card -->
	  </div>  

		
		

<?php endwhile; ?>
 </div>  
   </div>
	</section>
<?php wp_reset_postdata(); // (5) ?>
<?php else:  ?>
<p>
     <?php _e( 'No Products' ); // (6) ?>
</p>
<?php endif; 

	return ob_get_clean();
}