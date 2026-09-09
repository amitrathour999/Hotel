<?php
exec('git status', $out);
echo implode("\n", $out);
