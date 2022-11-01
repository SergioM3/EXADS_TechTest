<?php

namespace App\Services;

use Exads\ABTestData;
use Illuminate\Http\Request;

class DesignsService
{
    public function getDesignByPromoAndDesignId($promoId, $designId)
    {
        $abTest = new ABTestData($promoId);
        $designs = $abTest->getAllDesigns();
        foreach ($designs as $design) {
            if ($design["designId"] == $designId) {
                return $design;
            }
        }
        return null;
    }
}
