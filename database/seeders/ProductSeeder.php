<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::query()->pluck('id', 'slug');

        $products = [
            [
                'category_slug' => 'kopi-lampung',
                'name' => 'Kopi Robusta Lampung',
                'slug' => 'kopi-robusta-lampung',
                'price' => 48000,
                'stock_status' => Product::STATUS_AVAILABLE,
                'description' => 'Kopi Robusta petik merah dari perkebunan Lampung Barat yang disangrai medium-dark untuk menghasilkan cita rasa pekat, body tebal, dan aroma cokelat kacang yang khas. Cocok diseduh tubruk maupun espresso.',
                'badge' => 'Kopi Robusta',
                'palette' => ['#14532D', '#D97706', '#FEF3C7'],
            ],
            [
                'category_slug' => 'kopi-lampung',
                'name' => 'Kopi Bubuk Liwa',
                'slug' => 'kopi-bubuk-liwa',
                'price' => 55000,
                'stock_status' => Product::STATUS_AVAILABLE,
                'description' => 'Kopi bubuk halus khas Liwa dari dataran tinggi sejuk Lampung Barat. Diproses higienis untuk mempertahankan wangi floral-nutty alami tanpa campuran bahan tambahan. Kemasan pouch 250 gram ber-zipper.',
                'badge' => 'Kopi Liwa',
                'palette' => ['#166534', '#92400E', '#ECFDF5'],
            ],
            [
                'category_slug' => 'keripik-dan-camilan',
                'name' => 'Keripik Pisang Cokelat',
                'slug' => 'keripik-pisang-cokelat',
                'price' => 28000,
                'stock_status' => Product::STATUS_AVAILABLE,
                'description' => 'Keripik pisang kepok pilihan yang diiris tipis, digoreng renyah, lalu dibalut taburan bubuk cokelat premium khas oleh-oleh Bandar Lampung. Manis pas, tidak enek, dan renyah tahan lama.',
                'badge' => 'Best Seller',
                'palette' => ['#78350F', '#D97706', '#FFFBEB'],
            ],
            [
                'category_slug' => 'keripik-dan-camilan',
                'name' => 'Keripik Pisang Original',
                'slug' => 'keripik-pisang-original',
                'price' => 24000,
                'stock_status' => Product::STATUS_AVAILABLE,
                'description' => 'Keripik pisang kepok klasik dengan rasa gurih manis alami tanpa pemanis buatan. Camilan renyah favorit keluarga untuk menemani waktu santai bersama kopi atau teh hangat.',
                'badge' => 'Camilan Klasik',
                'palette' => ['#166534', '#CA8A04', '#FEFCE8'],
            ],
            [
                'category_slug' => 'sambal-dan-makanan',
                'name' => 'Sambal Lampung',
                'slug' => 'sambal-lampung',
                'price' => 32000,
                'stock_status' => Product::STATUS_AVAILABLE,
                'description' => 'Sambal khas Lampung bercita rasa pedas segar dengan perpaduan cabai merah segar, bawang, dan rempah pilihan. Dikemas dalam botol kaca tersegel rapi 200 gram, siap menyempurnakan setiap hidangan.',
                'badge' => 'Pedas Autentik',
                'palette' => ['#991B1B', '#D97706', '#FEF2F2'],
            ],
            [
                'category_slug' => 'sambal-dan-makanan',
                'name' => 'Kemplang Panggang Lampung',
                'slug' => 'kemplang-panggang-lampung',
                'price' => 35000,
                'stock_status' => Product::STATUS_AVAILABLE,
                'description' => 'Kerupuk ikan tenggiri asli yang dipanggang di atas bara arang hingga mengembang renyah dan harum smokey, lengkap dengan sambal cocol terasi pedas manis khas pesisir Lampung.',
                'badge' => 'Ikan Tenggiri',
                'palette' => ['#14532D', '#EA580C', '#FFF7ED'],
            ],
            [
                'category_slug' => 'oleh-oleh-khas-lampung',
                'name' => 'Lapis Legit Khas Lampung',
                'slug' => 'lapis-legit-khas-lampung',
                'price' => 145000,
                'stock_status' => Product::STATUS_AVAILABLE,
                'description' => 'Kue lapis legit lembut dengan lapisan tipis keemasan yang dipanggang perlahan menggunakan mentega pilihan dan aroma rempah lembut. Pilihan tepat untuk hantaran spesial dari Lampung.',
                'badge' => 'Premium',
                'palette' => ['#B45309', '#166534', '#FEF3C7'],
            ],
            [
                'category_slug' => 'oleh-oleh-khas-lampung',
                'name' => 'Pie Pisang Lampung',
                'slug' => 'pie-pisang-lampung',
                'price' => 42000,
                'stock_status' => Product::STATUS_SOLD_OUT,
                'description' => 'Kue pie renyah dengan isian selai pisang muli khas Lampung yang lembut dan manis alami, dipadukan topping keju dan cokelat. Isi 8 pcs per kotak.',
                'badge' => 'Edisi Spesial',
                'palette' => ['#166534', '#D97706', '#FAFAF5'],
            ],
            [
                'category_slug' => 'minuman-tradisional',
                'name' => 'Serbat Kweni Lampung',
                'slug' => 'serbat-kweni-lampung',
                'price' => 26000,
                'stock_status' => Product::STATUS_AVAILABLE,
                'description' => 'Minuman segar tradisional khas pesisir Lampung dari perpaduan buah mangga kweni harum, serai, kayu manis, dan gula aren pilihan. Dikemas botol siap saji 350 ml.',
                'badge' => 'Minuman Segar',
                'palette' => ['#166534', '#D97706', '#FFFBEB'],
            ],
        ];

        foreach ($products as $item) {
            $categoryId = $categories[$item['category_slug']] ?? null;
            if (! $categoryId) {
                continue;
            }

            $imagePath = $this->resolveOrCreateProductImage($item);

            Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $categoryId,
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'price' => $item['price'],
                    'description' => $item['description'],
                    'image' => $imagePath,
                    'stock_status' => $item['stock_status'],
                ]
            );
        }
    }

    /**
     * Use an existing raster product image when present, otherwise generate a bespoke SVG illustration.
     *
     * @param  array{slug: string, name: string, badge: string, palette: array{0: string, 1: string, 2: string}}  $item
     */
    private function resolveOrCreateProductImage(array $item): string
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            $candidate = 'products/'.$item['slug'].'.'.$ext;
            if (Storage::disk('public')->exists($candidate)) {
                $svgFallback = 'products/'.$item['slug'].'.svg';
                if (Storage::disk('public')->exists($svgFallback)) {
                    Storage::disk('public')->delete($svgFallback);
                }

                return $candidate;
            }
        }

        $svgPath = 'products/'.$item['slug'].'.svg';
        Storage::disk('public')->put(
            $svgPath,
            $this->buildProductIllustration($item['slug'], $item['name'], $item['badge'], $item['palette'])
        );

        return $svgPath;
    }

    /**
     * Build a bespoke SVG illustration tailored to each seeded product.
     *
     * @param  array{0: string, 1: string, 2: string}  $palette
     */
    private function buildProductIllustration(string $slug, string $title, string $badge, array $palette): string
    {
        [$primary, $accent, $surface] = $palette;
        $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $safeBadge = htmlspecialchars($badge, ENT_QUOTES, 'UTF-8');
        $artwork = $this->buildArtworkBySlug($slug, $primary, $accent);

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" width="800" height="600">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="{$surface}"/>
      <stop offset="100%" stop-color="#FFFFFF"/>
    </linearGradient>
    <radialGradient id="glow" cx="50%" cy="42%" r="48%">
      <stop offset="0%" stop-color="{$accent}" stop-opacity="0.18"/>
      <stop offset="100%" stop-color="{$accent}" stop-opacity="0"/>
    </radialGradient>
  </defs>
  <rect width="800" height="600" fill="url(#bg)"/>
  <circle cx="400" cy="240" r="220" fill="url(#glow)"/>
  <rect x="48" y="48" width="704" height="504" rx="34" fill="#FFFFFF" fill-opacity="0.92" stroke="{$primary}" stroke-opacity="0.14" stroke-width="2"/>
  {$artwork}
  <rect x="290" y="396" width="220" height="36" rx="18" fill="{$accent}" fill-opacity="0.14"/>
  <text x="400" y="420" text-anchor="middle" font-family="Arial, sans-serif" font-size="16" font-weight="700" fill="{$accent}">{$safeBadge}</text>
  <text x="400" y="472" text-anchor="middle" font-family="Arial, sans-serif" font-size="28" font-weight="700" fill="#1C1917">{$safeTitle}</text>
  <text x="400" y="505" text-anchor="middle" font-family="Arial, sans-serif" font-size="15" fill="#57534E">Rasa Lampung • Kuliner &amp; Oleh-Oleh Khas</text>
</svg>
SVG;
    }

    /**
     * Render product-specific vector food artwork for SVG illustrations.
     */
    private function buildArtworkBySlug(string $slug, string $primary, string $accent): string
    {
        return match ($slug) {
            'keripik-pisang-cokelat' => <<<'SVG'
  <ellipse cx="400" cy="336" rx="142" ry="22" fill="#E7E5E4"/>
  <path d="M270 250 Q400 355 530 250 L506 318 Q400 358 294 318 Z" fill="#92400E"/>
  <ellipse cx="400" cy="250" rx="130" ry="26" fill="#B45309"/>
  <ellipse cx="345" cy="232" rx="36" ry="20" transform="rotate(-18 345 232)" fill="#451A03" stroke="#78350F" stroke-width="4"/>
  <ellipse cx="405" cy="218" rx="40" ry="22" transform="rotate(10 405 218)" fill="#5C2606" stroke="#92400E" stroke-width="4"/>
  <ellipse cx="458" cy="234" rx="35" ry="19" transform="rotate(24 458 234)" fill="#3F1703" stroke="#78350F" stroke-width="4"/>
  <ellipse cx="378" cy="252" rx="36" ry="19" transform="rotate(-8 378 252)" fill="#6B2D08" stroke="#D97706" stroke-width="2"/>
  <ellipse cx="430" cy="250" rx="34" ry="18" transform="rotate(14 430 250)" fill="#4A1E04" stroke="#B45309" stroke-width="2"/>
  <path d="M240 282 C210 230, 232 185, 278 190 C268 225, 272 258, 286 286 Z" fill="#166534" opacity="0.88"/>
SVG,
            'sambal-lampung' => <<<'SVG'
  <ellipse cx="400" cy="346" rx="130" ry="18" fill="#E7E5E4"/>
  <rect x="330" y="160" width="140" height="175" rx="28" fill="#DC2626" stroke="#991B1B" stroke-width="4"/>
  <rect x="342" y="180" width="22" height="132" rx="11" fill="#FFFFFF" opacity="0.22"/>
  <rect x="342" y="130" width="116" height="32" rx="10" fill="#D97706"/>
  <rect x="352" y="218" width="96" height="62" rx="12" fill="#FAFAF5"/>
  <text x="400" y="246" text-anchor="middle" font-family="Arial, sans-serif" font-size="14" font-weight="700" fill="#991B1B">SAMBAL</text>
  <text x="400" y="266" text-anchor="middle" font-family="Arial, sans-serif" font-size="13" font-weight="700" fill="#166534">LAMPUNG</text>
  <path d="M250 326 C265 292, 308 292, 314 334 C290 342, 265 340, 250 326 Z" fill="#B91C1C"/>
  <path d="M492 328 C508 295, 545 298, 548 334 C526 344, 504 342, 492 328 Z" fill="#DC2626"/>
  <path d="M244 318 C236 306, 240 296, 250 294" stroke="#166534" stroke-width="5" stroke-linecap="round" fill="none"/>
SVG,
            'kemplang-panggang-lampung' => <<<'SVG'
  <ellipse cx="400" cy="342" rx="160" ry="20" fill="#E7E5E4"/>
  <ellipse cx="388" cy="272" rx="135" ry="62" fill="#166534" opacity="0.9"/>
  <ellipse cx="355" cy="250" rx="52" ry="38" transform="rotate(-12 355 250)" fill="#FEF3C7" stroke="#D97706" stroke-width="4"/>
  <ellipse cx="422" cy="236" rx="54" ry="40" transform="rotate(14 422 236)" fill="#FDE68A" stroke="#D97706" stroke-width="4"/>
  <ellipse cx="385" cy="280" rx="50" ry="36" fill="#FFFBEB" stroke="#B45309" stroke-width="4"/>
  <circle cx="348" cy="245" r="5" fill="#92400E" opacity="0.45"/>
  <circle cx="430" cy="235" r="6" fill="#92400E" opacity="0.4"/>
  <circle cx="395" cy="284" r="5" fill="#92400E" opacity="0.4"/>
  <path d="M475 282 Q515 335 555 282 Z" fill="#FFFFFF" stroke="#D6D3D1" stroke-width="3"/>
  <ellipse cx="515" cy="282" rx="40" ry="12" fill="#DC2626"/>
SVG,
            'lapis-legit-khas-lampung' => <<<'SVG'
  <ellipse cx="400" cy="344" rx="150" ry="20" fill="#E7E5E4"/>
  <polygon points="278,312 522,312 544,334 256,334" fill="#F5F5F4" stroke="#D6D3D1" stroke-width="2"/>
  <rect x="305" y="180" width="190" height="132" rx="14" fill="#FDE68A" stroke="#92400E" stroke-width="3"/>
  <rect x="307" y="180" width="186" height="16" rx="6" fill="#92400E"/>
  <line x1="307" y1="210" x2="493" y2="210" stroke="#B45309" stroke-width="5"/>
  <line x1="307" y1="228" x2="493" y2="228" stroke="#D97706" stroke-width="5"/>
  <line x1="307" y1="246" x2="493" y2="246" stroke="#92400E" stroke-width="5"/>
  <line x1="307" y1="264" x2="493" y2="264" stroke="#D97706" stroke-width="5"/>
  <line x1="307" y1="282" x2="493" y2="282" stroke="#B45309" stroke-width="5"/>
  <line x1="307" y1="300" x2="493" y2="300" stroke="#92400E" stroke-width="5"/>
SVG,
            'pie-pisang-lampung' => <<<'SVG'
  <ellipse cx="400" cy="344" rx="154" ry="20" fill="#E7E5E4"/>
  <ellipse cx="400" cy="322" rx="144" ry="26" fill="#FFFFFF" stroke="#D6D3D1" stroke-width="3"/>
  <path d="M292 252 Q400 320 508 252 L488 308 Q400 335 312 308 Z" fill="#D97706"/>
  <ellipse cx="400" cy="248" rx="112" ry="44" fill="#FBBF24" stroke="#B45309" stroke-width="4"/>
  <ellipse cx="400" cy="246" rx="88" ry="30" fill="#FEF08A"/>
  <path d="M335 242 C360 226, 390 258, 418 238 C438 225, 455 248, 466 244" stroke="#78350F" stroke-width="6" stroke-linecap="round" fill="none"/>
  <rect x="355" y="232" width="24" height="8" rx="3" transform="rotate(-14 355 232)" fill="#FDE047"/>
  <rect x="415" y="244" width="24" height="8" rx="3" transform="rotate(18 415 244)" fill="#FDE047"/>
SVG,
            'serbat-kweni-lampung' => <<<'SVG'
  <ellipse cx="400" cy="346" rx="126" ry="18" fill="#E7E5E4"/>
  <rect x="350" y="160" width="100" height="175" rx="22" fill="#F59E0B" stroke="#B45309" stroke-width="4"/>
  <rect x="372" y="128" width="56" height="34" rx="8" fill="#166534"/>
  <rect x="364" y="176" width="16" height="140" rx="8" fill="#FFFFFF" opacity="0.28"/>
  <rect x="360" y="218" width="80" height="58" rx="10" fill="#FAFAF5"/>
  <text x="400" y="244" text-anchor="middle" font-family="Arial, sans-serif" font-size="13" font-weight="700" fill="#166534">SERBAT</text>
  <text x="400" y="262" text-anchor="middle" font-family="Arial, sans-serif" font-size="12" font-weight="700" fill="#D97706">KWENI</text>
  <circle cx="485" cy="316" r="28" fill="#FBBF24" stroke="#D97706" stroke-width="3"/>
  <path d="M475 288 C478 272, 496 270, 502 282" stroke="#166534" stroke-width="5" stroke-linecap="round" fill="none"/>
SVG,
            default => <<<SVG
  <rect x="280" y="132" width="240" height="220" rx="28" fill="{$primary}"/>
  <circle cx="400" cy="242" r="56" fill="{$accent}"/>
SVG,
        };
    }
}
