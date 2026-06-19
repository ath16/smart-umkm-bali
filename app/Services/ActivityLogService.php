<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogService
{
    /**
     * Log an activity.
     *
     * @param int|null $storeId
     * @param int $userId
     * @param string $action
     * @param string $description
     * @return ActivityLog
     */
    public function log(?int $storeId, int $userId, string $action, string $description): ActivityLog
    {
        return ActivityLog::create([
            'store_id' => $storeId,
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
        ]);
    }

    /**
     * Get activity logs for a specific store.
     *
     * @param int $storeId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLogsForStore(int $storeId, int $perPage = 15)
    {
        return ActivityLog::with('user')
            ->where('store_id', $storeId)
            ->latest()
            ->paginate($perPage);
    }
}
