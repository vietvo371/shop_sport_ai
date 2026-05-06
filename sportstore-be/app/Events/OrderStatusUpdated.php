<?php

namespace App\Events;

use App\Models\DonHang;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public DonHang $donHang) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.' . $this->donHang->nguoi_dung_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'OrderStatusUpdated';
    }

    public function broadcastWith(): array
    {
        return [
            'ma_don_hang' => $this->donHang->ma_don_hang,
            'trang_thai' => $this->donHang->trang_thai,
            'trang_thai_tt' => $this->donHang->trang_thai_tt,
        ];
    }
}
