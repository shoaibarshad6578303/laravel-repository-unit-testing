<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\Services\StudentServiceInterface;

class StudentController extends Controller
{
    private StudentServiceInterface $interface;

    public function __construct(StudentServiceInterface $studentServiceInterface) 
    {
        $this->interface = $studentServiceInterface;
    }

    public function index()
    {
       return $this->interface->getAllStudents();
    }

    public function store(Request $request) 
    {
       return $this->interface->store($request->all());
    }
    
    public function show($id) 
    {
        return $this->interface->getStudentById($id);
    }

    public function edit($id) 
    {
        return $this->interface->getStudentById($id);
    }
    
    public function update(Request $request, $id) 
    {
       return $this->interface->updateStudent($id, $request->all());
    }

    public function destroy($id) 
    {
       return $this->interface->deleteStudent($id);
    }

}
