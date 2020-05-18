<?php

/*

Contributors: intenseyazilim,mskapusuz
Donate link: http://intense.com.tr/

Plugin Name: Intense Türkiye İl İlçe Eklentisi For WooCommerce
Description: WooCommerce ödeme sayfası için Türkiye'de yer alan tüm il ve ilçelerin gösterilmesini sağlar.
Version: 1.2.2
Author: Intense Yazılım
Author URI: http://intense.com.tr
License: GPL2

WC tested up to: 4.1.0

*/


if ( ! defined( 'ABSPATH' ) ){
    exit;
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	define('INTENSE_IL_ILCE_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

    include_once("fonksiyonlar/in-class-il-ilce-alan-tanimlamalari.php");

	include_once("fonksiyonlar/in-class-il-ilce-district.php");

    include_once("fonksiyonlar/in-class-il-ilce-uyarilar.php");

    include_once("fonksiyonlar/in-class-il-ilce-checkout-js.php");

}
