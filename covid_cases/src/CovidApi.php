<?php

namespace Drupal\covid_cases;

use Drupal\Component\Serialization\Json;
use GuzzleHttp\Exception\GuzzleException;


class CovidApi {
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
      'base_uri' => 'https://www.trackcorona.live/api/',
    ]);
  }

  /**
   * Get some random api facts.
   *
   *
   * @return array
   */
  public function countries() {
  	try {
  	 $response =  $this->client->get('countries', [
  		 	'query' => [
				]
  		 ]);
     return Json::decode($response->getBody());
  	}
    catch (GuzzleException $error) {
        $response = $error->getResponse();
   // Get the info returned from the remote server.
      watchdog_exception('corona_live_tracker', $error,$error->getMessage());
       return Json::decode($response->getBody()->getContents());
     }
  }

    /**
   * Get some random api facts.
   *
   *
   * @return array
   */
  public function states() {
    try{
    $response = $this->client->get('cities', [
      'query' => [
      ]
    ]);

    return Json::decode($response->getBody());
      }
      catch (GuzzleException $error) {
        $response = $error->getResponse();
   // Get the info returned from the remote server.
      watchdog_exception('corona_live_tracker', $error,$error->getMessage());
       return Json::decode($response->getBody()->getContents());
     }
    
  }

      /**
   * Get some random api facts.
   *
   *
   * @return array
   */
  public function travel() {
    try{
    $response = $this->client->get('travel', [
      'query' => [
      ]
    ]);

    return Json::decode($response->getBody());
      }
      catch (GuzzleException $error) {
        $response = $error->getResponse();
   // Get the info returned from the remote server.
      watchdog_exception('corona_live_tracker', $error,$error->getMessage());
       return Json::decode($response->getBody()->getContents());
     }
  }

}