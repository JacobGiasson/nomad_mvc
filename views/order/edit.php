{{ include('layouts/header.php', {title: 'Edit order #' ~ order.id}) }}

    <h1 class="page__title">Edit order #{{ order.id }}</h1>
    <p class="page__subtitle">Change the client, date, product or quantity.</p>

    {{ include('order/_form.php', {submit: 'Save changes'}) }}

    <div class="page__actions">
        <a href="{{ base }}/order/show?id={{ order.id }}" class="btn">Cancel</a>
    </div>

{{ include('layouts/footer.php') }}