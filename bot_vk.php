<?php
$chat_tg = '';

include_once 'include/vk.php';
include_once 'include/tg.php';

$vk = new VK();
$tg = new TG();

if($vk->data['type'] == 'message_new')
{
    $chat_id = $vk->data['object']['message']['peer_id'];                   // ID чата
    $from_id = $vk->data['object']['message']['from_id'];                   // ID пользователя, которая написал сообщение
    $text = mb_strtolower($vk->data['object']['message']['text'], 'utf-8'); // Текст сообщения

    if($text)
    {
        if($text == 'ид чата') $vk->send($chat_id, $chat_id);
        else
        {
            $user = $vk->request("users.get", ["user_ids" => $from_id]); // Получаем информацию о пользователе (имя)
            $tg->send($chat_tg, '' . $user[0]['first_name'] . "\n" . $text);
        }
    }
}