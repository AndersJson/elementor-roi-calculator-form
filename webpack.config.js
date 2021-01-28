const path = require('path');
const currentTask = process.env.npm_lifecycle_event;
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const fse = require('fs-extra');


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
  entry: {
    app: './app/assets/scripts/App.js',
    admin: './app/assets/scripts/Admin.js'
  },
  plugins: pages,
  module: {
    rules: [cssConfig]
  },
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
    filename: '[name].min.js',
    path: path.resolve(__dirname, 'docs')
  };

  config.mode = 'production';

  config.plugins.push(
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({ filename: '[name]styles.min.css' }) 
  );
}

module.exports = config;
