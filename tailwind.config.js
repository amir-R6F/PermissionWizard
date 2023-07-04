/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                sky: '#06B0D2',
                cloud: '#CAF0F8',
                fog: '#BDD7DC'
            }
        },

    },
    plugins: [],
}
