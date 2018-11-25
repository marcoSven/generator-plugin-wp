'use strict';
var base = require('../plugin-wp-base');

module.exports = base.extend({
  initializing: function () {
    this.pkg = require('../package.json');
    this.rc = this.config.getAll();

    // Have Yeoman greet the user.
    this.log('Welcome to the neat Plugin WP Javascript subgenerator!');
  },

  prompting: function () {
    var done = this.async();

    var prompts = [{
      type: 'list',
      name: 'type',
      message: 'Javascript setup',
      choices: ['Concat', 'Basic']
    }];

    this.prompt(prompts, function (props) {
      // Sanitize inputs
      this.type = props.type;

      this.jsclassname = this.rc.classname.replace( /\_/gi, '' );

      done();
    }.bind(this));
  },

  configuring: function() {

  },

  writing: function () {
    var mainfile = 'assets/js/';

    if ( this.type !== 'Basic' ) {
      mainfile += 'components/main.js';
    } else {
      mainfile += this.rc.slug + '.js';
    }

    this.fs.copyTpl(
      this.templatePath('main.js'),
      this.destinationPath(mainfile),
      this
    );

    this.fs.copy(
      this.templatePath('_eslintrc.json'),
      this.destinationPath('.eslintrc.json')
    );
  },

  install: function () {
  }
});
