<?php

use Illuminate\Database\Seeder;

use App\Models\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Menu::truncate();
    	$data = json_decode(Storage::disk('local')->get('seeds/menus.json'), true);
    	$data = $this->handleData($data);
    	$this->create($data);
    }

	/**
	 * 处理数据
	 *
	 * @param  array  $data
	 * @param  int 	  $parentKey
	 */
	private function handleData($data, $parentKey = 0)
	{
		$result = [];
        foreach ($data as $index => $item) {
            if ($item['parent_id'] == $parentKey) {
                unset($data[$index]);
                if (!empty($data)) {
                    $item['children'] = $this->handleData($data, $item['id']);
                }
                $result[] = $item;
            }
        }
        return $result;
	}

    /**
	 * 添加数据
	 *
	 * @param  array  $data
	 * @param  int    $parentKey
	 * @return void
     */
    private function create($data, $parentKey = 0)
    {
    	foreach ($data as $item) {
    		$values = Arr::only($item, ['name', 'route', 'method', 'icon', 'sequence', 'is_show', 'is_verify']);
    		$values['parent_id'] = $parentKey;
    		// 使用forceCreate强制添加字段
    		$menu = Menu::forceCreate($values);
    		if (! empty($item['children'])) {
    			$this->create($item['children'], $menu->id);
    		}
    	}
    }
}
