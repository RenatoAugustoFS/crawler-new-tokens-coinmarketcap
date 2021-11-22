<?php

namespace App\Service;

class SendNotificationTelegram
{
    private $chatId = ["1184086653"];
    private $token = "2110462498:AAHPhoTDDul3uzZxOD-vvFlI7r8br1_XW9Y";
    private $url;

    public function sendMessage($message)
    {
        foreach ($this->chatId as $chatId) {
            $this->url = "https://api.telegram.org/bot".$this->token."/sendMessage?chat_id=".$chatId."&text=";

            try {
                file_get_contents($this->url.urlencode($message));
            } catch (\Exception $exception) {
                continue;
            }
        }
    }
}