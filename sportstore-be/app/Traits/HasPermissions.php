<?php

namespace App\Traits;

use App\Models\VaiTro;
use App\Models\Quyen;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;

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
     * Kiểm tra người dùng có một quyền cụ thể không
     */
    public function hasPermission(string $permissionSlug): bool
    {
        // Cache permissions list for the current user during the request
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
        return $this->cacVaiTro->contains('ma_slug', $roleSlug);
    }

    /**
     * Kiểm tra có phải là Admin (Super Admin) hay không
     * Đây là hàm helper để tương thích với logic cũ hoặc check nhanh
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }
}
