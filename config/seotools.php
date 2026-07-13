<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        'defaults'       => [
            'title'        => "Daatrade | Empowering B2B Connections",
            'titleBefore'  => false,
            'description'  => "Daatrade.com is your ultimate destination for B2B trade and global sourcing solutions. We aim to revolutionize the way suppliers and buyers connect, facilitate seamless transactions, and foster business growth on a global scale.",
            'separator'    => ' - ',
            'keywords'     => ['daatrade', 'mines and minerals', 'rice', 'mines', 'fruits', 'salt', 'herbs', 'species', 'graines', 'animal feeds'],
            'canonical'    => false,
            'robots'       => 'index, follow', // Updated to allow indexing and following
        ],
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        'defaults' => [
            'title'       => 'Daatrade | Empowering B2B Connections',
            'description' => 'Daatrade.com is your ultimate destination for B2B trade and global sourcing solutions. We aim to revolutionize the way suppliers and buyers connect, facilitate seamless transactions, and foster business growth on a global scale.',
            'url'         => 'https://daatrade.com',
            'type'        => 'website', // Updated to 'website' as a common type
            'site_name'   => 'Daatrade', // Updated to include site name
            'images'      => [
                'https://daatrade.com/storage/product_images/20240229105111_65e0619f3b90f.png',
                'https://daatrade.com/storage/product_images/20240229104100_65e05f3c8b282.png',
                'https://daatrade.com/storage/product_images/20240227091940_65dda92c57eeb.png',
                'https://daatrade.com/assets/img/logo.png',
            ], // You can add images here
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card'        => 'summary_large_image', // Updated to a larger image card type
            'site'        => '@Daatrade', // Replace with your Twitter handle
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'Daatrade | Empowering B2B Connections',
            'description' => 'Daatrade.com is your ultimate destination for B2B trade and global sourcing solutions. We aim to revolutionize the way suppliers and buyers connect, facilitate seamless transactions, and foster business growth on a global scale.',
            'url'         => 'https://daatrade.com',
            'type'        => 'WebPage',
            'images'      => [
                'https://daatrade.com/storage/product_images/20240229105111_65e0619f3b90f.png',
                'https://daatrade.com/storage/product_images/20240229104100_65e05f3c8b282.png',
                'https://daatrade.com/storage/product_images/20240227091940_65dda92c57eeb.png',
                'https://daatrade.com/assets/img/logo.png',
            ], // You can add images here
        ],
    ],
];
