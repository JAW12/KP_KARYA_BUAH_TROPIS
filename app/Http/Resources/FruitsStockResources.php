<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FruitsStockResources extends JsonResource
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
            "berat"      => $this->berat,
            "status"     => $this->status,
            "keterangan" => $this->keterangan,
            "tanggal" => $this->created_at,
        ];
    }
}
