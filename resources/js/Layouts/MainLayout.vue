<template>
  <div class="min-h-screen flex flex-col bg-slate-50">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
      <div class="max-w-5xl mx-auto px-6 py-3 flex items-center">

        <div class="flex items-center gap-4 lg:gap-6">
          <a href="#" class="flex items-center gap-2 shrink-0">
            <div class="w-8 h-8 bg-sky-600 rounded-lg flex items-center justify-center">
              <span class="text-white text-sm font-bold">C</span>
            </div>
            <span class="text-slate-800 font-bold text-lg tracking-tight">CitizenDocs</span>
          </a>

          <!-- Menu -->
          <nav class="flex items-center gap-1">
            <a v-for="item in menuItems" :key="item.label"
               :href="item.href"
               class="whitespace-nowrap flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200"
               :class="item.active ? 'bg-sky-50 text-sky-600 shadow-sm border border-sky-100/50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent'">
              <svg v-if="role !== 'citoyen' && iconPaths[item.icon]" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" :d="iconPaths[item.icon]" />
              </svg>
              {{ item.label }}
            </a>
          </nav>
        </div>

        <!-- Profil + déconnexion -->
        <div class="flex items-center gap-3 ml-auto shrink-0">
          <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-sm shrink-0">
              {{ user?.prenom?.[0] }}{{ user?.nom?.[0] }}
            </div>
            <div class="hidden lg:block shrink-0">
              <p class="text-sm font-medium text-slate-700 leading-none">{{ user?.prenom }} {{ user?.nom }}</p>
              <p class="text-xs text-slate-400 capitalize mt-0.5">{{ user?.role }}</p>
            </div>
          </div>
          <form method="POST" action="/logout" class="ml-2 shrink-0">
            <input type="hidden" name="_token" :value="csrfToken">
            <button type="submit"
              class="whitespace-nowrap flex items-center gap-1.5 text-sm text-slate-500 hover:text-red-600 transition-all font-semibold px-3 py-2 rounded-xl hover:bg-red-50/80 border border-transparent hover:border-red-100/30">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
              </svg>
              Déconnexion
            </button>
          </form>
        </div>
      </div>
    </header>

    <!-- CONTENU -->
    <main class="flex-1 max-w-5xl mx-auto w-full px-6 py-8">
      <slot />
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-slate-200 bg-white py-4">
      <div class="max-w-5xl mx-auto px-6 flex justify-between items-center">
        <p class="text-xs text-slate-400">© 2026 CitizenDocs — Gestion de documents administratifs</p>
        <p class="text-xs text-slate-400 capitalize">Connecté en tant que <span class="font-medium text-slate-600">{{ user?.role }}</span></p>
      </div>
    </footer>

  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
const user = ref(window.authUser || null)
const role = user.value?.role

const iconPaths = {
  home: 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25',
  'plus-circle': 'M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z',
  clipboard: 'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801-1.206a2.25 2.25 0 0 0-3.324 0M8.91 2.879a9 9 0 0 1 6.18 0M9.605 6h4.79m-6.79 3.75h10.5a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5H6.205a1.5 1.5 0 0 1-1.5-1.5v-7.5a1.5 1.5 0 0 1 1.5-1.5Z',
  'credit-card': 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z',
  folder: 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-19.5 0A2.25 2.25 0 002.25 15v4.5a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25V15a2.25 2.25 0 00-2.25-2.25m-19.5 0h19.5M2.25 9.75a2.25 2.25 0 012.25-2.25h3.182c.597 0 1.17.237 1.591.659l1.414 1.415a.5.5 0 00.354.146H19.5A2.25 2.25 0 0121.75 12M2.25 9.75V5.25A2.25 2.25 0 014.5 3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.28.28.66.438 1.06.438H19.5a2.25 2.25 0 012.25 2.25v1.5',
  users: 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766l-.014-.009v-.11a6.375 6.375 0 0112.75 0v.109zM3.557 9a15.047 15.047 0 015.821-1.517 14.98 14.98 0 015.821 1.517M3 13.065a4.125 4.125 0 017.533 0m0 0A4.125 4.125 0 013 13.065zm12.975 0a9.053 9.053 0 00-1.558-4.5M12.01 6a3 3 0 11-6 0 3 3 0 016 0zm7.49 3a3 3 0 11-6 0 3 3 0 016 0z',
  'document-text': 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z',
  'chart-bar': 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z'
}

const currentPath = window.location.pathname

const allMenus = {
  citoyen: [
    { label: 'Accueil', href: '/citoyen/dashboard', icon: 'home' },
    { label: 'Nouvelle demande', href: '/citoyen/demandes/create', icon: 'plus-circle' },
    { label: 'Mes demandes', href: '/citoyen/demandes', icon: 'clipboard' },
    { label: 'Paiements', href: '/citoyen/paiements', icon: 'credit-card' },
    { label: 'Documents', href: '/citoyen/documents', icon: 'folder' },
  ],
  agent: [
    { label: 'Accueil', href: '/agent/dashboard', icon: 'home' },
    { label: 'Demandes', href: '/agent/demandes', icon: 'clipboard' },
  ],
  admin: [
    { label: 'Accueil', href: '/admin/dashboard', icon: 'home' },
    { label: 'Utilisateurs', href: '/admin/users', icon: 'users' },
    { label: 'Types documents', href: '/admin/type-documents', icon: 'document-text' },
    { label: 'Rapports', href: '/admin/rapports', icon: 'chart-bar' },
  ],
}

const menuItems = computed(() => {
  const items = allMenus[role] || allMenus.citoyen
  return items.map(item => ({
    ...item,
    active: currentPath === item.href
  }))
})
</script>