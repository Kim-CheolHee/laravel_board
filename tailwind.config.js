module.exports = {
    // prefix: 'tw-',
    content: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],
    darkMode: 'media',
    theme: {
        extend: {
            fontFamily: {
                jua: ['Jua', 'sans-serif']
            },
            backgroundColor: ['odd']
        },
        colors: {
            citroGray: {
                light: '#F9F9F9',
                DEFAULT: '#D1D1D1',
                dark: '#979797',
                darkest: '#444444'
            },
            citroGreen: {
                light: '#DAF1EE',
                DEFAULT: '#008E76',
                dark: '#1A7868'
            },
            citroOrange: '#FF6B00',
            ...require('tailwindcss/colors')
        }
    },
    variants: {
        extend: {}
    },
    plugins: []
}
