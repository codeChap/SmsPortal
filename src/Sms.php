<?php
declare(strict_types=1);

namespace Codechap\SmsPortal;

use Codechap\SmsPortal\Traits\GetSet;

class Sms
{
    use GetSet;

    private const API_URL = 'https://rest.smsportal.com/bulkmessages';

    private $clientId;
    private $clientSecret;

   /**
    * Send SMS
    *
    * @param string $to   Recipient phone number
    * @param string $body Message content
    * @return object|false API response object or false on failure
    * @throws Exception
    */
    public function send($to, $body) : object|false
    {
        // Validate inputs
        if (empty($to) || empty($body)) {
            throw new \Exception('Recipient and message body are required');
        }

        // Validate phone number format
        if (!preg_match('/^\+?[1-9]\d{1,14}$/', $to)) {
            throw new \Exception('Invalid phone number format');
        }

        // Validate message body length
        if (strlen($body) > 160) {
            throw new \Exception('Message body exceeds maximum length');
        }

        // Prepare authentication
        $accountApiCredentials = $this->clientId . ':' . $this->clientSecret;
        $authHeader = 'Authorization: Basic ' . base64_encode($accountApiCredentials);

        // Prepare request data
        $sendData = json_encode([
            'messages' => [
                [
                    'content'              => $body,
                    'destination'          => $to,
                    'deliveryNotification' => true,
                ],
            ],
            "sendOptions" => [
                "campaignName" => "Portal"
            ]
        ]);

        // Configure request options
        $context = stream_context_create([
            'http' => [
                'header'  => [
                    "Content-Type: application/json",
                    $authHeader
                ],
                'method'  => 'POST',
                'content' => $sendData,
                'ignore_errors' => true
            ]
        ]);

        // Send request
        $response = file_get_contents(self::API_URL, false, $context);

        if ($response === false) {
            return false;
        }

        // Validate response
        if (!is_string($response)) {
            return false;
        }

        // Decode response
        return json_decode($response);
    }
}
