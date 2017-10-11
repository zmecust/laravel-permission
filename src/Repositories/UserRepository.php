<?php
/**
 * Created by PhpStorm.
 * User: zm
 * Date: 2017/4/24
 * Time: 14:57
 */
namespace Zmecust\LaravelPermission\Repositories;

use Zmecust\LaravelPermission\Models\Role;

class UserRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Role
     */
    protected $role;

    /**
     * UserRepository constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->user = config('zmecust.user_table.model');
        $this->role = $role;
    }

    public function getUserList($request)
    {
        if (!empty($name = $request->filter)) {
            return $this->user->where('name', 'like', "%$name%")->with([
                'roles' => function($query) {
                    $query->select('description');
                }])->paginate($request->paginate);
        }

        return $this->user->with([
            'roles' => function($query) {
                $query->select('description');
            }])->paginate($request->paginate);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $user = $this->user->find($id);
        $roles = $user->roles()->pluck('description');
        return $roles;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateUser($request, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->detachRoles($user->roles); //清除以前的角色

        if (is_array($request->roles)) {
            $roles = [];
            foreach ($request->roles as $description) {
                $roles[] = $this->role->where('description', $description)->first();
            }
            $user->attachRoles($roles);
        } //写入新角色

        return $this->user->where('id', $id)->with([
            'roles' => function($query) {
                $query->select('name');
            }])->first()->toArray();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteUser($id)
    {
        $user = $this->user->find($id);

        if ($user) {
            $user->roles()->sync([]);
            $user->destroy($id);
            return true;
        }

        return false;
    }
}