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
                'text-clr-50': 'var(--text-clr-50)',
                'text-clr-100': 'var(--text-clr-100)',
                'text-clr-200': 'var(--text-clr-200)',
                'text-clr-300': 'var(--text-clr-300)',
                'text-clr-400': 'var(--text-clr-400)',
                'text-clr-500': 'var(--text-clr-500)',
                'text-clr-600': 'var(--text-clr-600)',
                'text-clr-700': 'var(--text-clr-700)',
                'text-clr-800': 'var(--text-clr-800)',
                'text-clr-900': 'var(--text-clr-900)',
                'text-clr-950': 'var(--text-clr-950)',
            },
            'typography': () => ({
                DEFAULT: {
                    css: {
                        '--tw-prose-body': 'var(--text-clr-700)',
                        '--tw-prose-headings': 'var(--text-clr-900)',
                        '--tw-prose-lead': 'var(--text-clr-800)',
                        '--tw-prose-links': 'var(--text-clr-800)',
                        '--tw-prose-bold': 'var(--text-clr-900)',
                        '--tw-prose-counters': 'var(--text-clr-700)',
                        '--tw-prose-bullets': 'var(--text-clr-800)',
                        '--tw-prose-hr': 'var(--text-clr-500)',
                        '--tw-prose-quotes': 'var(--text-clr-800)',
                        '--tw-prose-quote-borders': 'var(--text-clr-800)',
                        '--tw-prose-captions': 'var(--text-clr-800)',
                        '--tw-prose-code': 'var(--text-clr-900)',
                        // '--tw-prose-pre-code': theme('colors.pink[100]'),
                        // '--tw-prose-pre-bg': 'var(--text-clr-800)',
                        '--tw-prose-th-borders': 'var(--text-clr-300)',
                        '--tw-prose-td-borders': 'var(--text-clr-200)',
                    }
                }
            })
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
}

