<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Dashboard/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Authentication
 */
$route['login'] = 'authentication/login';
$route['logout'] = 'authentication/logout';

/**
 * Teansactions
 */
$route['download_transaction'] = 'transactions/download_transaction';
$route['download_transaction_file'] = 'transactions/download_transaction_file';
$route['add_transaction'] = 'transactions/add_transaction';
$route['all_transaction'] = 'transactions/index';
$route['add_ticket_master'] = 'transactions/add_ticket_master';
$route['delete_transaction/(:num)'] = 'transactions/delete_transaction/$1';
$route['update_transaction/(:num)'] = 'transactions/update_transaction/$1';
$route['download_transaction_csv'] = 'transactions/download_transaction_csv';


/**
 * Noraml User
 */

$route['normal_user'] = 'user/add_normal_user';
$route['edit_normal_user/(:num)'] = 'user/edit_normal_user/$1';
$route['delete_normal_user/(:num)'] = 'user/delete_normal_user/$1';
$route['normal_user_ajax'] = 'user/normal_user_ajax';

/**
 * Users
 */
$route['add'] = 'user/add';
$route['list'] = 'user/list';
$route['delete/(:any)'] = 'user/delete/$1';
$route['edit/(:any)'] = 'user/edit/$1';

/**
 * charts
 */
$route['charts'] = 'Charts/get_charts';
$route['pie_chartsByValue'] = 'Charts/get_chartsByValue';
$route['bar_chartBydate'] = 'Charts/bar_chartBydate';
