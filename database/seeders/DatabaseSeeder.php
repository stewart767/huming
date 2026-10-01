<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Category;
use App\Models\CompanyValue;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\HomepageFeature;
use App\Models\HomepageSlide;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use App\Models\ProductionProcess;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        User::updateOrCreate(
            ['email' => 'admin@huming.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SUPER_ADMIN,
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'content@huming.com'],
            [
                'name' => 'Content Manager',
                'password' => Hash::make('password'),
                'role' => User::ROLE_CONTENT_MANAGER,
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'sales@huming.com'],
            [
                'name' => 'Sales & Quotation Manager',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SALES_MANAGER,
                'is_active' => true,
            ]
        );

        // 2. Settings
        $settings = [
            // General
            ['key' => 'company_name', 'value' => 'HUMING INTERNATIONAL LIMITED', 'group' => 'general', 'label' => 'Company Name'],
            ['key' => 'company_tagline', 'value' => 'Manufacturing Quality. Building the Future.', 'group' => 'general', 'label' => 'Company Tagline / Slogan'],
            ['key' => 'site_description', 'value' => 'Huming International Limited is a leading manufacturing and supply company specializing in marble sheets, wall panels, PVC sealing, flash tanks, PVC pipes, and modern building materials.', 'group' => 'general', 'label' => 'Site Meta Description'],
            ['key' => 'logo', 'value' => null, 'group' => 'branding', 'label' => 'Company Logo', 'type' => 'image'],
            ['key' => 'favicon', 'value' => null, 'group' => 'branding', 'label' => 'Favicon', 'type' => 'image'],

            // Contact
            ['key' => 'company_email', 'value' => 'info@huminginternational.com', 'group' => 'contact', 'label' => 'Primary Email Address'],
            ['key' => 'quote_notification_email', 'value' => 'quotes@huminginternational.com', 'group' => 'contact', 'label' => 'Quote Notification Email'],
            ['key' => 'company_phone', 'value' => '+254 700 000 000', 'group' => 'contact', 'label' => 'Primary Phone Number'],
            ['key' => 'company_whatsapp', 'value' => '+254700000000', 'group' => 'contact', 'label' => 'WhatsApp Number (with country code)'],
            ['key' => 'company_address', 'value' => 'Industrial Area, Commercial Street, Nairobi, Kenya', 'group' => 'contact', 'label' => 'Physical Address'],
            ['key' => 'working_hours', 'value' => 'Monday – Friday: 8:00 AM – 5:00 PM | Saturday: 8:30 AM – 1:00 PM', 'group' => 'contact', 'label' => 'Working Hours'],
            ['key' => 'google_maps_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127642.06201625902!2d36.7584185!3d-1.2920659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1172d84d49a7%3A0xf7cf0254b297924c!2sNairobi%2C%20Kenya!5e0!3m2!1sen!2s!4v1650000000000', 'group' => 'contact', 'label' => 'Google Maps Embed URL'],

            // Social
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/huminginternational', 'group' => 'social', 'label' => 'Facebook URL'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/huminginternational', 'group' => 'social', 'label' => 'Instagram URL'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/huminginternational', 'group' => 'social', 'label' => 'LinkedIn URL'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@huminginternational', 'group' => 'social', 'label' => 'YouTube URL'],

            // About
            ['key' => 'about_short', 'value' => 'Huming International Limited is a premier manufacturing and supply company delivering high-standard construction, interior finishing, plumbing, and architectural building solutions engineered for longevity and aesthetic excellence.', 'group' => 'about', 'label' => 'Short About Summary'],
            ['key' => 'company_overview', 'value' => 'Huming International Limited is an industrial manufacturing and supply company dedicated to engineering and distributing superior building, finishing, and plumbing materials. With modern production facilities and rigorous quality control protocols, we supply contractors, developers, architects, and commercial distributors with dependable products engineered to meet international building standards.', 'group' => 'about', 'label' => 'Company Overview'],
            ['key' => 'company_vision', 'value' => 'To be the most trusted manufacturing and building solutions partner across Africa and global markets, recognized for precision engineering, sustainable manufacturing, and unmatched product durability.', 'group' => 'about', 'label' => 'Company Vision'],
            ['key' => 'company_mission', 'value' => 'To manufacture and supply world-class construction, finishing, and plumbing solutions that enhance structural integrity, aesthetic elegance, and long-term value for our clients and communities.', 'group' => 'about', 'label' => 'Company Mission'],
            ['key' => 'footer_about', 'value' => 'HUMING INTERNATIONAL LIMITED is a manufacturing and supply company providing high-grade building materials, interior finishing panels, PVC systems, and plumbing products for modern construction.', 'group' => 'about', 'label' => 'Footer Description'],
            ['key' => 'manufacturing_overview', 'value' => 'Our manufacturing operations integrate advanced processing lines, high-grade polymer and composite formulations, and stringent quality assurance frameworks to guarantee peak performance in every product delivered.', 'group' => 'about', 'label' => 'Manufacturing Overview'],
            ['key' => 'quality_control_text', 'value' => 'Every production batch undergoes comprehensive physical testing, dimensional calibration, load and pressure validation, and aesthetic inspection before packaging and dispatch.', 'group' => 'about', 'label' => 'Quality Control Policy'],

            // Optional statistics (only real numbers when provided, otherwise editable)
            ['key' => 'show_statistics', 'value' => '1', 'group' => 'stats', 'label' => 'Display Statistics on Homepage'],
            ['key' => 'stat_experience', 'value' => '10+', 'group' => 'stats', 'label' => 'Years of Experience'],
            ['key' => 'stat_products', 'value' => '50+', 'group' => 'stats', 'label' => 'Product Variants'],
            ['key' => 'stat_projects', 'value' => '500+', 'group' => 'stats', 'label' => 'Commercial Projects Supplied'],
            ['key' => 'stat_capacity', 'value' => '100%', 'group' => 'stats', 'label' => 'Quality Tested'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(
                ['key' => $s['key']],
                [
                    'value' => $s['value'],
                    'group' => $s['group'] ?? 'general',
                    'label' => $s['label'] ?? ucwords(str_replace('_', ' ', $s['key'])),
                    'type' => $s['type'] ?? 'text',
                ]
            );
        }

        // 3. Homepage Slides
        HomepageSlide::truncate();
        HomepageSlide::create([
            'badge_text' => 'INDUSTRIAL MANUFACTURING EXCELLENCE',
            'title' => 'Quality Manufacturing Solutions for Modern Construction',
            'subtitle' => 'Reliable building, finishing and plumbing products manufactured and supplied for modern construction, architectural design, and industrial development.',
            'image' => 'images/hero/hero-1.jpg',
            'button_text' => 'Explore Products',
            'button_url' => '/products',
            'secondary_button_text' => 'Request a Quote',
            'secondary_button_url' => '/quote',
            'status' => true,
            'sort_order' => 1,
        ]);

        HomepageSlide::create([
            'badge_text' => 'PRECISION INTERIOR & EXTERIOR FINISHING',
            'title' => 'Premium Marble Sheets & Acoustic Wall Panels',
            'subtitle' => 'Elevate commercial and residential interiors with ultra-durable UV-coated marble sheets and precision-grooved decorative wall panels.',
            'image' => 'images/hero/hero-2.jpg',
            'button_text' => 'View Marble & Panels',
            'button_url' => '/products?category=marble-sheets',
            'secondary_button_text' => 'Contact Sales',
            'secondary_button_url' => '/contact',
            'status' => true,
            'sort_order' => 2,
        ]);

        HomepageSlide::create([
            'badge_text' => 'HIGH-PERFORMANCE PLUMBING SYSTEMS',
            'title' => 'Certified PVC Pipes, Sealing Solutions & Flash Tanks',
            'subtitle' => 'High-pressure rated PVC plumbing pipes, heavy-duty flash tanks, and industrial watertight PVC sealing systems engineered for extreme longevity.',
            'image' => 'images/hero/hero-3.jpg',
            'button_text' => 'Explore Plumbing Range',
            'button_url' => '/products?category=pvc-pipes',
            'secondary_button_text' => 'Request Bulk Quotation',
            'secondary_button_url' => '/quote',
            'status' => true,
            'sort_order' => 3,
        ]);

        // 4. Initial Categories
        $categoriesData = [
            [
                'name' => 'Marble Sheets',
                'slug' => 'marble-sheets',
                'description' => 'High-gloss UV marble sheets offering luxurious stone aesthetics, high impact resistance, waterproof properties, and lightweight installation for walls, countertops, and luxury interiors.',
                'sort_order' => 1,
                'seo_title' => 'UV Marble Sheets Manufacturing & Supply | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'Discover premium UV coated marble sheets for residential and commercial wall cladding, luxury interior decoration, and moisture-resistant surfaces.',
            ],
            [
                'name' => 'Wall Panels',
                'slug' => 'wall-panels',
                'description' => 'Engineered decorative and acoustic wall panel systems designed for contemporary architectural aesthetics, thermal insulation, and seamless modular mounting.',
                'sort_order' => 2,
                'seo_title' => 'Decorative Wall Panels | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'High-durability fluted and decorative wall panels manufactured for hotels, residential developments, and commercial office interiors.',
            ],
            [
                'name' => 'PVC Sealing',
                'slug' => 'pvc-sealing',
                'description' => 'Engineered PVC waterproof sealing strips, expansion joint profiles, and elastomeric seals engineered to prevent leaks and moisture ingress in structural joints.',
                'sort_order' => 3,
                'seo_title' => 'PVC Sealing Profiles & Waterproof Strips | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'Industrial-grade PVC sealing solutions for waterproofing construction joints, wet areas, doors, and industrial plumbing interfaces.',
            ],
            [
                'name' => 'Flash Tanks',
                'slug' => 'flash-tanks',
                'description' => 'Heavy-duty pressurized and gravity drainage flash tanks engineered for hydraulic efficiency, pressure equalization, and rapid waste evacuation in plumbing networks.',
                'sort_order' => 4,
                'seo_title' => 'Flash Tanks & Pressure Equalization Systems | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'Precision manufactured plumbing flash tanks for commercial, industrial, and high-rise sanitary systems.',
            ],
            [
                'name' => 'PVC Pipes',
                'slug' => 'pvc-pipes',
                'description' => 'Premium unplasticized and chlorinated PVC pipes manufactured to exacting dimensional standards for potable water supply, drainage, conduit, and civil infrastructure.',
                'sort_order' => 5,
                'seo_title' => 'High-Pressure PVC Pipes & Conduit Systems | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'Certified PVC pipes engineered for high pressure ratings, corrosion immunity, smooth fluid dynamics, and extreme lifespan.',
            ],
        ];

        $categoryModels = [];
        foreach ($categoriesData as $cData) {
            $cat = Category::updateOrCreate(
                ['slug' => $cData['slug']],
                $cData
            );
            $categoryModels[$cData['slug']] = $cat;
        }

        // 5. Applications
        $applicationsData = [
            [
                'title' => 'Residential Construction',
                'slug' => 'residential-construction',
                'description' => 'Durable plumbing, elegant wall claddings, and robust sealing systems for private villas, housing estates, and apartment complexes.',
                'icon' => 'home',
                'sort_order' => 1,
            ],
            [
                'title' => 'Commercial Buildings',
                'slug' => 'commercial-buildings',
                'description' => 'High-traffic resistant interior wall panels, plumbing infrastructure, and heavy-duty flash tanks for high-rise offices and towers.',
                'icon' => 'building-office-2',
                'sort_order' => 2,
            ],
            [
                'title' => 'Interior Decoration & Finishing',
                'slug' => 'interior-decoration',
                'description' => 'Luxurious UV marble sheets and fluted panels transforming living rooms, corporate boardrooms, lobbies, and accent feature walls.',
                'icon' => 'sparkles',
                'sort_order' => 3,
            ],
            [
                'title' => 'Plumbing & Drainage Infrastructure',
                'slug' => 'plumbing-infrastructure',
                'description' => 'Corrosion-proof PVC piping, pressure-rated manifolds, and industrial watertight PVC sealing for complete water distribution.',
                'icon' => 'wrench-screwdriver',
                'sort_order' => 4,
            ],
            [
                'title' => 'Hotels & Hospitality Spaces',
                'slug' => 'hospitality-hotels',
                'description' => 'Waterproof, mold-resistant marble sheeting and sound-dampening wall panels tailored for guest rooms, luxury suites, and reception lounges.',
                'icon' => 'building-storefront',
                'sort_order' => 5,
            ],
            [
                'title' => 'Retail & Shopping Complexes',
                'slug' => 'retail-spaces',
                'description' => 'Impact-resistant cladding materials and fast-installation modular wall systems for modern retail brand displays.',
                'icon' => 'shopping-bag',
                'sort_order' => 6,
            ],
            [
                'title' => 'Industrial & Manufacturing Facilities',
                'slug' => 'industrial-applications',
                'description' => 'Heavy chemical-resistant PVC piping networks, expansion joint seals, and high-capacity flash tank systems.',
                'icon' => 'cog-6-tooth',
                'sort_order' => 7,
            ],
            [
                'title' => 'Property Development & Estates',
                'slug' => 'property-development',
                'description' => 'Bulk supply of certified building materials for large-scale urban infrastructure and master-planned community developments.',
                'icon' => 'squares-2x2',
                'sort_order' => 8,
            ],
        ];

        $appModels = [];
        foreach ($applicationsData as $aData) {
            $app = Application::updateOrCreate(
                ['slug' => $aData['slug']],
                $aData
            );
            $appModels[$aData['slug']] = $app;
        }

        // 6. Products with dynamic specifications
        $productsData = [
            // Marble Sheets
            [
                'category' => 'marble-sheets',
                'name' => 'High-Gloss UV Marble Sheet (Calacatta Gold)',
                'slug' => 'high-gloss-uv-marble-sheet-calacatta-gold',
                'short_description' => 'Ultra-realistic Calacatta gold marble texture with mirror-finish UV topcoat, 100% waterproof and fire-retardant.',
                'full_description' => 'Our High-Gloss UV Marble Sheets are manufactured using advanced PVC-calcium composite extrusion and multi-layer UV curing technology. They replicate the opulent aesthetics of natural Calacatta marble while offering significantly lower installation costs, superior impact resistance, zero moisture absorption, and effortless maintenance.',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'seo_title' => 'UV Marble Sheet Calacatta Gold | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'Buy wholesale UV coated faux marble sheets in Calacatta Gold design. Fire-retardant, waterproof, and ideal for luxury walls.',
                'seo_keywords' => 'marble sheets, UV marble, PVC marble wall sheet, Calacatta gold, interior wall cladding',
                'specs' => [
                    ['name' => 'Standard Dimensions', 'value' => '1220mm × 2440mm (4ft × 8ft)'],
                    ['name' => 'Thickness', 'value' => '2.8mm / 3.0mm / 3.8mm'],
                    ['name' => 'Surface Finish', 'value' => 'High-Gloss Multi-Layer UV Coating'],
                    ['name' => 'Core Material', 'value' => 'PVC + Natural Stone Powder Composite'],
                    ['name' => 'Pattern Design', 'value' => 'Calacatta Gold Bookmatched Pattern'],
                    ['name' => 'Fire Rating', 'value' => 'Class B1 Flame Retardant'],
                    ['name' => 'Waterproof Rating', 'value' => '100% Moisture & Mold Proof'],
                    ['name' => 'Installation Method', 'value' => 'Structural Adhesive / Aluminum Trim Profiles'],
                ],
                'apps' => ['residential-construction', 'commercial-buildings', 'interior-decoration', 'hospitality-hotels', 'retail-spaces'],
            ],
            [
                'category' => 'marble-sheets',
                'name' => 'Statuario White UV Composite Marble Sheet',
                'slug' => 'statuario-white-uv-composite-marble-sheet',
                'short_description' => 'Timeless Statuario white stone veins on pure background with scratch-resistant protective sealant.',
                'full_description' => 'Engineered for high-end residential accent walls, elevator surrounds, commercial lobbies, and bathroom wall claddings. Features exceptional flexibility, zero porosity, and resistance to household chemicals and cleaning agents.',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 2,
                'specs' => [
                    ['name' => 'Dimensions', 'value' => '1220mm × 2800mm / 1220mm × 2440mm'],
                    ['name' => 'Thickness', 'value' => '3.0mm'],
                    ['name' => 'Surface Treatment', 'value' => 'UV Polyurethane Anti-Scratch Finish'],
                    ['name' => 'Density', 'value' => '1.95 - 2.05 g/cm³'],
                    ['name' => 'Color / Veining', 'value' => 'Statuario Classic Grey & White'],
                    ['name' => 'Flexural Strength', 'value' => '≥ 35 MPa'],
                ],
                'apps' => ['interior-decoration', 'hospitality-hotels', 'residential-construction'],
            ],

            // Wall Panels
            [
                'category' => 'wall-panels',
                'name' => 'Acoustic Fluted WPC Interior Wall Panel',
                'slug' => 'acoustic-fluted-wpc-interior-wall-panel',
                'short_description' => 'Modern vertical slat fluted wall panel delivering architectural depth, sound dampening, and woodgrain texture.',
                'full_description' => 'Our fluted Wood-Plastic Composite (WPC) wall panels combine natural wood aesthetics with the weatherability and longevity of advanced polymers. Perfect for TV feature walls, bed headboards, office acoustic partitions, and commercial accent walls.',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'seo_title' => 'Fluted WPC Wall Panels | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'Premium tongue-and-groove fluted WPC wall panels for architectural interiors and modern decorative feature walls.',
                'seo_keywords' => 'fluted wall panel, WPC wall cladding, decorative interior panels, slatted wood panel',
                'specs' => [
                    ['name' => 'Panel Width', 'value' => '160mm / 200mm'],
                    ['name' => 'Standard Length', 'value' => '2900mm (Custom lengths available)'],
                    ['name' => 'Overall Thickness', 'value' => '18mm / 24mm'],
                    ['name' => 'Interlocking System', 'value' => 'Precision Tongue and Groove Joint'],
                    ['name' => 'Available Finishes', 'value' => 'Natural Oak, Walnut, Teak, Charcoal Grey, Pure White'],
                    ['name' => 'Termite & Rot Resistance', 'value' => '100% Resistant'],
                ],
                'apps' => ['commercial-buildings', 'interior-decoration', 'hospitality-hotels', 'residential-construction'],
            ],
            [
                'category' => 'wall-panels',
                'name' => 'Modular Integrated Decorative PVC Wall Board',
                'slug' => 'modular-integrated-decorative-pvc-wall-board',
                'short_description' => 'Seamless interlocking hollow-core PVC wall and ceiling board with embossed textured foil.',
                'full_description' => 'Lightweight, rapid-fit wall and ceiling panel engineered with internal structural ribs for thermal and acoustic dampening. Ideal for bathrooms, kitchens, basement conversions, and commercial clinics.',
                'is_featured' => false,
                'status' => 'published',
                'sort_order' => 2,
                'specs' => [
                    ['name' => 'Effective Width', 'value' => '300mm / 400mm / 600mm'],
                    ['name' => 'Length', 'value' => '2800mm / 3000mm'],
                    ['name' => 'Core Structure', 'value' => 'Hollow Cellular Insulating Core'],
                    ['name' => 'Thickness', 'value' => '9mm'],
                    ['name' => 'Thermal Conductivity', 'value' => '0.068 W/(m·K)'],
                ],
                'apps' => ['residential-construction', 'commercial-buildings'],
            ],

            // PVC Sealing
            [
                'category' => 'pvc-sealing',
                'name' => 'Industrial Watertight PVC Sealing Strip Profile',
                'slug' => 'industrial-watertight-pvc-sealing-strip-profile',
                'short_description' => 'Flexible UV-stabilized PVC sealing profile engineered for expansion joints, wet areas, and building envelopes.',
                'full_description' => 'Manufactured with high-elasticity virgin polyvinyl chloride and weather-resistant plasticizers. Provides complete imperviousness against pressurized water, ozone degradation, chemical splashes, and thermal movement.',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'seo_title' => 'PVC Waterproof Sealing Strips | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'Industrial watertight PVC sealing profiles and expansion gaskets for structural waterproofing and plumbing interfaces.',
                'seo_keywords' => 'PVC sealing strip, waterproof PVC profile, expansion joint seal, building waterproofing',
                'specs' => [
                    ['name' => 'Profile Width', 'value' => '20mm – 150mm'],
                    ['name' => 'Elongation at Break', 'value' => '≥ 300%'],
                    ['name' => 'Shore Hardness', 'value' => '65 - 75 Shore A'],
                    ['name' => 'Working Temperature', 'value' => '-25°C to +75°C'],
                    ['name' => 'Packaging', 'value' => '25m / 50m Continuous Rolls'],
                    ['name' => 'Color Options', 'value' => 'Black, White, Translucent, Grey'],
                ],
                'apps' => ['plumbing-infrastructure', 'residential-construction', 'commercial-buildings', 'industrial-applications'],
            ],

            // Flash Tanks
            [
                'category' => 'flash-tanks',
                'name' => 'Heavy-Duty Hydraulic Flash Evacuation Tank',
                'slug' => 'heavy-duty-hydraulic-flash-evacuation-tank',
                'short_description' => 'Reinforced structural flash vessel designed for rapid pressure release, condensate separation, and sanitary fluid dynamics.',
                'full_description' => 'Precision manufactured from corrosion-proof polymer composites and pressure-certified fittings. Ensures instantaneous evacuation and hydraulic balancing in multi-story plumbing, steam blowdown, and high-flow sanitary drainage systems.',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'seo_title' => 'Heavy-Duty Hydraulic Flash Tanks | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'Industrial grade hydraulic flash tanks and condensate recovery vessels manufactured for commercial plumbing and heating circuits.',
                'seo_keywords' => 'flash tank, plumbing flash tank, condensate tank, hydraulic balancing vessel',
                'specs' => [
                    ['name' => 'Effective Volume / Capacity', 'value' => '50L / 100L / 250L / 500L Options'],
                    ['name' => 'Operating Pressure Rating', 'value' => 'Up to 10 Bar (PN10)'],
                    ['name' => 'Vessel Shell Material', 'value' => 'Reinforced Heavy Polymer / Composite Shell'],
                    ['name' => 'Inlet / Outlet Ports', 'value' => 'DN50 / DN80 / DN100 Flanged or Threaded'],
                    ['name' => 'Corrosion Immunity', 'value' => '100% Non-Corrosive Interior'],
                    ['name' => 'Mounting Configuration', 'value' => 'Vertical Free-Standing / Reinforced Base Brackets'],
                ],
                'apps' => ['plumbing-infrastructure', 'commercial-buildings', 'industrial-applications', 'property-development'],
            ],

            // PVC Pipes
            [
                'category' => 'pvc-pipes',
                'name' => 'High-Pressure Schedule 40/80 PVC Pipe System',
                'slug' => 'high-pressure-schedule-40-80-pvc-pipe-system',
                'short_description' => 'Heavy-wall unplasticized PVC pressure pipe with ultra-smooth bore for potable water supply and industrial fluid transport.',
                'full_description' => 'Manufactured in strict accordance with international standards. Our pressure PVC pipes feature superior tensile strength, zero calcification buildup, flawless flow dynamics, and exceptional resistance to soil chemicals and hydrostatic pressure surges.',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'seo_title' => 'High Pressure PVC Pipes PN10/PN16 | HUMING INTERNATIONAL LIMITED',
                'seo_description' => 'High-pressure PVC pipes for municipal water distribution, building plumbing, and industrial chemical conveyance.',
                'seo_keywords' => 'PVC pipe, UPVC pressure pipe, plumbing pipes, Schedule 40 PVC, drainage pipes',
                'specs' => [
                    ['name' => 'Nominal Diameters', 'value' => '½" (20mm) up to 12" (315mm)'],
                    ['name' => 'Standard Length', 'value' => '5.8m / 6.0m per length with socket end'],
                    ['name' => 'Working Pressure Ratings', 'value' => 'Class C (9 bar), Class D (12 bar), Class E (15 bar), PN16'],
                    ['name' => 'Joint Type', 'value' => 'Solvent Cement Socket / Rubber Ring Seal (Z-Joint)'],
                    ['name' => 'Tensile Strength', 'value' => '≥ 45 MPa'],
                    ['name' => 'Color', 'value' => 'Standard Industrial Grey / White / Blue (Potable)'],
                ],
                'apps' => ['plumbing-infrastructure', 'residential-construction', 'commercial-buildings', 'property-development', 'industrial-applications'],
            ],
            [
                'category' => 'pvc-pipes',
                'name' => 'Drainage, Waste & Vent (DWV) Underground PVC Pipe',
                'slug' => 'drainage-waste-vent-dwv-underground-pvc-pipe',
                'short_description' => 'High-ring-stiffness PVC soil and underground drainage pipe engineered for municipal sewage and building discharge.',
                'full_description' => 'Designed specifically for gravity drainage and underground waste conveyance. Features high crush resistance, rubber-gasketed push-fit joints for rapid trench assembly, and resistance to aggressive effluents and biological agents.',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 2,
                'specs' => [
                    ['name' => 'Diameters', 'value' => '110mm, 160mm, 200mm, 250mm'],
                    ['name' => 'Ring Stiffness', 'value' => 'SN4 / SN8 Rated for Deep Burial'],
                    ['name' => 'Standard Length', 'value' => '3.0m / 6.0m'],
                    ['name' => 'Jointing System', 'value' => 'Integral Socket with EPDM Elastomeric Ring'],
                    ['name' => 'Color', 'value' => 'Terracotta Orange / Golden Brown'],
                ],
                'apps' => ['plumbing-infrastructure', 'commercial-buildings', 'property-development'],
            ],
        ];

        foreach ($productsData as $pData) {
            $cat = $categoryModels[$pData['category']] ?? null;
            if (!$cat) continue;

            $product = Product::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'category_id' => $cat->id,
                    'name' => $pData['name'],
                    'short_description' => $pData['short_description'],
                    'full_description' => $pData['full_description'],
                    'is_featured' => $pData['is_featured'] ?? false,
                    'status' => $pData['status'] ?? 'published',
                    'main_image' => 'images/products/' . $pData['category'] . '.jpg',
                    'seo_title' => $pData['seo_title'] ?? $pData['name'] . ' | HUMING INTERNATIONAL LIMITED',
                    'seo_description' => $pData['seo_description'] ?? $pData['short_description'],
                    'seo_keywords' => $pData['seo_keywords'] ?? '',
                ]
            );

            // Seed Product Images
            ProductImage::where('product_id', $product->id)->delete();
            ProductImage::create([
                'product_id' => $product->id,
                'image' => 'images/products/' . $pData['category'] . '.jpg',
                'alt_text' => $product->name . ' Primary Showcase',
                'sort_order' => 1,
                'is_primary' => true,
            ]);

            // Add Specifications
            if (!empty($pData['specs'])) {
                ProductSpecification::where('product_id', $product->id)->delete();
                $sOrder = 1;
                foreach ($pData['specs'] as $spec) {
                    ProductSpecification::create([
                        'product_id' => $product->id,
                        'specification_name' => $spec['name'],
                        'specification_value' => $spec['value'],
                        'sort_order' => $sOrder++,
                    ]);
                }
            }

            // Attach applications
            if (!empty($pData['apps'])) {
                $appIds = [];
                foreach ($pData['apps'] as $aSlug) {
                    if (isset($appModels[$aSlug])) {
                        $appIds[] = $appModels[$aSlug]->id;
                    }
                }
                $product->applications()->sync($appIds);
            }
        }

        // 7. Company Values
        $values = [
            ['title' => 'Manufacturing Quality', 'description' => 'Uncompromising precision and high-grade formulation in every batch we produce.', 'icon' => 'shield-check', 'sort_order' => 1],
            ['title' => 'Integrity & Trust', 'description' => 'Transparent business partnerships, honest specifications, and contractual dependability.', 'icon' => 'hand-raised', 'sort_order' => 2],
            ['title' => 'Reliable Supply Chain', 'description' => 'Large-scale warehouse stock and structured logistics guaranteeing on-time site delivery.', 'icon' => 'truck', 'sort_order' => 3],
            ['title' => 'Technical Innovation', 'description' => 'Continuous investment in advanced extrusion, UV curing, and composite polymer engineering.', 'icon' => 'light-bulb', 'sort_order' => 4],
            ['title' => 'Client Satisfaction', 'description' => 'Dedicated sales engineering and prompt post-delivery support for projects of all scales.', 'icon' => 'heart', 'sort_order' => 5],
            ['title' => 'Sustainability & Durability', 'description' => 'Eco-conscious manufacturing practices and 100% recyclable thermoplastic products.', 'icon' => 'arrow-path', 'sort_order' => 6],
        ];

        CompanyValue::truncate();
        foreach ($values as $val) {
            CompanyValue::create($val);
        }

        // 8. Why Choose Us (Homepage Features)
        $features = [
            ['title' => 'Quality Products', 'description' => 'Manufactured under rigorous factory dimensional controls, pressure testing, and multi-layer surface inspections.', 'icon' => 'check-badge', 'sort_order' => 1],
            ['title' => 'Reliable Supply', 'description' => 'Consistent inventory ready for prompt dispatch to commercial developments, distributor yards, and contractors.', 'icon' => 'building-library', 'sort_order' => 2],
            ['title' => 'Professional Service', 'description' => 'Experienced technical team providing material sizing guidance, product datasheets, and custom batch advice.', 'icon' => 'user-group', 'sort_order' => 3],
            ['title' => 'Competitive Solutions', 'description' => 'Direct manufacturer pricing that maximizes profit margins for builders, developers, and regional stockists.', 'icon' => 'currency-dollar', 'sort_order' => 4],
            ['title' => 'Customer Support', 'description' => 'Fast turnaround on quotation requests, sample requests, and comprehensive after-sales assistance.', 'icon' => 'phone-arrow-up-right', 'sort_order' => 5],
            ['title' => 'Diverse Product Variety', 'description' => 'Comprehensive portfolio spanning interior decorative finishes, architectural panels, and heavy plumbing networks.', 'icon' => 'squares-plus', 'sort_order' => 6],
        ];

        HomepageFeature::truncate();
        foreach ($features as $f) {
            HomepageFeature::create($f);
        }

        // 9. Production Processes
        $processes = [
            ['step_number' => 1, 'title' => 'Raw Material Selection', 'description' => 'Rigorous screening and laboratory testing of virgin polymers, high-purity stone powders, and UV stabilizing compounds.', 'icon' => 'beaker'],
            ['step_number' => 2, 'title' => 'Precision Extrusion & Molding', 'description' => 'High-temperature automated extrusion lines form exact panel profiles and high-density pipe walls with tight tolerances.', 'icon' => 'cog'],
            ['step_number' => 3, 'title' => 'Multi-Stage Quality Inspection', 'description' => 'Continuous in-line laser measurement of wall thickness, tensile resistance, and hydrostatic pressure containment.', 'icon' => 'magnifying-glass'],
            ['step_number' => 4, 'title' => 'Surface Calibration & UV Finishing', 'description' => 'Precision texture embossing and multi-pass UV coating application for mirror gloss, scratch resistance, and color fastness.', 'icon' => 'sparkles'],
            ['step_number' => 5, 'title' => 'Industrial Protective Packaging', 'description' => 'Individual protective film application, corner guards, and heavy-duty strapping to safeguard product integrity during transport.', 'icon' => 'archive-box'],
            ['step_number' => 6, 'title' => 'Secure Warehousing & Inventory', 'description' => 'Modern climate-controlled storage racking organized for rapid palletization and seamless order fulfillment.', 'icon' => 'building-storefront'],
            ['step_number' => 7, 'title' => 'Logistics & Nationwide Distribution', 'description' => 'Dedicated fleet coordination and distributor partnerships ensuring fast, damage-free delivery directly to project sites.', 'icon' => 'truck'],
        ];

        ProductionProcess::truncate();
        foreach ($processes as $proc) {
            ProductionProcess::create($proc);
        }

        // 10. Gallery Categories & Items
        $gCats = [
            ['name' => 'Products', 'slug' => 'products', 'sort_order' => 1],
            ['name' => 'Factory & Operations', 'slug' => 'factory', 'sort_order' => 2],
            ['name' => 'Manufacturing Lines', 'slug' => 'manufacturing', 'sort_order' => 3],
            ['name' => 'Projects & Applications', 'slug' => 'projects', 'sort_order' => 4],
        ];

        $gCatModels = [];
        foreach ($gCats as $gc) {
            $gModel = GalleryCategory::updateOrCreate(['slug' => $gc['slug']], $gc);
            $gCatModels[$gc['slug']] = $gModel;
        }

        $galleryItems = [
            ['cat' => 'products', 'title' => 'Premium UV Marble Sheet Installation', 'desc' => 'High-gloss bookmatched marble sheet feature wall in luxury hotel lobby.', 'sort' => 1],
            ['cat' => 'products', 'title' => 'Acoustic Fluted Wall Panels', 'desc' => 'Vertical fluted wood composite panels installed in executive office suite.', 'sort' => 2],
            ['cat' => 'products', 'title' => 'Pressure PVC Pipes Inventory', 'desc' => 'High-grade PVC pressure piping ready for municipal water project.', 'sort' => 3],
            ['cat' => 'factory', 'title' => 'Automated Extrusion Plant', 'desc' => 'High-speed automated PVC extrusion machinery running continuously.', 'sort' => 4],
            ['cat' => 'factory', 'title' => 'Warehouse & Staging Facility', 'desc' => 'Bulk staging area for scheduled contractor shipments and container loading.', 'sort' => 5],
            ['cat' => 'manufacturing', 'title' => 'UV Curing & Topcoat Application', 'desc' => 'Automated UV radiation curing line applying multi-layer protective coating.', 'sort' => 6],
            ['cat' => 'manufacturing', 'title' => 'Pressure Testing Quality Lab', 'desc' => 'Hydrostatic burst pressure and dimensional validation testing in progress.', 'sort' => 7],
            ['cat' => 'projects', 'title' => 'Commercial Mall Restroom Fit-Out', 'desc' => 'Waterproof PVC wall paneling and plumbing flash tank integration.', 'sort' => 8],
            ['cat' => 'projects', 'title' => 'High-Rise Residential Plumbing Network', 'desc' => 'Complete PVC pipe and DWV drain installation in multi-story development.', 'sort' => 9],
        ];

        Gallery::truncate();
        foreach ($galleryItems as $gi) {
            $catId = isset($gCatModels[$gi['cat']]) ? $gCatModels[$gi['cat']]->id : null;
            Gallery::create([
                'gallery_category_id' => $catId,
                'title' => $gi['title'],
                'description' => $gi['desc'],
                'image' => 'images/gallery/' . $gi['cat'] . '-' . $gi['sort'] . '.jpg',
                'is_featured' => $gi['sort'] <= 4,
                'sort_order' => $gi['sort'],
            ]);
        }
    }
}
