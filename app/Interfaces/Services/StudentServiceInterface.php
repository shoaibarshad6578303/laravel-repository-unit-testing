<?php

namespace App\Interfaces\Services;

interface StudentServiceInterface
{
    public function store(array $data);
    public function getAllStudents();
    public function getStudentById($id);
    public function deleteStudent($id);
    public function updateStudent(array $data, $id);

}