/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./assets/**/*.js", "./templates/**/*.html.twig"],
  theme: {
    extend: {
      colors: {
        primary: colors.slate[700], // => #334155
        accent: colors.teal[600], // => #0d9488
      },
      fontFamily: {
        sans: ["system-ui", "sans-serif"],
      },
    },
  },

  plugins: [],
};
