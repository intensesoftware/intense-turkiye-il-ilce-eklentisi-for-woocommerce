<?php

/*
Plugin Name: Woocommerce Intense Türkiye İl İlçe Eklentisi
Plugin URI: http://intense.com.tr
Description: WooCommerce ödeme sayfası için Türkiye'de yer alan tüm il ve ilçelerin gösterilmesini sağlar.
Version: 1.0
Author: Intense Yazılım
Author URI: http://intense.com.tr
License: GPL2
*/


add_filter('woocommerce_checkout_fields', 'intense_ilce_override');

function intense_ilce_override($fields){

    $fields['billing']['billing_city']['type'] = 'select';
    $fields['billing']['billing_city']['options'] = array('0'=>'Lütfen Seçiniz');

    return $fields;

}



add_action('admin_init', 'il_ve_ilce_listeleri');

/**
 * $il_adi = 'Çankırı';
 */
function il_ve_ilce_listeleri(){


    //global $wpdb;

    $countries_obj = new WC_Countries();
    $TR_sehirler = array_map('mb_strtoupper', $countries_obj->get_states()['TR']);

    $ilce_listesi = array();

    foreach($TR_sehirler as $WC_il_kodu=>$il_adi){

        echo $ilce_listesi;

    }

    exit;


}





add_action('wp_footer', 'ilcelerin_listelenmesi');

function ilcelerin_listelenmesi(){

    ?>

    <script>

        jQuery('document').ready(function(){

            jQuery('#billing_state').on('change', function(){

                var data = jQuery('.select2 option:selected').text();
                let billing_il = jQuery('#billing_state').val();

            });

        });

    </script>

    <?php


}