<?php

namespace Pop\Geo\Test;

use Pop\Geo\Geo;

class GeoTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $geo = new Geo([
            'host'      => 'www.google.com',
            'latitude'  => '29.9546500',
            'longitude' => '-90.0750700'

        ]);
        $this->assertInstanceOf('Pop\Geo\Geo', $geo);
        $this->assertEquals('29.9546500', $geo->getLatitude());
        $this->assertEquals('-90.0750700', $geo->getLongitude());
        $this->assertEquals(10, count($geo->getDatabases()));
        $this->assertFalse($geo->isDbAvailable('proxy'));
        $this->assertFalse($geo->isDbAvailable('bad'));
        $this->assertNull($geo->getHostInfo()['netspeed']);
        $this->assertNull($geo->netspeed);
    }

    public function testDistanceTo()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        $geo1 = new Geo([
            'latitude'  => '29.9546500',
            'longitude' => '-90.0750700'
        ]);

        $geo2 = new Geo([
            'latitude'  => '30.450746',
            'longitude' => '-91.154551'

        ]);

        $this->assertEquals(73.0, $geo1->distanceTo($geo2));
    }

    public function testDistanceToGeo1NoCoords()
    {
        $this->setExpectedException('Pop\Geo\Exception');
        $geo1 = new Geo();
        $geo2 = new Geo([
            'latitude'  => '30.450746',
            'longitude' => '-91.154551'

        ]);
        $this->assertEquals(73.0, $geo1->distanceTo($geo2));
    }

    public function testDistanceToGeo2NoCoords()
    {
        $this->setExpectedException('Pop\Geo\Exception');
        $geo1 = new Geo([
            'latitude'  => '29.9546500',
            'longitude' => '-90.0750700'
        ]);
        $geo2 = new Geo();
        $this->assertEquals(73.0, $geo1->distanceTo($geo2));
    }

    public function testCalculateDistance()
    {
        $origin = [
            'latitude'  => '29.9546500',
            'longitude' => '-90.0750700'
        ];
        $destination = [
            'latitude'  => '30.450746',
            'longitude' => '-91.154551'
        ];
        $this->assertEquals(117.48, Geo::calculateDistance($origin, $destination, 2, true));
    }

    public function testCalculateDistanceGeo1NoCoords()
    {
        $this->setExpectedException('Pop\Geo\Exception');
        $origin = [];
        $destination = [
            'latitude'  => '30.450746',
            'longitude' => '-91.154551'
        ];
        $this->assertEquals(117.48, Geo::calculateDistance($origin, $destination, 2, true));
    }

    public function testCalculateDistanceGeo2NoCoords()
    {
        $this->setExpectedException('Pop\Geo\Exception');
        $origin = [
            'latitude'  => '29.9546500',
            'longitude' => '-90.0750700'
        ];
        $destination = [];
        $this->assertEquals(117.48, Geo::calculateDistance($origin, $destination, 2, true));
    }
}