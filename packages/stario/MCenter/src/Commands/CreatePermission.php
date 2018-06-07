<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Commands;


use Illuminate\Console\Command;
use Star\MCenter\Contracts\Permissions\Permission as PermissionContract;

class CreatePermission extends Command
{
    protected $signature = 'mc:create-permission
                              {name: The name of the permission}
                              {label: The label of the permission}';
    protected $description = 'Create a permission';

    public function handle()
    {
        $permissionClass = app(PermissionContract::class);

        $permission = $permissionClass::create([
            'name' => $this->argument('name'),
            'label' => $this->argument('label'),
        ]);

        $this->info("Permission `{$permission->name}` created.");
    }
}