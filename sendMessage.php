<?php
  require_once("twitteroauth-master/twitteroauth/twitteroauth.php");

  function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
    return $connection;
  }

  $message = ""; //Enter the message you want to send as DM.
  $userName = ""; //Enter your Twitter handle.
  $consumerkey = "";
  $consumersecret = "";
  $accesstoken = "";
  $accesstokensecret = "";

  $followersId = array();

  $connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

  $followers = $connection->get("https://api.twitter.com/1.1/followers/ids.json?screen_name=".$userName);

  $decode_json = json_decode(json_encode($followers), true);

  $message = urlencode($message);

  foreach($decode_json as $i)
  {
    foreach($i as $id)
    {
      $responseDM = $connection->post("https://api.twitter.com/1.1/direct_messages/new.json?text=".$message."&user_id=".$id);
    }
  }
?>
