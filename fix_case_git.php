<?php

echo "=== Fixing Git Case Sensitivity for Linux ===\n";

// Step 1: Check if Backend folder exists in git
exec('git ls-files resources/views', $files);

$backendUppercaseFound = false;
foreach ($files as $f) {
    if (stripos($f, 'resources/views/Backend') !== false || stripos($f, 'Booking.blade.php') !== false || stripos($f, 'Register.blade.php') !== false) {
        $backendUppercaseFound = true;
        break;
    }
}

// Rename Backend to temp
if (is_dir('resources/views/Backend') || is_dir('resources/views/backend')) {
    echo "1. Renaming Backend folder to temp...\n";
    system('git mv resources/views/Backend resources/views/backend_temp 2>NUL || git mv resources/views/backend resources/views/backend_temp 2>NUL');
    system('git commit -m "temp rename folder"');

    echo "2. Renaming backend_temp to lowercase backend...\n";
    system('git mv resources/views/backend_temp resources/views/backend');
}

// Fix frontend Register.blade.php
if (file_exists('resources/views/frontend/Register.blade.php')) {
    echo "3. Renaming Register.blade.php to register.blade.php...\n";
    system('git mv resources/views/frontend/Register.blade.php resources/views/frontend/register_temp.blade.php');
    system('git mv resources/views/frontend/register_temp.blade.php resources/views/frontend/register.blade.php');
}

// Fix all files inside resources/views/backend to lowercase
$backendFiles = glob('resources/views/backend/*.blade.php');
foreach ($backendFiles as $file) {
    $dir = dirname($file);
    $base = basename($file);
    $lowerBase = strtolower($base);
    if ($base !== $lowerBase) {
        echo "4. Renaming $base to $lowerBase...\n";
        system("git mv \"$file\" \"$dir/{$base}_temp\"");
        system("git mv \"$dir/{$base}_temp\" \"$dir/$lowerBase\"");
    }
}

echo "5. Committing and Pushing to GitHub...\n";
system('git add .');
system('git commit -m "Fix case sensitivity for Linux server"');
system('git push origin main');

echo "=== DONE! Render will now deploy the correct lowercase files! ===\n";
