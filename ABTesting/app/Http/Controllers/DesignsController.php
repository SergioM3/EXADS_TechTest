<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designs;
use App\Services\DesignsService;

class DesignsController extends Controller
{
    // GET Controllers
    public static function getDesignByPromoAndDesignId($promoId, $designId)
    {
        $designsService = new DesignsService();
        return $designsService->getDesignByPromoAndDesignId($promoId, $designId);
    }
}
