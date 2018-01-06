<?php
namespace Pbxg33k\UtorrentClient\Model;

abstract class BaseModel
{
    protected $map;

    public function fromHtml($html)
    {
        return $this->fromJson(\json_decode($html));
    }

    public function fromJson($json)
    {
        if(is_array($this->map)) {
            foreach($this->map as $propKey => $offset) {
                if(is_numeric($offset)) {
                    $this->{$propKey} = $json[$offset];
                } else {
                    $this->{$propKey} = $json->{$offset};
                }
            }
            return $this;
        } else {
            throw new \Exception('No mapping found and fromJson not overridden');
        }
    }

    /**
     * Transform object into its original format as returned by uTorrent
     */
    public function toOriginal()
    {
        if(is_array($this->map)) {
            $returnArray = [];
            foreach($this->map as $propKey => $offset) {
                if(is_numeric($offset)) {
                    $returnArray[] = $this->{$propKey};
                } else {
                    $returnArray[$offset] = $this->{$propKey};
                }
            }

            return $returnArray;
        } else {
            throw new \Exception('No mapping found and toOriginal not overridden');
        }
    }
}