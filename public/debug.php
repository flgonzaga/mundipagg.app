<?php

function debugRequest($url, $post){

	$_headers = array (
            // 'user-agent'    => 'MundiSDK',
            // 'Accept'        => 'application/json',
            'content-type'  => 'application/json; charset=utf-8',
            'Authorization' => 'No Auth'
        );
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, $_headers);
	$result = curl_exec($ch);
	curl_close($ch);  // Seems like good practice
	return $result;
}