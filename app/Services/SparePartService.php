<?php

namespace App\Services;

use App\Models\SparePart;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SparePartService
{
    /**
     * Get all spare parts
     *
     * @return Collection
     */
    public function getAllSpareParts(): Collection
    {
        try {
            return SparePart::all();
        } catch (\Exception $e) {
            Log::error('Error fetching spare parts: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get spare part by ID
     *
     * @param int $id
     * @return SparePart
     */
    public function getSparePartById(int $id): SparePart
    {
        try {
            return SparePart::findOrFail($id);
        } catch (\Exception $e) {
            Log::error('Error fetching spare part by ID: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create new spare part
     *
     * @param array $data
     * @return SparePart
     */
    public function createSparePart(array $data): SparePart
    {
        try {
            $sparePart = SparePart::create($data);
            Log::info('Spare part created successfully: ' . $sparePart->name);
            return $sparePart;
        } catch (\Exception $e) {
            Log::error('Error creating spare part: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update spare part
     *
     * @param int $id
     * @param array $data
     * @return SparePart
     */
    public function updateSparePart(int $id, array $data): SparePart
    {
        try {
            $sparePart = SparePart::findOrFail($id);
            $sparePart->update($data);
            Log::info('Spare part updated successfully: ' . $sparePart->name);
            return $sparePart;
        } catch (\Exception $e) {
            Log::error('Error updating spare part: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete spare part
     *
     * @param int $id
     * @return bool
     */
    public function deleteSparePart(int $id): bool
    {
        try {
            $sparePart = SparePart::findOrFail($id);
            $sparePart->delete();
            Log::info('Spare part deleted successfully: ' . $sparePart->name);
            return true;
        } catch (\Exception $e) {
            Log::error('Error deleting spare part: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get all spare parts with low stock
     *
     * @param int $threshold
     * @return Collection
     */
    public function getLowStockSpareParts(int $threshold = 5): Collection
    {
        return SparePart::where('quantity', '<=', $threshold)->get();
    }
} 