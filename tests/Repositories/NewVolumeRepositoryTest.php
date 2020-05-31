<?php namespace Tests\Repositories;

use App\Models\NewVolume;
use App\Repositories\NewVolumeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NewVolumeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NewVolumeRepository
     */
    protected $newVolumeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->newVolumeRepo = \App::make(NewVolumeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_new_volume()
    {
        $newVolume = factory(NewVolume::class)->make()->toArray();

        $createdNewVolume = $this->newVolumeRepo->create($newVolume);

        $createdNewVolume = $createdNewVolume->toArray();
        $this->assertArrayHasKey('id', $createdNewVolume);
        $this->assertNotNull($createdNewVolume['id'], 'Created NewVolume must have id specified');
        $this->assertNotNull(NewVolume::find($createdNewVolume['id']), 'NewVolume with given id must be in DB');
        $this->assertModelData($newVolume, $createdNewVolume);
    }

    /**
     * @test read
     */
    public function test_read_new_volume()
    {
        $newVolume = factory(NewVolume::class)->create();

        $dbNewVolume = $this->newVolumeRepo->find($newVolume->id);

        $dbNewVolume = $dbNewVolume->toArray();
        $this->assertModelData($newVolume->toArray(), $dbNewVolume);
    }

    /**
     * @test update
     */
    public function test_update_new_volume()
    {
        $newVolume = factory(NewVolume::class)->create();
        $fakeNewVolume = factory(NewVolume::class)->make()->toArray();

        $updatedNewVolume = $this->newVolumeRepo->update($fakeNewVolume, $newVolume->id);

        $this->assertModelData($fakeNewVolume, $updatedNewVolume->toArray());
        $dbNewVolume = $this->newVolumeRepo->find($newVolume->id);
        $this->assertModelData($fakeNewVolume, $dbNewVolume->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_new_volume()
    {
        $newVolume = factory(NewVolume::class)->create();

        $resp = $this->newVolumeRepo->delete($newVolume->id);

        $this->assertTrue($resp);
        $this->assertNull(NewVolume::find($newVolume->id), 'NewVolume should not exist in DB');
    }
}
