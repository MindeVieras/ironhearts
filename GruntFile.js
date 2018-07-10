//Gruntfile
'use strict';

module.exports = function(grunt) {
    //Initializing the configuration object
    grunt.initConfig({
        sass: {
            dev: {
                options: {
                    style: 'extended'
                },
                files: {
                    "./wp-content/themes/ironhearts/assets/css/styles.css" : "./wp-content/themes/ironhearts/assets/sass/main.scss"
                }
            }
        },
        uglify: {
            prod: {
                files: {
                    './wp-content/themes/ironhearts/assets/js/scripts.js': [
                        './node_modules/owl.carousel/dist/owl.carousel.js',
                        './wp-content/themes/ironhearts/assets/js/src/**/*.js'
                    ]
                },
                options: {
                    mangle: true,
                    // compress: {
                    //     drop_console: true
                    // },
                    compress: true,
                    sourceMap: false
                }
            }
        },
        watch: {
            js: {
                files: ['./wp-content/themes/ironhearts/assets/js/src/*.js'],
                tasks : [
                    'uglify:prod'
                ]
            },
            sass: {
                files: ['./wp-content/themes/ironhearts/assets/sass/**/*.scss'],
                tasks: [
                    'sass:dev'
                ]
            },
            options: {
                livereload: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Task definition
    grunt.registerTask('default', [
        'sass:dev',
        'uglify:prod',
        'watch'
    ]);

};
