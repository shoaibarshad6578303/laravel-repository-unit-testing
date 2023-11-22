<?php

namespace App\Interfaces\Repositories;


interface StudentRepositoryInterface
{
    public function createStudent(array $data);
    public function getAllStudents();
    public function getStudentById($id);
    public function deleteStudent($id);
    public function updateStudent(array $data, $id);

}
