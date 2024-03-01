<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class meals extends JsonResource
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
            'name' => $this->name,
            'calories' => $this->calories,
            'protein' => $this->protein,
            'carbohydrates' => $this->carbohydrates,
            'fat' => $this->fat,
            // 'created_at' => $this->created_at->format('d/m/Y'),
            // 'updated_at' => $this->updated_at->format('d/m/Y'),
            // 'created_at' => $this->created_at ? $this->created_at->format('d/m/Y') : $this->id,
            // 'updated_at' => $this->updated_at ? $this->updated_at->format('d/m/Y') : $this->id,
        ];
    }
}
