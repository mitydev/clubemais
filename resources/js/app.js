import './bootstrap'
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

// === MOBILE DRAWER (off-canvas) ===
document.addEventListener('DOMContentLoaded', () => {
  const openBtn  = document.getElementById('drawer-open')
  const drawer   = document.getElementById('mobile-drawer')
  const backdrop = document.getElementById('drawer-backdrop')
  const panel    = document.getElementById('drawer-panel')
  const closeBtn = document.getElementById('drawer-close')
  if (!openBtn || !drawer || !backdrop || !panel) return

  const open = () => {
    // habilita clique no container
    drawer.classList.remove('pointer-events-none')
    drawer.classList.add('pointer-events-auto')

    // mostra backdrop
    backdrop.classList.remove('opacity-0')
    backdrop.classList.add('opacity-100')

    // traz o painel
    panel.classList.remove('translate-x-full')

    openBtn.setAttribute('aria-expanded', 'true')
    drawer.setAttribute('aria-hidden', 'false')

    // trava o scroll do fundo
    document.body.style.overflow = 'hidden'

    // foca o painel
    setTimeout(() => panel.focus(), 10)
  }

  const close = () => {
    // esconde backdrop
    backdrop.classList.remove('opacity-100')
    backdrop.classList.add('opacity-0')

    // envia o painel pra fora
    panel.classList.add('translate-x-full')

    openBtn.setAttribute('aria-expanded', 'false')
    drawer.setAttribute('aria-hidden', 'true')

    document.body.style.overflow = ''

    // após a animação, desabilita clique no container
    setTimeout(() => {
      drawer.classList.remove('pointer-events-auto')
      drawer.classList.add('pointer-events-none')
    }, 200) // mesmo tempo do transition
  }

  openBtn.addEventListener('click', open)
  closeBtn?.addEventListener('click', close)
  backdrop.addEventListener('click', close)
  window.addEventListener('keydown', (e) => { if (e.key === 'Escape') close() })

  // fecha ao clicar em qualquer link/botão do painel
  panel.querySelectorAll('a, button').forEach(el => el.addEventListener('click', close))
})
