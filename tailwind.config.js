/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./theme/**/*.php",
    "./theme/**/*.js",
  ],
  theme: {
    extend: {},
  },
  safelist: [
    'top-[105px]',
    'right-[10px]',
    'z-100',
    'top-[150px]'
  ],
  plugins: [],
}