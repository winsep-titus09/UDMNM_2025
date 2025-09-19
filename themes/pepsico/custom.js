/**************************************
 * 1) TẠO MŨI TÊN DROPDOWN CHO MENU MOBILE
 **************************************/
document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth <= 991) {
    var menuItems = document.querySelectorAll('.menu-item-has-children');
    var fragment = document.createDocumentFragment();
    menuItems.forEach(function (item) {
      if (!item.querySelector('.mobile-menu-arrow')) {
        var arrow = document.createElement('span');
        arrow.className = 'mobile-menu-arrow';
        // Chèn tạm vào fragment
        fragment.appendChild(arrow);
        // Chèn vào DOM sau link
        item.querySelector('a').after(arrow);
      }
    });
  }
});

document.addEventListener('DOMContentLoaded', function () {
  if (window.innerWidth <= 991) {
    document.querySelectorAll('.menu-item-has-children > a').forEach(function (a) {
      a.addEventListener('click', function (e) {
        var li = a.parentElement;
        var sub = li.querySelector(':scope > .sub-menu');
        var arrow = li.querySelector('.mobile-menu-arrow');
        if (!sub) return; // không có submenu => cho đi link

        // nếu chưa mở => mở và chặn điều hướng
        if (!sub.classList.contains('active')) {
          e.preventDefault();
          sub.classList.add('active');
          if (arrow) arrow.classList.add('open');
          a.setAttribute('aria-expanded', 'true');
        } else {
          // đã mở => cho đi link bình thường (không preventDefault)
          a.setAttribute('aria-expanded', 'false');
        }
      });
    });
  }
});

/**************************************
 * 2) HOVER MỞ/ĐÓNG DROPDOWN CHO DESKTOP
 **************************************/
document.querySelectorAll('.menu-item-has-children').forEach(function (item) {
  let timeout;

  // Khi chuột vào: hủy đóng trễ và mở dropdown
  item.addEventListener('mouseenter', function () {
    clearTimeout(timeout);
    item.classList.add('dropdown-open');
  });

  // Khi chuột ra: trễ 180ms rồi đóng để thao tác mượt
  item.addEventListener('mouseleave', function () {
    timeout = setTimeout(function () {
      item.classList.remove('dropdown-open');
    }, 180); // 150–250ms thường cho cảm giác tự nhiên
  });

  // Giữ mở khi rê vào submenu
  let submenu = item.querySelector('.sub-menu');
  if (submenu) {
    submenu.addEventListener('mouseenter', function () {
      clearTimeout(timeout);
    });
    submenu.addEventListener('mouseleave', function () {
      timeout = setTimeout(function () {
        item.classList.remove('dropdown-open');
      }, 180);
    });
  }
});


/**************************************
 * 3) CLICK MŨI TÊN TRONG MOBILE ĐỂ MỞ/ĐÓNG SUBMENU
 **************************************/
document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth <= 991) {
    document.querySelectorAll('.menu-item-has-children').forEach(function (item) {
      var arrow = item.querySelector('.mobile-menu-arrow');
      var submenu = item.querySelector('.sub-menu');
      if (!arrow || !submenu) return;

      arrow.addEventListener('click', function (e) {
        e.preventDefault();
        // Bật/tắt submenu của chính mục này
        submenu.classList.toggle('active');
        // Quay mũi tên khi submenu đang mở
        arrow.classList.toggle('open', submenu.classList.contains('active'));
      });
    });
  }
});

/**************************************
 * 5) TIMELINE: CLICK NĂM → HIỆN CHI TIẾT TƯƠNG ỨNG
 **************************************/
document.addEventListener('click', function (e) {
  const li = e.target.closest('.timeline-year'); // Chỉ phản hồi khi click vào .timeline-year
  if (!li) return;
  const idx = li.dataset.index;

  // Cập nhật trạng thái active cho danh sách năm
  document.querySelectorAll('.timeline-year').forEach(el => el.classList.remove('active'));
  li.classList.add('active');

  // Chỉ hiển thị detail có data-index trùng với năm được chọn
  document.querySelectorAll('.timeline-detail').forEach(el => {
    el.classList.toggle('active', el.dataset.index === idx);
  });
});


/**************************************
 * 6) ACHIEVEMENTS TABS + CAROUSEL NGANG KÉO/CLICK
 **************************************/
(function () {
  const root = document.getElementById('achievementsTabs');
  if (!root) return;

  // Lấy các phần tử cốt lõi
  const tabs = root.querySelectorAll('.achv-tab');                 // Nút tab
  const heroPanes = root.querySelectorAll('.achv-hero-pane');      // Khối hero theo tab
  const tracks = root.querySelectorAll('.achv-track');             // Dải card ngang theo tab
  const prevBtn = root.querySelector('.achv-nav.prev');            // Nút cuộn trái
  const nextBtn = root.querySelector('.achv-nav.next');            // Nút cuộn phải

  // Chuyển tab theo key (ví dụ 't1', 't2')
  function showTab(key) {
    tabs.forEach(btn => {
      const on = btn.dataset.tab === key;
      btn.classList.toggle('is-active', on);
      btn.setAttribute('aria-selected', on ? 'true' : 'false');
    });
    // Ẩn/hiện hero & track tương ứng
    heroPanes.forEach(p => p.classList.toggle('is-hidden', p.dataset.pane !== key));
    tracks.forEach(t => t.classList.toggle('is-hidden', t.dataset.pane !== key));
  }

  // Khởi tạo: luôn mở tab1 để đảm bảo có nội dung kể cả khi JS/CSS lỗi
  showTab('t1');

  // Chuyển tab khi click nút
  tabs.forEach(btn => btn.addEventListener('click', () => showTab(btn.dataset.tab)));

  // Helper: lấy track (dải thẻ) đang hiển thị
  function activeTrack() { return root.querySelector('.achv-track:not(.is-hidden)'); }

  // Tính bước cuộn theo kích thước card + gap (fallback 300 nếu chưa đo được)
  function cardStep(track) {
    const card = track && track.querySelector('.achv-card');
    return card ? card.offsetWidth + 24 : 300;
  }

  // Nút cuộn trái/phải
  if (prevBtn) prevBtn.addEventListener('click', () => {
    const tr = activeTrack(); if (!tr) return;
    tr.scrollBy({ left: -cardStep(tr), behavior: 'smooth' });
  });
  if (nextBtn) nextBtn.addEventListener('click', () => {
    const tr = activeTrack(); if (!tr) return;
    tr.scrollBy({ left: cardStep(tr), behavior: 'smooth' });
  });

  // Kéo-để-cuộn (drag to scroll) trên track
  tracks.forEach(tr => {
    let down = false, startX = 0, startScroll = 0;
    tr.addEventListener('pointerdown', e => {
      down = true; startX = e.clientX; startScroll = tr.scrollLeft;
      tr.setPointerCapture(e.pointerId);
      tr.style.scrollBehavior = 'auto'; // bỏ smooth để kéo mượt
    });
    tr.addEventListener('pointermove', e => {
      if (!down) return;
      tr.scrollLeft = startScroll - (e.clientX - startX);
    });
    function endDrag() { down = false; tr.style.scrollBehavior = ''; }
    tr.addEventListener('pointerup', endDrag);
    tr.addEventListener('pointercancel', endDrag);
    tr.addEventListener('mouseleave', () => { if (down) endDrag(); });
  });
})();


/**************************************
 * 7) HOME-DRINK CAROUSEL: AUTOSCROLL VÔ HẠN
 **************************************/
(function () {
  document.querySelectorAll('.home-drink-carousel').forEach(function (wrap) {
    const track = wrap.querySelector('.home-drink-track');
    if (!track) return;

    const SPEED = 0.6; // px mỗi frame (thấp = chậm, cao = nhanh)
    const gap = () => parseFloat(getComputedStyle(track).gap || 0);
    let GAP = gap();

    // Nhân bản phần tử con để đảm bảo có đủ chiều dài cho hiệu ứng vô hạn
    function fillTrack() {
      const need = wrap.offsetWidth * 2; // tối thiểu gấp đôi bề rộng vùng nhìn
      while (track.scrollWidth < need) {
        const kids = Array.from(track.children);
        for (const el of kids) track.appendChild(el.cloneNode(true));
      }
    }
    fillTrack();

    // Biến điều khiển animation
    let offset = 0, rafId = null;

    // Tick mỗi frame: dịch trái theo SPEED, nếu phần tử đầu ra khỏi khung thì đẩy xuống cuối
    function tick() {
      offset -= SPEED;
      track.style.transform = `translateX(${offset}px)`;
      const first = track.children[0];
      const w = first.getBoundingClientRect().width + GAP;
      if (-offset >= w) {
        track.appendChild(first);
        offset += w; // reset offset để tránh số âm lớn dần
        track.style.transform = `translateX(${offset}px)`;
      }
      rafId = requestAnimationFrame(tick);
    }

    const start = () => { if (!rafId) rafId = requestAnimationFrame(tick); };
    const stop = () => { if (rafId) { cancelAnimationFrame(rafId); rafId = null; } };

    // Tạm dừng khi hover để người dùng đọc nội dung
    wrap.addEventListener('mouseenter', stop);
    wrap.addEventListener('mouseleave', start);

    // Khi resize: tính lại gap & reset transform, đồng thời đảm bảo track đủ dài
    window.addEventListener('resize', () => { GAP = gap(); offset = 0; track.style.transform = 'translateX(0)'; fillTrack(); });

    start(); // bắt đầu chạy
  });
})();


/**************************************
 * 8) SUSTAIN SECTION: INFINITE SCROLLER 3 DẢI
 **************************************/
(function () {
  // Đọc khoảng cách gap (grid/gap/columnGap) dưới dạng px
  function getGapPx(scroller) {
    const cs = getComputedStyle(scroller);
    const g = parseFloat(cs.gap || cs.columnGap || '0');
    return isNaN(g) ? 0 : g;
  }

  // Khởi tạo cho từng section .sustain
  function initSection(section) {
    const scroller = section.querySelector('.sustain-scroller');
    if (!scroller) return;

    // Lấy các thẻ gốc .s-card để clone
    const originals = Array.from(scroller.children).filter(el => el.classList.contains('s-card'));
    const n = originals.length;
    if (n === 0) return;

    // Clone trước và sau dải gốc
    const clonesBefore = originals.map(el => el.cloneNode(true));
    const clonesAfter = originals.map(el => el.cloneNode(true));
    clonesBefore.forEach(cl => scroller.insertBefore(cl, scroller.firstChild));
    clonesAfter.forEach(cl => scroller.appendChild(cl));

    const firstCard = scroller.querySelector('.s-card');
    let gap = getGapPx(scroller);

    // Hàm đo nhanh bề rộng card và tổng bề rộng 1 chu kỳ (sequence)
    const cardWidth = () => firstCard.getBoundingClientRect().width;
    const seqW = () => (cardWidth() + gap) * n;

    // Đặt scroll giữa (vào dải gốc) để có không gian lùi/tiến vô hạn
    function center() { scroller.scrollLeft = seqW(); }
    requestAnimationFrame(center);

    // Trong lúc kéo: chuẩn hóa vị trí nếu vượt ngưỡng (bù vào để không giật)
    function normalizeWhileDragging(state) {
      const w = seqW(); if (w <= 0) return;
      while (scroller.scrollLeft < w) {
        scroller.scrollLeft += w;
        if (state) state.startLeft += w;
      }
      while (scroller.scrollLeft >= 2 * w) {
        scroller.scrollLeft -= w;
        if (state) state.startLeft -= w;
      }
    }
    // Khi không kéo: chỉ cần chuẩn hóa vị trí về [w, 2w)
    function normalize() { normalizeWhileDragging(null); }

    // Theo dõi resize để giữ vị trí tương đối (tránh giật layout)
    if ('ResizeObserver' in window) {
      const ro = new ResizeObserver(() => {
        gap = getGapPx(scroller);
        const w = seqW(); if (w <= 0) return;
        const mod = scroller.scrollLeft % w;
        scroller.scrollLeft = w + mod; // đưa về dải gốc + phần lẻ đang xem
      });
      ro.observe(scroller);
      if (firstCard) ro.observe(firstCard);
    } else {
      window.addEventListener('resize', () => {
        gap = getGapPx(scroller);
        const w = seqW(); if (w <= 0) return;
        const mod = scroller.scrollLeft % w;
        scroller.scrollLeft = w + mod;
      });
    }

    // Biến trạng thái kéo (pointer)
    const drag = { down: false, startX: 0, startLeft: 0, pid: null };

    // Đọc cấu hình autoplay từ data-autoplay (ms); 0 = tắt
    const autoplayMs = parseInt(section.dataset.autoplay || '0', 10) || 0;
    let timer = null;

    // Bắt đầu autoplay: mỗi tick cuộn đúng 1 card (cardWidth + gap)
    function startAuto() {
      if (!autoplayMs) return;
      stopAuto();
      timer = setInterval(() => {
        scroller.scrollLeft += (cardWidth() + gap);
        const w = seqW();
        if (scroller.scrollLeft >= 2 * w) {
          scroller.scrollLeft -= w; // dịch tức thời để không thấy giật
        }
      }, autoplayMs);
    }
    // Dừng autoplay
    function stopAuto() {
      if (timer) { clearInterval(timer); timer = null; }
    }

    // Kéo bắt đầu: lưu tọa độ, dừng autoplay, bật style kéo
    scroller.addEventListener('pointerdown', e => {
      drag.down = true; drag.pid = e.pointerId;
      drag.startX = e.clientX; drag.startLeft = scroller.scrollLeft;
      scroller.classList.add('dragging');
      scroller.setPointerCapture(drag.pid);
      stopAuto(); // dừng khi kéo
    });
    // Kéo di chuyển: cập nhật scrollLeft theo delta
    scroller.addEventListener('pointermove', e => {
      if (!drag.down) return;
      const dx = e.clientX - drag.startX;
      scroller.scrollLeft = drag.startLeft - dx;
      normalizeWhileDragging(drag);
    });
    // Kết thúc kéo: nhả capture, chuẩn hóa lại, rồi chạy autoplay nếu có
    function endDrag() {
      if (!drag.down) return;
      drag.down = false; scroller.classList.remove('dragging');
      try { if (drag.pid != null) scroller.releasePointerCapture(drag.pid); } catch (e) { }
      drag.pid = null;
      normalize();
      startAuto();
    }
    scroller.addEventListener('pointerup', endDrag);
    scroller.addEventListener('pointercancel', endDrag);
    scroller.addEventListener('pointerleave', endDrag);

    // Khi scroll do user (không kéo), debounce bằng rAF rồi normalize
    let rafId = 0;
    scroller.addEventListener('scroll', () => {
      if (drag.down) return;
      if (!rafId) {
        rafId = requestAnimationFrame(() => { rafId = 0; normalize(); });
      }
    }, { passive: true });

    // Hover tạm dừng / rời chuột chạy lại autoplay
    section.addEventListener('mouseenter', stopAuto);
    section.addEventListener('mouseleave', startAuto);

    startAuto(); // chạy ngay nếu autoplayMs > 0
  }

  // Tìm và khởi tạo mọi section .sustain sau khi DOM sẵn sàng
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.sustain').forEach(initSection);
  });
})();

document.addEventListener('DOMContentLoaded', function () {
  // Bấm vào input date => mở lịch luôn (nếu trình duyệt hỗ trợ showPicker)
  document.querySelectorAll('.spv-news-filterForm input[type="date"]').forEach(function (el) {
    function openPicker() { if (typeof el.showPicker === 'function') el.showPicker(); }
    el.addEventListener('focus', openPicker);
    el.addEventListener('click', openPicker);
    // Enter để mở lịch
    el.addEventListener('keydown', function (e) { if (e.key === 'Enter') { e.preventDefault(); openPicker(); } });
  });
});


// slide cho trang san phẩm (single-pepsico.php)

document.addEventListener('DOMContentLoaded', function () {
  // Mỗi section .drink-variants là 1 slider độc lập
  document.querySelectorAll('.drink-variants').forEach(function (wrap) {
    const stage = wrap.querySelector('.dv-stage');
    if (!stage) return;

    const items = Array.from(stage.querySelectorAll('.dv-item'));
    if (items.length === 0) return;

    let cur = 0;

    function paint() {
      items.forEach((it, i) => {
        it.classList.remove('is-center', 'is-left', 'is-right', 'is-hidden');
        const diff = (i - cur + items.length) % items.length;
        if (i === cur) {
          it.classList.add('is-center');
        } else if (diff === 1) {
          it.classList.add('is-right');
        } else if (diff === items.length - 1) {
          it.classList.add('is-left');
        } else {
          it.classList.add('is-hidden');
        }
      });
    }

    // Khởi tạo
    paint();

    // Nút điều hướng trong chính section này
    const prevBtn = wrap.querySelector('.dv-nav.prev');
    const nextBtn = wrap.querySelector('.dv-nav.next');

    function goPrev() { cur = (cur - 1 + items.length) % items.length; paint(); }
    function goNext() { cur = (cur + 1) % items.length; paint(); }

    prevBtn && prevBtn.addEventListener('click', goPrev);
    nextBtn && nextBtn.addEventListener('click', goNext);

    // Bàn phím (chỉ khi slider đang trong viewport/được focus)
    wrap.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') goPrev();
      if (e.key === 'ArrowRight') goNext();
    });
    // Cho focus để nhận phím
    wrap.tabIndex = 0;

    // Ẩn nút khi ít ảnh
    if (items.length < 2) {
      prevBtn && (prevBtn.style.display = 'none');
      nextBtn && (nextBtn.style.display = 'none');
    }
  });
});

// lazy load images
(function () {
  const els = document.querySelectorAll('.lazy-bg[data-bg]');
  if (!('IntersectionObserver' in window)) {
    els.forEach(el => el.style.backgroundImage = `url(${el.dataset.bg})`);
    return;
  }
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const el = e.target;
        el.style.backgroundImage = `url(${el.dataset.bg})`;
        el.removeAttribute('data-bg');
        io.unobserve(el);
      }
    });
  }, { rootMargin: '200px 0px' });
  els.forEach(el => io.observe(el));
})();
