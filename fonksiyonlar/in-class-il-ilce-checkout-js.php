<?php

if ( ! defined( 'ABSPATH' ) ){
    exit;
}

Class In_Class_Il_Ilce_Checkout_JS {


    function __construct()
    {


        // İlçe verilerinin JSON olarak gösterilmesi
        add_action( 'wp_footer', array( $this, 'ilce_verileri') );

        // Genel JS Olayları, WooCommerce mevcut ilçe alanı ile Intense ilçe alanı seçimlerinin yapılması
        add_action( 'wp_footer', array( $this, 'ilcelerin_listelenmesi') );



    }


    function ilce_verileri(){

        if(!is_checkout())
            return;



        $raw_districts = include INTENSE_IL_ILCE_PLUGIN_PATH . 'data/districts.php';

	    $districts = apply_filters('woocommerce_TR_districts', $raw_districts);


        ?>



        <script>

            var ilceler = <?php echo json_encode($districts); ?>

        </script>


        <?php


    }


    function ilcelerin_listelenmesi(){

        if(!is_checkout())
            return;

        ?>

        <script>

            jQuery('document').ready(function($){

                // WC ilçe alanı label içeriğinin Intense ilçe alanına aktarımı
                $('#billing_ilce_field label').html(

                    $('#billing_city_field label').html()

                );


                // WC ilçe alanı label içeriğinin Intense ilçe alanına aktarımı
                $('#shipping_ilce_field label').html(

                    $('#shipping_city_field label').html()

                );


                // ilk yüklenme

                var billing_country = $('#billing_country').val();

                if(billing_country == 'TR'){

                    gizle('#billing_city_field');
                    goster('#billing_ilce_field');

                }else{


                    goster('#billing_city_field');
                    gizle('#billing_ilce_field');

                }

                var shipping_country = $('#shipping_country').val();

                if(shipping_country == 'TR'){

                    gizle('#shipping_city_field');
                    goster('#shipping_ilce_field');

                }else{


                    goster('#shipping_city_field');
                    gizle('#shipping_ilce_field');

                }



                jQuery(document).on('change', '#billing_state', function(){


                    // eski verileri temizle
                    jQuery('#billing_ilce').empty();
                    jQuery('#billing_ilce').append(new Option('Lütfen Seçiniz', ''));

                    let billing_il = jQuery('#billing_state').val();

                    let mevcut_billing_ilce = jQuery('input#intense_mevcut_billing_ilce').val();

                    if( Array.isArray(ilceler[billing_il]) ){

                        var bulunan_ilce_sayisi = ilceler[billing_il].length;

                        if( bulunan_ilce_sayisi > 0 ){

                            jQuery.each(ilceler[billing_il], function(key,ilce){

                                // yeni ilceleri ekle
                                if(jQuery.trim(ilce)==jQuery.trim(mevcut_billing_ilce))
                                    jQuery('#billing_ilce').append('<option selected value="'+ilce+'">'+ilce+'</option>');
                                else
                                    jQuery('#billing_ilce').append('<option value="'+ilce+'">'+ilce+'</option>');

                            });

                            gizle('#billing_city_field');
                            goster('#billing_ilce_field');


                        }else {

                            goster('#billing_city_field');
                            gizle('#billing_ilce_field');

                        }


                    }else{

                        goster('#billing_city_field');
                        gizle('#billing_ilce_field');

                    }


                });


                jQuery(document).on('change', '#shipping_state', function(){


                    // eski verileri temizle
                    jQuery('#shipping_ilce').empty();
                    jQuery('#shipping_ilce').append(new Option('Lütfen Seçiniz', ''));

                    let shipping_il = jQuery('#shipping_state').val();

                    let mevcut_shipping_ilce = jQuery('input#intense_mevcut_shipping_ilce').val();

                    if( Array.isArray(ilceler[shipping_il]) ){

                        var bulunan_ilce_sayisi = ilceler[shipping_il].length;

                        if( bulunan_ilce_sayisi > 0 ){

                            jQuery.each(ilceler[shipping_il], function(key,ilce){

                                // yeni ilceleri ekle
                                if(jQuery.trim(ilce)==jQuery.trim(mevcut_shipping_ilce))
                                    jQuery('#shipping_ilce').append('<option selected value="'+ilce+'">'+ilce+'</option>');
                                else
                                    jQuery('#shipping_ilce').append('<option value="'+ilce+'">'+ilce+'</option>');

                            });

                            gizle('#shipping_city_field');
                            goster('#shipping_ilce_field');


                        }else {

                            goster('#shipping_city_field');
                            gizle('#shipping_ilce_field');

                        }


                    }else{

                        goster('#shipping_city_field');
                        gizle('#shipping_ilce_field');

                    }


                });


                jQuery('#billing_ilce').on('change', function(){

                    $('#billing_city').val(this.value);
                    jQuery('body').trigger('update_checkout');

                });

                jQuery('#shipping_ilce').on('change', function(){

                    $('#shipping_city').val(this.value);
                    jQuery('body').trigger('update_checkout');

                });



                jQuery('#billing_country').on('change', function(){

                    var billing_country = this.value;

                    if(billing_country == 'TR'){

                        gizle('#billing_city_field');
                        goster('#billing_ilce_field');

                    }else{

                        goster('#billing_city_field');
                        gizle('#billing_ilce_field');

                    }

                });


                jQuery('#shipping_country').on('change', function(){

                    var shipping_country = this.value;

                    if(shipping_country == 'TR'){

                        gizle('#shipping_city_field');
                        goster('#shipping_ilce_field');

                    }else{


                        goster('#shipping_city_field');
                        gizle('#shipping_ilce_field');

                    }

                });


                function goster( selector = '' ){

                    $( selector ).show( 200, function(){

                        $( this ).addClass("validate-required");

                    });

                    $(selector).removeClass("woocommerce-validated");
                    $(selector).removeClass("woocommerce-invalid woocommerce-invalid-required-field");

                }


                function gizle( selector = '' ){

                    $( selector ).hide( 200, function(){

                        $( this ).removeClass("validate-required");

                    });

                    $(selector).removeClass("woocommerce-validated");
                    $(selector).removeClass("woocommerce-invalid woocommerce-invalid-required-field");

                }


            });

        </script>

        <?php


    }


}


new In_Class_Il_Ilce_Checkout_JS();