const gulp = require('gulp');
const purgecss = require('gulp-purgecss');

gulp.task('purgecss', () => {
    return gulp.src('style.css') // Ruta de tus archivos CSS
        .pipe(
            purgecss({
                content: ['**/*.php'] // Ruta de tus archivos PHP, usualmente todos los archivos de plantilla de tu tema
            })
        )
        .pipe(gulp.dest('build/css')); // Ruta donde se guardarán los archivos CSS purgados
});

gulp.task('default', gulp.series('purgecss'));
