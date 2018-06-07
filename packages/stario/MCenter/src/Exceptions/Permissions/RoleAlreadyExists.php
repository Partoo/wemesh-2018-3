<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace Star\MCenter\Exceptions;


class RoleAlreadyExists extends \InvalidArgumentException
{
    public static function create(string $roleName)
    {
        return new static("Role `{$roleName}` already exists.");
    }
}