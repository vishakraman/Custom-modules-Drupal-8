<?php

namespace Drupal\image_api\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Implements a codimth Simple Form API.
 */
class imageSettings extends FormBase
{

  /**
   * @return string
   */
  public function getFormId()
  {
    return 'imagesettings_form';
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
        // Select.
    $form['color'] = [
      '#type' => 'select',
      '#title' => $this->t('Favorite color'),
      '#options' => [
        'red' => $this->t('Red'),
        'blue' => $this->t('Blue'),
        'green' => $this->t('Green'),
      ],
      '#empty_option' => $this->t('-select-'),
      '#description' => $this->t('Select, #type = select'),
    ];


    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }


  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {

  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $color = $form_state->getValue('color');
    $url = Url::fromRoute('image_api.imagesettings', [], ['query' => ['q' => $color]]);
    $form_state->setRedirectUrl($url);
  }

}