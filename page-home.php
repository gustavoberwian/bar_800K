<?php
// Template name: Home
get_header(); ?>
    <pre>
<?php

$products_slide = wc_get_products([
    'limit' => 6,
    'tag' => ['slide'],
]);

$products_new = wc_get_products([
    'limit' => 9,
    'orderby' => 'date',
    'order' => 'DESC',
]);

$products_sales = wc_get_products([
    'limit' => 9,
    'meta_key' => 'total_sales',
    'orderby' => 'date',
    'order' => 'DESC',
]);

$data = [];

$data['slide'] = format_products($products_slide, 'slide');
$data['lancamentos'] = format_products($products_new, 'medium');
$data['vendidos'] = format_products($products_sales, 'medium');

if(have_posts()){ while(have_posts()) { the_post(); ?>

    <section class="slide-wrapper">
        <ul class="slide">
            <?php foreach ($data['slide'] as $product) { ?>
                <li class="slide-item">
                    <img src="<?= $product['img']; ?>" alt="<?=$product['name']; ?>" />
                    <div class="slide-info">
                        <span class="slide-preco"><?=$product['price']; ?></span>
                        <h2 class="slide-nome"><?=$product['name']; ?></h2>
                        <a class="btn-link" href="<?=$product['link']; ?>">Ver produto</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </section>

    <section class="container">
        <h1 class="subtitulo">Lançamentos</h1>
        <?php bar800k_product_list($data['lancamentos']); ?>
    </section>

    <section class="container">
        <h1 class="subtitulo">Mais vendidos</h1>
        <?php bar800k_product_list($data['vendidos']); ?>
    </section>


<?php } } else { ?>

<?php } ?>

<?php get_footer(); ?>