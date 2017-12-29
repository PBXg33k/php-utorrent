<?php
namespace Pbxg33k\UtorrentClient\Model;

class Token
{
    /**
     * @var \DateTimeInterface
     */
    protected $createdDateTime;

    /**
     * @var \DateTimeInterface
     */
    protected $expirationDateTime;

    /**
     * @var string
     */
    protected $token;

    public function __construct(string $token)
    {
        $this->createdDateTime = new \DateTime('now');
        $this->expirationDateTime = new \DateTime('+ 25 min');
        $this->token = $token;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedDateTime(): \DateTimeInterface
    {
        return $this->createdDateTime;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getExpirationDateTime(): \DateTimeInterface
    {
        return $this->expirationDateTime;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    public function __toString()
    {
        return ($this->token) ?: '';
    }
}