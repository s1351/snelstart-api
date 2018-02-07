<?php

namespace s1351\SnelStartApi;

use s1351\SnelStartApi\Client\Auth;

class SnelStartApi
{
  private $auth;

  /**
   * Construct class.
   *
   * @param  string  $apiKey
   * @return void
   */
  public function __construct($apiKey)
  {
    // Set authentication.
    $this->auth = new Auth;
    $this->auth->setApiKey($apiKey);
  }

  /**
   * Access verkooporder actions.
   * 
   * @return VerkoopOrders
   */
  public function verkoopOrders()
  {
    return new VerkoopOrdersAction($this->auth);
  }

}