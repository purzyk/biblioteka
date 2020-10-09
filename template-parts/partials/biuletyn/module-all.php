<div class="under_content">

    <?php // POBIERZ INFORMACJE O KSIĄŻCE Z CPT KSIĄŻKI-LISTA
        get_template_part( 'template-parts/partials/biuletyn/module', 'book_info' ); ?>

    <?php // KSIĄŻKI Z SERII POEZJA W POEZJEM.PL
        get_template_part( 'template-parts/partials/biuletyn/module', 'seria_poezjem' ); ?>

    <?php // RELACJE Z WYDARZEŃ
        get_template_part( 'template-parts/partials/biuletyn/module', 'relacje_z_wydarzen' ); ?>

    <?php // INNE WIADOMOŚCI Z KATEGORII
        get_template_part( 'template-parts/partials/biuletyn/module', 'wiadomosci_z_kategorii' ); ?>

</div><!--.under_content-->

<?php // TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE
    get_template_part( 'template-parts/partials/biuletyn/module', 'materialy'  ); ?>

<?php // KSIĄŻKI
    get_template_part( 'template-parts/partials/module', 'ksiazki_lista' ); ?>

<div class="clearfix"></div>
<?php // PROJEKTY
    get_template_part( 'template-parts/partials/biuletyn/module', 'projekty' ); ?>