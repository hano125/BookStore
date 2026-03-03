<?php

namespace App\Modules\Book\DTOs;

use App\Http\Requests\CreateBookRequest;

class CreateBookDTO
{
    public function __construct(
        public string $title,
        public string $author,
        public int $category_id,
        public float $price,
        public int $stock,
        public ?string $description

    ) {

    }

    public static function formRequest(CreateBookRequest $request): self
    {
        return new self(
            title: $request->title,
            author: $request->author,
            category_id: $request->category_id,
            price: $request->price,
            stock: $request->stock,
            description: $request->description
        );
    }
}
