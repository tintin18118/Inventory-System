<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock Alert</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px;">
        <h2 style="color: #dc3545; margin-top: 0;">⚠️ Low Stock Alert</h2>
        <p>Hello,</p>
        <p>The following products have fallen below their minimum stock levels and require immediate attention:</p>
        
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0; background-color: white;">
            <thead>
                <tr style="background-color: #e9ecef;">
                    <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Product</th>
                    <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">SKU</th>
                    <th style="padding: 12px; text-align: center; border: 1px solid #dee2e6;">Current</th>
                    <th style="padding: 12px; text-align: center; border: 1px solid #dee2e6;">Min</th>
                    <th style="padding: 12px; text-align: left; border: 1px solid #dee2e6;">Supplier</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $product->name }}</td>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $product->sku }}</td>
                    <td style="padding: 12px; text-align: center; border: 1px solid #dee2e6; color: #dc3545; font-weight: bold;">
                        {{ $product->quantity }}
                    </td>
                    <td style="padding: 12px; text-align: center; border: 1px solid #dee2e6;">
                        {{ $product->minimum_stock }}
                    </td>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $product->supplier->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
            <strong>Action Required:</strong><br>
            Please review these items and restock as needed to maintain optimal inventory levels.
        </div>
        
        <p style="margin-top: 20px;">
            <a href="{{ url('/products') }}" style="display: inline-block; background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                View Products
            </a>
        </p>
        
        <hr style="margin: 30px 0; border: none; border-top: 1px solid #dee2e6;">
        
        <p style="font-size: 12px; color: #6c757d;">
            This is an automated alert from your Inventory Management System.<br>
            Date: {{ now()->format('F d, Y H:i A') }}
        </p>
    </div>
</body>
</html>