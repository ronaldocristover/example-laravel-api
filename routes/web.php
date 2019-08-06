<?php

$router->post('/auth/login', 'UserController@authenticate');
$router->post('/auth/signup', 'UserController@signup');
$router->get('/v1/products', 'ProductController@index');
$router->get('/v1/products/{id}', 'ProductController@show');
$router->post('/v1/products', 'ProductController@store');
$router->put('/v1/products/{id}', 'ProductController@update');
$router->delete('/v1/products/{id}', 'ProductController@remove');
