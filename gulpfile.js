var gulp = require("gulp");
var sass = require("gulp-sass");
sass.compiler = require("node-sass");
var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var cssnano = require("cssnano");

gulp.task("hello", function () {
  console.log("Hello world !!!");
});

gulp.task("sass", function () {
  return gulp
    .src("./src/assets/sass/**/*.scss")
    .pipe(sass.sync().on("error", sass.logError))
    .pipe(gulp.dest("./src/assets/css"));
});

gulp.task("sass:watch", function () {
  gulp.watch("./src/assets/sass/**/*.scss", gulp.series("sass"));
});

gulp.task("postcss:prefix", function () {
  return gulp
    .src("./src/assets/css/*.css")
    .pipe(postcss([autoprefixer()]))
    .pipe(gulp.dest("./src/assets/css"));
});

gulp.task("postcss:min", function () {
  return gulp
    .src("./src/assets/css/*.css")
    .pipe(postcss([cssnano]))
    .pipe(gulp.dest("./dist/assets/css"));
});

gulp.task("postcss:all", gulp.series("postcss:prefix", "postcss:min"));

gulp.task("php", function () {
  return gulp.src("./src/**/*.php").pipe(gulp.dest("./dist"));
});

gulp.task("build", gulp.parallel("php", "postcss:all"));
