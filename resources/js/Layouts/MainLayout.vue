<template>
  <div class="min-h-screen flex flex-col bg-slate-50">

    <!-- NAVBAR -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

        <div class="flex items-center gap-8">
          <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-sky-600 rounded-lg flex items-center justify-center">
              <span class="text-white text-sm font-bold">C</span>
            </div>
            <span class="text-slate-800 font-bold text-lg tracking-tight">CitizenDocs</span>
          </div>

          <!-- Menu -->
          <nav class="flex items-center gap-1">
            <a v-for="item in menuItems" :key="item.label"
               :href="item.href"
               class="px-3 py-2 rounded-lg text-sm font-medium transition"
               :class="item.active ? 'bg-sky-50 text-sky-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'">
              {{ item.label }}
            </a>
          </nav>
        </div>

        <!-- Profil + déconnexion -->
        <div class="flex items-center gap-3">
          <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-sm">
              {{ user?.prenom?.[0] }}{{ user?.nom?.[0] }}
            </div>
            <div>
              <p class="text-sm font-medium text-slate-700">{{ user?.prenom }} {{ user?.nom }}</p>
              <p class="text-xs text-slate-400 capitalize">{{ user?.role }}</p>
            </div>
          </div>
          <form method="POST" action="/logout">
            <input type="hidden" name="_token" :value="csrfToken">
            <button type="submit"
              class="text-sm text-slate-500 hover:text-red-600 transition font-medium px-3 py-1.5 rounded-lg hover:bg-red-50">
              Déconnexion
            </button>
          </form>
        </div>
      </div>
    </header>

    <!-- CONTENU -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-8">
      <slot />
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-slate-200 bg-white py-4">
      <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
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

const allMenus = {
  citoyen: [
    { label: 'Accueil', href: '/citoyen/dashboard', active: true },
    { label: 'Nouvelle demande', href: '/citoyen/demandes/create', active: false },
    { label: 'Mes demandes', href: '/citoyen/demandes', active: false },
    { label: 'Mes paiements', href: '/citoyen/demandes', active: false },
    { label: 'Mes documents', href: '/citoyen/demandes', active: false },
  ],
  agent: [
    { label: 'Accueil', href: '/agent/dashboard', active: true },
    { label: 'Demandes', href: '/agent/demandes', active: false },
  ],
  admin: [
    { label: 'Accueil', href: '/admin/dashboard', active: true },
    { label: 'Utilisateurs', href: '/admin/users', active: false },
    { label: 'Types documents', href: '/admin/type-documents', active: false },
    { label: 'Rapports', href: '/admin/rapports', active: false },
  ],
}

const menuItems = computed(() => allMenus[role] || allMenus.citoyen)
</script>