<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Exceptions\Permissions;


class RoleDoesNotExist extends \InvalidArgumentException
{
    public static function named(string $roleName)
    {
        return new static("There is no role named `{$roleName}`.");
    }

    public static function withId(int $roleId)
    {
        return new static("There is no role with id `{$roleId}`.");
    }
}