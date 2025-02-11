<?php 

namespace App\Core\Data\Services;

use App\Core\Data\Entities\Sale;
use App\Core\Data\Repositories\SaleRepositoryInterface;
use App\Models\Sale as ModelsSale;
use Illuminate\Support\Collection;

class SaleService {

    public function all(): Collection {
        try {
            $eloquentSales = ModelsSale::all();
            $sales = $eloquentSales->map(function ($eloquentSale) {
                return Sale::fromSale($eloquentSale);
            });
            return $sales;
        } catch (\Exception $e) {
            return new Collection();
        }
    }

    public function find(int $id): ?Sale {
        try {
            $eloquentSale = ModelsSale::find($id);
            return Sale::fromSale($eloquentSale);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function create(Sale $sale): ?Sale {
        try {
            $eloquentSale = new ModelsSale();
            $eloquentSale->client_id = $sale->client_id;
            $eloquentSale->client_name = $sale->client_name;
            $eloquentSale->client_email = $sale->client_email;
            $eloquentSale->client_phone = $sale->client_phone;
            $eloquentSale->client_address = $sale->client_address;
            $eloquentSale->client_city = $sale->client_city;
            $eloquentSale->client_state = $sale->client_state;
            $eloquentSale->client_zip = $sale->client_zip;
            $eloquentSale->client_country = $sale->client_country;
            $eloquentSale->client_rfc = $sale->client_rfc;
            $eloquentSale->client_type_id = $sale->client_type_id;
            $eloquentSale->save();
            return Sale::fromSale($eloquentSale);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update(Sale $sale): ?Sale {
        try {
            $eloquentSale = ModelsSale::find($sale->id);
            $eloquentSale->client_id = $sale->client_id;
            $eloquentSale->client_name = $sale->client_name;
            $eloquentSale->client_email = $sale->client_email;
            $eloquentSale->client_phone = $sale->client_phone;
            $eloquentSale->client_address = $sale->client_address;
            $eloquentSale->client_city = $sale->client_city;
            $eloquentSale->client_state = $sale->client_state;
            $eloquentSale->client_zip = $sale->client_zip;
            $eloquentSale->client_country = $sale->client_country;
            $eloquentSale->client_rfc = $sale->client_rfc;
            $eloquentSale->client_type_id = $sale->client_type_id;
            $eloquentSale->save();
            return Sale::fromSale($eloquentSale);
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete(int $id): bool {
        try {
            $eloquentSale = ModelsSale::find($id);
            $eloquentSale->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function searchSales(string $searchTerm): Collection {
        try {
            // TODO: Implement searchSales() method.
            return new Collection();
        } catch (\Exception $e) {
            return new Collection();
        }
    }
    
    
}