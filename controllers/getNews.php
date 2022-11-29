<?php
require_once 'constants.php';


function getNewsTopHeadlines($country) {
    $current_useragent = $_SERVER['HTTP_USER_AGENT'];
    $url_top_headlines = ENDPOINT_TOP_HEADLINES . '?country=' . $country . '&apiKey=' . API_KEY;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_top_headlines);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $current_useragent);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

