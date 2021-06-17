<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/*
 | -----------------------------------------------------
 | Authentication options.
 | -----------------------------------------------------
 */

/**
 * identity login column
 */
$config['unique_phone'] = true;

/**
 * Allow users to be remembered and enable auto-login
 **/
$config['remember_users'] = true;

/**
 * How long to remember the user (seconds)
 **/
$config['remember_expire'] = 259200; // 3 ngày (3 * 86400)

/**
 * Extend the users cookies everytime they auto-login
 **/
$config['remember_extend_on_login'] = true;

/**
 * Email Activation for registration
 * auto|email|none
 *
 * auto: auto activation
 * email: active by email
 * none: active by admin
 */
$config['user_activation_method'] = 'auto';
