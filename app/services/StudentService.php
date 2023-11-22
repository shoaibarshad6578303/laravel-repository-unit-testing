<?php

namespace App\services;
use App\Models\Student;
use App\Interfaces\Services\StudentServiceInterface;
use App\Repositories\StudentRepository;

class StudentService implements StudentServiceInterface
{
    private StudentRepository $repository;

    public function __construct(StudentRepository  $studentRepository)
    {
        $this->repository = $studentRepository;
    }
    public function store(array $data){
        return $this->repository->createStudent($data);
    }
    public function getAllStudents(){
        return $this->repository->getAllStudents();
    }
    public function getStudentById($id){
        return $this->repository->getStudentById($id);
    }

    public function deleteStudent($id){
        return $this->repository->deleteStudent($id);
    }
    public function updateStudent(array $data, $id){
        return $this->repository->updateStudent($data, $id);
    }
}