<?php
include_once 'include/vk.php';
include_once 'include/tg.php';
$chat_vk = ''; // ID Вашей беседы во ВКонтакте

$vk = new VK();
$tg = new TG();

$data = json_decode(file_get_contents('php://input'),true);
$text = mb_strtolower($data['message']['text'], 'utf-8'); // Текст сообщения
$first_name = $data['message']['from']['first_name']; // Имя пользователя
$chat_id = $data['message']['chat']['id']; // ID чата

if($text)
{
    if($text == 'ид чата') $tg->send($chat_id, $chat_id);
    else $vk->send($chat_vk, '' . $first_name . "\n" . $text);
}

exit('ok');