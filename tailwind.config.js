/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],

  
  theme: {
    extend: {
      darkMode: 'class',
      rotate: {
        '360': '360deg', // Add custom rotation value
      },
      fontSize: {
        xs: '0.65rem',    // 12px
        sm: '0.75rem',   // 14px
        base: '0.875rem',   // 14px
        lg: '1rem',   // 18px
        xl: '1.25rem',    // 20px
        '2xl': '1.5rem',  // 24px
        '3xl': '1.875rem', // 30px
        '4xl': '2.25rem', // 36px
        '5xl': '3rem',    // 48px
        '6xl': '3.75rem', // 60px
        '7xl': '4.5rem',  // 72px
        // Add more custom sizes as needed
      },
      container : {
          center : true,
          padding : '10px'  // 16px
        },
      colors : {
        // primary: { "50": "#eff6ff", "100": "#dbeafe", "200": "#bfdbfe", "300": "#93c5fd", "400": "#60a5fa", "500": "#3b82f6", "600": "#2563eb", "700": "#1d4ed8", "800": "#1e40af", "900": "#1e3a8a" },
        primary: {
          // light: 'rgb(var(--primary-light))', // Light mode primary color
          // dark: 'rgb(var(--primary-dark))', // Dark mode primary color
          // light: 'var(--primary-light)', // Light mode primary color
          light: 'rgb(var(--primary-light) / <alpha-value>)', // Light mode primary color
          dark: 'var(--primary-dark)', // Dark mode primary color
          "50": "#eff6ff", "100": "#dbeafe", "200": "#bfdbfe", "300": "#93c5fd", "400": "#60a5fa", "500": "#3b82f6", "600": "#2563eb", "700": "var(--primary-700)", "800": "var(--primary-800)", "900": "#1e3a8a"
        },
         
        // "primary": "#1E429F",
          
        "secondary": "#a999ef",
                 
        "accent": "#d492f4",
                 
        "neutral": "#2f293d",
                 
        "base-100": "#f9fafb",
                 
        "info": "#90dcf3",
                 
        "success": "#29d6bf",
                 
        "warning": "#f7d336",
                 
        "error": "#f6421e",
      },
      fontFamily: {
        'sans': ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
        'body': ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'system-ui', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
        'mono': ['ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'Liberation Mono', 'Courier New', 'monospace'],
        'icon' :['font-awesome']
      },
 
      transitionProperty: {
        'width': 'width'
      },
   },
   
     },
     plugins: [
      require('flowbite-typography'),
      require('flowbite/plugin')({wysiwyg: true,}),
],
}