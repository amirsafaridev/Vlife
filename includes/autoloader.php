<?php

// Actions
add_action('init', 'register_script_arta_vlife_promotion');
add_action('wp_enqueue_scripts', 'enqueue_arta_vlife_promotion');
add_action('admin_enqueue_scripts', 'enqueue_arta_vlife_promotion');

function register_script_arta_vlife_promotion()
{
    wp_register_script('arta_vlife_promotionjs', plugin_dir_url(__DIR__) .'assets/js/arta_vlife_promotion.js',array( 'jquery' ), time(), true);
    wp_register_style('arta_vlife_promotion_style', plugin_dir_url(__DIR__) . 'assets/css/arta_vlife_promotion_style.css', false, time(), 'all');

}


function enqueue_arta_vlife_promotion()
{
    global $post;
    //enqueue js
    wp_enqueue_script('arta_vlife_promotionjs');
    wp_localize_script('arta_vlife_promotionjs', 'arta_vlife_promotion_object',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'post'=>$post
        )
    );

    //enqueue css
    wp_enqueue_style('arta_vlife_promotion_style');
}