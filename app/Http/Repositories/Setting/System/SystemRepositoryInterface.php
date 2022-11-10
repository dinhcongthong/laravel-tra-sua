<?php
namespace App\Http\Repositories\Setting\System;

use App\Http\Repositories\RepositoryInterface;

interface SystemRepositoryInterface extends RepositoryInterface
{
    public function getModel();

    /**
     * Set model
     */
    public function setModel();
}
