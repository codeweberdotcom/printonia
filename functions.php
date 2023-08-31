<?php
/*
 * This is the child theme for Codeweber theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action('wp_enqueue_scripts', 'printonia_enqueue_styles');
function printonia_enqueue_styles()
{
   wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
   wp_enqueue_style(
      'child-style',
      get_stylesheet_directory_uri() . '/style.css',
      array('parent-style')
   );
}
/*
 * Your code goes below
 */


// --- New Gutenberg Block Layout Codeweber---
if (!function_exists('checkCategoryOrder')) {
   function checkCategoryOrder($categories)
   {
      //custom category array
      $temp = array(
         'slug'  => 'codeweber',
         'title' => 'Codeweber Blocks'
      );
      $temp_1 = array(
         'slug'  => 'codeweber_elements',
         'title' => 'Codeweber Elements'
      );
      $temp_2 = array(
         'slug'  => 'child_blocks',
         'title' => 'Child Blocks'
      );
      //new categories array and adding new custom category at first location
      $newCategories = array();
      $newCategories[0] = $temp;
      $newCategories[1] = $temp_1;
      $newCategories[2] = $temp_2;
      //appending original categories in the new array
      foreach ($categories as $category) {
         $newCategories[] = $category;
      }
      //return new categories
      return $newCategories;
   }
}
add_filter('block_categories_all', 'checkCategoryOrder', 99, 1);



// --- ACF Flexible Block
add_action('acf/init', 'my_acf_blocks_init_child');
function my_acf_blocks_init_child()
{

   // Register Child blocks.
   acf_register_block_type(array(
      'name'              => 'childs_blocks',
      'title'             => __('Child blocks'),
      'description'       => __('Child blocks flexible block.'),
      'render_template'   => 'templates/flexible-content/child_blocks.php',
      'category'          => 'child_blocks',
      'align'           => 'full',
      'supports'        => array(
         'align'        => array('full'),
         'align'        => true,
      ),
      'mode' => 'preview',

   ));
};

add_filter('wc_product_sku_enabled', '__return_false');

// Бланковые модели
function icon_base_models_block()
{
   if (is_object_in_term(get_the_ID(), 'product_cat', 'bazovye-modeli')) { ?>
      <?php if (get_field('ikonka') || get_field('ikonka_2')) { ?>
         <div class="w-100 row g-3 mb-3 icon-block position-absolute zindex-1 bottom-0 ps-3">
            <?php if (get_field('ikonka')) { ?>
               <div class="col-6">
                  <div class="card card-body p-2">
                     <span class="d-flex flex-row align-items-center">
                        <span class="mb-2 mb-md-0 d-flex align-items-center ">
                           <span class="avatar text-white w-7 h-7 fs-17 me-3"><?php if (get_field('ikonka')) { ?>
                                 <img src="<?php the_field('ikonka'); ?>" />
                              <?php } ?></span>
                        </span>
                        <span class="mb-2 mb-md-0 d-flex align-items-center fs-14 lh-2">
                           <?php the_field('tekst_k_ikonke_1'); ?>
                        </span>
                     </span>
                  </div>
               </div>
            <?php } ?>
            <?php if (get_field('ikonka_2')) { ?>
               <div class="col-6">
                  <div class="card card-body p-2">
                     <span class=" d-flex flex-row align-items-center">
                        <span class="mb-2 mb-md-0 d-flex align-items-center ">
                           <span class="avatar text-white w-7 h-7 fs-17 me-3"><?php if (get_field('ikonka_2')) { ?>
                                 <img src="<?php the_field('ikonka_2'); ?>" />
                              <?php } ?></span>
                        </span>
                        <span class="mb-2 mb-md-0 d-flex align-items-center fs-14 lh-2">
                           <?php the_field('tekst_k_ikonke_2'); ?>
                        </span>
                     </span>
                  </div>
               </div>
            <?php } ?>
         </div>
      <?php
      }
   }
}

add_action('codeweber_woo_product_main_image_start', 'icon_base_models_block', 25);

function price_block()
{
   if (is_object_in_term(get_the_ID(), 'product_cat', 'bazovye-modeli')) {
      add_filter('wc_product_sku_enabled', '__return_false');
      ?>
      <div class="alert alert-dark alert-icon mt-4" role="alert"><i class="uil uil-map-marker-info"></i><?php the_field('tekst_k_czene'); ?>
      </div>


   <?php
      /**
       * Remove product page tabs
       */
      add_filter('woocommerce_product_tabs', 'my_remove_all_product_tabs', 98);

      function my_remove_all_product_tabs($tabs)
      {
         unset($tabs['description']);        // Remove the description tab
         unset($tabs['reviews']);       // Remove the reviews tab
         unset($tabs['additional_information']);    // Remove the additional information tab
         return $tabs;
      }
   };
}

add_action('woocommerce_single_product_summary', 'price_block', 30);


//Обертка card card-body для цены товара
function woo_card()
{
   ?>
   <div class="card card-body">
   <?
}
add_action('woocommerce_before_add_to_cart_form', 'woo_card', 1);
function woo_card_1()
{
   ?>
   </div>
   <?
}
add_action('woocommerce_after_add_to_cart_form', 'woo_card_1', 100);



//Base Model Description
function base_model_description()
{
   $product_instance = wc_get_product(get_the_ID());
   $product_full_description = $product_instance->get_description();
   $product_short_description = $product_instance->get_short_description();

   //Get Product Attributes Function	
   function cw_woo_attribute()
   {
      global $product;
      $attributes = $product->get_attributes();
      if (!$attributes) {
         return;
      }
      $display_result = '';
      $display_result .= '<table class="table">';
      foreach ($attributes as $attribute) {
         $display_result .= '<tr>';
         $name = $attribute->get_name();
         if ($attribute->is_taxonomy()) {
            $terms = wp_get_post_terms($product->get_id(), $name, 'all');
            $cwtax = $terms[0]->taxonomy;
            $cw_object_taxonomy = get_taxonomy($cwtax);
            if (isset($cw_object_taxonomy->labels->singular_name)) {
               $tax_label = $cw_object_taxonomy->labels->singular_name;
            } elseif (isset($cw_object_taxonomy->label)) {
               $tax_label = $cw_object_taxonomy->label;
               if (0 === strpos($tax_label, 'Product ')) {
                  $tax_label = substr($tax_label, 8);
               }
            }

            $display_result .= '<td>' . $tax_label . '</td>';
            $tax_terms = array();
            foreach ($terms as $term) {
               $single_term = esc_html($term->name);
               array_push($tax_terms, $single_term);
            }
            $display_result .= '<td>' . implode(', ', $tax_terms) . '</td>';
         } else {
            $display_result .= $name;
            $display_result .= esc_html(implode(', ', $attribute->get_options())) . '</td>';
         }
         $display_result .= '</tr>';
      }
      $display_result .= '</table>';
      return $display_result;
   }
   add_action('woocommerce_single_product_summary', 'cw_woo_attribute', 25);
   if (is_object_in_term(get_the_ID(), 'product_cat', 'bazovye-modeli')) {

   ?>

      <section class="wrapper bg-light">

         <div class="row gy-7">
            <?php if ($product_full_description) { ?>
               <div class="col-lg-4">
                  <div class="card h-100">
                     <div class="card-body">
                        <h2 class="mb-4">Описание базовой модели</h2>
                        <p><?php echo $product_full_description; ?></p><?php
                                                                        $button_video = new CW_Buttons('<div class="d-flex justify-content-center justify-content-lg-start flex-wrap" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">%s</div>', NULL, NULL, NULL);
                                                                        echo '<div class="mb-2">' . $button_video->final_buttons . '</div>'; ?>
                     </div>
                  </div>
               </div>
            <?php } ?>
            <?php if (cw_woo_attribute()) { ?>
               <div class="col-lg-8">
                  <div class="card h-100">
                     <div class="card-body overflow-auto">
                        <h2 class="mb-4">Характеристики</h2>
                        <?php echo cw_woo_attribute(); ?>
                     </div>
                  </div>
               </div>
            <?php } ?>

            <div class="col-lg-8">
               <div class="card h-100">
                  <div class="card-body">
                     <h2 class="mb-4">Размерная сетка</h2>
                     <div class="row">
                        <div class="col-md-5">
                           <?php if (get_field('razmernaya_setka_vneshnij_vid')) : ?>
                              <figure class="mb-6 mb-lg-0">
                                 <img src="<?php the_field('razmernaya_setka_vneshnij_vid'); ?>" srcset="<?php the_field('razmernaya_setka_vneshnij_vid'); ?>" alt="">
                              </figure>
                           <?php endif ?>
                        </div>

                        <div class="col-md-7">
                           <?php if (get_field('razmernaya_setka_tablica')) : ?>
                              <figure>
                                 <img src="<?php the_field('razmernaya_setka_tablica'); ?>" srcset="<?php the_field('razmernaya_setka_tablica'); ?>" alt="">
                              </figure>
                              <p class="">* погрешность в размерах + - 2см</p>


                           <?php endif ?>
                        </div>
                     </div>


                  </div>
               </div>
            </div>
            <?php if (get_field('usloviya_po_uhodu_text') || get_field('usloviya_po_uhodu')) { ?>
               <div class="col-lg-4">
                  <div class="card h-100">
                     <div class="card-body">
                        <h2 class="mb-4">Условия по уходу</h2>
                        <?php if (get_field('usloviya_po_uhodu_text')) { ?>
                           <p><?php the_field('usloviya_po_uhodu_text'); ?></p>
                        <?php } ?>
                        <?php if (get_field('usloviya_po_uhodu')) : ?>
                           <figure>
                              <img src="<?php the_field('usloviya_po_uhodu'); ?>" srcset="<?php the_field('usloviya_po_uhodu'); ?>" alt="">
                           </figure>
                        <?php endif ?>
                     </div>
                  </div>
               </div>
            <?php } ?>
         </div>
      </section>
<?php
   }
}

add_action('woocommerce_after_single_product_summary', 'base_model_description', 0);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_before_add_to_cart_form', 'woocommerce_template_single_price', 10);

include_once('shortcodes.php');



add_action('codeweber_pageheader_after_title', 'codeweber_pageheader_after_title');

function codeweber_pageheader_after_title()
{
   if (is_woocommerce()) {
      echo '<p class="lead fs-lg pe-lg-15 pe-xxl-12 text-white">Все принты из нашего каталога мы изготавливаем индивидуально для вас после размещения заказа. Срок изготовления 2-5 рабочих дней</p>';
   }
}
