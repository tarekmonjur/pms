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
            "name" => "project manage",
            "permission" => [
                "projects" => "view",
                "projects/create" => "create",
                "projects/edit" => "edit",
                "projects/delete" => "delete",
            ]
        ],
        [
            "name" => "story manage",
            "permission" => [
                "projects/stories" => "view",
                "stories/create" => "create",
                "stories/edit" => "edit",
                "stories/delete" => "delete",
            ]
        ],
        [
            "name" => "task manage",
            "permission" => [
                "stories/tasks" => "view",
                "tasks/create" => "create",
                "tasks/edit" => "edit",
                "tasks/delete" => "delete",
            ]
        ],
        [
            "name" => "user manage",
            "permission" => [
                "users" => "view",
                "users/create" => "create",
                "users/edit" => "edit",
                "users/delete" => "delete",
            ]
        ],
        [
            "name" => "role manage",
            "permission" => [
                "roles" => "view",
                "roles/create" => "create",
                "roles/edit" => "edit",
                "roles/delete" => "delete",
            ]
        ],
        [
            "name" => "team manage",
            "permission" => [
                "teams" => "view",
                "teams/create" => "create",
                "teams/edit" => "edit",
                "teams/delete" => "delete",
            ]
        ],
        [
            "name" => "company manage",
            "permission" => [
                "company" => "view",
                "company/create" => "create",
                "company/edit" => "edit",
                "company/delete" => "delete",
            ]
        ],
        [
            "name" => "department manage",
            "permission" => [
                "department" => "view",
                "department/create" => "create",
                "department/edit" => "edit",
                "department/delete" => "delete",
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
        $onlyPermissions = array_merge($onlyPermissions, $permission['permission']);
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