<?php namespace Tests\APIs;

use App\Models\NewVolume;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Tank;

class TankApiTest extends TestCase
{
//    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;
    use ApiTestTrait, RefreshDatabase;
    /**
     * @test
     */
    public function test_create_tank()
    {
        $tank = factory(Tank::class)->create()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tanks', $tank
        )
            ->assertSuccessful();

//        $this->assertApiResponse($tank);
    }

    /**
     * @test
     */
    public function test_read_tank()
    {
        $tank = factory(Tank::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tanks/'.$tank->id
        );

        $this->assertApiResponse($tank->toArray());
    }

    /**
     * @test
     */
    public function test_update_tank()
    {
        $tank = factory(Tank::class)->create();
        $editedTank = factory(Tank::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tanks/'.$tank->id,
            $editedTank
        );

        $this->assertApiResponse($editedTank);
    }

    /**
     * @test
     */
    public function test_delete_tank()
    {
        $tank = factory(Tank::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tanks/'.$tank->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tanks/'.$tank->id
        );

        $this->response->assertStatus(404);
    }

    public function test_liquid_transfer()
    {
        factory(Tank::class, 3)->create()->toArray();

        $tankId = [
            'tank1' => 1,
            'tank2' => 2,
        ];

        $this->response = $this->json(
            'POST',
            '/api/transfer', $tankId
        )
            ->assertSuccessful();
    }

    public function test_daily_sum()
    {
        factory(Tank::class, 4)->create();

        $this->response = $this->json(
            'GET',
            '/api/sum'
        )
            ->assertSuccessful()
            ->assertStatus(200);
    }

    public function test_volume_before_and_after_offloading()
    {
        factory(Tank::class)->create();
        $newVolume = factory(NewVolume::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/volume/change/'. $newVolume->id
        )
            ->assertSuccessful()
            ->assertStatus(200);
    }
}
