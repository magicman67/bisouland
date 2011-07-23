<?php

Atomik::set(array(
  'app' => array(
      'layout'          => '_layout',
      'default_action'  => 'accueil',
      'views'           => array(
          'file_extension'  => '.phtml',
      ),
  ),
  'atomik' => array(
      'start_session'   => true,
      'class_autoload'  => true,
      'trigger'         => 'action',
      'catch_errors'    => true,
      'display_errors'  => true,
      'debug'           => false,
  ),
  'styles' => array(
      0                 => 'assets/css/reset.css',
      1                 => 'assets/css/main.css',
      2                 => 'assets/css/header.css',
      3                 => 'assets/css/nav.css',
      4                 => 'assets/css/article.css',
      5                 => 'assets/css/footer.css',
  ),
  'plugins' => array(
  ),
  'scripts' => array(
  ),
));
