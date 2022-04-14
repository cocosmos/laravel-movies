const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        screens: {
            '2xle': {'max': '1535px'},
            // => @media (max-width: 1535px) { ... }

            'xle': {'max': '1279px'},
            // => @media (max-width: 1279px) { ... }

            'lge': {'max': '1023px'},
            // => @media (max-width: 1023px) { ... }

            'mde': {'max': '767px'},
            // => @media (max-width: 767px) { ... }

            'sme': {'max': '639px'},
            // => @media (max-width: 639px) { ... }
            'sm': '640px',
            // => @media (min-width: 640px) { ... }

            'md': '768px',
            // => @media (min-width: 768px) { ... }

            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }

            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }

            '2xl': '1536px',
            // => @media (min-width: 1536px) { ... }
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
