<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_authenticates_with_valid_credentials()
    {



        // Meniru permintaan dengan kredensial yang valid
        $response = $this->submitForm('/login', [
            'email' => 'nyai@gmail.com',
            'password' => 'rahasia123',
        ]);

        // Memastikan bahwa pengguna diotentikasi dan dialihkan ke halaman yang dimaksud
        $response->assertRedirect('/');

    }

    /** @test */
    public function it_does_not_authenticate_with_invalid_credentials()
    {
        // Meniru permintaan dengan kredensial yang tidak valid
        $response = $this->post('/login', [
            'email' => 'invalid@example.com',
            'password' => 'wrongpassword',
        ]);

        // Memastikan bahwa pengguna tidak diotentikasi dan dialihkan kembali
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}

