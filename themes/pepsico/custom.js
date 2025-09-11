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

document.addEventListener('click', function(e){
  const li = e.target.closest('.timeline-year'); if(!li) return;
  const idx = li.dataset.index;
  document.querySelectorAll('.timeline-year').forEach(el=>el.classList.remove('active'));
  li.classList.add('active');
  document.querySelectorAll('.timeline-detail').forEach(el=>{
    el.classList.toggle('active', el.dataset.index === idx);
  });
});

////////
(function(){
  const root = document.getElementById('achievementsTabs');
  if (!root) return;

  const tabs = root.querySelectorAll('.achv-tab');
  const heroPanes = root.querySelectorAll('.achv-hero-pane');
  const tracks = root.querySelectorAll('.achv-track');
  const prevBtn = root.querySelector('.achv-nav.prev');
  const nextBtn = root.querySelector('.achv-nav.next');

  function showTab(key){
    tabs.forEach(btn => {
      const on = btn.dataset.tab === key;
      btn.classList.toggle('is-active', on);
      btn.setAttribute('aria-selected', on ? 'true' : 'false');
    });
    heroPanes.forEach(p => p.classList.toggle('is-hidden', p.dataset.pane !== key));
    tracks.forEach(t => t.classList.toggle('is-hidden', t.dataset.pane !== key));
  }

  // init: luôn hiện tab1 để thấy nội dung dù JS/CSS lỗi
  showTab('t1');

  // switch tabs
  tabs.forEach(btn => btn.addEventListener('click', () => showTab(btn.dataset.tab)));

  // helpers
  function activeTrack(){ return root.querySelector('.achv-track:not(.is-hidden)'); }
  function cardStep(track){
    const card = track && track.querySelector('.achv-card');
    return card ? card.offsetWidth + 24 : 300;
  }

  // nav
  if (prevBtn) prevBtn.addEventListener('click', () => {
    const tr = activeTrack(); if (!tr) return;
    tr.scrollBy({ left: -cardStep(tr), behavior: 'smooth' });
  });
  if (nextBtn) nextBtn.addEventListener('click', () => {
    const tr = activeTrack(); if (!tr) return;
    tr.scrollBy({ left: cardStep(tr), behavior: 'smooth' });
  });

  // drag-to-scroll
  tracks.forEach(tr => {
    let down=false, startX=0, startScroll=0;
    tr.addEventListener('pointerdown', e => {
      down=true; startX=e.clientX; startScroll=tr.scrollLeft;
      tr.setPointerCapture(e.pointerId);
      tr.style.scrollBehavior='auto';
    });
    tr.addEventListener('pointermove', e => {
      if(!down) return;
      tr.scrollLeft = startScroll - (e.clientX - startX);
    });
    function endDrag(){ down=false; tr.style.scrollBehavior=''; }
    tr.addEventListener('pointerup', endDrag);
    tr.addEventListener('pointercancel', endDrag);
    tr.addEventListener('mouseleave', ()=>{ if(down) endDrag(); });
  });
})();
