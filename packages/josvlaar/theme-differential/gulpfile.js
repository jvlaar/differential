var gulp = require('gulp'),
    util = require('gulp-util'),
    sass = require('gulp-sass'),
    clean = require('gulp-clean'),
    cleancss = require('gulp-clean-css'),
    browserify = require('browserify'),
    babelify = require('babelify'),
    source = require('vinyl-source-stream');


var paths = {};
paths.css = 'css';
paths.js = 'js';
paths.img = 'images';

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
    return browserify({entries: paths.js + '/src/theme.js'})
        .transform(babelify.configure({
            presets: ["es2015"]
        }))
        .bundle()
        .pipe(source('theme.js'))
        .pipe(gulp.dest(paths.js));
});

gulp.task('default', ['clean'], function () {
    var tasks = ['images', 'sass', 'javascript'];
    tasks.forEach(function (val) {
        gulp.start(val);
    });
});

gulp.task('watch', function () {
    var tasks = ['images', 'sass'];
    tasks.forEach(function (val) {
        gulp.start(val);
    });
    gulp.watch(paths.css + '/sass/*', ['sass']);
    gulp.watch(paths.css + '/sass/*/*', ['sass']);
    //gulp.watch(paths.js + '/src/*', ['javascript'])
    //gulp.watch(paths.js + '/src/*/*', ['javascript'])

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