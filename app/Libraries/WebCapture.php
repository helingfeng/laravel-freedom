<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;

/**
 * 数据抓取工具类
 *
 */
class WebCapture
{
    private $http_protocol = "http://";

    private $client = null;


    public function __construct()
    {
        $this->client = new Client();
    }

    public function run($terminal)
    {
        $tasks = DB::table('ms_crawler_task_sheet')->where('status', '>', 0)->get();
        $terminal->info("processing...");
        foreach ($tasks as $task) {
            $this->capture($task,$terminal);
        }
        $terminal->info("task done.");
    }

    public function capture($task,$terminal)
    {
        $network_status = $this->checkNetwork($task->remote_host);
        if ($network_status) {
            DB::table('ms_crawler_task_sheet')->where('name', $task->name)->update(['ping_status' => 1]);
            $data_lists = [];
            $request_urls = $this->combinePath($task->remote_host, $task->request_path, $task->request_info);
            foreach ($request_urls as $url) {
                $data['name'] = $task->name;
                $data['request_url'] = $url;
                $data['response_data'] = $this->jsonGet($url);
                $data['create_time'] = time();
                $data['version'] = $task->name.$data['create_time'];
                $data_lists[] = $data;
                $terminal->info("capturing URL_PATH=>".$url);
            }
            DB::table('ms_crawler_raw_data')->insert($data_lists);
        }else{
            $task->ping_status = 0;
            DB::table('ms_crawler_task_sheet')->where('name', $task->name)->update(['ping_status' => 0]);
        }

    }

    public function checkNetwork($host)
    {
        try{
            $request = new Request('GET', $this->http_protocol.$host);
            $response = $this->client->send($request, ['timeout' => 10]);
            $reason = $response->getReasonPhrase(); // OK
            return $reason == "OK";
        }catch (ConnectException $e){
            return false;
        }catch (ServerException $e){
            return false;
        }
    }

    public function combinePath($host, $request_path, $request_info)
    {
        $request_params = json_decode($request_info, true);
        $urls = array();
        $request_url = $this->http_protocol . $host . $request_path;
        if (!empty($request_params)) {
            foreach ($request_params as $params) {
                $request_temp_url = $request_url;
                foreach ($params as $key => $param) {
                    $request_temp_url = str_replace("{" . $key . "}", $param, $request_temp_url);
                }
                $urls[] = $request_temp_url;
            }
        } else {
            $urls[] = $request_url;
        }
        return $urls;
    }

    public function jsonGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}