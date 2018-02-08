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
   * You subscription key.
   *
   * @var
   */
  private $subscriptionKey;

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
   * @param  string  $subscriptionKey
   * @return void
   */
  public function setCredentials($apiKey, $subscriptionKey)
  {
    // Set the API key.
    $this->setApiKey($apiKey);

    // Get the username and password from the API key.
    list($username, $password) = explode(':', base64_decode($apiKey));

    // Set the username and password.
    $this->setUsername($username);
    $this->setPassword($password);

    // Set the subscription key for the application.
    $this->setSubscriptionKey($subscriptionKey);

    // Set the access token for the application.
    $this->setToken();
  }

  /**
   * Return API uri.
   * 
   * @return string
   */
  public function getApiUrl()
  {
    return $this->apiUri;
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
   * Returns the current subscription key.
   * 
   * @return string
   */
  public function getSubscriptionKey()
  {
    return $this->subscriptionKey;
  }

  /**
   * Set subscription key.
   *
   * @param  string  $subscriptionKey
   * @return void
   */
  private function setSubscriptionKey($subscriptionKey)
  {
    $this->subscriptionKey = $subscriptionKey;
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
   * @return void
   */
  private function setToken()
  {
    $method = 'POST';
    $uri    = $this->authUri;
    $body   = "grant_type=clientkey&clientkey={$this->getApiKey()}";

    $headers = [
      'Content-Type' => 'application/x-www-form-urlencoded',
    ];

    $request  = new Request($method, $uri, $headers, $body);
    $response = json_decode((new Client())->send($request)->getBody(), true);

    if (isset($response['access_token'])) {
      $this->token = $response['access_token'];
    }
  }

}