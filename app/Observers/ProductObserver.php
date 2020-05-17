<?php

namespace App\Observers;

use App\Product;
use App\ReportView;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        // By the way, we can to do that:
        //$product->reportViews()
        //->save(new ReportView(Array of required attributes...));
        // but need to allow expected attributes in fillable property of the model...

        $views = new ReportView();
        $views->user()
        ->associate(auth()->user());
        $views->total_views = 0;

        $product->reportViews()
        ->save($views);
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
