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

class CrazySpeakHistoryTest extends TestCase
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
        return \English\Models\CrazySpeakHistory::value('id');
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
        $params = [ 'user_id' => rand(1, 9), 'crazy_id' => rand(1, 9), 'score' => rand(1, 9), 'audio' => rand(1, 9),  ];
        $response = $this->post(route('admin.crazy-speak-histories.store'), $params, $this->getHeader());

        $response->assertStatus(201);
    }

    public function testShow()
    {
        $response = $this->get(route('admin.crazy-speak-histories.show', $this->getId()), $this->getHeader());

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $params = [ 'user_id' => rand(1, 9), 'crazy_id' => rand(1, 9), 'score' => rand(1, 9), 'audio' => rand(1, 9),  ];
        $response = $this->put(route('admin.crazy-speak-histories.update', $this->getId()), $params, $this->getHeader());

        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('admin.crazy-speak-histories.destroy', $this->getId()), [], $this->getHeader());

        $response->assertStatus(200);
    }
}
