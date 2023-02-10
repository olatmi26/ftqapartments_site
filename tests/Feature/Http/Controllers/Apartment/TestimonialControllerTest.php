<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\TestimonialController
 */
class TestimonialControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $testimonials = Testimonial::factory()->count(3)->create();

        $response = $this->get(route('testimonial.index'));

        $response->assertOk();
        $response->assertViewIs('testimonial.index');
        $response->assertViewHas('testimonials');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('testimonial.create'));

        $response->assertOk();
        $response->assertViewIs('testimonial.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->get(route('testimonial.show', $testimonial));

        $response->assertOk();
        $response->assertViewIs('testimonial.show');
        $response->assertViewHas('testimonial');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->get(route('testimonial.edit', $testimonial));

        $response->assertOk();
        $response->assertViewIs('testimonial.edit');
        $response->assertViewHas('testimonial');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\TestimonialController::class,
            'update',
            \App\Http\Requests\Apartment\TestimonialUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->put(route('testimonial.update', $testimonial));

        $testimonial->refresh();

        $response->assertRedirect(route('testimonial.index'));
        $response->assertSessionHas('testimonial.id', $testimonial->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->delete(route('testimonial.destroy', $testimonial));

        $response->assertRedirect(route('testimonial.index'));

        $this->assertModelMissing($testimonial);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\TestimonialController::class,
            'store',
            \App\Http\Requests\Apartment\TestimonialStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $testimony = $this->faker->text;

        $response = $this->post(route('testimonial.store'), [
            'user_id' => $user->id,
            'testimony' => $testimony,
        ]);

        $testimonials = Testimonial::query()
            ->where('user_id', $user->id)
            ->where('testimony', $testimony)
            ->get();
        $this->assertCount(1, $testimonials);
        $testimonial = $testimonials->first();

        $response->assertRedirect(route('Testimonial.index'));
        $response->assertSessionHas('testimonial-added-successively', $testimonial-added-successively);
    }
}
