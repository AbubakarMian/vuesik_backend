<?php

return [

	'status' => [
		'OK' => 200,
		'pending' => 'pending',
		'confirmed' => 'confirmed',
		'paid' => 'paid',
		'dispatched'=>'dispatched',
		'rejected'=>'rejected'
	],

		"in_city_shipment_charges"=> "in_city_shipment_charges",
		"out_city_shipment_charges"=> "out_city_shipment_charges",
		"in_city_shipment_charges"=> "in_city_shipment_charges",
		'type' => [
				'product' => 'product',
				'service' => 'service',
		],
	'sender' =>[
		'user'=>'user',
		'vendor'=>'vendor'
	],
	'language' =>[
		'arabic'=>'arabic',
		'english'=>'english'
	],
//	'payfort_live_url'=>'/var/www/html/gomallbackend/',
	'payfort_live_url'=>'../../gomallbackend/',
    'lead_status' =>[
        'pending'=>'pending',
        'contacted'=>'contacted',
        'not_interested'=>'not_interested',
        'interested'=>'interested',
    ],
];