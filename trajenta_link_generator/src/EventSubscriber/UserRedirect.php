<?php

namespace Drupal\trajenta_link_generator\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class UserRedirect.
 */
class UserRedirect implements EventSubscriberInterface {

  /**
   * Constructor.
   */
  public function __construct() {
  }


  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['userRedirect'];
   // $events[KernelEvents::RESPONSE][] = ['onRespond'];
    return $events;
  }
  //   public function onRespond(FilterResponseEvent $event) {
  //     $response = $event->getResponse();
  //     $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate, post-check=0, pre-check=0');
  // }
  /**
   * Code that should be triggered on event specified
   */
  public function userRedirect() {
    // Check current path.
    $current_path = \Drupal::service('path.current')->getPath();
    $current_path = str_replace("/","",$current_path);

      //Fetching the veevaid from the db
        $conn = \Drupal::database();
        $query = $conn->select('trajentalink', 'm')
        ->condition('veevaid', $current_path)
        ->fields('m');
        $data = [];
        $data = $query->execute()->fetchAssoc();
        $data['veevaid'] = $data['veevaid'] ?? '';

    // Redirect the user to the destination link if the url matches the db veevaid.
    if ($current_path == $data['veevaid']) {
      $response = new RedirectResponse($data['destination'], 302);
      $response->send();
    }

  }
}