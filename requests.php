<?php

function oldb_get_url($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($curl);
  
  curl_close($curl);

  $data = json_decode($response);

  return $data; 
}