<?php

namespace App\Observers;

use App\Models\Asset;

class ProductObserver
{
    /**
     * Handle the task "created" event.
     *
\     * @return void
     */
    public function created(\App\Models\Product $product)
    {
       Asset::factory(random_int(1,4))->create(["product_id"=>$product->id]);
    }
}
