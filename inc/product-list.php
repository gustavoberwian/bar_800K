<?php
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
                        <h2>
                            <span style="font-size: large"><?=$product['name']; ?> </span>
                            <br/>
                            <span style="font-size: x-large"><?=$product['price']; ?></span>
                        </h2>
                    </div>
                    <div class="product-overlay">
                        <span class="btn-link" id="color-white">Ver mais</span>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
<?php } // Fecha função bar800k_product_list