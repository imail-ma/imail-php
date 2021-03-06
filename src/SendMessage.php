<?php
namespace Imail;

class SendMessage
{
    protected $client;

    public $attributes = [];

    public function __construct($client)
    {
        $this->client = $client;
        $this->reset();
    }

    public function reset()
    {
        $this->attributes = [
            'to' => [],
            'cc' => [],
            'bcc' => [],
            'headers' => null,
            'attachments' => []
        ];
    }

    public function to($address, $name = null)
    {
        if ($name !== null) {
            $address = '"' . $name . '" <' . $address . '>';
        }
        $this->attributes['to'][] = $address;
    }

    public function cc($address, $name = null)
    {
        if ($name !== null) {
            $address = '"' . $name . '" <' . $address . '>';
        }
        $this->attributes['cc'][] = $address;
    }

    public function bcc($address, $name = null)
    {
        if ($name !== null) {
            $address = '"' . $name . '" <' . $address . '>';
        }
        $this->attributes['bcc'][] = $address;
    }

    public function from($address, $name = null)
    {
        if ($name !== null) {
            $address = '"' . $name . '" <' . $address . '>';
        }
        $this->attributes['from'] = $address;
    }

    public function sender($address)
    {
        $this->attributes['sender'] = $address;
    }

    public function subject($subject)
    {
        $this->attributes['subject'] = $subject;
    }

    public function tag($tag)
    {
        $this->attributes['tag'] = $tag;
    }

    public function replyTo($replyTo, $name = null)
    {
        if ($name !== null) {
            $replyTo = '"' . $name . '" <' . $replyTo . '>';
        }
        $this->attributes['reply_to'] = $replyTo;
    }

    public function plainBody($content)
    {
        $this->attributes['plain_body'] = $content;
    }

    public function htmlBody($content)
    {
        $this->attributes['html_body'] = $content;
    }

    public function header($key, $value)
    {
        $this->attributes['headers'][$key] = $value;
    }

    public function attach($filename, $content_type, $data)
    {
        $attachment = [
            'name' => $filename,
            'content_type' => $content_type,
            'data' => base64_encode($data),
        ];

        $this->attributes['attachments'][] = $attachment;
    }


    public function send()
    {
        $result = $this->client->makeRequest('send', 'message', $this->attributes);

        return new SendResult($this->client, $result);
    }
}