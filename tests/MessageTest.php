<?php

include __DIR__ . '/../vendor/autoload.php';

class MessageTest extends PHPUnit_Framework_TestCase
{
    public function testJsonP()
    {
        $jsonp = '/**/jQuery111107995170897718433_1477782096318({ "steamid": "76561198212106244", "error": "OK", "umqid": "6347012660400807339", "timestamp": 33003884, "utc_timestamp": 1477779043, "message": 14, "push": 0 })';
        $data = \Xolf\PhpSteam\Message::jsonp($jsonp);
        $this->assertEquals("76561198212106244", $data->steamid);
        $this->assertEquals("OK", $data->error);
        $this->assertEquals("6347012660400807339", $data->umqid);
        $this->assertEquals(33003884, $data->timestamp);
        $this->assertEquals(1477779043, $data->utc_timestamp);
        $this->assertEquals(14, $data->message);
        $this->assertEquals(0, $data->push);
    }

}
