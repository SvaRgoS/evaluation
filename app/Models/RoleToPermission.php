<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\RoleToPermission
 *
 * @property int $id
 * @property int $role_id
 * @property int $permission_id
 * @method static \Illuminate\Database\Eloquent\Builder|RoleToPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleToPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleToPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleToPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleToPermission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleToPermission whereRoleId($value)
 * @mixin \Eloquent
 */
class RoleToPermission extends Pivot
{
    //
}
