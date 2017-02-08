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
        //
        $page_lists = [["page_name"=>75],["page_name"=>74],["page_name"=>73],["page_name"=>72],["page_name"=>71]];

        DB::table('ms_crawler_task_sheet')->insert([
            'name' => "tzgg",
            'remote_addr' => "202.193.80.36",
            'remote_host' => "www.glut.edu.cn",
            'request_path' => "/index/tzgg/{page_name}.htm",
            'request_info' => json_encode($page_lists,JSON_UNESCAPED_UNICODE),
            'ping_status' => 0,
            'status' => 1,
            'modify_time' => time(),
            'create_time' => time(),
        ]);
    }
}
