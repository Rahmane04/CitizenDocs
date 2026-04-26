<template>
  <MainLayout>
    <div class="max-w-5xl mx-auto">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Panel Administrateur</h1>
        <p class="text-gray-500 text-sm mt-1">Bonjour, {{ user?.prenom }}</p>
      </div>

      <div class="grid grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-teal-500">
          <p class="text-xs text-gray-500 uppercase tracking-wide">Total demandes</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">0</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-500">
          <p class="text-xs text-gray-500 uppercase tracking-wide">Citoyens</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">0</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-purple-500">
          <p class="text-xs text-gray-500 uppercase tracking-wide">Agents</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">0</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
          <p class="text-xs text-gray-500 uppercase tracking-wide">Paiements</p>
          <p class="text-2xl font-bold text-gray-800 mt-1">0 FCFA</p>
        </div>
      </div>

 <div class="grid grid-cols-2 gap-4">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-base font-semibold text-gray-700 mb-4">Gestion des comptes</h2>
        <div class="flex flex-col gap-2">
            <a href="/admin/users"
               class="bg-blue-800 text-white px-4 py-2.5 rounded-lg hover:bg-blue-900 transition text-sm text-left">
                👥 Voir tous les utilisateurs
            </a>
            <a href="/admin/users"
               class="border border-gray-200 text-gray-600 px-4 py-2.5 rounded-lg hover:bg-gray-50 transition text-sm text-left">
                ➕ Ajouter un agent
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-base font-semibold text-gray-700 mb-4">Types de documents</h2>
        <div class="flex flex-col gap-2">
            <a href="/admin/type-documents"
               class="bg-blue-800 text-white px-4 py-2.5 rounded-lg hover:bg-blue-900 transition text-sm text-left">
                📄 Voir les types
            </a>
            <a href="/admin/type-documents/create"
               class="border border-gray-200 text-gray-600 px-4 py-2.5 rounded-lg hover:bg-gray-50 transition text-sm text-left">
                ➕ Ajouter un type
            </a>
        </div>
    </div>
</div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'

const user = ref(window.authUser || null)
</script>