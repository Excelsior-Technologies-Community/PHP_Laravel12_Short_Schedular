<?php

namespace Tests\Feature;

use App\Models\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test; 
use Tests\TestCase;

class LogDashboardTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_loads_the_dashboard_page_successfully()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    #[Test]
    public function it_displays_log_statistics_correctly()
    {
        Log::factory()->count(2)->create(['status' => 'success']);
        Log::factory()->create(['status' => 'failed']);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('3'); 
        $response->assertSee('2'); 
        $response->assertSee('1'); 
    }
}