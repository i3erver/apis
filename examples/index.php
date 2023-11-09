<?php
use MHamid\i3erver\Tron;

require_once 'vendor/autoload.php';

$api = new Tron;

echo $api->RecentTransactions("TXoh1REbE8UANqxVzfj1KJ16EgMLMQx93C");