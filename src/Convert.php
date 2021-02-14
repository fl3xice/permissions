<?php


namespace flexice;


use Exception;

class Convert
{
    /**
     * @param array $array
     * @return PermissionsManager
     */
    public static function fromArrayToPermissionsManager(array $array) : PermissionsManager
    {
        $Group = new Group();

        foreach ($array as $role => $params) {
            $role = new Role($role, $params["permissions"]);

            if (!empty($params["inherit"])) {
                foreach ($params["inherit"] as $param) {
                    try {
                        $roleFound = $Group->getRoleByName($param);
                        $role->inheritPermissions($roleFound);
                    } catch (Exception $e) {
                        break;
                    }
                }
            }

            if (!empty($params["permissions-lock"])) {
                foreach ($params["permissions-lock"] as $param) {
                    $role->permissionLock($param);
                }
            }

            $Group->addRole($role);
        }

        return new PermissionsManager($Group);
    }
}