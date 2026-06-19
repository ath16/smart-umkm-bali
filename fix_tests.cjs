const fs = require('fs');
const glob = require('glob');

const files = glob.sync('tests/e2e/**/*.spec.ts');

files.forEach(file => {
    let content = fs.readFileSync(file, 'utf8');
    
    // Replace click submit followed by goto
    content = content.replace(
        /await page\.click\('button\[type="submit"\]'\);\s+await page\.goto/g,
        'await page.click(\'button[type="submit"]\');\n    await page.waitForTimeout(1500);\n    await page.goto'
    );

    // Also replace click submit followed by a comment then goto
    content = content.replace(
        /await page\.click\('button\[type="submit"\]'\);\s+\/\/[^\n]+\s+await page\.goto/g,
        match => {
            return match.replace('await page.goto', 'await page.waitForTimeout(1500);\n    await page.goto');
        }
    );

    fs.writeFileSync(file, content, 'utf8');
});

console.log('Fixed test files.');
