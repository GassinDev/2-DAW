document.body.style.backgroundColor = 'yellow'
document.body.style.color = '#f0f'
document.body.style.fontFamily = 'Courier'
document.body.style.margin = '40px'
document.body.style.border = '1px solid #f00'
document.body.style.padding = '20px'
document.body.style.visibility = 'hidden'

setInterval(() => {
    if (document.body.style.visibility === 'visible') {
        document.body.style.visibility = 'hidden'
    } else {
        document.body.style.visibility = 'visible'
    }
}, 1000)

setTimeout(() => {
    document.body.style.visibility = 'hidden'
}, 3000)
