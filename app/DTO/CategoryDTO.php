<?php

namespace App\DTO;

class CategoryDTO
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function fromRequest(array $data)
    {
        return new self($data['name'] ?? null);
    }

    public function toArray()
    {
        return ['name' => $this->name];
    }
}
