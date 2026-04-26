<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
      <div class="text-xl font-bold text-blue-700">🏛️ CitizenDocs</div>
      <div class="flex gap-4">
        <span class="text-gray-600">{{ user?.prenom }} {{ user?.nom }}</span>
        <form method="POST" action="/logout">
          <input type="hidden" name="_token" :value="csrfToken">
          <button type="submit" class="text-red-500 hover:underline">
            Déconnexion
          </button>
        </form>
      </div>
    </nav>
    <main class="p-6">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
const user = ref(window.authUser || null)
</script>