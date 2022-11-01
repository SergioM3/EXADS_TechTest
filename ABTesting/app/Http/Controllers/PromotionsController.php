<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotions;
use App\Services\PromotionsService;

class PromotionsController extends Controller
{
    // GET Controllers
    public static function getAllDesignsByPromoId($promoId)
    {
        $promotionsService = new PromotionsService();
        return $promotionsService->getAllDesignsByPromoId($promoId);
    }
}
