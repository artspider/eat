const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    purge: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                montserrat: ["Montserrat"],
                raleway: ["Raleway"],
            },
            width: {
                '110': '27rem',
              },
        },
        colors: {
            transparent: "transparent",
            "eat-white": {
                50: "#ffffff",
                100: "#ffffff",
                200: "#ffffff",
                300: "#ffffff",
                400: "#fffffe",
                500: "#fcfcf4",
                600: "#f2f2ea",
                700: "#e8e8e0",
                800: "#deded6",
                900: "#d4d4cc",
            },
            "eat-green": {
                50: "#edff45",
                100: "#e3ff3b",
                200: "#d9ff31",
                300: "#cffc27",
                400: "#c5f21d",
                500: "#bbe813",
                600: "#b1de09",
                700: "#a7d400",
                800: "#9dca00",
                900: "#93c000",
            },
            "eat-olive": {
                50: "#839632",
                100: "#798c28",
                200: "#6f821e",
                300: "#657814",
                400: "#5b6e0a",
                500: "#516400",
                600: "#475a00",
                700: "#3d5000",
                800: "#334600",
                900: "#293c00",
            },
            "eat-fuccia": {
                50: "#ff6994",
                100: "#ff5f8a",
                200: "#ff5580",
                300: "#fc4b76",
                400: "#f2416c",
                500: "#e83762",
                600: "#de2d58",
                700: "#d4234e",
                800: "#ca1944",
                900: "#c00f3a",
            },
            "eat-pink": {
                50: "#ff97c2",
                100: "#ff8db8",
                200: "#ff83ae",
                300: "#ff79a4",
                400: "#ff6f9a",
                500: "#fc6590",
                600: "#f25b86",
                700: "#e8517c",
                800: "#de4772",
                900: "#d43d68",
            },
        },
    },

    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
