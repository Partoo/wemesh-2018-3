<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Services;


use Star\MCenter\Services\Traits\MakeMenu;

class MCenter
{
    use MakeMenu;

    public static function makeMenus()
    {

        foreach (glob('../Modules/*.json') as $fileName) {
            static::makeMenuFromJson(file_get_contents('../Modules/' . $fileName));
        }

    }
}