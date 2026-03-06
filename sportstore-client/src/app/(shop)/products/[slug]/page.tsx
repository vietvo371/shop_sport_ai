'use client';

import { useQuery } from '@tanstack/react-query';
import Image from 'next/image';
import { notFound } from 'next/navigation';
import { useState } from 'react';
import { use } from 'react';
import { ShoppingCart } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import { productService } from '@/services/product.service';
import { formatCurrency } from '@/lib/utils';
import { useCartStore } from '@/store/cart.store';

export default function ProductDetailPage({ params }: { params: Promise<{ slug: string }> }) {
    const { slug } = use(params);
    const [selectedSize, setSelectedSize] = useState<string | null>(null);
    const [quantity, setQuantity] = useState(1);
    const { openCart, setItemCount } = useCartStore(); // Using dummy setItemCount for now

    const { data: product, isLoading, isError } = useQuery({
        queryKey: ['product', slug],
        queryFn: () => productService.getProductBySlug(slug),
    });

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

    const mainImage = product.hinh_anh_san_pham?.find((img) => img.la_anh_chinh)?.url
        || product.hinh_anh_san_pham?.[0]?.url
        || '/placeholder.png';

    // Extract unique sizes from variants
    const sizes = Array.from(new Set(product.bien_the_san_pham?.map(v => v.kich_co).filter(Boolean))) as string[];
    const currentPrice = product.gia_khuyen_mai || product.gia_goc;

    const handleAddToCart = () => {
        // Basic placeholder action
        setItemCount(useCartStore.getState().itemCount + quantity);
        openCart();
    };

    return (
        <div className="container mx-auto px-4 py-8 max-w-6xl">
            <div className="flex flex-col md:flex-row gap-8 lg:gap-16">
                {/* Image Gallery */}
                <div className="w-full md:w-1/2 space-y-4">
                    <div className="relative aspect-square w-full rounded-2xl overflow-hidden bg-slate-50 border">
                        <Image
                            src={mainImage}
                            alt={product.ten_san_pham}
                            fill
                            className="object-cover"
                            priority
                        />
                        {product.noi_bat && (
                            <Badge className="absolute top-4 left-4 bg-amber-500 text-sm py-1">Hot</Badge>
                        )}
                    </div>

                    {product.hinh_anh_san_pham && product.hinh_anh_san_pham.length > 1 && (
                        <div className="flex gap-4 overflow-x-auto pb-2">
                            {product.hinh_anh_san_pham.map((img) => (
                                <div key={img.id} className="relative w-20 h-20 rounded-lg overflow-hidden border shrink-0 cursor-pointer hover:ring-2 ring-primary">
                                    <Image src={img.url || img.duong_dan_anh} alt="Thumnail" fill className="object-cover" />
                                </div>
                            ))}
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
                        >
                            <ShoppingCart className="h-5 w-5" />
                            Thêm Vào Giỏ
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
