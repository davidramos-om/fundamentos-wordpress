<?php 

function init_template(){
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus(array('top_menu'=> 'Menú Principal'));
}

add_action('after_setup_theme', 'init_template');

function assets(){
    
    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css','','5.0.0','all');
    wp_register_style('montserrat','https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap','','1.0','all');
    
    wp_enqueue_style('estilos', get_stylesheet_uri(), array('bootstrap','montserrat'), '1.0', 'all');

    //Debido a que JQuery ya no esta incluido en bootstrap 5
    wp_enqueue_script('jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', '','3.6.0', true);

    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js', '','5.0.0', true);

    wp_enqueue_script('custom', get_template_directory_uri().'/assets/js/custom.js', '', '1.0', true);
    wp_localize_script('custom', 'pg',  
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'apiurl' => home_url('wp-json/pg/v1/')
    ));
}

add_action('wp_enqueue_scripts','assets');

function sidebar(){
    
    register_sidebar( array(
            'name'=> 'Pie de Página',
            'id'=> 'footer',
            'description' => 'Zona de widgest para pie de página',
            'before_title'=> '<p>',
            'after_title'=>'</p>',
            'before_widget'=> '<div id="%1$s" class="%2$s" >',
            'after_widget'=> '</div>'
    ));
}

add_action('widgets_init','sidebar' );

function product_type(){

    $labels = array(
        'name' => 'Productos',
        'singular_name' => 'Producto',
        'menu_name' => 'Productos',        
    );

    $args = array(
        'label' => 'Productos',
        'description' => 'Productos de Platzi',
        'labels' =>  $labels,
        'supports' => array('title', 'editor', 'thumbnail','revisions'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'can_export' => true,
        'publicy_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => true,
    );

    register_post_type('product', $args);
}

add_action('init','product_type');

function pgRegisterTax(){

    $args = array(
        'hierarchical' => true,
        'labels'=> array(
                'name' => 'Categorías de Producto', 
                'singular_name' => 'Categoría de Productos'
        ),
        'show_in_nav_menu'=> true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'categoria-productos')
    );

    register_taxonomy('categoria-productos', array('product'), $args); 
}

add_action ('init','pgRegisterTax');

function filtroProductos(){

    $args = array(
        'post_type' => 'product', 
        'posts_per_page' => -1,
        'order' => 'asc',
        'orderby' => 'title'
    ); 

    //categoria = parametro en la función JS del archivo custom.js
    if($_POST['categoria']){

        $args['tax_query'] = array(
            array(
                'taxonomy'=> 'categoria-productos',
                'field' => 'slug',
                'terms' => $_POST['categoria'],
            ),
        );
    }

    $productos = new WP_Query($args); 
    $resultado = array();

    if($productos->have_posts()) {
    
        while($productos->have_posts()){
            $productos->the_post();
            
            $resultado[] = array(
                'imagen' => get_the_post_thumbnail(get_the_ID(),'large'),
                'link' => get_the_permalink(),
                'titulo'=> get_the_title()
            );
        }
    }

    wp_send_json($resultado);
}

//Usuarios logueaodos
add_action('wp_ajax_filtroProductos','filtroProductos');

//Usuarios no logueados
add_action('wp_ajax_nopriv_filtroProductos','filtroProductos');


//Registrar EndPoint
add_action('rest_api_init','novedadesAPI');

function novedadesAPI(){

    register_rest_route(
        'pg/v1', 
        '/novedades/(?P<cantidad>\d+)', 
        array(
            'methods' => 'GET',
            'callback' => 'solicitarNovedades'
        ),
        true
    );
}

function solicitarNovedades($data){

    $args = array(
        'post_type' => 'post', 
        'posts_per_page' => $data['cantidad'],
        'order' => 'asc',
        'orderby' => 'title'
    ); 

    $novedades = new WP_Query($args); 
    $resultado = array();

    if($novedades->have_posts()) {
    
        while($novedades->have_posts()){
            $novedades->the_post();
            
            $resultado[] = array(
                'imagen' => get_the_post_thumbnail(get_the_ID(),'large'),
                'image_url' => get_the_post_thumbnail_url(get_the_ID(),'large'),
                'link' => get_the_permalink(),
                'titulo'=> get_the_title()
            );
        }
    }

    return $resultado;
}


//Registrar EndPoint
add_action('rest_api_init','productosAPI');

function productosAPI(){

    register_rest_route(
        'pg/v1', 
        '/productos/(?P<cantidad>\d+)', 
        array(
            'methods' => 'GET',
            'callback' => 'solicitarProductos'
        ),
        true
    );
}

function solicitarProductos($data){

    $args = array(
        'post_type' => 'product', 
        'posts_per_page' => $data['cantidad'],
        'order' => 'asc',
        'orderby' => 'title'
    ); 

    //Categoria solicitada en la solicitud hacia la api, enviada por parámetro
    if($data['categoria']){

        $args['tax_query'] = array(
            array(
                'taxonomy'=> 'categoria-productos',
                'field' => 'slug',
                'terms' => $data['categoria'],
            ),
        );
    }

    $productos = new WP_Query($args); 
    $resultado = array();

    if($productos->have_posts()) {
    
        while($productos->have_posts()){
            $productos->the_post();
            
            $resultado[] = array(
                'image' => get_the_post_thumbnail_url(get_the_ID(),'large'),
                'link' => get_the_permalink(),
                'titulo'=> get_the_title()
            );
        }
    }

    return $resultado;
}

function registerBlock(){

    $ruta = get_template_directory().'/blocks/build/index.asset.php';
    $ruta_uri = get_template_directory_uri().'/blocks/build/index.js';
    $assets = include_once($ruta);

    wp_register_script('pg-block', $ruta_uri , $assets['dependencies'], $assets['version'], true);

    register_block_type('pg/basic', 
        array(
            'editor_script' => 'pg-block',
            'attributes'  => array(
                'content' => array(
                    'type'    => 'string',
                    'default' => 'Hello world'
                )
            ),            
            'render_callback' => 'renderDynamicBlock'
        )
    );


    register_block_type('pg/table-block', 
        array(
            'editor_script' => 'pg-block',
            // 'render_callback' => 'renderDynamicTableBlock'
        )
    );
   
}

add_action('init','registerBlock');

function renderDynamicBlock($attributes, $content){
    return '<h2>'.$attributes['content'].'</h2>';
}


function renderDynamicTableBlock($attributes, $content){
    return '<h1>'.$attributes['content'].'</h1>';
}

function acfRegisterBlocks(){

    acf_register_block(
        array(
            'name' => 'pg-institucional',
            'title'=> 'Institucional',
            'description' => '',
            'render_template'=> get_template_directory().'/template-parts/institucional.php',
            'category'=>'text',
            'icon' =>'smiley',
            'mode' => 'edit'
        )
    );
}

//Se necesita pagar
// add_action('acf/init','acfRegisterBlocks');