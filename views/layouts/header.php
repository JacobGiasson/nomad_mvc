<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }} | NOMAD Shop</title>
    <link rel="stylesheet" href="{{ asset }}/css/style.css">
</head>
<body>
    <nav class="nav">
        <a href="{{ base }}/" class="nav__brand">NOMAD</a>
        <a href="{{ base }}/" class="nav__link">Home</a>
        <a href="{{ base }}/orders" class="nav__link">Orders</a>
        <a href="{{ base }}/order/create" class="nav__link">New order</a>
    </nav>
    <main class="page">
        {% if success %}
            <p class="alert alert--success">{{ success }}</p>
        {% endif %}