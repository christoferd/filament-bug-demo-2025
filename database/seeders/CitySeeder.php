<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = 'Hobart,Perth,Darwin,Melbourne,Sydney,Brisbane,Chongqing,Shanghai,Beijing,'.
                 'Chengdu,Guangzhou,Shenzhen,Wuhan,Tianjin,Xian,Suzhou,Zhengzhou,Hangzhou,'.
                 'Shijiazhuang,Linyi,Dongguan,Qingdao,Changsha,Hefei';

        $items = explode(',', $items);
        foreach($items as $city)
        {
            (new City(['name' => $city]))->save();
        }
    }
}
