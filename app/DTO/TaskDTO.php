<?php

namespace App\DTO;

class TaskDTO
{
    public $title;
    public $description;
    public $user_id;
    public $status;

    public $category_id;

    public $due_date;

    public function __construct($title = null, $description = null, $user_id = null, $status = false,  $category_id = null , $due_date = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->user_id = $user_id;
        $this->status = $status;
        $this->category_id = $category_id;
        $this->due_date = $due_date;
    }


    public static function fromRequest(array $data, array $oldData)
    {
        return new self(
            $data['title'] ?? $oldData['title'],
            $data['description'] ?? $oldData['description'],
            $data['user_id'] ?? $oldData['user_id'],
            $data['status'] ?? $oldData['status'],
            $data['category_id'] ?? null,
            $data['due_date'] ?? null
        );
    }


    public function toArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'due_date' => $this->due_date,
        ];
    }
}
