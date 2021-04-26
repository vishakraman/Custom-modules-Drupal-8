<?php

namespace Drupal\image_api\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Block of Corona Cases... you can't make this stuff up.
 *
 * @Block(
 *   id = "image_api_block",
 *   admin_label = @Translation("Pixa Image API Block")
 * )
 */
class PixaBlock extends BlockBase implements ContainerFactoryPluginInterface {
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
   * @param $pixa_api \Drupal\image_api\PixabayApi
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, $pixa_api) 
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->pixaservice = $pixa_api;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('pixa_api')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $images = $this->pixaservice->images();
    return [
      '#theme' => 'image_api',
      '#images' => $images,
      '#attached' => array(
        'library' => array('image_api/image_api'),
        ),
    ];
  }

}
