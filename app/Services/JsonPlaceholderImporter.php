<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Http;

class JsonPlaceholderImporter extends PostImporter
{
    public function import(int $id): Post
    {
        $response = Http::get("https://jsonplaceholder.typicode.com/posts/{$id}");

        if ($response->failed()) {
            throw new \Exception('Failed to fetch post from JsonPlaceholder');
        }

        $data = $response->json();

        return $this->savePost([
            'title' => $data['title'],
            'content' => $data['body'],
            'source' => 'jsonplaceholder',
            'external_id' => $data['id'],
            'status' => 'published', // or 'draft'
        ]);
    }
}
