<?php
namespace Drupal\trajenta_link_generator\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Render\Element;
/**
 * Class DeleteForm.
 *
 * @package Drupal\trajenta_link_generator\Form
 */
class DeleteLinks extends ConfirmFormBase {
/**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'delete_form';
  }
  public $pid;

  public function getQuestion() { 
    return t('Do you want to delete %pid?', array('%pid' => $this->pid));
  }

  public function getCancelUrl() {
    return new Url('trajenta_link_generator.display');
  }

  public function getDescription() {
    return t('Only do this if you are sure!');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete it!');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelText() {
    return t('Cancel');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $pid = NULL) {
       $this->pid = $pid;
      return parent::buildForm($form, $form_state);
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
       $query = \Drupal::database();
       $query->delete('trajentalink')
                   ->condition('pid',$this->pid)
                  ->execute();
             drupal_set_message("succesfully deleted");
            $form_state->setRedirect('trajenta_link_generator.display');
  }
}