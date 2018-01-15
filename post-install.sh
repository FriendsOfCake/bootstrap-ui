#!/usr/bin/env bash

debug=true

# Load Bootstrap Plugin, if not already loaded in config/bootstrap.php
# If in debug, load plugin with routes to see example pages
loaded=$(../../../bin/cake plugin loaded | grep BootstrapUI)
if [ -z ${loaded} ]; then
  echo "Loading Bootstrap Plugin...";
  if $debug; then
    ../../../bin/cake plugin load BootstrapUI -r
  else
    ../../../bin/cake plugin load BootstrapUI
  fi
fi

# Checking npm
echo "Checking npm...";
command -v npm >/dev/null 2>&1 || { echo >&2 "NPM (https://www.npmjs.com/) is required, but not installed. Aborting."; exit 1; }

# Install Bootstrap Assets (Bootstrap, JQuery, Popper.js)
echo "Installing Bootstrap Assets...";
rm -R node_modules
npm install --verbose 2>&1

# Clear webroot & copy Assets
echo "Clearing webroot and Copying Assets...";
find webroot -type f -not -name 'cover.css' -not -name 'dashboard.css' -not -name 'signin.css' -delete
rm -rf webroot/js/*

if $debug; then
  # This will copy all assets, including source maps
  cp -r node_modules/bootstrap/dist/* webroot
  cp -r node_modules/jquery/dist/* webroot/js
  cp -r node_modules/popper.js/dist/* webroot/js
else
  # This will copy only assets for production
  cp -f node_modules/bootstrap/dist/css/bootstrap.min.css webroot/css/
  cp -f node_modules/bootstrap/dist/js/bootstrap.min.js webroot/js/
  cp -f node_modules/jquery/dist/jquery.min.js webroot/js
  cp -f node_modules/popper.js/dist/popper.min.js webroot/js
fi

# Symlink Assets to webroot
echo "Symlinking Assets...";
symlink=../../../webroot/bootstrap_u_i
if [ -L $symlink ]; then
  rm -f $symlink
fi
../../../bin/cake plugin assets symlink
