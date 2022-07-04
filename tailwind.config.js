/** @type {import('tailwindcss').Config} */


const plugin =require("tailwindcss/plugin");

Myclass = plugin(function({addUtilities}){
  addUtilities({
   ".my-rotate-y-180": {
    transform: "rotateY(180deg)"
   } ,
   ".preserve-3d":{
    transformStyle: "preserve-3d"
   },
   ".perspective": {
    perspective: '1000px;'
   },
   ".backface-hidden":{
    backfaceVisibility: 'hidden'
   }
  })
})

module.exports = {
  content: [
     "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
    Myclass
  ],
}
