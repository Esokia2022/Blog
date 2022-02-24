/**
 * Gulpfile.
 *
 * Gulp with WordPress.
 *
 * Implements:
 *      1. Live reloads browser with BrowserSync.
 *      2. CSS: Sass to CSS conversion, error catching, Autoprefixing, Sourcemaps,
 *         CSS minification, and Merge Media Queries.
 *      3. JS: Concatenates & uglifies Vendor and Custom JS files.
 *      4. Images: Minifies PNG, JPEG, GIF and SVG images.
 *      5. Watches files for changes in CSS or JS.
 *      6. Watches files for changes in PHP.
 *      7. Corrects the line endings.
 *      8. InjectCSS instead of browser page reload.
 *      9. Generates .pot file for i18n and l10n.
 *
 */

/**
 * Configuration.
 *
 * Project Configuration for gulp tasks.
 *
 * In paths you can add <<glob or array of globs>>. Edit the variables as per your project requirements.
 */

// START Editing Project Variables.
// Project related.
var project                 = 'Wiki'; // Project Name.
//var projectURL              = 'wpgulp.dev'; // Local project URL of your already running WordPress site. Could be something like local.dev or localhost:8888.
var productURL              = './'; // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.

// const server = {
//     proxyURL: 'http://wiki.loc/'
// }


// Style related.
var styleSRC                = 'wp-content/themes/wiki-wordpress/assets/sass/main.scss'; // Path to main .scss file.
var styleDestination        = 'wp-content/themes/wiki-wordpress/assets/css/'; // Path to place the compiled CSS file.
// Default set to root folder.


// JS Custom related.
var jsCustomSRC             = 'wp-content/themes/wiki-wordpress/assets/js/main.js'; // Path to JS custom scripts folder.
var jsCustomDestination     = 'wp-content/themes/wiki-wordpress/assets/js/dist/'; // Path to place the compiled JS custom scripts file.
var jsCustomFile            = 'script'; // Compiled JS custom file name.
// Default set to custom i.e. custom.js.




const imgPaths = {
  src: 'wp-content/themes/wiki-wordpress/assets/images/',
  dist: 'wp-content/themes/wiki-wordpress/assets/images/',
  spriteImg: 'wp-content/themes/wiki-wordpress/assets/images/icons/*.png',
  spriteRetina: 'wp-content/themes/wiki-wordpress/assets/images/icons-retina/*@2x.png'
}

//var spritesmith =   require('gulp-spritesmith');


// Watch files paths.
var styleWatchFiles         = 'wp-content/themes/wiki-wordpress/assets/sass/**/*.scss'; // Path to all *.scss files inside css folder and inside them.
//var vendorJSWatchFiles      = './wp-content/themes/wiki-wordpress/assets/js/vendor/*.js'; // Path to all vendor JS files.
var customJSWatchFiles      = 'wp-content/themes/wiki-wordpress/assets/js/custom.js'; // Path to all custom JS files.
//var projectPHPWatchFiles    = './**/*.php'; // Path to all PHP files.


// Browsers you care about for autoprefixing.
// Browserlist https        ://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
    'last 2 version',
    '> 1%',
    'ie >= 9',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4',
    'bb >= 10'
  ];

'use strict';



// STOP Editing Project Variables.

/**
 * Load Plugins.
 *
 * Load gulp plugins and passing them semantic names.
 */
var gulp         = require('gulp'); // Gulp of-course

// CSS related plugins.
var sass         = require('gulp-sass'); // Gulp pluign for Sass compilation.
var minifycss    = require('gulp-uglifycss'); // Minifies CSS files.
var autoprefixer = require('gulp-autoprefixer'); // Autoprefixing magic.
var mmq          = require('gulp-merge-media-queries'); // Combine matching media queries into one media query definition.

// JS related plugins.
var concat       = require('gulp-concat'); // Concatenates JS files
var uglify       = require('gulp-uglify'); // Minifies JS files
var include      = require('gulp-include');

// Image realted plugins.
var imagemin     = require('gulp-imagemin'); // Minify PNG, JPEG, GIF and SVG images with imagemin.
var spritesmith = require('gulp.spritesmith');
//var pipe = require('gulp-pipe');
//var buffer = require('vinyl-buffer');

// Utility related plugins.
var rename       = require('gulp-rename'); // Renames files E.g. style.css -> style.min.css
var lineec       = require('gulp-line-ending-corrector'); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)
var filter       = require('gulp-filter'); // Enables you to work on a subset of the original files by filtering them using globbing.
var sourcemaps   = require('gulp-sourcemaps'); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css)
var notify       = require('gulp-notify'); // Sends message notification to you
var browserSync  = require('browser-sync');// Reloads browser and injects CSS. Time-saving synchronised browser testing.
var reload       = browserSync.reload; // For manual browser reload.


/**
 * Task: `browser-sync`.
 *
 * Live Reloads, CSS injections, Localhost tunneling.
 *
 * This task does the following:
 *    1. Sets the project URL
 *    2. Sets inject CSS
 *    3. You may define a custom port
 *    4. You may want to stop the browser from openning automatically
 */
// ========================================
// SERVER 
// ========================================

gulp.task('browser-sync', () => {
	browserSync({
    server : {
      baseDir : productURL
    }
    //proxy: server.proxyURL,
    //browser: true,
		//notify: false,
    //open: true
	});
});


/**
 * Task: `styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 *    7. Injects CSS or reloads the browser via browserSync
 */
 gulp.task('styles', function () {
    gulp.src( styleSRC )
    .pipe( sourcemaps.init() )
    .pipe( sass( {
      errLogToConsole: true,
      outputStyle: 'compact',
      // outputStyle: 'compressed',
      // outputStyle: 'nested',
      // outputStyle: 'expanded',
      precision: 10
    } ) )
    .on('error', console.error.bind(console))
    .pipe( sourcemaps.write( { includeContent: false } ) )
    .pipe( sourcemaps.init( { loadMaps: true } ) )
    .pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

    .pipe( sourcemaps.write ( './' ) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( styleDestination ) )

    .pipe( filter( '**/*.css' ) ) // Filtering stream to only css files
    .pipe( mmq( { log: true } ) ) // Merge Media Queries only for .min.css version.

    .pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.

    .pipe( rename( { suffix: '.min' } ) )
    .pipe( minifycss( {
      maxLineLen: 10
    }))
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( styleDestination ) )

    .pipe( filter( '**/*.css' ) ) // Filtering stream to only css files
    //.pipe( browserSync.stream() )// Reloads style.min.css if that is enqueued.
    .pipe(browserSync.reload({
      stream: true
    }))
    .pipe( notify( { message: 'TASK: "styles" Completed! 💯', onLast: true } ) )
 });




 /**
  * Task: `customJS`.
  *
  * Concatenate and uglify custom JS scripts.
  *
  * This task does the following:
  *     1. Gets the source folder for JS custom files
  *     2. Concatenates all the files and generates custom.js
  *     3. Renames the JS file with suffix .min.js
  *     4. Uglifes/Minifies the JS file and generates custom.min.js
  */
 gulp.task( 'customJS', function() {
    gulp.src( jsCustomSRC )
    .pipe( include() )
    .pipe( concat( jsCustomFile + '.js' ) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( jsCustomDestination ) )
    .pipe( rename( {
      basename: jsCustomFile,
      suffix: '.min'
    }))
    .pipe( uglify() )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( jsCustomDestination ) )
    .pipe( notify( { message: 'TASK: "customJs" Completed! 💯', onLast: true } ) );
 });



// ========================================
// IMAGES
// ========================================

gulp.task('compress-images', () => {
  return gulp.src(imgPaths.src + '/**/*.{jpg,png,svg}')
    .pipe(imagemin([
      imagemin.jpegtran({progressive: true}),
      imagemin.optipng({optimizationLevel: 5})
    ]))
    .pipe(gulp.dest(imgPaths.dist));
});

gulp.task('sprite', function () {
  var spriteData = gulp.src('wp-content/themes/wiki-wordpress/assets/images/icons/*.png').pipe(spritesmith({
    // This will filter out `fork@2x.png`, `github@2x.png`, ... for our retina spritesheet
    //   The normal spritesheet will now receive `fork.png`, `github.png`, ...
    retinaSrcFilter: ['wp-content/themes/wiki-wordpress/assets/images/icons/*@2x.png'],
    imgPath: '../images/sprite.png', 
    retinaImgPath: '../images/sprite@2x.png',
    imgName: 'sprite.png',
    retinaImgName: 'sprite@2x.png',
    cssName: '_sprites.scss'
  }));
  
  spriteData.img.pipe(gulp.dest('wp-content/themes/wiki-wordpress/assets/images/'));
  spriteData.css.pipe(gulp.dest('wp-content/themes/wiki-wordpress/assets/sass/helpers/'));
});


 /**
  * Watch Tasks.
  *
  * Watches for file changes and runs specific tasks.
  */
  //['styles', 'customJS', 'compress-images', 'sprite', 'browser-sync']
 gulp.task( 'default', ['styles', 'customJS', 'compress-images', 'sprite', 'browser-sync'], function () {
  //gulp.watch( projectPHPWatchFiles, reload ); // Reload on PHP file changes.
  gulp.watch( styleWatchFiles, [ 'styles' ] ); // Reload on SCSS file changes.
  //gulp.watch( vendorJSWatchFiles, [ 'vendorsJs', reload ] ); // Reload on vendorsJs file changes.
  gulp.watch(productURL+'*.html', reload);
  gulp.watch( customJSWatchFiles, [ 'customJS', reload ] ); // Reload on customJS file changes.
  gulp.watch(imgPaths.src + "/**/*", ['compress-images', 'sprite']);
 });
