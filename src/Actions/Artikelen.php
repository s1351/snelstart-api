<?php

namespace s1351\SnelStartApi\Actions;

use s1351\SnelStartApi\Client\Request;

class Artikelen
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
   * Get artikelen request.
   *
   * @return bool
   */
  public function get()
  {
    $this->request->setMethod('GET');
    $this->request->setUrl('artikelen');

    return $this->request->request();
  }

}