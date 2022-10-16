<?php
namespace App\Http\Repositories\Product;

interface ProductRepositoryInterface
{
    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getProductHost();
}
