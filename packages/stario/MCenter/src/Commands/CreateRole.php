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
use Star\MCenter\Contracts\Permissions\Role as RoleContract;

class CreateRole extends Command
{
    protected $signature = 'mc:create-role
                            {name: The name of the role}
                            {label: The label of the role}';
    protected $description = 'Create a role';

    public function handle()
    {
        $roleClass = app(RoleContract::class);

        $role = $roleClass::create([
            'name' => $this->argument('name'),
            'label' => $this->argument('label'),
        ]);

        $this->info("Role `{$role->name}` created");
    }
}