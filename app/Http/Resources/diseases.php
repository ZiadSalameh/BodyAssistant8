<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class diseases extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'joint_pain' => $this->joint_pain,
            'back_pain' => $this->back_pain,
            'neck_pain' => $this->neck_pain,
            'rheumatism' => $this->rheumatism,
            'nerve_disease' => $this->nerve_disease,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
