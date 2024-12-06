var config = {
    'paths': {
        'dmpt': 'Visionet_AbandonedCart/js/dmpt',
        'stick-to-me' : 'Visionet_AbandonedCart/js/stick-to-me'
    },
    'shim': {
        'dmpt': {
            exports: '_dmTrack',
            deps: ['jquery']
        },
        'stick-to-me': {
            deps: ['jquery']
        }
    }
};
