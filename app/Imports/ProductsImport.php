<?php

namespace App\Imports;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
        $products = collect();
        if (count($collection) > 0) {
            $productsExcel = $collection;
            foreach ($productsExcel as $index => $productExcel) {
                //First row is the header
                if ($index > 0) {
                    //add product to collection
                    $product = collect([
                        "name" => $productExcel[0],
                        "shape" => $productExcel[1],
                        "Duration" => $productExcel[2],
                        "Shots" => $productExcel[3],
                        "Caliber" => $productExcel[4],
                        "Price" => $productExcel[5],
                        "Stock" => $productExcel[6],

                    ]);
                    if ($product['name'] != null) {

                        $this->addProductToDB($product);

                        $this->addProductsToInventory($product);
                        $products->push($product);
                    }
                }
            }
        }
        return $products;
    }

    private function addProductToDB($product)
    {
        $productDB = new Product();
        $productDB->product_role_id = 1;
        $productDB->name = $product['name'] ?? "";
        $productDB->description = $product['name'];
        $productDB->unit = "pza";
        $productDB->duration = $product['Duration'];
        $productDB->shots = $product['Shots'];
        $productDB->caliber = $product['Caliber'];
        $productDB->shape = $product['shape'];
        $productDB->save();
    }

    private function addProductsToInventory($product)
    {
        $inventory = Inventory::find(1);

        $productDB = Product::where('name', $product['name'])->where('shots', $product['Shots'])->where('caliber', $product['Caliber'])->where('shape', $product['shape'])->first();

        $inventory->products()->attach($productDB->id, [
            'quantity' => $product['Stock'],
            'price' => $product['Price'],
        ]);

    }
}
