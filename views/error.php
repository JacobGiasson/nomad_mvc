{{ include('layouts/header.php', {title: 'Error'}) }}

    <h1 class="page__title">Something went wrong</h1>
    <p class="alert alert--error">{{ message }}</p>

    <div class="page__actions">
        <a href="{{ base }}/orders" class="btn">Back to orders</a>
    </div>

{{ include('layouts/footer.php') }}