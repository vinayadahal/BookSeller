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
//$route['member/my-books'] = 'Member/myBooks';
//$route['member/my-books/(:num)'] = 'Member/myBooks/$1';
//$route['member/my-books/add'] = 'Member/addBook';
//$route['member/my-books/create'] = 'Member/createBook';
//$route['member/my-books/edit/(:num)'] = 'Member/editBook/$1';
$route['member/my-books'] = 'MyBooks/index';
$route['member/my-books/(:num)'] = 'MyBooks/index/$1';
$route['member/my-books/add'] = 'MyBooks/addBook';
$route['member/my-books/create'] = 'MyBooks/createBook';
$route['member/my-books/edit/(:num)'] = 'MyBooks/editBook/$1';
$route['member/my-books/update'] = 'MyBooks/updateBook';
$route['member/my-books/delete/(:num)'] = 'MyBooks/deleteBook/$1';
$route['member/my-books/publish/(:num)'] = 'MyBooks/publishBook/$1';
$route['member/my-books/hide/(:num)'] = 'MyBooks/hideBook/$1';