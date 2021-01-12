<?php

class TG
{
    private $token = '';

    public function request($method, $params = [])
    {
        $url = 'https://api.telegram.org/bot' . $this->token . '/' . $method;
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $out = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return $out;
    }

    public function send($chat, $text)
    {
        return  $this->request('sendMessage', ["parse_mode" => "markdown", "chat_id" => $chat, "text" => $text]);
    }
}