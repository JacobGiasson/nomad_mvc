{{ include('layouts/header.php', {title: 'New order'}) }}

    <h1 class="page__title">New order</h1>
    <p class="page__subtitle">Select a client, a date and a total.</p>

    {{ include('order/_form.php', {submit: 'Create order'}) }}

    <div class="page__actions">
        <a href="{{ base }}/orders" class="btn">Cancel</a>
    </div>

{{ include('layouts/footer.php') }}