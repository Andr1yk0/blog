import defaultTheme from "tailwindcss/defaultTheme";
const {default: flattenColorPalette} = require("tailwindcss/lib/util/flattenColorPalette");
const {parseColor} = require("tailwindcss/lib/util/color");
import aspectRatio from "@tailwindcss/aspect-ratio";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: "selector",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        {
            pattern: /bg-clr-(100|200|300|400|500|600|700|800|900)/
        },
        'bg-gray-100',
    ],
    theme: {
        extend: {
            colorComponents: ({ theme }) => {
                // Flatten possible multi-depth color configuration.
                const flatPalette = flattenColorPalette(theme('colors'));

                // Iterate through the color configuration.
                const entries = Object.entries(flatPalette)
                    .map(([key, value]) => [
                        key,
                        // parseColor() by default breaks down colors to RGB.
                        // One may need to adjust if it returns other formats.
                        parseColor(value)?.color.join(' '),
                    ])
                    // Filter unparsable colors, like `currentColor`.
                    .filter(([, value]) => value);

                // Return the iterated color configuration as a flat dictionary.
                return Object.fromEntries(entries);
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                "8xl": "90rem",
                "9xl": "105rem",
                "10xl": "120rem",
            },
            zIndex: {
                1: "1",
                60: "60",
                70: "70",
                80: "80",
                90: "90",
                100: "100",
            },
            keyframes: {
                "spin-slow": {
                    "100%": {
                        transform: "rotate(-360deg)",
                    },
                },
            },
            animation: {
                "spin-slow": "spin-slow 8s linear infinite",
            },
            colors: {
                'clr-50': 'rgb(var(--clr-50)/<alpha-value>)',
                'clr-100': 'rgb(var(--clr-100)/<alpha-value>)',
                'clr-200': 'rgb(var(--clr-200)/<alpha-value>)',
                'clr-300': 'rgb(var(--clr-300)/<alpha-value>)',
                'clr-400': 'rgb(var(--clr-400)/<alpha-value>)',
                'clr-500': 'rgb(var(--clr-500)/<alpha-value>)',
                'clr-600': 'rgb(var(--clr-600)/<alpha-value>)',
                'clr-700': 'rgb(var(--clr-700)/<alpha-value>)',
                'clr-800': 'rgb(var(--clr-800)/<alpha-value>)',
                'clr-900': 'rgb(var(--clr-900)/<alpha-value>)',
                'clr-950': 'rgb(var(--clr-950)/<alpha-value>)',
            },
            'typography': () => ({
                DEFAULT: {
                    css: {
                        'code::before': {
                            content: '""'
                        },
                        'code::after': {
                            content: '""'
                        },
                    }
                }
            })
        },
    },
    plugins: [aspectRatio, forms, typography],
}

