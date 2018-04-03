<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'PublicUser';
$route['home'] = 'PublicUser/index';
$route['home/(:num)'] = 'PublicUser/index/$1';
$route['showDetails/(:num)'] = 'PublicUser/showDetails/$1';

$route['member'] = 'Member/index';
$route['member/home'] = 'Member/index';
$route['member/my-books'] = 'Member/myBooks';
$route['member/my-books/(:num)'] = 'Member/myBooks/$1';
$route['member/my-books/add'] = 'Member/addBook';
$route['member/my-books/create'] = 'Member/createBook';
$route['member/my-books/edit/(:num)'] = 'Member/editBook/$1';
$route['member/my-books/update'] = 'Member/updateBook';