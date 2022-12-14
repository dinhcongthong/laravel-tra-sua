<?php
namespace App\Http\Repositories\Option;

use App\Http\Repositories\RepositoryInterface;

interface OptionRepositoryInterface extends RepositoryInterface
{
    public function getModel();

    public function getOptionContent ($optionCategoryId, $productId);

    public function getIdsByCategory ($categoryId);
}
