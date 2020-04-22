<?php

namespace MiguelRod\SlackApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use MiguelRod\SlackApi\SlackApi;
use Orchestra\Testbench\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use MiguelRod\SlackApi\SlackApiServiceProvider;

class SlackApiTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [SlackApiServiceProvider::class];
    }

    /** @test */
    public function it_uploads_file_successfully_to_slack()
    {
        $mock = new MockHandler([new Response(200, [], '{
                                                        "ok": true,
                                                        "file": {
                                                            "id": "F0TD00400",
                                                            "created": 1532293501,
                                                            "timestamp": 1532293501,
                                                            "name": "dramacat.gif",
                                                            "title": "dramacat",
                                                            "mimetype": "image/jpeg",
                                                            "filetype": "gif",
                                                            "pretty_type": "JPEG",
                                                            "user": "U0L4B9NSU",
                                                            "editable": false,
                                                            "size": 43518,
                                                            "mode": "hosted",
                                                            "is_external": false,
                                                            "external_type": "",
                                                            "is_public": false,
                                                            "public_url_shared": false,
                                                            "display_as_bot": false,
                                                            "username": "",
                                                            "url_private": "https://.../dramacat.gif",
                                                            "url_private_download": "https://.../dramacat.gif",
                                                            "thumb_64": "https://.../dramacat_64.gif",
                                                            "thumb_80": "https://.../dramacat_80.gif",
                                                            "thumb_360": "https://.../dramacat_360.gif",
                                                            "thumb_360_w": 360,
                                                            "thumb_360_h": 250,
                                                            "thumb_480": "https://.../dramacat_480.gif",
                                                            "thumb_480_w": 480,
                                                            "thumb_480_h": 334,
                                                            "thumb_160": "https://.../dramacat_160.gif",
                                                            "image_exif_rotation": 1,
                                                            "original_w": 526,
                                                            "original_h": 366,
                                                            "permalink": "https://.../dramacat.gif",
                                                            "permalink_public": "https://.../More-Path-Components",
                                                            "comments_count": 0,
                                                            "is_starred": false,
                                                            "shares": {
                                                                "private": {
                                                                    "D0L4B9P0Q": [
                                                                        {
                                                                            "reply_users": [],
                                                                            "reply_users_count": 0,
                                                                            "reply_count": 0,
                                                                            "ts": "1532293503.000001"
                                                                        }
                                                                    ]
                                                                }
                                                            },
                                                            "channels": [],
                                                            "groups": [],
                                                            "ims": [
                                                                "D0L4B9P0Q"
                                                            ],
                                                            "has_rich_preview": false
                                                        }
                                                    }')]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler'=>$handler]);

        $slack = new SlackApi($client);

        $response = $slack->fileUpload(['path'=>'test path','file'=>__DIR__.'/testfile.txt','filename'=>'test filename','title'=>' test title']);

        $this->assertSame(true, $response->ok);
    }
}
