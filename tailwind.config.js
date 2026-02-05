/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.{js,jsx,ts,tsx,vue}",
    "./resources/views/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        junspro: {
          50: "#f4f2ff",
          100: "#e9e5ff",
          200: "#d5ceff",
          300: "#b8adff",
          400: "#9b8aff",
          500: "#7d66ff",
          600: "#684bff",
          700: "#5435e6",
          800: "#4329b3",
          900: "#38248f",
        },
      },
      backgroundImage: {
        "junspro-card":
          "linear-gradient(135deg, #4F3DFF 0%, #6C5BFF 45%, #8A7CFF 100%)",
        "junspro-button":
          "linear-gradient(90deg, #5A3FFF 0%, #7A5FFF 50%, #9D83FF 100%)",
      },
    },
  },
  plugins: [require("@tailwindcss/line-clamp")],
};


