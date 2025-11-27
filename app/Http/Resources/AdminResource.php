<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Admin */
class AdminResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'profile' => $this->profile,
            'username' => $this->username,
            'fullname' => $this->fullname,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
