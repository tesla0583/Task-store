<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    public function testCreateCategory(): void
    {
        $response = $this->postJson('/api/categories', [
            'code' => 'benz',
            'name' => 'mercedes',
            'description' => 'mercedes benz category'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'code',
                'name',
                'parent_id',
                'description',
            ]
        ]);

        $data = $response->decodeResponseJson();
        $this->assertEquals('mercedes', $data['data']['name']);
        $this->assertDatabaseHas(Category::class, ['id' => $data['data']['id']]);
    }

    public function testDeleteCategory(): void
    {
        $response = $this->deleteJson('/api/categories/1');

        $response->assertStatus(200);
        $data = $response->decodeResponseJson();
        $this->assertEquals('true', $data['status']);
    }
}
