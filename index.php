<?php

// phpinfo();


$services = [
    "Payment" => [
        "2C2P" => [
            [
                "endpoint" => "https://t.2c2p.com/RedirectV3/payment",
                "method" => "POST",
                "params" => [
                    'merchant_id' => 1
                ],
                "name" => "2C2P Payment Gateway Live",
                "description" => "2C2P Payment Gateway Live",
                "header" => [
                    "Content-Type: application/x-www-form-urlencoded",
                ]
            ],
            [
                "endpoint" => "https://t.2c2p.com/RedirectV3/payment",
                "method" => "POST",
                "params" => [
                    'merchant_id' => 1
                ],
                "name" => "2C2P Payment Gateway Live",
                "description" => "2C2P Payment Gateway Live",
                "header" => [
                    "Content-Type: application/json",
                ]
            ]
        ]
    ]
];


foreach ($services as $type => $service_args) {
    foreach ($service_args as $service) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $service["endpoint"],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $service["method"],
            CURLOPT_POSTFIELDS => json_encode($service["params"], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            CURLOPT_HTTPHEADER => $service["header"],
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        echo "<hr />";
    }
}
