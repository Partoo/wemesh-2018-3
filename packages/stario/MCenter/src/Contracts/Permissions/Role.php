<?php
/**
 * 功能：
 * 角色接口
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Contracts\Permissions;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Role
{
    public function permissions(): BelongsToMany;

    public static function findByName(string $name): Role;

    public static function findById(int $id): self;

    public function hasPermissionTo($permission): bool;

}