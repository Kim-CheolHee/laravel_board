console.log('Test JS file loaded!')

document.addEventListener('DOMContentLoaded', function () {
    const testElement = document.createElement('p')
    testElement.textContent = 'This is a test paragraph from test.js!'
    document.body.appendChild(testElement)
})
