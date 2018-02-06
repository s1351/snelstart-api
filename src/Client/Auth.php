<?php

namespace s1351\SnelStartApi\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Auth
{
  /**
   * Your API key.
   * 
   * @var string
   */
  private $apiKey;

  /**
   * Default API uri.
   *
   * @var
   */
  private $apiUri = 'https://b2bapi.snelstart.nl/v1/';

  /**
   * Default API auth uri.
   *
   * @var
   */
  private $authUri = 'https://auth.snelstart.nl/b2b/token';

  /**
   * Username and password.
   *
   * @var
   */
  private $username;
  private $password;

  /**
   * Access token.
   *
   * @var
   */
  private $token;

  /**
   * Set required credentials.
   * 
   * @param  string  $apiKey
   * @return void
   */
  public function setCredentials($apiKey)
  {
    $this->setApiKey($apiKey);

    list($username, $password) = explode(':', base64_decode($apiKey));

    $this->setUsername($username);
    $this->setPassword($password);
  }

  /**
   * Returns the current API key.
   * 
   * @return string
   */
  public function getApiKey()
  {
    return $this->apiKey;
  }

  /**
   * Set the current API key.
   *
   * @param  string  $apiKey
   * @return void
   */
  private function setApiKey($apiKey)
  {
    $this->apiKey = $apiKey;
  }

  /**
   * Get the username
   * 
   * @return string
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set username.
   *
   * @param  string  $username
   * @return void
   */
  private function setUsername($username)
  {
    $this->username = $username;
  }

  /**
   * Get password.
   * 
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set password.
   * 
   * @param  string  $password
   * @return void
   */
  private function setPassword($password)
  {
    $this->password = $password;
  }

  /**
   * Get access token.
   * 
   * @return string
   */
  public function getToken()
  {
    return $this->token;
  }

  /**
   * Set access token.
   *
   * @param string
   * @return void
   */
  private function setToken($apiKey)
  {
    $method = 'POST';
    $uri    = $this->authUri;
    $body   = "grant_type=password&amp;username={$this->username}&amp;{$this->password}";

    $headers = [
      'Content-Type' => 'application/x-www-form-urlencoded',
    ];

    $request = new Request($method, $uri, $headers, $body);

    $response = json_decode((new Client())->send($request)->getBody(), true);

    if (!isset($response['access_token'])) {
      $this->token = $response['access_token'];
    }
  }

}