const { createProxyMiddleware } = require('http-proxy-middleware');

module.exports = function(app) {
    app.use(
        '/api/user-post',
        createProxyMiddleware({
            target: 'http://localhost:8006', // API sunucunuzun adresi
            changeOrigin: true,
        })
    );

    app.use(
        '/api/user-post',
        createProxyMiddleware({
            target: 'http://localhost:8006', // API sunucunuzun adresi
            changeOrigin: true,
        })
    );
};