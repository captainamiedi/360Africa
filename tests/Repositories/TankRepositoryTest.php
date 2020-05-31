<?php namespace Tests\Repositories;

use App\Models\Tank;
use App\Repositories\TankRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TankRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TankRepository
     */
    protected $tankRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tankRepo = \App::make(TankRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tank()
    {
        $tank = factory(Tank::class)->make()->toArray();

        $createdTank = $this->tankRepo->create($tank);

        $createdTank = $createdTank->toArray();
        $this->assertArrayHasKey('id', $createdTank);
        $this->assertNotNull($createdTank['id'], 'Created Tank must have id specified');
        $this->assertNotNull(Tank::find($createdTank['id']), 'Tank with given id must be in DB');
        $this->assertModelData($tank, $createdTank);
    }

    /**
     * @test read
     */
    public function test_read_tank()
    {
        $tank = factory(Tank::class)->create();

        $dbTank = $this->tankRepo->find($tank->id);

        $dbTank = $dbTank->toArray();
        $this->assertModelData($tank->toArray(), $dbTank);
    }

    /**
     * @test update
     */
    public function test_update_tank()
    {
        $tank = factory(Tank::class)->create();
        $fakeTank = factory(Tank::class)->make()->toArray();

        $updatedTank = $this->tankRepo->update($fakeTank, $tank->id);

        $this->assertModelData($fakeTank, $updatedTank->toArray());
        $dbTank = $this->tankRepo->find($tank->id);
        $this->assertModelData($fakeTank, $dbTank->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tank()
    {
        $tank = factory(Tank::class)->create();

        $resp = $this->tankRepo->delete($tank->id);

        $this->assertTrue($resp);
        $this->assertNull(Tank::find($tank->id), 'Tank should not exist in DB');
    }
}
