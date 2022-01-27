<?php get_header(); ?>

<?php
$products = [];
if (have_posts()){ while (have_posts()){ the_post();
    $id = get_the_ID();
    $products[] = wc_get_product($id);
} }

$data = [];
$data['products'] = format_products($products);
?>

    <div class="container breadcrumb">
        <?php woocommerce_breadcrumb(['delimiter' => ' > ']); ?>
    </div>

    <article class="container products-archive">
        <nav class="filtros">
            <h2>Filtros</h2>
            <div>
                <?php
                wp_nav_menu([

                ])
                ?>
            </div>
        </nav>
        <main>
            <?php if ($data['products'][0]){ ?>

                <?php bar800k_product_list($data['products']); ?>
                <?= get_the_posts_pagination() ?>

            <?php } else { ?>
                <p>Nenhum resultado para sua busca.</p>
            <?php } ?>

        </main>
    </article>

<?php get_footer(); ?>