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
}