{{ include('layouts/header.php', {title: 'Home'}) }}

    <h1 class="page__title">NOMAD Shop</h1>
    <p class="page__subtitle">Order management</p>

    <div class="page__actions">
        <a href="{{ base }}/orders" class="btn btn--primary">View orders</a>
        <a href="{{ base }}/order/create" class="btn">New order</a>
    </div>

{{ include('layouts/footer.php') }}