<?php

/*

Contributors: intenseyazilim
Donate link: http://intense.com.tr/

Plugin Name: Intense Türkiye İl İlçe Eklentisi For WooCommerce
Description: !!! Dikkat: Bu eklenti emekli edilmiştir, bu eklentinin yerine Hezarfen isimli eklentimizi öneririz, Hezarfen eklentimiz; ücretsiz olarak ilçe ve mahalle desteği sunar. https://wordpress.org/plugins/hezarfen-for-woocommerce/
Version: 1.3.0
Author: Intense Yazılım
Author URI: http://intense.com.tr
License: GPL2

WC tested up to: 5.3.0

*/


if ( ! defined( 'ABSPATH' ) ){
    exit;
}


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    require __DIR__ . '/vendor/autoload.php';

	define('INTENSE_IL_ILCE_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

    include_once("fonksiyonlar/in-class-il-ilce-alan-tanimlamalari.php");

	include_once("fonksiyonlar/in-class-il-ilce-district.php");

    include_once("fonksiyonlar/in-class-il-ilce-uyarilar.php");

    include_once("fonksiyonlar/in-class-il-ilce-checkout-js.php");

}
