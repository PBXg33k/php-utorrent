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


$start = microtime(true);

$utorrentClient->setCache(new \Cache\Adapter\Void\VoidCachePool());

$torrents = $utorrentClient->getTorrents();

$getTime = microtime(true);

/** @var \Pbxg33k\UtorrentClient\Model\Torrent $torrent */
foreach($torrents->getTorrents() as $torrent) {
    print("Hash: {$torrent->getHash()} | Size: {$torrent->getSize()} | Name: {$torrent->getName()}\r\n");
}

$end = microtime(true);
print("Retrieved {$torrents->getTorrents()->count()} torrents\r\n");