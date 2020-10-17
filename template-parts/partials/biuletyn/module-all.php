<div class="under_content">

    <?php // INNE WIADOMOŚCI Z KATEGORII
        get_template_part( 'template-parts/partials/biuletyn/module', 'wiadomosci_z_kategorii' ); ?>

</div><!--.under_content-->

<?php // TEKSTY I MATERIAŁY O KSIĄŻCE W BIBLIOTECE
if (has_term(array('zapowiedzi', 'premiery'), 'biuletyn_kategorie')) {
    get_template_part( 'template-parts/partials/biuletyn/module', 'materialy'  );
}
?> 