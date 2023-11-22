<?php

namespace App\Repositories;

use App\Interfaces\Repositories\StudentRepositoryInterface;
use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface 
{
    private $model;

    public function __construct(Student $student)
    {
        $this->model = $student;
    }
    public function getAllStudents() 
    {
        return $this->model::all();
    }

    public function getStudentById($studentId) 
    {
        return $this->model::findOrFail($studentId);
    }

    public function deleteStudent($studentId) 
    {
        return $this->model::destroy($studentId);
    }

    public function createStudent(array $studentDetails) 
    {
        return $this->model::create($studentDetails);
    }

    public function updateStudent(array $newDetails, $studentId) 
    {
        return $this->model::whereId($studentId)->update($newDetails);
    }

}