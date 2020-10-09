<?php // KSIĄŻKI
    get_template_part( 'template-parts/partials/module', 'ksiazki_lista' ); ?>

<div class="clearfix"></div>

<?php // PROJEKTY
    get_template_part( 'template-parts/partials/biuletyn/module', 'projekty' ); ?>
  
<div class="clearfix"></div>
  
<div class="under_content">

    <?php // INNE WIADOMOŚCI Z KATEGORII
        get_template_part( 'template-parts/partials/biuletyn/module', 'wiadomosci_z_kategorii' ); ?>

</div><!--.under_content-->