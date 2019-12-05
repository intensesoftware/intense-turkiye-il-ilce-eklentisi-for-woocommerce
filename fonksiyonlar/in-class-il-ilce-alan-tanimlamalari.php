<?php

if ( ! defined( 'ABSPATH' ) ){
    exit;
}


Class In_Class_Il_Ilce_Alan_Tanimlamalari {


    function __construct()
    {

        add_filter('woocommerce_checkout_fields', array( $this, 'ilce_alaninin_tanimlanmasi_ve_oncelik_siralamalari' ), 9999);

        add_filter('woocommerce_checkout_fields', array( $this, 'odeme_alanlarinin_son_siralama_kontrolu' ), 10000);

        add_filter('woocommerce_default_address_fields', array( $this, 'adres_alanlari_oncelik_siralamalari' ), 9999);

        add_action('woocommerce_before_checkout_billing_form', array( $this, 'secili_ilce_bilgileri' ) );

    }


    function odeme_alanlarinin_son_siralama_kontrolu( $fields ){

        $woocommerce_default_alanlar = array(
            'billing_state',
            'billing_first_name',
            'billing_last_name',
            'billing_company',
            'billing_country',
            'billing_address_1',
            'billing_address_2',
            'billing_city',
            'billing_postcode',
            'billing_phone',
            'billing_email',
            'shipping_first_name',
            'shipping_last_name',
            'shipping_company',
            'shipping_country',
            'shipping_address_1',
            'shipping_city',
            'shipping_state',
            'shipping_address_2',
            'shipping_postcode',
            'billing_ilce',
            'shipping_ilce'
        );


        foreach( $fields as $alanlar_key => $alanlar ){

            if( $alanlar_key != 'billing' && $alanlar_key != 'shipping' )
                continue;


            foreach( $alanlar as $alan_key => $alan){


                if(!in_array($alan_key, $woocommerce_default_alanlar)){

                    $fields[$alanlar_key][$alan_key]['priority'] += 30;

                }


            }


        }

        return $fields;


    }


    function secili_ilce_bilgileri(){

        ?>


        <input type="hidden" id="intense_mevcut_billing_ilce" value="<?php echo WC()->customer->get_billing_city(); ?>" />
        <input type="hidden" id="intense_mevcut_shipping_ilce" value="<?php echo WC()->customer->get_shipping_city(); ?>" />

        <?php

    }


    function adres_alanlari_oncelik_siralamalari( $address_fields ){



        $address_fields['first_name']['priority'] = 1;
        $address_fields['last_name']['priority'] = 2;
        $address_fields['company']['priority'] = 3;
        $address_fields['country']['priority'] = 4;
        $address_fields['state']['priority'] = 5;
        $address_fields['city']['priority'] = 6;
        $address_fields['address_1']['priority'] = 7;
        $address_fields['address_2']['priority'] = 8;
        $address_fields['postcode']['priority'] = 9;


        return $address_fields;

    }


    function ilce_alaninin_tanimlanmasi_ve_oncelik_siralamalari($fields){

        if(!is_checkout())
            return;

        // fatura alanları öncelik sıralaması
        $billing_ulke_priority = intval($fields['billing']['billing_country']['priority']);
        $fields['billing']['billing_state']['priority'] = $billing_ulke_priority+1;
        $fields['billing']['billing_city']['priority'] = $billing_ulke_priority+2;
        $fields['billing']['billing_address_1']['priority'] = $billing_ulke_priority+3;
        $fields['billing']['billing_address_2']['priority'] = $billing_ulke_priority+4;
        $fields['billing']['billing_postcode']['priority'] = $billing_ulke_priority+5;

        // alıcı adresi alanları öncelik sıralaması
        $ulke_priority = intval($fields['shipping']['shipping_country']['priority']);
        $fields['shipping']['shipping_state']['priority'] = $ulke_priority+1;
        $fields['shipping']['shipping_city']['priority'] = $ulke_priority+2;
        $fields['shipping']['shipping_address_1']['priority'] = $ulke_priority+3;
        $fields['shipping']['shipping_address_2']['priority'] = $ulke_priority+4;
        $fields['shipping']['shipping_postcode']['priority'] = $ulke_priority+5;


        $fields['billing']['billing_ilce']['class'][0] = 'form-row-wide';
        $fields['billing']['billing_ilce']['type'] = 'select';
        $fields['billing']['billing_ilce']['priority'] = $billing_ulke_priority + 2;
        $fields['billing']['billing_ilce']['label'] = "İlçe / Semt";
        $fields['billing']['billing_ilce']['required'] = false;
        $fields['billing']['billing_ilce']['options'] = array(''=>'Lütfen Seçiniz');


        $fields['shipping']['shipping_ilce']['class'][0] = 'form-row-wide';
        $fields['shipping']['shipping_ilce']['type'] = 'select';
        $fields['shipping']['shipping_ilce']['priority'] = $ulke_priority + 2;
        $fields['shipping']['shipping_ilce']['label'] = "İlçe / Semt";
        $fields['shipping']['shipping_ilce']['required'] = false;
        $fields['shipping']['shipping_ilce']['options'] = array(''=>'Lütfen Seçiniz');



        return $fields;

    }


}

new In_Class_Il_Ilce_Alan_Tanimlamalari();