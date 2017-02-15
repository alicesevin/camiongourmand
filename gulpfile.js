var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var livereload = require('gulp-livereload');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var es = require('event-stream');
var flatten = require('gulp-flatten');
var size = require('gulp-filesize');
var uglify = require('gulp-uglify');

var path = {
    theme: './wp-content/themes/camion/app/',
    theme_dest: './wp-content/themes/camion/dist/',
    theme_style: './wp-content/themes/camion/app/scss/',
    theme_js: './wp-content/themes/camion/app/js/',
    theme_images: './wp-content/themes/camion/app/img/',
    npm_dir: './node_modules/'
};

// Compile and minify scss
gulp.task('scss', function () {
    gulp.src([path.theme_style + 'main.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(autoprefixer())
        .pipe(gulp.dest(path.theme_dest + 'css/'))
        .pipe(livereload());
});

// Optimisation Images
gulp.task('images', function () {
    gulp.src([path.theme_images + '*.jpg', path.theme_images + '*.png'])
        .pipe(flatten())
        .pipe(gulp.dest(path.theme_dest + 'img/'));
});

// Browserify to require modules in Js files
gulp.task('browserify', function () {
    // Define Bundle:
    var files = [
        path.theme_js + 'app.js'
    ];
    var tasks = files.map(function (entry) {
        return browserify({
            entries: [entry],
            debug: true,
            paths: ['./node_modules']
        })
            .bundle().on('error', function (err) {
                console.log(err.message);
                this.emit('end');
            })
            .pipe(source('main.js'))
            .pipe(buffer())
            .pipe(sourcemaps.init({loadMaps: true}))
            .pipe(sourcemaps.write('./'))
            .pipe(flatten())
            .pipe(gulp.dest(path.theme_dest + 'js/'));
    });
    return es.merge.apply(null, tasks);
});

//Watch using livereload
gulp.task('watch', function () {
    livereload.listen();
    // Scss files
    gulp.watch([
        path.theme_style + '**/*.scss'
    ], ['scss']);

    // JS files
    gulp.watch([
        path.theme_js + '**/*.js'
    ], ['browserify']);
});

//Minify Js files
gulp.task('uglifyJs', ['browserify'], function () {
    return gulp.src(path.theme_dest + 'js/' + '*.js')
        .pipe(uglify())
        .pipe(gulp.dest(path.theme_dest + 'js/'))
        .pipe(size());
});

// Optimisation Fonts
gulp.task('fonts', function () {
    gulp.src([
        path.theme + 'fonts/*.{ttf,woff,eot,svg,woff2}'
    ])
        .pipe(flatten())
        .pipe(gulp.dest(path.theme_dest + 'fonts/'));
});

// Cmd dev
gulp.task('default', ['scss', 'uglifyJs', 'browserify', 'fonts', 'images', 'watch']);

// Cmd prod
gulp.task('build', ['scss', 'uglifyJs', 'fonts', 'images']);
