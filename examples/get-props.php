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

$torrents = $utorrentClient->getTorrents();

print("Retrieved {$torrents->getTorrents()->count()} torrents\r\n");

if($torrents->getTorrents()->count() == 0) {
    print("You need at least one torrent for this to work");
}

/** @var \Pbxg33k\UtorrentClient\Model\Torrent $torrent */
$torrentObj = $torrents->getTorrents()->first();

/** @var \Pbxg33k\UtorrentClient\Response\PropResponse $torrentProps */
$torrentProps = $utorrentClient->getTorrent($torrentObj->getHash());

var_dump($torrentProps);