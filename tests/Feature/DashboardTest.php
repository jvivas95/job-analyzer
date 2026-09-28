<?php

namespace Tests\Feature;

use App\Models\JobOffer;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_only_the_users_offer_metrics_and_recent_offers(): void
    {
        $user = User::factory()->create(['name' => 'Ada Lovelace']);
        $otherUser = User::factory()->create();

        Profile::create([
            'user_id' => $user->id,
            'full_name' => 'Ada Lovelace',
            'summary' => str_repeat('Professional summary. ', 3),
            'skills' => ['PHP'],
        ]);

        JobOffer::create([
            'user_id' => $user->id,
            'title' => 'Backend Engineer',
            'company' => 'Own Company',
            'description' => 'A backend engineering role.',
            'status' => 'processed',
            'fit_score' => 90,
            'cv_pdf_path' => 'offers/ada-cv.pdf',
            'cover_letter_pdf_path' => 'offers/ada-letter.pdf',
        ]);
        JobOffer::create([
            'user_id' => $user->id,
            'title' => 'Platform Engineer',
            'company' => 'In Progress Company',
            'description' => 'A platform engineering role.',
            'status' => 'processing',
        ]);
        JobOffer::create([
            'user_id' => $user->id,
            'title' => 'Data Engineer',
            'company' => 'Failed Company',
            'description' => 'A data engineering role.',
            'status' => 'failed',
        ]);
        JobOffer::create([
            'user_id' => $otherUser->id,
            'title' => 'Private Role',
            'company' => 'Other User Company',
            'description' => 'A private job offer.',
            'status' => 'processed',
            'fit_score' => 100,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response
            ->assertOk()
            ->assertSee('Hola, Ada')
            ->assertSee('Own Company')
            ->assertSee('In Progress Company')
            ->assertDontSee('Other User Company')
            ->assertViewHas('stats', fn (array $stats): bool => $stats === [
                'total' => 3,
                'analyzed' => 1,
                'high_fit' => 1,
                'in_progress' => 1,
                'failed' => 1,
                'documents' => 2,
            ])
            ->assertViewHas('profileProgress', fn (array $progress): bool => $progress['percentage'] === 75);
    }

    public function test_dashboard_prompts_the_user_to_complete_a_missing_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response
            ->assertOk()
            ->assertSee('Completa estos datos')
            ->assertSee('Completar mi perfil')
            ->assertViewHas('profileProgress', fn (array $progress): bool => $progress['percentage'] === 0);
    }
}
