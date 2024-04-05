<?php
session_start(); //starts session
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
?>