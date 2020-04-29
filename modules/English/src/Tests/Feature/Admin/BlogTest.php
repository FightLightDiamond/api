<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 */

namespace English\Tests\Feature\Admin;


use Cuongpm\Modularization\MultiInheritance\TestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
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
        return \English\Models\Blog::value('id');
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
        $params = [ 'title' => rand(1, 9), 'intro' => rand(1, 9), 'content' => rand(1, 9), 'created_by' => rand(1, 9), 'updated_by' => rand(1, 9),  ];
        $response = $this->post(route('admin.blogs.store'), $params, $this->getHeader());

        $response->assertStatus(201);
    }

    public function testShow()
    {
        $response = $this->get(route('admin.blogs.show', $this->getId()), $this->getHeader());

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $params = [ 'title' => rand(1, 9), 'intro' => rand(1, 9), 'content' => rand(1, 9), 'created_by' => rand(1, 9), 'updated_by' => rand(1, 9),  ];
        $response = $this->put(route('admin.blogs.update', $this->getId()), $params, $this->getHeader());

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('admin.blogs.destroy', $this->getId()), [], $this->getHeader());

        $response->assertStatus(200);
    }
}
