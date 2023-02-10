<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ContactU;
use App\Models\ContactUs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ContactUsController
 */
class ContactUsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $contactUs = ContactUs::factory()->count(3)->create();

        $response = $this->get(route('contact-u.index'));

        $response->assertOk();
        $response->assertViewIs('contactU.index');
        $response->assertViewHas('contactUs');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('contact-u.create'));

        $response->assertOk();
        $response->assertViewIs('contactU.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $contactU = ContactUs::factory()->create();

        $response = $this->get(route('contact-u.show', $contactU));

        $response->assertOk();
        $response->assertViewIs('contactU.show');
        $response->assertViewHas('contactU');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $contactU = ContactUs::factory()->create();

        $response = $this->get(route('contact-u.edit', $contactU));

        $response->assertOk();
        $response->assertViewIs('contactU.edit');
        $response->assertViewHas('contactU');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContactUsController::class,
            'update',
            \App\Http\Requests\ContactUsUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $contactU = ContactUs::factory()->create();

        $response = $this->put(route('contact-u.update', $contactU));

        $contactU->refresh();

        $response->assertRedirect(route('contactU.index'));
        $response->assertSessionHas('contactU.id', $contactU->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $contactU = ContactUs::factory()->create();
        $contactU = ContactU::factory()->create();

        $response = $this->delete(route('contact-u.destroy', $contactU));

        $response->assertRedirect(route('contactU.index'));

        $this->assertModelMissing($contactU);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContactUsController::class,
            'store',
            \App\Http\Requests\ContactUsStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $email = $this->faker->safeEmail;
        $fullName = $this->faker->word;
        $message = $this->faker->text;
        $subject = $this->faker->word;
        $phone = $this->faker->phoneNumber;

        $response = $this->post(route('contact-u.store'), [
            'email' => $email,
            'fullName' => $fullName,
            'message' => $message,
            'subject' => $subject,
            'phone' => $phone,
        ]);

        $contactUs = ContactUs::query()
            ->where('email', $email)
            ->where('fullName', $fullName)
            ->where('message', $message)
            ->where('subject', $subject)
            ->where('phone', $phone)
            ->get();
        $this->assertCount(1, $contactUs);
        $contactU = $contactUs->first();

        $response->assertRedirect(route('ContactUs.index'));
        $response->assertSessionHas('contactUs-saved-successively', $contactUs-saved-successively);
    }
}
