<?php
/**
 * 
 */
class Rs_App
{
	public $baseUrl;
	function __construct()
	{
		$this->baseUrl = "http://localhost/onlineshop/aplikasi/";
	}
	public function CheckString($string){
		return $string;
	}
}