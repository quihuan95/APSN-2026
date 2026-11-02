<?php

return [
    'admin' => [
        'username' => env('APSN_ADMIN_USERNAME'),
        'password' => env('APSN_ADMIN_PASSWORD'),
        'email' => env('APSN_ADMIN_EMAIL'),
    ],

    'titles' => ['Mr.', 'Ms.', 'Mrs.', 'Dr.', 'Prof.'],

    'genders' => ['Male', 'Female'],

    'economies' => [
        'Australia',
        'Brunei Darussalam',
        'Canada',
        'Chile',
        'China',
        'Hong Kong, China',
        'Indonesia',
        'Japan',
        'Republic of Korea',
        'Malaysia',
        'Mexico',
        'New Zealand',
        'Papua New Guinea',
        'Peru',
        'The Philippines',
        'Russia',
        'Singapore',
        'Chinese Taipei',
        'Thailand',
        'United States',
        'Viet Nam',
    ],

    'roles' => [
        'Council member',
        'Government official',
        'Industry/NMP',
    ],

    'passport_types' => [
        'Diplomatic Passport',
        'Official Passport',
        'Regular Passport',
    ],

    'visa_statuses' => [
        'Visa-exempt',
        'ABTC with "VNM" entry',
        'Diplomatic or official passport exemption',
        'Will apply for e-visa',
    ],

    'e_visa_status' => 'Will apply for e-visa',

    'sessions' => [
        'forum' => 'APSN Forum (15 Dec)',
        'technical_visit' => 'Technical Visit (16 Dec)',
        'council' => 'APSN Council Meeting 2026 (16 - 17 Dec) - Council members only',
        'welcome_dinner' => 'Welcome Dinner (15 December)',
        'council_dinner' => 'Dinner (16 December) (Council Member only)',
    ],

    'diets' => ['Vegetarian', 'Halal', 'No Seafood'],

    'deadlines' => [
        'NMP (Non Member Participant)' => '10 November 2026',
        'Other participants' => '15 November 2026',
    ],
];
