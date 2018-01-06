<?php
namespace Pbxg33k\UtorrentClient\Model;

class TorrentProp extends BaseModel
{
    /**
     * Torrent hash
     *
     * @var string
     */
    protected $hash;
    /**
     * List of trackers, seperated by a blank link
     *
     * @var string
     */
    protected $trackers;
    /**
     * Maximum upload speed (0 = default)
     *
     * @var int
     */
    protected $ulrate;
    /**
     * Maximum download speed (0 = default)
     * @var int
     */
    protected $dlrate;
    /**
     * Initial seeding
     *
     * @var int
     */
    protected $superseed;
    /**
     * DHT Enabled
     *
     * @var int
     */
    protected $dht;
    /**
     * Peer Exchange enabled
     *
     * @var int
     */
    protected $pex;
    /**
     * Override seed
     *
     * @var int
     */
    protected $seed_override;
    /**
     * Seed ratio
     *
     * @var int
     */
    protected $seed_ratio;
    /**
     * Seed time
     *
     * @var int
     */
    protected $seed_time;
    /**
     * Upload slots
     *
     * @var int
     */
    protected $ulslots;

    protected $map = [
        "hash" => "hash",
        "trackers" => "trackers",
        "ulrate" => "ulrate",
        "dlrate" => "dlrate",
        "superseed" => "superseed",
        "dht" => "dht",
        "pex" => "pex",
        "seed_override" => "seed_override",
        "seed_ratio" => "seed_ratio",
        "seed_time" => "seed_time",
        "ulslots" => "ulslots",
    ];
    
    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return TorrentProp
     */
    public function setHash(string $hash): TorrentProp
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrackers(): string
    {
        return $this->trackers;
    }

    /**
     * @param string $trackers
     * @return TorrentProp
     */
    public function setTrackers(string $trackers): TorrentProp
    {
        $this->trackers = $trackers;
        return $this;
    }

    /**
     * @return int
     */
    public function getUlrate(): int
    {
        return $this->ulrate;
    }

    /**
     * @param int $ulrate
     * @return TorrentProp
     */
    public function setUlrate(int $ulrate): TorrentProp
    {
        $this->ulrate = $ulrate;
        return $this;
    }

    /**
     * @return int
     */
    public function getDlrate(): int
    {
        return $this->dlrate;
    }

    /**
     * @param int $dlrate
     * @return TorrentProp
     */
    public function setDlrate(int $dlrate): TorrentProp
    {
        $this->dlrate = $dlrate;
        return $this;
    }

    /**
     * @return int
     */
    public function getSuperseed(): int
    {
        return $this->superseed;
    }

    /**
     * @param int $superseed
     * @return TorrentProp
     */
    public function setSuperseed(int $superseed): TorrentProp
    {
        $this->superseed = $superseed;
        return $this;
    }

    /**
     * @return int
     */
    public function getDht(): int
    {
        return $this->dht;
    }

    /**
     * @param int $dht
     * @return TorrentProp
     */
    public function setDht(int $dht): TorrentProp
    {
        $this->dht = $dht;
        return $this;
    }

    /**
     * @return int
     */
    public function getPex(): int
    {
        return $this->pex;
    }

    /**
     * @param int $pex
     * @return TorrentProp
     */
    public function setPex(int $pex): TorrentProp
    {
        $this->pex = $pex;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeedOverride(): int
    {
        return $this->seed_override;
    }

    /**
     * @param int $seed_override
     * @return TorrentProp
     */
    public function setSeedOverride(int $seed_override): TorrentProp
    {
        $this->seed_override = $seed_override;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeedRatio(): int
    {
        return $this->seed_ratio;
    }

    /**
     * @param int $seed_ratio
     * @return TorrentProp
     */
    public function setSeedRatio(int $seed_ratio): TorrentProp
    {
        $this->seed_ratio = $seed_ratio;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeedTime(): int
    {
        return $this->seed_time;
    }

    /**
     * @param int $seed_time
     * @return TorrentProp
     */
    public function setSeedTime(int $seed_time): TorrentProp
    {
        $this->seed_time = $seed_time;
        return $this;
    }

    /**
     * @return int
     */
    public function getUlslots(): int
    {
        return $this->ulslots;
    }

    /**
     * @param int $ulslots
     * @return TorrentProp
     */
    public function setUlslots(int $ulslots): TorrentProp
    {
        $this->ulslots = $ulslots;
        return $this;
    }
}