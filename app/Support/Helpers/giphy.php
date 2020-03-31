<?php

use App\Giphy;

/**
 * Helper for model getters using giphy from model.
 *
 * @param  string $class
 * @param  mixed $value
 * @return ?Enum
 */
function get_giphy(Giphy $giphy)
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
