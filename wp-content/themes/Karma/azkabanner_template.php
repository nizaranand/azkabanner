<?php
/*
Template Name: Azkabanner main
*/
?>
<?php get_header(); ?>
</div><!-- header-area -->
</div><!-- end rays -->
</div><!-- end header-holder -->
</div><!-- end header -->

<?php truethemes_before_main_hook();// action hook, see truethemes_framework/global/hooks.php 
$current_user = wp_get_current_user();//user object 
?>

<div id="main">
<?php get_template_part('theme-template-part-tools','childtheme'); ?>
			
			
<div class="main-holder">
<?php  
//retrieve value for sub-nav checkbox
global $post;
$post_id = $post->ID;
$meta_value = get_post_meta($post_id,'truethemes_page_checkbox',true);

if(empty($meta_value)){
get_template_part('theme-template-part-subnav-horizontal','childtheme');}else{
// do nothing
}
?>

<div id="content" class="portfolio_full_width">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; ?>

<?php 

if ( 0 == $current_user->ID ) {
	echo "Not logged in";
}
else{
	include(AZKBN_TPL_DIR . '/tpl_main.php'); 
}
?>

<div class="port_sep"><div class="hr_top_link"></div></div><!-- end port_sep -->


<?php  wp_pagenavi();  ?>
</div><!-- end content -->
</div><!-- end main-holder -->
</div><!-- main-area -->

<?php get_footer(); ?>