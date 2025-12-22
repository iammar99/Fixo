module.exports = {
  content: [
    "./*.php",                 // index.php in root
    "./includes/**/*.php",     // all php files inside /includes
    "./includes/components/**/*.php",
    "./Styles/*.css",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
