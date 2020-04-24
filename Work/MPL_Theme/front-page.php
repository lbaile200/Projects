<?php get_header();?>

<div class="banner"> 
<img alt="" src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>">
</div>


<div class="container">



<?php if (have_posts()) : while (have_posts()) : the_post();?>

    <?php the_content();?>

<?php endwhile; endif;?>


</div>


<?php get_footer();?>
