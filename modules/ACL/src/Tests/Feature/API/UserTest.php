<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace ACL\Tests\Feature\API;


use Cuongpm\Modularization\MultiInheritance\TestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
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
        return \ACL\Models\User::value('id');
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

		$response = $this->call('GET', route('api.users.index'), $params, [], [], $server);

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $params = [ 'first_name' => rand(1, 9), 'last_name' => rand(1, 9), 'code' => rand(1, 9), 'email' => rand(1, 9), 'phone_number' => rand(1, 9), 'sex' => rand(1, 9), 'password' => rand(1, 9), 'birthday' => rand(1, 9), 'address' => rand(1, 9), 'avatar' => rand(1, 9), 'remember_token' => rand(1, 9), 'is_active' => rand(1, 9), 'last_login' => rand(1, 9), 'last_logout' => rand(1, 9), 'slack_webhook_url' => rand(1, 9), 'coin' => rand(1, 9), 'locale' => rand(1, 9), 'group_id' => rand(1, 9),  ];
        $response = $this->post(route('api.users.store'), $params, $this->getHeader());

        $response->assertStatus(201);
    }

    public function testShow()
    {
        $response = $this->get(route('api.users.show', $this->getId()), $this->getHeader());

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $params = [ 'first_name' => rand(1, 9), 'last_name' => rand(1, 9), 'code' => rand(1, 9), 'email' => rand(1, 9), 'phone_number' => rand(1, 9), 'sex' => rand(1, 9), 'password' => rand(1, 9), 'birthday' => rand(1, 9), 'address' => rand(1, 9), 'avatar' => rand(1, 9), 'remember_token' => rand(1, 9), 'is_active' => rand(1, 9), 'last_login' => rand(1, 9), 'last_logout' => rand(1, 9), 'slack_webhook_url' => rand(1, 9), 'coin' => rand(1, 9), 'locale' => rand(1, 9), 'group_id' => rand(1, 9),  ];
        $response = $this->put(route('api.users.update', $this->getId()), $params, $this->getHeader());

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('api.users.destroy', $this->getId()), [], $this->getHeader());

        $response->assertStatus(200);
    }
}
