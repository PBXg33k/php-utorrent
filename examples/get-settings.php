<?php
require_once(__DIR__.'/../vendor/autoload.php');
require_once('hostconf.php');

$utorrentClient = new \Pbxg33k\UtorrentClient\UtorrentClient(
    $host['host'],
    $host['port'],
    $host['username'],
    $host['password'],
    $host['path']
);

$utorrentClient->setCache(new \Cache\Adapter\Void\VoidCachePool());

/** @var  $settings */
$settings = $utorrentClient->getSettings();

var_dump($settings);