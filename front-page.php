<?php get_header() ?>
   <div class="banner">
   <h1 class="title">PHOTOGRAPHE EVENT </h1>
<?php 
$query= new WP_Query([
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'rand',
]);

 while ($query->have_posts()) : $query->the_post();
        ?>

            <?php the_content(); ?>

        <?php endwhile;
            wp_reset_postdata(); ?>
   </div>





  <form id="photoFilter">
  <div>
  <!-- <div class="custom-select" style="width:200px;"> -->
  <select  id="photoCategory">
    <option value="">CATEGORIES</option>
    <?php
    $categories = get_categories([
      'taxonomy' => 'categorie',
      'hide_empty' => false,
    ]);
    foreach ($categories as $category) :
    ?>
    <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
    <?php endforeach; ?>
  </select>
  <!-- </div> -->
  
  <!-- <div class="custom-select" style="width:200px;"> -->
<select id="photoFormat">
  <option value="">FORMATS</option>
  <?php
  $formats = get_terms([
    'taxonomy' => 'format',
    'hide_empty' => false,
  ]);
  foreach ($formats as $format) :
  ?>
  <option value="<?php echo $format->slug; ?>"><?php echo $format->name; ?></option>
  <?php endforeach; ?>
</select>
  <!-- </div> -->
  </div>
<div>
  <select id="photoOrderby">
    <option>TRIER PAR</option>
    <option value="date">Date</option>
    <option value="title">Titre</option>
  </select>
  </div>
</form>

<div id="phoapp">




</div>


</div>


<div class="center"><button class="btn-contact" id="loadMore">Charger plus</button></div>

    
<?php get_footer() ?>