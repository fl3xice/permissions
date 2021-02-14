<?php

use flexice\Convert;
use PHPUnit\Framework\TestCase;

class ConvertTest extends TestCase
{
    public function testFromArrayToPermissionsManager()
    {
        $roles = [
            "guest" => [
                "permissions" => [
                    "required.disable.adblock",
                    "web.show.content"
                ]
            ],
            "user" => [
                "permissions" => [
                    "test.permission.1",
                    "test.permission.2",
                    "test.permission.3"
                ],
                "inherit" => [
                    "guest"
                ],
                "permissions-lock" => [
                    "required.disable.adblock"
                ]
            ],
            "admin" => [
                "permissions" => [
                    "admin.panel",
                    "test.permission.4"
                ],
                "inherit" => [
                    "guest",
                    "user"
                ]
            ]
        ];

        $PM = Convert::fromArrayToPermissionsManager($roles);

        try {
            $this->assertEquals(false, $PM->hasPermission('user', 'required.disable.adblock'));
            $this->assertEquals(true, $PM->hasPermission('admin', 'test.permission.1'));
            $this->assertEquals(true, $PM->hasPermission('admin', 'test.permission.4'));
            $this->assertEquals(true, $PM->hasPermission('admin', 'required.disable.adblock'));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
}
