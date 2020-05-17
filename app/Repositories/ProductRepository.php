<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Product;

class ProductRepository
{
    /**
     * Store newly created or updated product
     * 
     * @param string $title
     * @param Product|null $product
     * @return boolean
     */
    public function storeProduct(string $title, Product $product = null)
    {
        $product = $product ?? new Product();

        $product->title = $title;

        return $product->save();
    }

    /**
     * Get products details
     * 
     * @param string $date
     * @return \Illuminate\Support\Collection
     */
    public function getProducts(string $date = null)
    {
        $product = DB::table("products")
        ->selectRaw("products.id as productId, products.title as productName, CONCAT(((sum(report.purchased) / sum(report_views.total_views)) * 100), '%') as purchasedPercentage")
        ->leftJoin('report', 'report.product_id', '=', 'products.id')
        ->leftJoin('report_views', 'report_views.product_id', '=', 'products.id');

        if (!is_null($date)) {
            $product->whereRaw('date(report.created_at) = ?', $date)
            ->whereRaw('date(report_views.created_at) = ?', $date);
        }

        return $product->groupBy('products.id')
        ->get();
    }

    /**
     * Get information about product and it report view as eager load. 
     * 
     * @param Product $product
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Builder|NULL
     */
    public function getProduct(Product $product)
    {
        return Product::with('reportViews')
        ->find($product->id);
    }

    /**
     * Delete given product
     * 
     * @param Product $product
     * @return boolean|NULL
     */
    public function deleteProduct(Product $product)
    {
        return $product->delete();
    }
}
