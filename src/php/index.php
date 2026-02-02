<?php

echo "<h1>Hello from Nginx + PHP-FPM!</h1>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server Time: " . date('Y-m-d H:i:s') . "</p>";

// Uncomment to see full phpinfo
// phpinfo();