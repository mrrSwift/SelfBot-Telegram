<?php

// Crator : SjD , Mr Swift , SylvanasWindruner
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
     if ($text == 'rel' or $text == '/rel') {
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

     if ($text == 'zan' or $text == '/zan') {
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
// Crator : SjD , Mr Swift , SylvanasWindruner
     if ($text == 'namal' or $text == '/namal') {
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خ"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خا"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خای"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایم"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایما"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمال"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالی"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالی ن"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالی نک"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالی نکن"]);

     }

     if ($text == 'namal2' or $text == '/namal2') {
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خ"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خا"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خای"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایم"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایما"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمال"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالو"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالو"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالو س"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالو سگ"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => " خایمالو سگ گ"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالو سگ گا"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "خایمالو سگ گای"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => " خایمالو سگ گایی"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => " خایمالو سگ گایید"]);

     }

     if ($text == 'madar' or $text == '/madar') {
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "م"]);
         sleep(1);
           $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ما"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ماد"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادر"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادرت"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادرت ف"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادرت فو"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادرت فوت"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادرت فوت ک"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادرت فوت کر"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "مادرت فوت کرد"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پ"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پی"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش "]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش ب"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به "]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به س"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سو"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی م"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مج"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجل"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجلس"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجلس خ"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجلس خت"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی کجلس ختم"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجلس ختم م"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجلس ختم ما"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجلس ختم ماد"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجلس ختم مادر"]);
         sleep(1);
          $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "پیش به سوی مجلس ختم مادرت"]);
         sleep(1);

     }
// Crator : SjD , Mr Swift , SylvanasWindruner
     if ($text == 'tofang' or $text == '/tofang') {
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "(҂`_´)"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "(҂`_´)
<,︻╦╤─ ҉ "]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "(҂`_´)
<,︻╦╤─ ҉ -
/﹋\."]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "(҂`_´)
<,︻╦╤─ ҉ ----💥
/﹋\."]);

     }



     if ($text == 'gharyb' or $text == '/gharyab') {
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "غار یاب  . .

█                                            10%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "غار یاب . . .

███                                     20%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "غار یاب . . . . .

█████                              30%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "غار یاب . . . . . . .

████████                   60%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "غار یاب . . . . . . . . .

████████████    90%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "غار یاب . . . . . . . . . . . . .

█████████████ 100%"]);
         sleep(1);
         $robot = ["• قطر دهانه غار : 1 سانت  
        • عمق غار : ۱۵ سانت

•ظرفیت : ۱ ژاپنی

","
• قطر دهانه غار : 7 سانت  
        • عمق غار : 30 سانت

• ظرفیت : ۳ سفید پوست 

","
• قطر دهانه غار : Eror404  
        • عمق غار : ......

• ظرفیت : ...... 
","
• قطر دهانه غار : 1 متر  
        • عمق غار :مسیر تا دهان ادامه دارد

• ظرفیت :5 سیاه پوست
","
• قطر دهانه غار : ورودی غار بسه میباشد   
        • عمق غار : معلوم نیست
• ظرفیت :معلوم نیست

","
• قطر دهانه غار : غار علی صدر  
        • عمق غار : ناشناخته

• ظرفیت : نامحدود
","
• قطر دهانه غار : غاری یافت نشود احتمالا شخص آلت دارد  
        • عمق غار : ......

• ظرفیت : ......
"];
         $r = $robot[rand(0, count($robot)-1)];
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => $r ]);
     }




     if ($text == 'lisyab' or $text == '/lisyab') {
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص لیس یابی . .

█                                            10%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص لیس یابی . . .

███                                     20%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص لیس یابی . . . . .

█████                              30%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص لیس یابی . . . . . . .

████████                   70%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص لیس یابی . . . . . . . . .

████████████    90%"]);
         sleep(1);
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "کص لیس یابی . . . . . . . . . . . . .

█████████████ 100%"]);
         sleep(1);
         $robot = ["• میزان کص لیسی : %100

• تواناییی لیسیدن 3 دختر همزمان

• رتبه لیسری : کص لیس افسانه ای","• میزان کص لیسی : %300

• بدون محدودیت تعداد دختر میتواند بلیسد

• رتبه لیسری : متی هلیش","شما یک خایمال هستید نه لیسر

• تواناییی مالیدن انقد میمالد تا زخم شود

• رتبه خایمالی : خایمال ارشد","• میزان کص لیسی : %85

• تواناییی لیسیدن 2.5 دختر همزمان

• رتبه لیسری : لیسر رو به پیشرفت","• میزان کص لیسی : %200

• تواناییی لیسیدن 5 دختر همزمان

• رتبه لیسری : کص لیس باز نشسته","• میزان کص لیسی : %75

• تواناییی لیسیدن 2 دختر همزمان

• رتبه لیسری : استاد","• میزان کص لیسی : %0

فرد مورد نظر پاک است درود بر تو فرزندم","• میزان کص لیسی : %30

• تواناییی لیسیدن 1 دختر به زور

• رتبه لیسری : کص لیس تازه کار","• میزان کص لیسی : %10

• تواناییی لیسیدن نصفه لیس میزند ول می کند

• رتبه لیسری : کص لیس بدبخت","• میزان کص لیسی : %5

• فقط روی دختر مردم کراش میزنم بدون لیس

• رتبه لیسری : کص لیس بیچاره"];
         $r = $robot[rand(0, count($robot)-1)];
         $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => $r ]);
     }




     if($text=='ماشین' or $text=='car'){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '💣________________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣_______________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣______________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣_____________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣____________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣___________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣__________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣_________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣________🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣_______🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣______🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣____🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣___🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣__🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💣_🏎']);

yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💥ZART💥']);
}

	if ($text == 'time' or $text=='ساعت'  or $text=='تایم') {
	    date_default_timezone_set('Asia/Tehran');
	yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => ';)']);
	for ($i=1; $i <= 5; $i++){
	yield $MadelineProto->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => date('H:i:s')]);
	yield $MadelineProto->sleep(1);
	}
	}

if ($text == 'تاریخ شمسی') {
include 'jdf.php';
$fasl = jdate('f');
$month_name= jdate('F');
$day_name= jdate('l');
$tarikh = jdate('y/n/j');
$hour = jdate('H:i:s - a');
$animal = jdate('q');
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "امروز  $day_name  |$tarikh|

نام ماه🌙: $month_name

نام فصل ❄️: $fasl

ساعت ⌚️: $hour

نام حیوان امسال 🐋: $animal
"]);
}

if ($text == 'تاریخ میلادی') {
date_default_timezone_set('UTC');
$rooz = date("l"); // روز
$tarikh = date("Y/m/d"); // سال
$mah = date("F"); // نام ماه
$hour = date('H:i:s - A'); // ساعت
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "today  $rooz |$tarikh|

month name🌙: $mah

time⌚️: $hour"]);
}

  if ($text == 'ping' or $text == '/ping' or $text == 'پینگ') {
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Ride :)"]);
  }
 if(preg_match("/^[\/\#\!]?(setanswer) (.*)$/i", $text)){
$ip = trim(str_replace("/setanswer ","",$text));
$ip = explode("|",$ip."|||||");
$txxt = trim($ip[0]);
$answeer = trim($ip[1]);
if(!isset($data['answering'][$txxt])){
$data['answering'][$txxt] = $answeer;
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "کلمه جدید به لیست پاسخ شما اضافه شد👌🏻"]);
}else{
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "این کلمه از قبل موجود است :/"]);
 }
}



if(preg_match("/^[\/\#\!]?(upload) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(upload) (.*)$/i", $text, $a);
$oldtime = time();
$link = $a[2];
$ch = curl_init($link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_NOBODY, TRUE);
$data = curl_exec($ch);
$size1 = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD); curl_close($ch);
$size = round($size1/1024/1024,1);
if($size <= 150){
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => '🌵 Please Wait...
💡 FileSize : '.$size.'MB']);
$path = parse_url($link, PHP_URL_PATH);
$filename = basename($path);
copy($link, "files/$filename");
yield $MadelineProto->messages->sendMedia([
 'peer' => $peer,
 'media' => [
 '_' => 'inputMediaUploadedDocument',
 'file' => "files/$filename",
 'attributes' => [['_' => 'documentAttributeFilename',
 'file_name' => "$filename"]]],
 'message' => "🔖 Name : $filename
💠 [Your File !]($link)
💡 Size : ".$size.'MB',
 'parse_mode' => 'Markdown'
]);
$t=time()-$oldtime;
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "✅ Uploaded ($t".'s)']);
unlink("files/$filename");
} else {
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => '⚠️ خطا : حجم فایل بیشتر 150MB است!']);
}
}
 if(preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text, $text);
$txxt = $text[2];
if(isset($data['answering'][$txxt])){
unset($data['answering'][$txxt]);
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "کلمه مورد نظر از لیست پاسخ حذف شد👌🏻"]);
}else{
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "این کلمه در لیست پاسخ وجود ندارد :/"]);
 }
}



if ($text == '/die;') {
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => '!..!']);
  yield $this->restart();
  die;
}

if($text == '/id' or $text == 'id'){
  if (isset($message['reply_to_msg_id'])) {
   if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
  yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => 'YourID : '.$messag, 'parse_mode' => 'markdown']);
} else {
	if($type3 == 'user'){
 yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "YourID : `$peer`", 'parse_mode' => 'markdown']);
}}} else {
  yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "GroupID : `$peer`", 'parse_mode' => 'markdown']);
}
}

if(isset($message['reply_to_msg_id'])){
if($text == 'unblock' or $text == '/unblock' or $text == '!unblock'){
if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
  yield $MadelineProto->contacts->unblock(['id' => $messag]);
  yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "UnBlocked!"]);
  } else {
  	if($type3 == 'user'){
yield $MadelineProto->contacts->unblock(['id' => $peer]); yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "UnBlocked!"]);
}
}
}

if($text == 'block' or $text == '/block' or $text == '!block'){
if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
  yield $MadelineProto->contacts->block(['id' => $messag]);
  yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Blocked!"]);
  } else {
 	if($type3 == 'user'){
yield $MadelineProto->contacts->block(['id' => $peer]); yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Blocked!"]);
}
}
}

if(preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text)){
$gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gmsg['messages'][0]['from_id'];
  if(!in_array($messag, $data['enemies'])){
    $data['enemies'][] = $messag;
    file_put_contents("data.json", json_encode($data));
    yield $MadelineProto->contacts->block(['id' => $messag]);
    yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "$messag is now in enemy list"]);
  } else {
    yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This User Was In EnemyList"]);
  }
}
if(preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text)){
$gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gmsg = yield $MadelineProto->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gmsg['messages'][0]['from_id'];
  if(in_array($messag, $data['enemies'])){
    $k = array_search($messag, $data['enemies']);
    unset($data['enemies'][$k]);
    file_put_contents("data.json", json_encode($data));
    yield $MadelineProto->contacts->unblock(['id' => $messag]);
    yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "$messag deleted from enemy list"]);
  } else{
    yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This User Wasn't In EnemyList"]);
  }
 }
}

if(preg_match("/^[\/\#\!]?(answerlist)$/i", $text)){
if(count($data['answering']) > 0){
$txxxt = "لیست پاسخ ها :
";
$counter = 1;
foreach($data['answering'] as $k => $ans){
$txxxt .= "$counter: $k => $ans \n";
$counter++;
}
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txxxt]);
}else{
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "پاسخی وجود ندارد!"]);
  }
 }
 if($text == 'help' or $text == '/help'){
$mem_using = round(memory_get_usage() / 1024 / 1024,1);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "راهنمای سلف بات میدلاین
`/bot ` [on] or [off]
• خاموش و روشن کردن ربات

`ping`
• دریافت وضعیت ربات

`online ` on یا off
• روشن و خاموش کردن حالت همیشه انلاین

`typing ` on یا off
• روشن و خاموش کردن حالت تایپینگ بعد از هر پیام

`markread ` on یا off
• روشن و خاموش کردن حالت خوانده شدن پیام ها

`flood ` [NUMBER] [TEXT]
•  اسپم پیام در یک متن

`flood2 ` [NUMBER] [TEXT]
•  اسپم بصورت پیام های مکرر

`contacts ` on یا off
• فعال شدن حالت ادد شدن مخاطبین به صورت خودکار

`adduser ` [UserID] [IDGroup]
• ادد کردن یه کاربر به گروه موردنظر

`setusername ` [text]
• تنظیم نام کاربری (آیدی) ربات

`profile ` [NAME] `|` [LAST] `|` [BIO]
• تنظیم نام اسم , فامیل و بیوگرافی ربات

`/blue ` [TEXT-EN]
• تبدیل متن انگلیسی به فنت Blue

`/sticker ` [TEXT]
• تبدیل متن به استیکر

`/upload ` [URL]
• اپلود فایل از لینک

`/time ` [Time-Zone-EN] (iran)
• دریافت ساعت و تاریخ محلی

`/weather ` [TEXT-EN]
• آب و هوای منطقه

`/music ` [TEXT]
• موزیک درخواستی

`block ` [@username] یا [reply]
• بلاک کردن شخصی خاص در ربات

`unblock ` [@username] یا [reply]
• آزاد کردن شخصی خاص از بلاک در ربات

`/info ` [@username]
• دریافت اطلاعات کاربر

`/gpinfo`
• دریافت اطلاعات گروه

`/sessions`
• دریافت بازنشست های فعال اکانت

`/save ` [REPLAY]
• سیو کردن پیام و محتوا  در پیوی خود ربات

`/id ` [reply]
• دریافت ایدی عددی کابر

`!setenemy ` [userid] یا [reply]
• تنظیم دشمن با استفاده از ایدی عددی یا ریپلی

`!delenemy ` [userid] یا [reply]
• حذف دشمن با استفاده از ایدی عددی یا ریپلی

`!clean enemylist`
• پاک کردن لیست دشمنان

× × × × × ×

🍃 #بخش_تنظیم_جواب_سریع :

`/setanswer ` [TEXT] | [ANSWER]
• افزودن جواب سریع (متن اول متن دریافتی از کاربر و ددوم جوابی که ربات بدهد)

`/delanswer ` [TEXT]
• حذف جواب سریع

`/clean answers`
• حذف همه جواب سریع ها

`/answerlist`
• لیست همه جواب سریع ها

× × × × × ×
Crator :SjD , SylvanasWindruner , MrSwift

♻️ مقدار رم درحال استفاده : $mem_using مگابایت",
'parse_mode' => 'markdown']);
}
if(preg_match("/^[\/\#\!]?(save)$/i", $text) && isset($message['reply_to_msg_id'])){
$me = yield $MadelineProto->get_self();
$me_id = $me['id'];
yield $MadelineProto->messages->forwardMessages(['from_peer' => $peer, 'to_peer' => $me_id, 'id' => [$message['reply_to_msg_id']]]);
      yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "> Saved :D"]);
     }
 if(preg_match("/^[\/\#\!]?(typing) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(typing) (on|off)$/i", $text, $m);
$data['typing'] = $m[2];
file_put_contents("data.json", json_encode($data));
      yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Typing Now Is $m[2]"]);
     }
 if(preg_match("/^[\/\#\!]?(echo) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(echo) (on|off)$/i", $text, $m);
$data['echo'] = $m[2];
file_put_contents("data.json", json_encode($data));
      yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Echo Now Is $m[2]"]);
     }
 if(preg_match("/^[\/\#\!]?(markread) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(markread) (on|off)$/i", $text, $m);
$data['markread'] = $m[2];
file_put_contents("data.json", json_encode($data));
      yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Markread Now Is $m[2]"]);
     }
 if(preg_match("/^[\/\#\!]?(info) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(info) (.*)$/i", $text, $m);
$mee = yield $MadelineProto->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_status = $me['status']['_'];
$me_bio = $mee['full']['about'];
$me_common = $mee['full']['common_chats_count'];
$me_name = $me['first_name'];
$me_uname = $me['username'];
$mes = "ID: $me_id \nName: $me_name \nUsername: @$me_uname \nStatus: $me_status \nBio: $me_bio \nCommon Groups Count: $me_common";
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => $mes]);
     }
 if(preg_match("/^[\/\#\!]?(block) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(block) (.*)$/i", $text, $m);
yield $MadelineProto->contacts->block(['id' => $m[2]]);
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Blocked!"]);
     }
 if(preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $text, $m);
yield $MadelineProto->contacts->unblock(['id' => $m[2]]);
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "UnBlocked!"]);
     }
 if(preg_match("/^[\/\#\!]?(checkusername) (@.*)$/i", $text)){
preg_match("/^[\/\#\!]?(checkusername) (@.*)$/i", $text, $m);
$check = yield $MadelineProto->account->checkUsername(['username' => str_replace("@", "", $m[2])]);
if($check == false){
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Exists!"]);
} else{
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Free!"]);
}
     }
 if(preg_match("/^[\/\#\!]?(setfirstname) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setfirstname) (.*)$/i", $text, $m);
yield $MadelineProto->account->updateProfile(['first_name' => $m[2]]);
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Done!"]);
     }
 if(preg_match("/^[\/\#\!]?(setlastname) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setlastname) (.*)$/i", $text, $m);
yield $MadelineProto->account->updateProfile(['last_name' => $m[2]]);
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Done!"]);
     }
 if(preg_match("/^[\/\#\!]?(setbio) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setbio) (.*)$/i", $text, $m);
yield $MadelineProto->account->updateProfile(['about' => $m[2]]);
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Done!"]);
     }
 if(preg_match("/^[\/\#\!]?(setusername) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setusername) (.*)$/i", $text, $m);
yield $MadelineProto->account->updateUsername(['username' => $m[2]]);
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Done!"]);
     }
 if(preg_match("/^[\/\#\!]?(j) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(j) (.*)$/i", $text, $m);
yield $MadelineProto->channels->joinChannel(['channel' => $m[2]]);
yield $MadelineProto->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "Joined!"]);
     }
if(preg_match("/^[\/\#\!]?(add2all) (@.*)$/i", $text)){
preg_match("/^[\/\#\!]?(add2all) (@.*)$/i", $text, $m);
$dialogs = yield $MadelineProto->get_dialogs();
foreach ($dialogs as $peeer) {
$peer_info = yield $MadelineProto->get_info($peeer);
$peer_type = $peer_info['type'];
if($peer_type == "supergroup"){
  yield $MadelineProto->channels->inviteToChannel(['channel' => $peeer, 'users' => [$m[2]]]);
}
}
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "Added To All SuperGroups"]);
     }
 if(preg_match("/^[\/\#\!]?(newanswer) (.*) \|\|\| (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(newanswer) (.*) \|\|\| (.*)$/i", $text, $m);
$txxt = $m[2];
$answeer = $m[3];
if(!isset($data['answering'][$txxt])){
$data['answering'][$txxt] = $answeer;
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "New Word Added To AnswerList"]);
} else{
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This Word Was In AnswerList"]);
}
     }
 if(preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text, $m);
$txxt = $m[2];
if(isset($data['answering'][$txxt])){
unset($data['answering'][$txxt]);
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "Word Deleted From AnswerList"]);
} else{
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This Word Wasn't In AnswerList"]);
}
     }
 if(preg_match("/^[\/\#\!]?(clean answers)$/i", $text)){
$data['answering'] = [];
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "AnswerList Is Now Empty!"]);
     }
 if(preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text, $m);
$mee = yield $MadelineProto->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_name = $me['first_name'];
if(!in_array($me_id, $data['enemies'])){
$data['enemies'][] = $me_id;
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->contacts->block(['id' => $m[2]]);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "$me_name is now in enemy list"]);
} else {
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This User Was In EnemyList"]);
}
     }
 if(preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text, $m);
$mee = yield $MadelineProto->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_name = $me['first_name'];
if(in_array($me_id, $data['enemies'])){
$k = array_search($me_id, $data['enemies']);
unset($data['enemies'][$k]);
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->contacts->unblock(['id' => $m[2]]);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "$me_name deleted from enemy list"]);
} else{
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "This User Wasn't In EnemyList"]);
}
     }
 if(preg_match("/^[\/\#\!]?(clean enemylist)$/i", $text)){
$data['enemies'] = [];
file_put_contents("data.json", json_encode($data));
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "EnemyList Is Now Empty!"]);
     }
 if(preg_match("/^[\/\#\!]?(enemylist)$/i", $text)){
if(count($data['enemies']) > 0){
$txxxt = "EnemyList:
";
$counter = 1;
foreach($data['enemies'] as $ene){
  $mee = yield $MadelineProto->get_full_info($ene);
  $me = $mee['User'];
  $me_name = $me['first_name'];
  $txxxt .= "$counter: $me_name \n";
  $counter++;
}
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txxxt]);
} else{
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "No Enemy!"]);
}
     }
 if(preg_match("/^[\/\#\!]?(inv) (@.*)$/i", $text) && $update['_'] == "updateNewChannelMessage"){
preg_match("/^[\/\#\!]?(inv) (@.*)$/i", $text, $m);
$peer_info = yield $MadelineProto->get_info($message['to_id']);
$peer_type = $peer_info['type'];
if($peer_type == "supergroup"){
yield $MadelineProto->channels->inviteToChannel(['channel' => $message['to_id'], 'users' => [$m[2]]]);
} else{
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "Just SuperGroups"]);
}
     }
if ($text==  'لفت' or $text== 'left') {
yield $MadelineProto->channels->leaveChannel(['channel' => $peer]);
yield $MadelineProto->channels->deleteChannel(['channel' => $peer ]);
}
 if(preg_match("/^[\/\#\!]?(flood) ([0-9]+) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(flood) ([0-9]+) (.*)$/i", $text, $m);
$count = $m[2];
$txt = $m[3];
$spm = "";
for($i=1; $i <= $count; $i++){
$spm .= "$txt \n";
}
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $spm]);
     }
 if(preg_match("/^[\/\#\!]?(flood2) ([0-9]+) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(flood2) ([0-9]+) (.*)$/i", $text, $m);
$count = $m[2];
$txt = $m[3];
for($i=1; $i <= $count; $i++){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt]);
}
     }
 if(preg_match("/^[\/\#\!]?(music) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(music) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@melobot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(wiki) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(wiki) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@wiki", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(youtube) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(youtube) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@uVidBot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(pic) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(pic) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@pic", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(gif) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(gif) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@gif", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(google) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(google) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@GoogleDEBot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(joke)$/i", $text)){
preg_match("/^[\/\#\!]?(joke)$/i", $text, $m);
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@function_robot", 'peer' => $peer, 'query' => '', 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(aasab)$/i", $text)){
preg_match("/^[\/\#\!]?(aasab)$/i", $text, $m);
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@function_robot", 'peer' => $peer, 'query' => '', 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][1]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(like) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(like) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $MadelineProto->messages->getInlineBotResults(['bot' => "@like", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
yield $MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(search) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(search) (.*)$/i", $text, $m);
$q = $m[2];
$res_search = yield $MadelineProto->messages->search(['peer' => $peer, 'q' => $q, 'filter' => ['_' => 'inputMessagesFilterEmpty'], 'min_date' => 0, 'max_date' => time(), 'offset_id' => 0, 'add_offset' => 0, 'limit' => 50, 'max_id' => $message['id'], 'min_id' => 1]);
$texts_count = count($res_search['messages']);
$users_count = count($res_search['users']);
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => "Msgs Found: $texts_count \nFrom Users Count: $users_count"]);
foreach($res_search['messages'] as $text){
$textid = $text['id'];
yield $MadelineProto->messages->forwardMessages(['from_peer' => $text, 'to_peer' => $peer, 'id' => [$textid]]);
 }
}
 else if(preg_match("/^[\/\#\!]?(weather) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(weather) (.*)$/i", $text, $m);
$query = $m[2];
$url = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$query."&appid=eedbc05ba060c787ab0614cad1f2e12b&units=metric"), true);
$city = $url["name"];
$deg = $url["main"]["temp"];
$type1 = $url["weather"][0]["main"];
if($type1 == "Clear"){
		$tpp = 'آفتابی☀';
		file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Clouds"){
		$tpp = 'ابری ☁☁';
		file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Rain"){
		 $tpp = 'بارانی ☔';
file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Thunderstorm"){
		$tpp = 'طوفانی ☔☔☔☔';
file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Mist"){
		$tpp = 'مه 💨';
file_put_contents('type.txt',$tpp);
	}
  if($city != ''){
$eagle_tm = file_get_contents('type.txt');
  $txt = "دمای شهر $city هم اکنون $deg درجه سانتی گراد می باشد

شرایط فعلی آب و هوا: $eagle_tm";
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt]);
unlink('type.txt');
}else{
 $txt = "⚠️شهر مورد نظر شما يافت نشد";
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt]);
 }
}
  else if(preg_match("/^[\/\#\!]?(sessions)$/i", $text)){
$authorizations = yield $MadelineProto->account->getAuthorizations();
$txxt="";
foreach($authorizations['authorizations'] as $authorization){
$txxt .="
هش: ".$authorization['hash']."
مدل دستگاه: ".$authorization['device_model']."
سیستم عامل: ".$authorization['platform']."
ورژن سیستم: ".$authorization['system_version']."
api_id: ".$authorization['api_id']."
app_name: ".$authorization['app_name']."
نسخه برنامه: ".$authorization['app_version']."
تاریخ ایجاد: ".date("Y-m-d H:i:s",$authorization['date_active'])."
تاریخ فعال: ".date("Y-m-d H:i:s",$authorization['date_active'])."
آی‌پی: ".$authorization['ip']."
کشور: ".$authorization['country']."
منطقه: ".$authorization['region']."

====================";
}
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txxt]);
     }
 if(preg_match("/^[\/\#\!]?(gpinfo)$/i", $text)){
$peer_inf = yield $MadelineProto->get_full_info($message['to_id']);
$peer_info = $peer_inf['Chat'];
$peer_id = $peer_info['id'];
$peer_title = $peer_info['title'];
$peer_type = $peer_inf['type'];
$peer_count = $peer_inf['full']['participants_count'];
$des = $peer_inf['full']['about'];
$mes = "ID: $peer_id \nTitle: $peer_title \nType: $peer_type \nMembers Count: $peer_count \nBio: $des";
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $mes]);
     }
   }
 if($data['power'] == "on"){
   if ($from_id != $admin) {
   if($message && $data['typing'] == "on" && $update['_'] == "updateNewChannelMessage"){
$sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
yield $MadelineProto->messages->setTyping(['peer' => $peer, 'action' => $sendMessageTypingAction]);
     }
     if($message && $data['echo'] == "on"){
yield $MadelineProto->messages->forwardMessages(['from_peer' => $peer, 'to_peer' => $peer, 'id' => [$message['id']]]);
     }
     if($message && $data['markread'] == "on"){
if(intval($peer) < 0){
yield $MadelineProto->channels->readHistory(['channel' => $peer, 'max_id' => $message['id']]);
yield $MadelineProto->channels->readMessageContents(['channel' => $peer, 'id' => [$message['id']] ]);
} else{
yield $MadelineProto->messages->readHistory(['peer' => $peer, 'max_id' => $message['id']]);
}
     }
     if(strpos($text, '😐') !== false and $data['poker'] == "on"){
yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => '😐', 'reply_to_msg_id' => $message['id']]);
     }
  $fohsh = [
"گص کش","کس ننه","کص ننت","کس خواهر","کس خوار","کس خارت","کس ابجیت","کص لیس","ساک بزن","ساک مجلسی","ننه الکسیس","نن الکسیس","ناموستو گاییدم","ننه زنا","کس خل","کس مخ","کس مغز","کس مغذ","خوارکس","خوار کس","خواهرکس","خواهر کس","حروم زاده","حرومزاده","خار کس","تخم سگ","پدر سگ","پدرسگ","پدر صگ","پدرصگ","ننه سگ","نن سگ","نن صگ","ننه صگ","ننه خراب","تخخخخخخخخخ","نن خراب","مادر سگ","مادر خراب","مادرتو گاییدم","تخم جن","تخم سگ","مادرتو گاییدم","ننه حمومی","نن حمومی","نن گشاد","ننه گشاد","نن خایه خور","تخخخخخخخخخ","نن ممه","کس عمت","کس کش","کس بیبیت","کص عمت","کص خالت","کس بابا","کس خر","کس کون","کس مامیت","کس مادرن","مادر کسده","خوار کسده","تخخخخخخخخخ","ننه کس","بیناموس","بی ناموس","شل ناموس","سگ ناموس","ننه جندتو گاییدم باو ","چچچچ نگاییدم سیک کن پلیز D:","ننه حمومی","چچچچچچچ","لز ننع","ننه الکسیس","کص ننت","بالا باش","ننت رو میگام","کیرم از پهنا تو کص ننت","مادر کیر دزد","ننع حرومی","تونل تو کص ننت","کیر تک تک بکس تلع گلد تو کص ننت","کص خوار بدخواه","خوار کصده","ننع باطل","حروم لقمع","ننه سگ ناموس","منو ننت شما همه چچچچ","ننه کیر قاپ زن","ننع اوبی","ننه کیر دزد","ننه کیونی","ننه کصپاره","زنا زادع","کیر سگ تو کص نتت پخخخ","ولد زنا","ننه خیابونی","هیس بع کس حساسیت دارم","کص نگو ننه سگ که میکنمتتاااا","کص نن جندت","ننه سگ","ننه کونی","ننه زیرابی","بکن ننتم","ننع فاسد","ننه ساکر","کس ننع بدخواه","نگاییدم","مادر سگ","ننع شرطی","گی ننع","بابات شاشیدتت چچچچچچ","ننه ماهر","حرومزاده","ننه کص","کص ننت باو","پدر سگ","سیک کن کص ننت نبینمت","کونده","ننه ولو","ننه سگ","مادر جنده","کص کپک زدع","ننع لنگی","ننه خیراتی","سجده کن سگ ننع","ننه خیابونی","ننه کارتونی","تکرار میکنم کص ننت","تلگرام تو کس ننت","کص خوارت","خوار کیونی","پا بزن چچچچچ","مادرتو گاییدم","گوز ننع","کیرم تو دهن ننت","ننع همگانی","کیرم تو کص زیدت","کیر تو ممهای ابجیت","ابجی سگ","کس دست ریدی با تایپ کردنت چچچ","ابجی جنده","ننع سگ سیبیل","بده بکنیم چچچچ","کص ناموس","شل ناموس","ریدم پس کلت چچچچچ","ننه شل","ننع قسطی","ننه ول","دست و پا نزن کس ننع","ننه ولو","خوارتو گاییدم","محوی!؟","ننت خوبع!؟","کس زنت","شاش ننع","ننه حیاطی /:","نن غسلی","کیرم تو کس ننت بگو مرسی چچچچ","ابم تو کص ننت :/","فاک یور مادر خوار سگ پخخخ","کیر سگ تو کص ننت","کص زن","ننه فراری","بکن ننتم من باو جمع کن ننه جنده /:::","ننه جنده بیا واسم ساک بزن","حرف نزن که نکنمت هااا :|","کیر تو کص ننت😐","کص کص کص ننت😂","کصصصص ننت جووون","سگ ننع","کص خوارت","کیری فیس","کلع کیری","تیز باش سیک کن نبینمت","فلج تیز باش چچچ","بیا ننتو ببر","بکن ننتم باو ","کیرم تو بدخواه","چچچچچچچ","ننه جنده","ننه کص طلا","ننه کون طلا","کس ننت بزارم بخندیم!؟","کیرم دهنت","مادر خراب","ننه کونی","هر چی گفتی تو کص ننت خخخخخخخ","کص ناموست بای","کص ننت بای ://","کص ناموست باعی تخخخخخ","کون گلابی!","ریدی آب قطع","کص کن ننتم کع","نن کونی","نن خوشمزه","ننه لوس"," نن یه چشم ","ننه چاقال","ننه جینده","ننه حرصی ","نن لشی","ننه ساکر","نن تخمی","ننه بی هویت","نن کس","نن سکسی","نن فراری","لش ننه","سگ ننه","شل ننه","ننه تخمی","ننه تونلی","ننه کوون","نن خشگل","نن جنده","نن ول ","نن سکسی","نن لش","کس نن ","نن کون","نن رایگان","نن خاردار","ننه کیر سوار","نن پفیوز","نن محوی","ننه بگایی","ننه بمبی","ننه الکسیس","نن خیابونی","نن عنی","نن ساپورتی","نن لاشخور","ننه طلا","ننه عمومی","ننه هر جایی","نن دیوث","تخخخخخخخخخ","نن ریدنی","نن بی وجود","ننه سیکی","ننه کییر","نن گشاد","نن پولی","نن ول","نن هرزه","نن دهاتی","ننه ویندوزی","نن تایپی","نن برقی","نن شاشی","ننه درازی","شل ننع","یکن ننتم که","کس خوار بدخواه","آب چاقال","ننه جریده","ننه سگ سفید","آب کون","ننه 85","ننه سوپری","بخورش","کس ن","خوارتو گاییدم","خارکسده","گی پدر","آب چاقال","زنا زاده","زن جنده","سگ پدر","مادر جنده","ننع کیر خور","چچچچچ","تیز بالا","ننه سگو با کسشر در میره","کیر سگ تو کص ننت","kos kesh","kir","kiri","nane lashi","kos","kharet","blis kirmo","دهاتی","کیرم لا کص خارت","کیری","ننه لاشی","ممه","کص","کیر","بی خایه","ننه لش","بی پدرمادر","خارکصده","مادر جنده","کصکش"
];
if(in_array($from_id, $data['enemies'])){
  $f = $fohsh[rand(0, count($fohsh)-1)];
  yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $f, 'reply_to_msg_id' => $msg_id]);
}
if(isset($data['answering'][$text])){
  yield $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $data['answering'][$text] , 'reply_to_msg_id' => $msg_id]);
    }
   }
  }
 }
} catch(\Exception $e){

  }
 }
}

// Madeline Tools
register_shutdown_function('shutdown_function', $lock);
closeConnection();
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
  yield $MadelineProto->setEventHandler('\EventHandler');
});
$MadelineProto->loop();

?>
