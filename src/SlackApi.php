<?php

namespace MiguelRod\SlackApi;

use GuzzleHttp\Client;

class SlackApi
{
    const SLACK_FILE_UPLOAD ='https://slack.com/api/files.upload';
    protected $client;
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    public function uploadFile($path)
    {
        $options = [
            'multipart'  =>[
                [
                    'name'=>'channels',
                    'contents'=>'dev,privatetest'
                ],
                [
                    'name'=>'title',
                    'contents'     => 'test title',
                ],
                [
                    'contents'   => fopen($path, 'r'),
                    'name' => 'file'
                ]
            ],
            'headers'  => [
                'Authorization'=>'Bearer xoxb-1068834984038-1068983525878-eyUYByMFuUWcQ5kKGvqyzfIq']
            ];
        $response = $this->client->post(self::SLACK_FILE_UPLOAD, $options);
        return json_decode($response->getBody()->getContents());
    }
}
