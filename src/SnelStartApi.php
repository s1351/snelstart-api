<?php

namespace s1351\SnelStartApi;

use s1351\SnelStartApi\Client\Auth;
use s1351\SnelStartApi\Actions\Artikelen as ArtikelenAction;
use s1351\SnelStartApi\Actions\VerkoopOrders as VerkoopOrdersAction;

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
   * Access artikelen actions.
   * 
   * @return Artikelen
   */
  public function artikelen()
  {
    return new ArtikelenAction($this->auth);
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