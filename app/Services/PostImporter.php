<?php

namespace App\Services;

use App\Models\Post;

abstract class PostImporter
{
    abstract public function import(int $id): Post;

    protected function savePost(array $data): Post
    {
        return Post::firstOrCreate([
            'external_id' => $data['external_id'],
            'source' => $data['source'],
        ], $data);
    }
}
