<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Find the category by name or create it if it doesn't exist
        $category = Category::firstOrCreate(['name' => $row['category']]);

        return new Product([
            'name'     => $row['name'],
            'description'    => $row['description'], 
            'gender'    => $row['gender'], 
            'price'    => $row['price'],
            'category_id' => $category->id,
            // 'category_id' => $category->id, 
        ]);
    }
}
