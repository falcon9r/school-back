<?php

namespace App\Http\Resources\API\Admin\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
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
            'id' => $this->id,
            'login' => $this->login,
            'first_name' => isset($this->first_name) ? $this->first_name : "No enter",
            'last_name' => isset($this->last_name) ? $this->last_name : "No enter",
            'grade' => count($this->grades) == 0 ? "No exists" : GradeResource::collection($this->grades),
            'subjects' => count($this->subjects) == 0 ? "No choose" : SubjectResource::collection($this->subjects),
        ];
    }
}
