<?php

namespace Tests\Feature\Http\Controllers\Apartment;

use App\Models\Term;
use App\Models\Terms;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Apartment\TermsController
 */
class TermsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $terms = Terms::factory()->count(3)->create();

        $response = $this->get(route('term.index'));

        $response->assertOk();
        $response->assertViewIs('term.index');
        $response->assertViewHas('terms');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('term.create'));

        $response->assertOk();
        $response->assertViewIs('term.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $term = Terms::factory()->create();

        $response = $this->get(route('term.show', $term));

        $response->assertOk();
        $response->assertViewIs('term.show');
        $response->assertViewHas('term');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $term = Terms::factory()->create();

        $response = $this->get(route('term.edit', $term));

        $response->assertOk();
        $response->assertViewIs('term.edit');
        $response->assertViewHas('term');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\TermsController::class,
            'update',
            \App\Http\Requests\Apartment\TermsUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $term = Terms::factory()->create();

        $response = $this->put(route('term.update', $term));

        $term->refresh();

        $response->assertRedirect(route('term.index'));
        $response->assertSessionHas('term.id', $term->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $term = Terms::factory()->create();
        $term = Term::factory()->create();

        $response = $this->delete(route('term.destroy', $term));

        $response->assertRedirect(route('term.index'));

        $this->assertModelMissing($term);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Apartment\TermsController::class,
            'store',
            \App\Http\Requests\Apartment\TermsStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('term.store'));

        $response->assertRedirect(route('Terms.index'));
        $response->assertSessionHas('terms-added-successively', $terms-added-successively);

        $this->assertDatabaseHas(terms, [ /* ... */ ]);
    }
}
