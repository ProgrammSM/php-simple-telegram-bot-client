<?php

namespace Programmsm\SimpleTelegramBotClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Client for working with telegram bot.
 */
class BotClient
{
    /**
     * @param Client $client Guzzle client for send requests
     * @param string $botToken Token received from BotFather
     * @param string $apiUrl Url api Telegram
     */
    public function __construct(
        protected Client $client,
        protected string $botToken,
        protected string $apiUrl = 'https://api.telegram.org/bot',
    ) {}

    /**
     * Create example BotClient.
     *
     * @param Client $client Guzzle client for send requests
     * @param string $botToken Token received from BotFather
     * @param string $apiUrl Url api Telegram
     */
    public static function create(
        Client $client,
        string $botToken,
        string $apiUrl = 'https://api.telegram.org/bot',
    ): self {
        return new BotClient($client, $botToken, $apiUrl);
    }

    /**
     * Send text message to selected chat.
     *
     * @param int $chatId Identifier chat
     * @param string $message Text message
     * @param string|null $parseMode Format mode
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendMessageToChat(int $chatId, string $message, ?string $parseMode = null): ResponseInterface
    {
        $url = "{$this->apiUrl}{$this->botToken}/sendMessage";
        $params = [
            'chat_id' => $chatId,
            'text' => $message,
        ];
        if ($parseMode) {
            $params['parse_mode'] = $parseMode;
        }

        return $this->client->post($url, ['json' => $params]);
    }
}
