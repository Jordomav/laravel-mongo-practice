<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);


/*
|--------------------------------------------------------------------------
| Connect to mLabs mongoDB
|--------------------------------------------------------------------------
|
*/
/*
 * Copyright (c) 2016 ObjectLabs Corporation
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 *
 * Written with extension mongo 1.6.12
 * Documentation: http://php.net/mongo
 * A PHP script connecting to a MongoDB database given a MongoDB Connection URI.
 */
// Create seed data
$seedData = array(
    array(
        'decade' => '1970s',
        'artist' => 'Debby Boone',
        'song' => 'You Light Up My Life',
        'weeksAtOne' => 10
    ),
    array(
        'decade' => '1980s',
        'artist' => 'Olivia Newton-John',
        'song' => 'Physical',
        'weeksAtOne' => 10
    ),
    array(
        'decade' => '1990s',
        'artist' => 'Mariah Carey',
        'song' => 'One Sweet Day',
        'weeksAtOne' => 16
    ),
);
/*
 * Standard single-node URI format:
 * mongodb://[username:password@]host:port/[database]
 */
$uri = "mongodb://user:pass@host:port/db";
$client = new MongoClient($uri);
$db = $client->selectDB("db");
/*
 * First we'll add a few songs. Nothing is required to create the songs
 * collection; it is created automatically when we insert.
 */
$songs = $db->songs;
// To insert a dict, use the insert method.
$songs->batchInsert($seedData);
/*
 * Then we need to give Boyz II Men credit for their contribution to
 * the hit "One Sweet Day".
*/
$songs->update(
    array('artist' => 'Mariah Carey'),
    array('$set' => array('artist' => 'Mariah Carey ft. Boyz II Men'))
);

/*
 * Finally we run a query which returns all the hits that spent 10
 * or more weeks at number 1.
*/
$query = array('weeksAtOne' => array('$gte' => 10));
$cursor = $songs->find($query)->sort(array('decade' => 1));
foreach($cursor as $doc) {
    echo 'In the ' .$doc['decade'];
    echo ', ' .$doc['song'];
    echo ' by ' .$doc['artist'];
    echo ' topped the charts for ' .$doc['weeksAtOne'];
    echo ' straight weeks.', "\n";
}
// Since this is an example, we'll clean up after ourselves.
$songs->drop();
// Only close the connection when your app is terminating
$client->close();