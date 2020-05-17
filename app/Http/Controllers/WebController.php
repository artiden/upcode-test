<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class WebController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        // In the real project I should check date format here. But I'm using query param binding, so we get just empty result if date will be incorrect :)
        return view('welcome', [
            'products' => $this->repository->getProducts($request->get('date', null)),
        ]);
    }
}
