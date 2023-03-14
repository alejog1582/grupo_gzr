<?php

namespace App\Http\Resources\Grupogzr\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'identificacion' => $this->cedula,
            'role' => $this->role,
        ];
    }
}
