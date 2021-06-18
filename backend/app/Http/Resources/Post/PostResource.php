<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Comment\CommentsResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Image\ImagesResource;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\Video\VideoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'post_id' => $this->id,
            'post_title' =>$this->title,
            'post_content' =>$this->content,
            'post_type' =>$this->post_type,
            'author_id' =>$this->author_id,
            'category_id' =>$this->category_id,
            'post_meta' =>$this->meta_data,
            
            'post_updated_at' =>$this->updated_at,
            'category' => new CategoryResource($this->category),
            'author' => new UserResource($this->author),

            'images' => ImageResource::collection($this->images),
            'videos' => VideoResource::collection($this->videos),
            'tags' => TagResource::collection($this->tags),

            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
