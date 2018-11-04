<?php

return [
    'settings' => [
      'auth'  => 'Basic QWRtaW5pc3RyYXRvcjoxMjM0NTY=',
      'UID'   => '56898e01-acd6-484e-b658-20429c8703ca',
      'base_url' => 'http://localhost:8080/AccountRight/'
    ],
    'payroll' => [
        'overtime' => [
          '15' =>   'f3fd7dec-a7a3-42b9-b5ad-e691bc060c8b',
          '20' =>   '191727b1-2e33-4307-8f6e-7e2cf2c00f6e',
        ],
        'base_hourly'     => 'e6ca2091-7c53-4256-8554-4f7c91eaa331',
        'anl'             => 'b0484276-29d3-45a0-9765-c9c757a3499f',
        'anl_load'        => 'ad35f05b-8866-4b2b-ac36-08d9aa5c22fe',
        'rdo'             => 'f75663f7-859d-4fbe-9d66-278a42cd027e',
        'pld'             => 'a97167f0-4709-4c6a-940b-664636316417',
        'sick'             => '469ab709-83d0-4ea1-a5fd-11098d5aa331',
        'site_allow'      => [
            'tradesman' => 'bc035dc3-47ab-43f7-929d-28ea59aba0d8',
            'apprentice' => [
              '1' => 'a092a70d-6d65-4597-8958-7d8090861de0',
              '2' => '6f38b905-9ae1-44c1-900b-42a91441aa9a',
              '3' => '8384dfee-01b2-4536-a581-25554fa96ccf',
              '4' => '7118d1f9-3933-4327-b9f4-263316248aac'
            ]
          ],
        'default_job'     => '6c1e9a6d-6d76-4be8-9fe5-e2ccccefa3b5',
        'travel_days'     => [
          'tradesman' => 'cfe189f3-365a-47e8-b15d-35f92d1b1f1a',
          'apprentice' => [
              '1' => 'ee041929-c400-4b43-973b-dd499c8488b8',
              '2' => 'b2c6ed21-8dd1-4641-9744-f6a42f24fcbc',
              '3' => 'b2c6ed21-8dd1-4641-9744-f6a42f24fcbc',
              '4' => '0834868c-67bc-4707-937c-def0318b93ac'
            ]
          ]
    ],
    'entitlements' => [
      'anl'             => 'fb1ad0b1-e2b4-4254-843a-c68bc2529681',
      'rdo'             => 'aff9ffdd-73ca-40fb-9c7c-47e9522fcd4c',
      'pld'             => 'cde563b9-3919-46d4-9fa0-303f20304e57',
    ]
];
