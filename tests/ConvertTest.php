<?php

use flexice\Convert;
use PHPUnit\Framework\TestCase;

class ConvertTest extends TestCase
{
    public function testFromArrayToPermissionsManager()
    {
        $roles = [
            "user" => [
                "permissions" => [
                    "test"
                ]
            ],
            "admin" => [
                "inherit" => [
                    "user"
                ],
                "permissions" => [
                    "test2"
                ]
            ]
        ];

        $PM = Convert::fromArrayToPermissionsManager($roles);
        try {
            $this->assertEquals(true, $PM->hasPermission('user', 'test'));
            $this->assertEquals(true, $PM->hasPermission('admin', 'test'));
            $this->assertEquals(true, $PM->hasPermission('admin', 'test2'));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
}
