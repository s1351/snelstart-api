<?php

namespace s1351\SnelStartAPI;

use s1351\SnelStartAPI\Client\Auth;
use s1351\SnelStartAPI\Client\Request;

class SnelStartApi
{
  private $auth;

  /**
   * Construct class.
   *
   * @param  string  $apiKey
   * @param  string  $subscriptionKey
   * @return void
   */
  public function __construct($apiKey, $subscriptionKey)
  {
    // Set authentication.
    $this->auth = new Auth;
    $this->auth->setCredentials($apiKey, $subscriptionKey);
  }

  /**
   * Send API call.
   *
   * @param  array   $data
   * @param  string  $url
   * @param  string  $method
   * @return mixed
   */
  public function send(array $data = [], $url, $method = 'GET')
  {
    $request = new Request($this->auth);

    $request->setData($data);
    $request->setUrl($url);
    $request->setMethod($method);

    return $request->request();
  }

}