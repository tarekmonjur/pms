<?php
/**
 * Created by PhpStorm.
 * User: Tarek Monjur
 * Date: 12/13/2017
 * Time: 4:44 PM
 */


function getUserTypes(){
    return [
        "director" => [
            "",
        ],
        "admin" => [
            "",
        ],
        "manager" => [
            "projects",
            "projects/create",
        ],
        "employee" => [
            "",
        ]
    ];
}


function canAccess($user_type, $access){
    $userTypes = getUserTypes();

    if(isset($userTypes[$user_type]))
    {
        if (in_array($access, $userTypes[$user_type])) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}