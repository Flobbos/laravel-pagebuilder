// https://github.com/shelljs/shelljs
const shell = require('shelljs');

shell.exec('gitbook build', (code, stdout, stderr) => {
  if( code === 0 ) {
    shell.rm('-rf', 'site/docs');
    shell.exec('mv _book site/docs')
  }
});