<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RasaLampungTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(): User
    {
        return User::create([
            'name' => 'Admin Test',
            'email' => 'admin@rasalampung.test',
            'password' => Hash::make('secret123'),
        ]);
    }

    private function fakePngUpload(string $filename = 'produk.png'): UploadedFile
    {
        // Valid 1x1 transparent PNG binary so Laravel's `image` & `mimes` rules pass without requiring ext-gd
        $pngBytes = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='
        );

        return UploadedFile::fake()->createWithContent($filename, $pngBytes);
    }

    public function test_public_pages_render_database_content_correctly(): void
    {
        $category = Category::create([
            'name' => 'Kopi Lampung',
            'slug' => 'kopi-lampung',
            'description' => 'Kopi khas Lampung',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Kopi Robusta Lampung',
            'slug' => 'kopi-robusta-lampung',
            'price' => 48000,
            'description' => 'Kopi robusta petik merah pilihan.',
            'stock_status' => Product::STATUS_AVAILABLE,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Kenali Cita Rasa Khas Lampung')
            ->assertSee('Kopi Robusta Lampung')
            ->assertSee('Kopi Lampung');

        $this->get('/produk')
            ->assertOk()
            ->assertSee('Kopi Robusta Lampung');

        $this->get('/produk?kategori=kopi-lampung&cari=Robusta')
            ->assertOk()
            ->assertSee('Kopi Robusta Lampung');

        $this->get('/produk/'.$product->slug)
            ->assertOk()
            ->assertSee('Kopi Robusta Lampung')
            ->assertSee('Rp 48.000');

        $this->get('/produk/'.$product->id)
            ->assertOk()
            ->assertSee('Kopi Robusta Lampung');

        $this->get('/tentang')
            ->assertOk()
            ->assertSee('Tentang Rasa Lampung')
            ->assertSee('Jl. Raden Intan No. 88');
    }

    public function test_eloquent_relationships_between_category_and_product(): void
    {
        $category = Category::create([
            'name' => 'Keripik dan Camilan',
            'slug' => 'keripik-dan-camilan',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Keripik Pisang Cokelat',
            'slug' => 'keripik-pisang-cokelat',
            'price' => 28000,
            'description' => 'Keripik pisang renyah berbalut cokelat.',
            'stock_status' => Product::STATUS_AVAILABLE,
        ]);

        $this->assertTrue($product->category->is($category));
        $this->assertCount(1, $category->products);
    }

    public function test_admin_routes_require_authentication_and_login_logout_works(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
        $this->get('/admin/products')->assertRedirect('/login');
        $this->get('/admin/categories')->assertRedirect('/login');

        $admin = $this->createAdmin();

        $this->post('/login', [
            'email' => 'not-an-email',
            'password' => '',
        ])->assertSessionHasErrors(['email', 'password']);

        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'wrong-password',
        ])->assertSessionHasErrors(['email']);

        // Intended URL from prior unauthenticated /admin/categories visit
        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'secret123',
        ])->assertRedirect('/admin/categories');

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertSee('Dashboard Ringkasan');

        $this->actingAs($admin)
            ->get('/admin/products/create')
            ->assertOk()
            ->assertSee('Formulir Produk Baru');

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();

        // Direct login without prior intended URL goes to /admin/dashboard
        $this->get('/login')->assertOk();
        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'secret123',
        ])->assertRedirect('/admin/dashboard');
    }

    public function test_admin_can_crud_product_with_image_upload_replacement_and_deletion(): void
    {
        Storage::fake('public');
        $admin = $this->createAdmin();
        $category = Category::create([
            'name' => 'Sambal dan Makanan',
            'slug' => 'sambal-dan-makanan',
        ]);

        // Validation check
        $this->actingAs($admin)
            ->post('/admin/products', [
                'name' => '',
                'price' => 0,
                'stock_status' => 'invalid',
            ])
            ->assertSessionHasErrors(['name', 'category_id', 'price', 'description', 'stock_status']);

        // Create with image
        $this->actingAs($admin)
            ->post('/admin/products', [
                'name' => 'Sambal Lampung Spesial',
                'category_id' => $category->id,
                'price' => 35000,
                'description' => 'Sambal pedas khas Lampung dalam kemasan botol kaca.',
                'stock_status' => 'available',
                'image' => $this->fakePngUpload('sambal-1.png'),
            ])
            ->assertRedirect('/admin/products');

        $product = Product::where('name', 'Sambal Lampung Spesial')->firstOrFail();
        $firstImagePath = $product->image;
        $this->assertNotNull($firstImagePath);
        $this->assertStringStartsWith('products/', $firstImagePath);
        Storage::disk('public')->assertExists($firstImagePath);

        // Update & replace image
        $this->actingAs($admin)
            ->put('/admin/products/'.$product->id, [
                'name' => 'Sambal Lampung Pedas Mantap',
                'category_id' => $category->id,
                'price' => 38000,
                'description' => 'Varian ekstra pedas.',
                'stock_status' => 'sold_out',
                'image' => $this->fakePngUpload('sambal-2.png'),
            ])
            ->assertRedirect('/admin/products');

        $product->refresh();
        $secondImagePath = $product->image;
        $this->assertNotSame($firstImagePath, $secondImagePath);
        Storage::disk('public')->assertMissing($firstImagePath);
        Storage::disk('public')->assertExists($secondImagePath);
        $this->assertSame('sold_out', $product->stock_status);

        // Delete product & image
        $this->actingAs($admin)
            ->delete('/admin/products/'.$product->id)
            ->assertRedirect('/admin/products');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing($secondImagePath);
    }

    public function test_admin_category_crud_and_delete_protection_when_used_by_products(): void
    {
        $admin = $this->createAdmin();

        $this->actingAs($admin)
            ->post('/admin/categories', [
                'name' => 'Minuman Herbal',
                'description' => 'Minuman rempah tradisional.',
            ])
            ->assertRedirect('/admin/categories');

        $category = Category::where('name', 'Minuman Herbal')->firstOrFail();

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Wedang Jahe Lampung',
            'slug' => 'wedang-jahe-lampung',
            'price' => 25000,
            'description' => 'Minuman hangat jahe merah.',
            'stock_status' => 'available',
        ]);

        // Cannot delete while in use
        $this->actingAs($admin)
            ->delete('/admin/categories/'.$category->id)
            ->assertRedirect('/admin/categories')
            ->assertSessionHas('error');

        $this->assertDatabaseHas('categories', ['id' => $category->id]);

        // Update category
        $this->actingAs($admin)
            ->put('/admin/categories/'.$category->id, [
                'name' => 'Minuman Tradisional Lampung',
                'description' => 'Aneka minuman khas daerah.',
            ])
            ->assertRedirect('/admin/categories');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Minuman Tradisional Lampung',
        ]);

        // Remove product then delete category
        $product->delete();

        $this->actingAs($admin)
            ->delete('/admin/categories/'.$category->id)
            ->assertRedirect('/admin/categories')
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
