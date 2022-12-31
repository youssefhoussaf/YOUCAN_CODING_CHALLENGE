<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testCreateCategory()
    {
        // Arrange
        $data = [
            'name' => 'Category Name'
        ];
    
        // Act
        $response = $this->postJson('/api/addCategory', $data);
    
        // Assert
        $response->assertStatus(200)
            ->assertJson(['success'=>true]);

    }

    public function testUpdateCategory()
    {
        // Arrange
        $data = [
            'id' => \App\Models\Category::first()->id,
            'name' => 'Category Name'
        ];
    
        // Act
        $response = $this->postJson('/api/updateCategory', $data);
    
        // Assert
        $response->assertStatus(200)
            ->assertJson(['success'=>true]);

    }
}
