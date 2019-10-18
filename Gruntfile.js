module.exports = function ( grunt ) {

	// Load all Grunt tasks
	require( 'jit-grunt' )( grunt, {
		makepot: 'grunt-wp-i18n'
	} );

	const sass = require( 'node-sass' );

	grunt.initConfig( {

		pkg: grunt.file.readJSON( 'package.json' ),

		// Concat and Minify our js.
		// uglify: {
		// 	dev: {
		// 		files: {
		// 			'assets/js/plugins.min.js': [
		// 				'assets/js/devs/**/*.js'
		// 			]
		// 		}
		// 	},
		// 	prod: {
		// 		files: {
		// 			'assets/js/<%= pkg.name %>.min.js': [ 'assets/js/plugins.min.js', 'assets/js/main.js' ]
		// 		}
		// 	}
		// },

		// Minify CSS
		// cssmin: {
		// 	options: {
		// 		shorthandCompacting: false,
		// 		roundingPrecision: -1,
		// 		keepSpecialComments: 0
		// 	},
		// 	prod: {
		// 		files: {
		// 			'assets/css/plugins.min.css': [
		// 				'assets/css/devs/**/*.css'
		// 			]
		// 		}
		// 	}
		// },

		// Compile our sass.
		sass: {
			dev: {
				options: {
					implementation: sass,
					outputStyle: 'expanded',
					sourceMap: true
				},
				files: {
					'style.css': 'sass/style.scss',
				}
			},
			prod: {
				options: {
					implementation: sass,
					outputStyle: 'compressed',
					sourceMap: false
				},
				files: {
					'style.min.css': 'sass/style.scss',
				}
			}
		},

		// Autoprefixer.
		autoprefixer: {
			dev: {
				options: {
					browsers: [
						'last 8 versions', 'ie 8', 'ie 9'
					],
					map: true
				},
				files: {
					'style.css': 'style.css'
				}
			},
			prod: {
				options: {
					browsers: [
						'last 8 versions', 'ie 8', 'ie 9'
					],
					map: false
				},
				files: {
					'style.min.css': 'style.min.css'
				}
			}
		},

		// Sorting our CSS properties.
		csscomb: {
			options: {
				config: '.csscomb.json'
			},
			main: {
				src: [ 'style.css' ]
			}
		},

		// Newer files checker
		newer: {
			options: {
				override: function ( detail, include ) {
					if ( detail.task === 'php' || detail.task === 'sass' ) {
						include( true );
					} else {
						include( false );
					}
				}
			}
		},

		// Watch for changes.
		watch: {
			options: {
				livereload: true,
				spawn: false
			},
			sass: {
				files: [ 'sass/**/*.scss' ],
				tasks: [
					'sass:dev',
					'autoprefixer:dev',
				]
			},
			js: {
				files: [ 'assets/js/**/*.js' ],
			}
		},

		// Images minify
		imagemin: {
			screenshot: {
				files: {
					'screenshot.png': 'screenshot.png'
				}
			},
			dynamic: {
				files: [ {
					expand: true,
					cwd: 'assets/img/',
					src: [ '**/*.{png,jpg,gif}' ],
					dest: 'assets/img/'
				} ]
			}
		},

		// Copy the theme into the build directory
		copy: {
			build: {
				expand: true,
				src: [
					'**',
					'!node_modules/**',
					'!bower_components/**',
					'!build/**',
					'!scss/**',
					'!.git/**',
					'!Gruntfile.js',
					'!package.json',
					'!package-lock.json',
					'!.csscomb.json',
					'!.editorconfig',
					'!.tern-project',
					'!bower.json',
					'!.gitignore',
					'!.jshintrc',
					'!.DS_Store',
					'!*.map',
					'!**/*.map',
					'!**/Gruntfile.js',
					'!**/package.json',
					'!**/*~'
				],
				dest: 'build/<%= pkg.name %>/'
			}
		},

		// Compress build directory into <name>.zip
		compress: {
			build: {
				options: {
					mode: 'zip',
					archive: './build/<%= pkg.name %>.zip'
				},
				expand: true,
				cwd: 'build/<%= pkg.name %>/',
				src: [ '**/*' ],
				dest: '<%= pkg.name %>/'
			}
		},

		// Clean up build directory
		clean: {
			build: [
				'build/<%= pkg.name %>',
				'build/<%= pkg.name %>.zip'
			]
		},

		makepot: {
			target: {
				options: {
					domainPath: '/languages/', // Where to save the POT file.
					exclude: [ // Exlude folder.
						'build/.*',
						'assets/.*',
						'readme/.*',
						'scss/.*',
						'bower_components/.*',
						'node_modules/.*'
					],
					potFilename: '<%= pkg.name %>.pot', // Name of the POT file.
					type: 'wp-theme', // Type of project (wp-plugin or wp-theme).
					updateTimestamp: true, // Whether the POT-Creation-Date should be updated without other changes.
					processPot: function ( pot, options ) {
						pot.headers[ 'report-msgid-bugs-to' ] = 'satrya@idenovasi.com';
						pot.headers[ 'plural-forms' ] = 'nplurals=2; plural=n != 1;';
						pot.headers[ 'last-translator' ] = 'Satrya (satrya@idenovasi.com)';
						pot.headers[ 'language-team' ] = 'Satrya (satrya@idenovasi.com)';
						pot.headers[ 'x-poedit-basepath' ] = '..\n';
						pot.headers[ 'x-poedit-language' ] = 'English\n';
						pot.headers[ 'x-poedit-country' ] = 'UNITED STATES\n';
						pot.headers[ 'x-poedit-sourcecharset' ] = 'utf-8\n';
						pot.headers[ 'x-poedit-searchpath-0' ] = '.\n';
						pot.headers[ 'x-poedit-keywordslist' ] = '__;_e;__ngettext:1,2;_n:1,2;__ngettext_noop:1,2;_n_noop:1,2;_c;_nc:4c,1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;\n';
						pot.headers[ 'x-textdomain-support' ] = 'yes\n';
						return pot;
					}
				}
			}
		}

	} );

	// Setup task
	grunt.registerTask( 'default', [
		// 'uglify:dev',
		// 'cssmin:prod',
	] );

	// Production task
	grunt.registerTask( 'build', [
		// 'newer:uglify:prod',
		'newer:imagemin',
		'sass:prod',
		'autoprefixer:prod',
		'csscomb:main',
		'makepot',
		'copy'
	] );

	// Package task
	grunt.registerTask( 'package', [
		'compress',
	] );

};
