<?php
function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $maxIndex = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $maxIndex)];
    }

    $sha256HashString = hash('sha256', $randomString . time());
    return substr($sha256HashString, mt_rand(0, max(0, strlen($sha256HashString) - $length)), $length);
}

// Generate a random string with a length of 49 characters
$randomString = generateRandomString();
echo "\n$randomString\n";

$dummy_users = [
    [
      'name'=> 'Syed Amir Ali', 
      'email'=> 'amirralli300400@gmail.com',
      'picture'=> 'media/profile/image-1.jpg',
      'identity_token' => generateRandomString()
    ],
    [
      'name'=> 'Sabbir Ahmed', 
      'email'=> 'sabbirahmed09@gmail.com',
      'picture'=> 'media/profile/image-2.jpg',
      'identity_token' => generateRandomString()
    ],
    [
      'name'=> 'Solaiman Kobir', 
      'email'=> 'solaimankobir0@gmail.com',
      'picture'=> 'media/profile/image-3.jpg',
      'identity_token' => generateRandomString()
    ]
];

// echo "\n". charAt ."\n";