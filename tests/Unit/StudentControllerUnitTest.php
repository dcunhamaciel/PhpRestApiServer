<?php

namespace Tests\Unit;

use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
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
        $fakeRequest = new Request([
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
        $fakeRequest = new Request([
            'course' => 'Arqueologia',
        ]);

        $this->expectExceptionMessage('The field name is required');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }

    /**
     * @return void
     */
    public function testValidateRequestMissingCourseFailureFlow(): void
    {
        $fakeRequest = new Request([
            'name' => 'Lara Croft',
        ]);

        $this->expectExceptionMessage('The field course is required');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }
    
    /**
     * @return void
     */
    public function testValidateRequestNameExceededMaxLengthFailureFlow(): void
    {
        $fakeRequest = new Request([
            'name' => 'Lara Croftttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt',
            'course' => 'Arqueologia',
        ]);

        $this->expectExceptionMessage('The field name must have at most 60 characters');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }    

    /**
     * @return void
     */
    public function testValidateRequestCourseExceededMaxLengthFailureFlow(): void
    {
        $fakeRequest = new Request([
            'name' => 'Lara Croft',
            'course' => 'Arqueologiaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
        ]);

        $this->expectExceptionMessage('The field course must have at most 60 characters');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }   
      
    /**
     * @return void
     */
    public function testValidateRequestNameWithInvalidTypeFailureFlow(): void
    {
        $fakeRequest = new Request([
            'name' => 123,
            'course' => 'Arqueologia',
        ]);

        $this->expectExceptionMessage('The field name must be string');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }       

    /**
     * @return void
     */
    public function testValidateRequestCourseWithInvalidTypeFailureFlow(): void
    {
        $fakeRequest = new Request([
            'name' => 'Lara Croft',
            'course' => 0,
        ]);

        $this->expectExceptionMessage('The field course must be string');
        $this->studentControllerInstance->validateRequest($fakeRequest);
    }      
}
