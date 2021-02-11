# Permissions

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