'use strict';

var gulp = require('gulp');
var concat = require('gulp-concat');
var concatCss = require('gulp-concat-css');
var sass = require('gulp-sass');
var csso = require('gulp-csso');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();

// Set the browser that you want to support
const AUTOPREFIXER_BROWSERS = [
    'ie >= 10',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4.4',
    'bb >= 10'
];

// Gulp task to compile and minify SASS files
gulp.task('styles', function () {
    return gulp.src('../css/modules/sass/*.scss')
    // Compile SASS files
    .pipe(sass({
        outputStyle: 'nested',
        precision: 10,
        includePaths: ['.'],
        onError: console.error.bind(console, 'Sass error:')
    }))
    // Auto-prefix css styles for cross browser compatibility
    .pipe(autoprefixer({browsers: AUTOPREFIXER_BROWSERS}))
    // Concatenate files
    .pipe(concatCss('style.css'))
    // Minify files
    .pipe(csso())
    // Output
    .pipe(gulp.dest('../css/'))
    // Stream to browser sync
    .pipe(browserSync.stream())
});

// Gulp task to minify JavaScript files
gulp.task('scripts', function() {
    return gulp.src('../js/modules/*.js')
    // Combine files
    .pipe(concat('script.js'))
    // Minify files
    .pipe(uglify())
    // Output
    .pipe(gulp.dest('../js/'))
    // Stream to browser sync
    .pipe(browserSync.stream())
});

// Watch files for changes
gulp.task('watch', function () {
    gulp.watch([
        '../css/modules/sass/*.scss'
    ], gulp.series('styles'));
    gulp.watch([
        '../js/modules/*.js'
    ], gulp.series('scripts'));
});

// Watch with browser sync
gulp.task('dev', function () {
    browserSync.init({
        proxy: 'snappic.local'
    });

    gulp.watch([
        '../css/modules/sass/*.scss'
    ], gulp.series('styles'));
    gulp.watch([
        '../js/modules/*.js'
    ], gulp.series('scripts'));
});