<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * ApiResponse — Chuẩn hóa toàn bộ JSON response cho sportstore-be
 *
 * ⚠️ QUAN TRỌNG: Mọi response trong Controller đều phải dùng class này.
 * Không sử dụng response()->json() trực tiếp.
 *
 * @example
 *   return ApiResponse::success($data, 'Thành công');
 *   return ApiResponse::error('Không tìm thấy', 404);
 *   return ApiResponse::paginate($paginator, 'Lấy danh sách thành công');
 */
class ApiResponse
{
    /**
     * Response thành công cơ bản.
     *
     * @param mixed  $data    Dữ liệu trả về (array, object, Resource...)
     * @param string $message Thông báo hiển thị
     * @param int    $status  HTTP status code (mặc định 200)
     */
    public static function success(
        mixed $data = null,
        string $message = 'Thành công',
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    /**
     * Response lỗi.
     *
     * @param string     $message Thông báo lỗi
     * @param int        $status  HTTP status code (mặc định 400)
     * @param mixed|null $errors  Chi tiết lỗi (validation errors...)
     */
    public static function error(
        string $message = 'Có lỗi xảy ra',
        int $status = 400,
        mixed $errors = null
    ): JsonResponse {
        $payload = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors !== null) {
            $payload['errors'] = $errors;
        }

        return response()->json($payload, $status);
    }

    /**
     * Response có phân trang.
     *
     * @param LengthAwarePaginator $paginator Kết quả paginate từ Eloquent
     * @param string               $message   Thông báo
     */
    public static function paginate(
        LengthAwarePaginator $paginator,
        string $message = 'Thành công'
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $paginator->items(),
            'meta'    => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'from'         => $paginator->firstItem(),
                'to'           => $paginator->lastItem(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last'  => $paginator->url($paginator->lastPage()),
                'prev'  => $paginator->previousPageUrl(),
                'next'  => $paginator->nextPageUrl(),
            ],
        ], 200);
    }

    /**
     * Response 404 Not Found.
     *
     * @param string $message Thông báo (mặc định tiếng Việt)
     */
    public static function notFound(string $message = 'Không tìm thấy dữ liệu'): JsonResponse
    {
        return self::error($message, 404);
    }

    /**
     * Response 401 Unauthorized.
     *
     * @param string $message Thông báo
     */
    public static function unauthorized(string $message = 'Vui lòng đăng nhập để tiếp tục'): JsonResponse
    {
        return self::error($message, 401);
    }

    /**
     * Response 403 Forbidden.
     *
     * @param string $message Thông báo
     */
    public static function forbidden(string $message = 'Bạn không có quyền thực hiện thao tác này'): JsonResponse
    {
        return self::error($message, 403);
    }

    /**
     * Response 422 Validation Error.
     * Thường được gọi khi FormRequest validation thất bại.
     *
     * @param mixed  $errors  Mảng lỗi validation (từ $validator->errors())
     * @param string $message Thông báo chung
     */
    public static function validationError(
        mixed $errors,
        string $message = 'Dữ liệu không hợp lệ'
    ): JsonResponse {
        return self::error($message, 422, $errors);
    }

    /**
     * Response tạo mới thành công (201 Created).
     *
     * @param mixed  $data    Dữ liệu vừa tạo
     * @param string $message Thông báo
     */
    public static function created(
        mixed $data = null,
        string $message = 'Tạo mới thành công'
    ): JsonResponse {
        return self::success($data, $message, 201);
    }

    /**
     * Response xóa thành công (200 với data = null).
     *
     * @param string $message Thông báo
     */
    public static function deleted(string $message = 'Xóa thành công'): JsonResponse
    {
        return self::success(null, $message, 200);
    }

    /**
     * Response 500 Server Error.
     *
     * @param string $message Thông báo (ẩn chi tiết lỗi với user)
     */
    public static function serverError(string $message = 'Lỗi hệ thống, vui lòng thử lại sau'): JsonResponse
    {
        return self::error($message, 500);
    }
}
