{{ include('layouts/header.php', {title: 'Orders'}) }}

    <h1 class="page__title">Orders</h1>
    <p class="page__subtitle">All NOMAD Shop orders, most recent first.</p>

    {% if orders is empty %}
        <p class="empty">No orders yet.</p>
    {% else %}
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {% for order in orders %}
                <tr>
                    <td>{{ order.id }}</td>
                    <td>{{ order.client_name }}</td>
                    <td>{{ order.order_date }}</td>
                    <td>${{ order.total|number_format(2) }}</td>
                    <td class="table__actions">
                        <a href="{{ base }}/order/show?id={{ order.id }}" class="btn btn--small">View</a>
                    </td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    {% endif %}

    <div class="page__actions">
        <a href="{{ base }}/order/create" class="btn btn--primary">New order</a>
    </div>

{{ include('layouts/footer.php') }}