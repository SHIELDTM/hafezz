<?php
ob_start();
define('API_KEY','197532731:AAHzqjbYep0d1_1HY12YgDR-ZbBJzhrhnVM');
$admin = "200106480";
$admin2 = "131020409";
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
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$editm = $update->edited_message;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$text1 = $message->text;
$fadmin = $message->from->id;
$file_o = __DIR__.'/users/'.$mid.'.json';
file_put_contents($file_o,json_encode($update->message->text));
chmod($file_o,0777);
if (isset($update->edited_message)){
  //$chat_id1 = $editm->chat->id;
  $eid = $editm->message_id;
  $edname = $editm->from->first_name;
  $text2 = $editm->text;
  $jsu = json_decode(file_get_contents(__DIR__.'/users/'.$eid.'.json'));
  $text = "<b>".$edname."</b>\nادیت نکن دیگه من دیدم که نوشتی:\n\n<code>".$text2."</code>\n@Dont_Edit_Bot"
  $id = $update->edited_message->chat->id;
  bot('sendmessage',[
    'chat_id'=>$id,
    'reply_to_message_id'=>$eid,
    'text'=>$text,
    'parse_mode'=>'html'
  ]);
  $file_o = __DIR__.'/users/'.$eid.'.json';
  file_put_contents($file_o,json_encode($update->edited_message->text));
  //$up = file_get_contents(__DIR__.'/users/'.$eid.'.json');
  //str_replace("edited_message","message",$up);
}elseif(preg_match('/^\/([Ss]tart)/',$text1)){
  $text = "<b>به ربات ادیت نکن</b>\n<b>خوش آمدید</b>\n<b>برای اد کردن من به گروه بر روی لینک زیر بزنید</b>\n\nhttps://telegram.me/Dont_Edit_Bot?startgroup=new\nکاری مشترک از تیم های شیلد و سودو\n@shieldTM\n@SuDo_TM";
  bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>$text,
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'S H I E L D','url'=>'https://telegram.me/shieldTM'],
		  ['text'=>'H.A.F.E.Z','url'=>'https://telegram.me/EdBaRoO']
        ],
        [
          ['text'=>'SuDo TEAM','url'=>'https://telegram.me/SuDo_TM'],
		  ['text'=>'AliReza','url'=>'https://telegram.me/AliRezaMee']
        ]
      ]
    ])
  ]);
}elseif( $fadmin == $admin |  $fadmin == $admin2 and $update->message->text == '/stats'){
    $txtt = file_get_contents('member.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
  bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"کاربران : $mmemcount 👤 "
    ]);

}elseif(isset($update->message-> new_chat_member )){
bot('sendMessage',[
      'chat_id'=>$chat_id,
      $edname = $editm->from->first_name;
      'text'=>"<b>".$edname."</b>\nسلام خوش اومدی اگه پیام ادیت کنی من می فهمم پس ادیت نکن ضایع بشی"
    ]);
}
  
  
  
  
  
  
  
$txxt = file_get_contents('member.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array($chat_id,$pmembersid)){
      $aaddd = file_get_contents('member.txt');
      $aaddd .= $chat_id."\n";
      file_put_contents('member.txt',$aaddd);
    }
