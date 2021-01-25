const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',

    ],
    theme: {
        extend: {
            colors: {
                "dark-slate-gray": {
                    200:"#33534b",
                    100:"#60938B",
                },
                "ash-gray": {
                    200: "#a5ae9e",
                    100: "#DBE4D3"
                },
                "gainsboro": "#d0ddd7",
                "medium-carmine": "#a44a3f",
                "solid-pink": "#873d48"
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'),     '~/plugins/v-tailwind-picker'],
};
