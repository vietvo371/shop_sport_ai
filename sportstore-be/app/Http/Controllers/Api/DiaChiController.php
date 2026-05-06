<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DiaChi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 4. Thông tin cá nhân & Địa chỉ
 * @subgroup Sổ địa chỉ
 *
 * Quản lý sổ địa chỉ giao hàng của người dùng.
 * @authenticated
 */
class DiaChiController extends Controller
{
    /**
     * Danh sách địa chỉ
     */
    public function index(Request $request): JsonResponse
    {
        return ApiResponse::success($request->user()->diaChi, 'Danh sách địa chỉ');
    }

    /**
     * Thêm địa chỉ mới
     *
     * @bodyParam ho_va_ten string required Họ và tên người nhận. Example: Nguyễn Văn B
     * @bodyParam so_dien_thoai string required Số điện thoại nhận hàng. Example: 0988777666
     * @bodyParam tinh_thanh string required Tỉnh/Thành phố. Example: Hà Nội
     * @bodyParam quan_huyen string required Quận/Huyện. Example: Cầu Giấy
     * @bodyParam phuong_xa string required Phường/Xã. Example: Dịch Vọng
     * @bodyParam dia_chi_cu_the string required Số nhà, đường. Example: 123 Xuân Thủy
     * @bodyParam la_mac_dinh boolean Đặt làm địa chỉ mặc định (true/false). Example: true
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ho_va_ten'       => ['required', 'string', 'min:2', 'max:100', 'regex:/^[\p{L}]+(?:\s+[\p{L}]+)+$/u'],
            'so_dien_thoai'   => ['required', 'string', 'regex:/^(84|0[35789])[0-9]{8}$/'],
            'tinh_thanh'      => 'required|string|max:100',
            'quan_huyen'      => 'required|string|max:100',
            'phuong_xa'       => 'required|string|max:100',
            'dia_chi_cu_the'  => 'required|string|min:5|max:255',
            'la_mac_dinh'     => 'boolean',
        ], [
            'ho_va_ten.min' => 'Họ tên phải có ít nhất 2 ký tự.',
            'ho_va_ten.regex' => 'Vui lòng nhập đầy đủ họ và tên.',
            'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ.',
            'dia_chi_cu_the.min' => 'Địa chỉ cụ thể phải có ít nhất 5 ký tự.',
        ]);

        $uid = $request->user()->id;
        if (!empty($data['la_mac_dinh'])) {
            DiaChi::where('nguoi_dung_id', $uid)->update(['la_mac_dinh' => false]);
        }

        $address = DiaChi::create(['nguoi_dung_id' => $uid, ...$data]);
        return ApiResponse::created($address, 'Đã thêm địa chỉ');
    }

    /**
     * Lấy chi tiết một địa chỉ
     *
     * @urlParam id int required ID của địa chỉ. Example: 1
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $address = DiaChi::where('nguoi_dung_id', $request->user()->id)->findOrFail($id);
        return ApiResponse::success($address, 'Chi tiết địa chỉ');
    }

    /**
     * Cập nhật địa chỉ
     *
     * @urlParam id int required ID của địa chỉ cần sửa. Example: 1
     * @bodyParam ho_va_ten string Họ và tên người nhận. Example: Nguyễn Văn B
     * @bodyParam so_dien_thoai string Số điện thoại nhận hàng. Example: 0988777666
     * @bodyParam tinh_thanh string Tỉnh/Thành phố. Example: Hồ Chí Minh
     * @bodyParam quan_huyen string Quận/Huyện. Example: Quận 1
     * @bodyParam phuong_xa string Phường/Xã. Example: Bến Nghé
     * @bodyParam dia_chi_cu_the string Số nhà, đường. Example: Tòa nhà Bitexco
     * @bodyParam la_mac_dinh boolean Đặt làm địa chỉ mặc định (true/false). Example: true
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $address = DiaChi::where('nguoi_dung_id', $request->user()->id)->findOrFail($id);
        $data = $request->validate([
            'ho_va_ten'      => ['sometimes', 'string', 'min:2', 'max:100', 'regex:/^[\p{L}]+(?:\s+[\p{L}]+)+$/u'],
            'so_dien_thoai'  => ['sometimes', 'string', 'regex:/^(84|0[35789])[0-9]{8}$/'],
            'tinh_thanh'     => 'sometimes|string|max:100',
            'quan_huyen'     => 'sometimes|string|max:100',
            'phuong_xa'      => 'sometimes|string|max:100',
            'dia_chi_cu_the' => 'sometimes|string|min:5|max:255',
            'la_mac_dinh'    => 'boolean',
        ], [
            'ho_va_ten.min' => 'Họ tên phải có ít nhất 2 ký tự.',
            'ho_va_ten.regex' => 'Vui lòng nhập đầy đủ họ và tên.',
            'so_dien_thoai.regex' => 'Số điện thoại không hợp lệ.',
            'dia_chi_cu_the.min' => 'Địa chỉ cụ thể phải có ít nhất 5 ký tự.',
        ]);
        if (!empty($data['la_mac_dinh'])) {
            DiaChi::where('nguoi_dung_id', $request->user()->id)->update(['la_mac_dinh' => false]);
        }
        $address->update($data);
        return ApiResponse::success($address, 'Đã cập nhật địa chỉ');
    }

    /**
     * Xóa địa chỉ
     *
     * @urlParam id int required ID của địa chỉ cần xóa. Example: 1
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        DiaChi::where('nguoi_dung_id', $request->user()->id)->findOrFail($id)->delete();
        return ApiResponse::deleted('Đã xóa địa chỉ');
    }
}
