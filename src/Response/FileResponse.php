<?php
namespace Pbxg33k\UtorrentClient\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\UtorrentClient\Model\File;

class FileResponse extends BaseResponse
{
    /**
     * @var int
     */
    protected $build;

    /**
     * @var ArrayCollection
     */
    protected $files;

    /**
     * @var string
     */
    private $torrentHash;

    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    /**
     * @param $json
     * @return $this
     * @throws \Exception
     */
    public function fromJson($json)
    {
        $this->build = $json->build;

        $fileCount = count($json->files);
        for($i = 0; $i < $fileCount; $i++) {
            // First item in the array is the hash of the torrent
            if($i==0) {
                $this->torrentHash = $json->files[$i];
            } else {
                $this->files->add((new File)->fromJson($json->files[$i][0]));
            }
        }

        return $this;
    }

    /**
     * Return this object in a string format as originaly
     * returned from uTorrent web API
     * @return string
     */
    protected function toOrigFormat(): \stdClass
    {
        $returnObj = new \stdClass();
        $returnObj->build = $this->build;
        $returnObj->files = array_merge([$this->torrentHash], $this->collectionToOrigJson($this->files));

        return $returnObj;
    }

    /**
     * @return int
     */
    public function getBuild(): int
    {
        return $this->build;
    }

    /**
     * @return ArrayCollection
     */
    public function getFiles(): ArrayCollection
    {
        return $this->files;
    }

    /**
     * @return string
     */
    public function getTorrentHash(): string
    {
        return $this->torrentHash;
    }
}