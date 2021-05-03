<?php 

//Plugin name: Modo Oscuro
//Description: Activa el modo oscuro para tu web
//version: 1.0
//Author: David Ramos
//Author URI: https://github.com/davidramos-om

function estilos_plugin(){

    $estilos_url = plugin_dir_url(__FILE__);

    wp_enqueue_style('modo_oscuro', $estilos_url.'/assets/css/estilo.css', '', '1.0', 'all');
}

add_action('wp_enqueue_scripts','estilos_plugin');