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

(function(){
  document.querySelectorAll('.home-drink-carousel').forEach(function(wrap){
    const track = wrap.querySelector('.home-drink-track');
    if(!track) return;

    const SPEED = 0.6;
    const gap = () => parseFloat(getComputedStyle(track).gap || 0);
    let GAP = gap();

    function fillTrack(){
      const need = wrap.offsetWidth * 2;
      while(track.scrollWidth < need){
        const kids = Array.from(track.children);
        for(const el of kids) track.appendChild(el.cloneNode(true));
      }
    }
    fillTrack();

    let offset = 0, rafId = null;
    function tick(){
      offset -= SPEED;
      track.style.transform = `translateX(${offset}px)`;
      const first = track.children[0];
      const w = first.getBoundingClientRect().width + GAP;
      if(-offset >= w){
        track.appendChild(first);
        offset += w;
        track.style.transform = `translateX(${offset}px)`;
      }
      rafId = requestAnimationFrame(tick);
    }
    const start = ()=>{ if(!rafId) rafId = requestAnimationFrame(tick); };
    const stop  = ()=>{ if(rafId){ cancelAnimationFrame(rafId); rafId = null; } };

    wrap.addEventListener('mouseenter', stop);
    wrap.addEventListener('mouseleave', start);
    window.addEventListener('resize', ()=>{ GAP = gap(); offset = 0; track.style.transform='translateX(0)'; fillTrack(); });

    start();
  });
})();

(function(){
  function getGapPx(scroller){
    const cs = getComputedStyle(scroller);
    const g = parseFloat(cs.gap || cs.columnGap || '0');
    return isNaN(g) ? 0 : g;
  }

  function initSection(section){
    const scroller = section.querySelector('.sustain-scroller');
    if(!scroller) return;

    const originals = Array.from(scroller.children).filter(el => el.classList.contains('s-card'));
    const n = originals.length;
    if (n === 0) return;

    const clonesBefore = originals.map(el => el.cloneNode(true));
    const clonesAfter  = originals.map(el => el.cloneNode(true));
    clonesBefore.forEach(cl => scroller.insertBefore(cl, scroller.firstChild));
    clonesAfter.forEach(cl => scroller.appendChild(cl));

    const firstCard = scroller.querySelector('.s-card');
    let gap = getGapPx(scroller);

    const cardWidth = () => firstCard.getBoundingClientRect().width;
    const seqW      = () => (cardWidth() + gap) * n;

    function center(){ scroller.scrollLeft = seqW(); }
    requestAnimationFrame(center);

    function normalizeWhileDragging(state){
      const w = seqW(); if (w <= 0) return;
      while (scroller.scrollLeft < w){
        scroller.scrollLeft += w;
        if (state) state.startLeft += w;
      }
      while (scroller.scrollLeft >= 2*w){
        scroller.scrollLeft -= w;
        if (state) state.startLeft -= w;
      }
    }
    function normalize(){ normalizeWhileDragging(null); }

    if ('ResizeObserver' in window){
      const ro = new ResizeObserver(()=>{
        gap = getGapPx(scroller);
        const w = seqW(); if (w <= 0) return;
        const mod = scroller.scrollLeft % w;
        scroller.scrollLeft = w + mod;
      });
      ro.observe(scroller);
      if (firstCard) ro.observe(firstCard);
    } else {
      window.addEventListener('resize', ()=>{
        gap = getGapPx(scroller);
        const w = seqW(); if (w <= 0) return;
        const mod = scroller.scrollLeft % w;
        scroller.scrollLeft = w + mod;
      });
    }

    const drag = { down:false, startX:0, startLeft:0, pid:null };

    // Autoplay (đọc từ data-autoplay, ms)
    const autoplayMs = parseInt(section.dataset.autoplay || '0', 10) || 0;
    let timer=null;
    function startAuto(){
      if(!autoplayMs) return;
      stopAuto();
      timer = setInterval(()=>{
        scroller.scrollLeft += (cardWidth() + gap);
        const w = seqW();
        if (scroller.scrollLeft >= 2*w){
          scroller.scrollLeft -= w; // tức thời, không giật
        }
      }, autoplayMs);
    }
    function stopAuto(){
      if(timer){ clearInterval(timer); timer=null; }
    }

    scroller.addEventListener('pointerdown', e=>{
      drag.down = true; drag.pid = e.pointerId;
      drag.startX = e.clientX; drag.startLeft = scroller.scrollLeft;
      scroller.classList.add('dragging');
      scroller.setPointerCapture(drag.pid);
      stopAuto(); // ⟵ dừng autoplay khi bắt đầu kéo
    });
    scroller.addEventListener('pointermove', e=>{
      if(!drag.down) return;
      const dx = e.clientX - drag.startX;
      scroller.scrollLeft = drag.startLeft - dx;
      normalizeWhileDragging(drag);
    });
    function endDrag(){
      if(!drag.down) return;
      drag.down=false; scroller.classList.remove('dragging');
      try { if(drag.pid!=null) scroller.releasePointerCapture(drag.pid); } catch(e){}
      drag.pid=null;
      normalize();
      startAuto(); // ⟵ chạy lại sau khi thả
    }
    scroller.addEventListener('pointerup', endDrag);
    scroller.addEventListener('pointercancel', endDrag);
    scroller.addEventListener('pointerleave', endDrag);

    let rafId = 0;
    scroller.addEventListener('scroll', ()=>{
      if (drag.down) return;
      if (!rafId){
        rafId = requestAnimationFrame(()=>{ rafId = 0; normalize(); });
      }
    }, { passive:true });

    section.addEventListener('mouseenter', stopAuto);
    section.addEventListener('mouseleave', startAuto);

    startAuto();
  }

  document.addEventListener('DOMContentLoaded', ()=>{
    document.querySelectorAll('.sustain').forEach(initSection);
  });
})();
