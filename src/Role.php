<?php


namespace flexice;


use Exception;

class Role
{
    public $name;
    protected $inherited;
    protected $permissions;

    /**
     * Role constructor.
     * @param string $name
     * @param array $permissions
     */
    public function __construct(string $name, array $permissions = [])
    {
        $this->name = mb_strtolower($name);
        $this->permissions = array_map('strtolower', $permissions);
        $this->inherited = [];
    }

    /**
     * @param Role $role
     * @return bool
     * @throws Exception
     */
    public function inheritPermissions(Role $role) : bool
    {
        foreach ($this->inherited as $item) {
            if ($item->name == $role->name) {
                throw new Exception("Role \"" . $role->name . "\" has already been inherited by \"" . $this->name . "\" role");
            }
        }

        $this->permissions = array_merge($this->permissions, $role->permissions);
        $this->inherited[] = $role;
        return true;
    }

    /**
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission) : bool
    {
        foreach ($this->permissions as $perm) {
            if ($perm == strtolower($permission)) {
                return true;
            }
        }
        return false;
    }
}