<?php

namespace App\Services;

use Exads\ABTestData;
use Illuminate\Http\Request;

class PromotionsService
{
    public function getAllDesignsByPromoId($promoId)
    {
        $abTest = new ABTestData($promoId);
        return $abTest->getAllDesigns();
    }
}
