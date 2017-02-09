<?php

use Illuminate\Database\Seeder;

class CaptureTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //学校简介
        DB::table('ms_crawler_task_sheet')->insert([
            'name' => "xxjj",
            'remote_addr' => "202.193.80.36",
            'remote_host' => "www.glut.edu.cn",
            'request_path' => "/xqzl1/xxjj.htm",
            'request_info' => "",
            'ping_status' => 0,
            'status' => 1,
            'modify_time' => time(),
            'create_time' => time(),
        ]);

        //通知公告
        $page_lists = array();
        for($i=1;$i<=74;$i++){
            $page_lists[] = ["page_name"=>"/".$i];
        }
        $page_lists[] = ["page_name"=>""];
        DB::table('ms_crawler_task_sheet')->insert([
            'name' => "tzgg",
            'remote_addr' => "202.193.80.36",
            'remote_host' => "www.glut.edu.cn",
            'request_path' => "/index/tzgg{page_name}.htm",
            'request_info' => json_encode($page_lists,JSON_UNESCAPED_UNICODE),
            'ping_status' => 0,
            'status' => 1,
            'modify_time' => time(),
            'create_time' => time(),
        ]);

        //科技动态
        $page_lists = array();
        for($i=1;$i<=88;$i++){
            $page_lists[] = ["page_name"=>"/".$i];
        }
        $page_lists[] = ["page_name"=>""];
        DB::table('ms_crawler_task_sheet')->insert([
            'name' => "kjdt",
            'remote_addr' => "202.193.80.36",
            'remote_host' => "www.glut.edu.cn",
            'request_path' => "/index/kjdt{page_name}.htm",
            'request_info' => json_encode($page_lists,JSON_UNESCAPED_UNICODE),
            'ping_status' => 0,
            'status' => 1,
            'modify_time' => time(),
            'create_time' => time(),
        ]);

        //媒体桂工
        $page_lists = array();
        for($i=1;$i<=3;$i++){
            $page_lists[] = ["page_name"=>"/".$i];
        }
        $page_lists[] = ["page_name"=>""];
        DB::table('ms_crawler_task_sheet')->insert([
            'name' => "mtgg",
            'remote_addr' => "202.193.80.36",
            'remote_host' => "www.glut.edu.cn",
            'request_path' => "/index/mtgg{page_name}.htm",
            'request_info' => json_encode($page_lists,JSON_UNESCAPED_UNICODE),
            'ping_status' => 0,
            'status' => 1,
            'modify_time' => time(),
            'create_time' => time(),
        ]);

        //桂工要闻
        $page_lists = array();
        for($i=1;$i<=282;$i++){
            $page_lists[] = ["page_name"=>"/".$i];
        }
        $page_lists[] = ["page_name"=>""];
        DB::table('ms_crawler_task_sheet')->insert([
            'name' => "ggyw",
            'remote_addr' => "202.193.80.36",
            'remote_host' => "www.glut.edu.cn",
            'request_path' => "/index/ggyw{page_name}.htm",
            'request_info' => json_encode($page_lists,JSON_UNESCAPED_UNICODE),
            'ping_status' => 0,
            'status' => 1,
            'modify_time' => time(),
            'create_time' => time(),
        ]);

        //http://zj.glut.edu.cn/list.aspx?s=1&ClassID=32&Curpage=1

    }
}
