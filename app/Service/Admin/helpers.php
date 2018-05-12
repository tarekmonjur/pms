<?php
/**
 * Created by PhpStorm.
 * User: Tarek Monjur
 * Date: 12/13/2017
 * Time: 4:44 PM
 */


function getPermissionList()
{
    $permissions = [
        [
            "name" => "Order Manage",
            "permission" => [
                "orders/view" => "view",
                "orders/status" => "handle",
                "orders/edit" => "edit",
                "orders/delete" => "delete",
            ]
        ],
        [
            "name" => "User Manage",
            "permission" => [
                "users/view" => "view",
                "users/create" => "create",
                "users/edit" => "edit",
                "users/delete" => "delete",
            ]
        ],
        [
            "name" => "Offer Manage",
            "permission" => [
                "offers/view" => "view",
                "offers/add" => "add",
                "offers/edit" => "edit",
                "offers/delete" => "delete",
            ]
        ],
        [
            "name" => "Slider Manage",
            "permission" => [
                "sliders/view" => "view",
                "sliders/add" => "add",
                "sliders/edit" => "edit",
                "sliders/delete" => "delete",
            ]
        ],
        [
            "name" => "Medicine Manage",
            "permission" => [
                "medicines/view" => "view",
                "medicines/add" => "add",
                "medicines/edit" => "edit",
                "medicines/delete" => "delete",
            ]
        ],
        [
            "name" => "Medicine Category Manage",
            "permission" => [
                "categories/view" => "view",
                "categories/create" => "create",
                "categories/edit" => "edit",
                "categories/delete" => "delete",
            ]
        ],
        [
            "name" => "Medicine Type Manage",
            "permission" => [
                "types/view" => "view",
                "types/create" => "create",
                "types/edit" => "edit",
                "types/delete" => "delete",
            ]
        ],
        [
            "name" => "Medicine Generics Manage",
            "permission" => [
                "generics/view" => "view",
                "generics/add" => "add",
                "generics/edit" => "edit",
                "generics/delete" => "delete",
            ]
        ],
        [
            "name" => "Medicine Companies Manage",
            "permission" => [
                "companies/view" => "view",
                "companies/add" => "add",
                "companies/edit" => "edit",
                "companies/delete" => "delete",
            ]
        ],
        [
            "name" => "Admin Manage",
            "permission" => [
                "admins/view" => "view",
                "admins/create" => "create",
                "admins/edit" => "edit",
                "admins/delete" => "delete",
            ]
        ],
        [
            "name" => "Role Manage",
            "permission" => [
                "roles/view" => "view",
                "roles/create" => "create",
                "roles/edit" => "edit",
                "roles/delete" => "delete",
            ]
        ]
    ];

    return $permissions;
}


function getOnlyPermission()
{
    $permissions = getPermissionList();

    $onlyPermissions = [];
    foreach ($permissions as $permission){
        $onlyPermissions = array_merge($onlyPermissions, array_keys($permission['permission']));
    }
    return $onlyPermissions;
}


function canAccess($url)
{
    $permission = session('permissions');
    if(is_array($permission)) {
        if (in_array($url, $permission)) {
            return true;
        } else {
            return false;
        }
    }else{
        return false;
    }

}