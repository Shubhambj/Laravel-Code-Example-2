<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface EmployeeInterface {

    function getAllEmployee();
        
    function getEmployee($id);
        
    function createUpdateEmployee(Request $request, $id = null);
        
    function uploadImage(Request $request);
        
    function attachDetachSyncUserRoles($employeeId, $roles, $action = 'attach');
        
    function createEmployeeArray($attributes, $id = null);
        
    function createAddressArray($attributes, $employeeId);
        
    function createAddress($attributes, $employeeId);
        
    function updateAddress($attributes, $employeeId);
        
    function delete($id);
}
