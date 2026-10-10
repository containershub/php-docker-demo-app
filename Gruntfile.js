module.exports = function (grunt) {

    // Require the sass module - grunt-sass instead of grunt-contrib-sass
    // because grunt-contrib-sass requires Ruby and it's not very convenient in
    // a Docker container.
    const sassCompiler = require('sass');

    // Project configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Minify JavaScript task
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <% grunt.template.today("dd-mm-yyyy") %> */n'
            },
            build: {
                src: './resources/js/main.js',
                dest: './public/js/main.min.js'
            }
        },

        // Compile sass task - for grunt-sass which doesn't require Ruby
        sass: {
            options: {
                implementation: sassCompiler,
                sourceMap: true
            },

            dist: {
                files: {
                    './public/css/main.css': './resources/sass/main.scss'
                }
            }
        },

        // Watch task configuration
        watch: {
            scripts: {
                files: ['./resources/js/**/*.js'],      // Watch all JavaScript files
                tasks: ['uglify'],                      // Run uglify if they change
                options: { spawn: false }               // Fast updates
            },
            css: {
                files: ['./resources/sass/**/*.scss'],  // Watch all Sass files
                tasks: ['sass'],                        // Run Sass compilation if they change
            }
        }
    });

    // Load the plugins
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');          // Links the "grunt watch" command


    // Register custom task aliases
    // Default task(s): Typing "grunt" runs sass and uglify sequentially as a complete build
    grunt.registerTask('default', ['sass', 'uglify']);

    // Optional: Explicit build command alias "grunt build"
    grunt.registerTask('build', ['sass', 'uglify']);

    // Development command that will first build and then watch
    grunt.registerTask('dev', ['sass', 'uglify', 'watch']);
};
