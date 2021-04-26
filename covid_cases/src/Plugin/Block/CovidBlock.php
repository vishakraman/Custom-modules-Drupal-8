<?php

namespace Drupal\covid_cases\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Block of Corona Cases... you can't make this stuff up.
 *
 * @Block(
 *   id = "covid_tracker_block",
 *   admin_label = @Translation("Covid Live Tracker Block")
 * )
 */
class CovidBlock extends BlockBase implements ContainerFactoryPluginInterface {
 /**
   * @var \Drupal\cat_facts\CatFactsClient
   */
  protected $coronaservice;

  /**
   * CatFacts constructor.
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   * @param $corona_api \Drupal\covid_cases\CovidApi
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $corona_api) 
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->coronaservice = $corona_api;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('covid_cases')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $countries = $this->coronaservice->countries();
    $states = $this->coronaservice->states();
    $travel = $this->coronaservice->travel();
    return [
      '#theme' => 'covid_live_tracker',
      '#countriesdata' => $countries,
      '#statedata' => $states,
      '#traveldata' => $travel,
      '#attached' => array(
        'library' => array('covid_cases/covid_cases'),
        ),
    ];
  }

}
