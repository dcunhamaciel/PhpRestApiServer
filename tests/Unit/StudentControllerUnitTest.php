<?php

namespace Tests\Unit;

use App\Http\Controllers\StudentController;
use App\Http\Requests\StudentRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudentControllerUnitTest extends TestCase
{
    use DatabaseTransactions;

    private StudentController $studentControllerInstance;

    public function setUp(): void
    {
        parent::setUp();
        $this->studentControllerInstance = new StudentController();
    }

    /**
     * @return void
     */
    public function testValidateRequestSuccessFlow(): void
    {
        $fakeRequest = new StudentRequest([
            'name' => 'Lara Croft',
            'course' => 'Arqueologia',
        ]);

        $result = $this->studentControllerInstance->validateRequest($fakeRequest);

        $this->assertNull($result);
    }

    /**
     * @return void
     */
    public function testValidateRequestMissingNameFailureFlow(): void
    {
        $fakeRequest = new StudentRequest([
            'course' => 'Arqueologia',
        ]);

        $this->expectExceptionMessage('O campo name é obrigatório');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }

    /**
     * @return void
     */
    public function testValidateRequestMissingCourseFailureFlow(): void
    {
        $fakeRequest = new StudentRequest([
            'name' => 'Lara Croft',
        ]);

        $this->expectExceptionMessage('O campo course é obrigatório');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }
    
    /**
     * @return void
     */
    public function testValidateRequestNameExceededMaxLengthFailureFlow(): void
    {
        $fakeRequest = new StudentRequest([
            'name' => 'Lara Croftttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt',
            'course' => 'Arqueologia',
        ]);

        $this->expectExceptionMessage('O campo name deve ter no máximo 60 caracteres');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }    

    /**
     * @return void
     */
    public function testValidateRequestCourseExceededMaxLengthFailureFlow(): void
    {
        $fakeRequest = new StudentRequest([
            'name' => 'Lara Croft',
            'course' => 'Arqueologiaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
        ]);

        $this->expectExceptionMessage('O campo course deve ter no máximo 60 caracteres');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }   
      
    /**
     * @return void
     */
    public function testValidateRequestNameWithInvalidTypeFailureFlow(): void
    {
        $fakeRequest = new StudentRequest([
            'name' => 123,
            'course' => 'Arqueologia',
        ]);

        $this->expectExceptionMessage('O campo name deve ser string');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }       

    /**
     * @return void
     */
    public function testValidateRequestCourseWithInvalidTypeFailureFlow(): void
    {
        $fakeRequest = new StudentRequest([
            'name' => 'Lara Croft',
            'course' => 0,
        ]);

        $this->expectExceptionMessage('O campo course deve ser string');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }      
}
