<template>
  <div class="min-h-screen flex flex-col bg-gray-50">
    <!-- Header -->
    <header class="bg-blue-900 text-white px-6 py-3 flex justify-between items-center shadow">
      <span class="text-xl font-bold tracking-wide">🏛️ CitizenDocs</span>
      <div class="flex items-center gap-4">
        <span class="text-sm text-blue-200">{{ user?.prenom }} {{ user?.nom }}</span>
        <form method="POST" action="/logout">
          <input type="hidden" name="_token" :value="csrfToken">
          <button type="submit"
            class="bg-white text-blue-900 text-sm font-semibold px-4 py-1.5 rounded hover:bg-gray-100 transition"></button>
        </form>
      </div>
    </header>

    <div class="flex flex-1">
      <!-- Sidebar -->
      <aside class="w-60 bg-blue-800 text-white flex flex-col py-6 px-3 gap-1">
        <div class="mb-4 px-3">
          <p class="text-xs text-blue-300 uppercase tracking-widest font-semibold">Navigation</p>
        </div>

        <a v-for="item in menuItems" :key="item.label"
          :href="item.href"
          class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-blue-700 transition cursor-pointer"
          :class="{ 'bg-blue-600 font-semibold': item.active }">
          <span class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold"
            :style="{ backgroundColor: item.color }">
            {{ item.label[0] }}
          </span>
          <span class="text-sm">{{ item.label }}</span>
          <span v-if="item.active" class="ml-auto w-2 h-2 rounded-full bg-white"></span>
        </a>

        <!-- Profil en bas -->
        <div class="mt-auto px-3 pt-4 border-t border-blue-700">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center font-bold text-sm text-blue-900">
              {{ user?.prenom?.[0] }}{{ user?.nom?.[0] }}
            </div>
            <div>
              <p class="text-sm font-medium">{{ user?.prenom }}</p>
              <p class="text-xs text-blue-300 capitalize">{{ user?.role }}</p>
            </div>
          </div>
        </div>
      </aside>

      <!-- Contenu -->
      <main class="flex-1 p-6 overflow-y-auto">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
const user = ref(window.authUser || null)
const role = user.value?.role

const allMenus = {
  citoyen: [
    { label: 'Accueil', href: '/citoyen/dashboard', color: '#1d4ed8', active: true },
    { label: 'Nouvelle demande', href: '#', color: '#d97706', active: false },
    { label: 'Mes demandes', href: '#', color: '#2563eb', active: false },
    { label: 'Mes paiements', href: '#', color: '#7c3aed', active: false },
    { label: 'Mes documents', href: '#', color: '#059669', active: false },
  ],
  agent: [
    { label: 'Accueil', href: '/agent/dashboard', color: '#1d4ed8', active: true },
    { label: 'Demandes', href: '#', color: '#2563eb', active: false },
    { label: 'Historique', href: '#', color: '#7c3aed', active: false },
  ],
  admin: [
    { label: 'Accueil', href: '/admin/dashboard', color: '#1d4ed8', active: true },
    { label: 'Utilisateurs', href: '#', color: '#2563eb', active: false },
    { label: 'Types documents', href: '#', color: '#d97706', active: false },
    { label: 'Rapports', href: '#', color: '#059669', active: false },
  ],
}

const menuItems = computed(() => allMenus[role] || allMenus.citoyen)
</script>