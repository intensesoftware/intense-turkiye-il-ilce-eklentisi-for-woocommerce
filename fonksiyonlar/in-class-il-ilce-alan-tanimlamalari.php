<?php


Class In_Class_Il_Ilce_Alan_Tanimlamalari {


    function __construct()
    {

        add_filter('woocommerce_checkout_fields', array( $this, 'ilce_alaninin_tanimlanmasi_ve_oncelik_siralamalari' ), 9999);

        add_action('woocommerce_default_address_fields', array( $this, 'adres_alanlari_oncelik_siralamalari' ), 9999);

        add_action('woocommerce_before_checkout_billing_form', array( $this, 'secili_ilce_bilgileri' ) );

    }


    function secili_ilce_bilgileri(){

        ?>


        <input type="hidden" id="intense_mevcut_billing_ilce" value="<?php echo WC()->customer->get_billing_city(); ?>" />
        <input type="hidden" id="intense_mevcut_shipping_ilce" value="<?php echo WC()->customer->get_shipping_city(); ?>" />

        <?php

    }


    function adres_alanlari_oncelik_siralamalari( $address_fields ){



        $country_priority = $address_fields['country']['priority'];
        $address_fields['state']['priority'] = $country_priority + 1;
        $address_fields['city']['priority'] = $country_priority + 2;
        $address_fields['address_1']['priority'] = $country_priority + 3;
        $address_fields['address_2']['priority'] = $country_priority + 4;


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


        $fields['billing']['billing_ilce']['type'] = 'select';
        $fields['billing']['billing_ilce']['priority'] = $billing_ulke_priority + 2;
        $fields['billing']['billing_ilce']['label'] = "İlçe / Semt";
        $fields['billing']['billing_ilce']['required'] = false;
        $fields['billing']['billing_ilce']['options'] = array(''=>'Lütfen Seçiniz');


        $fields['shipping']['shipping_ilce']['type'] = 'select';
        $fields['shipping']['shipping_ilce']['priority'] = $ulke_priority + 2;
        $fields['shipping']['shipping_ilce']['label'] = "İlçe / Semt";
        $fields['shipping']['shipping_ilce']['required'] = false;
        $fields['shipping']['shipping_ilce']['options'] = array(''=>'Lütfen Seçiniz');



        return $fields;

    }


}

new In_Class_Il_Ilce_Alan_Tanimlamalari();