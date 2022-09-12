const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin'); // Minificar imagenes 
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const clean = require('gulp-clean');
const webp = require('gulp-webp');
const plumber = require('gulp-plumber');
const avif = require('gulp-avif');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    images: 'src/img/**/*'
}

function css(done) {
    src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(plumber()) // Prevents workflow from stopping
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css'));
    done();
}

function javascript(done) {
    src(paths.js)
        .pipe(sourcemaps.init())
        .pipe(concat('bundle.js'))
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('./build/js'));
    done();
}

function images(done) {
    src(paths.images)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('build/img'));
    //.pipe(notify({ message: 'Images Completed' }));
    done();
}

function convertToWebp(done) {
    const options = {
        quality: 50,
    };
    src('src/img/**/*.{png,jpg}')
        .pipe(webp(options))
        .pipe(dest('build/img'));

    done();
}

function convertToAvif(done) {
    const options = {
        quality: 50,
    };
    src('src/img/**/*.{png,jpg}')
        .pipe(avif(options))
        .pipe(dest('build/img'));

    done();
}


function watchFiles(done) {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.images, images);
    watch(paths.images, convertToWebp);
    watch(paths.images, convertToAvif);
    done();
}

exports.css = css;
exports.images = images;
exports.watchFiles = watchFiles;
exports.default = parallel(css, javascript, convertToWebp, convertToAvif, watchFiles); 