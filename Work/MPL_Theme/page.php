<?php get_header();?>

<div class="banner">
<?php if(has_post_thumbnail()):?>

<img src="<?php the_post_thumbnail_url('largest');?>" class="img-fluid">

<?php endif;?></div>

<div class="container">

    <div class="posts">


<?php if (have_posts()) : while (have_posts()) : the_post();?>

    <?php the_content();?>

<?php endwhile; endif;?>

</div>
</div>


<?php get_footer();?>
