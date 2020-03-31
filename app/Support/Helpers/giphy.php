<?php

use App\Giphy;

/**
 * Helper for model getters using enums.
 *
 * @param  string $class
 * @param  mixed $value
 * @return ?Enum
 */
function set_giphy(Giphy $giphy)
{
    return collect([
        'url' => $giphy->getUrl(),
        'title' => $giphy->getTitle(),
        'width' => $giphy->getWidth(),
        'height' => $giphy->getHeight(),
        'frame_count' => $giphy->getFrameCount(),
        'size' => $giphy->getSize(),
    ]);
}
