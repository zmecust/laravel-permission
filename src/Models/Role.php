<?php

namespace Zmecust\LaravelPermission\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'id', 'description'];

    /**
     * @param null $id
     * @return array
     */
    public function rules($id = null)
    {
        return [
            'name' => 'required|unique:roles,name,'.$id,
            'description' => 'required|unique:roles,description,'.$id,
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '角色名不能为空',
            'name.unique' => '该角色名已存在',
            'description.required' => '角色描述不能为空',
            'description.unique' => '该角色描述已存在',
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function perms()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /**
     * Attach permission to current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function attachPermission($permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->perms()->attach($permission);
    }

    /**
     * Detach permission from current role.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function detachPermission($permission)
    {
        if (is_object($permission))
            $permission = $permission->getKey();

        if (is_array($permission))
            $permission = $permission['id'];

        $this->perms()->detach($permission);
    }

    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function attachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    /**
     * Detach multiple permissions from current role
     *
     * @param mixed $permissions
     *
     * @return void
     */
    public function detachPermissions($permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }
}