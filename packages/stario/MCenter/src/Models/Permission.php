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
use Illuminate\Support\Collection;
use Star\MCenter\Contracts\Permissions\Permission as PermissionContract;
use Star\MCenter\Exceptions\Permissions\PermissionAlreadyExists;
use Star\MCenter\Exceptions\Permissions\PermissionDoesNotExist;
use Star\MCenter\PermissionRegistrar;
use Star\MCenter\Traits\HasRoles;
use Star\MCenter\Traits\RefreshesPermissionCache;

class Permission extends Model implements PermissionContract
{
    use HasRoles;
    use RefreshesPermissionCache;

    protected $guarded = ['id'];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->setTable('permissions');
    }

    public static function create($attributes = array())
    {
        if (static::getPermissions()->where('name', $attributes['name'])->first()) {
            throw PermissionAlreadyExists::create($attributes['name']);
        }
        return static::query()->create($attributes);
    }

    protected static function getPermissions(): Collection
    {
        return app(PermissionRegistrar::class)->getPermissions();
    }

    /**
     * 权限可以被分配到角色中
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            'role', 'role_has_permissions'
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            'user', 'user_has_permissions'
        );
    }

    /**
     * 通过权限名称查找权限
     * @param string $name
     * @return PermissionContract
     */
    public static function findByName(string $name): PermissionContract
    {
        $permission = static::getPermissions()->where('name', $name)->first();
        if (!$permission) {
            throw PermissionDoesNotExist::create($name);
        }
        return $permission;
    }

    public static function findOrCreate(string $name): PermissionContract
    {
        $permission = static::getPermissions()->where('name', $name)->first();
        if (!$permission) {
            return static::create(['name' => $name]);
        }
        return $permission;
    }
}