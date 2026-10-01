<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5120'],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        $path = $request->file('image')->store('products/gallery', 'public');
        $maxOrder = $product->images()->max('sort_order') ?? 0;

        $image = ProductImage::create([
            'product_id' => $product->id,
            'image' => $path,
            'alt_text' => $request->input('alt_text'),
            'sort_order' => $maxOrder + 1,
            'is_primary' => false,
        ]);

        return back()->with('success', 'Image uploaded successfully.');
    }

    public function destroy(ProductImage $image)
    {
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    public function setPrimary(ProductImage $image)
    {
        ProductImage::where('product_id', $image->product_id)->update(['is_primary' => false]);
        $image->is_primary = true;
        $image->save();

        // Also update main_image on product
        $image->product->update(['main_image' => $image->image]);

        return back()->with('success', 'Primary image updated.');
    }
}
