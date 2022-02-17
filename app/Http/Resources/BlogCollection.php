<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class BlogCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->blog_id,
            'name' => $this->title,
            'Category_id' => $this->category_id,
            'Content' => $this->content,
            'User_id'  => $this->user_id,
            'Blog_image' =>  asset('storage/blog_images/' . $this->blog_image),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
