<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Contact;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    public function it_creates_a_contact(): void
    {
       $response = $this->post('/contacts', [
            'name' => 'Test User',
            'phone' => '1234567890'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('contacts', ['name' => 'Test User']);
    }
    public function it_fails_validation_when_creating_contact(): void
    {
        $response = $this->postJson('/api/contacts', [
            'phone' => '1234567890',
        ]);

        $response->assertStatus(422);
    }
}
