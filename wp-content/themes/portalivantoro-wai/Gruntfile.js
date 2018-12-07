module.exports = function(grunt) {

	//Configure task(s)
	grunt.initConfig({
  		pkg:grunt.file.readJSON('package.json'),

  		compass: {                  // Task
	  		build: {                   // Target
		  		options: {
			  		relativeAssets: true,             // Target options
			  		sassDir: 'src/sass',
			  		cssDir: 'src/css',
			  		imagesDir:'img',
			  		fontsDir:'fonts',
      			}
    		},
			dev: {                    // Another target
				options: {
					relativeAssets: true,
					sourcemap: false,
					sassDir: 'src/sass',
					cssDir: 'src/css',
					imagesDir: 'img',
					fontsDir:'fonts',
      			}
    		}
  		},

  		jshint: {
			files: ['src/js/scripts.js'],
		    options: {
		        // options here to override JSHint defaults
				globals: {
					jQuery: true,
					console: true,
					module: true,
					document: true
		        }
		    }
		},

  		uglify: {
	  		build: {
		  		src: 'src/js/scripts.js',
		  		dest: 'js/script.min.js',

	  		},
	  		dev: {
		  		options: {
			  		beautify: true,
			  		mangle: false,
			  		compress: false,
			  		preserveComments: 'all'
		  		},
		  		src: 'src/js/scripts.js',
		  		dest: 'js/script.min.js'
	  		}
  		},
  		cssmin: {
  			target: {
  				files: [{
  					expand: true,
  					cwd: 'src/css',
  					src: ['*.css', '!*.min.css'],
  					dest: 'css',
  					ext: '.min.css'
    			}]
  			}
		},
  		imagemin: {
			png: {
			    options: {
			        optimizationLevel:7
			        },
			    files: [{
			        expand: true,
			        cwd: 'img',
			        src: ['*.png'],
			        dest: 'img',
			        ext: '.png'
			    }]
			},
			jpg: {
			    options: {
			        progressive: true
			    },
			    files: [{
			        expand: true,
			        cwd: 'img',
			        src: ['*.jpg'],
			        dest: 'img',
			        ext: '.jpg'
			    }]
			}
		},
		concat_css: {
			options: {},
			all: {
				src: ["src/css/*.css"],
				dest: "src/css/styles.min.css"
    		},
  		},
  		browserSync: {
    		dev: {
       			  bsFiles: {
                    src : [
                        'src/css/*.css',
                        'js/*.js',
                        '*.html',
                        '*.php'
                    ]
                },
       			 options: {
       			 	watchTask: true,
           			 proxy: "http://localhost:3000/portal-ivantoro"
       			 }
       		}
		},
  		watch: {
	  		css: {
				files: '**/*.scss',
				tasks: ['compass:dev'],

			/*	options : {
					livereload:9090,
				} */

			},
	  		js: {
		  		files: ['src/js/*.js'],
		  		tasks: ['uglify:dev'],

		  	/*	options : {
					livereload:9090,
				} */

	  		},
	  	/*	html: {
            	files: ['*.php'],
            	options: {
                	livereload: 9090,
            	}
        	}, */
	  		jshint: {
	        	files: ['src/js/*.js'],
				tasks: ['newer:jshint']
	      	}
  		}

	});


	//Load the plugins
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-concat-css');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-browser-sync');
	grunt.loadNpmTasks('grunt-postcss');


	//Register task(s)
 	grunt.registerTask('default', ['browserSync','watch']);
 	grunt.registerTask('build', ['uglify:build','compass:build','newer:imagemin','newer:concat_css','newer:cssmin']);

};
