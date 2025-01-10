<?php 

namespace App\Core\Services;

use App\Core\Data\Entities\Event;
use App\Core\Data\Repositories\ProductRepositoryInterface;
use App\Core\Data\Services\ProductAssignamentServiceInterface;
use App\Models\Event as ModelsEvent;

class EloquentProductAssignamentService implements ProductAssignamentServiceInterface {

    public function __construct(private ProductRepositoryInterface $productRepository) {}

    public function assignToEvent(Event $event): Event {
        logger('assignProductToEvent');
        $packageIds = $event->packages->pluck('id')->toArray();
        $products = $this->productRepository->getByPackageIds($packageIds);
        $eloquentEvent = ModelsEvent::find($event->id);

        $syncData = $products->mapWithKeys(function ($product) {
            return [
                $product['product']->id => [
                    'quantity' => $product['quantity']
                ]
            ];
        })->toArray();

        $eloquentEvent->products()->sync($syncData);

        $event->products = $products;
        logger($event);
        return $event;
    }

}