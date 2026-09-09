<?php

echo "--- Checking Git view files ---\n";
exec('git ls-files resources/views', $output);
foreach ($output as $line) {
    echo $line . "\n";
}
