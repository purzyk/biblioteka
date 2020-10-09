<?php
$terms = get_terms( 'ksiazki_litera' );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
<div class="row">
    <div class="col-md-12 autorzy-litera lato-font">
        <ul>
            <?php
            foreach ( $terms as $term ) :
            $active = "";
            if ( isset(get_queried_object()->term_id) && get_queried_object()->term_id == $term->term_id )
            {
                $active = "class='active'";
            }
            ?>
            <li>
                <a <?= $active ?> href="<?= esc_url( get_term_link( $term ) ) ?>"><?= $term->name ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>