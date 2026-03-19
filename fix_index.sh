#!/bin/bash
TARGET="/home/dany/web/cms.pixelapp.com.co/public_html/index.php"
sudo tee "$TARGET" << 'EOF'
<?php
// Entry point for Pixel CMS Master Panel
require_once __DIR__ . '/vendor/autoload.php';
$app = new \App\Core\Application(__DIR__);
$app->run();
EOF
sudo chown dany:dany "$TARGET"
chmod 644 "$TARGET"
