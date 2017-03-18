<?php get_header(); ?>

<main role="main">
<?php
  if (have_posts()):
    while (have_posts()): the_post();
      // Loop code
      the_content();
    endwhile;
  endif;
  wp_footer();
?>
</main>

<?php get_footer(); ?>

