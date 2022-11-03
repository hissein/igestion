<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SaleItem;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Create extends Component
{
    use WithPagination;
    protected $listeners = ['addSaleItem' => 'addSaleItem'];

    public function paginationView(): string
    {
        return 'partials.pagination';
    }
    public string $search = '';
    public $salProducts = [];
    public $selectCategory = null;
    protected $queryString = [
            "search"=>['except'=>''],
        'selectCategory'=>['except'=> null, 'as'=>'category']
    ];

    public $discount;
    public $tax = 15;
    public function render()
    {
        return view('livewire.admin.sales.create',$this->queries());
    }

    /**
     * @throws UnknownProperties
     */
    public function boot()
    {
        $products  = Product::all()->random(5);
        foreach ($products as $product){
            $qty = random_int(1,5);
            $this->salProducts[] = new SaleItem([
                'product'=> $product,
                'qty' => $qty,
                'total'=> $qty * $product->price
            ]);
        }
    }
    /**
     * @throws \Exception
     */
    protected function queries(){
        $categories  = ProductCategory::all();

        $this->discount = random_int(0,22);
        $total = 0;
        foreach ($this->salProducts as $key => $salProduct){
            if($salProduct instanceof SaleItem){
                $total+= $salProduct->total;

            }else {
                $this->salProducts[$key] = new SaleItem([
                    'product'=>new Product($this->salProducts[$key]['product']),
                    'qty' => $this->salProducts[$key]['qty'],
                    'total'=>  $this->salProducts[$key]['total']
                ]);
                $total+= $this->salProducts[$key]->total;
            }
        }
        $products = null;
        if($this->selectCategory){
            $products = Product::where('product_category_id',$this->selectCategory);
        }else {
            $products = Product::with(['category','assets']);
        }
        return [
            'products'=>$products->where('name','Like',"%".$this->search."%")->paginate(8),
            'categories'=>$categories,
            'total'=>$total,
            'finalPrice' => $total - ($total * ($this->discount /100)) + ($total * ($this->tax /100))
        ];
    }


    public function setCategory( $id){
        $this->selectCategory = ($id) ?? null;
        $this->resetPage();
    }

    public function clearSal(){
        $this->salProducts = [];
    }

    /**
     * @throws UnknownProperties
     */
    public function addSaleItem($data){
        $product = Product::findOrFail($data['id']);
        if($product instanceof Product)
        {

            $exist  = false;
            foreach ($this->salProducts as $salProduct){
                if(is_array($salProduct) && $salProduct['product']["id"] === $product->id){
                    $exist = true;
                    break;
                }
                if($salProduct instanceof SaleItem && $salProduct->product->id === $product->id){
                    $exist = true;
                    break;
                }

            }

            if (!$exist){
                $this->salProducts[]= new SaleItem([
                    'product'=>$product,
                    'qty' =>$data['qty'],
                    'total'=>  $product->price * $data['qty']
                ]);
            }
        }
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function removeSaleItem(int $id){
        foreach ($this->salProducts as $key => $salProduct){
            if(is_array($salProduct) && $salProduct['product']["id"] === $id){
                $reload = $this->salProducts;
               unset($reload[$key]);
               $this->salProducts =$reload;
                break;
            }
            if($salProduct instanceof SaleItem && $salProduct->product->id === $id){
                $reload = $this->salProducts;
                unset($reload[$key]);
                $this->salProducts =$reload;
                break;
            }
        }
    }

}
