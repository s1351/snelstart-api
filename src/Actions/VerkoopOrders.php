<?php

namespace s1351\SnelStartApi\Actions;

use s1351\SnelStartApi\Client\Request;

class VerkoopOrders
{
  /**
   * Request container.
   *
   * @var
   */
  private $request;

  /**
   * Construct class.
   * 
   * @param  Auth $auth
   * @return void
   */
  public function __construct($auth)
  {
    $this->request = new Request($auth);
  }

  /**
   * Post verkoopboekingen request.
   *
   * @param  array   $data
   * @param  string  $url
   * @return bool
   */
  public function post(array $data = [], $url = 'verkooporders')
  {
    $this->request->setData($data);
    $this->request->setUrl($url);
    $this->request->setMethod('POST');

    return $this->request->request();
  }

}