<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\ProductCategory;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.category.index', $this->queries());
    }

    private function queries():array
    {

        return ['categories'=>ProductCategory::paginate(20)];
    }
}
