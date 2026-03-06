import Link from 'next/link';
import Image from 'next/image';
import { Product } from '@/types/product.types';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import { formatCurrency } from '@/lib/utils';
import { Badge } from '@/components/ui/badge';

interface ProductCardProps {
    product: Product;
}

export function ProductCard({ product }: ProductCardProps) {
    const mainImage = product.hinh_anh_san_pham?.find((img) => img.la_anh_chinh)?.url
        || product.hinh_anh_san_pham?.[0]?.url
        || '/placeholder.png'; // Fallback image

    const salePercent = product.gia_khuyen_mai && product.gia_khuyen_mai < product.gia_goc
        ? Math.round(((product.gia_goc - product.gia_khuyen_mai) / product.gia_goc) * 100)
        : 0;

    return (
        <Link href={`/products/${product.duong_dan}`}>
            <Card className="group overflow-hidden transition-all hover:shadow-lg border-0 bg-slate-50/50">
                <CardContent className="p-0 relative aspect-square">
                    <Image
                        src={mainImage}
                        alt={product.ten_san_pham}
                        fill
                        className="object-cover transition-transform duration-300 group-hover:scale-105"
                    />
                    {product.noi_bat && (
                        <Badge className="absolute top-2 left-2 bg-amber-500">Mới</Badge>
                    )}
                    {salePercent > 0 && (
                        <Badge variant="destructive" className="absolute top-2 right-2">
                            -{salePercent}%
                        </Badge>
                    )}
                </CardContent>
                <CardFooter className="flex flex-col items-start p-4 gap-2">
                    {product.thuong_hieu && (
                        <span className="text-xs text-muted-foreground uppercase font-semibold">
                            {product.thuong_hieu.ten}
                        </span>
                    )}
                    <h3 className="font-medium line-clamp-2 text-sm md:text-base group-hover:text-primary transition-colors">
                        {product.ten_san_pham}
                    </h3>
                    <div className="flex items-center gap-2 mt-auto pt-2">
                        <span className="font-bold text-lg text-primary">
                            {formatCurrency(product.gia_khuyen_mai || product.gia_goc)}
                        </span>
                        {product.gia_khuyen_mai && product.gia_khuyen_mai < product.gia_goc && (
                            <span className="text-sm text-muted-foreground line-through">
                                {formatCurrency(product.gia_goc)}
                            </span>
                        )}
                    </div>
                </CardFooter>
            </Card>
        </Link>
    );
}
