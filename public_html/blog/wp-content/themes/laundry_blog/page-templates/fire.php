<?php
/*
 *  Template Name: fire
 * 
 * */
 ?>

    <link href="<?php bloginfo('stylesheet_directory'); ?>/css/fireworks.css" rel="stylesheet">
  </head>
    <!-- Hiding library elements in the DOM is fun -->
    <aside id="library">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/nightsky.png" id="nightsky" />
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/big-glow.png" id="big-glow" />
      <img src="<?php bloginfo('stylesheet_directory'); ?>/images/small-glow.png" id="small-glow" />
    </aside>
  </body>
  <script src="<?php bloginfo('stylesheet_directory'); ?>/js/requestanimframe.js"></script>
  <script src="<?php bloginfo('stylesheet_directory'); ?>/js/fireworks.js"></script>
