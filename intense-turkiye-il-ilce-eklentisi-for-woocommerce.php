<?php

/*
Plugin Name: Intense Türkiye İl İlçe Eklentisi For WooCommerce
Description: WooCommerce ödeme sayfası için Türkiye'de yer alan tüm il ve ilçelerin gösterilmesini sağlar.
Version: 1.1.1
Author: Intense Yazılım
Author URI: http://intense.com.tr
License: GPL2
*/


if ( ! defined( 'ABSPATH' ) ){
    exit;
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    include_once("fonksiyonlar/in-class-il-ilce-alan-tanimlamalari.php");

    include_once("fonksiyonlar/in-class-il-ilce-uyarilar.php");

    include_once("fonksiyonlar/in-class-il-ilce-checkout-js.php");

}
