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

    public function fileUpload($params =[])
    {
        $options=[
            'headers'  => [
                'Authorization'=>'Bearer '. config('slack-api.slack-token')
                ]
            ];
        foreach ($params as $key => $value) {
            if ($key == 'file') {
                $options['multipart'][]=[
                    'name'  =>  $key,
                    'contents'  =>  fopen($value, 'r')
                ];
            } else {
                $options['multipart'][]=[
                    'name'=> $key,
                    'contents'=>$value
                ];
            }
        }
        /* $options = [
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
            ]; */
        $response = $this->client->post(self::SLACK_FILE_UPLOAD, $options);
        return json_decode($response->getBody()->getContents());
    }
}
