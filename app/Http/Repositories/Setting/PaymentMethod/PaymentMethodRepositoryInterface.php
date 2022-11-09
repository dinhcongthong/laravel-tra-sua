<?php
namespace App\Http\Repositories\Setting\PaymentMethod;

use App\Http\Repositories\RepositoryInterface;

interface PaymentMethodRepositoryInterface extends RepositoryInterface
{
    public function getModel();

    /**
     * Set model
     */
    public function setModel();

    public function getAllBySearchData($searchData);

    public function getActiveItems();
}
