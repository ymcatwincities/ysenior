<?php

namespace Drupal\social_feed_fetcher\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\CronInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\State\StateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form with examples on how to use cron.
 */
class SocialPostSettingsForm extends ConfigFormBase {

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * The cron service.
   *
   * @var \Drupal\Core\CronInterface
   */
  protected $cron;

  /**
   * The state keyvalue collection.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;


  /**
   * Request time value.
   *
   * @var int
   */
  private $requestTime;

  /**
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory, AccountInterface $current_user, CronInterface $cron, StateInterface $state, MessengerInterface $messenger_interface) {
    parent::__construct($config_factory);
    $this->currentUser = $current_user;
    $this->cron = $cron;
    $this->state = $state;
    $this->messenger = $messenger_interface;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('current_user'),
      $container->get('cron'),
      $container->get('state'),
      $container->get('messenger')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'social_feed_fetcher';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('social_feed_fetcher.settings');
    $this->requestTime = \Drupal::time()->getRequestTime();

    $next_execution = $this->state->get('social_feed_fetcher.next_execution');
    $next_execution = !empty($next_execution) ? $next_execution : $this->requestTime;

    $args = [
      '%time'    => date_iso8601($this->state->get('social_feed_fetcher.next_execution')),
      '%seconds' => $next_execution - $this->requestTime,
    ];
    $form['status']['last'] = [
      '#type'   => 'item',
      '#markup' => $this->t('The Social Feed Fetcher will next execute the first time the cron runs after %time (%seconds seconds from now)', $args),
    ];

    $form['facebook'] = [
      '#type'  => 'details',
      '#title' => $this->t('Facebook settings'),
      '#open'  => TRUE,
    ];

    $form['facebook']['facebook_enabled'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Enable'),
      '#default_value' => $config->get('facebook_enabled'),
    ];

    $form['facebook']['fb_page_name'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Facebook Page Name'),
      '#default_value' => $config->get('fb_page_name'),
      '#description'   => $this->t('eg. If your Facebook page URL is this http://www.facebook.com/YOUR_PAGE_NAME, <br />then you just need to add this YOUR_PAGE_NAME above.'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('facebook_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="facebook_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['facebook']['fb_app_id'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Facebook App ID'),
      '#default_value' => $config->get('fb_app_id'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('facebook_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="facebook_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['facebook']['fb_secret_key'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Facebook Secret Key'),
      '#default_value' => $config->get('fb_secret_key'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('facebook_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="facebook_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['facebook']['fb_user_token'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Facebook User Token'),
      '#default_value' => $config->get('fb_user_token'),
      '#size'          => 100,
      '#maxlength'     => 255,
      '#required'      => FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="facebook_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['facebook']['fb_no_feeds'] = [
      '#type'          => 'number',
      '#title'         => $this->t('Number of Feeds'),
      '#default_value' => $config->get('fb_no_feeds'),
      '#size'          => 60,
      '#maxlength'     => 60,
      '#max'           => 30,
      '#min'           => 1,
      '#states'        => [
        'visible' => [
          ':input[name="facebook_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];


    $form['twitter'] = [
      '#type'  => 'details',
      '#title' => $this->t('Twitter settings'),
      '#open'  => TRUE,
    ];

    $form['twitter']['twitter_enabled'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Enable'),
      '#default_value' => $config->get('twitter_enabled'),
    ];

    $form['twitter']['timeline'] = [
      '#type'          => 'radios',
      '#title'         => t('Timeline'),
      '#default_value' => $config->get('timeline'),
      '#options'       => [
        'home'    => 'Home timeline',
        'user'    => 'User timeline',
        'mention' => 'Mention timeline',
      ],
      '#description'   => $this->t("If you set 'User timeline' the following field is required."),
      '#states'        => [
        'visible' => [
          ':input[name="twitter_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['twitter']['screen_name'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Twitter User name'),
      '#default_value' => $config->get('screen_name'),
      '#description'   => $this->t("This field is usefull if you want to
       get post from 'user_timeline' instead of 'home_timeline' or 'mentions_timeline'."),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#states'        => [
        'visible' => [
          ':input[name="twitter_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['twitter']['tw_consumer_key'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Twitter Consumer Key'),
      '#default_value' => $config->get('tw_consumer_key'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('twitter_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="twitter_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['twitter']['tw_consumer_secret'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Twitter Consumer Secret'),
      '#default_value' => $config->get('tw_consumer_secret'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('twitter_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="twitter_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['twitter']['tw_access_token'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Twitter Access Token'),
      '#default_value' => $config->get('tw_access_token'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="twitter_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['twitter']['tw_access_token_secret'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Twitter Access Token Secret'),
      '#default_value' => $config->get('tw_access_token_secret'),
      '#description'   => $this->t("The Access Token Secret is no longer
       used as access token secret if you don't set access token. The twitter 
       app will use it as bearer token."),
      '#size'          => 60,
      '#maxlength'     => 200,
      '#required'      => $config->get('twitter_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="twitter_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['twitter']['tw_count'] = [
      '#type'          => 'number',
      '#title'         => $this->t('Tweets Count'),
      '#default_value' => $config->get('tw_count'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#min'           => 1,
      '#max'           => 30,
      '#states'        => [
        'visible' => [
          ':input[name="twitter_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['instagram'] = [
      '#type'  => 'details',
      '#title' => $this->t('Instagram settings'),
      '#open'  => TRUE,
    ];

    $form['instagram']['instagram_enabled'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Enable'),
      '#default_value' => $config->get('instagram_enabled'),
    ];
    $help_url = \Drupal::moduleHandler()->moduleExists('help')
      ? Url::fromRoute('help.page', ['name' => 'socialfeed'])->toString() : '#';
    $form['instagram']['header']['#markup'] = $this->t('To get Client ID you need to manage clients from your instagram account detailed information <a href="@admin" target="@blank">here</a>.', [
      '@admin' => $help_url,
      '@blank' => '_blank',
    ]);
    $form['instagram']['in_client_id'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Client ID'),
      '#description'   => $this->t('Client ID from Instagram account'),
      '#default_value' => $config->get('in_client_id'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('instagram_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="instagram_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['instagram']['in_redirect_uri'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Redirect URI'),
      '#description'   => $this->t('Redirect URI from Instagram account'),
      '#default_value' => $config->get('in_redirect_uri'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('instagram_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="instagram_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['instagram']['in_auth_link'] = [
      '#type'          => 'item',
      '#title'         => $this->t('Generate Instagram Access Token'),
      '#description'   => $this->t('Access this URL in your browser https://instagram.com/oauth/authorize/?client_id=&lt;your_client_id&gt;&redirect_uri=&lt;your_redirect_uri&gt;&response_type=token, you will get the access token.'),
      '#default_value' => $config->get('in.auth_link'),
      '#markup'        => $this->t('Check <a href="@this" target="_blank">this</a> article.', [
        '@this' => Url::fromUri('http://jelled.com/instagram/access-token')
          ->toString(),
      ]),
      '#states'        => [
        'visible' => [
          ':input[name="instagram_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['instagram']['in_access_token'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Access Token'),
      '#default_value' => $config->get('in_access_token'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('instagram_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="instagram_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['instagram']['in_picture_count'] = [
      '#type'          => 'number',
      '#title'         => $this->t('Picture Count'),
      '#default_value' => $config->get('in_picture_count'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#min'           => 1,
      '#max'           => 30,
      '#states'        => [
        'visible' => [
          ':input[name="instagram_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    if ($config->get('in_access_token')) {
      $form['instagram']['feed'] = [
        '#type'   => 'item',
        '#title'  => $this->t('Feed URL'),
        '#markup' => $this->t('https://api.instagram.com/v1/users/self/feed?access_token=@access_token&count=@picture_count',
          [
            '@access_token'  => $config->get('in_access_token'),
            '@picture_count' => $config->get('in_picture_count'),
          ]
        ),
      ];
    }
    $form['instagram']['in_picture_resolution'] = [
      '#type'          => 'select',
      '#title'         => $this->t('Picture Resolution'),
      '#default_value' => $config->get('in_picture_resolution'),
      '#options'       => [
        'thumbnail'           => $this->t('Thumbnail'),
        'low_resolution'      => $this->t('Low Resolution'),
        'standard_resolution' => $this->t('Standard Resolution'),
      ],
      '#states'        => [
        'visible' => [
          ':input[name="instagram_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['instagram']['in_post_link'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Show post URL'),
      '#default_value' => $config->get('in_post_link'),
      '#states'        => [
        'visible' => [
          ':input[name="instagram_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['linkedin'] = [
      '#type' => 'details',
      '#title' => $this->t('Linkedin settings'),
      '#open' => TRUE,
    ];

    $form['linkedin']['linkedin_enabled'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Enable'),
      '#default_value' => $config->get('linkedin_enabled'),
    ];
    $form['linkedin']['linkedin_feed_type'] = [
      '#type'          => 'radios',
      '#title' => $this->t('Feed type'),
      '#default_value' => $config->get('linkedin_feed_type'),
      '#options' => ['companies' => 'Company feed', 'people' => 'People feed'],
      '#states'        => [
        'visible'  => [
          ':input[name="linkedin_enabled"]' => ['checked' => TRUE],
        ]
      ]
    ];
    $form['linkedin']['linkedin_companies_id'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Linkedin company ID'),
      '#default_value' => $config->get('linkedin_companies_id'),
      '#description'   => $this->t("This field is usefull if you want to
       get post from 'company' instead of 'people'."),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#states'        => [
        'visible' => [
          ':input[name="linkedin_feed_type"]' => ['value' => 'companies'],
        ],
      ],
    ];
    $form['linkedin']['linkedin_client_id'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Client ID'),
      '#description'   => $this->t('Client ID from linkedin account'),
      '#default_value' => $config->get('linkedin_client_id'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('linkedin_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="linkedin_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['linkedin']['linkedin_secret_app'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('Secret app'),
      '#description'   => $this->t('Secret app'),
      '#default_value' => $config->get('linkedin_secret_app'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#required'      => $config->get('linkedin_enabled') ? TRUE : FALSE,
      '#states'        => [
        'visible' => [
          ':input[name="linkedin_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    $form['linkedin']['linkedin_posts_count'] = [
      '#type'          => 'number',
      '#title'         => $this->t('Linkedin Count'),
      '#default_value' => $config->get('linkedin_posts_count'),
      '#size'          => 60,
      '#maxlength'     => 100,
      '#min'           => 1,
      '#max' => 30,
      '#states'        => [
        'visible'  => [
          ':input[name="linkedin_enabled"]' => ['checked' => TRUE],
        ]
      ]
    ];
    $form['linkedin']['feed'] = [
      '#type'   => 'item',
      '#title'  => $this->t('Feed URL'),
      '#markup' => $this->t('Your url redirect is : @url_redirect',
        [
          '@url_redirect'  => \Drupal::request()->getHost() . '/oauth/callback',
        ]
      ),
      '#states' => [
        'visible'  => [
          ':input[name="linkedin_enabled"]' => ['checked' => TRUE],
        ],
      ],
    ];
    if ($config->get('linkedin_client_id') && $config->get('linkedin_secret_app')) {
      $url = Url::fromUri(
        'https://www.linkedin.com/oauth/v2/authorization',
        [
          'query' => [
            'response_type' => 'code',
            'client_id' => $config->get('linkedin_client_id'),
            'redirect_uri' => 'https://' . \Drupal::request()->getHost() . '/oauth/callback',
          ]
        ]
      );
      $form['linkedin']['url_connector'] = [
        '#type'   => 'item',
        '#title'  => $this->t('URL connector'),
        '#description' => $this->t('You need to click on this link to update the access token. this one expire all the 60 days.'),
        '#markup' => $this->t('Your url redirect is : <a href="@url_connector" target="@blank">here</a>',
          [
            '@url_connector'  => $url->toString(),
            '@blank' => '_blank',
          ]
        ),
      ];
      $access = $this->state->getMultiple(['access_token', 'expires_in', 'expires_in_save']);
      $time = time();
      $message = $this->t("You're disconnect to Linkedin API. You need to refresh the token");
      if (($access['expires_in_save'] + $access['expires_in']) > $time) {
        $message = $this->t("You're connected to Linkedin API.");
      }
      $form['linkedin']['connect_api'] = [
        '#type'   => 'item',
        '#title'  => $this->t('State API connection'),
        '#markup' => $message,
      ];
    }


    if ($this->currentUser->hasPermission('administer site configuration')) {
      $form['cron_run'] = [
        '#type'  => 'details',
        '#title' => $this->t('Run cron manually'),
        '#open'  => TRUE,
      ];
      $form['cron_run']['cron_trigger']['actions'] = ['#type' => 'actions'];
      $form['cron_run']['cron_trigger']['actions']['submit'] = [
        '#type'   => 'submit',
        '#value'  => $this->t('Run cron now'),
        '#submit' => [
          [
            $this,
            'cronRun',
          ],
        ],
      ];
    }

    $form['configuration'] = [
      '#type'  => 'details',
      '#title' => $this->t('Schedule Cron'),
      '#open'  => TRUE,
    ];
    $form['configuration']['social_feed_fetcher_interval'] = [
      '#type'          => 'select',
      '#title'         => $this->t('Cron interval'),
      '#description'   => $this->t('Time after which cron will respond to a processing request.'),
      '#default_value' => $config->get('social_feed_fetcher_interval'),
      '#options'       => [
        60    => $this->t('1 minute'),
        300   => $this->t('5 minutes'),
        600   => $this->t('10 minutes'),
        900   => $this->t('15 minutes'),
        1800  => $this->t('30 minutes'),
        3600  => $this->t('1 hour'),
        21600 => $this->t('6 hours'),
        86400 => $this->t('1 day'),
      ],
    ];

    $allowed_formats = filter_formats();
    foreach (filter_formats() as $format_name => $format) {
      $allowed_formats[$format_name] = $format->label();
    }

    $form['formats'] = [
      '#type'  => 'details',
      '#title' => $this->t('Post Format'),
      '#open'  => TRUE,
    ];

    $form['formats']['formats_post_format'] = [
      '#type'          => 'select',
      '#title'         => $this->t('Post format'),
      '#default_value' => $config->get('formats_post_format'),
      '#options'       => $allowed_formats,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('timeline') == 'user' && !$form_state->getValue('screen_name')) {
      $form_state->setError($form['twitter']['screen_name'], "This field can't be empty if you select user as timeline");
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * Allow user to directly execute cron, optionally forcing it.
   */
  public function cronRun(array &$form, FormStateInterface &$form_state) {
    // Use a state variable to signal that cron was run manually from this form.
    $this->state->set('social_feed_fetcher.next_execution', 0);
    $this->state->set('social_feed_fetcher_show_status_message', TRUE);
    if ($this->cron->run()) {
      $this->messenger->addMessage($this->t('Cron ran successfully.'));
    }
    else {
      $this->messenger->addMessage($this->t('Cron run failed.'), 'error');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('social_feed_fetcher.settings');
    foreach ($form_state->getValues() as $key => $value) {
      $config->set($key, $value);
    }
    $config->save();
    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['social_feed_fetcher.settings'];
  }

}
