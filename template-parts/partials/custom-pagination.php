<!-- pagination -->
<?php
$previous_link_img = '<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_left_grey.png" />';
$next_link_img = '<img src="https://www.biuroliterackie.pl/biblioteka/wp-content/themes/biblioteka/img/pagination_lright_grey.png" />';

$cur_page = intval(get_query_var('paged'));
if ($cur_page == 0)
{
    $cur_page = 1;
}
$previous_link = add_query_arg( 'paged', ($cur_page - 1) );
$next_link = $cur_page + 1;

if ( $cur_page == $wp_query->max_num_pages )
{
    $next_link = "";
}

if ( $cur_page == 2 )
{
    $previous_link = remove_query_arg( 'paged' );
}
?>
<div class="pagination_links">
    <div class="pagination">
        <span>

        <?php if ( !empty($_GET['paged']) ) : ?>
        <a href="<?php echo $previous_link; ?>">
        <?php echo $previous_link_img; ?>
        </a>
        <?php endif; //$cur_page != 1 || $cur_page != 0 ?>

        <span><?php echo $cur_page; ?>/<?php echo $wp_query->max_num_pages; ?></span>

        <?php if ( $cur_page != $wp_query->max_num_pages ) : ?>
        <a href="<?php echo add_query_arg( 'paged', $next_link ); ?>" title="następna strona">
        <?php echo $next_link_img; ?>
        </a>
        <?php endif; //$cur_page == $wp_query->max_num_pages ?>

        </span>
    </div>
</div>