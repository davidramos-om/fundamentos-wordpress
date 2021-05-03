<?php get_header(); ?>

<main class="container my-5">
    <div class="pagina404">
        <h1 class="text-center">404 - Pagína no encontrada</h1>
         
         <div id="img" class="my-2" style="display: flex;justify-content: center;">
            <img src="<?php echo get_template_directory_uri()?>/assets/img/404.png" width="400" height="270" >
        </div>
     
        <h2 class="text-center"> <a href="<?php echo home_url(); ?>">Volver a inicio</a> </h2>
    </div>
</main>

<?php get_footer(); ?>