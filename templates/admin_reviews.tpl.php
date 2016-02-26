<?php
    drupal_add_css(drupal_get_path('module','reviews_system').'/css/date-popup.css');
    drupal_add_js(drupal_get_path('module','reviews_system').'/scripts/jquery-1.9.1.js');
    drupal_add_js(drupal_get_path('module','reviews_system').'/scripts/date-popup.js');
    drupal_add_js(drupal_get_path('module','reviews_system').'/scripts/script.js');

?>
<?
    
    $form = drupal_get_form('reviews_system_review_admin_filter_form');
    print $form;
    print $html;
    print_r($pager);
?>