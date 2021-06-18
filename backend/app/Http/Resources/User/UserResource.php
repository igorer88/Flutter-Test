<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'author_id' => $this->id,
            'first_name' =>$this->first_name,
            'last_name' =>$this->last_name,
            'author_email' =>$this->email,
            'avatar' =>$this->avatar
        ];
    }
}
