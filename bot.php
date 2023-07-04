<?php 

ob_start();

$API_KEY = '6102152287:AAHtO_vJp-uPFO3XHd3-E9aiJnih0dCGsEg';
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>$mode
 ]);
 }
 function sendphoto($chat_id, $photo, $captionl){
 bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>$photo,
 'caption'=>$caption,
 ]);
 }
 function sendsticker($chat_id, $photo, $captionl){
 bot('sendsticker',[
 'chat_id'=>$chat_id,
 'sticker'=>$photo,
 'caption'=>$caption,
 ]);
 }
 function sendaction($chat_id, $action){
 bot('sendchataction',[
 'chat_id'=>$chat_id,
 'action'=>$action
 ]);
 }
 //====================Fornax======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
//====================Fornax======================//
if(preg_match('/^\/([Ss]tart)/',$text)){
sendaction($chat_id, typing);
        bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "
Bu bot rasmlarni stickerga aylantirish uchun mo'ljallangan ЁЯМ┐

Botga hohlagan rasmingizni yuboring, bot sizga o'sha rasmni sticker shaklida qaytaradi ЁЯФе

Yaratuvchi: [Lunatic Fornax](t.me/LunaticFornax) тЪбя╕П
Jamoamiz: [Fornax Team](t.me/Fornax_Team) тЪбя╕П",
'reply_to_message_id'=>$message->message_id,
'disable_web_page_preview'=>'true',
'parse_mode'=>"MarkDown"
            ]);
        }
elseif(isset($message->photo)){
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('tikapp.png',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    sendsticker($chat_id , new CURLFile('tikapp.png'), "Hi");
    }
elseif(isset($message->sticker)){
$sticker = $message->sticker;
$file = $sticker->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('tikapp.png',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    sendphoto($chat_id , new CURLFile('tikapp.png'), "Hi");
    }
    ?>
