document.addEventListener("DOMContentLoaded", function(){
    if(window.innerWidth <= 991){
        document.querySelectorAll('.menu-item-has-children').forEach(function(item){
            if(!item.querySelector('.mobile-menu-arrow')){
                var arrow = document.createElement('span');
                arrow.className = 'mobile-menu-arrow';
                item.querySelector('a').after(arrow);
            }
        });
    }
});



document.querySelectorAll('.menu-item-has-children').forEach(function(item) {
    let timeout;

    item.addEventListener('mouseenter', function() {
        clearTimeout(timeout);
        item.classList.add('dropdown-open');
    });

    item.addEventListener('mouseleave', function() {
        timeout = setTimeout(function() {
            item.classList.remove('dropdown-open');
        }, 180); // thời gian giữ lại, thường 150-250ms là hợp lý
    });

    // Nếu submenu cũng cần giữ mở khi hover vào
    let submenu = item.querySelector('.sub-menu');
    if (submenu) {
        submenu.addEventListener('mouseenter', function() {
            clearTimeout(timeout);
        });
        submenu.addEventListener('mouseleave', function() {
            timeout = setTimeout(function() {
                item.classList.remove('dropdown-open');
            }, 180);
        });
    }
});

document.addEventListener("DOMContentLoaded", function(){
    if(window.innerWidth <= 991){
        document.querySelectorAll('.menu-item-has-children').forEach(function(item){
            var arrow = item.querySelector('.mobile-menu-arrow');
            var submenu = item.querySelector('.sub-menu');
            if(!arrow || !submenu) return;

            arrow.addEventListener('click', function(e){
                e.preventDefault();
                // Toggle submenu của mục này
                submenu.classList.toggle('active');
                // Quay mũi tên khi mở
                arrow.classList.toggle('open', submenu.classList.contains('active'));
            });
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll(".banner-slider .slide");
    const prevBtn = document.querySelector(".banner-slider .prev-btn");
    const nextBtn = document.querySelector(".banner-slider .next-btn");
    let current = 0;

    function showSlide(index) {
        slides.forEach((s, i) => {
            s.classList.remove("active");
            if (i === index) s.classList.add("active");
        });
    }

    prevBtn.addEventListener("click", function() {
        current = (current - 1 + slides.length) % slides.length;
        showSlide(current);
    });

    nextBtn.addEventListener("click", function() {
        current = (current + 1) % slides.length;
        showSlide(current);
    });

    // Không tự động chuyển slide nữa
});