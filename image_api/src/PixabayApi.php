<?php

namespace Drupal\image_api;

use Drupal\Component\Serialization\Json;
use GuzzleHttp\Exception\GuzzleException;


class PixabayApi {
	 /**
   * @var \GuzzleHttp\Client
   */
  protected $client;

  /**
   * CovidCases constructor.
   *
   * @param $http_client_factory \Drupal\Core\Http\ClientFactory
   */
  public function __construct($http_client_factory) {
    $this->client = $http_client_factory->fromOptions([
      'base_uri' => 'https://pixabay.com/api/',
    ]);
  }

  /**
   * Get some random api facts.
   *
   *
   * @return array
   */
  public function images() {
    $color = \Drupal::request()->query->get('q');
  	try {
  	 $response =  $this->client->get('', [
        'query' => [
           'key' => '21325036-23f3bcc2d767a6d9102c66c8e',
            'q' => $color,
				]
  		 ]);
     return Json::decode($response->getBody());
  	}
    catch (GuzzleException $error) {
        $response = $error->getResponse();
   // Get the info returned from the remote server.
      watchdog_exception('image_api', $error,$error->getMessage());
       return Json::decode($response->getBody()->getContents());
     }
  }

    /**
   * Get some random api facts.
   *
   *
   * @return array
   */
  // public function states() {
  //   try{
  //   $response = $this->client->get('cities', [
  //     'query' => [
  //     ]
  //   ]);

  //   return Json::decode($response->getBody());
  //     }
  //     catch (GuzzleException $error) {
  //       $response = $error->getResponse();
  //  // Get the info returned from the remote server.
  //     watchdog_exception('corona_live_tracker', $error,$error->getMessage());
  //      return Json::decode($response->getBody()->getContents());
  //    }
    
  // }

      /**
   * Get some random api facts.
   *
   *
   * @return array
   */
  // public function travel() {
  //   try{
  //   $response = $this->client->get('travel', [
  //     'query' => [
  //     ]
  //   ]);

  //   return Json::decode($response->getBody());
  //     }
  //     catch (GuzzleException $error) {
  //       $response = $error->getResponse();
  //  // Get the info returned from the remote server.
  //     watchdog_exception('corona_live_tracker', $error,$error->getMessage());
  //      return Json::decode($response->getBody()->getContents());
  //    }
  // }

}