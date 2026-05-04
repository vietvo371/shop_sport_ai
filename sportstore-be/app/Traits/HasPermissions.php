<?php

namespace App\Traits;

use App\Models\VaiTro;
use App\Models\Quyen;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use App\Events\UserRolesUpdated;

trait HasPermissions
{
    /**
     * Relationship: Vai trò của người dùng
     */
    public function cacVaiTro(): BelongsToMany
    {
        return $this->belongsToMany(VaiTro::class, 'nguoi_dung_vai_tro', 'nguoi_dung_id', 'vai_tro_id');
    }

    /**
     * Xóa cache quyền của user
     */
    public function forgetPermissionsCache(): void
    {
        Cache::forget("user_{$this->id}_permissions");
    }

    /**
     * Kiểm tra người dùng có một quyền cụ thể không
     */
    public function hasPermission(string $permissionSlug): bool
    {
        if ($this->is_master) {
            return true;
        }

        $permissions = Cache::remember("user_{$this->id}_permissions", 3600, function () {
            return $this->cacVaiTro()
                ->with('quyen')
                ->get()
                ->pluck('quyen')
                ->flatten()
                ->pluck('ma_slug')
                ->unique()
                ->toArray();
        });

        return in_array($permissionSlug, $permissions);
    }

    /**
     * Kiểm tra người dùng có một vai trò cụ thể không
     */
    public function hasRole(string $roleSlug): bool
    {
        return $this->cacVaiTro()->where('ma_slug', $roleSlug)->exists();
    }

    /**
     * Kiểm tra có phải là Admin (Super Admin) hay không
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }
}
