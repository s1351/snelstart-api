<?php

namespace s1351\SnelStartApi\Client;

class Auth
{
  /**
   * Your API key.
   * 
   * @var string
   */
  private $apiKey;

  /**
   * Returns the current API key.
   * 
   * @return string
   */
  public function get()
  {
    return $this->apiKey;
  }

  /**
   * Set the current API key.
   *
   * @param  string  $apiKey
   * @return void
   */
  public function set($apiKey)
  {
    $this->apiKey = $apiKey;
  }

}