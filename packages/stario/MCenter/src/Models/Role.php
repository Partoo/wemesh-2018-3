<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Star\MCenter\Contracts\Permissions\Permission;
use Star\MCenter\Contracts\Permissions\Role as RoleContract;
use Star\MCenter\Exceptions\Permissions\RoleDoesNotExist;
use Star\MCenter\Exceptions\RoleAlreadyExists;
use Star\MCenter\Traits\HasPermissions;
use Star\MCenter\Traits\RefreshesPermissionCache;

class Role extends Model implements RoleContract
{
    use HasPermissions;
    use RefreshesPermissionCache;

    public $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable('roles');
    }

    public static function create($attributes = array())
    {
        if (static::where('name', $attributes['name'])->first()) {
            throw RoleAlreadyExists::create($attributes['name']);
        }

        return static::query()->create($attributes);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            'permission', 'role_has_permissions'
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            'user', 'user_has_roles'
        );

    }

    public static function findByName(string $name): RoleContract
    {
        $role = static::where('name', $name)->first();
        if (!$role) {
            throw RoleDoesNotExist::named($name);
        }
        return $role;
    }


    public static function findById(int $id): RoleContract
    {
        $role = static::where('id', $id)->first();
        if (!$role) {
            throw RoleDoesNotExist::withId($id);
        }
        return $role;
    }

    public function hasPermissionTo($permission): bool
    {
        if (is_string($permission)) {
            $permission = app(Permission::class)->findByName($permission);
        }

        return $this->permissions->contains('id', $permission->id);
    }
}