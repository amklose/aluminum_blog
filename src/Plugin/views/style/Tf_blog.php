<?php

namespace Drupal\tf_blog\Plugin\views\style;

use Drupal\core\form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render a list of blog teasers in reverse chronological order
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "blog",
 *   title = @Translation("Blog"),
 *   help = @Translation("Render a list of blog teasers in reverse chronological
 *       order linked to blog content"),
 *   theme = "views_view_tf_blog",
 *   display_type = { "normal" }
 * )
 */
class Tf_blog extends StylePluginBase {

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['path'] = ['default' => 'blog'];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    // Path for blog links
    $form['path'] = [
      '#type' => 'textfield',
      '#title' => t('Link path'),
      '#default_value' => (isset($this->options['path']) ? $this->options['path'] : 'blog'),
      '#description' => t('Path prefix for each blog link, e.g. example.com<strong>/blog/</strong>2017/10'),
    ];

    // Month date format.
    $form['month_date_format'] = [
      '#type' => 'textfield',
      '#title' => t('Month date format'),
      '#default_value' => (isset($this->options['month_date_format']) ? $this->options['month_date_format'] : 'm'),
      '#description' => t('Valid PHP <a href="@url" target="_blank">Date function</a> parameter to display months.', ['@url' => 'http://php.net/manual/en/function.date.php']),
    ];

    // Whether month links should be nested inside year links.
    $options = [1 => 'yes', 2 => 'no'];
    $form['nesting'] = [
      '#type' => 'radios',
      '#title' => t('Nesting'),
      '#options' => $options,
      '#default_value' => (isset($this->$options['nesting']) ? $this->options['nesting'] : '1'),
      '#description' => t('Should months be nested inside years?'),
    ];

    // Extra CSS classes.
    $form['classes'] = [
      '#type' => 'textfield',
      '#title' => t('CSS classes'),
      '#default_value' => (isset($this->options['classes']) ? $this->options['classes'] : 'view--blog'),
      '#description' => t('CSS classes for further customization of the blog page.'),
    ];
  }
}
