const gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync').create();

//compilationn here

function style(){
   //css file location
   return gulp.src('./web/themes/custom/suboot/style/*.scss')
   //pass file throgugghh sass compiler
   .pipe(sass())
   //where to save compiled css?????
   .pipe(gulp.dest('web/themes/custom/suboot/css/'))
   .pipe(browserSync.stream());
}
function watch(){
  gulp.watch('./web/themes/custom/suboot/style/*.scss', style)
}
exports.style = style;
exports.watch = watch;
