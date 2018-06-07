<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Traits;

use Star\MCenter\Contracts\Permissions\Permission;
use Star\MCenter\PermissionRegistrar;

trait HasPermissions
{
    public function givePermissionsTo(...$permissions)
    {
        $permissions = collect($permissions)
            ->flatten()
            ->map(function ($permission) {
                return $this->getStoredPermission($permission);
            })
            ->all();

        $this->permissions()->saveMany($permissions);
        $this->forgetCachedPermissions();
        return $this;
    }

    public function syncPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function revokePermissionTo($permission)
    {
        $this->permissions()->detach($this->getStoredPermission($permission));
        $this->forgetCachedPermissions();

        return $this;
    }

    public function getStoredPermission($permissions)
    {
        if (is_string($permissions)) {
            return app(Permission::class)->findByName($permissions);
        }

        if (is_array($permissions)) {
            return app(Permission::class)
                ->whereIn('name', $permissions)
                ->get();
        }

        return $permissions;
    }

    public function forgetCachedPermissions()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
