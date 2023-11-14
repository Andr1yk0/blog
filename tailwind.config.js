/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'clr-50': 'var(--clr-50)',
                'clr-100': 'var(--clr-100)',
                'clr-200': 'var(--clr-200)',
                'clr-300': 'var(--clr-300)',
                'clr-400': 'var(--clr-400)',
                'clr-500': 'var(--clr-500)',
                'clr-600': 'var(--clr-600)',
                'clr-700': 'var(--clr-700)',
                'clr-800': 'var(--clr-800)',
                'clr-900': 'var(--clr-900)',
                'clr-950': 'var(--clr-950)',
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
}

