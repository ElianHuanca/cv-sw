<!-- resources/views/checkout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

    <form id="payment-form">
        <div>
            <label for="card-element">Ingresa la información de tu tarjeta</label>
            <div id="card-element"></div>
        </div>

        <button id="checkout-button">Pagar</button>
    </form>

    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');

        cardElement.mount('#card-element');

        var checkoutButton = document.getElementById('checkout-button');

        checkoutButton.addEventListener('click', function () {
            stripe.createPaymentMethod({
                type: 'card',
                card: cardElement
            })
            .then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                } else {
                    // Hacer una solicitud al servidor para crear un PaymentIntent con el ID del método de pago
                    fetch('/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Asegúrate de incluir el token CSRF si estás utilizando Laravel
                        },
                        body: JSON.stringify({ payment_method: result.paymentMethod.id })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Configurar Stripe.js con el client_secret
                        return stripe.confirmCardPayment(data.client_secret, {
                            payment_method: result.paymentMethod.id
                        });
                    })
                    .then(confirmResult => {
                        if (confirmResult.error) {
                            alert(confirmResult.error.message);
                        } else {
                            // La transacción se completó
                            alert('Pago exitoso!');
                        }
                    });
                }
            });
        });
    </script>

</body>
</html>
