<?php

return [
    'layouts' => [
        'classic' => [
            'name' => 'Classic Navy',
            'description' => 'Dark left sidebar, light content — professional two-column CV.',
            'preview' => ['#12123a', '#1a1a4b', '#7ec8e8', '#f4f6fb'],
            'mock' => 'sidebar-left',
        ],
        'emerald' => [
            'name' => 'Emerald Gold',
            'description' => 'Forest green sidebar with gold accents and name in the sidebar.',
            'preview' => ['#0b2e24', '#1b5a45', '#d4a017', '#eef6f2'],
            'mock' => 'sidebar-left',
        ],
        'horizon' => [
            'name' => 'Horizon Banner',
            'description' => 'Wide top banner with photo and name, skills column below.',
            'preview' => ['#172033', '#2c3e5b', '#f0b35a', '#f6f3ee'],
            'mock' => 'banner-top',
        ],
        'minimal' => [
            'name' => 'Minimal Blue',
            'description' => 'Clean white page, blue accent stripe, soft skill panel.',
            'preview' => ['#ffffff', '#0f172a', '#2563eb', '#eff6ff'],
            'mock' => 'stripe',
        ],
        'mirror' => [
            'name' => 'Mirror Slate',
            'description' => 'Content on the left, dark skills panel on the right.',
            'preview' => ['#f1f5f9', '#0f172a', '#38bdf8', '#e2e8f0'],
            'mock' => 'sidebar-right',
        ],
    ],

    'default_layout' => 'classic',

    'genders' => [
        ['en' => 'Male', 'km' => 'ប្រុស'],
        ['en' => 'Female', 'km' => 'ស្រី'],
    ],

    'marital_statuses' => [
        ['en' => 'Single', 'km' => 'នៅលីវ'],
        ['en' => 'Married', 'km' => 'រៀបការ'],
        ['en' => 'Divorced', 'km' => 'លែងលះ'],
        ['en' => 'Widowed', 'km' => 'មេម៉ាយ / ពោះម៉ាយ'],
    ],
];

