//root paths for themes/plugins
var themePath = 'wp-content/themes/industry';

module.exports = function(grunt) {
  //load all Grunt tasks
  grunt.loadNpmTasks('grunt-responsive-images');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');

  // Project configuration.
  var config = {
    pkg: grunt.file.readJSON('package.json'),

    less: {
      development: {
        files: {

        }
      }
    },
    responsive_images: {
      thumbNails: {
        options: {
          sizes: [{
            name: 'thumb',
            width: '200'
          }]
        }
      },
      files: {
        expand: true,
        src: ['content/**.{jpg,png}'],
        cwd: './app/img/',
        dest: 'thumbs/'
      }
    },

    watch: {
      scripts: {
        files: ['**/*.less'],
        tasks: ['less:development'],
        options: {
          spawn: false
        }
      }
    }
  };
  // append theme rootpath to css/less locations /css/<name of your file>.css/less
  config.less.development.files[themePath + '/css/lesson.css'] = themePath + '/css/lesson.less';

  grunt.initConfig(config);
  // the default task (running "grunt" in console) is "watch"
  grunt.registerTask('default', ['less','watch']);

};
