(() => {
    if (window.spatiePrice) {
        return;
    }

    const apiUrl = 'https://spatie.be/api';

    const responses = {};

    const fetchPrices = (url) => {
        if (! responses[url]) {
            responses[url] = fetch(url, { headers: { Accept: 'application/json' } })
                .then((response) => (response.ok ? response.json() : null))
                .catch(() => null);
        }

        return responses[url];
    };

    const formatPrice = (price) => {
        const [integerPart, decimalPart] = (price.price_in_cents / 100).toFixed(2).split('.');

        let amount = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

        if (decimalPart !== '00') {
            amount += `.${decimalPart}`;
        }

        return `${amount} ${price.currency_code}`;
    };

    const pad = (number) => number.toString().padStart(2, '0');

    const pricesComponent = (url) => ({
        loaded: false,
        couldFetchPrice: false,
        price: null,
        priceWithoutDiscount: null,
        discount: {
            active: false,
            percentage: null,
            name: null,
            expiresAt: null,
        },
        countdown: {
            days: '00',
            hours: '00',
            minutes: '00',
            seconds: '00',
        },
        response: null,
        started: false,

        init() {
            if (this.started) {
                return;
            }

            this.started = true;

            fetchPrices(url).then((response) => {
                this.loaded = true;

                if (! response || ! response.actual) {
                    return;
                }

                this.response = response;
                this.price = formatPrice(response.actual);
                this.priceWithoutDiscount = formatPrice(response.without_discount);
                this.discount = {
                    active: Boolean(response.discount.active),
                    percentage: response.discount.percentage,
                    name: response.discount.name,
                    expiresAt: response.discount.expires_at,
                };
                this.couldFetchPrice = true;

                if (this.discount.active && this.discount.expiresAt) {
                    this.startCountdown();
                }
            });
        },

        startCountdown() {
            const update = () => {
                const timeDistance = Math.max(this.discount.expiresAt * 1000 - Date.now(), 0);

                this.countdown.days = pad(Math.floor(timeDistance / (1000 * 60 * 60 * 24)));
                this.countdown.hours = pad(Math.floor((timeDistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                this.countdown.minutes = pad(Math.floor((timeDistance % (1000 * 60 * 60)) / (1000 * 60)));
                this.countdown.seconds = pad(Math.floor((timeDistance % (1000 * 60)) / 1000));

                return timeDistance > 0;
            };

            if (! update()) {
                return;
            }

            const interval = setInterval(() => {
                if (! update()) {
                    clearInterval(interval);
                }
            }, 1000);
        },
    });

    window.spatiePrice = (purchasableId) => pricesComponent(`${apiUrl}/price/${purchasableId}`);

    window.spatieBundlePrice = (bundleId) => pricesComponent(`${apiUrl}/bundle-price/${bundleId}`);
})();
