# Permissions

## Composer require
```shell
composer require fl3xice/permissions
```

```php
<?php

require_once 'vendor/autoload.php';

use flexice\Group;
use flexice\PermissionsManager;
use flexice\Role;

// Example Create Roles

$GuestRole = new Role("Guest", [
    "show.web.content"
]);

$UserRole = new Role("User", [
    "set.personal.name",
    "set.personal.lang",
    "get.personal.lang",
    "get.other.name"
]);

$AdminRole = new Role("Admin", [
    "ban.set",
    "delete.profile"
]);

try {
    // Inheritance Permissions from other role
    $UserRole->inheritPermissions($GuestRole);
    $AdminRole->inheritPermissions($UserRole);
    
    // Create Group of roles
    $GroupRoles = new Group([
        $GuestRole, $UserRole, $AdminRole
    ]);
     
    // Manager Permissions
    $PM = new PermissionsManager($GroupRoles);
    
    if ($PM->hasPermission('admin', 'ban.set')) {
        print "You can ban";
    }
    
} catch (Exception $exception) {
    // Your code
}
```

## Group

You can add all roles in the Group constructor or using the addRole method.
```php
    $GroupRoles = new Group([
        $GuestRole, $UserRole, $AdminRole
    ]);
```
### or
```php
    $GroupRoles = new Group();
    $GroupRoles->addRole($GuestRole);
    $GroupRoles->addRole($UserRole);
    $GroupRoles->addRole($AdminRole);
```

## PermissionsManager

### hasPermission(_nameRole_, _permission_)
- Role name case is ignored as well as permissions
- return true or false

