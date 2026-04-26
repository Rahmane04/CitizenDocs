<template>
  <MainLayout>
    <div class="max-w-5xl mx-auto">
      <!-- Titre -->
      <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
        <p class="text-gray-500 text-sm mt-1">Bienvenue, {{ user?.prenom }} {{ user?.nom }}</p>
      </div>

      <!-- Cartes statistiques -->
      <div class="grid grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-5 border-t-4 border-teal-500">
          <p class="text-sm text-gray-500">Demandes en attente</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">0</p>
          <p class="text-xs text-teal-600 mt-2">en cours de traitement</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-t-4 border-green-500">
          <p class="text-sm text-gray-500">Demandes validées</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">0</p>
          <p class="text-xs text-green-600 mt-2">documents disponibles</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 border-t-4 border-red-400">
          <p class="text-sm text-gray-500">Demandes rejetées</p>
          <p class="text-3xl font-bold text-gray-800 mt-1">0</p>
          <p class="text-xs text-red-500 mt-2">voir les motifs</p>
        </div>
      </div>

      <!-- Actions rapides -->
      <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-base font-semibold text-gray-700 mb-4">Actions rapides</h2>
        <div class="flex gap-3">
          <button class="bg-blue-800 text-white px-5 py-2.5 rounded-lg hover:bg-blue-900 transition text-sm font-medium">
            + Nouvelle demande
          </button>
          <button class="border border-gray-300 text-gray-600 px-5 py-2.5 rounded-lg hover:bg-gray-50 transition text-sm">
            Mes demandes
          </button>
          <button class="border border-gray-300 text-gray-600 px-5 py-2.5 rounded-lg hover:bg-gray-50 transition text-sm">
            Mes documents
          </button>
        </div>
      </div>

      <!-- Dernières demandes -->
      <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-base font-semibold text-gray-700 mb-4">Dernières demandes</h2>
        <div class="text-center py-8 text-gray-400 text-sm">
          Aucune demande pour le moment
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