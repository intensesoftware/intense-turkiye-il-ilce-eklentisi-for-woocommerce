<?php

if ( ! defined( 'ABSPATH' ) ){
	exit;
}

class In_Class_Il_Ilce_Districts
{


	/**
	 *
	 * Gets all districts
	 * @return mixed
	 */
	public static function get_TR_districts(){


		$raw_districts = include INTENSE_IL_ILCE_PLUGIN_PATH . 'data/districts.php';

		return apply_filters('woocommerce_TR_districts', $raw_districts);


	}


}