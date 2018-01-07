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
                    $val = $json[$offset];
                } else {
                    $val = $json->{$offset};
                }
                $setterName = "set".implode('',array_map('ucfirst',explode('_',$propKey)));
                if(method_exists($this, $setterName)) {
                    $this->{$setterName}($val);
                } else {
                    $this->{$propKey} = $val;
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