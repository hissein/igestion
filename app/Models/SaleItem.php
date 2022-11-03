<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;

class SaleItem extends DataTransferObject
{


    public Product $product;
public int $qty = 1;
public float $total = 1;
public string $note = '';

}
