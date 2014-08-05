<?php
//various settings to affect the appearance of templates 

if (get_post_meta($post->ID,'remove_top_nav',true)=='yes')
    {
    remove_action('reactor_header_before', 'reactor_do_top_bar', 1);
    }
if (get_post_meta($post->ID,'remove_main_nav',true)=='yes')
    {
    remove_action('reactor_header_after', 'reactor_do_main_top_bar', 3);
    }
if (get_post_meta($post->ID,'remove_hero',true)=='yes')
    {
    remove_action('reactor_content_before', 'earlyarts_hero_image', 5); 
    }
?>