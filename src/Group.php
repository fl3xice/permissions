<?php


namespace flexice;


use Exception;

class Group
{
    protected $roles;

    /**
     * Group constructor.
     * @param array $roles
     * @throws Exception
     */
    public function __construct(array $roles = [])
    {
        foreach ($roles as $role) {
            if (get_class($role) != Role::class) {
                throw new Exception("The array must not contain other elements than elements of type Role");
            } else {
                $this->addRole($role);
            }
        }
    }

    /**
     * @param Role $role
     * @return int
     */
    public final function addRole(Role $role) : int
    {
        $this->roles[] = $role;
        return count($this->roles) - 1;
    }

    /**
     * @param string $name
     * @return Role
     * @throws Exception
     */
    public final function getRoleByName(string $name) : Role
    {
        if (!is_array($this->roles)) throw new Exception("Roles don't created");
        foreach ($this->roles as $role) {
            if ($role->name == mb_strtolower($name)) {
                return $role;
            }
        }

        throw new Exception("Role not found");
    }

    /**
     * @param $index
     * @return bool
     */
    public final function removeRoleAtIndex($index) : bool
    {

        $_nameRole = $this->roles[$index]->name;

        unset($this->roles[$index]);

        if (empty($this->roles[$index])) return false;
        if ($this->roles[$index]->name != $_nameRole) return true;

        return false;
    }
}