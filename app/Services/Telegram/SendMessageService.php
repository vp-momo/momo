<?php
namespace App\Services\Telegram;

use App\Services\HttpClientService;
use Illuminate\Support\Facades\Log;

class SendMessageService{
    /**
     * @var SendMessageService
     */
    private static $instances;

    public static function getInstance(): SendMessageService
    {
        if (!isset(self::$instances)) {
            self::$instances = new SendMessageService();
        }
        return self::$instances;
    }

    public function send($message){
        try {
            $botToken = config('app.telegram.bot_token');
            $chatId = config('app.telegram.chat_id');
            $uri = "https://api.telegram.org/bot".$botToken."/sendMessage";
            $body = [
                "chat_id" => $chatId,
                "text" => $message,
                "parse_mode" => "HTML"
            ];
            HttpClientService::getInstance()->curl($uri, $body, []);
        }catch (\Exception $exception){
            Log::error("error SendMessageService => send");
            Log::error($exception);
        }
    }
}
