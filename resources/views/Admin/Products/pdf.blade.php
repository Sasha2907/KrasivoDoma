<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список товаров</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
<h2 style="text-align: center;">Список товаров</h2>
<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Материал</th>
        <th>Цена</th>
        <th>Категория</th>
        <th>Поставщик</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->material }}</td>
            <td>{{ $product->price }} BYN</td>
            <td>{{ $product->category->name ?? 'Нет категории' }}</td>
            <td>{{ $product->supplier->name ?? 'Нет поставщика' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
