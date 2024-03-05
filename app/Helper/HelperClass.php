<?php 
namespace App\Helper;

use App\Models\User;

class HelperClass{
  public static function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $timestamps = (int) time();
    $sha256HashString =  hash('sha256', $characters.$timestamps);
 
    return substr($sha256HashString, mt_rand(0, max(0, strlen($sha256HashString) - $length)), $length);
  } 

  public static function CreateDummyUsers(){
    $dummy_users = [];
    $static_dummy_users = [
      [
        'name'=> 'Syed Amir Ali', 
        'email'=> 'amirralli300400@gmail.com',
        'picture'=> 'media/profile/image-1.jpg',
        'identity_token' => static::generateRandomString()
      ],
      [
        'name'=> 'Sabbir Ahmed', 
        'email'=> 'sabbirahmed09@gmail.com',
        'picture'=> 'media/profile/image-2.jpg',
        'identity_token' => static::generateRandomString()
      ],
      [
        'name'=> 'Solaiman Kobir', 
        'email'=> 'solaimankobir0@gmail.com',
        'picture'=> 'media/profile/image-3.jpg',
        'identity_token' => static::generateRandomString()
      ],
      [
        'name'=> 'Mohammad Arif Vai', 
        'email'=> 'ararif724@gmail.com',
        'picture'=> 'media/profile/image-4.jpg',
        'identity_token' => static::generateRandomString()
      ],
    ];

    $message = [];
    
    foreach($static_dummy_users as $user){
      if(User::where('email', $user['email'])->exists()){
        $message[$user['email']] = 'User Exists';
      }else{
        $dummy_users[] = User::create($user);
        $message[$user['email']] = 'User Created Successfully!';
      }
    }

    return response()->json([
      'status'=> 200,
      'message'=> $message,
      'users'=> $dummy_users
    ]);
  }

  public static function googleDriveVideoIframe(string $file_id, $type = 'iframe'){
    switch ($type) {
      case 'iframe':
        return "<iframe src=https://drive.google.com/file/d/{$file_id}/preview' allow='autoplay'></iframe>";

      case 'drive_url':
        return "https://drive.google.com/file/d/{$file_id}/preview";
          
      default:
        return "<iframe src=https://drive.google.com/file/d/{$file_id}/preview' allow='autoplay'></iframe>";
    }
  }
}