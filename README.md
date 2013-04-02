[![Build Status](https://travis-ci.org/BruceWouaigne/tan-client.png)](https://travis-ci.org/BruceWouaigne/tan-client)

Installation
============

1. Clone this repository
2. Install dependencies with `composer.phar install --prefer-dist`
3. Start playing!

Usage
=====

```php
<?php

require './vendor/autoload.php';

$client = new Tan\ApiClient;

$stopList     = $client->getStopList();
$stopListNear = $client->getStopList('47,2181', '-1,5528');
$waitingTime  = $client->getWaitingTime('COMM');
$schedule     = $client->getSchedule('COMM', '51', 1);
```
