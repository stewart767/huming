<?php

namespace Database\Seeders;

class AssetCreator
{
    public static function generate()
    {
        $dir = dirname(__DIR__, 2) . '/public/images';

        // Category & Product visuals
        $categories = [
            'marble-sheets' => [
                'title' => 'UV MARBLE SHEETS',
                'subtitle' => 'High-Gloss Luxury Architectural Cladding',
                'color1' => '#1E293B',
                'color2' => '#0F172A',
                'accent' => '#F59E0B',
                'pattern' => 'marble',
            ],
            'wall-panels' => [
                'title' => 'DECORATIVE WALL PANELS',
                'subtitle' => 'Acoustic Fluted & Modular WPC Profiles',
                'color1' => '#1E3A8A',
                'color2' => '#172554',
                'accent' => '#38BDF8',
                'pattern' => 'fluted',
            ],
            'pvc-sealing' => [
                'title' => 'PVC SEALING PROFILES',
                'subtitle' => 'Industrial Watertight Expansion Seals',
                'color1' => '#0F766E',
                'color2' => '#134E4A',
                'accent' => '#2DD4BF',
                'pattern' => 'sealing',
            ],
            'flash-tanks' => [
                'title' => 'HYDRAULIC FLASH TANKS',
                'subtitle' => 'Heavy-Duty Evacuation & Balancing Vessels',
                'color1' => '#4338CA',
                'color2' => '#312E81',
                'accent' => '#818CF8',
                'pattern' => 'tank',
            ],
            'pvc-pipes' => [
                'title' => 'HIGH-PRESSURE PVC PIPES',
                'subtitle' => 'Schedule 40/80 & Drainage Underground Systems',
                'color1' => '#0369A1',
                'color2' => '#0C4A6E',
                'accent' => '#38BDF8',
                'pattern' => 'pipes',
            ],
        ];

        foreach ($categories as $slug => $c) {
            $svg = self::generateCategorySvg($c);
            file_put_contents($dir . "/categories/{$slug}.svg", $svg);
            file_put_contents($dir . "/categories/{$slug}.jpg", $svg); // Also save as .jpg for fallback compatibility
            file_put_contents($dir . "/products/{$slug}.jpg", $svg);
            file_put_contents($dir . "/products/{$slug}.svg", $svg);
        }

        // Hero image
        $heroSvg = self::generateHeroSvg();
        file_put_contents($dir . "/hero/hero-factory.jpg", $heroSvg);
        file_put_contents($dir . "/hero/hero-factory.svg", $heroSvg);

        // Applications
        $apps = [
            'residential-construction' => ['title' => 'Residential Construction', 'color1' => '#0284C7', 'color2' => '#0F172A'],
            'commercial-buildings' => ['title' => 'Commercial Buildings', 'color1' => '#1E40AF', 'color2' => '#0F172A'],
            'interior-decoration' => ['title' => 'Interior Decoration', 'color1' => '#D97706', 'color2' => '#0F172A'],
            'plumbing-infrastructure' => ['title' => 'Plumbing Infrastructure', 'color1' => '#0D9488', 'color2' => '#0F172A'],
            'hospitality-hotels' => ['title' => 'Hotels & Hospitality', 'color1' => '#4F46E5', 'color2' => '#0F172A'],
            'retail-spaces' => ['title' => 'Retail Spaces', 'color1' => '#EA580C', 'color2' => '#0F172A'],
            'industrial-applications' => ['title' => 'Industrial Facilities', 'color1' => '#475569', 'color2' => '#0F172A'],
            'property-development' => ['title' => 'Property Development', 'color1' => '#2563EB', 'color2' => '#0F172A'],
        ];

        foreach ($apps as $slug => $a) {
            $svg = self::generateAppSvg($a);
            file_put_contents($dir . "/applications/{$slug}.jpg", $svg);
            file_put_contents($dir . "/applications/{$slug}.svg", $svg);
        }

        // Gallery images
        for ($i = 1; $i <= 9; $i++) {
            $svg = self::generateGallerySvg($i);
            file_put_contents($dir . "/gallery/factory-{$i}.jpg", $svg);
            file_put_contents($dir . "/gallery/products-{$i}.jpg", $svg);
            file_put_contents($dir . "/gallery/manufacturing-{$i}.jpg", $svg);
            file_put_contents($dir . "/gallery/projects-{$i}.jpg", $svg);
        }
        file_put_contents($dir . "/gallery/factory.jpg", $heroSvg);
        file_put_contents($dir . "/placeholder.jpg", $heroSvg);
    }

    private static function generateCategorySvg($c)
    {
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" width="100%" height="100%">
  <defs>
    <linearGradient id="bgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$c['color1']}" />
      <stop offset="100%" stop-color="{$c['color2']}" />
    </linearGradient>
    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
      <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/>
    </pattern>
    <linearGradient id="accentGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="{$c['accent']}" />
      <stop offset="100%" stop-color="#ffffff" />
    </linearGradient>
  </defs>

  <!-- Background -->
  <rect width="800" height="600" fill="url(#bgGrad)" />
  <rect width="800" height="600" fill="url(#grid)" />

  <!-- Industrial Geometric Shapes -->
  <g opacity="0.15">
    <circle cx="700" cy="100" r="220" fill="none" stroke="{$c['accent']}" stroke-width="2" stroke-dasharray="10 10"/>
    <circle cx="700" cy="100" r="160" fill="none" stroke="{$c['accent']}" stroke-width="1.5"/>
    <rect x="50" y="380" width="300" height="300" rx="20" fill="none" stroke="white" stroke-width="1" transform="rotate(-15 200 530)"/>
  </g>

  <!-- Central Graphic Showcase -->
  <g transform="translate(400, 260)">
    <!-- Central Shield / Badge -->
    <rect x="-180" y="-140" width="360" height="240" rx="16" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.15)" stroke-width="2" backdrop-filter="blur(10px)"/>
    
    <!-- Accent Line -->
    <rect x="-150" y="-110" width="40" height="4" rx="2" fill="{$c['accent']}"/>
    
    <text x="-150" y="-70" font-family="'Inter', sans-serif" font-size="14" font-weight="700" letter-spacing="3" fill="{$c['accent']}">
      HUMING INDUSTRIAL SPECIFICATION
    </text>
    <text x="-150" y="-30" font-family="'Inter', sans-serif" font-size="24" font-weight="900" fill="#FFFFFF">
      {$c['title']}
    </text>
    <text x="-150" y="5" font-family="'Inter', sans-serif" font-size="14" font-weight="400" fill="#94A3B8">
      {$c['subtitle']}
    </text>
    
    <!-- Badges -->
    <rect x="-150" y="40" width="110" height="28" rx="6" fill="rgba(255,255,255,0.1)"/>
    <text x="-95" y="58" font-family="'Inter', sans-serif" font-size="11" font-weight="600" fill="#FFFFFF" text-anchor="middle">CERTIFIED QUALITY</text>

    <rect x="-30" y="40" width="130" height="28" rx="6" fill="rgba(255,255,255,0.1)"/>
    <text x="35" y="58" font-family="'Inter', sans-serif" font-size="11" font-weight="600" fill="#FFFFFF" text-anchor="middle">PRECISION ENGINEERED</text>
  </g>

  <!-- Top Brand Watermark -->
  <text x="50" y="60" font-family="'Inter', sans-serif" font-size="14" font-weight="800" letter-spacing="2" fill="rgba(255,255,255,0.4)">
    HUMING INTERNATIONAL LIMITED
  </text>
  
  <!-- Bottom Accent Strip -->
  <rect x="0" y="592" width="800" height="8" fill="url(#accentGrad)"/>
</svg>
SVG;
    }

    private static function generateHeroSvg()
    {
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080" width="100%" height="100%">
  <defs>
    <linearGradient id="heroBg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#020617" />
      <stop offset="50%" stop-color="#0F172A" />
      <stop offset="100%" stop-color="#0369A1" />
    </linearGradient>
    <pattern id="heroGrid" width="60" height="60" patternUnits="userSpaceOnUse">
      <path d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
    </pattern>
  </defs>

  <rect width="1920" height="1080" fill="url(#heroBg)"/>
  <rect width="1920" height="1080" fill="url(#heroGrid)"/>

  <!-- Architectural Engineering Lines -->
  <g opacity="0.2">
    <line x1="0" y1="200" x2="1920" y2="900" stroke="#38BDF8" stroke-width="2"/>
    <line x1="0" y1="400" x2="1920" y2="1100" stroke="#38BDF8" stroke-width="1"/>
    <circle cx="1500" cy="400" r="400" fill="none" stroke="#F59E0B" stroke-width="2" stroke-dasharray="15 15"/>
    <circle cx="1500" cy="400" r="300" fill="none" stroke="#38BDF8" stroke-width="1.5"/>
  </g>

  <!-- Industrial Manufacturing Grid Representation -->
  <g transform="translate(1200, 300)" opacity="0.7">
    <rect x="0" y="0" width="500" height="350" rx="24" fill="rgba(15, 23, 42, 0.6)" stroke="rgba(56, 189, 248, 0.3)" stroke-width="2"/>
    <rect x="30" y="40" width="80" height="6" rx="3" fill="#F59E0B"/>
    <text x="30" y="90" font-family="'Inter', sans-serif" font-size="28" font-weight="900" fill="#FFFFFF">MANUFACTURING PLANT</text>
    <text x="30" y="130" font-family="'Inter', sans-serif" font-size="16" font-weight="500" fill="#94A3B8">Automated Extrusion &amp; UV Coating Lines</text>
    
    <g transform="translate(30, 180)">
      <rect x="0" y="0" width="200" height="60" rx="12" fill="rgba(255,255,255,0.05)"/>
      <text x="20" y="26" font-family="'Inter', sans-serif" font-size="11" font-weight="700" fill="#38BDF8">CAPACITY STATUS</text>
      <text x="20" y="48" font-family="'Inter', sans-serif" font-size="16" font-weight="800" fill="#FFFFFF">ACTIVE PRODUCTION</text>
      
      <rect x="220" y="0" width="200" height="60" rx="12" fill="rgba(255,255,255,0.05)"/>
      <text x="240" y="26" font-family="'Inter', sans-serif" font-size="11" font-weight="700" fill="#F59E0B">QUALITY PROTOCOL</text>
      <text x="240" y="48" font-family="'Inter', sans-serif" font-size="16" font-weight="800" fill="#FFFFFF">ISO CALIBRATED</text>
    </g>
  </g>
</svg>
SVG;
    }

    private static function generateAppSvg($a)
    {
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400" width="100%" height="100%">
  <defs>
    <linearGradient id="appGrad_{$a['color1']}" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$a['color1']}" />
      <stop offset="100%" stop-color="{$a['color2']}" />
    </linearGradient>
  </defs>
  <rect width="600" height="400" fill="url(#appGrad_{$a['color1']})" />
  <g transform="translate(50, 200)">
    <rect x="0" y="0" width="500" height="140" rx="12" fill="rgba(0,0,0,0.4)" stroke="rgba(255,255,255,0.15)"/>
    <text x="30" y="50" font-family="'Inter', sans-serif" font-size="24" font-weight="800" fill="#FFFFFF">{$a['title']}</text>
    <text x="30" y="85" font-family="'Inter', sans-serif" font-size="14" font-weight="500" fill="#93C5FD">Commercial &amp; Industrial Building Application</text>
    <text x="30" y="115" font-family="'Inter', sans-serif" font-size="12" font-weight="700" letter-spacing="1" fill="#F59E0B">HUMING INTERNATIONAL LIMITED</text>
  </g>
</svg>
SVG;
    }

    private static function generateGallerySvg($idx)
    {
        $colors = ['#0F172A', '#1E3A8A', '#0D9488', '#0369A1', '#4338CA', '#334155'];
        $bg = $colors[$idx % count($colors)];
        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" width="100%" height="100%">
  <rect width="800" height="600" fill="{$bg}" />
  <circle cx="400" cy="300" r="200" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="2"/>
  <text x="400" y="280" font-family="'Inter', sans-serif" font-size="22" font-weight="800" fill="#FFFFFF" text-anchor="middle">HUMING MANUFACTURING FACILITY</text>
  <text x="400" y="320" font-family="'Inter', sans-serif" font-size="14" font-weight="500" fill="#94A3B8" text-anchor="middle">High-Standard Production &amp; Supply Showcase #{$idx}</text>
</svg>
SVG;
    }
}
