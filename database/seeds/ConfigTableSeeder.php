<?php

use Illuminate\Database\Seeder;

use App\Models\Config;
use App\Enums\ConfigType;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::truncate();
        $data = [
            'type' => ConfigType::SITE,
            'value' => ['icon' => '', 'logo' => '', 'name' => '', 'title' => '', 'keywords' => '', 'description' => '', 'icp' => '']
        ];
        Config::create($data);
    }
}
