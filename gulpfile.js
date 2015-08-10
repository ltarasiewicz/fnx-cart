'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

var config = {
    bootstrapDir: './web/assets/bower_components/bootstrap-sass',
    publicDir: './web'
};

gulp.task('sass', function () {
    gulp.src('./web/assets/custom-sass/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(config.publicDir + '/assets/dist/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('web/assets/custom-sass/*.scss', ['sass']);
});