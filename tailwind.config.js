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
    'top-[11%]',
    'right-[4%]',
    'z-100',
    'top-[16%]'
  ],
  plugins: [],
}