<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Eloquent\EmployeeRepository;

class EmployeeController extends Controller
{
    private $employeeRepo;
    
    public function __construct(EmployeeRepository $employeeRepo){
        $this->employeeRepo = $employeeRepo;
    }
    
    /**
     * @description used to load listing page.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function index() {
        $employees = $this->employeeRepo->getAllEmployee();
        return response()->view('employee.list', compact('employees'));
    }
    
    /**
     * @description used to load add form.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function create() {
        return response()->view('employee.create');
    }
    
    /**
     * @description used to create data in database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function store(Request $request) {
        return $this->storeUpdate($request);
    }
    
    /**
     * @description used to display data from database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function show($id) {
        $employee = $this->employeeRepo->getEmployee($id);
        return response()->view('employee.show', compact('employee'));
    }
    
    /**
     * @description used to load data in update form.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function edit($id) {
        $employee = $this->employeeRepo->getEmployee($id);
        return response()->view('employee.edit', compact('employee'));
    }
    
    /**
     * @description used to update data in database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function update(Request $request, $id) {
        return $this->storeUpdate($request, $id);
    }
    
    /**
     * @description used to delete data from database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function destroy($id) {
        $this->employeeRepo->delete($id);
        return redirect()->route('employee.list');
    }
    
    /**
     * @description used to create or update the data in database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return view
     */
    protected function storeUpdate(Request $request, $id = null) {
        $validationObj = $this->validateInputs($request);
        
        if($validationObj->fails()) {
            return redirect()->back()->withErrors($validationObj)->withInput();
        }

        $response = $this->employeeRepo->createUpdateEmployee($request, $id);
        $isSuccess = in_array($response, ['Created', 'Updated']);

        session()->flash('message', $response);
        session()->flash('alert-type', ($isSuccess ? 'info' : 'danger') );

        return $isSuccess ? redirect()->route('employee.list') : redirect()->back()->withErrors($validationObj)->withInput();
    }
    
    /**
     * @description used to validate data to create or update the data in database.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 05.07.21
     * @version v1
     * @param 
     * @return object
     */
    protected function validateInputs(Request $request) {
        $method = $request->get('_method');
        
        $validationRules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|regex:/[@$!%*#?&]/',
            'roles' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_address_same' => 'required',
            'current_address_line_one' => 'required|string',
            'current_address_city' => 'required',
            'current_address_state' => 'required',
        ];
        
        if($method === 'PATCH') {
            unset($validationRules['email']);
            unset($validationRules['password']);
            if(!$request->hasFile('image')) {
                unset($validationRules['image']);
            }
        }
        
        if((int)$request->get('is_address_same') === 0){
            $validationRules['permanent_address_line_one'] = 'required|string';
            $validationRules['permanent_address_city'] = 'required';
            $validationRules['permanent_address_state'] = 'required';
        }
        
        return Validator::make($request->all(), $validationRules);
    }
    
}
