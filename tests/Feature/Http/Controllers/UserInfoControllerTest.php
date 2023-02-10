<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserInfoController
 */
class UserInfoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $userInfos = UserInfo::factory()->count(3)->create();

        $response = $this->get(route('user-info.index'));

        $response->assertOk();
        $response->assertViewIs('userInfo.index');
        $response->assertViewHas('userInfos');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user-info.create'));

        $response->assertOk();
        $response->assertViewIs('userInfo.create');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $userInfo = UserInfo::factory()->create();

        $response = $this->get(route('user-info.show', $userInfo));

        $response->assertOk();
        $response->assertViewIs('userInfo.show');
        $response->assertViewHas('userInfo');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $userInfo = UserInfo::factory()->create();

        $response = $this->get(route('user-info.edit', $userInfo));

        $response->assertOk();
        $response->assertViewIs('userInfo.edit');
        $response->assertViewHas('userInfo');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserInfoController::class,
            'update',
            \App\Http\Requests\UserInfoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $userInfo = UserInfo::factory()->create();

        $response = $this->put(route('user-info.update', $userInfo));

        $userInfo->refresh();

        $response->assertRedirect(route('userInfo.index'));
        $response->assertSessionHas('userInfo.id', $userInfo->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $userInfo = UserInfo::factory()->create();

        $response = $this->delete(route('user-info.destroy', $userInfo));

        $response->assertRedirect(route('userInfo.index'));

        $this->assertModelMissing($userInfo);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserInfoController::class,
            'store',
            \App\Http\Requests\UserInfoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $user = User::factory()->create();
        $nextOfKin_fullName = $this->faker->word;
        $relationshipWithYou = $this->faker->word;
        $nextOfKin_phoneN0 = $this->faker->word;
        $nextOfKin_email = $this->faker->word;

        $response = $this->post(route('user-info.store'), [
            'user_id' => $user->id,
            'nextOfKin_fullName' => $nextOfKin_fullName,
            'relationshipWithYou' => $relationshipWithYou,
            'nextOfKin_phoneN0' => $nextOfKin_phoneN0,
            'nextOfKin_email' => $nextOfKin_email,
        ]);

        $userInfos = UserInfo::query()
            ->where('user_id', $user->id)
            ->where('nextOfKin_fullName', $nextOfKin_fullName)
            ->where('relationshipWithYou', $relationshipWithYou)
            ->where('nextOfKin_phoneN0', $nextOfKin_phoneN0)
            ->where('nextOfKin_email', $nextOfKin_email)
            ->get();
        $this->assertCount(1, $userInfos);
        $userInfo = $userInfos->first();

        $response->assertRedirect(route('Booking.index'));
        $response->assertSessionHas('userInfo-added-successively', $userInfo-added-successively);
    }
}
