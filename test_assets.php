<?php
// Asset Test Script for index.blade.php
echo "=== ASSET VERIFICATION TEST ===\n\n";

$publicPath = __DIR__ . '/public/';

// List of assets from the blade template
$assets = [
    // CSS Files
    'static/index/v1/css/main.css',
    'static/index/v1/css/index.css', 
    'static/index/v1/css/swiper/swiper.min.css',
    'static/index/v1/css/details.css',
    'assets/loading.css',
    
    // Image Files
    'profelar/profelar_logo.png',
    'profelar/profelar_pay.png',
    'profelar/profelar_ref.png',
    'uploads/material/withdrawicon.png',
    'uploads/material/titleicon.png', 
    'uploads/material/coins.png',
];

echo "Checking assets in: " . $publicPath . "\n\n";

$found = 0;
$missing = 0;

foreach ($assets as $asset) {
    $fullPath = $publicPath . $asset;
    if (file_exists($fullPath)) {
        $size = filesize($fullPath);
        echo "✅ FOUND: $asset (Size: " . number_format($size) . " bytes)\n";
        $found++;
    } else {
        echo "❌ MISSING: $asset\n";
        $missing++;
    }
}

echo "\n=== SUMMARY ===\n";
echo "Found: $found assets\n";
echo "Missing: $missing assets\n";

if ($missing > 0) {
    echo "\n=== SUGGESTED FIXES ===\n";
    
    // Check for alternative paths
    echo "Checking for alternative paths...\n";
    
    $alternatives = [
        'uploads/material/withdrawicon.png' => ['upload/payment/', 'ui3/', 'static/'],
        'uploads/material/titleicon.png' => ['upload/setting/', 'ui3/', 'static/'],
        'uploads/material/coins.png' => ['upload/payment/', 'ui3/', 'static/'],
    ];
    
    foreach ($alternatives as $missing_file => $search_dirs) {
        if (!file_exists($publicPath . $missing_file)) {
            echo "\nLooking for alternatives to: $missing_file\n";
            foreach ($search_dirs as $dir) {
                $searchPath = $publicPath . $dir;
                if (is_dir($searchPath)) {
                    $files = glob($searchPath . '*icon*');
                    $files = array_merge($files, glob($searchPath . '*coin*'));
                    $files = array_merge($files, glob($searchPath . '*title*'));
                    $files = array_merge($files, glob($searchPath . '*withdraw*'));
                    
                    foreach ($files as $file) {
                        $relativePath = str_replace($publicPath, '', $file);
                        echo "  → Found similar: $relativePath\n";
                    }
                }
            }
        }
    }
}

echo "\n=== DONE ===\n";
?>
