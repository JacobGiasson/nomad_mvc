<form method="post" class="card form">

    <label class="form__label">Client
        <select name="client_id" class="form__input">
            <option value="">Select a client</option>
            {% for client in clients %}
                <option value="{{ client.id }}" {% if client.id == order.client_id %}selected{% endif %}>{{ client.name }}</option>
            {% endfor %}
        </select>
    </label>
    {% if errors.client_id is defined %}
        <p class="form__error">{{ errors.client_id }}</p>
    {% endif %}

    <label class="form__label">Order date
        <input type="date" name="order_date" class="form__input" value="{{ order.order_date }}">
    </label>
    {% if errors.order_date is defined %}
        <p class="form__error">{{ errors.order_date }}</p>
    {% endif %}

    <label class="form__label">Product
        <select name="product_id" class="form__input">
            <option value="">Select a product</option>
            {% for product in products %}
                <option value="{{ product.id }}" {% if product.id == order.product_id %}selected{% endif %}>{{ product.name }} (${{ product.price|number_format(2) }})</option>
            {% endfor %}
        </select>
    </label>
    {% if errors.product_id is defined %}
        <p class="form__error">{{ errors.product_id }}</p>
    {% endif %}

    <label class="form__label">Quantity
        <input type="number" name="quantity" min="1" class="form__input" value="{{ order.quantity }}">
    </label>
    {% if errors.quantity is defined %}
        <p class="form__error">{{ errors.quantity }}</p>
    {% endif %}

    <button type="submit" class="btn btn--primary">{{ submit }}</button>
</form>