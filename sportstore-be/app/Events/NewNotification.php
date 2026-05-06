<?php

namespace App\Events;

use App\Models\ThongBao;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public ThongBao $thongBao) {}

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user.' . $this->thongBao->nguoi_dung_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'NewNotification';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->thongBao->id,
            'loai' => $this->thongBao->loai,
            'tieu_de' => $this->thongBao->tieu_de,
            'noi_dung' => $this->thongBao->noi_dung,
            'created_at' => (string) $this->thongBao->created_at,
        ];
    }
}
