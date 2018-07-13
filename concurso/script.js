const dev = true
const path = dev ? 'http://0.0.0.0:8080' : 'https://hotkoa.herokuapp.com'

const login = () => {
    const query = {}
    query.selector = 'login'
    query.email = document.querySelector('#username').value
    query.hash = document.querySelector('#password').value
    axios.post(path, query).then(res => console.log(res))
}

const call2 = (a,b,c) => (() => a(b,c));

const smoothYScrool = (diff, time) => {
    window.scrollBy(0, Math.ceil(diff/time))
    if (time > 0)
        setTimeout(call2(smoothYScrool, diff - Math.ceil(diff/time), time-1), 1)
}

const smooth = (id) => {
    let origin = window.pageYOffset
    let destination = document.querySelector(id).offsetTop
    let diff = destination - origin
    let time = 80
    smoothYScrool(diff, time)
}
