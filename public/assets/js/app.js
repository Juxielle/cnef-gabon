/* ==== NAVBAR : menus déroulants ==== */
const dropdownCloseTimers = new Map();

function openDropdown(dd) {
  clearTimeout(dropdownCloseTimers.get(dd));
  document.querySelectorAll('.nav-dropdown.open').forEach(d => { if (d !== dd) d.classList.remove('open'); });
  dd.classList.add('open');
  positionDropdown(dd);
}
function scheduleCloseDropdown(dd) {
  clearTimeout(dropdownCloseTimers.get(dd));
  dropdownCloseTimers.set(dd, setTimeout(() => dd.classList.remove('open'), 220));
}
function toggleDropdown(e, name) {
  e.stopPropagation();
  const dd = document.getElementById('nav-dropdown-' + name);
  if (!dd) return;
  const wasOpen = dd.classList.contains('open');
  closeDropdowns();
  if (!wasOpen) openDropdown(dd);
}
function positionDropdown(dd) {
  const trigger = dd.querySelector('.nav-dd-trigger');
  const menu = dd.querySelector('.nav-dd-menu');
  if (!trigger || !menu) return;
  const r = trigger.getBoundingClientRect();
  const left = Math.max(8, Math.min(r.left, window.innerWidth - menu.offsetWidth - 8));
  menu.style.left = left + 'px';
}
function closeDropdowns() {
  document.querySelectorAll('.nav-dropdown.open').forEach(d => {
    clearTimeout(dropdownCloseTimers.get(d));
    d.classList.remove('open');
  });
}
document.addEventListener('click', e => {
  if (!e.target.closest('.nav-dropdown')) closeDropdowns();
});
window.addEventListener('resize', closeDropdowns);
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.nav-dropdown').forEach(dd => {
    dd.addEventListener('mouseenter', () => openDropdown(dd));
    dd.addEventListener('mouseleave', () => scheduleCloseDropdown(dd));
  });
});

/* ==== TOAST ==== */
function toast(msg, ok = true) {
  const t = document.getElementById('toast');
  if (!t) return;
  document.getElementById('toast-msg').textContent = msg;
  t.style.background = ok ? 'var(--vert)' : '#c0392b';
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 5000);
}

/* ==== SCROLL TOP BUTTON + REVEAL ON SCROLL ==== */
window.addEventListener('scroll', () => {
  const stb = document.getElementById('stb');
  if (stb) stb.classList.toggle('show', window.scrollY > 400);
});
document.addEventListener('DOMContentLoaded', () => {
  const ro = new IntersectionObserver(entries => entries.forEach(e => {
    if (e.isIntersecting) e.target.classList.add('vis');
  }), { threshold: .08 });
  document.querySelectorAll('.rv').forEach(el => ro.observe(el));
});

/* ==== HERO CAROUSEL (page d'accueil) ==== */
let hcarIdx = 0, hcarTimer = null;
function hcarGo(i) {
  const slides = document.querySelectorAll('#hero-carousel .hcar-slide');
  const dots = document.querySelectorAll('#hero-carousel .hcar-dot');
  if (!slides.length) return;
  hcarIdx = (i + slides.length) % slides.length;
  slides.forEach((s, j) => s.classList.toggle('on', j === hcarIdx));
  dots.forEach((d, j) => d.classList.toggle('on', j === hcarIdx));
}
function hcarNext() { hcarGo(hcarIdx + 1); }
function hcarPrev() { hcarGo(hcarIdx - 1); }
function hcarAuto() { clearInterval(hcarTimer); hcarTimer = setInterval(hcarNext, 5500); }
function initHeroCarousel() {
  const el = document.getElementById('hero-carousel');
  if (!el) return;
  hcarAuto();
  el.addEventListener('mouseenter', () => clearInterval(hcarTimer));
  el.addEventListener('mouseleave', hcarAuto);
}
document.addEventListener('DOMContentLoaded', initHeroCarousel);

/* ==== UPLOAD ZONE (formulaires de saisine / candidature) ==== */
function dragOver(e, zoneId) { e.preventDefault(); document.getElementById(zoneId).classList.add('drag'); }
function dragLeave(e, zoneId) { document.getElementById(zoneId).classList.remove('drag'); }
function dropFiles(e, zoneId, inputId) {
  e.preventDefault();
  document.getElementById(zoneId).classList.remove('drag');
  const input = document.getElementById(inputId);
  input.files = e.dataTransfer.files;
  renderFileList(inputId, inputId + '-list');
}
function renderFileList(inputId, listId) {
  const input = document.getElementById(inputId);
  const list = document.getElementById(listId);
  if (!input || !list) return;
  const files = Array.from(input.files || []);
  list.innerHTML = files.map(f => `
    <div class="file-item">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.5)" stroke-width="2" stroke-linecap="round"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
      <span class="file-item-name">${f.name}</span>
      <span style="font-size:11px;color:rgba(255,255,255,.3)">${(f.size / 1024).toFixed(0)} Ko</span>
    </div>`).join('');
}
