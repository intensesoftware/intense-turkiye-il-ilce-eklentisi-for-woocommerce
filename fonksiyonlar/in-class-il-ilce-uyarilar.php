<?php

Class In_Class_Il_Ilce_Uyarilar {

    function __construct()
    {

        add_action('admin_notices', array( $this, 'uyarilar' ), 10, 1);

        add_action('admin_init', array( $this, 'reklam_gosterim_ayari' ));

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
            <a href="https://market.intense.com.tr" target="_blank">

                <img style="width:1000px" src="https://market.intense.com.tr/wp-content/uploads/2019/12/reklam.png" />

            </a>
            <p>
                Bu reklamı Intense İl İlçe eklentimizi kullanımınız sebebiyle görüntülemektesiniz. <a href="<?php echo get_admin_url(); ?>/index.php?intense-ilce-ilce-reklam-gosterimi-kapali=true">Dilerseniz buradan reklamı kalıcı olarak gizleyebilrsiniz.</a>
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