<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="invoice.css"></head>
<body style="padding: 3rem">
<div class="text-center">

</div>
<h1> Competition Report</h1>
<div class="card-content collapse show">
    <div class="card-body card-dashboard">
        <table class="table display nowrap table-striped table-bordered scroll-horizontal">
            <thead  class="">
            <tr>

                <th>Users</th>
                <th>SalesPeople</th>
                <th>DeliveryMen</th>
                <th>Categories</th>
                <th>Brand</th>
                <th>Product</th>
                <th>Order</th>
                <th>Article</th>
                <th>Copoun</th>

            </tr>
            </thead>

            <tbody>
            <tr>
                <td>{{App\Models\User::count()}}</td>
                <td>{{App\Models\SalesPerson::count()}}</td>
                <td>{{App\Models\DeliveryMan::count()}}</td>
                <td>{{App\Models\Category::count()}}</td>
                <td>{{App\Models\Brand::count()}}</td>
                <td>{{App\Models\Product::count()}}</td>
                <td>{{App\Models\Order::count()}}</td>
                <td>{{App\Models\Article::count()}}</td>
                <td>{{App\Models\Cobon::count()}}</td>

            </tr>

            </tbody>

        </table>
        <div class="justify-content-center d-flex">

        </div>
    </div>
</div>
</body>
</html>
