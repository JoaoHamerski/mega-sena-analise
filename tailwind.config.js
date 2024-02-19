/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/js/**/*.{vue,js,ts}',
    ],
    plugins: [require('daisyui')],
    daisyui: {
        themes: [
            {
                light: {
                    ...require('daisyui/src/theming/themes')['light'],
                    primary: 'oklch(50% 0.15 263.62)',
                    'primary-content': 'oklch(93.23% 0.04 220)',
                    success: 'oklch(60% 0.15 155)',
                    'success-content': 'oklch(93.23% 0.04 155)',
                    secondary: 'oklch(42.16% 0 250.48)',
                    'secondary-content': 'oklch(93.23% 0 250.48)'
                }
            }
        ]
    }
};
