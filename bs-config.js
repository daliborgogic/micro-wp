'use strict'

const proxy = require('http-proxy-middleware');

let apiProxy = proxy('/', {
  target: 'http://micro.dev',
  // for vhosted sites
  changeOrigin: true
})

module.exports = {
  server: {
    middleware: {
      1: apiProxy
    }
  }
}
