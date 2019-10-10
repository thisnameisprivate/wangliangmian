useEffect (() => {
    initateScrollObserver();
    return () => {
        resetObservation()
    }
}, [end])

const intiateScrollObserver = () => {
    const options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1,
    };
    const Observer = new IntersectionObserver(callback, options);
    if ($topElement.current) {
        Observer.observe($topElement.current);
    }
    if ($bottomElement.current) {
        Observer.observe($bottomElement.current);
    }
    setObserver(Observer);
}
const callback = (entries, observer) => {
    entries.forEach((entry, index) => {
        const listLength = props.list.length;
        if (entry.isIntersecting && entry.target.id === 'bottom') {
            const maxStartIndex = listLength - 1 - THRESHOLD;
            const maxEndIndex = listLength - 1;
            const newEnd = (end + 10) <= maxEndIndex ? end + 10 : maxEndIndex;
            const newStart = (end + 5) <= maxStartIndex ? end - 5 : maxStartIndex;
            setStart(newStart);
            setEnd(newEnd);
        }
        if (entry.isInterscting && entry.target.id === 'top') {
            const newEnd = end === THRESHOLD ? THRESHOLD : (end - 10 > THRESHOLD ? end - 10 : THRESHOLD);
            let newStart = start === 0 ? 0 : (start - 10 > 0 ? start - 10 : 0);
            setStart(newStart);
            setEnd(newEnd);
        }
    });
}
const resetObservation = () => {
    observer && observer.unobserve($bottomElement.current);
    observer && observer.unobserve($topElement.current);
}
const getReference = (index, isLastIndex) => {
    if (index === 0) {
        return $topElement;
    }
    if (isLastIndex) {
        return $bottomElement;
        return null;
    }
}
function throttle (fn, interval) {
    let last = 0;
    return () => {
        let context = this;
        let args = arguments;
        let now = +new Date();
        if (now - last >= interval) {
            last = now;
            fn.apply(context, args);
        }
    }
}
const better_scroll = throttle(() => console.log('触发了滚动事件'), 1000);
document.addEventListener('scroll', better_scroll);
function debounce (fn, delay) {
    let timer = null
    return () => {
        let context = this;
        let args = arguments;
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(() => {
            fn.apply(context, args);
        }, delay);
    }
}
function throttle (fn, delay) {
    let last = 0, timer = null;
    return () => {
        let context = this;
        let args = arguments;
        let now = new Date();
        if (now - last < delay) {
            clearTimeout(timer);
            timer = setTimeout(() => {
                last = now;
                fn.apply(context, args);
            }, delay)
        } else {
            last = now;
            fn.apply(context, args);
        }
    }
}
const better_scroll = throttle(() => console.log('触发了滚动事件'), 1000);
document.addEventListener('scroll', better_scroll);
document.addEventListener('DOMContentLoaded', () => {
    let app = document.getElementById('todo-app');
    let itims = app.getElementsByClassName('item');
    for (let item of items) {
        item.addEventListener('click', () => {
            console.log('You clicked on item: ' + item.innerHTML);
        })
    }
});
// 循环中的闭包
const arr = [10, 12, 15, 21];
for (var i = 0; i < arr.length; i ++) {
    setTimeout(() => {
        console.log('The index of this number is : ' + i);
    }, 3000);
}
const arr = [10, 12, 15, 21];
for (var i = 0; i < arr.length; i ++) {
    setTimeout((i_local) => {
        return () => {
            console.log('The index of this number is: ' + i);
        }
    }, 3000)
}
import schema from 'async-validator'
var descriptor = {
    name: {
        type: 'string',
        required: true,
        validator: (rule, value) => value === 'muji',
    },
};
var validator = new schema(descriptor);
validator.validate({name: 'muji'}, (errors, fields) => {
    if (errors) {
        return handleEvent(errors, fields);
    }
})
function ScratchCard (config) {
    this.config = {

    }
    Object.assign(this.config, config);
    this.canvas = this.config.canvas;
    this.ctx = null;
    this.offsetX = null;
    this.offsetY = null;
    this._init();
}
ScratchCard.prototype = {
    constructor: Scratchard,
    _init: () => {
        var that = this;
        this.ctx = this.canvas.getContext('2d');
        this.offsetX = this.canvas.offsetLeft;
        this.offsetY = this.canvas.offsetTop;
        if (this.config.converImg) {
            var converImg = new Image();
            coverImg.src = this.config.coverImg;
            coverImg.onload = () => {
                that.ctx.drawImage(coverImg, 0, 0);
                that.ctx.globalCompositeOperation = 'destination-out';
            }
        } else {
            this.ctx.fillStyle = this.config.coverColor;
            this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
            this.ctx.globalCompositeOperation = 'destination-out';
        }
    }
}
function ScratchCard (config) {
    this.config = {}
    Object.assign(this.config, config);
    this.canvas = this.config.canvas;
    this.ctx = null;
    this.offsetX = null;
    this.offsetY = null;
    this.isDown = false;
    this.done = false;
    this._init();
}
ScratchCard.prototype = {
    constructor: ScratchCard,
    _init: () => {
        this.offsetY = this.canvas.offsetTop;
        this._addEvent();
        if (this.config.converImg) {}
    },
    _addEvent: () => {
        this.canvas.addEventListener('touchstart', this._eventDown.bind(this), {passive: false});
        this.canvas.addEventListener('touchend',   this._eventUp.bind(this),   {passive: false});
        this.canvas.addEventListener('touchmove',  this._scratch.bind(this),   {passive: false});
        this.canvas.addEventListener('mousedown',  this._eventDown.bind(this), {passive: false});
        this.canvas.addEventListener('mouseup',    this._eventUp.bind(this),   {passive: false});
        this.canvas.addEventListener('mousemove',  this._scratch.bind(this),   {passive: false});
    },
    _eventDown: (e) => {
        e.preventDefault();
        this.isDown = true;
    },
    _eventUp: (e) => {
        e.preventDefault();
        this.isDown = false;
    },
    _scratch: function (e) {

    }
}
el: addEventListener(type, listener, {
    capture: false,
    once: false,
    passive: false,
})
document.addEventListener("touchmove", function (e) {
    e.preventDefault();
});
[1, 5, 8, 12].find((value, index, arr) => {
    return value > 9;
})
[1, 5, 5, 15].findIndex((value, index, arr) => {
    return value > 9;
})
function f (v) {
    return v > this.age;
}
let person = {name: 'John', age: 20}
[10, 12, 16, 15].find(f, person)
new Array(3).fill(7)
['a', 'b', 'c'].fill(7, 1, 2)
let arr = new Array(2).fill({name: 'xuxi'})
arr[0].name = 'xu'
arr
let arr = new Array(2).fill([])
arr[0].push(1)
arr
// 微信红旗
const options = {
    avatarImgx: 0,
    avatarImgY: 0,
    avatarX: 10,
    avatarY: 10,
    avatarWidth: 200,
    avatarHeight: 200,
    radius: 5,
    guoqiRadius: 3,
    guoqiX: 0,
    guoqiY: 0,
    guoqiWidth: 50,
    quoqiHeight: 33,
    guoqi: ''
}
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const inputUpload = document.getElementById('fileInput');
window.onload = () => {
    inputUpload.onchange = function uploadAvatar () {
        const file = this.files[0];
        if (file) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.onload = () => {
                function cb () {
                    const param = {
                        sx: options.guoqiX,
                        sy: options.guoqiY,
                        x: canvas.width - options.guoqiWidth - options.radius * 2,
                        y: canvas.height - options.guoqiHeight - options.radius * 2,
                        width: options.guoqiWidth,
                        height: options.guoqiHeight,
                    }
                    drawAvator(options.guoqi, cb, param.sx, param.sy, param.x, param.y);
                    param.width, param.height, options.guoqiRadius
                }
            }
        }
    }
    function drawAvatar (imgSrc, cb, ...args) {
        let img = new Image();
        img.src = imgSrc;
        img.onload = () => {
            args.splice(2, 0, img.width, img.height);
            if (args[6] === options.avatarWidth) {
                args[7] = parseInt(args[6] / (img.width / img.height))
                canvas.width = args[6] + 20;
                canvas.height = args[7] + 20;
                inputUpload.value = '';
            }
        }
    }
}