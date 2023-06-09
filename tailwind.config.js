module.exports = {
    // prefix: 'tw-',
    content: ['./storage/framework/views/*.php',
              './resources/views/**/*.blade.php',
              './resources/**/*.js',
              './resources/**/*.vue',
              './resources/views/**/*.html'],
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

/* const customBorder = {
    3: '3px',
    5: '5px',
    'custom': '10rem'
}

const customFont = {
    10: '10px',
    11: '11px',
    12: '12px',
    13: '13px',
    14: '14px',
    15: '15px',
    16: '16px',
    17: '17px',
    18: '18px',
    19: '19px',
    20: '20px',
    'custom': '100px'
}

const px100 = {
    ...Array.from(Array(101)).map((_, i) => 'px')
}

module.exports = {
    theme: {
      extend: {
        borderWidth: customBorder,
        fontSize: customFont
      }
    },
    plugins: [
      require('@tailwindcss/typography'),
      require('@tailwindcss/forms'),
      // ...
    ],
} */
