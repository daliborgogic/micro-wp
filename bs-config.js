'use strict'

const proxy = require('http-proxy-middleware');

let apiProxy = proxy('/', {
  target: 'http://micro.dev',
  // for vhosted sites
  changeOrigin: true
})

module.exports = {
  notify: false,
  files: "**/*.php",
  server: {
    middleware: {
      1: apiProxy
    }
  }
}
