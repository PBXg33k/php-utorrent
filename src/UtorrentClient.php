<?php
namespace Pbxg33k\UtorrentClient;

use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Pbxg33k\UtorrentClient\Model;
use Pbxg33k\UtorrentClient\Response\PropResponse;
use Pbxg33k\UtorrentClient\Response\SettingsResponse;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Pbxg33k\UtorrentClient\Response\ListResponse;

class UtorrentClient
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $cache;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $path = "/gui/";

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var Model\Token
     */
    protected $token;

    public function __construct($host,$port,$username,$password,$path = '/gui/')
    {
        $this
            ->setHost($host)
            ->setPort($port)
            ->setUsername($username)
            ->setPassword($password)
            ->setPath($path);
    }

    /**
     * @return Model\Token
     */
    public function getToken()
    {
        $cacheKey = "{$this->getCachePrefix()}_token";
        $cacheItem = $this->cache->getItem($cacheKey);
        $tokenExists = isset($this->token);

        if($cacheItem->isHit()) {
            /** @var Model\Token $token */
            $token = $cacheItem->get();
            $expDateTime = $token->getExpirationDateTime();
            if($expDateTime > new \DateTime()) {
                $this->token = $token;
                $tokenExists = true;
            }
        }

        if(!$tokenExists) {
            $token = $this->doTokenRequest();
            $token = $token->getBody()->getContents();
            if (preg_match("~\<div\sid=\'token\'[^\>]+\>(.*)?\<\/div\>~", $token, $matches)) {
                $this->token = new Model\Token($matches[1]);
                $cacheItem->set($this->token);
                $cacheItem->expiresAt($this->token->getExpirationDateTime());
                $this->cache->save($cacheItem);
            }
        }

        return $this->token;
    }

    /**
     * @param Model\Token $token
     * @return UtorrentClient
     */
    public function setToken(Model\Token $token): UtorrentClient
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return ListResponse
     */
    public function getTorrents()
    {
        $response = $this->doRequest($this->constructRequest(null,['list' => 1]));
        $listResponse = (new ListResponse())->setCache($this->cache)->fromHtml($response->getBody()->getContents());
        return $listResponse;
    }

    /**
     * @param string $hash
     * @return PropResponse
     */
    public function getTorrent(string $hash) {
        $response = $this->doRequest($this->constructRequest(null,[
            'action' => 'getprops',
            'hash' => $hash
        ]));

        return (new PropResponse())->fromHtml($response->getBody()->getContents());
    }

    /**
     * @return SettingsResponse
     */
    public function getSettings()
    {
        $response = $this->doRequest($this->constructRequest(null, ['action' => 'getsettings']));

        return (new SettingsResponse())->fromHtml($response->getBody()->getContents());
    }

//    WIP

//    public function setSettings()
//    {
//        // Get the current settings in order to diff
//        // and send one or more requests with only the updated values
//        // This can be one or more requests
//        $oldSettings = $this->getSettings();
//
//        // When sending updated settings to uTorrent use this:
//        //s:superseed
//        //v:0
//        //s:dht
//        //v:0
//        //s:pex
//        //v:0
//        //
//        // S: Key
//        // V: Value
//
//        // If A-OK, response will be a HTTP Status 200 with only the build number in the response
//    }

    /**
     * Makes a request.
     *
     * @param RequestInterface $request An origin request instance
     *
     * @return ResponseInterface An origin response instance
     */
    protected function doRequest($request) : ResponseInterface
    {
        $request = $this->addTokenToRequest($request);

        return $this->getClient()->send($request, [
            'auth' => [$this->username, $this->password]
        ]);
    }

    /**
     * Adds the token to the passed request
     *
     * @param RequestInterface $request
     * @return RequestInterface
     */
    protected function addTokenToRequest(RequestInterface $request) : RequestInterface {
        if(!$this->token) {
            $this->token = $this->getToken();
        }

        // Make sure the first parameter is token
        $query = rtrim("token={$this->token}&{$request->getUri()->getQuery()}", '&');

        return $request->withUri($request->getUri()->withQuery($query));
    }

    /**
     * @return ResponseInterface
     */
    protected function doTokenRequest()
    {
        return $this->getClient()->request('GET', $this->constructRequest('token.html')->getUri(), [
            'auth' => [$this->username, $this->password]
        ]);
    }

    /**
     * @param string $path
     * @param array $parameters
     * @return Request
     */
    protected function constructRequest($path = null, array $parameters = []) : Request
    {
        $scheme = (strpos($path, 'http') !== 0) ? 'http://' : '';
        $uri = "{$scheme}{$this->host}:{$this->port}{$this->path}{$path}";

        $requestUri = (new Uri(  $uri))->withQuery(implode('&', array_map(
            function ($v, $k) { return sprintf("%s=%s", $k, $v); },
            $parameters,
            array_keys($parameters)
        )));

        $authString = base64_encode("{$this->username}:{$this->password}");

        $request = new Request('GET', $requestUri, [
            'Authorization' => "Basic {$authString}"
        ]);

        return $request;
    }

    protected function getCachePrefix(): string
    {
        return hash('crc32', $this->constructRequest()->getUri());
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $address
     * @return UtorrentClient
     */
    public function setHost(string $address): UtorrentClient
    {
        $this->host = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return UtorrentClient
     */
    public function setPort(int $port): UtorrentClient
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return UtorrentClient
     */
    public function setPath(string $path): UtorrentClient
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return UtorrentClient
     */
    public function setUsername(string $username): UtorrentClient
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UtorrentClient
     */
    public function setPassword(string $password): UtorrentClient
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param CacheItemPoolInterface $cache
     */
    public function setCache(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        if(!$this->client) {
            $this->setClient(new Client());
        }

        return $this->client;
    }

    /**
     * @param ClientInterface $client
     * @return UtorrentClient
     */
    public function setClient(ClientInterface $client): UtorrentClient
    {
        $this->client = $client;
        return $this;
    }
}