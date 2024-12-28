
// Initialize Stripe with your Publishable Key (replace with your own key)
const stripe = Stripe('pk_test_51QXHt8GEjHAfmOQpStHyOFSNL5RYJpJk7fFjF4ShcUdrOxb3dOeyByCALopcNgjjYcBgznyF5udRG0p4FJHphkws00MXQss0ez');

// Create an instance of Elements
const elements = stripe.elements();

// Create an instance of the card Element
const card = elements.create('card', {
    style: {
        base: {
            color: 'black',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4',
            },
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a',
        },
    },
});

// Add the card Element to the DOM
card.mount('#card-element');
