<?php


namespace flexice;


use Exception;

class PermissionsManager
{

    private $group;

    /**
     * PermissionsManager constructor.
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * @return Group
     */
    public function getGroup(): Group
    {
        return $this->group;
    }

    /**
     * @param string $nameRole
     * @param string $permission
     * @return bool
     * @throws Exception
     */
    public function hasPermission(string $nameRole, string $permission) : bool
    {
        try {
            return $this->group->getRoleByName($nameRole)->hasPermission($permission);
        } catch (Exception $e) {
            throw $e;
        }
    }
}