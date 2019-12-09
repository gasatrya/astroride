module.exports = function( grunt ) {

	// Load all Grunt tasks
	require( 'jit-grunt' )( grunt, {
		makepot: 'grunt-wp-i18n',
		postcss: '@lodder/grunt-postcss',
	} );

	const sass = require( 'node-sass' );

	grunt.initConfig( {

		pkg: grunt.file.readJSON( 'package.json' ),

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
					'style-editor.css': 'sass/style-editor.scss',
				}
			}
		},

		// PostCSS.
		postcss: {
			options: {
				map: true,
				processors: [
					require( 'autoprefixer' )( )
				]
			},
			dist: {
				src: 'style.css'
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
					'sass:dev'
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

		// RTL CSS
		rtlcss: {
			prod: {
				expand: true,
				files: {
					'style-rtl.css': 'style.css'
				}
			}
		},

		// Copy the theme into the build directory
		copy: {
			build: {
				expand: true,
				src: [
					'**',
					'!node_modules/**',
					'!build/**',
					'!scss/**',
					'!.git/**',
					'!Gruntfile.js',
					'!package.json',
					'!package-lock.json',
					'!.editorconfig',
					'!.gitignore',
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
				'build/'
			]
		},

		// Generate .pot file
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
					processPot: function( pot, options ) {
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
		'watch'
	] );

	// Compress image task
	grunt.registerTask( 'image', [
		'imagemin',
	] );

	// Production task
	grunt.registerTask( 'build', [
		'sass',
		'postcss',
		'rtlcss',
		'makepot',
	] );

	// Package task
	grunt.registerTask( 'package', [
		'copy',
		'compress'
	] );

};
