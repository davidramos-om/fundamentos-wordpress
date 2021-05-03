
<?php 
$fields = get_fields(); 
?>

<h1 class="my-3"> <?php the_title(); ?> </h1> 

<div style="display:flex; justify-content: center; " >
    <img src="<?php echo $fields['imagen']; ?>" alt="<?php echo $fields['titulo']; ?>" class="my-3" >
</div>
<hr> 