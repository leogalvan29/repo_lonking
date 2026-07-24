<?php 

/*
*Template Name: Home
*/
?>
<?php  get_header()  ?>

<?php echo get_template_part('template-parts/hero-home') ?>

<?php echo get_template_part('template-parts/amex360-home') ?>

<?php echo get_template_part('template-parts/destacados-home') ?>

<?php echo get_template_part('template-parts/servicios-home') ?>

<?php echo get_template_part('template-parts/catalogo-home') ?>

<?php echo get_template_part('template-parts/cta-final-home') ?>

<!-- <?php

   $args = [
       'post_type' => 'product',
       'posts_per_page' => 10,
       'post_status' => 'publish'
   ];

   $products = new WP_Query($args); ?> 

   <?php  while($products->have_posts()):$products->the_post(); ?>

            <h1><?php  the_title()  ?></h1>

   <?php  endwhile;  ?>

   <?php wp_reset_postdata()  ?> -->

<?php get_template_part('template-parts/quote-modal') ?>

<?php get_footer() ?>