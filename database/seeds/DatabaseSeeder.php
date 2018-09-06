<?php

use Illuminate\Database\Seeder;
use App\Users;
use App\nhan_vien;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=1; $i<=100; $i++) {
            $nv = new nhan_vien();
            $nv->ma_so = $i;
            $nv->ho_ten = $faker->name;
            $nv->gioi_tinh = 1;
            $nv->so_cmnd = str_random(10);
            $nv->thuong_tru = $faker->address;
            $nv->tam_tru = $faker->address;
            $nv->di_dong_1 = $faker->phoneNumber ;
            $nv->di_dong_2 = $faker->phoneNumber;
            $nv->save();
        }
    }
}
