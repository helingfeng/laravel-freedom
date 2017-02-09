<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;

/**
 * HTML 解析
 *
 */
class HtmlParser
{

    public function __construct()
    {

    }

    public function findArticles()
    {
        //$html,$class
        $tasks = DB::table('ms_crawler_raw_data')->where('name', '=', 'tzgg')->first();
        $crawler = new Crawler($tasks->response_data);
        $nodeValues = $crawler->filter('.list_content ul li a')->each(function (Crawler $node, $i) {
            $a['href'] = str_replace("../../","http://www.glut.edu.cn/",$node->attr("href"));
            $a['title'] = $node->attr("title");
            return $a;
        });

        foreach($nodeValues as $node){
            $article['request_url'] = $node['href'];
            $article['response_html'] = WebCapture::jsonGet($node['href']);
            $article['name'] = $tasks->name;
            $article['create_time'] = time();
            $article['version'] = strtoupper($node['href']).$article['create_time'];
            DB::table('ms_crawler_article')->insert($article);
        }
    }

}