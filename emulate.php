<?php

include "vendor/autoload.php";

$cookies = [];

$cookies_file = file_get_contents("cookies");
$cookies_file = json_decode($cookies_file, true);
foreach ($cookies_file as $data) {
    $data = array_combine(
        array_map('ucfirst', array_keys($data)),
        array_values($data)
    );
    $cookies[] = new \GuzzleHttp\Cookie\SetCookie($data);
}


$jar = new \GuzzleHttp\Cookie\CookieJar(true, $cookies);
$client = new GuzzleHttp\Client(['verify' => false, 'cookies' => $jar]);
$message = new \Xolf\PhpSteam\Message($client, '6cde03585f8a8be1f3706df4e2952778');

//$url = 'https://api.steampowered.com/ISteamWebUserPresenceOAuth/Message/v0001/?jsonp=jQuery1111039157468357837133_1477228248393&umqid=6344631925668594462&type=saytext&steamid_dst=76561198068016024&text=huhu&access_token=6cde03585f8a8be1f3706df4e2952778&_=1477228248415';
//$url = 'https://api.steampowered.com/ISteamWebUserPresenceOAuth/Poll/v0001/?jsonp=jQuery1111039157468357837133_1477228248388&umqid=6344631925668594462&message=18&pollid=69&sectimeout=35&secidletime=172&use_accountids=1&access_token=6cde03585f8a8be1f3706df4e2952778&_=' . time();

$message->authClient();
for ($i=1;$i<=1;$i++) {
    if($message->send('Es ist ' . date('H:i:s'), '76561198068016024')->error != "OK") echo 'Message delivery failed';
    /*
    $response = $client->get($message->getUrl([
        'steamid_dst' => '76561198068016024',
        'message' => "Dotabuff Tournament: OG - EG 1:1" . $i
    ]), ['cookies' => $jar]);
    echo $response->getBody();
    */
}