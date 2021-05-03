<?php get_header(); ?>

<main class="container my-3">

    <p>📁 = single-producto.php</p>
    
    <?php if(have_posts()){  ?> 
        <?php while(have_posts()){
            the_post(); 
        ?> 

        <h1 class="my-5">
            <?php the_title(); ?>
        </h1>

        <div class="row my 5">
            <div class="col-md-6 col-12">
                <?php the_post_thumbnail('large');  ?>
            </div>
            <div class="col-md-6 col-12">
                <?php echo do_shortcode('[contact-form-7 id="71" title="Contact form 1"]') ?>
            </div>
            <div class="col-12">
                <?php the_content(); ?>
            </div>
        </div>        

        <?php  
            $Id_producto_actual = get_the_ID();
            $taxonomia = get_the_terms($Id_producto_actual,'categoria-productos');

            $args = array(
                'post_type' => 'product', 
                'posts_per_page' => 6,
                'order' => 'asc',
                'orderby' => 'title',
                'post__not_in'  => array($Id_producto_actual),
                'tax_query' => array(
                    array(
                        'taxonomy'=> 'categoria-productos',
                        'field' => 'slug',
                        'terms' => $taxonomia[0]->slug,
                    ),
                ),
            ); 

            $productos = new WP_Query($args); 
        ?>

        <?php if($productos->have_posts()) { ?>
           <div class="row justity-content-productos-relacionados">
                <div class="col-12">
                    <h2 class="text-center">Productos relacionados</h2>
                </div>
                
                <?php while($productos->have_posts()) {?>
                <?php $productos->the_post(); ?>
                <div class="col-2 my-3 text-center">
                    <?php the_post_thumbnail('thumbnail') ?>
                    <h4>
                        <a href="<?php the_permalink() ?>"> <?php the_title()?> </a>
                    </h4>
                </div>
                <?php } ?>
           </div>
        <?php }?>
        
        <?php } ?>
    <?php } ?>
</main>

<?php get_footer(); ?>