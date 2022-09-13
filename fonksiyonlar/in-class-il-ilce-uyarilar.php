<?php

if ( ! defined( 'ABSPATH' ) ){
    exit;
}

Class In_Class_Il_Ilce_Uyarilar {

    const DISMISS_KEY_HIDE_DEPRECATION_NOTICE = 'intense_il_ilce_deprecation-7';

    function __construct()
    {
        new \WP_Dismiss_Notice();

        add_action('admin_notices', array($this, 'deprecated_notice'), 10, 1);

        add_action('admin_init', array( $this, 'reklam_gosterim_ayari' ));

    }

    public function deprecated_notice() {
        if( ! WP_Dismiss_Notice::is_admin_notice_active( self::DISMISS_KEY_HIDE_DEPRECATION_NOTICE ) ) {
            return;
        }

        $current_screen = get_current_screen();

        if( ! ( $current_screen instanceof \WP_Screen ) || !( in_array( $current_screen->id, ['plugins', 'dashboard'] ) ) ) {
            return;
        }

        if( defined('WC_HEZARFEN_VERSION') ) {
            return;
        }
        ?>
        <div class="notice notice-error is-dismissible" data-dismissible='<?php echo self::DISMISS_KEY_HIDE_DEPRECATION_NOTICE; ?>'>
            <p>
                <b style="color:red; font-size:14px">Önemli not: "Intense İl İlçe eklenti"'si emekli edilmiştir, artık bu eklenti için güncelleme ve destek verilmemektedir.</a></b>
            </p>
            <p>
                <span style="text-decoration:underline; font-weight:bold">Önerimiz: "Intense İl İlçe eklentisi"ni kaldırıp ve bunun yerine <a href="<?php echo $this->hezarfen_install_url(); ?>">"Hezarfen for WooCommerce"</a> eklentisini yükleyebilirsiniz</span> bu sayede ücretsiz olarak ilçelere ek olarak <strong>mahalleleri de</strong> ödeme ekranınızda gösterebilirsiniz. Hezarfen eklentisi, WooCommerce'i Türkiye için daha kullanılabilir hale getirmeyi amaçlar.
            </p>
            <p>
                <a class="button" href="<?php echo $this->hezarfen_install_url(); ?>">Hezarfen'i buraya tıklayarak yükleyebilirsiniz.</a>
            </p>
            <p>
            Hezarfen for WooCommerce, Intense ekibi tarafından geliştirilmektedir.</b> <a target="_blank" href="https://wordpress.org/plugins/hezarfen-for-woocommerce/">Hezarfen ile ilgili soru ve geri bildirimlerinizi, WP sayfasi->Support(Destek) alanından iletebilirsiniz.</a>
            </p>
            <p>
                <i>Bu uyarının sağ üst köşesinde bulunan "çarpı" ikonuyla bu uyarıyı 7 gün için gizleyebilirsiniz. Eğer Hezarfen'i kullanmak istemiyorsanız ve bu uyarıyı görmek istemiyorsanız İl İlçe eklenti v1.2.6'a manuel olarak dönebilirsiniz ancak güncellenmeyen bir eklentiyi kullanmanızı önermemekteyiz. Şikayet ve önerileriniz için info@intense.com.tr adresinden bize ulaşabilirsiniz. Teşekkür ederiz!</i>
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