<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amvata Help Check</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <?php

    // phpinfo();
    $services = [
        "Payment" => [
            "2C2P" => [
                [
                    "endpoint" => "https://t.2c2p.com/RedirectV3/payment",
                    "method" => "GET",
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
                    "endpoint" => "https://amvata.com/index.php?dispatch=2c2p_callback.backend",
                    "method" => "POST",
                    "params" => [],
                    "name" => "2C2P Payment Recevice Amvata",
                    "description" => "2C2P Payment Recevice Amvata",
                    "header" => [
                        "Content-Type: application/json",
                    ]
                ]
            ],
            "SCB_QRCODE" => [
                [
                    "endpoint" => "https://api.partners.scb/partners/v1/oauth/token",
                    "method" => "POST",
                    "params" => [],
                    "name" => "QR Code Get Token",
                    "description" => "QR Code Get Token",
                    "header" => [
                        "Content-Type: application/json",
                        "requestUId: 1234567890",
                        "resourceOwnerId: 1234567890"
                    ]
                ],
                [
                    "endpoint" => "https://api.partners.scb/partners/v1/payment/qrcode/create",
                    "method" => "POST",
                    "params" => [],
                    "name" => "QR Code Generate QRCODE",
                    "description" => "QR Code Generate QRCODE",
                    "header" => [
                        "Content-Type: application/json",
                        "requestUId: 1234567890",
                        "resourceOwnerId: 1234567890",
                        "authorization: 1234567890"
                    ]
                ],
                [
                    "endpoint" => "https://amvata.com/index.php?dispatch=qr30_payment.download_qrcode&file=1234567890",
                    "method" => "GET",
                    "params" => [],
                    "name" => "Get QR Image In Server",
                    "description" => "Get QR Image In Server",
                    "header" => [
                        "Content-Type: application/json"
                    ]
                ],
            ],
            "BILL_PAYMENT" => [
                [
                    "endpoint" => "https://amvata.com/index.php?dispatch=bill_payments.test",
                    "method" => "GET",
                    "params" => [],
                    "name" => "Blank Controller In Bill Payment",
                    "description" => "Blank Controller In Bill Payment",
                    "header" => [
                        "Content-Type: application/json"
                    ]
                ],
            ]
        ],
        "Shipment" => [
            "CJ_LOGISTICS" => [
                [
                    "endpoint" => "https://cj-prod.amvata.com/amvatagw/api/cjrequest",
                    "method" => "POST",
                    "params" => [],
                    "name" => "CJ Gateway Create Tracking Orders",
                    "description" => "CJ Gateway Create Tracking Orders",
                    "header" => [
                        "Content-Type: application/json"
                    ]
                ],
                [
                    "endpoint" => "https://amvata.com/api.php?_d=OrdersStatus",
                    "method" => "GET",
                    "params" => [],
                    "name" => "Shipment API Amvata Recevice Shipment Update [Call Index to help check]",
                    "description" => "Shipment API Amvata Recevice Shipment Update [Call Index to help check]",
                    "header" => [
                        "Content-Type: application/json",
                        "Authorization: 01234567890"
                    ]
                ],
                [
                    "endpoint" => "https://amvata.com/api.php?_d=PaymentTS",
                    "method" => "GET",
                    "params" => [],
                    "name" => "Shipment API Amvata Recevice COD Update [Call Index to help check]",
                    "description" => "Shipment API Amvata Recevice COD Update [Call Index to help check]",
                    "header" => [
                        "Content-Type: application/json",
                        "Authorization: 01234567890"
                    ]
                ],
            ],
            "THAILANDPOST" => [
                [
                    "endpoint" => "https://r_dservice.thailandpost.com/webservice/addItem",
                    "method" => "POST",
                    "params" => [],
                    "name" => "Create Tracking Orders",
                    "description" => "Create Tracking Orders",
                    "header" => [
                        "Content-Type: application/json",
                        "Authorization: xxxxxxx"
                    ]
                ],
                [
                    "endpoint" => "https://amvata.com/index.php?dispatch=thailandpost.index",
                    "method" => "GET",
                    "params" => [],
                    "name" => "Thailandpost Blank Controller [Alway return die... and http 200 ok]",
                    "description" => "Thailandpost Blank Controller [Alway return die... and http 200 ok]",
                    "header" => [
                        "Content-Type: application/json",
                        "Authorization: xxxxxxx"
                    ]
                ],
            ]
        ]
    ];

    function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}

    foreach ($services as $type => $service_args) {
        foreach ($service_args as $k => $_service) {
            foreach ($_service as $kk => $service) {
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
                $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                $error_msg = curl_error($curl);
                curl_close($curl);
                $services[$type][$k][$kk]["http_status"] = $http_status;
                $services[$type][$k][$kk]["error_msg"] = $error_msg;
                if ($http_status != 200) {
                    $services[$type][$k][$kk]["response"] = (isJson($response)) ? json_decode($response, true) : $response;
                }
                // echo "<hr />";
            }
        }
    }
    // echo "<pre>";
    // print_r($services);
    // echo "</pre>";
    date_default_timezone_set("Asia/Bangkok");
    $datetime = date("Y-m-d h:i:s");
    ?>

    <div class="container">
        <h1>Help Check Amvata Status : <?php echo DateThai($datetime); ?></h1>
        <div class="row">
            <?php foreach ($services as $key => $service) : ?>
            <div class="col-sm-12">
                <h1 style=" color: darkblue; font-weight: bold; "><?php echo $key; ?></h1>
                <div class="row">
                    <?php foreach ($service as $k => $value) : ?>
                        <div class="col-sm-12">
                            <h3 style=" color: green; font-weight: bold; "><?php echo $k; ?></h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Response</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($value as $kk => $val) : ?>
                                        <tr>
                                            <td><?php echo $val['name'] ?></td>
                                            <td><?php echo $val['endpoint'] ?></td>
                                            <td style="word-break: break-all;"><?php echo (!empty($val['http_status']) && $val['http_status'] == 200 ) ? "OK" : json_encode($val["response"]); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>