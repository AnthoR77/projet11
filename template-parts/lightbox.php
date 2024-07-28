<div id="lightbox">
<button id="prev" class="prev">
  <img class="prevarrow" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/prec.svg'; ?>" alt="">
</button>
       <img src="" alt="" id="lightbox_img" data-index="0">
        <button id="lightbox_close"><img class="close" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/close.png'; ?>" alt=""></button>
        <button id="next" class="next">
  <img class="nextarrow" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/suivant.svg'; ?>" alt="">
</button>
        <div class="lightboxText">
                <div class="lightbox_ref"><?php echo get_field('Reference', get_the_ID()); ?></div>
                <div class="lightbox_cat"><?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie')); ?></div>
        </div>
</div>

