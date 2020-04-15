@extends('layouts.payments')
@section('content')
    <input id="card-holder-name" type="text">

    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>

    <button id="card-button">
        Process Payment
    </button>

    <script
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{ $pk }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
            const { paymentMethod, error } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: { name: cardHolderName.value }
                }
            );

            if (error) {
                // Display "error.message" to the user...
            } else {
                fd = new FormData()
                fd.append('id', paymentMethod.id)
                fetch('/dashboard/paymentmethods/singlecharges', {
                    method  : 'POST',
                    headers : {'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].getAttribute('content')},
                    body    : fd
                })
            }
        });
    </script>
@endsection
