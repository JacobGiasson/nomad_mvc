{{ include('layouts/header.php', {title: 'Home'}) }}

    <section class="hero">
        <p class="hero__eyebrow">NOMAD Shop</p>
        <h1 class="hero__title">Every order, in one place.</h1>
        <p class="hero__text">Track SafeSip orders from your clients, from the first click to the shipping address.</p>
        <div class="hero__actions">
            <a href="{{ base }}/order/create" class="btn btn--primary">New order</a>
            <a href="{{ base }}/orders" class="btn btn--light">View orders</a>
        </div>
    </section>

    <h2 class="section__title">How it works</h2>
    <div class="steps">
        <div class="step">
            <span class="step__number">1</span>
            <h3 class="step__title">Choose a client</h3>
            <p class="step__text">Pick a registered client from the list.</p>
        </div>
        <div class="step">
            <span class="step__number">2</span>
            <h3 class="step__title">Add a product</h3>
            <p class="step__text">Select a product and a quantity.</p>
        </div>
        <div class="step">
            <span class="step__number">3</span>
            <h3 class="step__title">Save the order</h3>
            <p class="step__text">The total is calculated automatically.</p>
        </div>
    </div>

{{ include('layouts/footer.php') }}