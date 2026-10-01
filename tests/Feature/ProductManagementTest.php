<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->admin = User::where('role', User::ROLE_SUPER_ADMIN)->first();
        $this->category = Category::first();
    }

    public function test_admin_can_view_products_dashboard()
    {
        $response = $this->actingAs($this->admin)->get('/admin/products');
        $response->assertStatus(200);
        $response->assertSee('Product Catalog Management');
    }

    public function test_admin_can_create_product_with_dynamic_specifications()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('marble.jpg');

        $response = $this->actingAs($this->admin)->post('/admin/products', [
            'name' => 'Custom Ultra Wall Panel',
            'category_id' => $this->category->id,
            'short_description' => 'Acoustic architectural board',
            'full_description' => 'Detailed engineering specs',
            'status' => 'published',
            'is_featured' => 1,
            'sort_order' => 1,
            'main_image' => $image,
            'spec_names' => ['Thickness', 'Pressure Rating'],
            'spec_values' => ['12mm', 'PN16'],
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Custom Ultra Wall Panel',
            'category_id' => $this->category->id,
        ]);

        $createdProduct = Product::where('name', 'Custom Ultra Wall Panel')->first();
        $this->assertCount(2, $createdProduct->specifications);
    }

    public function test_admin_can_update_product()
    {
        $product = Product::first();

        $response = $this->actingAs($this->admin)->put('/admin/products/' . $product->id, [
            'name' => 'Updated Product Name',
            'category_id' => $product->category_id,
            'short_description' => 'Updated summary',
            'status' => 'published',
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
        ]);
    }

    public function test_admin_can_delete_product()
    {
        $product = Product::first();

        $response = $this->actingAs($this->admin)->delete('/admin/products/' . $product->id);
        $response->assertRedirect('/admin/products');
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }
}
