<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        // Arrange
        $data = [
            'name' => 'Product Name',
            'description' => 'Product desc',
            'price' => 100,
            'category_id' => 1
        ];
    
        // Act
        $response = $this->postJson('/api/addProduct', $data);
    
        // Assert
        $response->assertStatus(200)
            ->assertJson(['success'=>true]);

    }

    public function testUpdateProduct()
    {
        // Arrange
        $data = [
            'id' => \App\Models\Product::first()->id,
            'name' => 'Product Name',
            'description' => 'Product desc',
            'price' => 100,
            'category_id' => 1
        ];
    
        // Act
        $response = $this->postJson('/api/updateProduct', $data);
    
        // Assert
        $response->assertStatus(200)
            ->assertJson(['success'=>true]);

    }

    public function testDeleteProduct()
    {
        // Arrange
        $data = [
            'id' => \App\Models\Product::first()->id,
        ];
    
        // Act
        $response = $this->postJson('/api/deleteProduct', $data);
    
        // Assert
        $response->assertStatus(200)
            ->assertJson(['success'=>true]);

    }
}
