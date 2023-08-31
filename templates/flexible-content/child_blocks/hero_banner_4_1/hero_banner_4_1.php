<?php

/**
 * Hero 3_1
 */
$block = new CW_Settings(
  $cw_settings = array(
    'title' => 'I\'m User Interface Designer & Developer.',
    'patternTitle' => '<h1 class="display-1 mb-5">%s</h1>',

    'buttons' => '<div class="d-flex justify-content-center justify-content-lg-start flex-wrap flex-wrap" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900"><span><a href="#" class="btn btn-lg btn-primary rounded-pill me-2">See My Works</a></span><span><a href="#" class="btn btn-lg btn-outline-primary rounded-pill">Contact Me</a></span></div>',
    'buttons_pattern' => '<div class="d-flex justify-content-center justify-content-lg-start flex-wrap flex-wrap" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">%s</div>',

    'background_class_default' => 'wrapper bg-gray',

    'divider' => true,

    'swiper' => array(
      'swiper_container_class' => 'w-100',
      'image_class' => 'w-auto',
      'wrapper_image_class' => '',
      'image_pattern' => '<figure %5$s %9$s>%6$s<img %4$s src="%1$s" srcset="%1$s" %3$s />%7$s %10$s %11$s</figure>',
      'image_thumb_size' => 'sandbox_hero_3',
      'image_demo' => '<div class="img-mask mask-1"><img src="' . get_template_directory_uri() . '/dist/img/photos/about17.jpg" srcset="' . get_template_directory_uri() . '/dist/img/photos/about17@2x.jpg 2x" alt="" /></div><div class="card shadow-lg position-absolute" style="bottom: 10%; right: 2%;"><div class="card-body py-4 px-5"><div class="d-flex flex-row align-items-center"><div><img src="' . get_template_directory_uri() . '/dist/img/icons/lineal/check.svg" class="svg-inject icon-svg icon-svg-sm text-primary mx-auto me-3" alt="" /></div><div><h3 class="counter mb-0 text-nowrap">250+</h3><p class="fs-14 lh-sm mb-0 text-nowrap">Projects Done</p></div></div></div><!--/.card-body --></div><!--/.card -->',
      'image_big_size' => 'project_1',
      'img_link' => '/dist/img/photos/about17.jpg',
      'data_margin' => '30',
      'nav' => 'true',
      'nav_color' => NULL,
      'nav_position' => NULL,
      'dots' => 'false',
      'dots_color' => NULL,
      'dots_position' => NULL,
      'swiper_effect' => NULL,
      'base_items' => '1',
      'items_xs' => '1',
      'items_sm' => '1',
      'items_md' => '1',
      'items_lg' => '1',
      'items_xl' => '1',
      'items_xxl' => '1',
      'autoplay' => 'false',
      'autoplay_time' => '3000',
      'loop' => 'false',
      'autoheight' => 'false',
      'image_shape' => 'img-mask mask-1',
    ),

    'label_demo' => '<div class="card shadow-lg" style="bottom: 5rem; right: 5rem;"><div class="card-body py-4 px-5"><div class="d-flex flex-row align-items-center"><div><img src="' . get_template_directory_uri() . '/dist/img/icons/lineal/check.svg" class="svg-inject icon-svg icon-svg-sm text-primary mx-auto me-3" alt="" /></div><div><h3 class="counter mb-0 text-nowrap">250+</h3><p class="fs-14 lh-sm mb-0 text-nowrap">Projects Done</p></div></div></div><!--/.card-body --></div><!--/.card -->',

    'label_pattern' => '<div class="card shadow-lg position-absolute zindex-1 %6$s" %7$s><div class="card-body py-4 px-5"><div class="d-flex flex-row align-items-center"><div>%2$s</div><div><div class="counter mb-0 text-nowrap h3">%3$s</div><p class="fs-14 lh-sm mb-0 text-nowrap">%4$s</p>%5$s</div></div></div><!--/.card-body --></div><!--/.card -->',

    'features' => '<div class="col-12"><div class="d-flex flex-row"><div><div class="icon btn btn-circle btn-lg btn-soft-primary disabled me-5"><i class="uil uil-phone-volume"></i> </div></div><div><div class="mb-1 h4">24/7 Support</div><p class="mb-0">Nulla vitae elit libero pharetra augue dapibus.</p></div></div></div><!--/column -->',
    'features_pattern' => '<div class="col-12 %1$s"><div class="d-flex flex-row"><div>%2$s</div><div><div class="h4 mb-1%9$s">%3$s</div><p class="mb-0%10$s">%4$s</p>%5$s</div></div></div><!--/column -->',
    'features_style_icon' => 'disabled me-5',

    'column_class_1' => '',
    'column_class_2' => 'order-lg-2 offset-lg-1',
  )
);
?>

<section id="<?php echo esc_html($args['block_id']); ?>" class="<?php echo $block->section_class; ?> <?php page_frame_banner(); ?> <?php echo esc_html($args['block_class']); ?>" <?php echo $block->background_data; ?>>
  <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
    <div class="row gy-10 gy-md-13 gy-lg-0 align-items-center">
      <div class="col-md-8 col-lg-5 d-flex position-relative mx-auto <?php echo $block->column_class_1; ?>" data-cues="slideInDown" data-group="header">
        <?php echo $block->swiper_final; ?>
        <!--/swiper -->
      </div>
      <!--/column -->
      <div class="col-lg-5 text-center text-lg-start <?php echo $block->column_class_2; ?>" data-cues="slideInDown" data-group="page-title" data-delay="600">
        <?php echo $block->title; ?>
        <!--/title -->
        <?php // echo $block->paragraph; 
        ?>
        <!--/pargraph -->
        <div class="row gx-xl-10 gy-6 mb-6 text-start">
          <?php echo $block->features; ?>
          <!--/features -->
        </div>
        <!--/.row -->
        <?php echo $block->buttons; ?>
        <!--/buttons group -->
      </div>
      <!--/column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <?php if ($block->divider_wave) {
    echo $block->divider_wave;
  } ?>
  <!-- /divider -->
</section>
<!-- /section -->