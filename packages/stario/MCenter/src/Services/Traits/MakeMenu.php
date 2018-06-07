<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Services\Traits;

use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Icenter静态方法
 * 根据module.json文件，写入菜单并指定权限
 */
trait MakeMenu
{
    /**
     * 根据约定格式，将.json文件转换为带权限的菜单
     * @param  $fileName - 读取到的json文件
     */
    public static function makeMenuFromJson($fileName)
    {
        $json = json_decode($fileName, true);
        static::handle($json);
    }

    /**
     * 处理逻辑
     * menu.json可能嵌套或不嵌套，判断后处理
     * @param  $array
     */
    private static function handle($array)
    {
        if (is_array(array_first($array))) {
            static::handleNested($array);
        }
        static::createMenu($array);
    }

    /**
     * 创建菜单，并在终端命令行中打印结果
     * 判断菜单中是否含有子菜单并进行相应处理
     * @param  $array
     * @param  $parentId - 父级菜单id
     */
    private static function createMenu($array, $parentId = null)
    {
        $permissions = static::checkPermissions($array['permissions']);
        $node = new Menu;
        $node->name = $array['name'];
        $node->icon = $array['icon'];
        $node->path = $array['path'];
        $node->order = array_key_exists('order', $array) ? $array['order'] : 8;
        if ($parentId != null) {
            $node->parent_id = $parentId;
        }
        $output = new ConsoleOutput();
        if ($node->save()) {
            $node->permissions()->sync($permissions);
            $output->writeln("<question>Module [" . $array['name'] . "] has been activated.</question>");
        } else {
            $output->writeln("<question>Module [" . $array['name'] . "] could not be activated.</question>");
        }

        if (array_key_exists('children', $array)) {
            static::handleNested($array['children'], $node->id);
        }

    }

    private static function handleNested($array, $parentId = null)
    {
        foreach ($array as $item) {
            array_key_exists('icon', $item) ?: $item['icon'] = '';
            if ($parentId == null) {
                static::createMenu($item);
            } else {
                static::createMenu($item, $parentId);
            }
        }
    }

    private static function checkPermissions($permissions)
    {
        if (is_array($permissions)) {
            $ids = [];
            foreach ($permissions as $item) {
                $ids[] = static::createPermission($item);
            }
            return $ids;
        }
        return static::createPermission($permissions);
    }

    private static function createPermission($permissions)
    {
        app()['cache']->forget('wemesh.permission.cache');
        if (Permission::where('name', $permissions['name'])->exists()) {
            return Permission::where('name', $permissions['name'])->first()->id;
        }
        return Permission::create($permissions)->id;
    }

}
