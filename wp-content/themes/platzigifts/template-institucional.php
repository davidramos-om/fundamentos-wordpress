<?php 
//Template Name: Pagina Institucional
get_header(); 
$fields = get_fields(); 
?>

<main class="container">
    <?php if(have_posts()){
        while(have_posts()){
            the_post(); ?>  

        <h5 class="text-center my-3"> <?php echo $fields['titulo']; ?> </h5> 
        <div style="display:flex; justify-content: center; " >
            <img src="<?php echo $fields['imagen']; ?>" alt="<?php echo $fields['titulo']; ?>" class="my-3" >
        </div>
        <hr> 

        <h1 class="my-3"> <?php the_title(); ?> </h1> 
        <?php the_content(); ?>
        <?php }
    }?>
</main>

<?php get_footer(); ?>