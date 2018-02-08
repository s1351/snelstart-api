<?php

namespace s1351\SnelStartApi\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class Request
{
  /**
   * Options array.
   *
   * @var array
   */
  private $options;

  /**
   * Containers.
   *
   * @var
   */
  private $auth;
  private $url;
  private $data;
  private $method;

  /**
   * Construct class.
   *
   * @var
   */
  public function __construct($auth)
  {
    $this->auth = $auth;
  }

  /**
   * Set data.
   * 
   * @param  array  $data
   * @return void
   */
  public function setData(array $data)
  {
    $this->data = json_encode($data);
  }

  /**
   * Set method.
   * 
   * @param  string  $method
   * @return void
   */
  public function setMethod(string $method)
  {
    $this->method = $method;
  }

  /**
   * Set url.
   * 
   * @param  string $url
   * @return void
   */
  public function setUrl(string $url)
  {
    $this->url = $this->auth->getApiUrl() . $url;
  }
  /**
   * Create a request.
   * 
   * @return mixed
   */
  public function request()
  {
    $headers = [
      'Content-Type'              => 'application/x-www-form-urlencoded',
      'Ocp-Apim-Subscription-Key' => $this->auth->getSubscriptionKey(),
      'Authorization'             => $this->auth->getToken(),
    ];

    $request = new GuzzleRequest($this->method, $this->url, $headers, $this->data);

    return json_decode((new Client())->send($request)->getBody(), true);
  }

}