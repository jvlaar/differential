var gulp = require('gulp'),
    util = require('gulp-util'),
    sass = require('gulp-sass'),
    clean = require('gulp-clean'),
    cleancss = require('gulp-clean-css'),
    browserify = require('browserify'),
    babelify = require('babelify'),
    tsify = require("tsify"),
    source = require('vinyl-source-stream'),
    ts = require("gulp-typescript"),
    tsProject = ts.createProject("tsconfig.json");

var paths = {};
paths.css = 'public/css';
paths.js = 'public/js';
paths.img = 'public/images';

gulp.task('sass', function() {
    return gulp.src([paths.css + '/sass/*.scss'])
        .pipe(sass({compress: true}))
        .pipe(cleancss())
        .pipe(gulp.dest(paths.css));
});

gulp.task('images', function () {
    return gulp.src([
        paths.img + '/src/*'
    ])
        .pipe(gulp.dest(paths.img))
});

gulp.task('clean', function () {
    return gulp.src([paths.css + '/*', paths.js + '*', paths.img + '/*'])
        .pipe(clean());
});

/**
 * Javascript bundle with Browserify
 */
gulp.task('javascript', function (){
    return browserify({
        basedir: '.',
        debug: true,
        entries: ['public/js/src/main.ts'],
        cache: {},
        packageCache: {}
    })
    .plugin(tsify)
    .bundle()
    .pipe(source('main.js'))
    .pipe(gulp.dest(paths.js));
});

gulp.task('default', ['clean'], function () {
    var tasks = ['images', 'sass', 'javascript'];
    tasks.forEach(function (val) {
        gulp.start(val);
    });
});

gulp.task('watch', function () {
    var tasks = ['images', 'sass', 'javascript'];
    tasks.forEach(function (val) {
        gulp.start(val);
    });
    gulp.watch(paths.js + '/src/*', ['javascript']);
    gulp.watch(paths.js + '/src*/*', ['javascript']);
    gulp.watch(paths.css + '/sass/*', ['sass']);
    gulp.watch(paths.css + '/sass/*/*', ['sass']);
});

function handleError(error, emitEnd) {
    if (typeof(emitEnd) === 'undefined') {
        emitEnd = true;
    }
    util.beep();
    util.log(util.colors.black.bgRed('Error!'), util.colors.red(error.toString()));
    if (emitEnd) {
        this.emit('end');
    }
}