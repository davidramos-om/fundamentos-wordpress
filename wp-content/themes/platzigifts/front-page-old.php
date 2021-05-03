<?php get_header(); ?>

    <main>
        <div class="container">
            <?php if(have_posts()){
                 while(have_posts()) {
                        the_post(); ?>
                
                <h1 class="my-3"> <?php the_title(); ?>!! </h1>
                <?php the_content(); ?>
                 <?php }
            } ?>

            <div class="lista-productos my-5">
                <h2 class="text-center">Productos</h2>
                <div class="row">
                    <div class="col-12">
                        <select name="categorias-producto" id="categorias-producto" class="form-control">
                            <option value="">Todas las categorias</option>
                            <?php $terms = get_terms('categoria-productos', array('hiden_empty' => true)); ?>
                            <?php foreach($terms as $term) {
                                echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
                            } ?>
                        </select>
                    </div>
                </div>

                <div id="resultado-productos" class="row justify-content-center">
                
                <?php
                    $args = array(
                        'post_type' => 'product',
                        'post_per_page' => -1,
                        'order' => 'asc',
                        'orderby' => 'title'
                    );

                    $productos = new WP_Query($args);

                    if($productos->have_posts()){
                        while($productos->have_posts()){
                            $productos->the_post();
                            ?>

                            <div class="col-4">
                            
                                <div class="card" style="width: 18rem;margin-top:15px">                                    
                                    <figure class="card-img-top" alt="<?php the_title() ?>">
                                        <?php the_post_thumbnail('large')?>
                                    </figure>
                                    <div class="card-body">
                                        <h5 class="card-title"> <?php the_title(); ?></h5> 
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Muestrame</a>
                                    </div>
                                </div>
                            </div>

                        <?php }
                    }
                ?>
                </div>
            </div>
        </div>        
    </main>

<?php get_footer(); ?>