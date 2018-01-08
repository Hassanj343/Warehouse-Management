<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => base_path(env('SNAPPY_PDF_BINARY')),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => base_path(env('SNAPPY_IMAGE_BINARY')),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
