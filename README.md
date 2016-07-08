pop-geo
=======

[![Build Status](https://travis-ci.org/popphp/pop-geo.svg?branch=master)](https://travis-ci.org/popphp/pop-geo)
[![Coverage Status](http://cc.popphp.org/coverage.php?comp=pop-geo)](http://cc.popphp.org/pop-geo/)

END OF LIFE
-----------
The `pop-geo` component v2.1.0 is now end-of-life and will no longer be supported due
to lack of support for the GeoIP extension in PHP 7.

OVERVIEW
--------
`pop-geo` is a component for leveraging the GeoIP databases and calculating information
about IP location as well as distances between sets of longitude and latitude points.

`pop-geo` is a component of the [Pop PHP Framework](http://www.popphp.org/).

INSTALL
-------

Install `pop-geo` using Composer.

    composer require popphp/pop-geo

BASIC USAGE
-----------

If the GeoIP extension and databases are installed, it will autodetect information
based on the IP.

```php
use Pop\Geo\Geo;

$nola = new Geo();

echo $nola->getLatitude();  // 29.9546500
echo $nola->getLongitude(); // -90.0750700
```

##### Calculate the distance between to sets of points

You can give it a second set of coordinates to calculate the distance between them:

```php
$houston = new Geo([
    'latitude'  => 29.7632800,
    'longitude' => -95.3632700
]);

echo $nola->distanceTo($houston);          // Outputs '317.11' miles
echo $nola->distanceTo($houston, 2, true); // Outputs '510.34' kilometers
```

You can also manually give it 2 sets of points as well:

```php
use Pop\Geo\Geo;

$nola = [
    'latitude'  => 29.9546500,
    'longitude' => -90.0750700
];

$houston = [
    'latitude'  => 29.7632800,
    'longitude' => -95.3632700
];

echo Geo::calculateDistance($nola, $houston); // Outputs '317.11' miles
```
