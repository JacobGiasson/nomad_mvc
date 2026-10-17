{{ include('layouts/header.php', {title: 'Order #' ~ order.id}) }}

    <h1 class="page__title">Order #{{ order.id }}</h1>
    <p class="page__subtitle">Placed on {{ order.order_date }}</p>

    <div class="card">
        <span class="card__label">Client</span>
        <span class="card__value">{{ client.name }}</span>
        <span class="card__label">Email</span>
        <span class="card__value">{{ client.email }}</span>
        <span class="card__label">Shipping address</span>
        <span class="card__value">{{ client.address }}, {{ client.city }} {{ client.zip_code }}</span>
        <span class="card__label">Total</span>
        <span class="card__value">${{ order.total|number_format(2) }}</span>
    </div>

    {% if lines is not empty %}
    <table class="table table--spaced">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit price</th>
            </tr>
        </thead>
        <tbody>
            {% for line in lines %}
            <tr>
                <td>{{ line.product_name }}</td>
                <td>{{ line.quantity }}</td>
                <td>${{ line.unit_price|number_format(2) }}</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    {% endif %}

    <div class="page__actions">
        <a href="{{ base }}/orders" class="btn">Back</a>
        <a href="{{ base }}/order/edit?id={{ order.id }}" class="btn btn--primary">Edit</a>
        <form action="{{ base }}/order/delete" method="post" onsubmit="return confirm('Delete order #{{ order.id }}?');">
            <input type="hidden" name="id" value="{{ order.id }}">
            <button type="submit" class="btn btn--danger">Delete</button>
        </form>
    </div>

{{ include('layouts/footer.php') }}