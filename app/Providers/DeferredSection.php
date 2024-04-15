<?php
namespace App;

class DeferredSection
{
    protected $sections = [];

    public function push($content)
    {
        $this->sections[] = $content;
    }

    public function render()
    {
        return implode("\n", $this->sections);
    }
}
