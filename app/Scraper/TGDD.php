<?php


namespace App\Scraper;

use App\Models\Product;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class TGDD
{
    public function scrape()
    {
        $url = 'https://www.thegioididong.com/dtdd';

        $client = new Client();

        $crawler = $client->request('GET', $url);
        /*$crawler->filter('ul.homeproduct li.item')->each(
            function (Crawler $node) {

                $name = $node->filter('h3')->text();

                $price = $node->filter('.price strong')->text();

                $wholeStar = $node->filter('.icon-star-half')->count();
                $halfStar = $node->filter('.icon-star')->count();
                $rate = $wholeStar + 0.5 * $halfStar;
                \Log::info($name);
                \Log::info($price);
                \Log::info($rate);
                $price = preg_replace('/\D/', '', $price);
                $product = new Product();
                $product->name = $name;
                $product->price = $price;
                $product->rate = $rate;
                $product->save();

            }
        );*/
        $crawler->filter('.listproduct .item')->each(function ($node) {
            $name = $node->filter('h3')->text();
            $price = $node->filter('.price')->text();
            $wholeStar = $node->filter('.icon-star-half')->count();
            $halfStar = $node->filter('.icon-star')->count();
            $rate = $wholeStar + 0.5 * $halfStar;
            \Log::info($name);
            \Log::info($price);
            \Log::info($rate);
            $price = preg_replace('/\D/', '', $price);
            $product = new Product();
            $product->name = $name;
            $product->price = $price;
            $product->rate = $rate;
            $product->save();
            dump($price);
        });
    }
}
