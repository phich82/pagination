<?php

namespace Tests\Feature\Controllers;

use App\Promotion;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PromotionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Index method test of controller
     *
     * @return void
     */
    public function testShowEditPromotionPage()
    {
        $ids = range(1, 10);
        for ($i = 1; $i < count($ids); $i++) {
            factory(Promotion::class)->create([
                'activity_id'         => null,
                'activity_title'      => null,
                'area_pathJP'         => 'demo/test',
                'activity_start_date' => date('Y-m-d'),
                'activity_end_date'   => null,
                'purchase_start_date' => date('Y-m-d', strtotime(date('Y-m-d')) + 6*24*60*60),
                'purchase_end_date'   => null,
                'rate_type'           => 1,
                'amount'              => 200,
                'created_user'        => 'admin@test.com'
            ]);
        }
        $promotion = Promotion::find($ids[array_rand($ids)]);
        $this->get(route('promotion.edit', [$promotion->id]))
             ->assertSee($promotion->activity_start_date)
             ->assertSee($promotion->purchase_start_date)
             ->assertSee($promotion->area_pathJP);
    }

    public function testShowEditPromotionPage2()
    {
        $ids = range(1, 10);
        for ($i = 1; $i < count($ids); $i++) {
            factory(Promotion::class)->create([
                'activity_id'         => null,
                'activity_title'      => null,
                'area_pathJP'         => 'demo/test',
                'activity_start_date' => date('Y-m-d'),
                'activity_end_date'   => null,
                'purchase_start_date' => date('Y-m-d', strtotime(date('Y-m-d')) + 6*24*60*60),
                'purchase_end_date'   => null,
                'rate_type'           => 1,
                'amount'              => 200,
                'created_user'        => 'admin@test.com'
            ]);
        }
        $promotion = Promotion::find($ids[array_rand($ids)]);
        $this->get(route('promotion.edit', [$promotion->id]))
             ->assertSee($promotion->activity_start_date)
             ->assertSee($promotion->purchase_start_date)
             ->assertSee($promotion->area_pathJP);
    }
}