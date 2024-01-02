/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
    fontFamily: {
      'poppins': ['Poppins']
    },
    colors: {
      'black' : '#333F51',
      'white' : '#FFFFFF',
      'gray' : '#556987',
      'light-gray' : '#EEF0F3',
      'dark-gray' : '#333F51',
      'light-blue' : '#EBF5FF',
      'dark-blue' : '#003165',
      'primary' : '#3496FF', 
      'gradient-bg1': '#f4fbff',
      'gradient-bg2': '#f7f8ff',
      'dark-orange' : '#EF5944',
      'light-orange' : '#FFFAF3',
      'light-perot' : '#F0FDF4',
      'perot' : '#22C55E',
      'light-red' : '#FEF7F6',
      'yellow' : '#F59E0B',
      'light-yellow' : '#FFFAF3',
      'light-pink' : '#FBF7FF',
      'dark-pink' : '#A855F7',    
      'green' : '#4fd69c'
    },
    screens: {
      s: '280px',
      m: '360px',
      l: '480px',
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      xxl: '1536px',
      xxxl: '1650px',
      xxxxl: '1903px'
    },  
  },
  plugins: [
    require('tw-elements/dist/plugin'),
    require('flowbite/plugin')
  ],
}
