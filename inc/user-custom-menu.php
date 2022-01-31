<?php

// Adicionar novo menu

function bar800k_custom_menu($menu_links){
    $menu_links = array_slice($menu_links,0,5,true)
        + ['pagar' => 'Pagar com PIX',]
        + array_slice($menu_links, 5, null, true);

    unset($menu_links['downloads']);

    return $menu_links;
}
add_filter('woocommerce_account_menu_items', 'bar800k_custom_menu');

function bar800k_add_endpoint(){
    add_rewrite_endpoint('pagar', EP_PAGES);
}
add_action('init', 'bar800k_add_endpoint');

function bar800k_pagar_com_pix(){
?>

    <p>Pague aqui</p>

    <?php if (function_exists('current_customer_month_count')) { ?>
        <?php echo "R$ ".$customer_current_month_orders = current_customer_month_count(); ?>
    <?php } ?>

<?php
}
add_action('woocommerce_account_pagar_endpoint', 'bar800k_pagar_com_pix');

flush_rewrite_rules();