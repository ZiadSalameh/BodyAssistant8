<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class personal_inforamtion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'age' => $this->age,
            'weight' => $this->weight,
            'height' => $this->height,
            'gender' => $this->gender,
            'activity_level' => $this->activity_level,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
