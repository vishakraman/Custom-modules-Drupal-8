<?php
namespace Drupal\trajenta_link_generator\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class MydataForm.
 *
 * @package Drupal\trajenta_link_generator\Form
 */
class UpdateLinks extends FormBase {
/**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'update_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    //Fetching from the db for default value
    $conn = Database::getConnection();
     $record = array();
    if (isset($_GET['num'])) {
        $query = $conn->select('trajentalink', 'm')
            ->condition('pid', $_GET['num'])
            ->fields('m');
        $record = $query->execute()->fetchAssoc();
    }

    $form['veevaid'] = array(
      '#type' => 'textfield',
      '#title' => t('Veeva ID:'),
      '#required' => TRUE,
       //'#default_values' => array(array('id')),
      '#default_value' => (isset($record['veevaid']) && $_GET['num']) ? $record['veevaid']:'',
      );
    $form['destination'] = array(
      '#type' => 'textfield',
      '#title' => t('Destination Link:'),
      '#default_value' => (isset($record['destination']) && $_GET['num']) ? $record['destination']:'',
      );

    $form['submit'] = [
        '#type' => 'submit',
        '#value' => 'save',
        //'#value' => t('Submit'),
    ];
    return $form;
  }
  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {
        
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $field=$form_state->getValues();

    $veevaid=$field['veevaid'];
    $destination=$field['destination'];

       if (isset($_GET['num'])) {
          $field  = array(
              'veevaid'   => $veevaid,
              'destination' =>  $destination,
          );

          //updating into the database!
          $query = \Drupal::database();
          $query->update('trajentalink')
              ->fields($field)
              ->condition('pid', $_GET['num'])
              ->execute();
          drupal_set_message("Succesfully Updated!");
          $form_state->setRedirect('trajenta_link_generator.display');
      }
       else
       {
           drupal_set_message("ID not Matching!");

       }
     }
}