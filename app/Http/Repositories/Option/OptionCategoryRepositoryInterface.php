<?php
namespace App\Http\Repositories\Option;

use App\Http\Repositories\RepositoryInterface;

interface OptionCategoryRepositoryInterface extends RepositoryInterface
{
    public function getModel();
}
