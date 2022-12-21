<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'store_name'    => $this->name,
            'store_status'  => $this->getStatus->name,
            'address'       => $this->address,
            'note'          => $this->note,
            'image'         => $this->getImage->url,
            'products'      => ProductResource::collection($this->getProducts)
        ];
    }
}
