<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\EmployeeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Address;

class EmployeeRepository implements EmployeeInterface {

    private $userModel;
    private $addressModel;

    public function __construct(User $userModel, Address $addressModel) {
        $this->userModel = $userModel;
        $this->addressModel = $addressModel;
    }
    
    /**
     * @description used to get all the users data from database with relation.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    function getAllEmployee() {
        return $this->userModel::with('addresses')->with('roles')->get();
    }
    
    /**
     * @description used to get specific user data from database with relation.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    function getEmployee($id) {
        return $this->userModel::where('id', $id)->with('addresses')->with('roles')->first();
    }
    
    /**
     * @description used to create/update user data into database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return string
     */
    function createUpdateEmployee(Request $request, $id = null) {
        $image = $this->uploadImage($request);
        $employeeArr = $this->createEmployeeArray($request->all(), $id);
        is_null($image) ?: $employeeArr['image'] = $image;
      
        if(is_null($id)) {
            $employeeData = $this->userModel::create($employeeArr);
            $employeeId = $employeeData->id;
            
            $pivotAction = 'attach';
            $addressFunction = 'createAddress';
            $response = !empty($employeeData) ? 'Created' : 'Something went wrong';
        } else {
            $status = $this->userModel::find($id)->update($employeeArr);
            $employeeId = $id;
            
            $pivotAction = 'sync';
            $addressFunction = 'updateAddress';
            $response = $status ? 'Updated' : 'Something went wrong';
        }
        
        $this->attachDetachSyncUserRoles($employeeId, $request->get('roles'), $pivotAction);
        $this->$addressFunction($request->all(), $employeeId);
        
        return $response;
    }
    
    /**
     * @description used to upload image in storage liked to public folder.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return string|null
     */
    function uploadImage(Request $request) {
        if($request->hasFile('image')) {
            $file = $request->file('image');

            $fileExtension = $file->getClientOriginalExtension();
            $fileName = 'avatar_'.time().'.'.$fileExtension;
            $filePath = storage_path('app/public/images/users');

            $status = $file->move($filePath, $fileName);

            return $fileName;
        }
        return null;
    }
    
    /**
     * @description used to update pivot table.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return
     */
    function attachDetachSyncUserRoles($employeeId, $roles, $action = 'attach') {
        $user = $this->userModel::find($employeeId);
        $userRolesObj = $user->roles();
        
        switch($action) {
            case 'attach':
                $userRolesObj->attach($roles);
                break;
            case 'detach':
                $userRolesObj->detach($roles);
                break;
            case 'sync':
                $userRolesObj->sync($roles);
                break;
        }
    }
    
    /**
     * @description used to user data array.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return array
     */
    function createEmployeeArray($attributes, $id = null) {
        $employee = [
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'dob' => $attributes['date_of_birth'] ?? null,
            'email_verification_token' => Str::random(40),
            'is_address_same' => $attributes['is_address_same']
        ];
        
        if(is_null($id)) {
            $employee['email'] = $attributes['email'];
            $employee['password'] = bcrypt($attributes['password']);
        }
        
        return $employee;
    }
    
    /**
     * @description used to create address data array.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return array
     */
    function createAddressArray($attributes, $employeeId) {
        $currentAddress = [
            'user_id' => $employeeId,
            'type' => 1,
            'line_one' => $attributes['current_address_line_one'],
            'line_two' => $attributes['current_address_line_two'],
            'city_id' => $attributes['current_address_city'],
            'state_id' => $attributes['current_address_state'],
            'country_id' => 101,
        ];
        
        $permanentAddress = [];
        if((int)$attributes['is_address_same'] === 0) {
            $permanentAddress = [
                'user_id' => $employeeId,
                'type' => 0,
                'line_one' => $attributes['permanent_address_line_one'],
                'line_two' => $attributes['permanent_address_line_two'],
                'city_id' => $attributes['permanent_address_city'],
                'state_id' => $attributes['permanent_address_state'],
                'country_id' => 101,
            ];
        }
        
        return ['current_address' => $currentAddress, 'permanent_address' => $permanentAddress];
    }
    
    /**
     * @description used to insert address data in database
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    function createAddress($attributes, $employeeId) {
        $addresses = $this->createAddressArray($attributes, $employeeId);
        if(empty($addresses['permanent_address'])) {
            unset($addresses['permanent_address']);
        }
        return $this->addressModel->insert($addresses);
    }
    
    /**
     * @description used to update address data in database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    function updateAddress($attributes, $employeeId) {
        $addresses = $this->createAddressArray($attributes, $employeeId);
        
        $status = $this->addressModel::where(['user_id' => $employeeId, 'type' => 1])->update($addresses['current_address']);
        
        if(!empty($addresses['permanent_address'])) {
            $permanentAddress = $this->addressModel::where(['user_id' => $employeeId, 'type' => 0])->first();
            empty($permanentAddress) ? 
                $this->addressModel->create($addresses['permanent_address']) 
                    : $this->addressModel::where(['user_id' => $employeeId, 'type' => 0])->update($addresses['permanent_address']);
        }
        
        return $status;
    }
    
    /**
     * @description used to delete user from database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    function delete($id) {
        $user = $this->userModel::findOrFail($id);
        return $user->delete();
    }
}