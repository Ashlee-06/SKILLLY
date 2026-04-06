<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
    }

    // TC-UP-00: Upload page loads
    public function test_upload_page_loads()
    {
        $response = $this->get('/upload');
        $response->assertStatus(200);
    }

    // TC-UP-01: Valid PDF upload is accepted
    public function test_valid_pdf_upload_is_accepted()
    {
        $file = UploadedFile::fake()->create('resume.pdf', 100, 'application/pdf');

        $response = $this->post('/upload', ['resume' => $file]);

        $response->assertSessionHasNoErrors();
    }

    // TC-UP-02: Valid DOCX upload is accepted
    public function test_valid_docx_upload_is_accepted()
    {
        $file = UploadedFile::fake()->create(
            'resume.docx',
            100,
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        );

        $response = $this->post('/upload', ['resume' => $file]);

        $response->assertSessionHasNoErrors();
    }

    // TC-UP-04: File over 5MB is rejected
    public function test_file_exceeding_5mb_is_rejected()
    {
        $file = UploadedFile::fake()->create('big.pdf', 6000, 'application/pdf');

        $response = $this->post('/upload', ['resume' => $file]);

        $response->assertSessionHasErrors(['resume']);
    }

    // TC-UP-05: Wrong file type (.txt) is rejected
    public function test_wrong_file_type_is_rejected()
    {
        $file = UploadedFile::fake()->create('resume.txt', 100, 'text/plain');

        $response = $this->post('/upload', ['resume' => $file]);

        $response->assertSessionHasErrors(['resume']);
    }

    // TC-UP-07: Submitting with no file returns validation error
    public function test_upload_without_file_returns_validation_error()
    {
        $response = $this->post('/upload', []);

        $response->assertSessionHasErrors(['resume']);
    }
}