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

class ContactTest extends TestCase
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
        return \ACL\Models\Contact::value('id');
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

		$response = $this->call('GET', route('api.contacts.index'), $params, [], [], $server);

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $params = [  ];
        $response = $this->post(route('api.contacts.store'), $params, $this->getHeader());

        $response->assertStatus(201);
    }

    public function testShow()
    {
        $response = $this->get(route('api.contacts.show', $this->getId()), $this->getHeader());

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $params = [  ];
        $response = $this->put(route('api.contacts.update', $this->getId()), $params, $this->getHeader());

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('api.contacts.destroy', $this->getId()), [], $this->getHeader());

        $response->assertStatus(200);
    }
}
