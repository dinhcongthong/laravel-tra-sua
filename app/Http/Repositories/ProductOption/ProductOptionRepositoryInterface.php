<?php
namespace App\Http\Repositories\ProductOption;

use App\Http\Repositories\RepositoryInterface;

interface ProductOptionRepositoryInterface extends RepositoryInterface
{
    public function getModel();

    /**
     * Set model
     */
    public function setModel();
}
