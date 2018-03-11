<?php
namespace Pbxg33k\UtorrentClient\Model;


class File extends BaseModel
{
    /**
     * @var string
     */
    protected $filename;

    /**
     * @var integer
     */
    protected $filesize;

    /**
     * @var integer
     */
    protected $downloaded;

    /**
     * @var integer
     */
    protected $priority;

    /**
     * @var array
     */
    protected $map = [
        'filename' => 0,
        'filesize' => 1,
        'downloaded' => 2,
        'priority' => 3
    ];

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return File
     */
    public function setFilename(string $filename): File
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return int
     */
    public function getFilesize(): int
    {
        return $this->filesize;
    }

    /**
     * @param int $filesize
     * @return File
     */
    public function setFilesize(int $filesize): File
    {
        $this->filesize = $filesize;
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
     * @return File
     */
    public function setDownloaded(int $downloaded): File
    {
        $this->downloaded = $downloaded;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return File
     */
    public function setPriority(int $priority): File
    {
        $this->priority = $priority;
        return $this;
    }


}