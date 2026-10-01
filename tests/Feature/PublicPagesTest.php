<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_homepage_loads_successfully()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('HUMING INTERNATIONAL LIMITED');
        $response->assertSee('Quality Manufacturing Solutions for Modern Construction');
    }

    public function test_about_page_loads_successfully()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSee('Our Vision');
        $response->assertSee('Our Mission');
    }

    public function test_products_catalog_loads_successfully()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('Marble Sheets');
    }

    public function test_product_detail_page_loads_and_shows_specs()
    {
        $product = Product::published()->first();
        $this->assertNotNull($product);

        $response = $this->get('/products/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_manufacturing_page_loads_successfully()
    {
        $response = $this->get('/manufacturing');
        $response->assertStatus(200);
        $response->assertSee('Raw Material Selection');
    }

    public function test_applications_page_loads_successfully()
    {
        $response = $this->get('/applications');
        $response->assertStatus(200);
        $response->assertSee('Residential Construction');
    }

    public function test_gallery_page_loads_successfully()
    {
        $response = $this->get('/gallery');
        $response->assertStatus(200);
        $response->assertSee('Media Gallery');
    }

    public function test_contact_page_loads_successfully()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Contact Message Form');
    }

    public function test_sitemap_xml_generates_valid_response()
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    }
}
