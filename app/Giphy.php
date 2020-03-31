<?php

namespace App;

// Just Giphy Model
class Giphy
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $frameCount;

    /**
     * @var int
     */
    protected $size;

    /**
     * Just get set methods below 
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth($width): void
    {
        $this->width = $width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight($height): void
    {
        $this->height = $height;
    }

    public function getFrameCount(): int
    {
        return $this->frameCount;
    }

    public function setFrameCount($frameCount): void
    {
        $this->frameCount = $frameCount;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize($size): void
    {
        $this->size = $size;
    }
}