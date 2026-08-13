<?php
/* Agregamos configuracion para el tema por defecto y los temas disponibles. */
return [
    'default' => env('APP_THEME', 'corporate'),
    'available' => ['corporate', 'bumblebee', 'dark', 'fantasy',  'cupcake', 'light'],
];
