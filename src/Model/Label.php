<?php
namespace Pbxg33k\UtorrentClient\Model;

class Label extends BaseModel
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $torrents;

    public function fromJson($json)
    {
        $this->name = $json[0];
        $this->torrents = $json[1];
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
     * @return Label
     */
    public function setName(string $name): Label
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getTorrents(): int
    {
        return $this->torrents;
    }

    /**
     * @param int $torrents
     * @return Label
     */
    public function setTorrents(int $torrents): Label
    {
        $this->torrents = $torrents;
        return $this;
    }


}