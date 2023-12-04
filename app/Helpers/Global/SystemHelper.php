<?php

/**
 * Loops through a folder and requires all PHP files
 * Searches sub-directories as well.
 *
 * @param $folder
 */
if (! function_exists('includeFilesInFolder')) {
    function includeFilesInFolder($folder)
    {
        try {
            $it = new RecursiveDirectoryIterator($folder);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

/**
 * @param $folder
 */
if (!function_exists('includeRouteFiles')) {
    function includeRouteFiles($folder)
    {
        includeFilesInFolder($folder);
    }
}

/**
 * Get GCD (Greatest Common Divisor)
 */
if (!function_exists('getGcd')) {
    function getGcd($x, $y) {
        if ($y == 0) {
            return $x;
        }

        return getGcd($y, $x % $y);
    }
}
