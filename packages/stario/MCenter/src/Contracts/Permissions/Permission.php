<?php
/**
 * 功能：
 * 权限接口
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Contracts\Permissions;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Permission
{
    /**
     * 权限可以被分配到角色中
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany;

    /**
     * 通过权限名称查找权限
     * @param string $name
     * @return Permission
     */
    public static function findByName(string $name): self;
}
