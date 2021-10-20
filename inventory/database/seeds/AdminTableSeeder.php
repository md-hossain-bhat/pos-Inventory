<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $adminRecords =[
        	['id'=>1,'name'=>'admin','type'=>'admin','mobile'=>'04238480204','email'=>'admin@gmail.com','password'=>'$2y$10$NRsnPZ0Qo8Oulj0bV9TPxeMtflatKrnGrUtgswGy7c0cWg3FonMLy','image'=>'','status'=>1],
        	['id'=>2,'name'=>'hossain','type'=>'admin','mobile'=>'59709','email'=>'hossain@gmail.com','password'=>'$2y$10$NRsnPZ0Qo8Oulj0bV9TPxeMtflatKrnGrUtgswGy7c0cWg3FonMLy','image'=>'','status'=>1],
        	['id'=>3,'name'=>'tanni','type'=>'subadmin','mobile'=>'04238480204','email'=>'tanni@gmail.com','password'=>'$2y$10$NRsnPZ0Qo8Oulj0bV9TPxeMtflatKrnGrUtgswGy7c0cWg3FonMLy','image'=>'','status'=>1],
        ];

        DB::table('admins')->insert($adminRecords);

        // foreach ($adminRecords as $key => $record) {
        // 	\App\Admin::create($record);
        // }
    }
}
