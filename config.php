<?php

// Run `node -e "console.log(require('crypto').randomBytes(32).toString('hex'))"`
// in terminal to generate secret
define('APPLICATION_NAME', 'multitier-shop');
define('JWT_SECRET', 'd0fa1b85fc9ac2d882f1157c1253fca79d6249d3cc7a8350df1f7f004342db42');


// Set database connection info here
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'multitier_shop');
