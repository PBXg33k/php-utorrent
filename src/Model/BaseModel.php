<?php
namespace Pbxg33k\UtorrentClient\Model;

abstract class BaseModel
{
    public function fromHtml($html)
    {
        return $this->fromJson(\json_decode($html));
    }

    abstract public function fromJson($json);
}