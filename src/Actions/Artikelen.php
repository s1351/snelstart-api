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
   * @param  array   $data
   * @param  string  $url
   * @return bool
   */
  public function get(array $data = [], $url = 'artikelen')
  {
    $this->request->setMethod('GET');
    $this->request->setUrl($url);
    $this->request->setData($data);

    return $this->request->request();
  }

}