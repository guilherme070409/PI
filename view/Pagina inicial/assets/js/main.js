/*=============== SHOW SIDEBAR ===============*/
const showSidebar = (toggleId, sidebarId, headerId, mainId) =>{
   const toggle = document.getElementById(toggleId),
         sidebar = document.getElementById(sidebarId),
         header = document.getElementById(headerId),
         main = document.getElementById(mainId)

   if(toggle && sidebar && header && main){
       toggle.addEventListener('click', ()=>{
           /* Show sidebar */
           sidebar.classList.toggle('show-sidebar')
           /* Add padding header */
           header.classList.toggle('left-pd')
           /* Add padding main */
           main.classList.toggle('left-pd')
       })
   }
}
showSidebar('header-toggle','sidebar', 'header', 'main')

/*=============== LINK ACTIVE ===============*/
const categoryLinks = document.querySelectorAll('.sidebar__list a[data-category]')
const privacyLinks = document.querySelectorAll('.sidebar__list a[data-privacy]')
const categorySections = document.querySelectorAll('.category-section')
const privacySections = document.querySelectorAll('.privacy-section')
const categoriesContainer = document.getElementById('categories')
const privacyContainer = document.getElementById('privacy')
const mainTitle = document.querySelector('#main h1')

function handleCategoryClick(event){
    // Permite links .php navegarem
    const href = event.currentTarget.getAttribute('href') || ''
    if(href.endsWith('.php')) return
    event.preventDefault()
    const clicked = event.currentTarget
    const category = clicked.getAttribute('data-category')
    if(!category) return

    // Estado ativo apenas dentro do grupo de categorias
    categoryLinks.forEach(l => l.classList.remove('active-link'))
    clicked.classList.add('active-link')

    // Mostrar área de categorias e ocultar privacidade
    if(categoriesContainer) categoriesContainer.style.display = 'block'
    if(privacyContainer) privacyContainer.style.display = 'none'
    // Oculta seções de privacidade
    privacySections.forEach(section => {
        section.classList.remove('active')
        section.style.display = 'none'
    })

    categorySections.forEach(section => {
        const isMatch = section.getAttribute('data-category') === category
        section.classList.toggle('active', isMatch)
        section.style.display = isMatch ? 'block' : 'none'
    })

    // Atualiza o título principal com o nome da categoria
    try{ if(mainTitle) mainTitle.textContent = clicked.querySelector('span')?.textContent || 'Categorias' }catch{}
}

// Inicializa visibilidade conforme link ativo inicial
function initializeCategoriesVisibility(){
    let initialCategory = null
    categoryLinks.forEach(l => {
        if(l.classList.contains('active-link')){
            initialCategory = l.getAttribute('data-category')
        }
    })
    if(!initialCategory && categoryLinks.length){
        initialCategory = categoryLinks[0].getAttribute('data-category')
        categoryLinks[0].classList.add('active-link')
    }
    categorySections.forEach(section => {
        const isMatch = section.getAttribute('data-category') === initialCategory
        section.classList.toggle('active', isMatch)
        section.style.display = isMatch ? 'block' : 'none'
    })
    if(categoriesContainer) categoriesContainer.style.display = 'block'
    if(privacyContainer) privacyContainer.style.display = 'none'

    // Define o título inicial com a categoria ativa
    try{
        if(mainTitle){
            const activeLink = Array.from(categoryLinks).find(l => l.classList.contains('active-link')) || categoryLinks[0]
            if(activeLink) mainTitle.textContent = activeLink.querySelector('span')?.textContent || 'Categorias'
        }
    }catch{}
}

function handlePrivacyClick(event){
    const href = event.currentTarget.getAttribute('href') || ''
    if(href.endsWith('.php')) return
    event.preventDefault()
    const clicked = event.currentTarget
    const key = clicked.getAttribute('data-privacy')
    if(!key) return

    // Estado ativo apenas dentro do grupo de privacidade
    privacyLinks.forEach(l => l.classList.remove('active-link'))
    clicked.classList.add('active-link')

    // Mostrar área de privacidade e ocultar categorias
    if(privacyContainer) privacyContainer.style.display = 'block'
    if(categoriesContainer) categoriesContainer.style.display = 'none'

    // Oculta seções de categoria
    categorySections.forEach(section => {
        section.classList.remove('active')
        section.style.display = 'none'
    })

    privacySections.forEach(section => {
        const isMatch = section.getAttribute('data-privacy') === key
        section.classList.toggle('active', isMatch)
        section.style.display = isMatch ? 'block' : 'none'
    })

    // Atualiza o título principal com o nome da seção de privacidade
    try{ if(mainTitle) mainTitle.textContent = clicked.querySelector('span')?.textContent || 'Privacidade' }catch{}
}

function initializePrivacyVisibility(){
    // Começa oculto, só mostra ao clicar
    if(privacyContainer) privacyContainer.style.display = 'none'
    privacySections.forEach(section => {
        section.classList.remove('active')
        section.style.display = 'none'
    })
}

categoryLinks.forEach(l => l.addEventListener('click', handleCategoryClick))
privacyLinks.forEach(l => l.addEventListener('click', handlePrivacyClick))
initializeCategoriesVisibility()
initializePrivacyVisibility()

/*=============== CATEGORY CARDS FILTER ===============*/
;(function initializeCategoryFilters(){
    const categorySectionsNodeList = document.querySelectorAll('.category-section')
    if(!categorySectionsNodeList.length) return

    function applyFilter(section, query){
        const cards = section.querySelectorAll('.cards .card')
        const normalized = (query || '').trim().toLowerCase()
        if(!normalized){
            cards.forEach(card => { card.style.display = '' })
            return
        }
        cards.forEach(card => {
            const title = (card.getAttribute('data-title') || '').toLowerCase()
            const tags = (card.getAttribute('data-tags') || '').toLowerCase()
            const text = `${title} ${tags}`
            card.style.display = text.includes(normalized) ? '' : 'none'
        })
    }

    categorySectionsNodeList.forEach(section => {
        const input = section.querySelector('.cards-filter__input')
        if(!input) return
        input.addEventListener('input', () => applyFilter(section, input.value))
    })

    // Reset filter input when a different category becomes active
    function resetInactiveFilters(activeKey){
        categorySectionsNodeList.forEach(section => {
            const key = section.getAttribute('data-category')
            const input = section.querySelector('.cards-filter__input')
            if(!input) return
            if(key !== activeKey){
                input.value = ''
                applyFilter(section, '')
            }
        })
    }

    // Hook into existing category click to reset other filters
    categoryLinks.forEach(l => l.addEventListener('click', (e)=>{
        const category = e.currentTarget.getAttribute('data-category')
        if(category) resetInactiveFilters(category)
    }))
})()

/*=============== DARK LIGHT THEME ===============*/ 
const themeButton = document.getElementById('theme-button')
const darkTheme = 'dark-theme'
const iconTheme = 'ri-sun-fill'

// Previously selected topic (if user selected)
const selectedTheme = localStorage.getItem('selected-theme')
const selectedIcon = localStorage.getItem('selected-icon')

// We obtain the current theme that the interface has by validating the dark-theme class
const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'ri-moon-clear-fill' : 'ri-sun-fill'

// We validate if the user previously chose a topic
if (selectedTheme) {
  // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
  document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
  themeButton.classList[selectedIcon === 'ri-moon-clear-fill' ? 'add' : 'remove'](iconTheme)
}

// Activate / deactivate the theme manually with the button
themeButton.addEventListener('click', () => {
    // Add or remove the dark / icon theme
    document.body.classList.toggle(darkTheme)
    themeButton.classList.toggle(iconTheme)
    // We save the theme and the current icon that the user chose
    localStorage.setItem('selected-theme', getCurrentTheme())
    localStorage.setItem('selected-icon', getCurrentIcon())
})

/*=============== PROFILE FORM (NO LOCAL SAVE) ===============*/
;(function initializeProfileForm(){
    const form = document.getElementById('profile-form')
    const photoInput = document.getElementById('profile-photo-input')
    const photoPreview = document.getElementById('profile-photo-preview')
    if(!form || !photoInput || !photoPreview) return

    // Clique na foto abre seletor de arquivo
    photoPreview.addEventListener('click', (e)=>{
        e.preventDefault()
        photoInput.click()
    })

    // Apenas pré-visualiza a imagem; não salva no localStorage
    photoInput.addEventListener('change', (e)=>{
        const file = e.target.files && e.target.files[0]
        if(!file) return
        const reader = new FileReader()
        reader.onload = () => {
            const dataUrl = reader.result
            if(typeof dataUrl === 'string'){
                photoPreview.src = dataUrl
            }
        }
        reader.readAsDataURL(file)
    })
    // Não intercepta o submit: deixe o PHP processar quando configurado
})()

/*=============== VIDEO MODAL & ACTIONS ===============*/
;(function initializeVideoModal(){
    const modal = document.getElementById('video-modal')
    const backdrop = document.getElementById('video-modal-backdrop')
    const closeBtn = document.getElementById('video-modal-close')
    const titleEl = document.getElementById('video-modal-title')
    const videoEl = document.getElementById('video-modal-player')
    const sourceEl = document.getElementById('video-modal-source')
    if(!modal || !backdrop || !closeBtn || !titleEl || !videoEl || !sourceEl) return

    const likeBtn = document.getElementById('action-like')
    const playlistBtn = document.getElementById('action-playlist')
    const laterBtn = document.getElementById('action-later')
    const saveBtn = document.getElementById('action-save')

    // Sem persistência JS: apenas estados visuais temporários

    let currentId = null

    function openModal({ id, title, src }){
        currentId = id
        titleEl.textContent = title || 'Vídeo'
        sourceEl.src = src
        videoEl.load()
        modal.setAttribute('aria-hidden', 'false')
        document.body.style.overflow = 'hidden'

        // Reset estados visuais
        likeBtn.classList.remove('active')
        playlistBtn.classList.remove('active')
        laterBtn.classList.remove('active')
        saveBtn.classList.remove('active')
    }

    function closeModal(){
        modal.setAttribute('aria-hidden', 'true')
        document.body.style.overflow = ''
        videoEl.pause()
    }

    // Não fecha ao clicar fora ou Esc; apenas no X
    closeBtn.addEventListener('click', closeModal)

    // Wire up cards
    const cards = document.querySelectorAll('.cards .card')
    cards.forEach(card => {
        const title = card.querySelector('.card__title')?.textContent?.trim() || 'Vídeo'
        const source = card.querySelector('video source')?.getAttribute('src') || ''
        const id = `${title}::${source}`

        // Click to open modal - on wrapper and on video click
        const wrapper = card.querySelector('.card__video-wrapper')
        const video = card.querySelector('video')
        function open(){ if(source) openModal({ id, title, src: source }) }
        if(wrapper) wrapper.addEventListener('click', open)
        if(video){
            // Prevent inline playback; open modal instead
            video.addEventListener('play', (e)=>{ e.preventDefault?.(); video.pause(); open() })
            video.addEventListener('click', (e)=>{ e.preventDefault?.(); open() })
            video.controls = false
        }
        // Also open when clicking title
        const titleNode = card.querySelector('.card__title')
        if(titleNode) titleNode.addEventListener('click', open)
    })

    // Actions
    likeBtn.addEventListener('click', ()=>{ if(!currentId) return; likeBtn.classList.toggle('active') })
    playlistBtn.addEventListener('click', ()=>{ if(!currentId) return; playlistBtn.classList.toggle('active') })
    laterBtn.addEventListener('click', ()=>{ if(!currentId) return; laterBtn.classList.toggle('active') })
    saveBtn.addEventListener('click', ()=>{ if(!currentId) return; saveBtn.classList.toggle('active') })
})()

/*=============== LIST MODAL (LIKES/PLAYLIST/LATER/SAVED) ===============*/
;(function initializeListModal(){
    const modal = document.getElementById('list-modal')
    const backdrop = document.getElementById('list-modal-backdrop')
    const closeBtn = document.getElementById('list-modal-close')
    const titleEl = document.getElementById('list-modal-title')
    const countEl = document.getElementById('list-modal-count')
    const listEl = document.getElementById('list-modal-list')
    const emptyEl = document.getElementById('list-modal-empty')
    if(!modal || !backdrop || !closeBtn || !titleEl || !countEl || !listEl || !emptyEl) return

    function openModal({ key, title }){
        titleEl.textContent = title
        listEl.innerHTML = ''
        // Sem dados via JS: mostrar estado vazio até o PHP popular
        emptyEl.style.display = 'grid'
        countEl.innerHTML = '<i class="ri-play-fill"></i>0 itens'

        modal.setAttribute('aria-hidden', 'false')
        document.body.style.overflow = 'hidden'
    }

    function closeModal(){
        modal.setAttribute('aria-hidden', 'true')
        document.body.style.overflow = ''
    }

    // Apenas fecha no X (mesma regra da video modal)
    closeBtn.addEventListener('click', closeModal)

    // Delegação: assistir abre a video modal
    listEl.addEventListener('click', (e)=>{
        const btn = e.target.closest('[data-action="watch"]')
        if(!btn) return
        const src = btn.getAttribute('data-src') || ''
        const title = btn.getAttribute('data-title') || 'Vídeo'
        if(!src) return
        // expõe evento global para abrir a modal de vídeo
        document.dispatchEvent(new CustomEvent('mk:openVideoModal', { detail: { src, title } }))
    })

    // Wire up list cards
    document.querySelectorAll('.list-card').forEach(card => {
        const key = card.getAttribute('data-list-key')
        const title = card.querySelector('.card__title')?.textContent?.trim() || 'Lista'
        if(!key) return
        card.addEventListener('click', ()=> openModal({ key, title }))
    })

    // Ouvir pedido para abrir modal de vídeo
    document.addEventListener('mk:openVideoModal', (e)=>{
        const { src, title } = e.detail || {}
        const modal = document.getElementById('video-modal')
        const sourceEl = document.getElementById('video-modal-source')
        const videoEl = document.getElementById('video-modal-player')
        const titleEl = document.getElementById('video-modal-title')
        if(!modal || !sourceEl || !videoEl || !titleEl) return
        titleEl.textContent = title || 'Vídeo'
        sourceEl.src = src
        videoEl.load()
        modal.setAttribute('aria-hidden', 'false')
        document.body.style.overflow = 'hidden'
    })
})()
