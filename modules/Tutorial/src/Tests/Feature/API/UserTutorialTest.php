<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace Tutorial\Tests\Feature\API;


use Cuongpm\Modularization\MultiInheritance\TestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTutorialTest extends TestCase
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
        return \Tutorial\Models\UserTutorial::value('id');
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

		$response = $this->call('GET', route('api.user-tutorials.index'), $params, [], [], $server);

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $params = [ 'user_id' => rand(1, 9), 'tutorial_id' => rand(1, 9),  ];
        $response = $this->post(route('api.user-tutorials.store'), $params, $this->getHeader());

        $response->assertStatus(201);
    }

    public function testShow()
    {
        $response = $this->get(route('api.user-tutorials.show', $this->getId()), $this->getHeader());

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $params = [ 'user_id' => rand(1, 9), 'tutorial_id' => rand(1, 9),  ];
        $response = $this->put(route('api.user-tutorials.update', $this->getId()), $params, $this->getHeader());

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('api.user-tutorials.destroy', $this->getId()), [], $this->getHeader());

        $response->assertStatus(200);
    }
}
