<?php

$url = 'http://10.8.0.5:8020/dialog';
//$url = 'https://af84-109-174-114-196.eu.ngrok.io';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    'Content-Type: application/json',
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

/*$data = (object) [
    'max_length' => 256,
    'no_repeat_ngram_size'=> 1,
    'do_sample'=> True,
    'top_k'=> 100,
    'top_p'=> 0.9,
    'temperature'=> 0.6,
    'num_return_sequences'=> 5,
    'device'=> 0,
    'is_always_use_length'=> True,
    'length_generate'=> '1'
];*/

$text = 'Ты будешь бухать?';

$data = '{
    "dialog_history_array": [
        {
            "speaker": 0,
            "text": "' . $text . '"
        }

    ],
    "params": {
        "length": 1,
        "max_length": 256,
        "no_repeat_ngram_size": 3,
        "top_k": 75,
        "top_p": 0.9,
        "temperature": 0.6,
        "num_return": 3,
        "do_sample": true,
        "use_gpu": false
    }
}';

curl_setopt($curl, CURLOPT_POSTFIELDS, /*json_encode($data)*/ $data);

$result = curl_exec($curl);

curl_close($curl);

print_r($result);

$obj = json_decode($result);

echo $obj->response;

//echo "{\"dialog_history_array\":[{\"speaker\":\"0\",\"text\":\"Как дела?\"}],\"params\":{\"length\":\"1\",\"max_length\":\"256\",\"no_repeat_ngram_size\":\"3\",\"top_k\":\"75\",\"top_p\":\"0.9\",\"temperature\":\"0.6\",\"num_return\":\"3\",\"do_sample\":true,\"use_gpu\":false}}";



