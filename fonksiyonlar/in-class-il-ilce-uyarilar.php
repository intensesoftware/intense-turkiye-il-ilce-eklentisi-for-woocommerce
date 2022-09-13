<?php

if ( ! defined( 'ABSPATH' ) ){
    exit;
}

Class In_Class_Il_Ilce_Uyarilar {

    function __construct()
    {

        add_action('admin_notices', array( $this, 'uyarilar' ), 10, 1);

        add_action('admin_notices', array($this, 'deprecated_notice'), 10, 1);

        add_action('admin_init', array( $this, 'reklam_gosterim_ayari' ));

    }

    public function deprecated_notice() {
        if( defined('WC_HEZARFEN_VERSION') ) {
            return;
        }
        ?>
        <div class="notice notice-error">
            <p>
                <b style="color:red; font-size:14px">Önemli not: "Intense İl İlçe eklenti"'si emekli edilmiştir, artık bu eklenti için güncelleme ve destek verilmemektedir.</a></b>
            </p>
            <p>
                <span style="text-decoration:underline; font-weight:bold">Ödeme ekranında ilçeleri göstermeye devam etmek istiyorsanız: "Intense İl İlçe eklentisi"ni kaldırıp ve bunun yerine <a href="<?php echo $this->hezarfen_install_url(); ?>">"Hezarfen for WooCommerce"</a> eklentisini yükleyiniz</span> bu sayede ücretsiz olarak ilçelere ek olarak <strong>mahalleleri de</strong> ödeme ekranınızda gösterebilirsiniz. Hezarfen eklentisi, WooCommerce'i Türkiye için daha kullanılabilir hale getirmeyi amaçlar.
            </p>
            <p>
                <a class="button" href="<?php echo $this->hezarfen_install_url(); ?>">Hezarfen'i buraya tıklayarak yükleyebilirsiniz.</a>
            </p>
            <p>
            Hezarfen for WooCommerce, Intense ekibi tarafından geliştirilmektedir.</b> <a target="_blank" href="https://wordpress.org/plugins/hezarfen-for-woocommerce/">Hezarfen ile ilgili soru ve geri bildirimlerinizi, WP sayfasi->Support(Destek) alanından iletebilirsiniz.</a>
            </p>
        </div>
        <?php
    }

    function hezarfen_install_url() {
        return admin_url('plugin-install.php?s=hezarfen&tab=search&type=term');
    }


    function uyarilar(){
        $screen = get_current_screen();

        // sadece dashboardda görünsün

        if( $screen->parent_base != 'index' )
            return false;

        $intense_il_ilce_reklam_gosterim_durumu = get_option( '_intense_il_ilce_reklam_gosterim_durumu' );

        if($intense_il_ilce_reklam_gosterim_durumu == 'pasif')
            return false;

        ?>

        <div style="margin:15px 0">
            <a href="https://wordpress.org/plugins/hezarfen-for-woocommerce" target="_blank">
                <img style="width:1000px" src="https://intense.com.tr/wp-content/uploads/2019/12/reklam.png" />
            </a>
            <p>
                Bu reklamı Intense İl İlçe eklentimizi kullanımınız sebebiyle görüntülemektesiniz. <b>Önemli not: "Intense İl İlçe eklenti"'si emekli edilmiştir, yakın zamanda kalıcı olarak kaldırılacaktır. Lütfen "Intense İl İlçe eklentisi"ni kaldırınız ve bunun yerine <a href="<?php echo $this->hezarfen_install_url(); ?>">"Hezarfen for WooCommerce"</a> eklentisini yükleyiniz bu sayede ücretsiz olarak ilçe ve mahalleleri ödeme ekranınızda gösterebilirsiniz. Hezarfen eklentisi, WooCommerce'i Türkiye için daha kullanılabilir hale getirmeyi amaçlar. <a href="<?php echo $this->hezarfen_install_url(); ?>">Hezarfen'i yükle</a></b>
            </p>

        </div>
        <?php
    }


    function reklam_gosterim_ayari(){

        if( isset( $_GET['intense-ilce-ilce-reklam-gosterimi-kapali'] ) ){

            if( $_GET['intense-ilce-ilce-reklam-gosterimi-kapali'] != 'true') return false;

        }else{

            return false;

        }


        update_option('_intense_il_ilce_reklam_gosterim_durumu', 'pasif', FALSE);

        wp_redirect( get_admin_url() );

        exit;

    }


}

new In_Class_Il_Ilce_Uyarilar();