const path = require('path');
const currentTask = process.env.npm_lifecycle_event;
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const fse = require('fs-extra');

/* CREATED PLUGINS */
//class RunAfterCompile {
//  apply(compiler) {
//    compiler.hooks.done.tap('Copy images', () => {
//      fse.copySync('./app/assets/images', './docs/assets/images');
//    });
//  }
//}

/* VARIABLES */
const POSTCSSPlugins = [
  require('postcss-import'),
  require('postcss-mixins'),
  require('postcss-simple-vars'),
  require('postcss-nested'),
  require('postcss-hexrgba'),
  require('autoprefixer')
];

const cssConfig = {
  test: /\.css$/i,
  use: [
    'css-loader?url=false',
    {
      loader: 'postcss-loader',
      options: {
        plugins: POSTCSSPlugins
      }
    }
  ]
};

    const pages = fse
      .readdirSync('./app')
      .filter(file => {
        return file.endsWith('.html');
      })
      .map(page => {
        return new HtmlWebpackPlugin({
          filename: page,
          template: `./app/${page}`
        });
      });


 /* SETTING UP THE CONFIG OBJECT WHICH ARE EXTRACTED */
const config = {
  entry: './app/assets/scripts/App.js',
  plugins: pages,
  module: {
    rules: [cssConfig]
  },

// Generate POT file
//    makepot: {
//      target: {
//        options: {
//          domainPath: '/languages/',
//          potFilename: 'roi-elementor-widget',
//          type: 'wp-plugin',
//        }
//      }
//    },
//    // Generate Text Domain
//    addtextdomain: {
//      options: {
//          textdomain: 'roi-elementor-widget',
//          updateDomains: [ 'roi-elementor-widget' ]
//      },
//      target: {
//        files: {
//          src: [
//            '*.php',
//            '**/*.php',
//          '!node_modules/**',
//          '!tests/**'
//          ]
//        }
//      },
//    }
//
//};

/* DEVELOPMENT MODE */
//if (currentTask == 'dev') {
//  cssConfig.use.unshift('style-loader');
//  config.mode = 'development';

//  config.output = {
//    filename: 'bundled.js',
//    path: path.resolve(__dirname, 'app')
//  };

  
// config.devServer = {
//    contentBase: path.join(__dirname, 'app'),
//    hot: true,
//    before: function(app, server) {
//      server._watch('./app/**/*.html');
//    }
//  };
}


/* BUILD MODE */
if (currentTask == 'build') {
  POSTCSSPlugins.push(require('cssnano'));
  cssConfig.use.unshift(MiniCssExtractPlugin.loader);

  config.module.rules.push({
    test: /\.js$/,
    exclude: /(node_modules)/,
    use: {
      loader: 'babel-loader',
      options: {
        presets: ['@babel/preset-env']
      }
    }
  });

  config.output = {
    filename: 'bundled.min.js',
//    chunkFilename: '[name].[chunkhash].js',
    path: path.resolve(__dirname, 'docs')
  };

  config.mode = 'production';

//  config.optimization = {
//    splitChunks: { chunks: 'all' }
//  };

  config.plugins.push(
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({ filename: 'styles.min.css' }) //    new MiniCssExtractPlugin({ filename: 'styles.[chunkhash].css' }),
//    new RunAfterCompile()
  );
}

module.exports = config;
