<?php

namespace App\Http\Controllers\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSearchRequest;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    protected $pagination;
    /**
     * index function
     *
     * @param Request $request
     * @return View
     */

    public function __construct()
    {
        $this->pagination = config('app.pagination');
    }

    public function index(CustomerSearchRequest $request): JsonResponse
    {
        try {
            $customers = Customer::with(['orders.items']);

            $hasFilters = $this->hasFilters($request);

            if ($hasFilters) {
                $customers = $this->applyFilters($customers, $request);
            } else {
                $customers->whereHas('orders.items');
            }

            $pagination = $request->input('pagination', $this->pagination);
            $customers = $customers->paginate($pagination);

            return response()->json([
                'success' => true,
                'data' => $customers,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error retrieving customers: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving customers.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Check if there are any filters in the request
     *
     * @param Request $request
     * @return bool
     */
    public function hasFilters(Request $request): bool
    {
        return $request->filled('search') && $request->filled('based_on');
    }

    /**
     * Apply filters to the customers query
     *
     * @param object $customers
     * @param Request $request
     * @return object
     */
    public function applyFilters($customers, Request $request): object
    {
        $search = $request->input('search');
        $basedOn = $request->input('based_on');

        switch ($basedOn) {
            case 'email':
                $customers->where('email', 'like', '%' . $search . '%');
                break;

            case 'order_number':
                $customers->whereHas('orders', function ($query) use ($search) {
                    $query->where('order_number', 'like', '%' . $search . '%');
                });
                break;

            case 'item_name':
                $customers->whereHas('orders.items', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
                break;
        }

        return $customers;
    }
}
