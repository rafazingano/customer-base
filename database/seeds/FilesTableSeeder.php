<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = DB::table('customers')->select('id')->get();
        $numbers = [1,2,3,4,5,6,7,8];
        foreach($customers as $cu){
        	foreach ($numbers as $value) {
        		$files[] = ['name' => $cu->id . '/' . $value . '.jpg', 'customer_id' => $cu->id];
        	}
        }  
        if(isset($files) && count($files) > 0){      
            foreach ($files as $file) {
                DB::table('files')->insert($file);
            }
        }
    }
}
