<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AiController extends Controller
{
    /**
     * ads  card for generating dummmy ads
     */

    public function marketingAds()
    {
        $ads = [
            (object)[
                'title' => 'Turn Free Time Into Cash',
                'body' => 'Use this 3-step system to earn income online with nothing but a browser and 30 minutes.',
                'image' => asset('storage/marketing_thumbnails/make_money_online.png'),
                'fighter_name' => 'Side Hustle King',
                'link' => '/fights/show/1',
            ],
            (object)[
                'title' => 'Viral TikTok Trick',
                'body' => 'How I got 200k views in a weekend without dancing or filters.',
                'image' => asset('storage/marketing_thumbnails/tiktok_marketing.png'),
                'fighter_name' => 'Tok Boss',
                'link' => '/fights/show/2',
            ],
        // Add the other 8 ads...
        ];

        return view('fighter.marketing', compact('ads'));
    }
}
