<?php  
/**  
 * @file  
 * Contains Drupal\site_location\Form\MessagesForm.  
 */  
namespace Drupal\site_location\Form;

use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  
  
class LocationSettingsForm extends ConfigFormBase {  
  
  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'site_location.settings';

  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'site_location_form';  
  }  

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['country'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Country:'),
      '#default_value' => $config->get('country'),
    );

    $form['city'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('City:'),
      '#default_value' => $config->get('city'),
    );

    $form['timezone'] = array (
      '#type' => 'select',
      '#title' => ('Select Timezone:'),
      '#default_value' => $config->get('timezone'),
      '#options' => array(
        'none' => $this->t('-None-'),
		    'America/Chicago' => $this->t('America/Chicago'),
        'America/New_York' => $this->t('America/New_York'),
        'Asia/Tokyo' => $this->t('Asia/Tokyo'),
        'Asia/Dubai' => $this->t('Asia/Dubai'),
        'Asia/Kolkata' => $this->t('Asia/Kolkata'),
        'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
        'Europe/Oslo' => $this->t('Europe/Oslo'),
        'Europe/London' => $this->t('Europe/London')
      ),
    );

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
    // Retrieve the configuration.
    $this->config(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();

    parent::submitForm($form, $form_state);

  }

}