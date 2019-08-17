<?php


namespace App\Services;


use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductService
{
    /**
     * @param  ProductRepository  $repository
     * @param $path
     * @return int
     */
    public static function import(ProductRepository $repository, $path) : int
    {
        $count = 0;
        $reader = Excel::load(storage_path("app/$path"));
        $results = $reader->toArray();
        foreach ($results as $row) {
            $numRow = array_values($row);
            /** @var Collection $found */
            $found = $repository->findByField('name', $numRow[0]);
            if($found->isNotEmpty())
                continue;

            $attributes['name'] = $numRow[0];
            $attributes['description'] = $numRow[1];
            $attributes['price'] = $numRow[2];
            $attributes['category_id'] = $numRow[3];

            $repository->create($attributes);
            $count++;
        }

        Storage::delete($path);

        return $count;
    }

}
