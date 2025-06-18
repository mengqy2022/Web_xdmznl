const carousel = document.querySelector('#imageCarousel');
let interval; // 在这里声明一个变量用于存储定时器ID

function nextSlide() {
    const nextControl = document.querySelector('.carousel-control-next');
    nextControl.click(); // 自动点击“下一个”按钮
    resetInterval(); // 点击后重新计算4秒
}

function resetInterval() {
    clearInterval(interval); // 清除当前定时器
    interval = setInterval(nextSlide, 4000); // 重新设置定时器
}

// 初始化自动调用nextSlide函数
resetInterval(); // 第一次调用

// 鼠标悬停时停止自动播放
carousel.addEventListener('mouseenter', () => {
    clearInterval(interval);
});

// 鼠标离开时重新开始自动播放
carousel.addEventListener('mouseleave', () => {
    resetInterval();
});
