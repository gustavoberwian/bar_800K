<?php

function bar800k_add_woocommerce_support(){
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'bar800k_add_woocommerce_support');

function bar800k_css(){
    wp_register_style('bar800k-style', get_template_directory_uri() . '/style.css', [], '1.0.6', false);
    wp_enqueue_style('bar800k-style');
}
add_action('wp_enqueue_scripts', 'bar800k_css');

function bar800k_custom_images(){
    add_image_size('slide', 1000, 800, ['center', 'top']);
    update_option('medium_crop', 1);
}
add_action('after_setup_theme', 'bar800k_custom_images');

function handel_loop_shop_per_page(): int{
    return 15;
}
add_filter('loop_shop_per_page', 'handel_loop_shop_per_page');

function format_products($products, $img_size = 'medium'){
    $products_final = [];
    foreach ($products as $product){
        $products_final[] = [
            'name' => $product->get_name(),
            'price' => $product->get_price_html(),
            'link' => $product->get_permalink(),
            'img' => wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
        ];
    }
    return $products_final;
}

function bar800k_product_list($products){ ?>
    <ul class="products-list">
        <?php foreach ($products as $product) { ?>
            <li class="product-item">
                <a href="<?=$product['link']; ?>">
                    <div class="product-info">
                        <img src="<?=$product['img']; ?>" alt="<?=$product['name']; ?>">
                        <h2><?=$product['name']; ?> - <span><?=$product['price']; ?></span></h2>
                    </div>
                    <div class="product-overlay">
                        <span class="btn-link" id="color-white">Ver mais</span>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } // Fecha função bar800k_product_list

