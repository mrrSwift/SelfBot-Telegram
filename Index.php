<?php




// Crator : Mr Swift , SylvanasWindruner

// set a cronjob 1min !

error_reporting(0);
ini_set('display_errors', 0);
ini_set('memory_limit', -1);
ini_set('max_execution_time', -1);
if(!is_dir('files')){
mkdir('files');
}
if(!file_exists('madeline.php')){
copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
if(!file_exists('online.txt')){
file_put_contents('online.txt','off');
}
include 'madeline.php';
$settings = [];
$settings['logger']['max_size'] = 5*1024*1024;
$MadelineProto = new \danog\MadelineProto\API('oghab.madeline', $settings);
$MadelineProto->start();

function closeConnection($message = 'OghabSelf Is Running ...'){
 if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
  return;
 }

    @ob_end_clean();
    @header('Connection: close');
    ignore_user_abort(true);
    ob_start();
    echo "$message";
    $size = ob_get_length();
    @header("Content-Length: $size");
    @header('Content-Type: text/html');
    ob_end_flush();
    flush();
    $GLOBALS['exited'] = true;
}
function shutdown_function($lock)
{
   try {
    $a = fsockopen((isset($_SERVER['HTTPS']) && @$_SERVER['HTTPS'] ? 'tls' : 'tcp').'://'.@$_SERVER['SERVER_NAME'], @$_SERVER['SERVER_PORT']);
    fwrite($a, @$_SERVER['REQUEST_METHOD'].' '.@$_SERVER['REQUEST_URI'].' '.@$_SERVER['SERVER_PROTOCOL']."\r\n".'Host: '.@$_SERVER['SERVER_NAME']."\r\n\r\n");
    flock($lock, LOCK_UN);
    fclose($lock);
} catch(Exception $v){}
}
if (!file_exists('bot.lock')) {
 touch('bot.lock');
}

$lock = fopen('bot.lock', 'r+');
$try = 1;
$locked = false;
while (!$locked) {
 $locked = flock($lock, LOCK_EX | LOCK_NB);
 if (!$locked) {
  closeConnection();
 if ($try++ >= 30) {
 exit;
 }
   sleep(1);
 }
}
if(!file_exists('data.json')){
 file_put_contents('data.json', '{"power":"on","adminStep":"","typing":"off","echo":"off","markread":"off","poker":"off","enemies":[],"answering":[]}');
}
//SjD Mr_Swift  SylvanasWindruner
class EventHandler extends \danog\MadelineProto\EventHandler
{
public function __construct($MadelineProto){
parent::__construct($MadelineProto);
}
public function onUpdateSomethingElse($update)
{
yield $this->onUpdateNewMessage($update);
}
public function onUpdateNewChannelMessage($update)
{
yield $this->onUpdateNewMessage($update);
}
public function onUpdateNewMessage($update){
$from_id = isset($update['message']['from_id']) ? $update['message']['from_id']:'';
  try {
 if(isset($update['message']['message'])){
 $text = $update['message']['message'];
 $msg_id = $update['message']['id'];
 $message = isset($update['message']) ? $update['message']:'';
 $MadelineProto = $this;
 $me = yield $MadelineProto->get_self();
 $admin = $me['id'];
 $chID = yield $MadelineProto->get_info($update);
 $peer = $chID['bot_api_id'];
 $type3 = $chID['type'];
 $data = json_decode(file_get_contents("data.json"), true);
 $step = $data['adminStep'];
 if(!file_exists('ooo')){
 file_put_contents('ooo', '');
 }
  if(file_exists('ooo') && file_get_contents('online.txt') == 'on' && (time() - filectime('ooo')) >= 30){
   @unlink('ooo');
   @file_put_contents('ooo', '');
   yield $MadelineProto->account->updateStatus(['offline' => false]);
  }
 if($from_id == $admin){
   if(preg_match("/^[\/\#\!]?(bot) (on|off)$/i", $text)){
     preg_match("/^[\/\#\!]?(bot) (on|off)$/i", $text, $m);
     $data['power'] = $m[2];
     file_put_contents("data.json", json_encode($data));
     yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Bot Now Is $m[2]"]);
   }
   if(preg_match("/^[\/\#\!]?(online) (on|off)$/i", $text)){
  preg_match("/^[\/\#\!]?(online) (on|off)$/i", $text, $m);
  file_put_contents('online.txt', $m[2]);
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Online Mode Now Is $m[2]"]);
   }



   if($text=='bk' or $text=='بکیرم'){
    yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '
    😂😂😂
    😂         😂
    😂           😂
    😂        😂
    😂😂😂
    😂         😂
    😂           😂
    😂           😂
    😂        😂
    😂😂😂']);
    yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
    😂         😂
    😂       😂
    😂     😂
    😂   😂
    😂😂
    😂   😂
    😂      😂
    😂        😂
    😂          😂
    😂            😂']);
    yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
    😂😂😂          😂         😂
    😂         😂      😂       😂
    😂           😂    😂     😂
    😂        😂       😂   😂
    😂😂😂          😂😂
    😂         😂      😂   😂
    😂           😂    😂      😂
    😂           😂    😂        😂
    😂        😂       😂          😂
    😂😂😂          😂            😂']);
        
    }
    // Crator : SjD , Mr Swift , SylvanasWindruner
    if ($text == 'fosh' or $text == '/fosh') {
    $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ک"]);
    sleep(1);
    $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص"]);
    sleep(1);
    $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص ع"]);
    sleep(1);
    $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص عم"]);
    sleep(1);
    $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص عمت"]);
    sleep(1);
    $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص عمت :)"]);
    
    }
    // Crator : SjD , Mr Swift , SylvanasWindruner
         if ($text == 'dost' or $text == '/dost') {
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "د"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دو"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دوس"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دوست"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دوستت"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دوستت د"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دوستت دا"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دوستت دار"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دوستت دارم"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "دوستت دارم :)"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "❤❤❤❤"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "🤍🤍🤍🤍"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "🥀بدون تو نمیتونم زندگیم"]);
         }
    
         if ($text == 'fosh2' or $text == '/fosh2') {
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کیرم"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "به"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادرت"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "هرجا"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "که"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "هستی"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کیرم به کص مادرت هرجا که هستی"]);
         }
    // Crator : SjD , Mr Swift , SylvanasWindruner
         if ($text == 'rel' or $text == '/rel' or $text == '/رل') {
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ر"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "رل"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "رل پ"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => " رل پی"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "رل پیو"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "رل پیوی"]);
             sleep(1);
         }
    
         if ($text == 'zan' or $text == '/zan' or $text == '/زن') {
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ز"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "زن"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "زنم "]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => " زنم م"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "زنم می"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "زنم میش"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "زنم میشی"]);
             sleep(1);
             $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "زنم میشی ؟ :)"]);
    
         }



?>