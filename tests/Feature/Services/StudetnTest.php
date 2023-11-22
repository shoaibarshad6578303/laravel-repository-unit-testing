<?php

namespace Tests\Feature\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Student;
use App\services\StudentService;
use App\Repositories\StudentRepository;


class StudetnTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected Student $student;
    private StudentRepository $repository;


    public function setUp(): void
    {
        parent::setUp();
        $this->student = Student::factory()->create();
    }

    protected function getStudentService(): StudentService
    {
        return $this->app->make(StudentService::class);
    }

    public function test_create_student()
    {
        $data = [
            'name' => $this->faker->name(),
        ];

        $student = new Student();
        $studentRepository = new StudentRepository($student);
        $studentService = new StudentService($studentRepository);
        $studentService->store($data);
        $this->assertDatabaseHas('students', [
            'name' => $data['name'],
        ]);
    }

    public function test_delete_student()
    {
        $data = [
            'name' => $this->faker->name(),
        ];

        $student = new Student();
        $studentRepository = new StudentRepository($student);
        $studentService = new StudentService($studentRepository);
        
        $createdStudent = $studentService->store($data);
        $this->assertDatabaseHas('students', [
            'id' => $createdStudent['id'],
        ]);

        $studentService->deleteStudent($createdStudent['id']);
        $this->assertDatabaseMissing('students', [
            'id' => $createdStudent['id'],
        ]);
    }

    public function test_update_student()
    {
        $data = [
            'name' => $this->faker->name(),
        ];

        $student = new Student();
        $studentRepository = new StudentRepository($student);
        $studentService = new StudentService($studentRepository);
        
        $createdStudent = $studentService->store($data);
        $this->assertDatabaseHas('students', [
            'name' => $data['name'],
        ]);

        $updateData = [
            'name' => $this->faker->name(),
        ];
        
        $studentService->updateStudent($updateData, $createdStudent['id']);
        $this->assertDatabaseHas('students', [
            'name' => $updateData['name'],
        ]);

    }

    public function test_student_by_id()
    {
        $data = [
            'name' => $this->faker->name(),
        ];

        $student = new Student();
        $studentRepository = new StudentRepository($student);
        $studentService = new StudentService($studentRepository);
        $createdStudent = $studentService->store($data);
        
        $this->assertDatabaseHas('students', [
            'name' => $data['name'],
        ]);

        $findStudent = $studentService->getStudentById($createdStudent['id']); 
        $this->assertDatabaseHas('students', [
            'name' => $findStudent['name'],
        ]);

    }

    public function test_student_all()
    {
        Student::factory(10)->create();

        $student = new Student();
        $studentRepository = new StudentRepository($student);
        $studentService = new StudentService($studentRepository);
        $listOfStudents = $studentService->getAllStudents();
        $this->assertCount(11, $listOfStudents);
    }
}
