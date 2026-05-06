<?php

namespace App\Events;

use App\Models\DonHang;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderReceived implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public DonHang $donHang) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('admin'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'NewOrderReceived';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->donHang->id,
            'ma_don_hang' => $this->donHang->ma_don_hang,
            'tong_tien' => $this->donHang->tong_tien,
            'ten_khach' => $this->donHang->nguoiDung?->ho_va_ten ?? 'Khách',
            'created_at' => $this->donHang->created_at->toISOString(),
        ];
    }
}
