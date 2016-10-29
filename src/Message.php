<?php

namespace Xolf\PhpSteam;

use GuzzleHttp\Client;

class Message {

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $access_token = "";

    private $auth;

    public function __construct(Client $client, $access_token)
    {
        $this->client = $client;
        $this->access_token = $access_token;
    }

    public function getUrl($attr = [])
    {
        if(!isset($attr['steamid_dst'], $attr['message'])) throw new \Exception("Parameter missing");

        $url = 'https://api.steampowered.com/ISteamWebUserPresenceOAuth/Message/v0001/?jsonp=jQuery1111039157468357837133_1477228248393';
        $url .= '&umqid=' . $this->auth->umqid;
        $url .= '&type=saytext';
        $url .= '&steamid_dst=' . $attr['steamid_dst'];
        $url .= '&text=' . $attr['message'];
        $url .= '&access_token=' . $this->access_token;
        $url .= '&_=' . time();
        return $url;
    }

    public function authClient()
    {
        $url = 'https://api.steampowered.com/ISteamWebUserPresenceOAuth/Logon/v0001/?jsonp=jQuery111107995170897718433_1477782096318';
        $url .= '&ui_mode=web';
        $url .= '&access_token=' . $this->access_token;
        $url .= '&_=' . time();

        $response = $this->client->get($url);
        file_put_contents('response.html', $response->getBody());
        $auth = self::jsonp($response->getBody());
        $this->auth = $auth;
    }

    public function send($message, $steam_dst)
    {
        $response = $this->client->get($this->getUrl([
            'steamid_dst' => $steam_dst,
            'message' => $message
        ]));
        return self::jsonp($response->getBody());
    }

    /**
     * @param $jsonp
     * @return mixed
     */
    public static function jsonp($jsonp)
    {
        $jsonp = explode("(", $jsonp)[1];
        $jsonp = explode(")", $jsonp)[0];
        return json_decode($jsonp);
    }

}