<?php

require_once '../Model/Customer.php';
require_once '../Model/Admin.php';

//factory
class userFactory{
    public static function redirectPageTo($role){
        switch($role){
            case 'Customer':
                return Customer::pageRedirect();
            case 'Admin':
                return Admin::pageRedirect();
        }
    }
}
