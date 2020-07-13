#!/usr/bin/env node
const pathCurrent = process.cwd()

const fs = require('fs')
const templates = {
    vue: {
        input: `${__dirname}/../templates/AoeRandom.vue`,
        output: `${pathCurrent}/AoeRandom.vue`
    },

    reactNative: {
        input: `${__dirname}/../templates/AoeRandom.js`,
        output: `${pathCurrent}/AoeRandom.js`
    },
};

renderFile = (input, output) => {
    const content = fs.readFileSync(input)
    fs.writeFileSync(output, content)
}

writeTemplate = () => {
    const argvs = process.argv
    console.log(argvs[2]);
    console.log(templates);

    try {
        renderFile(templates[argvs[2]]['input'], templates[argvs[2]]['output'])
        console.log('Component AoeRandom create successfully');
    } catch (e) {
        console.log('Nền tảng chưa được hỗ trợ');
    }
}

writeTemplate();
