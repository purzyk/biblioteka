var gulp            = require('gulp'),
    less            = require('gulp-less'),
    minify          = require('gulp-clean-css'),
    uglify          = require('gulp-uglify'),
    concat          = require('gulp-concat'),
    clean           = require('gulp-clean'),
    autoprefixer    = require('gulp-autoprefixer'),
    plumber         = require('gulp-plumber'),

    //nunjucksRender  = require('gulp-nunjucks-render'),
    twig_compile    = require('gulp-twig-compile'),
    twig            = require('gulp-twig'),

    del             = require('del'),
    
    conflict        = require("gulp-conflict");

    imagemin        = require('gulp-imagemin'),
    cache           = require('gulp-cache'),
    gulpIf          = require('gulp-if'),
    useref          = require('gulp-useref'),
    data            = require('gulp-data');

var browserSync     = require('browser-sync').create(),
    reload          = browserSync.reload;

var runSequence = require('run-sequence');

// ******************************************

var bases = {
  src: '__src/',
  preview: '__preview/',
  assets: '__preview/assets/'
};

var wp_paths = {
  template : 'templates/',
  assets : bases.assets
}

var paths = {

  watcher_all_file : [
    bases.src+'/less/**/*.less',
    bases.src+'/js/**/*.js'
  ],

  watcher_less_file : [
    bases.src+'/less/**/*.less',
  ],

  watcher_js_file : [
    bases.src+'/js/**/*.js'
  ],

  watcher_teplates_file : [
    bases.src+'/html/**/*.+(html|twig)'
  ],

  less_main: [
    bases.src+'/less/site.less'
  ],

  js: [
    bases.src+'/js/modules/*.js',
    //bases.src+'/js/**/*.js',
    bases.src+'/js/*.js'
  ],

  ng: [
    bases.src+'/js/angular/*.js'
  ],

  fonts : [
    bases.src+'/fonts/**/*.*'
  ],

  html : [
    bases.src+'/html/**/*.html'
  ]

}

// ******************************************

// Optimizing Images
gulp.task('images', function(){
  cache.clearAll()
  return gulp.src(bases.src+'img/**/*.+(png|jpg|jpeg)')
  .pipe(cache(imagemin({
      // Setting interlaced to true
      interlaced: true
    })))
  .pipe(gulp.dest(wp_paths.assets+'img'))  
});

gulp.task('images:temp', function(){
  cache.clearAll()
  return gulp.src(bases.src+'img_temp/**/*.+(png|jpg|jpeg)')
  .pipe(cache(imagemin({
      // Setting interlaced to true
      interlaced: true
    })))
  .pipe(gulp.dest(wp_paths.assets+'img_temp'))
});

// ******************************************

// Copying fonts
gulp.task('fonts', function() {
  return gulp.src(bases.src+'fonts/**/*')
    .pipe(gulp.dest(wp_paths.assets+'fonts'))
})

// ******************************************

// Copying SVG
gulp.task('copy-svg', function() {
  return gulp.src(bases.src+'/img/svg/*.+(svg)')
    .pipe(gulp.dest(wp_paths.assets+'img/svg/'))
})

// ******************************************

// Cleaning
/*gulp.task('clean', function(cb) {
  return del.sync(bases.assets+'**')
  .then(function(cb) {
    return cache.clearAll(cb);
  });
})*/

gulp.task('clean:assets', function() {
  return del.sync([
    bases.assets+'/*.html',
    '!'+bases.assets+'/img',
    '!'+bases.assets+'/img/**/*',
    '!'+bases.assets+'/js',
    '!'+bases.assets+'/js/**/*',
    '!'+bases.assets+'/css',
    '!'+bases.assets+'/css/**/*',
    '!'+bases.assets+'/fonts',
    '!'+bases.assets+'/fonts/**/*'
  ]);
});


gulp.task('clean:preview', function() {
  return del.sync([
    bases.preview+'/**/*.html',
    bases.preview+'/*.html'    
  ]);
});

// ******************************************

// Optimizing CSS and JavaScript
gulp.task('useref', function() {

  return gulp.src(bases.preview+'*.html')
    .pipe(useref())
    .pipe(gulpIf('*.js', uglify()))
    .pipe(gulpIf('*.css', minify())) // cssnano
    //.pipe(cache(useref()))
//    .pipe(gulpIf('*.js', cache(uglify())))
//    .pipe(gulpIf('*.css', cache(minify())))
    .pipe(gulp.dest(bases.preview))
    .pipe(reload({stream: true}));
});

// ******************************************


gulp.task('less', function () {
  return gulp.src(paths.less_main)
    .pipe(plumber({
        errorHandler: function (err) {
          console.log(err);
          this.emit('end');
        }
    }))
    .pipe(less())
    .pipe(autoprefixer({
        browsers: ['last 8 versions', 'IE 9'],
        cascade: false
    }))
    //.pipe(concat('styles.css'))
    //.pipe(gulp.dest(wp_paths.assets+'css/'))
    .pipe(minify())
    .pipe(concat('styles.min.css'))

    .pipe(gulp.dest(wp_paths.assets+'css/'))
    .pipe(reload({stream: true}));
});

// ******************************************

gulp.task('js', function () {
  return gulp.src(paths.js)
    .pipe(plumber({
        errorHandler: function (err) {
          console.log(err);
          this.emit('end');
        }
    }))
    .pipe(uglify())   
    .pipe(concat('main.min.js'))
    .pipe(gulp.dest(wp_paths.assets+'js/'))
    .pipe(reload({stream: true}));

});

// ******************************************

gulp.task('ng', function () {
    return gulp.src(paths.ng)
        .pipe(plumber({
            errorHandler: function (err) {
                console.log(err);
                this.emit('end');
            }
        }))
        //.pipe(uglify())
        .pipe(concat('ng-main.min.js'))
        .pipe(gulp.dest(wp_paths.assets+'js/'))
        .pipe(reload({stream: true}));

});

// ******************************************

//Creating html template's
gulp.task('twig', function() {
  return gulp.src(bases.src+'html/*.+(twig)')
    .pipe(data(function() {
          return require('./'+bases.src+'html/data.json')
      }))
      .pipe(twig({
          base : '__src/html/',
          functions : [
              {
                  name: "TimberImage",
                  func: function (args) {
                      return args;
                  }
              },
              {
                  name: "LoremIpsum",
                  func: function (args) {
                      var lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eget sem sit amet eros interdum ultricies. Aenean ac orci lacinia, finibus risus elementum, ultricies arcu. Aliquam sit amet urna lacinia tortor semper porttitor et vitae lectus. Morbi lacinia risus non quam condimentum imperdiet. Donec lacinia rutrum interdum. Nullam sit amet libero massa. Nam porttitor feugiat ante, eget mollis orci pulvinar at. Duis non ultricies mauris, vitae ullamcorper lorem. Vivamus mauris velit, lacinia at rutrum quis, sollicitudin sit amet turpis. Phasellus ultrices orci eu dictum ornare. Duis vel molestie mauris. Sed venenatis libero in pretium euismod. Quisque quam nulla, porta eu posuere sit amet, condimentum ac mi. Vestibulum vel venenatis nunc. Mauris purus mi, auctor nec consequat at, viverra vitae eros. Donec blandit libero et leo consectetur, sed interdum erat tempus.';
                      return lorem.substring(0, args);
                  }
              },
              {
                  name: "__",
                  func: function (args) {
                      return args;
                  }
              }
          ],
          filters : [
              {
                  name: "resize",
                  func: function (args) {
                      //return args;
                  }
              }
          ]
      }))
    //.pipe(conflict(bases.preview))
    .pipe(gulp.dest(bases.preview))
    .pipe(reload({stream: true}));
});

gulp.task('parse-twig', function(cb) {
  cache.clearAll();
  runSequence('twig', 'reload', cb);
});

gulp.task('build-twig', function(cb) {
  cache.clearAll();
  runSequence('twig', 'useref', cb);
});


//Creating html template's
gulp.task('reload', function() {
  return gulp.src(bases.preview)
        .pipe(reload({stream: true}));
});

// ******************************************

gulp.task('watch-less', function () {
  gulp.watch(paths.watcher_less_file, ['less']);
});

// ******************************************

gulp.task('watch-js', function () {
  gulp.watch(paths.watcher_js_file, ['js']);
});

// ******************************************

gulp.task('watch-ng', function () {
    gulp.watch(paths.watcher_js_file, ['ng']);
});

// ******************************************

gulp.task('watch-twig', function () {
  gulp.watch(paths.watcher_teplates_file, ['twig']);
});

// ******************************************

// Static Server + watching less/html files
gulp.task('serve', ['twig', 'less', 'js'], function () {
  browserSync.init({
    server: bases.preview
    // Multiple base directories
    //server: [bases.assets, bases.src]
  });
  gulp.watch(paths.watcher_teplates_file, ['twig']);
  gulp.watch(paths.watcher_less_file, ['less']);
  gulp.watch(paths.watcher_js_file, ['js']);
  //gulp.watch(bases.preview+"/**/*.*").on('change', reload);
});

// ******************************************

// WP

gulp.task('wp:copy-twig', function() {
  return gulp.src([
    bases.src+'html/**/*.+(twig)',
    '!'+bases.src+'html/template.twig',
    ])
    .pipe(conflict(wp_paths.template, { defaultChoice:'n' }))
    .pipe(gulp.dest(wp_paths.template))
})

gulp.task('wp:copy-from-assets', function(calback) {
  wp_paths.assets = 'assets/';
  cache.clearAll();
  return gulp.src(bases.preview+'assets/**/*.*')
    //.pipe(conflict(wp_paths.assets, { defaultChoice:'n' }))
    .pipe(gulp.dest(wp_paths.assets))
})

gulp.task('wp:build', function(calback) {
  wp_paths.assets = 'assets/';
  cache.clearAll();
  runSequence (
    ['wp:copy-twig'],
    ['wp:copy-from-assets'],
    calback
  );
})

gulp.task('wp:watch', function(callback) {
    wp_paths.assets = 'assets/';
    runSequence ( ['watch-less', 'watch-js', 'watch-ng'], callback );
})


// ******************************************

//
gulp.task('watch', ['watch-less', 'watch-twig', 'watch-js']);

//
gulp.task('default', function(callback){
  cache.clearAll();
  runSequence ( 'rebuild', 'serve', callback );
});

//
gulp.task('rebuild', function(callback) {
  cache.clearAll();
  runSequence(
    'clean:assets',
    ['js', 'less', 'images', 'copy-svg', 'fonts'],
    'twig',
    'useref',
    'reload',
    callback
  )
})



