<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\QuoteRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class QuoteSubmissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_visitor_can_submit_quotation_request_with_attachment()
    {
        Storage::fake('public');

        $product = Product::first();
        $file = UploadedFile::fake()->create('bill_of_quantities.pdf', 500, 'application/pdf');

        $response = $this->post('/quote', [
            'full_name' => 'Michael Contractor',
            'company_name' => 'Buildcorp Estates Ltd',
            'email' => 'michael@buildcorp.com',
            'phone' => '+254712345678',
            'country' => 'Kenya',
            'location' => 'Mombasa Port Road',
            'product_id' => $product->id,
            'quantity' => 250,
            'preferred_unit' => 'Pieces / Units',
            'message' => 'Please provide bulk discount for commercial housing project.',
            'preferred_contact_method' => 'Email',
            'attachment' => $file,
        ]);

        $this->assertDatabaseHas('quote_requests', [
            'full_name' => 'Michael Contractor',
            'email' => 'michael@buildcorp.com',
            'product_id' => $product->id,
        ]);

        $quote = QuoteRequest::where('email', 'michael@buildcorp.com')->first();
        $this->assertNotNull($quote->quote_number);
        $response->assertRedirect(route('quote.success', ['quote_number' => $quote->quote_number]));
    }

    public function test_visitor_can_submit_contact_message()
    {
        $response = $this->post('/contact', [
            'name' => 'David Kim',
            'email' => 'david@architects.com',
            'phone' => '+254722000111',
            'subject' => 'Architectural Catalog Request',
            'message' => 'We are specifying wall panels for a 5-star hotel.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'David Kim',
            'email' => 'david@architects.com',
        ]);
    }
}
