<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\NewVolume;

class NewVolumeApiTest extends TestCase
{
//    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;
        use RefreshDatabase, ApiTestTrait;
    /**
     * @test
     */
    public function test_create_new_volume()
    {
        $newVolume = factory(NewVolume::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/new_volumes', $newVolume
        )
            ->assertSuccessful();

//        $this->assertApiResponse($newVolume);
    }

    /**
     * @test
     */
    public function test_read_new_volume()
    {
        $newVolume = factory(NewVolume::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/new_volumes/'.$newVolume->id
        );

        $this->assertApiResponse($newVolume->toArray());
    }

    /**
     * @test
     */
    public function test_update_new_volume()
    {
        $newVolume = factory(NewVolume::class)->create();
        $editedNewVolume = factory(NewVolume::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/new_volumes/'.$newVolume->id,
            $editedNewVolume
        );

        $this->assertApiResponse($editedNewVolume);
    }

    /**
     * @test
     */
    public function test_delete_new_volume()
    {
        $newVolume = factory(NewVolume::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/new_volumes/'.$newVolume->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/new_volumes/'.$newVolume->id
        );

        $this->response->assertStatus(404);
    }
}
