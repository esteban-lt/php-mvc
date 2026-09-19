<?php
return [
    'GET /'         => ['ProductController', 'index'],
    'GET /create'   => ['ProductController', 'create'],
    'POST /store'   => ['ProductController', 'store'],
    'GET /edit'     => ['ProductController', 'edit'],
    'POST /update'  => ['ProductController', 'update'],
    'POST /destroy' => ['ProductController', 'destroy'],
];
