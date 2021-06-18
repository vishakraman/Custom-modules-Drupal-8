<?php

namespace Drupal\trajenta_link_generator\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;

/**
 * Class DisplayTableController.
 *
 * @package Drupal\trajenta_link_generator\Controller
 */
class ReferralLinksDisplay extends ControllerBase {

  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function display() {

    //create table header
    $header_table = array(
      'pid'=>    t('PID'),
      'veevaid' => t('Veeva Id'),
      'destination' => t('Destination URL'),
    );

      //select records from table
    $query = \Drupal::database()->select('trajentalink', 'm');
      $query->fields('m', ['pid','veevaid','destination']);
      $results = $query->execute()->fetchAll();
        $rows=array();

    foreach($results as $data){
        $delete = Url::fromUserInput('/referrallinks/form/delete/'.$data->pid);
        $edit   = Url::fromUserInput('/referrallinks/form/update?num='.$data->pid);

      //print the data from table
      $rows[] = array(
        'pid' =>$data->pid,
        'veevaid' => $data->veevaid,
        'destination' => $data->destination,
        \Drupal::l('Delete', $delete),
        \Drupal::l('Edit', $edit),
      );
}
    //display data in site
    $form['table'] = [
            '#type' => 'table',
            '#header' => $header_table,
            '#rows' => $rows,
            '#empty' => t('No users found'),
        ];
        return $form;
}
}