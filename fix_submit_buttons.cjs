const fs = require('fs');
const glob = require('glob');

const files = glob.sync('tests/e2e/**/*.spec.ts');

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    
    // Replace the generic submit button selector with one that ignores the logout form
    content = content.replace(
        /'button\[type="submit"\]'/g,
        '\'form:not([action$="logout"]) button[type="submit"]\''
    );
    
    // Also replace double quotes version
    content = content.replace(
        /"button\[type=\\"submit\\"\]"/g,
        '"form:not([action$=\\"logout\\"]) button[type=\\"submit\\"]"'
    );

    fs.writeFileSync(file, content, 'utf8');
});

console.log('Fixed submit button selectors.');
