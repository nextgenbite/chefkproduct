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

      container : {
          center : true,
          padding : '1rem'  // 16px
        },
      colors : {
         
        "primary": "#1E429F",
          
        "secondary": "#a999ef",
                 
        "accent": "#d492f4",
                 
        "neutral": "#2f293d",
                 
        "base-100": "#f9fafb",
                 
        "info": "#90dcf3",
                 
        "success": "#29d6bf",
                 
        "warning": "#f7d336",
                 
        "error": "#f6421e",
      },
   },
   
     },
     plugins: [
      require('flowbite/plugin'),
],
}