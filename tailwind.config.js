module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.ts',
		'./resources/**/*.vue',
	],
	theme: {
		extend: {
            fontFamily: {
                'sansation': ['Sansation', 'sans-serif'],

            },
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                'white': '#ffffff',
                'primary': {
                    100: '#CDECE2',
                    200: '#008993',

                },
                'black':{
                    100: '#0C0E0F'
                },
                'gray': {
                    50: "#fafafa",
                    100: "#e4e5f1",
                    200: "#d2d3db",
                    300: "#9394a5",
                    400: "#484b6a",
                    500: "#6b7280",
                    600: "#4b5563",
                    700: "#374151",
                    800: "#1f2937",
                    900: "#111827",
                },
            },
        },
	},
	plugins: [],
}
