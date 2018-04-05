<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'PublicUser';
$route['home'] = 'PublicUser/index';
$route['home/(:num)'] = 'PublicUser/index/$1';
$route['showDetails/(:num)'] = 'PublicUser/showDetails/$1';

$route['login'] = 'Login/index';
$route['checkLogin'] = 'Login/checkLogin';
$route['logout'] = 'Login/logout';

$route['member'] = 'Member/index';
$route['member/home'] = 'Member/index';
$route['member/my-books'] = 'MyBooks/index';
$route['member/my-books/(:num)'] = 'MyBooks/index/$1';
$route['member/my-books/add'] = 'MyBooks/addBook';
$route['member/my-books/create'] = 'MyBooks/createBook';
$route['member/my-books/edit/(:num)'] = 'MyBooks/editBook/$1';
$route['member/my-books/update'] = 'MyBooks/updateBook';
$route['member/my-books/delete/(:num)'] = 'MyBooks/deleteBook/$1';
$route['member/my-books/publish/(:num)'] = 'MyBooks/publishBook/$1';
$route['member/my-books/hide/(:num)'] = 'MyBooks/hideBook/$1';

$route['member/my-posts'] = 'Posts/index';
$route['member/my-posts/(:num)'] = 'Posts/index/$1';
$route['member/my-posts/add'] = 'Posts/addPost';
$route['member/my-posts/create'] = 'Posts/createPost';
$route['member/my-posts/edit/(:num)'] = 'Posts/editPost/$1';
$route['member/my-posts/update'] = 'Posts/updatePost';
$route['member/my-posts/delete/(:num)'] = 'Posts/deletePost/$1';

$route['member/matches'] = 'Matches/index';

$route['member/settings'] = 'Settings/index';
$route['member/settings/updateUser'] = 'Settings/updateUser';

$route['admin'] = 'Admin/index';
$route['admin/category'] = 'Category/index';
$route['admin/category/(:num)'] = 'Category/index/$1';
$route['admin/category/add'] = 'Category/addCategory';
$route['admin/category/create'] = 'Category/createCategory';
$route['admin/category/edit/(:num)'] = 'Category/editCategory/$1';
$route['admin/category/update'] = 'Category/updateCategory';
$route['admin/category/delete/(:num)'] = 'Category/deleteCategory/$1';