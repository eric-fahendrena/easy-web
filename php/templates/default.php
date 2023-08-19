<?php
/**
 * To personalize the template, it's better to define first the following variables from the file that include this file.
 */
$t_TITLE = (!isset($t_TITLE)) ? 'Untitled' : $t_TITLE;
$t_CONTENT = (!isset($t_CONTENT)) ? '' : $t_CONTENT;
$t_OPEN_GRAPH = array(
   'title' => (isset($t_OPEN_GRAPH['title'])) ? $t_OPEN_GRAPH['title'] : NULL,
   'description' => (isset($t_OPEN_GRAPH['description'])) ? $t_OPEN_GRAPH['description'] : NULL,
   'image' => (isset($t_OPEN_GRAPH['image'])) ?  $t_OPEN_GRAPH['image'] : NULL,
   'url' => (isset($t_OPEN_GRAPH['url'])) ? $t_OPEN_GRAPH['url'] : NULL
);

ob_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="max-width=device-width, initial-scale=1.0">
<?php 
foreach ($t_OPEN_GRAPH as $og_prop => $og_content): 
   if ($og_content !== null): 
?>
      <meta property="og:<?=$og_prop?>" content="<?=$og_content?>">
<?php 
   endif;
endforeach; 
?>
      <title><?=$t_TITLE?></title>
      <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
   </head>
   <body>
   <!-- Add header -->
<div class="container">
<?=$t_CONTENT?>
</div>
   <!-- Add footer -->
<script src="../../assets/js/main.js"></script>
   </body>
</html>

<?php
return ob_get_clean();
?>
