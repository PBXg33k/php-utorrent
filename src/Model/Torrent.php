<?php
namespace Pbxg33k\UtorrentClient\Model;

class Torrent extends BaseModel
{
    /**
     * @var string
     */
    protected $hash;
    /**
     * @var int
     * 1 = Started2 = Checking4 = Start after check8 = Checked16 = Error32 = Paused64 = Queued128 = Loaded
     */
    protected $status;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var int
     */
    protected $size;
    /**
     * @var int
     */
    protected $progress;
    /**
     * @var int
     */
    protected $downloaded;
    /**
     * @var int
     */
    protected $uploaded;
    /**
     * @var int
     */
    protected $ratio;
    /**
     * @var int
     */
    protected $uploadSpeed;
    /**
     * @var int
     */
    protected $downloadSpeed;
    /**
     * @var int
     */
    protected $eta;
    /**
     * @var string
     */
    protected $label;
    /**
     * @var int
     */
    protected $peersConnected;
    /**
     * @var int
     */
    protected $peersInSwarm;
    /**
     * @var int
     */
    protected $seedsConnected;
    /**
     * @var int
     */
    protected $seedsInSwarm;
    /**
     * @var int
     */
    protected $availability;
    /**
     * @var int
     */
    protected $queueOrder;
    /**
     * @var int
     */
    protected $remaining;

    public function fromJson($json)
    {
        $this->hash = $json[0];
        $this->status = $json[1];
        $this->name = $json[2];
        $this->size = $json[3];
        $this->progress = $json[4];
        $this->downloaded = $json[5];
        $this->uploaded = $json[6];
        $this->ratio = $json[7];
        $this->uploadSpeed = $json[8];
        $this->downloadSpeed = $json[9];
        $this->eta = $json[10];
        $this->label = $json[11];
        $this->peersConnected = $json[12];
        $this->peersInSwarm = $json[13];
        $this->seedsConnected = $json[14];
        $this->seedsInSwarm = $json[15];
        $this->availability = $json[16];
        $this->queueOrder = $json[17];
        $this->remaining = $json[18];

        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return Torrent
     */
    public function setHash(string $hash): Torrent
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Torrent
     */
    public function setStatus(int $status): Torrent
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Torrent
     */
    public function setName(string $name): Torrent
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return Torrent
     */
    public function setSize(int $size): Torrent
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @param int $progress
     * @return Torrent
     */
    public function setProgress(int $progress): Torrent
    {
        $this->progress = $progress;
        return $this;
    }

    /**
     * @return int
     */
    public function getDownloaded(): int
    {
        return $this->downloaded;
    }

    /**
     * @param int $downloaded
     * @return Torrent
     */
    public function setDownloaded(int $downloaded): Torrent
    {
        $this->downloaded = $downloaded;
        return $this;
    }

    /**
     * @return int
     */
    public function getUploaded(): int
    {
        return $this->uploaded;
    }

    /**
     * @param int $uploaded
     * @return Torrent
     */
    public function setUploaded(int $uploaded): Torrent
    {
        $this->uploaded = $uploaded;
        return $this;
    }

    /**
     * @return int
     */
    public function getRatio(): int
    {
        return $this->ratio;
    }

    /**
     * @param int $ratio
     * @return Torrent
     */
    public function setRatio(int $ratio): Torrent
    {
        $this->ratio = $ratio;
        return $this;
    }

    /**
     * @return int
     */
    public function getUploadSpeed(): int
    {
        return $this->uploadSpeed;
    }

    /**
     * @param int $uploadSpeed
     * @return Torrent
     */
    public function setUploadSpeed(int $uploadSpeed): Torrent
    {
        $this->uploadSpeed = $uploadSpeed;
        return $this;
    }

    /**
     * @return int
     */
    public function getDownloadSpeed(): int
    {
        return $this->downloadSpeed;
    }

    /**
     * @param int $downloadSpeed
     * @return Torrent
     */
    public function setDownloadSpeed(int $downloadSpeed): Torrent
    {
        $this->downloadSpeed = $downloadSpeed;
        return $this;
    }

    /**
     * @return int
     */
    public function getEta(): int
    {
        return $this->eta;
    }

    /**
     * @param int $eta
     * @return Torrent
     */
    public function setEta(int $eta): Torrent
    {
        $this->eta = $eta;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Torrent
     */
    public function setLabel(string $label): Torrent
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeersConnected(): int
    {
        return $this->peersConnected;
    }

    /**
     * @param int $peersConnected
     * @return Torrent
     */
    public function setPeersConnected(int $peersConnected): Torrent
    {
        $this->peersConnected = $peersConnected;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeersInSwarm(): int
    {
        return $this->peersInSwarm;
    }

    /**
     * @param int $peersInSwarm
     * @return Torrent
     */
    public function setPeersInSwarm(int $peersInSwarm): Torrent
    {
        $this->peersInSwarm = $peersInSwarm;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeedsConnected(): int
    {
        return $this->seedsConnected;
    }

    /**
     * @param int $seedsConnected
     * @return Torrent
     */
    public function setSeedsConnected(int $seedsConnected): Torrent
    {
        $this->seedsConnected = $seedsConnected;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeedsInSwarm(): int
    {
        return $this->seedsInSwarm;
    }

    /**
     * @param int $seedsInSwarm
     * @return Torrent
     */
    public function setSeedsInSwarm(int $seedsInSwarm): Torrent
    {
        $this->seedsInSwarm = $seedsInSwarm;
        return $this;
    }

    /**
     * @return int
     */
    public function getAvailability(): int
    {
        return $this->availability;
    }

    /**
     * @param int $availability
     * @return Torrent
     */
    public function setAvailability(int $availability): Torrent
    {
        $this->availability = $availability;
        return $this;
    }

    /**
     * @return int
     */
    public function getQueueOrder(): int
    {
        return $this->queueOrder;
    }

    /**
     * @param int $queueOrder
     * @return Torrent
     */
    public function setQueueOrder(int $queueOrder): Torrent
    {
        $this->queueOrder = $queueOrder;
        return $this;
    }

    /**
     * @return int
     */
    public function getRemaining(): int
    {
        return $this->remaining;
    }

    /**
     * @param int $remaining
     * @return Torrent
     */
    public function setRemaining(int $remaining): Torrent
    {
        $this->remaining = $remaining;
        return $this;
    }


}