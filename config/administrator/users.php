<?php

return [
    'title' => 'Users',
    'single' => 'user',
    'model' => 'App\User',
    'columns' => [
        'id',
        'name',
        'email',
    ],
    'edit_fields' => [
        'name',
        'email',
    ],
];