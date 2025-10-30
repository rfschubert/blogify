<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Http;

class FakeStoreImporter extends PostImporter
{
    public function import(int $id): Post
    {
        $response = Http::get("https://fakestoreapi.com/products/{$id}");

        if ($response->failed()) {
            throw new \Exception('Failed to fetch product from FakeStore');
        }

        $data = $response->json();

        return $this->savePost([
            'title' => $data['title'],
            'content' => $data['description'],
            'source' => 'fakestore',
            'external_id' => $data['id'],
            'status' => 'published', // or 'draft'
        ]);
    }
}
