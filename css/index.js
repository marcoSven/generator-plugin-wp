'use strict';
var base = require('../plugin-wp-base');

module.exports = base.extend({
  initializing: function () {
    this.pkg = require('../package.json');
    this.rc = this.config.getAll();

    // Have Yeoman greet the user.
    this.log('Welcome to the neat Plugin WP Styles subgenerator!');
  },

  prompting: function () {
    var done = this.async();

    var prompts = [{
      type   : 'list',
      name   : 'type',
      message: 'Style setup',
      choices: ['SASS', 'Basic']
    }];

    // Sanitize inputs
    this.prompt(prompts, function (props) {
      this.type = props.type;

      done();
    }.bind(this));
  },

  configuring: function() {

  },

  writing: function () {
    if ( this.type === 'SASS' ) {
      this.fs.copyTpl(
        this.templatePath('styles.css'),
        this.destinationPath('assets/css/sass/styles.scss'),
        this
      );
    } else {
      this.fs.copyTpl(
        this.templatePath('styles.css'),
        this.destinationPath('assets/css/' + this.rc.slug + '.css'),
        this
      );
    }
  },

  install: function () {
  }
});
