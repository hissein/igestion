<?php

namespace App\Traits;

use App\Helpers\Base64Helper;
use Illuminate\Support\Str;

trait ProductRequestTrait
{
    protected function prepareForValidation()
    {
        if (str_contains($this->image, 'data')) {
            $image = Base64Helper::base6ToFile($this->image);
            $this->merge([
                'image' => $image,
            ]);
        }
        $this->merge([
            'slug' => Str::slug($this->name, '-'),
            'parent_id' => $this->parent,
        ]);
    }
}
