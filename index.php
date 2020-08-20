<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

require './domain.php';
require './record.php';
require './bind.php';

$domain = new domain("lifeindigital.co.za.");
$domain->setNS1("ns1.froth.cloud.");
$domain->setNS2("ns2.froth.cloud.");
$domain->email = "master.froth.cloud";

$date = new DateTime();
        
$domain->addRecord([
    "host" => "lifeindigital.co.za.",
    "type" => "SOA",
    "ttl" => "14400",
    "mx_priority" => "",
    "serial" => $date->format('U'),
    "refresh" => "7200",
    "retry" => "3600",
    "expire" => "604800",
    "minimum" => "86400",
]);

$domain->addRecord([
    "host" => "@",
    "type" => "A",
    "ttl" => "14400",
    "rdata" => "102.130.116.4",
]);

$domain->addRecord([
    "host" => "www",
    "type" => "CNAME",
    "ttl" => "14400",
    "rdata" => "102.130.116.4",
]);

$bind = new bind();

echo $bind->createZone($domain);
