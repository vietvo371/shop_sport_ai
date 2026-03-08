'use client';

import { useQuery } from '@tanstack/react-query';
import Image from 'next/image';
import { notFound } from 'next/navigation';
import { useState, useEffect } from 'react';
import { use } from 'react';
import { ShoppingCart } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { productService } from '@/services/product.service';
import { formatCurrency } from '@/lib/utils';
import { useCartStore } from '@/store/cart.store';
import { useCart } from '@/hooks/useCart';
import { toast } from 'sonner';

export default function ProductDetailPage({ params }: { params: Promise<{ slug: string }> }) {
    const { slug } = use(params);
    const [selectedSize, setSelectedSize] = useState<string | null>(null);
    const [quantity, setQuantity] = useState(1);
    const [activeImage, setActiveImage] = useState<string>('/placeholder.png');
    const { openCart } = useCartStore();
    const { addToCart, isAdding } = useCart();

    const { data: product, isLoading, isError } = useQuery({
        queryKey: ['product', slug],
        queryFn: () => productService.getProductBySlug(slug),
    });

    // Sync active image when product is loaded
    useEffect(() => {
        if (product) {
            const imagesList = product.hinh_anh || product.hinh_anh_san_pham;
            const initialImage = product.anh_chinh?.url
                || imagesList?.find((img) => img.la_anh_chinh)?.url
                || imagesList?.[0]?.url
                || '/placeholder.png';
            setActiveImage(initialImage);
        }
    }, [product]);

    if (isLoading) {
        return (
            <div className="container mx-auto px-4 py-8 animate-pulse">
                <div className="flex flex-col md:flex-row gap-8">
                    <div className="w-full md:w-1/2 aspect-square bg-slate-100 rounded-xl" />
                    <div className="w-full md:w-1/2 space-y-4">
                        <div className="h-8 bg-slate-100 rounded w-3/4" />
                        <div className="h-6 bg-slate-100 rounded w-1/4" />
                        <div className="h-24 bg-slate-100 rounded w-full" />
                    </div>
                </div>
            </div>
        );
    }

    if (isError || !product) {
        return notFound();
    }

    const imagesList = product.hinh_anh || product.hinh_anh_san_pham;

    // Extract unique sizes from variants
    const sizes = Array.from(new Set(product.bien_the?.map(v => v.kich_co).filter(Boolean) || product.bien_the_san_pham?.map(v => v.kich_co).filter(Boolean))) as string[];
    const currentPrice = product.gia_khuyen_mai || product.gia_goc;

    const handleAddToCart = async () => {
        if (sizes.length > 0 && !selectedSize) {
            toast.error('Vui lòng chọn kích cỡ/phân loại sản phẩm.');
            return;
        }

        let variantId = undefined;
        if (selectedSize) {
            const variants = product.bien_the || product.bien_the_san_pham || [];
            const matched = variants.find(v => v.kich_co === selectedSize);
            if (matched) variantId = matched.id;
        }

        try {
            await addToCart({
                san_pham_id: product.id,
                so_luong: quantity,
                bien_the_id: variantId,
            });
            toast.success('Đã thêm vào giỏ hàng');
            openCart();
        } catch (error: any) {
            toast.error(error.message || 'Có lỗi xảy ra khi thêm vào giỏ');
            if (error?.message?.includes('Unauth')) {
                // Should redirect to login? Interceptor handles 401 anyway.
            }
        }
    };

    return (
        <div className="container mx-auto px-4 py-8 max-w-6xl">
            <div className="flex flex-col md:flex-row gap-8 lg:gap-16">
                {/* Image Gallery */}
                <div className="w-full md:w-1/2 space-y-4">
                    <div className="relative aspect-square w-full rounded-2xl overflow-hidden bg-slate-50 border">
                        <Image
                            src={activeImage}
                            alt={product.ten_san_pham}
                            fill
                            className="object-cover"
                            priority
                        />
                        {product.noi_bat && (
                            <Badge className="absolute top-4 left-4 bg-amber-500 text-sm py-1">Hot</Badge>
                        )}
                    </div>

                    {imagesList && imagesList.length > 1 && (
                        <div className="flex gap-4 overflow-x-auto pb-2">
                            {imagesList.map((img) => {
                                const imgUrl = img.url || img.duong_dan_anh || '';
                                return (
                                    <div
                                        key={img.id}
                                        onClick={() => setActiveImage(imgUrl)}
                                        className={`relative w-20 h-20 rounded-lg overflow-hidden border shrink-0 cursor-pointer hover:ring-2 ring-primary transition-all ${activeImage === imgUrl ? 'ring-2 ring-primary border-primary' : 'border-slate-200'}`}
                                    >
                                        <Image src={imgUrl} alt="Thumbnail" fill className="object-cover" />
                                    </div>
                                );
                            })}
                        </div>
                    )}
                </div>

                {/* Product Info */}
                <div className="w-full md:w-1/2 flex flex-col">
                    {product.thuong_hieu && (
                        <span className="text-sm text-primary font-semibold uppercase tracking-wider mb-2">
                            {product.thuong_hieu.ten}
                        </span>
                    )}

                    <h1 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4 leading-tight">
                        {product.ten_san_pham}
                    </h1>

                    <div className="flex items-end gap-4 mb-6 pb-6 border-b">
                        <span className="text-3xl font-bold text-slate-900">
                            {formatCurrency(currentPrice)}
                        </span>
                        {product.gia_khuyen_mai && product.gia_khuyen_mai < product.gia_goc && (
                            <span className="text-lg text-muted-foreground line-through mb-1">
                                {formatCurrency(product.gia_goc)}
                            </span>
                        )}
                    </div>

                    <p className="text-slate-600 mb-8 leading-relaxed">
                        {product.mo_ta_ngan || 'Sản phẩm thể thao cao cấp chính hãng.'}
                    </p>

                    {/* Variants Selector (Size) */}
                    {sizes.length > 0 && (
                        <div className="mb-8">
                            <div className="flex justify-between items-center mb-4">
                                <span className="font-medium text-slate-900">Chọn kích cỡ:</span>
                                <span className="text-sm text-primary cursor-pointer hover:underline">Hướng dẫn chọn size</span>
                            </div>
                            <div className="flex flex-wrap gap-3">
                                {sizes.map((size) => (
                                    <button
                                        key={size}
                                        onClick={() => setSelectedSize(size)}
                                        className={`h-12 min-w-[3rem] px-4 rounded-lg border font-medium transition-all
                      ${selectedSize === size
                                                ? 'border-primary bg-primary text-primary-foreground'
                                                : 'border-slate-200 hover:border-slate-400 bg-white'}`}
                                    >
                                        {size}
                                    </button>
                                ))}
                            </div>
                        </div>
                    )}

                    {/* Add to Cart Actions */}
                    <div className="flex gap-4 mt-auto">
                        <div className="flex items-center border rounded-lg h-14">
                            <button
                                onClick={() => setQuantity(q => Math.max(1, q - 1))}
                                className="w-12 h-full flex items-center justify-center text-slate-500 hover:text-slate-900 transition-colors"
                            >
                                -
                            </button>
                            <span className="w-12 text-center font-medium">{quantity}</span>
                            <button
                                onClick={() => setQuantity(q => q + 1)}
                                className="w-12 h-full flex items-center justify-center text-slate-500 hover:text-slate-900 transition-colors"
                            >
                                +
                            </button>
                        </div>

                        <Button
                            size="lg"
                            className="flex-1 h-14 text-base gap-2"
                            onClick={handleAddToCart}
                            disabled={isAdding}
                        >
                            <ShoppingCart className="h-5 w-5" />
                            {isAdding ? 'Đang thêm...' : 'Thêm Vào Giỏ'}
                        </Button>
                    </div>
                </div>
            </div>

            {/* Full Description Section */}
            {product.mo_ta_day_du && (
                <div className="mt-16 pt-16 border-t">
                    <h2 className="text-2xl font-bold mb-8">Thông Tin Sản Phẩm</h2>
                    <div
                        className="prose prose-slate max-w-none"
                        dangerouslySetInnerHTML={{ __html: product.mo_ta_day_du }}
                    />
                </div>
            )}
        </div>
    );
}
