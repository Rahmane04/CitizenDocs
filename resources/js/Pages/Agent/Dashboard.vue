<template>
  <MainLayout>
    <div class="max-w-5xl mx-auto">
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tableau de bord Agent</h1>
        <p class="text-gray-500 text-sm mt-1">Bonjour, {{ user?.prenom }}</p>
      </div>

      <div class="grid grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-yellow-400">
          <p class="text-sm text-gray-500">En attente</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">{{ stats.en_attente }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
          <p class="text-sm text-gray-500">Validées</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">{{ stats.validee }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-red-400">
          <p class="text-sm text-gray-500">Rejetées</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">0{{ stats.rejetee }}</p>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-base font-semibold text-gray-700 mb-4">Demandes à traiter</h2>
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b text-gray-500">
              <th class="py-3 px-4 text-left font-medium">Référence</th>
              <th class="py-3 px-4 text-left font-medium">Citoyen</th>
              <th class="py-3 px-4 text-left font-medium">Type document</th>
              <th class="py-3 px-4 text-left font-medium">Statut</th>
              <th class="py-3 px-4 text-left font-medium">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="5" class="text-center py-8 text-gray-400">
                Aucune demande pour le moment
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </MainLayout>
</template>
<script setup>
import { ref } from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'

const user = ref(window.authUser || null)
const stats = ref(window.dashboardStats || { en_attente: 0, validee: 0, rejetee: 0 })
</script>
