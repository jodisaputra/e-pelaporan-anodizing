<?php

namespace App\Services;

use App\Models\Action;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class ActionService
{
    /**
     * Get all actions
     *
     * @return Collection
     */
    public function getAllActions(): Collection
    {
        try {
            return Action::with('sparePart')->get();
        } catch (\Exception $e) {
            Log::error('Error fetching actions: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get action by ID
     *
     * @param int $id
     * @return Action
     */
    public function getActionById(int $id): Action
    {
        try {
            return Action::with('sparePart')->findOrFail($id);
        } catch (\Exception $e) {
            Log::error('Error fetching action by ID: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create new action
     *
     * @param array $data
     * @return Action
     */
    public function createAction(array $data): Action
    {
        try {
            $sparePart = \App\Models\SparePart::findOrFail($data['spare_part_id']);
            if ($sparePart->quantity < $data['spare_part_quantity']) {
                throw new \Exception('Not enough stock for the selected spare part.');
            }
            $sparePart->quantity -= $data['spare_part_quantity'];
            $sparePart->save();

            $action = Action::create($data);
            Log::info('Action created successfully: ' . $action->action_id);
            return $action;
        } catch (\Exception $e) {
            Log::error('Error creating action: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update action
     *
     * @param int $id
     * @param array $data
     * @return Action
     */
    public function updateAction(int $id, array $data): Action
    {
        try {
            $action = Action::findOrFail($id);
            $sparePart = \App\Models\SparePart::findOrFail($data['spare_part_id']);

            // Restore previous stock
            $sparePart->quantity += $action->spare_part_quantity;

            // Check if enough stock for new quantity
            if ($sparePart->quantity < $data['spare_part_quantity']) {
                throw new \Exception('Not enough stock for the selected spare part.');
            }
            $sparePart->quantity -= $data['spare_part_quantity'];
            $sparePart->save();

            $action->update($data);
            Log::info('Action updated successfully: ' . $action->action_id);
            return $action;
        } catch (\Exception $e) {
            Log::error('Error updating action: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete action
     *
     * @param int $id
     * @return bool
     */
    public function deleteAction(int $id): bool
    {
        try {
            $action = Action::findOrFail($id);
            $sparePart = \App\Models\SparePart::find($action->spare_part_id);
            if ($sparePart) {
                $sparePart->quantity += $action->spare_part_quantity;
                $sparePart->save();
            }
            $action->delete();
            Log::info('Action deleted successfully: ' . $action->action_id);
            return true;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Tried to delete non-existent action: ' . $id);
            throw new \Exception('Action not found or already deleted.');
        } catch (\Exception $e) {
            Log::error('Error deleting action: ' . $e->getMessage());
            throw $e;
        }
    }
} 