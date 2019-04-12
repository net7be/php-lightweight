const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const outputDir = 'assets';
const contentBase = path.join(__dirname, `public/${outputDir}`);

const config = {
  entry: {
    app: './src/js/app.js',
    vendor: './src/js/vendor.js'
  },
  output: {
    path: contentBase,
    filename: 'js/[name]_[contenthash:5].js'
  },
  module: {
    rules: [
      {
        test: /\.(png|jpe?g|gif|svg)(\?.*)?$/i,
        use: [
          {
            loader: 'url-loader',
            options: {
              limit: 10000,
              name: 'images/[name].[ext]',
              publicPath: '../'
            }
          }
        ]
      },
      {
        test: /.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
        use: [{
          loader: 'file-loader',
          options: {
            name: 'fonts/[name].[ext]',
            publicPath: '../'
          }
        }]
      },
      {
        test: /\.css$/,
        use: [
          'style-loader',
          MiniCssExtractPlugin.loader,
          'css-loader'
        ]
      }
    ]
  },
  plugins: [
    new CleanWebpackPlugin([contentBase]),
    new ManifestPlugin({
      filter: ({path}) => !path.match(/\.(png|jpe?g|gif|svg)(\?.*)?$/i)
    }),
    new MiniCssExtractPlugin({
      filename: 'css/styles_[contenthash:5].css',
    }),
    new CopyWebpackPlugin([
      { from: './assets/images', to: 'images' }
    ])
  ]
};

/*
  We're exporting a function because Windows
  has issues with environment variables so 
  this is a much safer way to detect the
  requested mode (dev or prod).
*/
module.exports = (env, argv) => {

  if (argv.mode === 'development') {
    config.devtool = 'source-map';
  }
  
  return config;
};