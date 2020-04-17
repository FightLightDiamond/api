<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace GCard\Cuongpm\Modularization\Tests\Feature\Admin;


use Cuongpm\Modularization\MultiInheritance\TestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HeroTest extends TestCase
{
	use TestTrait;

	public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct();
    }

    public function setAuth()
    {
        $this->setUsername(config('modularization.test.admin_account.username'));
        $this->setPassword(config('modularization.test.admin_account.password'));
        $this->setProvider('admins');
    }

    private function getId()
    {
        return \GCard\Models\Hero::value('id');
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

        $response = $this->call('GET', route('admin.services.index'), $params, [], [], $server);

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $params = [ 'name' => rand(1, 9), 'nickname' => rand(1, 9), 'role' => rand(1, 9), 'sayings' => rand(1, 9), 'class_id' => rand(1, 9), 'image' => rand(1, 9), 'element_id' => rand(1, 9), 'publish_time' => rand(1, 9), 'status' => rand(1, 9),  ];
        $response = $this->post(route('admin.heroes.store'), $params, $this->getHeader());

        $response->assertStatus(201);
    }

    public function testShow()
    {
        $response = $this->get(route('admin.heroes.show', $this->getId()), $this->getHeader());

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $params = [ 'name' => rand(1, 9), 'nickname' => rand(1, 9), 'role' => rand(1, 9), 'sayings' => rand(1, 9), 'class_id' => rand(1, 9), 'image' => rand(1, 9), 'element_id' => rand(1, 9), 'publish_time' => rand(1, 9), 'status' => rand(1, 9),  ];
        $response = $this->put(route('admin.heroes.update', $this->getId()), $params, $this->getHeader());

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('admin.heroes.destroy', $this->getId()), [], $this->getHeader());

        $response->assertStatus(200);
    }
}
