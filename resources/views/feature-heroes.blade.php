@php
$features = [
    [
        'title'   => 'Ad Weapon',
        'tiers'   => [
            'Amateur'     => 'Text only',
            'Lightweight' => 'Full HTML WYSIWYG',
            'Heavyweight' => 'AI generated ads',
        ],
        'benefit' => 'Capture the voters’ eye with a beautiful, rich, full-HTML ad… it will automatically generate an ad weapon for you',
    ],
    [
        'title'   => 'Cost to Display Ad Weapon',
        'tiers'   => [
            'Amateur'     => '50',
            'Lightweight' => '30',
            'Heavyweight' => '20',
        ],
        'benefit' => 'It lasts forever when you pay less for displaying your fights',
    ],
    [
        'title'   => 'Credits for Voting',
        'tiers'   => [
            'Amateur'     => '20–60',
            'Lightweight' => '25–75',
            'Heavyweight' => '30–90',
        ],
        'benefit' => 'Your fight displayed 1.5×–2× more times with paid membership',
    ],
    [
        'title'   => 'Max # of Fights',
        'tiers'   => [
            'Amateur'     => '3',
            'Lightweight' => '5',
            'Heavyweight' => 'Unlimited',
        ],
        'benefit' => 'Multiple fights for all of your programs, multi-way advertising',
    ],
    [
        'title'   => 'Login Ads?',
        'tiers'   => [
            'Amateur'     => 'No',
            'Lightweight' => 'Yes',
            'Heavyweight' => 'Yes',
        ],
        'benefit' => 'Login ads work, but you have to be heavyweight to get it',
    ],
    [
        'title'   => 'Banner Ad on Surf Page',
        'tiers'   => [
            'Amateur'     => 'Yes',
            'Lightweight' => 'Yes',
            'Heavyweight' => 'Yes',
        ],
        'benefit' => 'Let the voters/visitors focus on your ad weapons',
    ],
    [
        'title'   => 'Priority Support',
        'tiers'   => [
            'Amateur'     => 'No',
            'Lightweight' => 'No',
            'Heavyweight' => 'Yes',
        ],
        'benefit' => 'Get replies to your inquiries within hours',
    ],
    [
        'title'   => 'Bonus Credits',
        'tiers'   => [
            'Amateur'     => '0',
            'Lightweight' => '50',
            'Heavyweight' => '100',
        ],
        'benefit' => 'Set it on autopilot—bonus credits delivered to your site every day',
    ],
    [
        'title'   => 'Random Opponent Pick',
        'tiers'   => [
            'Amateur'     => 'Third',
            'Lightweight' => 'Second',
            'Heavyweight' => 'First',
        ],
        'benefit' => 'Get your ads seen in priority—paid members first!',
    ],
    [
        'title'   => 'Test Ads by Running Fights',
        'tiers'   => [
            'Amateur'     => 'No',
            'Lightweight' => 'No',
            'Heavyweight' => 'Yes',
        ],
        'benefit' => 'Know which of your ads work and roll out the winners',
    ],
    [
        'title'   => 'Pick Only Free Members as Opponents',
        'tiers'   => [
            'Amateur'     => 'No',
            'Lightweight' => 'No',
            'Heavyweight' => 'Yes',
        ],
        'benefit' => 'So you can get the easy win and all the traffic and sales',
    ],
];
@endphp

@foreach($features as $feature)
    <x-hero-section
        :title="$feature['title']"
        :tiers="$feature['tiers']"
        :benefit="$feature['benefit']"
    />
@endforeach
