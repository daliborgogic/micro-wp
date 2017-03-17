<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <title></title>
  <?php wp_head(); ?>
  </head>
  <body>
  <?php
    if (have_posts()):
      while (have_posts()): the_post();
        // Loop code
        the_content();
      endwhile;
    endif;
    wp_footer();
  ?>
  </body>
</html>
