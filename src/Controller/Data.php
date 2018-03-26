<?php

namespace App\Controller;

class Data {
 
    const LINKS_FOOTER_MY_ACCOUNT = array(
        
        'title' => 'MY ACCOUNT',
        
        'account' => [
            
            'link0' =>['name' => 'account',
                'url' => '/login'],
            
            
            'link1' =>['name' => 'my whishlist',
                'url' => '/whishlist'],
            
            'link2' =>['name' => 'compare',
                'url' => '/compare'],
            
            'link3' =>['name' => 'checkout',
                'url' => '/checkout'],
            
            'link4' =>['name' => 'login',
                'url' => '/login']
            
            
        ]);
    
    const LINKS_TOP_NAV = array (
        
        'link0' =>['name' => 'store',
            'url' => '/store'],
        
        
        'link1' =>['name' => 'newsletter',
            'url' => '/newsletter'],
        
        'link2' =>['name' => 'faq',
            'url' => '/faq']
        
    );
    
    const REVIEWS = array (
        
        'review0' =>['user' => 'John',
            'id_article' => '',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
            'date' => '27 DEC 2017 / 8:00 PM',
            'note' => 4
        ],
        
        'review1' =>['user' => 'Tom',
            'id_article' => '',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
            'date' => '24 DEC 2017 / 8:00 PM',
            'note' => 4
        ],
        
        'review2' =>['user' => 'Bill',
            'id_article' => '',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
            'date' => '12 DEC 2017 / 10:00 PM',
            'note' => 4
        ],
        
    );
    
    const SOCIALS_NETWORKS = array (
        
        'link0' =>['icon' => 'fa fa-facebook',
            'url' => 'https://www.facebook.com/'],
        
        'link1' =>['icon' => 'fa fa-twitter',
            'url' => 'https://twitter.com/'],
        
        'link2' =>['icon' => 'fa fa-instagram',
            'url' => 'https://www.instagram.com/'],
        
        'link3' =>['icon' => 'fa fa-google-plus',
            'url' => 'https://plus.google.com'],
        
        'link4' =>['icon' => 'fa fa-pinterest',
            'url' => 'https://www.pinterest.fr/'],
        
    );
    
    const LANGUAGES = array (
        
        'default' => 'eng',
        
        'country' => [
            
            'index0' =>['name' => 'english',
                'code' => 'eng'],
            
            'index1' =>['name' => 'russian',
                'code' => 'ru'],
            
            'index2' =>['name' => 'french',
                'code' => 'fr'],
            
            'index3' =>['name' => 'spanish',
                'code' => 'es']
        ]
    );
    
    const CHANGES = array (
        
        'default' => 'usd',
        
        'country' => [
            
            'index0' =>['name' => 'usd',
                'code' => '$'],
            
            'index1' =>['name' => 'eur',
                'code' => '€']
        ]
    );
    
    const LINKS_FOOTER_CUSTOMER_SERVICE = array(
        
        
        'title' => 'CUSTOMER SERVICE',
        
        'service' => [
            
            'link0' =>['name' => 'about us',
                'url' => '/about-us'],
            
            'link1' =>['name' => 'shiping & return',
                'url' => '/shiping-return'],
            
            'link2' =>['name' => 'shiping guide',
                'url' => '/shiping-guide'],
            
            'link3' =>['name' => 'faq',
                'url' => '/faq']
            
        ]);
    
    const CATEGORIES = array(
        
        'title' => 'categories',
        
        'list' => [
        
            'categorie0' => ['name' => 'women\'s clothing',
                'url' => '/products/clothing/women'],
            
            'categorie1' => ['name' => 'men\'s clothing',
                'url' => '/products/clothing/men'],
            
            'categorie2' => ['name' => 'phones & accessories',
                'url' => '/products/Phones-Accessories'],
            
            'categorie3' => ['name' => 'computer & office',
                'url' => '/products/Computer-Office'],
            
            'categorie4' => ['name' => 'consumer electronics',
                'url' => '/Consumer-Electronics'],
            
            'categorie5' => ['name' => 'jewelry & watches',
                'url' => '/products/Jewelry-Watches'],
            
            'categorie6' => ['name' => 'bags & shoes',
                'url' => '/products/bags-shoes'],
            
            'categorie7' => ['name' => 'view all',
                'url' => '/products/all']
        
    ]);

    const NAV_CATEGORIES = array(
             
        'menu' => [
            'title1' => 'women',
            'title2' => 'men']
        ,
        
        'title' => 'categories',
        
        'list' => [
            
            'categorie0' => ['name' => 'clothing',
                'url' => '/products/all'],
                      
            'categorie1' => ['name' => 'phones & accessories',
                'url' => '/products/all'],
            
            'categorie2' => ['name' => 'jewelry & watches',
                'url' => '/products/all'],
            
            'categorie3' => ['name' => 'bags & shoes',
                'url' => '/products/all']
            
        ]);
    
    const LASTPRODUCTS = '[{
            "id" : "1",
            "name" : "Sac de Femme",
            "price" : "32.50",
            "url" : "./img/product01.jpg"
        },
        
        {
            "id" : "2",
            "name" :"Montre Homme",
            "price" : "55.50",
            "new" : "New",
            "reduct" : "-20%",
            "url" : "./img/product02.jpg"
        },
        
        {
            "id" : "3",
            "name" : "Portefeuille",
            "price" : "25.50",
            "new" : "New",
            "reduct" : "-20%",
            "url" :"./img/product03.jpg"
        },
        
        {
            "id" : "4",
            "name" : "Chaussure Bleu",
            "price" : "85.50",
            "new" : "New",
            "url" : "./img/product04.jpg"
        },
        
        {
            "id" : "5",
            "name" : "Sac Cuir Marron",
            "price" : "125.50",
            "new" : "New",
            "reduct" : "-20%",
            "url" : "./img/product07.jpg"
        },
        
        {
            "id" : "6",
            "name" : "Sac Cuir Femme",
            "price" : "165.50",
            "new" : "New",
            "reduct" : "-20%",
            "url" : "./img/product06.jpg"
        },
        
        {
            "id" : "7",
            "name" : "Botte Femme",
            "price" : "115.50",
            "new" : "New",
            "reduct" : "-20%",
            "url" : "./img/product05.jpg"
        }
        
        ]';
    
    const PICKEDPRODUCTS = '[
        
		{
            "id" : "1",
            "name" : "Chaussure Bleu",
            "price" : "85.50",
            "url" : "./img/product04.jpg"
        },
        
		{
            "id" : "2",
            "name" : "Portefeuille",
            "price" : "25.50",
            "new" : "New",
            "url" :"./img/product03.jpg"
        },
        
		{
            "id" : "3",
            "name" :"Montre Homme",
            "price" : "55.50",
            "reduct" : "-20%",
            "url" : "./img/product02.jpg"
        },
        
		{
            "id" : "4",
            "name" : "Sac de Femme",
            "price" : "32.50",
            "reduct" : "-20%",
            "new" : "New",
            "url" : "./img/product01.jpg"
        }
        
        ]';
   
    const DEALPRODUCTS = '[{
            "id" : "1",
            "name" : "Sac de Femme",
            "price" : "32.50",
            "url" : "./img/product01.jpg"
        },
        
        {
            "id" : "2",
            "name" :"Montre Homme",
            "price" : "55.50",
            "url" : "./img/product02.jpg"
        },
        
        {
            "id" : "3",
            "name" : "Portefeuille",
            "price" : "25.50",
            "url" :"./img/product03.jpg"
        },
        
        {
            "id" : "4",
            "name" : "Chaussure Bleu",
            "price" : "85.50",
            "url" : "./img/product04.jpg"
        }]';
    
   
}