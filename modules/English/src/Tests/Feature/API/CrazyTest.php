<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace English\Tests\Feature\API;


use Cuongpm\Modularization\MultiInheritance\TestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrazyTest extends TestCase
{
	use TestTrait;

	public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct();
    }

    public function setAuth()
    {
        $this->setUsername( config('modularization.test.user_account.username'));
        $this->setPassword( config('modularization.test.user_account.password'));
        $this->setProvider('users');
    }

    private function getId()
    {
        return \English\Models\Crazy::value('id');
    }

    public function getServer()
    {
        return $this->transformHeadersToServerVars($this->getHeader());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $server = $this->getServer();
		$params = [

		];

		$response = $this->call('GET', route('api.crazies.index'), $params, [], [], $server);

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $params = [ 'name' => rand(1, 9), 'audio' => rand(1, 9), 'created_by' => rand(1, 9), 'updated_by' => rand(1, 9), 'is_active' => rand(1, 9), 'crazy_course_id' => rand(1, 9), 'img' => rand(1, 9), 'description' => rand(1, 9),  ];
        $response = $this->post(route('api.crazies.store'), $params, $this->getHeader());

        $response->assertStatus(201);
    }

    public function testShow()
    {
        $response = $this->get(route('api.crazies.show', $this->getId()), $this->getHeader());

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $params = [ 'name' => rand(1, 9), 'audio' => rand(1, 9), 'created_by' => rand(1, 9), 'updated_by' => rand(1, 9), 'is_active' => rand(1, 9), 'crazy_course_id' => rand(1, 9), 'img' => rand(1, 9), 'description' => rand(1, 9),  ];
        $response = $this->put(route('api.crazies.update', $this->getId()), $params, $this->getHeader());

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('api.crazies.destroy', $this->getId()), [], $this->getHeader());

        $response->assertStatus(200);
    }
}
