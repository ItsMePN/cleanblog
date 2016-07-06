module.exports = function ( grunt ) {

	// load all grunt tasks matching the `grunt-*` pattern
	// Ref. https://npmjs.org/package/load-grunt-tasks
	require( 'load-grunt-tasks' )( grunt );

	grunt.initConfig( {
		// watch for changes and trigger sass, jshint, uglify and livereload
		watch: {
			sass: {
				files: [ 'sass/**/*.{scss,sass}', 'pro/**/*.{scss,sass}' ],
				tasks: [ 'sass', 'autoprefixer', 'cmq' ]
			},
			// js: {
			// 	files: '<%= uglify.frontend.src %>',
			// 	tasks: [ 'uglify' ]
			// },
			livereload: {
				// Here we watch the files the sass task will compile to
				// These files are sent to the live reload server after sass compiles to them
				options: { livereload: true },
				files: [ '*.php', '*.css', '*.js' ]
			}
		},
		// Compile Sass to CSS
		// Ref. https://www.npmjs.com/package/grunt-contrib-sass
		sass: {
			//expanded: {
			//			options: {
			//				style: 'expanded' // nested / compact / compressed / expanded
			//			},
			//			files: {
			//				'style-expanded.css': 'sass/style.scss', // 'destination': 'source'
			//				'pro/pro.css': 'pro/sass/pro.scss'
			//			}
			//		  },
			minify: {
						options: {
							style: 'nested' // nested / compact / compressed / expanded
						},
						files: {
							'style.css': 'style.css' // 'destination': 'source'
						}
					}
			// editor: {
			// 			options: {
			// 				style: 'compressed' // nested / compact / compressed / expanded
			// 			},
			// 			files: {
			// 				'editor-style.css': 'sass/editor-style.scss' // 'destination': 'source'
			// 			}
			// 		},

		},

        // To copy files from node_modules
        // Ref. https://www.npmjs.com/package/grunt-contrib-copy

        copy: {
            angularjs: {
                expand: true,
                cwd: 'node_modules/angular/',
                src: 'angular.min.js',
                dest: 'js/'
            },
            angularroutejs: {
                expand: true,
                cwd: 'node_modules/angular-route/',
                src: 'angular-route.min.js',
                dest: 'js/'
            },
			angularsanitizejs: {
				expand: true,
				cwd: 'node_modules/angular-sanitize/',
				src: 'angular-sanitize.min.js',
				dest: 'js/'
			},
			bootstrapjs: {
				expand: true,
				cwd: 'node_modules/bootstrap/dist/js/',
				src: 'bootstrap.min.js',
				dest: 'js/'
			},
			bootstrapjs: {
				expand: true,
				cwd: 'node_modules/angular-utils-disqus/',
				src: 'dirDisqus.js',
				dest: 'js/'
			},
			bootstrapcss: {
				expand: true,
				cwd: 'node_modules/bootstrap/dist/css/',
				src: 'bootstrap.min.css',
				dest: 'css/'
			}

        },

		// autoprefixer
		autoprefixer: {
			options: {
				browsers: [ 'last 2 versions', 'ie 9', 'ios 6', 'android 4' ],
				map: true
			},
			files: {
				expand: true,
				flatten: true,
				src: '*.css',
				dest: ''
			}
		},
		// Uglify Ref. https://npmjs.org/package/grunt-contrib-uglify
		//uglify: {
		//	options: {
		//		banner: '/*! \n * Personal Blog JavaScript Library \n * @package Personal Blog Theme \n */',
		//		sourceMap: 'js/main.js.map',
		//		sourceMappingURL: 'main.js.map',
		//		sourceMapPrefix: 2
		//	},
		//	frontend: {
		//		src: [
		//			'js/vendor/jquery.cycle2.js',
		//			'js/vendor/jquery.mmenu.min.all.js',
		//			'js/main.js'
		//		],
		//		dest: 'js/main.min.js'
		//	}
		//},
		// Internationalize WordPress themes and plugins
		// Ref. https://www.npmjs.com/package/grunt-wp-i18n
		//
		// IMPORTANT: `php` and `php-cli` should be installed in your system to run this task
		makepot: {
					target: {
						options: {
							cwd: '.', // Directory of files to internationalize.
							domainPath: 'languages/', // Where to save the POT file.
							exclude: [ 'node_modules/*' ], // List of files or directories to ignore.
							mainFile: 'index.php', // Main project file.
							potFilename: 'cleanblog.pot', // Name of the POT file.
							potHeaders: { // Headers to add to the generated POT file.
								poedit: true, // Includes common Poedit headers.
								'Last-Translator': 'Company <support@personal-blog-theme.com>',
								'Language-Team': 'Team <support@personal-blog-theme.com>',
								'report-msgid-bugs-to': 'https://github.com/ItsMePN',
								'x-poedit-keywordslist': true // Include a list of all possible gettext functions.
							},
							type: 'wp-theme', // Type of project (wp-plugin or wp-theme).
							updateTimestamp: true // Whether the POT-Creation-Date should be updated without other changes.
						}
					}
				},

		//https://www.npmjs.com/package/grunt-checktextdomain
		//checktextdomain: {
		//	options: {
		//		text_domain: 'cleanblog', //Specify allowed domain(s)
		//		keywords: [ //List keyword specifications
		//			'__:1,2d',
		//			'_e:1,2d',
		//			'_x:1,2c,3d',
		//			'esc_html__:1,2d',
		//			'esc_html_e:1,2d',
		//			'esc_html_x:1,2c,3d',
		//			'esc_attr__:1,2d',
		//			'esc_attr_e:1,2d',
		//			'esc_attr_x:1,2c,3d',
		//			'_ex:1,2c,3d',
		//			'_n:1,2,4d',
		//			'_nx:1,2,4c,5d',
		//			'_n_noop:1,2,3d',
		//			'_nx_noop:1,2,3c,4d'
		//		]
		//	},
		//	target: {
		//		files: [ {
		//				src: [
		//					'*.php',
		//					'**/*.php',
		//					'!node_modules/**',
		//					'!tests/**'
		//				], //all php
		//				expand: true
		//			} ]
		//	}
		//},
		// Combine Media Queries
		//
		// Combine matching media queries into one media query definition. Useful for CSS generated by preprocessors using nested media queries.
		// Ref. https://www.npmjs.com/package/grunt-combine-media-queries
		cmq: {
			options: {
				log: false
			},
			target: {
				files: {
					'style.css': ['style.css']
				}
			}
		}
	} );

    //grunt.loadNpmTasks('grunt-copy');
	// register task
	grunt.registerTask( 'default', [ 'sass', 'autoprefixer', 'copy', 'watch' ] );
	//grunt.registerTask( 'default', [ 'sass', 'autoprefixer', 'checktextdomain', 'makepot', 'uglify', 'watch' ] );
};